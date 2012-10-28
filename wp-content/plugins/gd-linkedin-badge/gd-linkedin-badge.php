<?php
/*
Plugin Name: GD LinkedIn Badge
Plugin URI: http://www.dev4press.com/plugins/gd-linkedin-badge/
Description: This widget displays badge with a link to a LinkedIn profile page.
Version: 2.3
Author: Milan Petrovic
Author URI: http://www.dev4press.com/

== Copyright ==

Copyright 2008 - 2012 Milan Petrovic (email: milan@gdragon.info)

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

require_once(dirname(__FILE__)."/code/widget.php");

class GDLinkedInBadge {
    var $wp_version;
    var $plugin_path;

    var $default_options = array(
            'title' => 'My LinkedIn Profile',
            'url' => 'http://www.linkedin.com/in/gdragon/',
            'text' => 'Milan Petrovic',
            'description' => 'To see my LinkedIn profile, click here:',
            'badge' => 0,
            'target' => '_blank',
            'align' => 'center',
            'image' => ''
        );

    var $badges = array(
            array('View Profile 160x33', 'btn_viewmy_160x33.gif'),
            array('My Profile 160x33', 'btn_myprofile_160x33.gif'),
            array('View Profile 160x25', 'btn_viewmy_160x25.gif'),
            array('View Profile 120x33', 'btn_viewmy_120x33.gif'),
            array('LinkedIn 120x33', 'btn_linkedin_120x30.gif'),
            array('Profile Grey 80x15', 'btn_profile_greytxt_80x15.gif'),
            array('Profile Blue 80x15', 'btn_profile_bluetxt_80x15.gif'),
            array('LinkedIn 80x15', 'btn_liprofile_blue_80x15.gif')
        );

    function GDLinkedInBadge() {
        global $wp_version;
        $this->wp_version = substr(str_replace('.', '', $wp_version), 0, 2);

        $this->plugin_path = dirname(__FILE__).'/';
        define('GDLI_BADGE_PATH', $this->plugin_path);

        add_action('init', array(&$this, 'init'));
        add_action('admin_head', array(&$this, 'admin_head'));

        if ($this->wp_version < 28) {
            add_action('plugins_loaded', array(&$this, 'init_widget'));
        } else {
            add_action('widgets_init', array(&$this, 'init_widgets_28'));
        }
    }

    function init() {
        $currentLocale = get_locale();
        if(!empty($currentLocale)) {
            $moFile = dirname(__FILE__).'/languages/gd-linkedin-badge-'.$currentLocale.'.mo';
            if (@file_exists($moFile) && is_readable($moFile)) {
                load_textdomain('gd-linkedin-badge', $moFile);
            }
        }
    }

    function admin_head() {
        global $parent_file;
        if ($parent_file == 'widgets.php' || $parent_file == 'themes.php') {
            $gdlb_js_items = "";

            for ($i = 0; $i < count($this->badges); $i++) {
                $gdlb_js_items.= "'".$this->badges[$i][1]."'";
                if ($i < count($this->badges) - 1) {
                    $gdlb_js_items.= ',';
                }
            }

            include(GDLI_BADGE_PATH.'code/jscss.php');
        }
    }

    function init_widgets_28() {
        register_widget('gdlbWidget');
    }

    function init_widget() {
        register_sidebar_widget(array('GD LinkedIn Badge', 'widgets'), array($this, 'widget'));
        register_widget_control(array('GD LinkedIn Badge', 'widgets'), array($this, 'control'), 250, 470);
    }

    function widget($args) {
        extract($args);
        $options = get_option('widget_gdlinkedinbadge');

        $title = trim($options['title']);
        $text = __($options['text']);
        $description = __($options['description']);
        $url = $options['url'];
        $badge = $options['badge'];
        $target = $options['target'];
        $align = $options['align'];

        echo $before_widget;

        if ($title != '') {
            echo $before_title.__($title).$after_title;
        }

        if ($description != '') {
            echo '<p'.($align != '' ? ' style="text-align: '.$align.';"' : '').' class="gdlb-widget-text">'.$description.'</p>';
        }

        echo $this->make_badge($url, $text, $target, $align, $badge);
        echo $after_widget;
    }

    function control() {
        $options = get_option('widget_gdlinkedinbadge');
        if (!is_array($options)) {
            $options = $this->default_options;
        }

        if ($_POST['gdlb-submit']) {
            $options['title'] = strip_tags(stripslashes($_POST['gdlb-title']));
            $options['url'] = $_POST['gdlb-url'];
            $options['text'] = $_POST['gdlb-text'];
            $options['description'] = $_POST['gdlb-description'];
            $options['badge'] = $_POST['gdlb-badge'];
            $options['target'] = $_POST['gdlb-target'];
            $options['align'] = $_POST['gdlb-align'];

            update_option('widget_gdlinkedinbadge', $options);
        }

        extract($instance);

        include(GDLI_BADGE_PATH.'forms/form_new.php');
    }

    function make_badge($badge_url, $badge_text, $target = '_blank', $align = 'center', $badge_id = 0) {
        $linked_img = 'http://www.linkedin.com/img/webpromo/';
        $badge_array = $this->badges[$badge_id];

        return '<div'.($align != '' ? ' style="text-align: '.$align.';"' : '').' class="gdlb-widget-badge"><a'.($target != '' ? ' target="'.$target.'"' : '').' href="'.$badge_url.'"><img src="'.$linked_img.$badge_array[1].'" border="0" alt="'.$badge_text.'" /></a></div>';
    }

    function make_options($selected = 0) {
        for ($i = 0; $i < count($this->badges); $i++) {
            $badge_array = $this->badges[$i];
            if ($selected == $i) 
                $current = ' selected="selected"';
            else 
                $current = '';
            echo "\n\t<option value='".$i."'".$current.">".$badge_array[0]."</option>";
        }
    }
}

$gdlb = new GDLinkedInBadge();

?>