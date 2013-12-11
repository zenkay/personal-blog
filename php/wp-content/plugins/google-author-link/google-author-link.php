<?php

/*
Plugin Name: Google Author Link
Plugin URI: http://HelpForWP.com
Description: Manage your Google Authorship with this simple plugin. Works for single author and multi-author WordPress sites.
Version: 1.4.2
Author: HelpForWP
Author URI: http://HelpForWP.com

------------------------------------------------------------------------

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, 
or any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
*/




class GoogleAuthorLink {

	var $_linksCount = 0;

	public function __construct() {
		
		if(is_admin()) {
			add_action( 'admin_menu', array($this, 'galink_add_admin_option_page') );
			add_action( 'admin_init', array($this, 'galink_register_settings') );
			add_action( 'admin_init', array($this, 'galink_register_styles'));
			add_action( 'admin_print_styles', array($this, 'galink_enqueue_styles'));
			add_action( 'wp_print_scripts', array($this, 'galink_enqueue_scripts') );
	    }else{
			add_action('wp_head', array($this, 'galink_head_output_authorship') );
			add_action('wp_head', array($this, 'galink_head_output_publisher') );
		}

		add_filter( 'user_contactmethods', array($this, 'galink_google_profile'), 10, 1);
		
		register_activation_hook( __FILE__, array($this, 'galink_activate') );
		register_deactivation_hook( __FILE__, array($this, 'galink_deactivate') );
		register_uninstall_hook( __FILE__,  'GoogleAuthorLink::galink_remove_option' );
	}
	
	function galink_register_styles(){
		wp_register_style('google_author_link_admin_css', plugins_url('css/google-author-link-admin.css', __FILE__));
	}
	
	function galink_enqueue_styles(){
		wp_enqueue_style( 'google_author_link_admin_css' );
	}
	function galink_enqueue_scripts(){
		wp_enqueue_script( 'google-author-link', plugin_dir_url( __FILE__ ) . 'js/google-author-link-admin.js', array( 'jquery' ) );
	}
	function galink_activate() {

	}
	
	function galink_deactivate(){
		
	}

	function galink_remove_option() {
		delete_option('galink_options');
		delete_option('galink_google_publisher_profile');
		delete_option('galink_exclude_post_categories');
		delete_option('galink_exclude_custom_post_type');
		delete_option('galink_remove_authorship_from_all_pages');
		delete_option('galink_exclude_pages');
		
		return;
	}
	
	function galink_google_profile(){
		// Add Google Profiles
		$galink_contactmethods['galink_profile'] = 'Google Profile URL';
		return $galink_contactmethods;
	}
	
	function galink_add_admin_option_page(){
		add_options_page('Google-Author-Link', 'Google Author Link', 'manage_options', 'galink_options', array($this, 'galink_option_page') );
	}
	
	function galink_option_page() {
		if ( ! current_user_can( 'manage_options' ) ){
			wp_die( __('You do not have sufficient permissions to access this page.') );
		}		
		
		require_once('inc/google-author-link-options.php');
		//for title and body
		galink_options_show();

		
		//for footer
		require_once('inc/footer.php');
	}
	
	function galink_register_settings() {
		register_setting( 'galink-settings', 'galink_options' );
		register_setting( 'galink-settings', 'galink_google_publisher_profile' );
		register_setting( 'galink-settings', 'galink_exclude_post_categories' );
		register_setting( 'galink-settings', 'galink_exclude_custom_post_type' );
		register_setting( 'galink-settings', 'galink_remove_authorship_from_all_pages' );				
		register_setting( 'galink-settings', 'galink_exclude_pages' );		
	}
	
	function galink_head_output_authorship(){
		global $post;
		
		//check if exclude all pages
		$remove_all_pages = get_option('galink_remove_authorship_from_all_pages', 0);
		if( $remove_all_pages ){
			return;
		}
		//check if is exclude page
		$exclude_pages = get_option('galink_exclude_pages', '');
		if( $exclude_pages && is_array($exclude_pages) && count($exclude_pages) > 0 && in_array($post->ID, $exclude_pages) ){
			return;
		}
		//check if is exclude category
		$exclude_category = get_option('galink_exclude_post_categories', ''); 
		if( $exclude_category && is_array($exclude_category) && count($exclude_category) > 0 && in_category( $exclude_category ) ){
			return;
		}
		
		//check if is exclude post type
		$exclude_post_type = get_option('galink_exclude_custom_post_type', '');
		if( $exclude_post_type && is_array($exclude_post_type) && count($exclude_post_type) > 0 && is_singular( $exclude_post_type ) ){
			return;
		}
		
		//check if home page
		if ( is_home() || is_front_page() ){
			$galink_home_user = get_option('galink_options', 0);
			if ($galink_home_user < 1) return;
			
			$galink_author_id = $galink_home_user;
		}else if ( is_single() || is_page() ){
			$galink_author_id = $post->post_author;
		}
		$galink_google_profile = get_user_meta($galink_author_id, 'galink_profile', true);
		if ( $galink_google_profile ){
			echo '<link rel="author" href="'.$galink_google_profile.'"/>'."\n";
		}
	}
	
	function galink_head_output_publisher(){
		$galink_google_publisher_profile = get_option('galink_google_publisher_profile', '');
		if ( $galink_google_publisher_profile ){
			echo '<link rel="publisher" href="'.$galink_google_publisher_profile.'"/>'."\n";
		}
	}
}


$google_author_link = new GoogleAuthorLink();
