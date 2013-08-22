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
  <h3>Plugin configuration</h3>
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
        <p style="margin-top: 20px"><button class="button-primary" type="submit" id="wpls_admin_submit">Save Settings</button></p>
        </form>
        
        <h3>Love this plugin?</h3>
        <p>Why not donate a few dollars to help maintain it.</p><p>We have a quick donation tool that uses PayPal <a href="http://helpforwp.com/donate/" target="_blank">right here!</a></p>
        
		<h3>Documenation and tutorials</h3>
		<p>We have a <a target="_blank" href="http://helpforwp.com/tag/google-author-link/">number of blog posts</a> with some extra information on this plugin, as well visit the <a target="_blank" href="http://helpforwp.com/plugins/google-author-link/">plugin's home page here</a>.</p>

        <h3>Google Author Link Plugin Support</h3>
        <p>We provide support for all of our plugins, if you're having a problem or have a quick question, <a href="http://helpforwp.com/forum/" target="_blank">create a support request here</a></p>
    </div>
<?php
} 
?>