<?php
/*
Plugin Name: JM Twitter Cards
Plugin URI: http://www.tweetpress.fr
Description: Meant to help users to implement and customize Twitter Cards easily
Author: Julien Maury
Author URI: http://www.tweetpress.fr
Version: 5.3.7
License: GPL2++

JM Twitter Cards Plugin
Copyright (C) 2013-2014, Julien Maury - contact@tweetpress.fr

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.

*    Sources: 
* - https://dev.twitter.com/docs/cards
* - https://dev.twitter.com/docs/cards/getting-started#open-graph
* - https://dev.twitter.com/docs/cards/markup-reference
* - https://dev.twitter.com/docs/cards/types/player-card
* - https://dev.twitter.com/docs/cards/app-installs-and-deep-linking [GREAT]
* - https://dev.twitter.com/discussions/17878
* - https://github.com/WebDevStudios/Custom-Metaboxes-and-Fields-for-WordPress [GREAT]
* - https://about.twitter.com/fr/press/brand-assets
* - http://www.jqeasy.com/jquery-character-counter
* - https://trepmal.com/2011/04/03/change-the-virtual-robots-txt-file/ [GREAT]
* - https://github.com/pippinsplugins/Settings-Import-and-Export-Example-Pluginc [GREAT]
* - http://www.wpexplorer.com/wordpress-image-crop-sizes/
*/


//Add some security, no direct load !
defined('ABSPATH') 
	or die('What we\'re dealing with here is a total lack of respect for the law !');


//Constantly constant
define( 'JM_TC_VERSION', '5.3.7' );
define( 'JM_TC_DIR', plugin_dir_path( __FILE__ )  );
define( 'JM_TC_INC_DIR', trailingslashit(JM_TC_DIR . 'inc') );
define( 'JM_TC_CLASS_DIR', trailingslashit(JM_TC_INC_DIR . 'classes') );
define( 'JM_TC_ADMIN_DIR', trailingslashit(JM_TC_DIR . 'inc/admin') );
define( 'JM_TC_ADMIN_CLASS_DIR', trailingslashit(JM_TC_ADMIN_DIR . 'classes') );
define( 'JM_TC_ADMIN_PAGES_DIR', trailingslashit(JM_TC_INC_DIR . 'admin/pages') );
define( 'JM_TC_METABOX_DIR', trailingslashit(JM_TC_INC_DIR . 'admin/meta-box') );
define( 'JM_TC_LANG_DIR', dirname(plugin_basename(__FILE__)) . '/languages/' );
define( 'JM_TC_URL', trailingslashit(plugin_dir_url( __FILE__ ).'inc/admin') );
define( 'JM_TC_METABOX_URL', trailingslashit(JM_TC_URL.'admin/meta-box') );
define( 'JM_TC_IMG_URL', trailingslashit(JM_TC_URL.'img') );
define( 'JM_TC_CSS_URL', trailingslashit(JM_TC_URL.'css') );
define( 'JM_TC_JS_URL', trailingslashit(JM_TC_URL.'js') );				
		

//Call modules 
require( JM_TC_INC_DIR . 'functions.inc.php' );
require( JM_TC_CLASS_DIR . 'utilities.class.php' ); 
require( JM_TC_CLASS_DIR . 'particular.class.php' ); 
require( JM_TC_CLASS_DIR . 'thumbs.class.php' );
require( JM_TC_CLASS_DIR . 'disable.class.php' );
require( JM_TC_CLASS_DIR . 'options.class.php' );
require( JM_TC_CLASS_DIR . 'markup.class.php' ); 

if( is_admin() ) {
	
	require( JM_TC_ADMIN_CLASS_DIR . 'author.class.php' );
	require( JM_TC_ADMIN_CLASS_DIR.  'tabs.class.php' );
	require( JM_TC_ADMIN_CLASS_DIR.  'admin-tc.class.php' );
	require( JM_TC_ADMIN_CLASS_DIR . 'preview.class.php' );	
	require( JM_TC_ADMIN_CLASS_DIR . 'meta-box.class.php' );	
	require( JM_TC_ADMIN_CLASS_DIR . 'import-export.class.php' );	

}

/******************
	CLASS INIT
******************/

global $jm_twitter_cards;

//check if Twitter cards is activated in Yoast and deactivate it
$jm_twitter_cards['disable'] = new JM_TC_Disable;

//handle particular cases	
$jm_twitter_cards['particular'] = new JM_TC_Particular;

//admin classes
if( is_admin() ) {

	$jm_twitter_cards['utilities'] = new JM_TC_Utilities;
	$jm_twitter_cards['admin-tabs'] = new JM_TC_Tabs;
	$jm_twitter_cards['admin-base'] = new JM_TC_Admin; 
	$jm_twitter_cards['admin-import-export'] = new JM_TC_Import_Export;
	$jm_twitter_cards['admin-preview'] = new JM_TC_Preview;
	$jm_twitter_cards['admin-metabox'] = new JM_TC_Metabox;
	$jm_twitter_cards['admin-about'] = new JM_TC_Author;

}
	
$jm_twitter_cards['process-thumbs'] = new JM_TC_Thumbs;
$jm_twitter_cards['populate-markup'] = new JM_TC_Markup;

/**
* Add a "Settings" link in the plugins list
*/	
function jm_tc_settings_action_links($links, $file)
{
	$settings_link = '<a href="' . admin_url('admin.php?page=jm_tc') . '">' . __("Settings") . '</a>';
	array_unshift($links, $settings_link);
	
	return $links;
}

/**
* Init meta box
*/	
function jm_tc_initialize() 
{
	if ( ! class_exists( 'cmb_Meta_Box' ) ) {
		
		require_once JM_TC_METABOX_DIR . 'init.php';
	
	}

	/* Thumbnails */
	$opts = jm_tc_get_options();
	$is_crop = true;
	$crop = $opts['twitterCardCrop'];
	$crop_x =  $opts['twitterCardCropX'];
	$crop_y =  $opts['twitterCardCropY'];
	$size = $opts['twitterCardImgSize'];

	switch($crop)
		{
			case 'yes' :
				$is_crop = true;
			break;

			case 'no' :
				$is_crop = false;
			break;

			case 'yo' :
				global $wp_version;
				$is_crop = ( version_compare( $wp_version, '3.9', '>=') ) ? array($crop_x, $crop_y) : true;
			break;
		}

	if (function_exists('add_theme_support')) 
		add_theme_support('post-thumbnails');

	switch ($size) 
	{
		case 'small':
			add_image_size('jmtc-small-thumb', 280, 150, $is_crop);/* the minimum size possible for Twitter Cards */
		break;

		case 'web':
			add_image_size('jmtc-max-web-thumb', 435, 375, $is_crop);/* maximum web size for photo cards */
		break;

		case 'mobile-non-retina':
			add_image_size('jmtc-max-mobile-non-retina-thumb', 280, 375, $is_crop);/* maximum non retina mobile size for photo cards*/
		break;

		case 'mobile-retina':
			add_image_size('jmtc-max-mobile-retina-thumb', 560, 750, $is_crop);/* maximum retina mobile size for photo cards  */
		break;

		default:
			add_image_size('jmtc-small-thumb', 280, 150, $is_crop);/* the minimum size possible for Twitter Cards */
	}
}


/**
* Everything that should trigger early
*/	
function jm_tc_plugins_loaded()
{
	//lang
	load_plugin_textdomain('jm-tc', false, JM_TC_LANG_DIR);
	
	//settings link
	add_filter('plugin_action_links_' . plugin_basename(__FILE__) , 'jm_tc_settings_action_links', 10, 2);
	
	//meta box
	add_action( 'init', 'jm_tc_initialize');
	
	//markup
	global $jm_twitter_cards;
	$init_markup = $jm_twitter_cards['populate-markup'];
	
	add_action('wp_head', array( $init_markup, 'add_markup'), 2 );
}
add_action('plugins_loaded', 'jm_tc_plugins_loaded');

/**
* Default options for multisite when creating new site
*/	
function jm_tc_new_blog($blog_id ) 
{
	switch_to_blog( $blog_id );
	
		jm_tc_on_activation();

	 restore_current_blog();
}
add_action('wpmu_new_blog', 'jm_tc_new_blog');

/**
* Avoid undefined index by registering default options
*/	
function jm_tc_on_activation() 
{
	$opts = get_option('jm_tc');	
	if (!is_array($opts)) update_option('jm_tc', jm_tc_get_default_options());  
}



/**
* Avoid undefined index by registering default options
*/
function jm_tc_activate() {

	if( !is_multisite() ) {
		jm_tc_on_activation();
	
	} else {
	
	    // For regular options.
		global $wpdb;
		$blog_ids = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );
		foreach ( $blog_ids as $blog_id ) 
		{
			switch_to_blog( $blog_id );
			jm_tc_on_activation();
			restore_current_blog();
			  
		}
	
	}
	
}
register_activation_hook(__FILE__, 'jm_tc_activate');

/**
* Return default options
* @return array
*/	
function jm_tc_get_default_options()
{
	return array(
		'twitterCardType' => 'summary',
		'twitterCreator' => 'TweetPressFr',
		'twitterSite' => 'TweetPressFr',
		'twitterImage' => 'https://g.twimg.com/Twitter_logo_blue.png',
		'twitterCardImgSize' => 'small',
		'twitterImageWidth' => '280',
		'twitterImageHeight' => '150',
		'twitterCardMetabox' => 'yes',
		'twitterProfile' => 'yes',
		'twitterPostPageTitle' => get_bloginfo('name') , // filter used by plugin to customize title
		'twitterPostPageDesc' => __('Welcome to', 'jm-tc') . ' ' . get_bloginfo('name') . ' - ' . __('see blog posts', 'jm-tc') ,
		'twitterCardTitle' => '',
		'twitterCardDesc' => '',
		'twitterCardExcerpt' => 'no',
		'twitterCardCrop' => 'yes',
		'twitterCardCropX' => '',
		'twitterCardCropY' => '',
		'twitterUsernameKey' => 'jm_tc_twitter',
		'twitteriPhoneName' => '',
		'twitteriPadName' => '',
		'twitterGooglePlayName' => '',
		'twitteriPhoneUrl' => '',
		'twitteriPadUrl' => '',
		'twitterGooglePlayUrl' => '',
		'twitteriPhoneId' => '',
		'twitteriPadId' => '',
		'twitterGooglePlayId' => '',
		'twitterCardRobotsTxt' => 'no',
		'twitterAppCountry' => '',
		'twitterCardOg' => 'no',
	);
}