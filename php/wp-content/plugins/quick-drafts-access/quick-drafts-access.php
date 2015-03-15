<?php
/**
 * Plugin Name: Quick Drafts Access
 * Version:     2.0
 * Plugin URI:  http://coffee2code.com/wp-plugins/quick-drafts-access/
 * Author:      Scott Reilly
 * Author URI:  http://coffee2code.com/
 * Text Domain: quick-drafts-access
 * Domain Path: /lang/
 * License:     GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Description: Adds a link to Drafts under the Posts, Pages, and other custom post type sections in the admin menu.
 *
 * Compatible with WordPress 3.1 through 4.1+.
 *
 * =>> Read the accompanying readme.txt file for instructions and documentation.
 * =>> Also, visit the plugin's homepage for additional information and updates.
 * =>> Or visit: https://wordpress.org/plugins/quick-drafts-access/
 *
 * TODO:
 * - Add screen option checkboxes to control if menu links should appear?
 * - Cache user draft count; clear count when a post transitions to/from draft
 * - More unit tests
 *
 * @package Quick_Drafts_Access
 * @author  Scott Reilly
 * @version 2.0
 */

/*
	Copyright (c) 2010-2015 by Scott Reilly (aka coffee2code)

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

if ( ! class_exists( 'c2c_QuickDraftsAccess' ) ) :

class c2c_QuickDraftsAccess {

	/**
	 * Returns version of the plugin.
	 *
	 * @since 2.0
	 *
	 * @return string
	 */
	public static function version() {
		return '2.0';
	}

	/**
	 * Initializes the plugins.
	 */
	public static function init() {

		// Hook the admin menu to add links to drafts.
		add_action( 'admin_menu', array( __CLASS__, 'quick_drafts_access' ) );

	}

	/**
	 * Adds the drafts link(s) to the admin menu.
	 */
	public static function quick_drafts_access() {

		// Get a list of all post type with a UI.
		$post_types  = (array) get_post_types( array( 'show_ui' => true ), 'object' );

		// Permit filtering of the post types handled by the plugin.
		$post_types  = (array) apply_filters( 'c2c_quick_drafts_access_post_types', $post_types );

		// Memoized post status object.
		$post_status = null;

		// Iterate through all post types.
		foreach ( $post_types as $post_type ) {

			// If a post type doesn't look like a post type object, throw notice and skip it.
			if ( ! is_object( $post_type ) || ! property_exists( $post_type, 'name' ) ) {
				_doing_it_wrong(
					__FUNCTION__,
					__( 'The "c2c_quick_drafts_access_post_types" filter should be passed an array of post type objects.', 'quick-drafts-access' ),
					'2.0'
				);
				continue;
			}

			// Post type name.
			$name = $post_type->name;

			// Path base.
			$path = 'edit.php';

			// Specify post type if not 'post'.
			if ( 'post' != $name ) {
				$path .= '?post_type=' . $name;
			}

			// Array for query vars.
			$query_vars = array(
				'post_status' => 'draft',
			);

			// Get post status object if it hasn't been gotten already.
			if ( ! $post_status ) {
				$post_status = get_post_status_object( 'draft' );
			}

			// Permit override of default view state for draft links.
			$show_all_drafts = apply_filters( 'c2c_quick_drafts_access_show_all_drafts_menu_link', true, $post_type );
			$show_my_drafts  = apply_filters( 'c2c_quick_drafts_access_show_my_drafts_menu_link',  true, $post_type );

			// Count of all drafts the user has for this post type.
			if ( $show_my_drafts ) {
				$num_my_drafts = count( $x = get_posts( array_merge(
					$query_vars,
					array(
						'author'         => get_current_user_id(),
						'fields'         => 'ids',
						'post_type'      => $name,
						'posts_per_page' => -1,
					)
				) ) );
			} else {
				// If not showing the 'My Drafts' link, the exact count doesn't matter.
				$num_my_drafts = false;
			}

			// If the 'All Drafts' link hasn't been disabled via filter.
			if ( $show_all_drafts ) {

				// Count of all drafts readable by the user.
				$num_all_drafts = (int) wp_count_posts( $name, 'readable' )->draft;

				// Show the 'All Drafts' link if there are drafts, or if forced to do so via filter.
				if ( ( $num_all_drafts > 0 ) || apply_filters( 'c2c_quick_drafts_access_show_if_empty', false, $name, $post_type, 'all' ) ) {

					// Show the menu link unless 'My Drafts' is also being shown AND the user is responsible for all drafts
					if ( ! ( $show_my_drafts && $num_all_drafts === $num_my_drafts ) ) {

						// Link label.
						if ( 0 === $num_all_drafts ) {
							$menu_text = __( 'All Drafts', 'quick-drafts-access' );
						} else {
							$menu_text = sprintf( __( 'All Drafts (%s)', 'quick-drafts-access' ), number_format_i18n( $num_all_drafts ) );
						}

						// Add the menu link.
						add_submenu_page(
							$path,
							'', // page title is not applicable
							$menu_text,
							$post_type->cap->edit_posts,
							add_query_arg( $query_vars, $path )
						);

					}

				}

			}

			// If the 'My Drafts' link hasn't been disabled via filter.
			if ( $show_my_drafts ) {

				// Ensure an int value for count of user drafts.
				$num_my_drafts = (int) $num_my_drafts;

				// Limit query to those posts authored by the current user.
				$query_vars['author'] = get_current_user_id();

				// Show the 'My Drafts' link if there are drafts, or if forced to do so via filter.
				if ( ( $num_my_drafts > 0 ) || apply_filters( 'c2c_quick_drafts_access_show_if_empty', false, $name, $post_type, 'my' ) ) {

					// Link label.
					if ( 0 === $num_my_drafts ) {
						$menu_text = __( 'My Drafts', 'quick-drafts-access' );
					} else {
						$menu_text = sprintf( __( 'My Drafts (%s)', 'quick-drafts-access' ), number_format_i18n( $num_my_drafts ) );
					}

					// Add the menu link.
					add_submenu_page(
						$path,
						'', // page title is not applicable
						$menu_text,
						$post_type->cap->edit_posts,
						add_query_arg( $query_vars, $path )
					);

				}

			}

		}

	}

}

c2c_QuickDraftsAccess::init();

endif;
