<?php
/**
 * @package Tweet Dis
 */
    /*
     Plugin Name: Tweet Dis
     Plugin URI: http://tweetdis.com
     Description: This plugin lets you make any piece of text "tweetable". Visitors will just have to click this text in order to tweet it.
     Version: 2.4.4
     Author: Tim Soulo
     Author URI: http://tweetdis.com
     License: Ms-LPL
     */
/*  Copyright 2014  Web-Pantera  (email: xander.wp@gmail.cpm)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

define('TWEET_DIS_VERSION', '2.4.4');
//define('TWEET_DIS_PLUGIN_URL', trailingslashit( plugin_dir_url( __FILE__ ) ));
define( 'TWEET_DIS_PLUGIN_URL', plugins_url( '', __FILE__ ).'/' , true );

include_once dirname( __FILE__ ) . '/widget.php';

if ( is_admin() )
	require_once dirname( __FILE__ ) . '/admin.php';
   
register_deactivation_hook(__FILE__, 'gill_check_deactivation_tweet_dis');
function gill_check_deactivation_tweet_dis() {
    global $wpdb;
    $table_seting_tabs = $wpdb->prefix . "tweetdis_seting_tabs";
        $table_seting = $wpdb->prefix . "tweetdis_setings";
        $table_lic = $wpdb->prefix . "tweetdis";
         if($wpdb->get_var("SHOW TABLES LIKE '$table_seting'") == $table_seting) {
            $wpdb->query("DROP TABLE `".$table_seting."`");
        }
         if($wpdb->get_var("SHOW TABLES LIKE '$table_seting_tabs'") == $table_seting_tabs) {
            $wpdb->query("DROP TABLE `".$table_seting_tabs."`");
        }  
         if($wpdb->get_var("SHOW TABLES LIKE '$table_lic'") == $table_lic) {
            $license = $wpdb->get_row("SELECT * FROM `".$table_lic."` WHERE domain = '".$_SERVER['SERVER_NAME']."'" );
            file_get_contents_curl_td_tweet_dis("http://tweetdis.com/activate.php?act=deactivate&domain=".$license->domain."&key=".$license->key);
            $wpdb->query("DROP TABLE `".$table_lic."`");
        }
        wp_clear_scheduled_hook('gill_check_event');    
} 
$this_file = __FILE__;
$update_check = "http://www.tweetdis.com/tweetdis.chk";
require_once('gill-updates.php');