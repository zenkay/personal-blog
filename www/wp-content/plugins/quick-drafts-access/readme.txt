=== Quick Drafts Access ===
Contributors: coffee2code
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=6ARCFJ9TX3522
Tags: draft, drafts, admin, menu, multiuser, post, page, post_type, shortcut, coffee2code
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Requires at least: 3.1
Tested up to: 4.1
Stable tag: 2.0

Adds links to 'All Drafts' and 'My Drafts' under the Posts, Pages, and other custom post type sections in the admin menu.


== Description ==

By default in WordPress, accessing the drafts listing of any given post type (including posts and pages) in the admin requires multiple clicks. Then filtering the drafts listing by a particular user (generally to view only your drafts) additionally requires some non-obvious manual URL hacking.

This plugin allows you one click access to all drafts, as well as to just your drafts, of each post type via the main admin menu.

In addition, the plugin provides a count of the number of current drafts for that post type in the link (i.e. the link could read "All Drafts (3)" to indicate there are three drafts for that post type, and "My Drafts (1)" to indicate you only have one draft for that post type).

When the user is responsible for all of the drafts of a given post type (and the "My Drafts" link is not disabled via a hook) then only the "My Drafts" links will appear. It would be redundant to show both the "All Drafts" and "My Drafts" links in this situation. This behavior also ensures only one link is present for single-author blogs.

Also, the draft link(s) only appear for users who have the capability to edit posts of that post type.

The plugin hides the two types of draft links when no related drafts for that post type are present. See the Filters section for how to override this behavior. Filters are also provided to disable the plugin from ever showing the "All Drafts" or the "My Drafts" links.

Links: [Plugin Homepage](http://coffee2code.com/wp-plugins/quick-drafts-access/) |  [Plugin Directory Page](https://wordpress.org/plugins/quick-drafts-access/) | [Author Homepage](http://coffee2code.com)


== Installation ==

1. Unzip `quick-drafts-access.zip` inside the `/wp-content/plugins/` directory (or install via the built-in WordPress plugin installer)
1. Activate the plugin through the 'Plugins' admin menu in WordPress


== Screenshots ==

1. A screenshot of the main admin menu (with the menu expanded) showing the "All Drafts" and "My Drafts" link (with pending draft counts) for both posts (in the sidebar menu popup) and pages (in the expanded sidebar menu). Note that for pages, the "All Drafts" link is not shown because the current user is responsible for all of the current page drafts.


== Frequently Asked Questions ==

= Why don't I see an "All Drafts" or "My Drafts" link in my menu after activating the plugin? =

Does that post type have any drafts?  By default, the plugin does NOT display the drafts links if no drafts are present for that post type. This behavior can be overridden (see the Filters section).

The "All Drafts" link is always hidden for users who are responsible for all drafts of a given post type, assuming the "My Drafts" link is configured to be displayed (which it is by default).

= Why don't you show the "All Drafts" and "My Drafts" links for post types that don't have any drafts? =

Like the Posts and Pages admin tables in WordPress, the default behavior of the plugin is to not show the drafts link if none are present for the post type since there isn't anything meaningful to link to. Bear in mind that the behavior can be overridden (see the Filters section).

= For my single author site, isn't it redundant to display both the "All Drafts" and "My Drafts" links since they are effectively identical? =

Yes, which is why the plugin hides the "All Drafts" link when the "My Drafts" link is configured to be displayed (which it is by default) and the user is responsible for all of the drafts for a given post type.


== Filters ==

The plugin is further customizable via four filters. Typically, these customizations would be put into your active theme's functions.php file, or used by another plugin.

= c2c_quick_drafts_access_post_types =

The 'c2c_quick_drafts_access_post_types' filter allows you to customize the list of post_types for which the draft links will be shown. By default, draft links will be shown for all public post types, which includes the default post types of 'post' and 'page'. If other post types have been added to your site, they will also automatically be taken into consideration. If you want to explicitly add or remove particular post types, use this filter.

Arguments:

* $post_types (array): Array of post type objects

Example:

`
/**
 * Prevents the drafts menu link(s) from being displayed for the 'event' post type.
 *
 * @param array  $post_types The post types that will show drafts menu links by default.
 * @return array
 */
function my_qda_mods( $post_types ) {
    $acceptable_post_types = array();
    foreach ( (array) $post_types as $post_type ) {
        // Don't show the Drafts link for 'event' post type
        if ( ! in_array( $post_type->name, array( 'event' ) ) ) {// More post types can be added to this array
            $acceptable_post_types[] = $post_type;
        }
    }
    return $acceptable_post_types;
}
add_filter( 'c2c_quick_drafts_access_post_types', 'my_qda_mods' );
`

= c2c_quick_drafts_access_show_all_drafts_menu_link =

The 'c2c_quick_drafts_access_show_all_drafts_menu_link' filter allows you to customize whether the 'All Drafts' link will appear at all for a post type. If true, then the 'c2c_quick_drafts_access_show_if_empty' filter would ultimately determine if the link should appear based on the presence of actual drafts.

Arguments:

* $show (bool): The default boolean indicating if the 'All Drafts' link should be shown at all. Default is truee.
* $post_type (object): The post_type object

Example:

`
// Completely disable the 'All Drafts' link for all post types.
add_filter( 'c2c_quick_drafts_access_show_all_drafts_menu_link', '__return_false' );
`

= c2c_quick_drafts_access_show_my_drafts_menu_link =

The 'c2c_quick_drafts_access_show_my_drafts_menu_link' filter allows you to customize whether the 'My Drafts' link will appear at all for a post type. If true, then the 'c2c_quick_drafts_access_show_if_empty' filter would ultimately determine if the link should appear based on the presence of actual drafts.

Arguments:

* $show (bool): The default boolean indicating if the 'My Drafts' link should be shown at all. Default is truee.
* $post_type (object): The post_type object

Example:

`
// Completely disable the 'My Drafts' link for all post types.
add_filter( 'c2c_quick_drafts_access_show_my_drafts_menu_link', '__return_false' );
`

= c2c_quick_drafts_access_show_if_empty =

The 'c2c_quick_drafts_access_show_if_empty' filter allows you to customize whether the 'All Drafts' and/or 'My Drafts' links will appear for a post type _when that post type currently has no drafts_.

Arguments:

* $show (bool): The default boolean indicating if the Drafts link should be shown if the post type does not have any drafts. Default is false.
* $post_type_name (string): The post_type name
* $post_type (object): The post_type object
* $menu_type (string): The type of draft menu link. Either 'all' for 'All Drafts' or 'my' for 'My Drafts'.

Example:

`
// Show the links to drafts even if no drafts exist for the post type or the user.
add_filter( 'c2c_quick_drafts_access_show_if_empty', '__return_true' );
`


== Changelog ==

= 2.0 (2015-02-23) =
* Change 'Drafts' menu link text to 'All Drafts'
* Add 'My Drafts' menu link that links directly to current user's drafts
* Add filter 'c2c_quick_drafts_access_show_all_drafts_menu_link'
* Add filter 'c2c_quick_drafts_access_show_my_drafts_menu_link'
* Add extra arg to 'c2c_quick_drafts_access_show_if_empty' filter with value of 'all' or 'my' to allow fine-grained control
* Build query args via add_query_args() rather than as a string
* Skip handling a post type if it doesn't look like a post type object
* Cast result of 'c2c_quick_drafts_access_post_types' filter as array
* Remove is_admin() check that prevented class use outside of admin
* Add meager unit tests
* Add full localization support
* Add version() to return version number of the plugin
* Explicitly declare functions public and static
* Add documentation blocks for functions
* Add full inline code documentation
* Reformat plugin header
* Add 'Domain Path' directive to top of main plugin file
* Note compatibility through WP 4.1+
* Update copyright date (2015)
* Minor code reformatting (bracing, spacing)
* Change documentation links to wp.org to be https
* Update banner and screenshot images
* Add plugin icon
* Regenerate .pot

= 1.1.4 (2013-12-19) =
* Minor documentation tweaks
* Note compatibility through WP 3.8+
* Update copyright date (2014)
* Change donate link
* Update banner image to reflect WP 3.8 admin refresh
* Update screenshots to reflect WP 3.8 admin refresh

= 1.1.3 =
* Add check to prevent execution of code if file is directly accessed
* Note compatibility through WP 3.5+
* Update copyright date (2013)
* Move screenshots into repo's assets directory

= 1.1.2 =
* Re-license as GPLv2 or later (from X11)
* Add 'License' and 'License URI' header tags to readme.txt and plugin file
* Add banner image for plugin page
* Remove ending PHP close tag
* Note compatibility through WP 3.4+
* Update copyright date (2012)

= 1.1.1 =
* Note compatibility through WP 3.3+
* Update screenshots

= 1.1 =
* Improve internationalization support
* Note compatibility through WP 3.2+
* Drop compatibility with versions of WP older than 3.1
* Minor code refactoring and formatting changes
* Fix plugin homepage and author links in description in readme.txt

= 1.0.2 =
* Add link to plugin homepage to description in readme.txt

= 1.0.1 =
* Note compatibility with WP 3.1+
* Update copyright date (2011)
* Add Upgrade Notice section to readme.txt

= 1.0 =
* Initial release


== Upgrade Notice ==

= 2.0 =
Substantial update: now there is the potential for 'All Drafts' and/or 'My Drafts' menu links; added localization support; noted compatibility through WP 4.1+; more

= 1.1.4 =
Trivial update: noted compatibility through WP 3.8+

= 1.1.3 =
Trivial update: noted compatibility through WP 3.5+

= 1.1.2 =
Trivial update: noted compatibility through WP 3.4+; explicitly stated license

= 1.1.1 =
Trivial update: noted compatibility through WP 3.3+; updated screenshots

= 1.1 =
Moderate update: noted compatibility through WP 3.2+; dropped support for versions of WP older than 3.1; improved internationalization support

= 1.0.2 =
Trivial update: add link to plugin homepage to description in readme.txt

= 1.0.1 =
Trivial update: noted compatibility with WP 3.1+ and updated copyright date.
