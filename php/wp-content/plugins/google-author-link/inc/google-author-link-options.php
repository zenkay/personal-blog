<?php

// ********** OPTIONS PAGE **********
// **********************************

function galink_options_show() {

	if ( ! current_user_can( 'list_users' ) ){
			wp_die( __( 'Cheatin&#8217; uh?' ) );
	}
	$galink_home_user = get_option('galink_options');
	$galink_args = array( 'show_option_none' => 'Please select',
						  'show' => 'display_name', 
						  'echo' => true, 
						  'selected' => $galink_home_user, 
						  'name' => 'galink_options', // string
						  'id' => null, // integer
						  'class' => 'linkedCategoriesSelect', // string 
						  'blog_id' => $GLOBALS['blog_id'],
						  'who' => null // string
						 );
?>
    <div class="wrap">
        <img src="<?PHP echo plugins_url(); ?>/google-author-link/images/help-for-wordpress-small.png" alt="Help For WordPress Logo" style="float:left;" />
        <h2>Google Author Link</h2>
        
        <a href="http://helpforwp.com/donate/?utm_source=PluginSettings&utm_medium=WP&utm_campaign=GoogleAuthorLink" target="_blank"><img src="<?PHP echo plugins_url(); ?>/google-author-link/images/paypal-donate.png" align="right" style="padding:10px;"/></a>
  <h2>Quick start guide</h2>
        <p>This plugin allows you to easily manage your Google Authorship and Google Publisher Profile.</p>
		<h3>Google Authorship</h3>
        <p>Each user that is contributing to the WordPress site now has a new field on their <a href='<?PHP echo get_admin_url() . "users.php"; ?>'>user profile</a> - 'Google Profile URL'. 
	        All users that have a Google profile should add the URL to their profile. The plugin will then add the correct author link to the html head of the document (on single posts and pages) so that Google recognises the author of the page.
        </p>
        <p>In addition you can set one user's profile to be used on the home page of your WordPress Site, choose that user below and click 'save'.
        </p>
		<h3>Google Publisher Profile</h3>
		<p>This is to link your company Google Publisher Profile to the entire web site, all you need to do add the "about" URL for your Google Page in the Publisher Profile URL below.</p>
		<p><i>This is optional and should only be used if you have a Google Page configured for your business.</i></p>
		<h3>Test the setup</h3>
		<p>Finally, ensure that you add your WordPress site to your Google Profle.<p>
        <p>Once you have completed the above, take one of your website URLs and test your page in the Google <a href="http://www.google.com/webmasters/tools/richsnippets" target="_blank">Rich Snippets Testing Tool</a>, this will confirm that all is setup correctly. 
        </p>
		<hr style="border:0;border-bottom: 1px dashed #ccc;background: #999;">
		<h2>Settings</h2>	
        <h3>Home page user profile</h3>
    	<form action="options.php" method="POST" id="wpls_settings">
    	<?php settings_fields( 'galink-settings' ); ?>
    	<table>
            <tr>
            	<td><?php wp_dropdown_users( $galink_args ); ?></td>
                <td>Choose the author for the home page.</td>
            </tr>
        </table>
        <?php
			$galink_google_publisher_profile = get_option('galink_google_publisher_profile');
		?>
        <h3>Google Publisher Profile URL</h3>
        <table>
            <tr>
            	<td><input type="text" name="galink_google_publisher_profile" id="galink_google_publisher_profile_id"  value="<?php echo $galink_google_publisher_profile; ?>" class="galink-google-publisher-profile" /></td>
                <td>If you have a Google Publisher Profile for this site, enter it here.</td>
            </tr>
        </table>
        
        
        <hr style="border:0;border-bottom: 1px dashed #ccc;background: #999;">
        <h2>Advanced authorship controls</h2>
        <p>By default your Google Authorship code will be added to all pages in your site.</p>
        <p>There are situations where this is not ideal, use the controls below to specify certain areas of your site that will not contain authorship markup code.</p>
        <p>Why remove Authorship code from certain content in your site? Get more information <a href="http://helpforwp.com/why-remove-google-authorship-code?utm_source=AuthorLink&utm_medium=SettingPage&utm_campaign=GoogleAuthorLink" target="_blank">here</a>.</p>
	        <p>
        <h3>Remove authorship from these categories</h3>
        <p>Select the categories below that will not have authorship code added.</p>
	        
			<?php
				$selected = get_option('galink_exclude_post_categories', ''); 
				$args = array( 'hide_empty' => 0, 'depth' => 0, 'hierarchical' => 1, 'name' => 'galink_exclude_post_categories[]', 'id' => 'galink_exclude_post_categories_id', 'echo' => 0,  );
				$categories_list = wp_dropdown_categories( $args );
				$categories_list_multiple = str_replace('<select', '<select multiple="multiple" style="width:350px; height:200px;" ', $categories_list);

				//check selected
				if( $selected && is_array($selected) && count($selected) > 0 ){
					$categories_options_array = explode('</option>', $categories_list_multiple);
					foreach( $categories_options_array as $key => $option ){
						foreach( $selected as $selected_cat ){
							if( strpos($option, 'value="'.$selected_cat.'"') !== false ){
								$categories_options_array[$key] = str_replace('value="'.$selected_cat.'"', 'value="'.$selected_cat.'" selected="selected"', $option);
							}
						}
					}
					$categories_list_multiple = implode('</option>', $categories_options_array);
				}
				
				echo $categories_list_multiple;
			?>
		</p>
        <p>Hold down Control or Command(Mac) for multiple selection</p>
        <h3>Remove authorship from these custom post types</h3>
<p>Each custom post type you choose here will no longer show your authorship code.</p>
        <p>
        	<?php
				$selected = get_option('galink_exclude_custom_post_type', ''); 
				$args = array('public'   => true, '_builtin' => false);
				$output = 'names'; // names or objects, note names is the default
				$operator = 'and'; // 'and' or 'or'
				$post_types = get_post_types( $args, $output, $operator ); 
			?>
            <select multiple="multiple" style="width:350px; height:50px;" name="galink_exclude_custom_post_type[]" id="galink_exclude_custom_post_type_id">
            <?php 
				if( count($post_types) > 0 ){ 
					foreach( $post_types as $post_type_name ){
						if ( $selected && is_array($selected) && count($selected) > 0 && in_array($post_type_name, $selected) ){
							echo '<option value="'.$post_type_name.'" selected="selected">'.$post_type_name.'</option>';
						}else{
							echo '<option value="'.$post_type_name.'">'.$post_type_name.'</option>';
						}
					}
				} 
			?>
            </select>
        </p>
        <p>Hold down Control or Command(Mac) for multiple selection</p>
        <h3>Remove authorship from some or all of your pages</h3>
		<p>Remove Authorship from all pages:&nbsp;
        	<?php
			$remove_all_pages = get_option('galink_remove_authorship_from_all_pages', 0);
			?>
        	<input type="radio" name="galink_remove_authorship_from_all_pages" id="galink_remove_authorship_from_all_pages_yes_id" value="1" <?php if($remove_all_pages == 1) echo ' checked="checked"'; ?>/> Yes&nbsp;&nbsp;
        	<input type="radio" name="galink_remove_authorship_from_all_pages" id="galink_remove_authorship_from_all_pages_no_id" value="0" <?php if($remove_all_pages == 0) echo ' checked="checked"'; ?>/> No
        </p>
        <div id="galink_remove_authorship_from_pages_select_id" style="display:<?php if($remove_all_pages == 0){ echo 'block'; }else{ echo 'none'; } ?>;">
        	<p>Select which specific pages to remove authorship code.</p>
        
            <?php 
                $all_pages_drop_down = wp_dropdown_pages( array('echo' => 0, 'name' => 'page_id') );
                $all_pages_drop_down = str_replace("<select name='page_id' id='page_id'>", '', $all_pages_drop_down);
                $all_pages_drop_down = str_replace("</select>", '', $all_pages_drop_down);
                $all_pages_drop_down_options_array = explode('</option>', $all_pages_drop_down);
                
                $all_pages_option_with_page_id = array();
                foreach($all_pages_drop_down_options_array as $page_option){
                    if( strlen($page_option) < 1 ){
                        continue;
                    }
                    $regex = '/value="([^"]*)"/';
                    $matches = array();
                    if(preg_match($regex, $page_option, $matches)){
                        $all_pages_option_with_page_id[$matches[1]] = $page_option;
                    }
                }
            ?>
            <select multiple="multiple" style="width:350px; height:200px;" name="galink_exclude_pages[]" id="galink_exclude_pages_id">
            <?php
            $selected_pages = get_option('galink_exclude_pages', '');
            if( count($all_pages_option_with_page_id) > 0 ){
                foreach( $all_pages_option_with_page_id as $key => $option ){
                    if ( $selected_pages && is_array($selected_pages) && count($selected_pages) > 0 && in_array($key, $selected_pages) ){
                        $option = str_replace('>', ' selected="selected">', $option);
                    }
                    echo $option.'</option>';
                }
            }
            ?>
            </select>
            <p>Hold down Control or Command(Mac) for multiple selection</p>
        </div>
        <p style="margin-top: 20px"><button class="button-primary" type="submit" id="wpls_admin_submit">Save Settings</button></p>
        </form>
         <hr style="border:0;border-bottom: 1px dashed #ccc;background: #999;">
        <h2>Love this plugin?</h2>
        <p>Why not donate a few dollars to help maintain it.</p><p>We have a quick donation tool that uses PayPal <a href="http://helpforwp.com/donate/" target="_blank">right here!</a></p>
        
		<h3>Documenation and tutorials</h3>
		<p>We have a <a target="_blank" href="http://helpforwp.com/tag/google-author-link/">number of blog posts</a> with some extra information on this plugin, as well visit the <a target="_blank" href="http://helpforwp.com/plugins/google-author-link/">plugin's home page here</a>.</p>
        <h3>Google Author Link Plugin Support</h3>
        <p>We provide support for all of our plugins, if you're having a problem or have a quick question, <a href="http://helpforwp.com/forum/" target="_blank">create a support request here</a></p>
    </div>
<?php
}
