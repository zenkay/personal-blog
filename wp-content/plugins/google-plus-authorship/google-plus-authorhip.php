<?php

/*
Plugin Name: Google Plus Authorship
Plugin URI: http://marto.lazarov.org/plugins/google-plus-authorship
Description: Google Plus Authorship enables Your profile picture to appear in Google Search Results. Very Easy to implement. Just 3 step to process
Version: 2.3
Author: Martin Lazarov
Author URI: http://marto.lazarov.org
License: GPL2
*/

function google_plus_authorship_link ($gplus_return) { 
	$gplus_author_name = esc_attr( get_the_author_meta( 'gplus_author_name', $user->ID ) );
	$gplus_author_display = esc_attr( get_the_author_meta( 'display_name', $user->ID ) );	
	$gplus_author_url = esc_attr( get_the_author_meta( 'gplus_author_url', $user->ID ) );

	/*
	if(is_author()()){
		$authororme = 12;
	}
	else {
		$authororme = 23;
	}
	
	if($gplus_author_name==NULL) {
		$author_name = $gplus_author_display;
	}
	else{
		$author_name = $gplus_author_name;
	}
	*/
	$author_name = "+";

	$gplus_return .= '<a href="'.$gplus_author_url.'" rel="'.(is_author()?"author":"me").'"';
	$gplus_return .= ' title="Google Plus Profile for '.$author_name.'" plugin="Google Plus Authorship">'.$author_name.'</a>';

	return $gplus_return;
} 

add_filter( 'get_the_author_link',	'google_plus_authorship_link',10,3 );
add_filter( 'the_author_posts_link',	'google_plus_authorship_link',10,3 );
add_action( 'show_user_profile',	'gplus_authorship_profile_fields' );
add_action( 'edit_user_profile',	'gplus_authorship_profile_fields' );

function gplus_authorship_profile_fields( $user ) {
	global $current_user;

	get_currentuserinfo();
	$gplus_author_name = esc_attr( get_the_author_meta( 'gplus_author_name', $current_user->ID ) );
	$gplus_author_url = esc_attr( get_the_author_meta( 'gplus_author_url', $current_user->ID ) );

	?>
	<h3>Google Plus profile information</h3>

	<table class="form-table">

		<tr>
			<th><label for="gplusauthor">Google Plus Profile URL</label></th>

			<td>
				<input type="text" name="gplus_author_url" id="gplus_author_url" value="<?php echo esc_attr( get_the_author_meta( 'gplus_author_url', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your Google Plus Profile URL. (with "https://plus.google.com/1234567890987654321")</span>
			</td>
		</tr>
		<!--tr>

			<th><label for="gplus_author_name">Preferred Name</label></th>
			<td>
				<input type="text" name="gplus_author_name" id="gplus_author_name" value="<?php echo esc_attr( get_the_author_meta( 'gplus_author_name', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Enter Your Preferred Name</span>
			</td>
		</tr//-->

	</table>
<?php }


add_action( 'profile_update', 'gplus_authorship_profile_save' );


function gplus_authorship_profile_save( $user_id ) {
	if ( !current_user_can( 'edit_user', $user_id ) ){
		echo "You can't edit this user";
		return false;
	}
	update_usermeta( $user_id, 'gplus_author_url', $_POST['gplus_author_url'] );
	update_usermeta( $user_id, 'gplus_author_name', $_POST['gplus_author_name'] );

}

?>
