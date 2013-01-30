<?php
add_action('admin_menu', 'any_mobile_create_menu');

function any_mobile_create_menu() {
	add_options_page('Any Mobile Theme', 'Any Mobile Theme', 'administrator', __FILE__, 'am_settings_page');
	add_action('admin_init', 'register_mysettings_theme');
}

function register_mysettings_theme() {
	register_setting('am-settings-group', 'iphone_theme');
	register_setting('am-settings-group', 'ipad_theme');
	register_setting('am-settings-group', 'android_theme');
	register_setting('am-settings-group', 'android_tab_theme');
	register_setting('am-settings-group', 'blackberry_theme');
	register_setting('am-settings-group', 'windows_theme');
	register_setting('am-settings-group', 'opera_theme');
	register_setting('am-settings-group', 'parm_os_theme');
	register_setting('am-settings-group', 'other_theme');
	register_setting('am-settings-group', 'mobile_view_theme_link_text');
	register_setting('am-settings-group', 'desktop_view_theme_link_text');
	register_setting('am-settings-group', 'show_switch_link_for_desktop');
}

function am_settings_page() {	
	include('includes/amts-header.php');
	include('includes/amts-theme-select.php');
	include('includes/amts-force-switch.php');
	include('includes/amts-readme.php');
	include('includes/amts-footer.php');
}