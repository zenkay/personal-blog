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
	
	$iphoneTheme 		= get_option('iphone_theme');
	$ipadTheme			= get_option('ipad_theme');
	$androidTheme		= get_option('android_theme');
	$blackberryTheme	= get_option('blackberry_theme');
	$windowsTheme		= get_option('windows_theme');
	$operaTheme			= get_option('opera_theme');
	$palmTheme			= get_option('parm_os_theme');
	$otherTheme			= get_option('other_theme');	
	$mobileThemeText	= get_option('mobile_view_theme_link_text');
	$desktopThemeText	= get_option('desktop_view_theme_link_text');	
	$desktopSwitchLink	= get_option('show_switch_link_for_desktop');
	
	
	if (empty($mobileThemeText)){
		update_option('mobile_view_theme_link_text', 'Switch To Mobile Version');
		$mobileThemeText	= get_option('mobile_view_theme_link_text');
	}
	
	if (empty($desktopThemeText)){
		update_option('desktop_view_theme_link_text', 'Switch To Desktop Version');
		$desktopThemeText	= get_option('desktop_view_theme_link_text');	
	}
	
	if (empty($desktopSwitchLink)){
		update_option('show_switch_link_for_desktop', 'no');
		$desktopSwitchLink	= get_option('show_switch_link_for_desktop');	
	}
	
	$themeList 		= get_themes();
	$themeNames 	= array_keys($themeList); 
	$defaultTheme 	= get_current_theme();
	natcasesort($themeNames);
?>

<div class="wrap amts">
<h2>Any Mobile Theme Switcher</h2>
<style>
.amts .form-table th, .amts .form-table td{border:none !important;}
</style>
<table width="100%">
	<tr>
    	<td valign="top">
    <form method="post" action="options.php">
	<?php settings_fields( 'am-settings-group' ); ?>
    

        <table class="wp-list-table widefat fixed bookmarks">
            <thead>
                <tr>
                    <th>Select Theme For Devices</th>
                </tr>
            </thead>
            <tbody>
            <tr>
                <td>
    
    <table class="form-table">
         <tr valign="top">
        <th scope="row">iPhone/iPod Touch Theme:</th>
        <td>
        	<select name="iphone_theme">
     <?php 
      foreach ($themeNames as $themeName) {              
          if (($iphoneTheme == $themeName) || (($iphoneTheme == '') && ($themeName == $defaultTheme))) {
              echo '<option value="' . $themeName . '" selected="selected">' . htmlspecialchars($themeName) . '</option>';
          } else {
              echo '<option value="' . $themeName . '">' . htmlspecialchars($themeName) . '</option>';
          }
      }
     ?>
        	</select>
        </td>
        </tr>
         
        <tr valign="top">
        <th scope="row">iPad Theme</th>
        <td>
        	<select name="ipad_theme">
     <?php 
      foreach ($themeNames as $themeName) {              
          if (($ipadTheme == $themeName) || (($ipadTheme == '') && ($themeName == $defaultTheme))) {
              echo '<option value="' . $themeName . '" selected="selected">' . htmlspecialchars($themeName) . '</option>';
          } else {
              echo'<option value="' . $themeName . '">' . htmlspecialchars($themeName) . '</option>';
          }
      }
     ?>
        	</select>
        </td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Android Theme</th>
        <td>
        	<select name="android_theme">
     <?php 
      foreach ($themeNames as $themeName) {              
          if (($androidTheme == $themeName) || (($androidTheme == '') && ($themeName == $defaultTheme))) {
              echo '<option value="' . $themeName . '" selected="selected">' . htmlspecialchars($themeName) . '</option>';
          } else {
              echo'<option value="' . $themeName . '">' . htmlspecialchars($themeName) . '</option>';
          }
      }
     ?>
        	</select>
        </td>
        </tr>
		
		
		<tr valign="top">
        <th scope="row">Blackberry Theme</th>
        <td>
        	<select name="blackberry_theme">
     <?php 
      foreach ($themeNames as $themeName) {              
          if (($blackberryTheme == $themeName) || (($blackberryTheme == '') && ($themeName == $defaultTheme))) {
              echo '<option value="' . $themeName . '" selected="selected">' . htmlspecialchars($themeName) . '</option>';
          } else {
              echo'<option value="' . $themeName . '">' . htmlspecialchars($themeName) . '</option>';
          }
      }
     ?>
        	</select>
        </td>
        </tr>
        
        
        <tr valign="top">
        <th scope="row">Windows Mobile Theme</th>
        <td>
        	<select name="windows_theme">
			 <?php 
              foreach ($themeNames as $themeName) {              
                  if (($windowsTheme == $themeName) || (($windowsTheme == '') && ($themeName == $defaultTheme))) {
                      echo '<option value="' . $themeName . '" selected="selected">' . htmlspecialchars($themeName) . '</option>';
                  } else {
                      echo'<option value="' . $themeName . '">' . htmlspecialchars($themeName) . '</option>';
                  }
              }
             ?>
        	</select>
        </td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Opera Mini Theme</th>
        <td>
        	<select name="opera_theme">
			 <?php 
              foreach ($themeNames as $themeName) {              
                  if (($operaTheme == $themeName) || (($operaTheme == '') && ($themeName == $defaultTheme))) {
                      echo '<option value="' . $themeName . '" selected="selected">' . htmlspecialchars($themeName) . '</option>';
                  } else {
                      echo'<option value="' . $themeName . '">' . htmlspecialchars($themeName) . '</option>';
                  }
              }
             ?>
        	</select>
        </td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Parm Os Theme</th>
        <td>
        	<select name="parm_os_theme">
			 <?php 
              foreach ($themeNames as $themeName) {              
                  if (($palmTheme == $themeName) || (($palmTheme == '') && ($themeName == $defaultTheme))) {
                      echo '<option value="' . $themeName . '" selected="selected">' . htmlspecialchars($themeName) . '</option>';
                  } else {
                      echo'<option value="' . $themeName . '">' . htmlspecialchars($themeName) . '</option>';
                  }
              }
             ?>
        	</select>
        </td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Other Mobile Device Theme</th>
        <td>
        	<select name="other_theme">
			 <?php 
              foreach ($themeNames as $themeName) {              
                  if (($otherTheme == $themeName) || (($otherTheme == '') && ($themeName == $defaultTheme))) {
                      echo '<option value="' . $themeName . '" selected="selected">' . htmlspecialchars($themeName) . '</option>';
                  } else {
                      echo'<option value="' . $themeName . '">' . htmlspecialchars($themeName) . '</option>';
                  }
              }
             ?>
        	</select>
        </td>
        </tr>
		<tr valign="top">
        <th scope="row">&nbsp;</th>
        <td>
        	<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
        </td>
        </tr>
    </table>
    <br/>
    
</td></tr></tbody></table>

<br/>


        <table class="wp-list-table widefat fixed bookmarks">
            <thead>
                <tr>
                    <th>Other Settings (Optional)</th>
                </tr>
            </thead>
            <tbody>
            <tr>
                <td>
   
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Switch Mobile Theme Link Text</th>
        <td>
        <input name="mobile_view_theme_link_text" style="width:300px;"  value="<?php echo $mobileThemeText; ?>" type="text" />
        </td>
        </tr>
         
        <tr valign="top">
        <th scope="row">Switch Desktop Theme Link Text</th>
        <td>
        <input name="desktop_view_theme_link_text" style="width:300px;" value="<?php echo $desktopThemeText; ?>" type="text" />
        </td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Do you want to show Switch Mobile Theme link even the vistor is viewing from desktop ?</th>
        <td>
        	<input name="show_switch_link_for_desktop" type="radio" value="yes" <?php echo $desktopSwitchLink == 'yes'?'checked="checked"':''; ?> /> Yes &nbsp;&nbsp;&nbsp;
            <input name="show_switch_link_for_desktop" type="radio" value="no" <?php echo $desktopSwitchLink == 'no'?'checked="checked"':''; ?> /> No <br/><span class="description">Normally, it is <b>NO</b>. It is usually useless to force the visitor to switch to mobile theme when s/he is in desktop.</span>
        </td>
        </tr>
        
       <tr valign="top">
        <th scope="row">&nbsp;</th>
        <td>
        	<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
        </td>
        </tr>
        
    </table>
    
    <br/>
    
</td></tr></tbody></table>

<br/>

        <table class="wp-list-table widefat fixed bookmarks">
            <thead>
                <tr>
                    <th>Read Me Please</th>
                </tr>
            </thead>
            <tbody>
            <tr>
                <td>
    <p>
	Use the following shortcode <strong>[show_theme_switch_link]</strong> in templates to show the theme switch link.    
    <br/>Example: <strong>&lt;?php echo do_shortcode('[show_theme_switch_link]'); ?&gt;</strong>
    <br/><br/>
	You can also add Switch Mobile Theme link to your Menus from Custom Links section under Appearance > Menus.<br />
	Example:<br />
	Url : <strong>http://yoursitename.com/?am_force_theme_layout=desktop</strong> (For Mobile Theme)<br/>
    Url : <strong>http://yoursitename.com/?am_force_theme_layout=mobile</strong>  (For Desktop Theme)<br/>
    Label :  As you wish :)    
    </p>
    </td></tr></tbody></table>
    
        </td>
        <td width="15">&nbsp;</td>
        <td width="250" valign="top">
        	<table class="wp-list-table widefat fixed bookmarks">
            	<thead>
                <tr>
                	<th>Support</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                	<td>If you have any issues, click <a href="http://dineshkarki.com.np/forums/forum/mobile-theme-switcher" target="_blank">here</a> to visit our support forum</td>
                </tr>
                </tbody>
            </table>
            <br/>
            <table class="wp-list-table widefat fixed bookmarks">
            	<thead>
                <tr>
                	<th>Plugins You May Like</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                	<td>
                    	<ol>
                        	<li><a href="http://wordpress.org/extend/plugins/use-any-font/" target="_blank">Use Any Font</a></li>
                            <li><a href="http://dineshkarki.com.np/jquery-validation-for-contact-form-7" target="_blank">Jquery Validation For Contact Form 7</a></li>
                            <li><a href="http://wordpress.org/extend/plugins/add-tags-and-category-to-page/" target="_blank">Add Tags And Category To Page</a></li>
                            <li><a href="http://wordpress.org/extend/plugins/block-specific-plugin-updates/" target="_blank">Block Specific Plugin Updates</a></li>
                            <li><a href="http://wordpress.org/extend/plugins/featured-image-in-rss-feed/" target="_blank">Featured Image In RSS Feed</a></li>
                            <li><a href="http://wordpress.org/extend/plugins/remove-admin-bar-for-client/" target="_blank">Remove Admin Bar</a></li>
                            <li><a href="http://wordpress.org/extend/plugins/html-in-category-and-pages/" target="_blank">.html in category and page url</a></li>
                        </ol>
                    </td>
                </tr>
                </tbody>
            </table>
            <br/>
            <table class="wp-list-table widefat fixed bookmarks">
            	<thead>
                <tr>
                	<th>Facebook</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                	<td><iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2FDnessCarKey%2F77553779916&amp;width=185&amp;height=258&amp;show_faces=true&amp;colorscheme=light&amp;stream=false&amp;border_color=%23f9f9f9&amp;header=false&amp;appId=215419415167468" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:240px; height:258px;" allowTransparency="true"></iframe>
                    </td>
                </tr>
                </tbody>
            </table>
            <br/>
            
            
            
            
        </td>
    </tr>
</table>
   

</form>
</div>
<?php } ?>
