<?php
/**
 * @package Quick_Drafts_Access
 * @author Scott Reilly
 * @version 1.1.3
 */
/*
Plugin Name: Quick Drafts Access
Version: 1.1.3
Plugin URI: http://coffee2code.com/wp-plugins/quick-drafts-access/
Author: Scott Reilly
Author URI: http://coffee2code.com/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Description: Adds a link to Drafts under the Posts, Pages, and other custom post type sections in the admin menu.

Compatible with WordPress 3.1 through 3.5+.

=>> Read the accompanying readme.txt file for instructions and documentation.
=>> Also, visit the plugin's homepage for additional information and updates.
=>> Or visit: http://wordpress.org/extend/plugins/quick-drafts-access/
*/

/*
	Copyright (c) 2010-2013 by Scott Reilly (aka coffee2code)

	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 2
	of the License, or (at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

defined( 'ABSPATH' ) or die();

if ( is_admin() && ! class_exists( 'c2c_QuickDraftsAccess' ) ) :

class c2c_QuickDraftsAccess {

	function init() {
		add_action( 'admin_menu', array( __CLASS__, 'quick_drafts_access' ) );
	}

	function quick_drafts_access() {
		$post_types = (array) get_post_types( array( 'show_ui' => true ), 'object' );
		$post_types = apply_filters( 'c2c_quick_drafts_access_post_types', $post_types );
		$post_status = null;

		foreach ( $post_types as $post_type ) {
			$name = $post_type->name;
			$num_posts = wp_count_posts( $name, 'readable' );
			$num_drafts = $num_posts->draft;

			if ( ( $num_drafts > 0 ) || apply_filters( 'c2c_quick_drafts_access_show_if_empty', false, $name, $post_type ) ) {
				$path = 'edit.php';
				if ( 'post' != $name ) // edit.php?post_type=post doesn't work
					$path .= '?post_type=' . $name;

				if ( ! $post_status )
					$post_status = get_post_status_object( 'draft' );

				add_submenu_page( $path, __( 'Drafts' ),
					sprintf( translate_nooped_plural( $post_status->label_count, $num_drafts ), number_format_i18n( $num_drafts ) ),
					$post_type->cap->edit_posts, "edit.php?post_type=$name&post_status=draft" );
			}
		}
	}

}

c2c_QuickDraftsAccess::init();

endif;
