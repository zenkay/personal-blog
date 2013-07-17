<?php

/*
Plugin Name: Google Author Link
Plugin URI: http://HelpForWP.com
Description: Manage your Google Authorship with this simple plugin. Works for single author and multi-author WordPress sites.
Version: 1.2
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
			add_action( 'admin_init', array($this, 'galink_register_settings') );
			add_action( 'admin_init', array($this, 'galink_register_styles'));
			add_action('admin_print_styles', array($this, 'galink_enqueue_styles'));
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
	
	function galink_activate() {

	}
	
	function galink_deactivate(){
		
	}

	function galink_remove_option() {
		delete_option('galink_options');
		delete_option('galink_google_publisher_profile');
		
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
	}
	
	function galink_head_output(){
	
		//check if home page
		if (is_home() || is_front_page()){
			$galink_home_user = get_option('galink_options', 0);
			if ($galink_home_user < 1) return;
			
			$galink_author_id = $galink_home_user;
		}else if ( is_single() || is_page() ){
			global $post;
			
			$galink_author_id = $post->post_author;
		}
		$galink_google_profile = get_user_meta($galink_author_id, 'galink_profile', true);
		if ( $galink_google_profile ){
			echo '<link rel="author" href="'.$galink_google_profile.'"/>'."\n";
		}
		
		$galink_google_publisher_profile = get_option('galink_google_publisher_profile', '');
		if ( $galink_google_publisher_profile ){
			echo '<link rel="publisher" href="'.$galink_google_publisher_profile.'"/>'."\n";
		}
	}
}


$google_author_link = new GoogleAuthorLink();
//hooks
add_action("admin_menu", array(&$google_author_link, 'galink_add_admin_option_page') );
add_action('wp_head', array(&$google_author_link, 'galink_head_output') );
