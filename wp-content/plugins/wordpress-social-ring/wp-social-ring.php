<?php
/*
Plugin Name: WordPress Social Ring
Description: Let visitors share posts/pages on Social Networks.
Author: Niccol&ograve; Tapparo
Version: 1.2.2
Author URI: http://wordpress.altervista.org/
Plugin URI: http://wordpress.altervista.org/wordpress-social-ring/
*/

define( 'WP_SOCIAL_RING', 'wp_social_ring' );
define( 'WP_SOCIAL_RING_PATH', plugin_dir_path(__FILE__) );
define( 'WP_SOCIAL_RING_URL', plugin_dir_url(__FILE__) );

register_activation_hook(__FILE__,'social_ring_install');

load_plugin_textdomain(WP_SOCIAL_RING, false, dirname(plugin_basename(__FILE__)).'/langs/');

//Set defaults if not defined
$wp_social_ring_options = get_option(WP_SOCIAL_RING.'_options');

include WP_SOCIAL_RING_PATH.'/includes/library.php';
include WP_SOCIAL_RING_PATH.'/includes/widgets.php';

if(is_admin()) {
	include WP_SOCIAL_RING_PATH.'/admin/admin.php';
}

function social_ring_install() {

	if(version_compare(get_bloginfo('version'), '3.3', '<')) {
		deactivate_plugins(basename(__FILE__));
	} else {
		$wp_social_ring_options = get_option(WP_SOCIAL_RING.'_options');
		if(empty($wp_social_ring_options)) {
			$wp_social_ring_options = array (
				'social_facebook_like_button' => 1,
				'social_facebook_send_button' => 0,
				'social_facebook_share_button' => 1,
				'social_twitter_button' => 1,
				'social_google_button' => 1,
				'social_pin_it_button' => 1,
				'social_linkedin_button' => 1,
				'social_stumble_button' => 0,
				'social_on_home' => 0,
				'social_on_pages' => 0,
				'social_on_posts' => 1,
				'social_on_category' => 0,
				'social_on_archive' => 0,
				'social_before_content' => 1,
				'social_after_content' => 0,
				'language' => 'Englsh',
				'facebook_language' => 'en_US',
				'google_language' => 'en-US',
				'twitter_language' => 'en',
				'button_counter' => 'horizontal'
			);
			update_option(WP_SOCIAL_RING.'_options', $wp_social_ring_options);
		}
		
	}
}


?>