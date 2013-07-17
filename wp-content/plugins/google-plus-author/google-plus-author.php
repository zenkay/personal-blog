<?php

/*
Plugin Name: WP Google Authorship
Plugin URI: http://mervin.info/google-plus-author
Description: Google Plus Profile Picture appear in Google Search. Very Easy to implement. Just 4 step Process. Including Google authorship for multiple authors and multisite
Version: 2.0
Author: Mervin Praison
Author URI: http://mervin.info
License: GPL2


  Copyright 2012  Mervin Praison  

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function google_plus_author () {
	echo google_plus_author_short();
}

function google_plus_author_short () { 
$gplus_author_name = esc_attr( get_the_author_meta( 'prefname', $user->ID ) );
$gplus_author_display = esc_attr( get_the_author_meta( 'display_name', $user->ID ) );
$gplus_author_url = esc_attr( get_the_author_meta( 'gplusauthor', $user->ID ) );
if(is_author){
$authororme = 12;
}
else {
$authororme = 23;
}
if($gplus_author_name==NULL) 
					{
						$authorizing = $gplus_author_display;
					}
					else{
						
					$authorizing = $gplus_author_name;
					
					}

				$gplusreturn = "<a href='";
				$gplusreturn .= $gplus_author_url;
				$gplusreturn .= "' rel='";
				if(is_author){ $gplusreturn .="author";}
				else {$gplusreturn .= "me";}
				$gplusreturn .= "' title='Google Plus Profile for ";
				$gplusreturn .= $authorizing; 
				$gplusreturn .="'>";					
				$gplusreturn .= $authorizing;
				$gplusreturn .= "</a>";

		return $gplusreturn;
} 

add_shortcode( 'googleplusauthor', 'google_plus_author_short' );
add_action( 'show_user_profile', 'gplus_author_profile_fields' );
add_action( 'edit_user_profile', 'gplus_author_profile_fields' );

function gplus_author_profile_fields( $user ) { 
	
	global $current_user;
	get_currentuserinfo();
	$gplus_author_name = esc_attr( get_the_author_meta( 'prefname', $current_user->ID ) );
	$gplus_author_url = esc_attr( get_the_author_meta( 'gplusauthor', $current_user->ID ) );

	?>
	<h3>Google Plus profile information</h3>

	<table class="form-table">

		<tr>
			<th><label for="gplusauthor">Google Plus Profile URL</label></th>

			<td>
				<input type="text" name="gplusauthor" id="gplusauthor" value="<?php echo esc_attr( get_the_author_meta( 'gplusauthor', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your Google Plus Profile URL. (with "https://plus.google.com/1234567890987654321")</span>
			</td>
		</tr>
		<tr>

			<th><label for="prefname">Preferred Name</label></th>
			<td>
				<input type="text" name="prefname" id="prefname" value="<?php echo esc_attr( get_the_author_meta( 'prefname', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Enter Your Preferred Name</span>
			</td>
		</tr>

	</table>
<?php }


add_action( 'personal_options_update', 'gplus_author_profile_save' );

function gplus_author_profile_save( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;

	update_usermeta( $user_id, 'gplusauthor', $_POST['gplusauthor'] );
	update_usermeta( $user_id, 'prefname', $_POST['prefname'] );
}

?>