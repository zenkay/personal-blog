<?php
/*
Plugin Name: WP Twitter Cards
Plugin URI: http://www.hitreach.com/
Description: Creates Twitter Card meta data for your site
Version: 1.0
Author: HitReach
Author URI: http://www.hitreach.com/
*/

if (!class_exists('wp_twitter_cards')) {
	/**
	* WP Twitter Cards
	*/
	class wp_twitter_cards
	{
		
		function __construct()
		{
			add_action("admin_init", array(__CLASS__, 'twitter_cards_admin_settings'));
			add_action('admin_menu', array(__CLASS__, 'twitter_cards_admin_actions'));
			add_action('admin_init', array(__CLASS__, 'twitter_cards_output_to_postbox'), 1);
			add_action( 'save_post', array(__CLASS__, 'save_twitter_cards_post') );
			add_action('wp_head', array(__CLASS__, 'add_twitter_cards_to_head'));
			register_activation_hook(__FILE__, array(__CLASS__, 'twitter_cards_activation'));
		}

		function twitter_cards_admin () {
			include ('twitter_cards_admin.php');
		}


		function add_settings_input ($atts) {
			extract($atts);
			$options = get_option('twitter_cards');
			$previous = $options[$name];
			echo '<input class="regular-text" name="twitter_cards[' . esc_attr($name) . ']"'; 
			if ($type) {echo ' type="' . $type . '"';}
				else {echo ' type="text"';}
			if ($previous) echo ' value="' . esc_attr($previous) . '"';
			if ($maxlength) echo ' maxlength="' . esc_attr($maxlength) . '"';
			if ($placeholder) echo ' placeholder="' . esc_attr($placeholder);
			echo '" />';
		}

		function add_settings_textarea ($atts) {
			extract($atts);
			$options = get_option('twitter_cards');
			$previous = $options[$name];

			echo '<textarea name="twitter_cards[' . esc_attr($name) . ']"';
			if ($placeholder) echo ' placeholder="' . esc_attr($placeholder) . '"';
			if ($maxlength) echo ' maxlength="' . esc_attr($maxlength) . '"';
			echo ' class="widefat">';
			if ($previous) echo esc_textarea($previous);
			echo '</textarea>';
		}

		function add_settings_select ($atts) {
			extract($atts);
			$options = get_option('twitter_cards');
			$previous = $options[$name];
		}

		function twitter_cards_settings_site () {
			echo '<p>Site Settings</p>';
		}
		function twitter_cards_settings_defaults () {
			echo '<p>Default Settings</p>';
		}

		function twitter_cards_admin_settings () {

			register_setting('twitter_cards', 'twitter_cards');    

			add_settings_section('twitter_cards_site', 'Site Settings', array(__CLASS__, 'twitter_cards_settings_site'), 'twitter_cards');
				add_settings_field('twitter_cards_twitter_username', 'Twitter Username', array(__CLASS__, 'add_settings_input'), 'twitter_cards', 'twitter_cards_site', array('name' => 'twitter_username', 'placeholder' => '@username'));
			
			add_settings_section('twitter_cards_defaults', 'Default Settings', array(__CLASS__, 'twitter_cards_settings_defaults'), 'twitter_cards');
				add_settings_field('twitter_cards_default_title', 'Default Title', array(__CLASS__, 'add_settings_input'), 'twitter_cards', 'twitter_cards_defaults', array('name' => 'default_title', 'placeholder' => 'Maximum 70 characters', 'maxlength' => '70'));
				add_settings_field('twitter_cards_default_description', 'Default Description', array(__CLASS__, 'add_settings_textarea'), 'twitter_cards', 'twitter_cards_defaults', array('name' => 'default_description', 'placeholder' => 'Maximum 200 characters', 'maxlength' => '200'));
				add_settings_field('twitter_cards_default_image', 'Default Image', array(__CLASS__, 'add_settings_input'), 'twitter_cards', 'twitter_cards_defaults', array('name' => 'default_image', 'type' => 'url', 'placeholder' => 'url of image'));
			
		}

		function twitter_cards_postbox ($post) {
			include ('twitter_cards_postbox.php');
		}

		/**
		 * Add the settings page to the admin menu
		 */
		function twitter_cards_admin_actions () {
			add_options_page('Twitter Cards', 'Twitter Cards', 'manage_options', 'twitter_cards',  array(__CLASS__, 'twitter_cards_admin'));
		}





		/**
		 * Adds the meta options to posts, pages and links
		 * @return null 
		 */
		function twitter_cards_output_to_postbox ($post) {
			add_meta_box("twitter_cards", "Twitter Cards", array(__CLASS__, 'twitter_cards_postbox'), "post", "normal", "core", $post);
			add_meta_box("twitter_cards", "Twitter Cards", array(__CLASS__, 'twitter_cards_postbox'), "page", "normal", "core", $post);
			add_meta_box("twitter_cards", "Twitter Cards", array(__CLASS__, 'twitter_cards_postbox'), "link", "normal", "core", $post);
		}



		function save_twitter_cards_post ($post_id) {
			// Bail if we're doing an auto save
			if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
		    // if our nonce isn't there, or we can't verify it, bail
		    if( !isset( $_POST['twitter_cards_post_nonce'] ) || !wp_verify_nonce( $_POST['twitter_cards_post_nonce'], 'twitter_cards_post_nonce' ) ) return;
		    // if our current user can't edit this post, bail
		    if( !current_user_can( 'edit_post' ) ) return;
		    // Make sure your data is set before trying to save it
		    if( isset( $_POST['twitter_cards_post_description'] ) )
		        update_post_meta( $post_id, 'twitter_cards_post_description',  $_POST['twitter_cards_post_description']);
		    if( isset( $_POST['twitter_cards_post_title'] ) )
		    	update_post_meta($post_id, 'twitter_cards_post_title', $_POST['twitter_cards_post_title']);
		    if( isset( $_POST['twitter_cards_post_creator_username'] ) )
		    	update_post_meta($post_id, 'twitter_cards_post_creator_username', $_POST['twitter_cards_post_creator_username']);
		    if( isset( $_POST['twitter_cards_post_type'] ) )
		    	update_post_meta($post_id, 'twitter_cards_post_type', $_POST['twitter_cards_post_type']);
		    if( isset( $_POST['twitter_cards_post_image'] ) )
		    	update_post_meta($post_id, 'twitter_cards_post_image', $_POST['twitter_cards_post_image']);
		    if( isset( $_POST['twitter_cards_post_iframe'] ) )
		    	update_post_meta($post_id, 'twitter_cards_post_iframe', $_POST['twitter_cards_post_iframe']);
		    if( isset( $_POST['twitter_cards_post_stream'] ) )
		    	update_post_meta($post_id, 'twitter_cards_post_stream', $_POST['twitter_cards_post_stream']);
		}


		function add_twitter_cards_to_head () {

			if (is_page() || is_single()) {
				$id = get_the_ID();
			}

			if ($twitter_cards = get_option('twitter_cards')) {

				if ($site_username = $twitter_cards['twitter_username']) {
					self::echo_meta('twitter:site', $site_username);
				}

				

				if ($id) {
					//Post / Page
					
					if ($title = get_post_meta($id, 'twitter_cards_post_title', true)) {
						self::echo_meta('twitter:title', $title);
					} else if ($title = $twitter_cards['default_title']) {
						self::echo_meta('twitter:title', $title);
					}

					if ($desc = get_post_meta($id, 'twitter_cards_post_description', true)) {
						self::echo_meta('twitter:description', $desc);
					} else if ($desc = $twitter_cards['default_description']) {
						self::echo_meta('twitter:description', $desc);
					}

					if ($creator = get_post_meta($id, 'twitter_cards_post_creator_username', true)) {
						self::echo_meta('twitter:creator', $creator);
					}

					if ($image = get_post_meta($id, 'twitter_cards_post_image', true)) {
						self::echo_meta('twitter:image', $image);
					} else if ($image = $twitter_cards['default_image']) {
						self::echo_meta('twitter:image', $image);
					}

					if (!$type = get_post_meta($id, 'twitter_cards_post_type', true)) {
						$type = 'summary';
					}
					self::echo_meta('twitter:card', $type);

					if ($stream = get_post_meta($id, 'twitter_cards_post_stream', true) && $type == 'player') {
						self::echo_meta('twitter:player:stream', $stream);
					} else if ($iframe = get_post_meta($id, 'twitter_cards_post_iframe', true) && $type == 'player') {
						self::echo_meta('twitter:player', $iframe);
					}

					if ($url = get_permalink()) {
						self::echo_meta('twitter:url', $url);
					}
					
				} else if (is_category()) {
					//Category

					if ($cat_id = get_query_var('cat')) {

						self::echo_meta('twitter:card', 'summary');
						
						if ($name = get_cat_name($cat_id)) {
							self::echo_meta('twitter:title', $name);
						} else if ($title = $twitter_cards['default_title']) {
							self::echo_meta('twitter:title', $title);
						}

						if ($desc = self::cut_to_limit(200, category_description($cat_id))) {
							self::echo_meta('twitter:description', $desc);
						} else if ($desc = $twitter_cards['default_description']) {
							self::echo_meta('twitter:description', $desc);
						}

						if ($image = $twitter_cards['default_image']) {
							self::echo_meta('twitter:image', $image);
						}

					}

				} else {

					if ($title = $twitter_cards['default_title']) {
						self::echo_meta('twitter:title', $title);
					}

					if ($desc = $twitter_cards['default_description']) {
						self::echo_meta('twitter:description', $desc);
					}

					if ($image = $twitter_cards['default_image']) {
						self::echo_meta('twitter:image', $image);
					}

					self::echo_meta('twitter:url', site_url());
				}

			}

		}


		/**
		 * Outputs a meta tag
		 * @param  string $prop the meta tag property attribute 
		 * @param  string $val  the meta tag content attribute
		 * @return output       the meta tag
		 */
		function echo_meta ($prop, $val) {
			if ($prop && $val) {
				echo '<meta property="' . $prop . '" content="' . $val . '" />';
			}
		}

		/**
		 * Activates the plugin
		 * @return void 
		 */
		function twitter_cards_activation(){
			update_option("twitter_cards", array());
		}

		/**
		 * Cuts content to specified number of charcters
		 * @param  int $limit   	Maximum number of characters
		 * @param  string $content 	html or text string to be shortened
		 * @return string          	the shortened string
		 */
		function cut_to_limit ($limit, $content) {

			$content = trim(strip_tags($content));

			if (strlen($content) > $limit) {
				if (substr($content, $limit - 3, 1) == ' ' || substr($content, $limit - 4, 1) == ' ') {
					$content = trim(substr($content, 0, $limit - 3));
				} else {
					$content = substr($content, 0, $limit - 3);
					$content = substr($content, 0, strrpos($content, " "));
				}

				$content .= '...';

			}

			return $content;

		}
		
	}

	$wp_twitter_cards = new wp_twitter_cards();
}