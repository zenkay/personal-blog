<?php
/*
Plugin Name: WP LinkedIn
Plugin URI: http://vedovini.net/plugins/?utm_source=wordpress&utm_medium=plugin&utm_campaign=wp-linkedin
Description: This plugin enables you to add various part of your LinkedIn profile to your Wordpress blog.
Author: Claude Vedovini
Author URI: http://vedovini.net/?utm_source=wordpress&utm_medium=plugin&utm_campaign=wp-linkedin
Version: 1.17.1
Text Domain: wp-linkedin

# The code in this plugin is free software; you can redistribute the code aspects of
# the plugin and/or modify the code under the terms of the GNU Lesser General
# Public License as published by the Free Software Foundation; either
# version 3 of the License, or (at your option) any later version.

# THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
# EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
# MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
# NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
# LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
# OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
# WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
#
# See the GNU lesser General Public License for more details.
*/

define('WP_LINKEDIN_VERSION', '1.17.1');

if (!defined('LINKEDIN_FIELDS_RECOMMENDATIONS')) {
	define('LINKEDIN_FIELDS_RECOMMENDATIONS', 'recommendations-received:(recommendation-text,recommender:(first-name,last-name,public-profile-url))');
}

define('LINKEDIN_FIELDS_BASIC', 'id, first-name, last-name, picture-url, headline, location, industry, public-profile-url');
define('LINKEDIN_FIELDS_DEFAULT', 'summary, specialties, languages, skills, educations, positions, ' . LINKEDIN_FIELDS_RECOMMENDATIONS);
define('LINKEDIN_FIELDS', get_option('wp-linkedin_fields', LINKEDIN_FIELDS_DEFAULT));
define('LINKEDIN_PROFILELANGUAGE', get_option('wp-linkedin_profilelanguage'));
define('LINKEDIN_SENDMAIL_ON_TOKEN_EXPIRY', get_option('wp-linkedin_sendmail_on_token_expiry', false));
define('LINKEDIN_SSL_VERIFYPEER', get_option('wp-linkedin_ssl_verifypeer', true));

include 'class-linkedin-connection.php';
include 'class-recommendations-widget.php';
include 'class-card-widget.php';
include 'class-profile-widget.php';
include 'class-updates-widget.php';


class WPLinkedInPlugin {

	function WPLinkedInPlugin() {
		add_action('init', array(&$this, 'init'));
		add_action('widgets_init', array(&$this, 'widgets_init'));
		add_action('admin_menu', array(&$this, 'admin_init'));
	}

	function init() {
		// Make plugin available for translation
		// Translations can be filed in the /languages/ directory
		add_filter('load_textdomain_mofile', array(&$this, 'smarter_load_textdomain'), 10, 2);
		load_plugin_textdomain('wp-linkedin', false, dirname(plugin_basename(__FILE__)) . '/languages/' );

		wp_register_script('jquery.tools', plugins_url('jquery.tools.min.js', __FILE__), array('jquery'), '1.2.7', true);
		wp_register_script('responsive-scrollable', plugins_url('responsive-scrollable.js', __FILE__), array('jquery.tools'), WP_LINKEDIN_VERSION, true);
		wp_register_style('wp-linkedin', plugins_url('style.css', __FILE__), false, WP_LINKEDIN_VERSION);
		add_action('wp_enqueue_scripts', array(&$this, 'enqueue_scripts'));

		add_shortcode('li_recommendations', 'wp_linkedin_recommendations');
		add_shortcode('li_profile', 'wp_linkedin_profile');
		add_shortcode('li_card', 'wp_linkedin_card');
		add_shortcode('li_updates', 'wp_linkedin_updates');

		$post_types = $this->get_post_types();
		if (!empty($post_types)) {
			add_filter('the_content', array(&$this, 'filter_content'), 1);
		}
	}

	function smarter_load_textdomain($mofile, $domain) {
		if ($domain == 'wp-linkedin' && !is_readable($mofile)) {
			extract(pathinfo($mofile));
			$pos = strrpos($filename, '_');

			if ($pos !== false) {
				# cut off the locale part, leaving the language part only
				$filename = substr($filename, 0, $pos);
				$mofile = $dirname . '/' . $filename . '.' . $extension;
			}
		}

		return $mofile;
	}

	function get_post_types() {
		$post_types = get_option('wp-linkedin_add_card_to_content', array());

		if (!is_array($post_types)) {
			$post_types = ($post_types) ? array('post') : array();
		}

		return $post_types;
	}

	function filter_content($content) {
		if (is_singular($this->get_post_types())) {
			$content .= wp_linkedin_card(array('summary_length' => 2000));
		}

		return $content;
	}

	function widgets_init() {
		register_widget('WP_LinkedIn_Recommendations_Widget');
		register_widget('WP_LinkedIn_Card_Widget');
		register_widget('WP_LinkedIn_Profile_Widget');
		register_widget('WP_LinkedIn_Updates_Widget');
	}

	function admin_init() {
		require_once 'class-admin.php';
		$this->admin = new WPLinkedInAdmin($this);
	}

	function enqueue_scripts() {
		wp_enqueue_style('wp-linkedin');
	}
}


function wp_linkedin_error($message) {
	if (WP_DEBUG) {
		return "<p class='error'>$message</p>";
	} else {
		return "<!-- $message -->";
	}

}


function wp_linkedin_get_profile($options='id', $lang=LINKEDIN_PROFILELANGUAGE) {
	$linkedin = wp_linkedin_connection();
	return ($linkedin !== false) ? $linkedin->get_profile($options, $lang) : false;
}


function wp_linkedin_get_network_updates($count=50, $only_self=true) {
	$linkedin = wp_linkedin_connection();
	return ($linkedin !== false) ? $linkedin->get_network_updates($count, $only_self) : false;
}


function wp_linkedin_load_template($name, $args, $plugin=__FILE__) {
	$template = locate_template('linkedin/'. $name . '.php');

	if (empty($template)) {
		$template = dirname($plugin) . '/templates/' . $name . '.php';
	}

	$template = apply_filters('linkedin_template', $template);

	extract($args);
	ob_start();
	if (WP_DEBUG) echo '<!-- template path: ' . $template . ' -->';
	require($template);
	return ob_get_clean();
}


function wp_linkedin_profile($atts=array()) {
	$atts = shortcode_atts(array(
				'fields' => LINKEDIN_FIELDS,
				'lang' => LINKEDIN_PROFILELANGUAGE
			), $atts, 'li_profile');
	extract($atts);

	$fields = preg_replace('/\s+/', '', LINKEDIN_FIELDS_BASIC . ',' . $fields);
	$profile = wp_linkedin_get_profile($fields, $lang);

	if (is_wp_error($profile)) {
		return wp_linkedin_error($profile->get_error_message());
	} elseif ($profile && is_object($profile)) {
		return wp_linkedin_load_template('profile',
				array_merge($atts, array('profile' => $profile)));
	}
}


function wp_linkedin_card($atts=array()) {
	$atts = shortcode_atts(array(
				'picture_width' => '50',
				'summary_length' => '200',
				'fields' => 'summary',
				'lang' => LINKEDIN_PROFILELANGUAGE
			), $atts, 'li_card');
	extract($atts);

	$fields = preg_replace('/\s+/', '', LINKEDIN_FIELDS_BASIC . ',' . $fields);
	$profile = wp_linkedin_get_profile($fields, $lang);

	if (is_wp_error($profile)) {
		return wp_linkedin_error($profile->get_error_message());
	} elseif ($profile && is_object($profile)) {
		return wp_linkedin_load_template('card',
				array_merge($atts, array('profile' => $profile)));
	}
}


function wp_linkedin_recommendations($atts=array()) {
	$atts = shortcode_atts(array(
				'width' => 'auto',
				'length' => '200',
				'interval' => '4000'
			), $atts, 'li_recommendations');
	extract($atts);

	$profile = wp_linkedin_get_profile(LINKEDIN_FIELDS_RECOMMENDATIONS);

	if (is_wp_error($profile)) {
		return wp_linkedin_error($profile->get_error_message());
	} elseif ($profile && is_object($profile)) {
		if (isset($profile->recommendationsReceived->values) && is_array($profile->recommendationsReceived->values)) {
			return wp_linkedin_load_template('recommendations',
					array_merge($atts, array('recommendations' => $profile->recommendationsReceived->values)));
		} else {
			return wp_linkedin_error(__('You don\'t have any recommendation to show.', 'wp-linkedin'));
		}
	}
}


function wp_linkedin_updates($atts=array()) {
	$atts = shortcode_atts(array(
				'only_self' => true,
				'count' => 50
			), $atts, 'li_updates');
	extract($atts);

	$updates = wp_linkedin_get_network_updates($count, $only_self);

	if (is_wp_error($updates)) {
		return wp_linkedin_error($updates->get_error_message());
	} elseif ($updates && is_object($updates)) {
		return wp_linkedin_load_template('network-updates',
				array_merge($atts, array('updates' => $updates)));
	}
}


function wp_linkedin_excerpt($str, $length, $postfix='[...]') {
	$length++;

	if (function_exists('mb_strlen')) {
		if (mb_strlen($str) > $length) {
			$subex = mb_substr($str, 0, $length - 5);
			$exwords = explode(' ', $subex);
			$excut = -mb_strlen($exwords[count($exwords) - 1]);
			if ($excut < 0) {
				echo mb_substr($subex, 0, $excut);
			} else {
				echo $subex;
			}
			echo $postfix;
		} else {
			echo $str;
		}
	} else {
		if (strlen($str) > $length) {
			$subex = substr($str, 0, $length - 5);
			$exwords = explode(' ', $subex);
			$excut = -strlen($exwords[count($exwords) - 1]);
			if ($excut < 0) {
				echo substr($subex, 0, $excut);
			} else {
				echo $subex;
			}
			echo $postfix;
		} else {
			echo $str;
		}
	}
}


function wp_linkedin_cause($cause_name) {
	static $causes;
	if (!isset($causes)) {
		$causes = array(
			'animalRights' => __('Animal Welfare', 'wp-linkedin'),
			'artsAndCulture' => __('Arts and Culture', 'wp-linkedin'),
			'children' => __('Children', 'wp-linkedin'),
			'civilRights' => __('Civil Rights and Social Action', 'wp-linkedin'),
			'humanitarianRelief' => __('Disaster and Humanitarian Relief', 'wp-linkedin'),
			'economicEmpowerment' => __('Economic Empowerment', 'wp-linkedin'),
			'education' => __('Education', 'wp-linkedin'),
			'environment' => __('Environment', 'wp-linkedin'),
			'health' => __('Health', 'wp-linkedin'),
			'humanRights' => __('Human Rights', 'wp-linkedin'),
			'politics' => __('Politics', 'wp-linkedin'),
			'povertyAlleviation' => __('Poverty Alleviation', 'wp-linkedin'),
			'scienceAndTechnology' => __('Science and Technology', 'wp-linkedin'),
			'socialServices' => __('Social Services', 'wp-linkedin'));
	}

	return $causes[$cause_name];
}


global $the_wp_linked_plugin;
$the_wp_linked_plugin = new WPLinkedInPlugin();
