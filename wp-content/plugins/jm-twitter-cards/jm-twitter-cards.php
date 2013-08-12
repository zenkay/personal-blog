<?php
/*
Plugin Name: JM Twitter Cards
Plugin URI: http://tweetpress.fr
Description: Meant to help users to implement and customize Twitter Cards easily
Author: Julien Maury
Author URI: http://tweetpress.fr
Version: 3.3.0
License: GPL2++
*/

/*
*    Sources: - https://dev.twitter.com/docs/cards
* 			  - http://codex.wordpress.org/Function_Reference/wp_enqueue_style
*			  - https://github.com/rilwis/meta-box [GREAT]
*			  - http://codex.wordpress.org/Function_Reference/wp_get_attachment_image_src
*/


//Add some security, no direct load !
defined( 'ABSPATH' ) or	die( 'No no, no no no no, there\'s a limit !' );

// Version number
function jm_tc_plugin_get_version() {
	if ( ! function_exists( 'get_plugins' ) )
	require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	$plugin_folder = get_plugins( '/' . plugin_basename( dirname( __FILE__ ) ) );
	$plugin_file = basename( ( __FILE__ ) );
	return $plugin_folder[$plugin_file]['Version'];
}

// Plugin activation: create default values if they don't exist
register_activation_hook( __FILE__, 'jm_tc_init' );
function jm_tc_init() {
	$opts = get_option( 'jm_tc' );
	if ( !is_array($opts) )
	update_option('jm_tc', jm_tc_get_default_options());
}


// Plugin uninstall: delete option
register_uninstall_hook( __FILE__, 'jm_tc_uninstall' );
function jm_tc_uninstall() {
	delete_option( 'jm_tc' );
}


// Remove any @ from input value
function jm_tc_remove_at($at) { 
	$noat = str_replace('@','',$at);
	return $noat;
}

// Add stuffs in init such as img size
add_action('init','jm_tc_initialize');
function jm_tc_initialize() {
	$opts = jm_tc_get_options(); 
	if ($opts['twitterCardCrop'] == 'yes') {
		$crop = true;
	} else {
		$crop = false;
	}


	if ( function_exists( 'add_theme_support' ) ) add_theme_support( 'post-thumbnails' );
	add_image_size( 'jmtc-small-thumb', 280, 150, $crop);  /* the minimum size possible for Twitter Cards */
	add_image_size( 'jmtc-max-web-thumb', 435, 375, $crop );  /* maximum web size for photo cards */
	add_image_size( 'jmtc-max-mobile-non-retina-thumb', 280, 375, $crop);  /* maximum non retina mobile size for photo cards  */
	add_image_size( 'jmtc-max-mobile-retina-thumb', 560, 750, $crop );  /* maximum retina mobile size for photo cards  */
}

// Get user choice and convert it into post thumbnail sizes
// I know there are much better ways but I want my free plugins to be easily modifiable
function jm_tc_thumbnail_sizes() {
	$opts = jm_tc_get_options(); 
	global $post;
	if( '' != ( $thumbnail_size = get_post_meta( $post->ID, 'cardImgSize', true ) ) ) $size = $thumbnail_size; else $size = $opts ['twitterCardImgSize'];
	switch ($size) {
	case 'small':
		$twitterCardImgSize = 'jmtc-small-thumb';
		
		break;
	case 'web':
		$twitterCardImgSize = 'jmtc-max-web-thumb';
		
		break;
	case 'mobile-non-retina':
		$twitterCardImgSize = 'jmtc-max-mobile-non-retina-thumb';
		
		break;
	case 'mobile-retina':
		$twitterCardImgSize = 'jmtc-max-mobile-retina-thumb';
		
		break;
	default: 
		$twitterCardImgSize = 'jmtc-small-thumb';
		?><!-- @(-_-)] --><?php
		break;
	}
	return $twitterCardImgSize;
}

// get featured image
function jm_tc_get_post_thumbnail_size() {
	global $post;
	$args = array(
	'post_type'         => 'attachment',
	'post_mime_type'    => array('image/png','image/jpeg','image/gif'),
	'numberposts'       => -1,
	'post_status'       => null,
	'post_parent'       => $post->ID
	);
	$attachments = get_posts($args);

	foreach ($attachments as $attachment) {
		$math = filesize( get_attached_file( $attachment->ID ) ) / 1000000;
		return $math;//Am I bold enough to call it a math?
	}
}

// grab our datas
$opts = jm_tc_get_options();          

if($opts['twitterCardCustom'] == 'yes') {	 
	add_action( 'add_meta_boxes', 'jm_tc_meta_box_add' );
	function jm_tc_meta_box_add()
	{
		$post_type = get_post_type();// add support for CPT
		add_meta_box( 'jm_tc-meta-box-id', 'Twitter Cards', 'jm_tc_meta_box_cb', $post_type, 'advanced', 'high' );
	}

	function jm_tc_meta_box_cb( $post )
	{
		$values = get_post_custom( $post->ID );
		$selectedType = isset( $values['twitterCardType'] ) ? esc_attr( $values['twitterCardType'][0] ) : '';
		$selectedSize = isset( $values['cardImgSize'] ) ? esc_attr( $values['cardImgSize'][0] ) : '';
		wp_nonce_field( 'jm_tc_meta_box_nonce', 'meta_box_nonce' );
		?>
		
		<!-- select card type -->
		<section style="background-color:#eee; margin:1em; padding:1em;line-height:150%;">
		<p>
		<label for="twitterCardType"><?php _e('Choose what type of card you want to use', 'jm-tc'); ?></label><br />
		<select name="twitterCardType" id="twitterCardType">
		<option value="summary" <?php selected( $selectedType, 'summary' ); ?>><?php _e('summary', 'jm-tc'); ?></option>
		<option value="summary_large_image" <?php selected( $selectedType, 'summary_large_image' ); ?>><?php _e('summary_large_image', 'jm-tc'); ?></option>
		<option value="photo" <?php selected( $selectedType, 'photo' ); ?>><?php _e('photo', 'jm-tc'); ?></option>
		<option value="product" <?php selected( $selectedType, 'product' ); ?>><?php _e('product', 'jm-tc'); ?></option>
		</select>
		</p>
		</section>
		
		
		<!-- set img from another source -->
		<section style="background-color:#eee; margin:1em; padding:1em;line-height:150%;">
		<p>
		<label for="twitterCardImage"><?php _e('Set another source as twitter image (enter URL)', 'jm-tc'); ?> :</label><br />
		<input id="twitterCardImage" type="url" name="cardImage" style="padding:.3em;" size="120" class="regular-text" value="<?php echo get_post_meta($post->ID,'cardImage',true); ?>" />
		</p>
		<p class="description"><?php _e('(This is optional but some users wanted alternatives for featured image.)', 'jm-tc'); ?></p>
		</section>
		
		<!-- set img dimensions -->
		<section style="background-color:#eee; margin:1em; padding:1em;line-height:150%;">
		<label for="cardImgSize"><?php _e('Set featured image dimensions', 'jm-tc'); ?> :</label><br />
		<select id="cardImgSize" name="cardImgSize">
		<option value="mobile-non-retina" <?php selected( $selectedSize, 'mobile-non-retina' ); ?>><?php _e('Max mobile non retina (width: 280px - height: 375px)', 'jm-tc'); ?></option>
		<option value="mobile-retina" <?php selected( $selectedSize, 'mobile-retina' ); ?>><?php _e('Max mobile retina (width: 560px - height: 750px)', 'jm-tc'); ?></option>
		<option value="web" <?php selected( $selectedSize, 'web' ); ?>><?php _e('Max web size(width: 435px - height: 375px)', 'jm-tc'); ?></option>
		<option value="small" <?php selected( $selectedSize, 'small' ); ?>><?php _e('Small (width: 280px - height: 150px)', 'jm-tc'); ?></option>
		</select>
		<br /><em><?php _e('Be careful with Retina displays, image must be tall enough. <br />Also make sure your image is not heavier than 1 MB if used for summary large cards','jm-tc');?></em>
		<?php 
		$color = "black";
		if( function_exists('jm_tc_get_post_thumbnail_size') && jm_tc_get_post_thumbnail_size() >= 1 ) 
		$color = "red"; //again it is just to make sure everybody understand what I'm doing
		?>
		<br /><em> <?php if( function_exists('jm_tc_get_post_thumbnail_size') && jm_tc_get_post_thumbnail_size() != 0 ) echo __('Current featured image size is : ','jm-tc').'<strong style="color:'.$color.';">'. jm_tc_get_post_thumbnail_size();?><?php _e(' MB','jm-tc'). '</strong>';?></em>
		</section>
		
		<!-- ~conditional fields (maybe some AJAX could be added but is it really worth?) -->
		<?php switch ($selectedType) {
		case 'photo': ?>
			<section style="background-color:#eee; margin:1em; padding:1em;line-height:150%;">
			<p><label for="twitterImageWidth"><?php _e('Image width', 'jm-tc'); ?> :</label>
			<input id="twitterImageWidth" type="number" min="280" name="cardPhotoWidth" class="small-number" value="<?php echo get_post_meta($post->ID,'cardPhotoWidth',true); ?>" />
			</p>
			<p>
			<label for="twitterImageHeight"><?php _e('Image height', 'jm-tc'); ?> :</label>
			<input id="twitterImageHeight" type="number" min="150" name="cardPhotoHeight" class="small-number" value="<?php echo get_post_meta($post->ID,'cardPhotoHeight',true); ?>" />
			</p>
			</section>
			<?php
			break;
		case 'product' :?>
			<section style="background-color:#eee; margin:1em; padding:1em;line-height:150%;">
			<p>
			<label for="cardData1"><?php _e('Enter the first key data for product', 'jm-tc'); ?> :</label>
			<input id="cardData1" type="text" name="cardData1" style="padding:.3em;" class="regular-text" value="<?php echo get_post_meta($post->ID,'cardData1',true); ?>" />
			</p>
			<p>
			<label for="cardLabel1"><?php _e('Enter the first key label for product', 'jm-tc'); ?> :</label>
			<input id="cardLabel1" type="text" name="cardLabel1" style="padding:.3em;" class="regular-text" value="<?php echo get_post_meta($post->ID,'cardLabel1',true); ?>" />
			</p>
			<p>
			<label for="cardData2"><?php _e('Enter the second key data for product', 'jm-tc'); ?> :</label>
			<input id="cardData2" type="text" name="cardData2" style="padding:.3em;" class="regular-text" value="<?php echo get_post_meta($post->ID,'cardData2',true); ?>" />
			</p>
			<p>
			<label for="cardLabel2"><?php _e('Enter the second key label for product', 'jm-tc'); ?> :</label>
			<input id="cardLabel2" type="text" name="cardLabel2" style="padding:.3em;" class="regular-text" value="<?php echo get_post_meta($post->ID,'cardLabel2',true); ?>" />
			</p>
			<p><label for="twitterImageWidth"><?php _e('Image width', 'jm-tc'); ?> :</label>
			<input id="twitterImageWidth" type="number" min="280" name="cardPhotoWidth" class="small-number" value="<?php echo get_post_meta($post->ID,'cardPhotoWidth',true); ?>" />
			</p>
			<p>
			<label for="twitterImageHeight"><?php _e('Image height', 'jm-tc'); ?> :</label>
			<input id="twitterImageHeight" type="number" min="150" name="cardPhotoHeight" class="small-number" value="<?php echo get_post_meta($post->ID,'cardPhotoHeight',true); ?>" />
			</p>
			<p class="description"><?php _e('Here you can set 2 key details for your product (e.g price, size, etc)', 'jm-tc'); ?></p>
			</section>
			<?php 
			break;
		default: ?>
			<!-- @(-_-)] -->
			<?php
			break;
		} ?>
		
		<?php	
	}

	add_action( 'save_post', 'jm_tc_meta_box_save' );
	function jm_tc_meta_box_save( $post_id )
	{
		// Bail if we're doing an auto save
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

		// if our nonce isn't there, or we can't verify it, bail
		if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'jm_tc_meta_box_nonce' ) ) return;

		// if our current user can't edit this post, bail
		if( !current_user_can( 'edit_post' ) ) return;

		// Probably a good idea to make sure your data is set		
		if( isset( $_POST['twitterCardType'] ) )
		update_post_meta( $post_id, 'twitterCardType', $_POST['twitterCardType'] );
		
		if( isset( $_POST['cardImage'] ) )
		update_post_meta( $post_id, 'cardImage', esc_url($_POST['cardImage']) );
		
		if( isset($_POST['cardPhotoWidth'],$_POST['cardPhotoHeight']))
		update_post_meta( $post_id, 'cardPhotoWidth', esc_attr( $_POST['cardPhotoWidth'] ) );
		update_post_meta( $post_id, 'cardPhotoHeight', esc_attr( $_POST['cardPhotoHeight'] ) );
		
		if( isset($_POST['cardData1'],$_POST['cardLabel1'],$_POST['cardData2'],$_POST['cardLabel2']))
		update_post_meta( $post_id, 'cardData1', esc_attr( $_POST['cardData1'] ) );
		update_post_meta( $post_id, 'cardLabel1', esc_attr( $_POST['cardLabel1'] ) );
		update_post_meta( $post_id, 'cardData2', esc_attr( $_POST['cardData2'] ) );
		update_post_meta( $post_id, 'cardLabel2', esc_attr( $_POST['cardLabel2'] ) );
		
		if( isset($_POST['cardImgSize']))
		update_post_meta( $post_id, 'cardImgSize', $_POST['cardImgSize'] );
	}

} 

//add twitter infos
$opts = jm_tc_get_options(); 
if($opts['twitterProfile'] == 'yes') {
	add_action( 'show_user_profile', 'jm_tc_add_field_user_profile' );
	add_action( 'edit_user_profile', 'jm_tc_add_field_user_profile' );

	function jm_tc_add_field_user_profile( $user ) {
		wp_nonce_field( 'jm_tc_twitter_field_update', 'jm_tc_twitter_field_update', false );
		?>
		<h3><?php _e("Twitter Card Creator","jm-tc");?></h3>	
		<table class="form-table">
		<tr>
		<th><label for="jm_tc_twitter"><?php _e("Twitter Account", "jm_tc"); ?></label></th>
		<td>
		<input type="text" name="jm_tc_twitter" id="jm_tc_twitter" value="<?php echo esc_attr( get_the_author_meta( 'jm_tc_twitter', $user->ID ) ); ?>" class="regular-text" /><br />
		<span class="description"><?php _e("Enter your Twitter Account (without @)", "jm-tc"); ?></span>
		</td>
		</tr>
		</table>
		<?php
	}
}

// save value for extra field in user profile
add_action( 'personal_options_update', 'jm_tc_save_extra_user_profile_field', 10,1 );
add_action( 'edit_user_profile_update', 'jm_tc_save_extra_user_profile_field',10,1 );

function jm_tc_save_extra_user_profile_field( $user_id ) {
	if( !current_user_can( 'edit_user', $user_id ) || ! isset( $_POST['jm_tc_twitter_field_update'] ) || ! wp_verify_nonce( $_POST['jm_tc_twitter_field_update'], 'jm_tc_twitter_field_update' ) ) { return false; }
	$tc_twitter = wp_filter_nohtml_kses($_POST['jm_tc_twitter']);
	update_user_meta( $user_id, 'jm_tc_twitter', $tc_twitter );
}

// apply a filter on input to delete any @ 
add_filter('user_profile_update_errors','jm_tc_check_at', 10, 3); // wp-admin/includes/users.php, thanks Greglone for this great hint
function jm_tc_check_at($errors, $update, $user)  {
	if($update) {  
		//let's save it but in case there's a @ just remove it before saving
		update_user_meta($user->ID, 'jm_tc_twitter', jm_tc_remove_at($_POST['jm_tc_twitter']) );
	}
}



//grab excerpt
if(!function_exists( 'get_excerpt_by_id' )) {

	function get_excerpt_by_id($post_id){
		$the_post = get_post($post_id); 
		$the_excerpt = $the_post->post_content; //Gets post_content to be used as a basis for the excerpt

		//SET LENGTH
		$excerpt_length = jm_tc_get_options();
		$excerpt_length = $excerpt_length['twitterExcerptLength'];


		$the_excerpt = strip_tags(strip_shortcodes($the_excerpt)); //Strips tags and images
		$words = explode(' ', $the_excerpt, $excerpt_length + 1);
		if(count($words) > $excerpt_length) :
		array_pop($words);
		array_push($words, '…');
		$the_excerpt = implode(' ', $words);
		endif;
		return esc_attr($the_excerpt);// to prevent meta from being broken by ""
	}
}


// function to add markup in head section of post types
if(!function_exists( 'add_twitter_card_info' )) {

	function add_twitter_card_info() {
		global $post;	
		/* get options */          		
		$opts = jm_tc_get_options(); 	
		if ( is_front_page()||is_home()) {
			echo "\n".'<!-- JM Twitter Cards by Julien Maury '.jm_tc_plugin_get_version().' -->'."\n";  	                   					
			echo '<meta name="twitter:card" content="'. $opts['twitterCardType'] .'">'."\n"; 
			echo '<meta name="twitter:creator" content="@'. $opts['twitterCreator'] .'">'."\n";
			echo '<meta name="twitter:site" content="@'. $opts['twitterSite'] .'">'."\n";								
			echo '<meta name="twitter:title" content="' .$opts['twitterPostPageTitle'] . '"/>'."\n";     
			echo '<meta name="twitter:description" content="' . $opts['twitterPostPageDesc'] . '">'."\n"; 
			echo '<meta name="twitter:image" content="' . $opts['twitterImage'] . '">'."\n";                   
			echo '<!-- /JM Twitter Cards -->'."\n\n"; 
		} 

		elseif( is_singular() && !is_front_page() && !is_home() && !is_404() && !is_tag()) {
			echo "\n".'<!-- JM Twitter Cards by Julien Maury '.jm_tc_plugin_get_version().' -->'."\n";  

			// get current post meta data
			$creator           = get_the_author_meta('jm_tc_twitter', $post->post_author);		
			$cardType          = get_post_meta($post->ID, 'twitterCardType', true);
			$cardPhotoWidth    = get_post_meta($post->ID,'cardPhotoWidth',true);
			$cardPhotoHeight   = get_post_meta($post->ID,'cardPhotoHeight',true);
			$cardImage         = get_post_meta($post->ID,'cardImage',true);
			$cardData1         = get_post_meta($post->ID,'cardData1',true);
			$cardLabel1        = get_post_meta($post->ID,'cardLabel1',true);
			$cardData2         = get_post_meta($post->ID,'cardData2',true);
			$cardLabel2        = get_post_meta($post->ID,'cardLabel2',true);
			$cardImgSize       = get_post_meta($post->ID,'cardImgSize',true);
			$cardTitleKey = $opts['twitterCardTitle'];
			$cardDescKey = $opts['twitterCardDesc'];
			
			/* custom fields */
			$tctitle  = get_post_meta($post->ID,$cardTitleKey,true);
			$tcdesc   = get_post_meta($post->ID,$cardDescKey,true);
			
			
			// support for custom meta description WordPress SEO by Yoast or All in One SEO
			if (class_exists('WPSEO_Frontend') ) { // little trick to check if plugin is here and active :)
				$object = new WPSEO_Frontend();
				if($opts['twitterCardSEOTitle'] == 'yes' && $object->title( false ) )  { $cardTitle = $object->title( false );} else { $cardTitle = the_title_attribute( array('echo' => false) );}
				if($opts['twitterCardSEODesc'] == 'yes' && $object->metadesc( false ) ) { $cardDescription = $object->metadesc( false ); } else { $cardDescription = get_excerpt_by_id($post->ID);}
			} elseif (class_exists('All_in_One_SEO_Pack')) {
				global $post;
				$post_id = $post;
				if (is_object($post_id)) $post_id = $post_id->ID;
				if($opts['twitterCardSEOTitle'] == 'yes' && get_post_meta(get_the_ID(), '_aioseop_title', true) ) { $cardTitle  = htmlspecialchars(stripcslashes(get_post_meta($post_id, '_aioseop_title', true))); } else { $cardTitle = the_title_attribute( array('echo' => false) );}
				if($opts['twitterCardSEODesc'] == 'yes' && get_post_meta(get_the_ID(), '_aioseop_description', true)) { $cardDescription = htmlspecialchars(stripcslashes(get_post_meta($post_id, '_aioseop_description', true))); } else { $cardDescription = get_excerpt_by_id($post->ID); }
			} elseif ( $tctitle && $tcdesc && $cardTitleKey != '' && $cardDescKey != '' ) { 
				// avoid array to string notice on title and desc
				$cardTitle = $tctitle;
				$cardDescription = $tcdesc;			
			} else { //default (I'll probably make a switch next time)
				$cardTitle = the_title_attribute( array('echo' => false) );
				$cardDescription = get_excerpt_by_id($post->ID);
			}
			
			if(($opts['twitterCardCustom'] == 'yes') && !empty($cardType)) {

				echo '<meta name="twitter:card" content="'. $cardType .'">'."\n";
			} else {
				echo '<meta name="twitter:card" content="'. $opts['twitterCardType'] .'">'."\n"; 
			}
			if(!empty($creator)) { // this part has to be optional, this is more for guest bltwitterging but it's no reason to bother everybody.
				echo '<meta name="twitter:creator" content="@'. $creator .'">'."\n";												
			} else {
				echo '<meta name="twitter:creator" content="@'. $opts['twitterCreator'] .'">'."\n";
			}
			// these next 4 parameters should not be editable in post admin 
			echo '<meta name="twitter:site" content="@'. $opts['twitterSite'] .'">'."\n";												  
			echo '<meta name="twitter:title" content="' . $cardTitle  . '">'."\n";  // filter used by plugin to customize title  
			echo '<meta name="twitter:description" content="' . $cardDescription . '">'."\n"; 

			if( has_post_thumbnail() ) {
				if(  $cardImage != '' ) { // cardImage is set
					echo '<meta name="twitter:image" content="' . $cardImage . '">'."\n";
				} else {
					$image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), jm_tc_thumbnail_sizes() );
					echo '<meta name="twitter:image" content="' . $image_attributes[0] . '">'."\n";
				} 
			} elseif( !has_post_thumbnail() &&  $cardImage != '') {
				echo '<meta name="twitter:image" content="' . $cardImage . '">'."\n";
			} else { //fallback
				echo '<meta name="twitter:image" content="' . $opts['twitterImage'] . '">'."\n";
			}
			
			if($cardType  == 'photo' || $cardType == 'product') {
				if(!empty($cardPhotoWidth) && !empty($cardPhotoHeight)) {
					echo '<meta name="twitter:image:width" content="'.$cardPhotoWidth.'">'."\n";
					echo '<meta name="twitter:image:height" content="'.$cardPhotoHeight.'">'."\n";
				} else {
					echo '<meta name="twitter:image:width" content="'.$opts['twitterImageWidth'].'">'."\n";
					echo '<meta name="twitter:image:height" content="'.$opts['twitterImageHeight'].'">'."\n";
				}	
			} 
			if($cardType == 'product') {
				if(!empty($cardData1) && !empty($cardLabel1) && !empty($cardData2) && !empty($cardLabel2)) {
					echo '<meta name="twitter:data1" content="'.$cardData1.'">'."\n";
					echo '<meta name="twitter:label1" content="'.strtoupper($cardLabel1).'">'."\n";
					echo '<meta name="twitter:data2" content="'.$cardData2.'">'."\n";
					echo '<meta name="twitter:label2" content="'.strtoupper($cardLabel2).'">'."\n";
				} else {
					echo '<meta name="twitter:data1" content="'.$opts['twitterData1'].'">'."\n";
					echo '<meta name="twitter:label1" content="'.strtoupper($opts['twitterLabel1']).'">'."\n";
					echo '<meta name="twitter:data2" content="'.$opts['twitterData2'].'">'."\n";
					echo '<meta name="twitter:label2" content="'.strtoupper($opts['twitterLabel2']).'">'."\n";
				}		
			}
			echo '<!-- /JM Twitter Cards -->'."\n\n"; 
		}      

	}
	add_action( 'wp_head', 'add_twitter_card_info', 99);// it's actually better to load twitter card meta at the very end (SEO desc is more important)
}

/*
* ADMIN OPTION PAGE
*/

// Language support
add_action( 'admin_init', 'jm_tc_lang_init' );
function jm_tc_lang_init() {
	load_plugin_textdomain( 'jm-tc', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );
}

// Add a "Settings" link in the plugins list
add_filter( 'plugin_action_links_'.plugin_basename(__FILE__), 'jm_tc_settings_action_links', 10, 2 );
function jm_tc_settings_action_links( $links, $file ) {
	$settings_link = '<a href="' . admin_url( 'options-general.php?page=jm_tc_options' ) . '">' . __("Settings") . '</a>';
	array_unshift( $links, $settings_link );

	return $links;
}


//The add_action to add onto the WordPress menu.
add_action('admin_menu', 'jm_tc_add_options');
function jm_tc_add_options() {
	$page = add_submenu_page( 'options-general.php', 'JM Twitter Cards Options', 'JM Twitter Cards', 'manage_options', 'jm_tc_options', 'jm_tc_options_page' );
	register_setting( 'jm-tc', 'jm_tc', 'jm_tc_sanitize' );
	add_action( 'admin_print_styles-' . $page, 'jm_tc_admin_css' );//add styles for our options page the WordPress way
	add_action( 'admin_head-' . $page, 'jm_tc_screen_icon' );//add icon for our options page the WordPress way
}

// Add screen icon
function jm_tc_screen_icon() {
	?>
	<style type="text/css">
	#icon-jm-tc {
background: url(<?php echo plugins_url('admin/bird_gray_32.png', __FILE__); ?>) no-repeat 50% 50%;
	}
	</style>
	<?php
}

// Add styles the WordPress Way >> http://codex.wordpress.org/Function_Reference/wp_enqueue_style#Load_stylesheet_only_on_a_plugin.27s_options_page
function jm_tc_admin_css() {  
	wp_enqueue_style( 'jm-style-tc', plugins_url('admin/jm-tc-admin-style.css', __FILE__)); 
} 


// Add dismissible notice	
add_action('admin_notices', 'jm_tc_admin_notice');
if(!function_exists( 'jm_tc_admin_notice' )) {
	function jm_tc_admin_notice() {
		global $current_user ;
		$user_id = $current_user->ID;
		if ( ! get_user_meta($user_id, 'jm_tc_ignore_notice') && current_user_can( 'install_plugins' ) && class_exists('WPSEO_Frontend') ) {
			echo '<div class="error"><p>';
			printf(__('WordPress SEO by Yoast is activated, please uncheck Twitter Card option in this plugin if it is enabled to avoid adding markup twice | <a href="%1$s">Hide Notice</a>'), '?jm_tc_ignore_this=0','jm-tc');
			echo "</p></div>";
		}
	}
}
add_action('admin_init', 'jm_tc_ignore_this');
if(!function_exists( 'jm_tc_ignore_this' )) {
	function jm_tc_ignore_this() {
		global $current_user;
		$user_id = $current_user->ID;
		/* If user clicks to ignore the notice, add that to their user meta */
		if ( isset($_GET['jm_tc_ignore_this']) && '0' == $_GET['jm_tc_ignore_this'] ) {
			add_user_meta($user_id, 'jm_tc_ignore_notice', 'true', true);
		}
	}
}


// Settings page
function jm_tc_options_page() {
	$opts = jm_tc_get_options();
	?>
	<div class="jm-tc">
	<span id="icon-jm-tc" class="icon32 inbl"></span>
	<h1 class="inbl"><?php _e('JM Twitter Cards Options', 'jm-tc'); ?></h1>
	<h2 class="nav-tab-wrapper">
	<a href="#tab1" class="nav-tab nav-tab-active"><?php _e('General','jm-tc');?></a>
	<a href="#tab2" class="nav-tab"><?php _e('SEO','jm-tc');?></a>
	<a href="#tab6" class="nav-tab"><?php _e('Product Cards','jm-tc');?></a>
	<a href="#tab3" class="nav-tab"><?php _e('Thumbnails','jm-tc');?></a>
	<a href="#tab4" class="nav-tab"><?php _e('Meta Box','jm-tc');?></a>
	<a href="#tab5" class="nav-tab"><?php _e('Home','jm-tc');?></a>
	<a href="#tab7" class="nav-tab"><?php _e('About','jm-tc');?></a>

	</h2>

	<p><?php _e('This plugin allows you to get Twitter photo, summary, summary large and product cards for your blog. You can even go further in your Twitter Cards experience.', 'jm-tc'); ?></p>
	<div class="fieldset-like">
	<h3><span><?php _e('Documentation', 'jm-tc'); ?></span></h3>
	<p><strong><?php _e('Before anything read the documentation (en)', 'jm-tc'); ?></strong> </p>
	<a class="button button-secondary" target="_blank" href="<?php echo plugins_url('documentation.html',__FILE__);?>"><?php _e('See  Documentation','jm-tc');?></a>
	</div>
	
	<form id="jm-tc-form" method="post" action="options.php">

	<?php settings_fields('jm-tc'); ?>


	<fieldset>  
	<legend id="tab1"><?php _e('General', 'jm-tc'); ?></legend>
	<p>
	<label for="twitterCardType"><?php _e('Choose what type of card you want to use', 'jm-tc'); ?> :</label>
	<select id="twitterCardType" name="jm_tc[twitterCardType]">
	<option value="summary" <?php echo $opts['twitterCardType'] == 'summary' ? 'selected="selected"' : ''; ?> ><?php _e('summary', 'jm-tc'); ?></option>
	<option value="summary_large_image" <?php echo $opts['twitterCardType'] == 'summary_large_image' ? 'selected="selected"' : ''; ?> ><?php _e('summary_large_image', 'jm-tc'); ?></option>
	<option value="photo" <?php echo $opts['twitterCardType'] == 'photo' ? 'selected="selected"' : ''; ?> ><?php _e('photo', 'jm-tc'); ?></option>
	</select>
	</p>
	<p>
	<label for="twitterCreator"><?php _e('Enter your Personal Twitter account', 'jm-tc'); ?> :</label>
	<input id="twitterCreator" type="text" name="jm_tc[twitterCreator]" class="regular-text" value="<?php echo jm_tc_remove_at($opts['twitterCreator']); ?>" />
	</p>
	<p>
	<label for="twitterSite"><?php _e('Enter Twitter account for your Website', 'jm-tc'); ?> :</label>
	<input id="twitterSite" type="text" name="jm_tc[twitterSite]" class="regular-text" value="<?php echo jm_tc_remove_at($opts['twitterSite']); ?>" />
	</p>
	<p>
	<label for="twitterExcerptLength"><?php _e('Set description according to excerpt length (words count)', 'jm-tc'); ?> :</label>
	<input id="twitterExcerptLength" type="number" min="10" max="200" name="jm_tc[twitterExcerptLength]" class="small-number" value="<?php echo $opts['twitterExcerptLength']; ?>" />
	</p>
	<p>
	<label for="twitterProfile"><?php _e('Add a field Twitter to profiles', 'jm-tc'); ?> :</label>
	<select id="twitterProfile" name="jm_tc[twitterProfile]">
	<option value="yes" <?php echo $opts['twitterProfile'] == 'yes' ? 'selected="selected"' : ''; ?> ><?php _e('yes', 'jm-tc'); ?></option>
	<option value="no" <?php echo $opts['twitterProfile'] == 'no' ? 'selected="selected"' : ''; ?> ><?php _e('no', 'jm-tc'); ?></option>
	</select>
	<br />(<em><?php _e('In 1.1.8 creator has been removed from metabox. Now it will grab this directly from profiles. This should be more comfortable for guest bltwitterging. If you do not have any Twitter option like that on profiles, just activate it here :','jm-tc'); ?>
	</em>)
	</p>
	<?php submit_button(null, 'primary', '_submit'); ?>
	</fieldset>
	
	<fieldset>   
	<legend id="tab2"><?php _e('SEO', 'jm-tc'); ?></legend>  
	<p>
	<label for="twitterCardSEOTitle"><?php _e('Use SEO by Yoast or All in ONE SEO meta title for your cards (<strong>default is yes</strong>)', 'jm-tc'); ?> :</label>
	<select id="twitterCardSEOTitle" name="jm_tc[twitterCardSEOTitle]">
	<option value="yes" <?php echo $opts['twitterCardSEOTitle'] == 'yes' ? 'selected="selected"' : ''; ?> ><?php _e('yes', 'jm-tc'); ?></option>
	<option value="no" <?php echo $opts['twitterCardSEOTitle'] == 'no' ? 'selected="selected"' : ''; ?> ><?php _e('no', 'jm-tc'); ?></option>
	</select></p> 
	<p>
	<label for="twitterCardSEODesc"><?php _e('Use SEO by Yoast or All in ONE SEO meta description for your cards (<strong>default is yes</strong>)', 'jm-tc'); ?> :</label>
	<select id="twitterCardSEODesc" name="jm_tc[twitterCardSEODesc]">
	<option value="yes" <?php echo $opts['twitterCardSEODesc'] == 'yes' ? 'selected="selected"' : ''; ?> ><?php _e('yes', 'jm-tc'); ?></option>
	<option value="no" <?php echo $opts['twitterCardSEODesc'] == 'no' ? 'selected="selected"' : ''; ?> ><?php _e('no', 'jm-tc'); ?></option>
	</select></p> 
	
	
	<strong><?php _e('In case you do not use SEO plugins such as WP SEO or All in One SEO and want to use values from custom fields you have already created instead','jm-tc');?>
	</strong><br />
	<p>
	<label for="twitterCardTitle"><?php _e('Enter key for card title', 'jm-tc'); ?> :</label>
	<input id="twitterCardTitle" type="text" name="jm_tc[twitterCardTitle]" class="regular-text" value="<?php echo $opts['twitterCardTitle']; ?>" />
	</p>
	<p>
	<label for="twitterCardDesc"><?php _e('Enter key for card description', 'jm-tc'); ?> :</label>
	<input id="twitterCardDesc" type="text" name="jm_tc[twitterCardDesc]" class="regular-text" value="<?php echo $opts['twitterCardDesc']; ?>" />
	</p>
	<br />
	(<em><?php _e('This allows you to grab datas from custom fields you have created.', 'jm-tc'); ?></em>)
	
	
	<?php submit_button(null, 'primary', '_submit2'); ?>	
	</fieldset> 
	
	
	
	<fieldset>
	<legend id="tab3"><?php _e('Thumbnails', 'jm-tc'); ?></legend>			              
	<?php _e("I have been told on support that plugin should provide a better control of image size for cards. Here we are, use this section to define size for you cards and it will apply to all your post thumbnails. You can override this on each post.", 'jm-tc'); ?>
	<p>
	<label for="twitterCardImgSize"><?php _e('Choose what type of card you want to use', 'jm-tc'); ?> :</label>
	<select id="twitterCardImgSize" name="jm_tc[twitterCardImgSize]">
	<option value="mobile-non-retina" <?php echo $opts['twitterCardImgSize'] == 'mobile-non-retina' ? 'selected="selected"' : ''; ?> ><?php _e('Max mobile non retina (width: 280px - height: 375px)', 'jm-tc'); ?></option>
	<option value="mobile-retina" <?php echo $opts['twitterCardImgSize'] == 'mobile-retina' ? 'selected="selected"' : ''; ?> ><?php _e('Max mobile retina (width: 560px - height: 750px)', 'jm-tc'); ?></option>
	<option value="web" <?php echo $opts['twitterCardImgSize'] == 'web' ? 'selected="selected"' : ''; ?> ><?php _e('Max web size(width: 435px - height: 375px)', 'jm-tc'); ?></option>
	<option value="small" <?php echo $opts['twitterCardImgSize'] == 'small' ? 'selected="selected"' : ''; ?> ><?php _e('Small (width: 280px - height: 150px)', 'jm-tc'); ?></option>
	</select>
	</p>
	<p>
	<label for="twitterCardCrop"><?php _e('Do you want to force crop on card Image?', 'jm-tc'); ?> :</label>
	<select id="twitterCardCrop" name="jm_tc[twitterCardCrop]">
	<option value="yes" <?php echo $opts['twitterCardCrop'] == 'yes' ? 'selected="selected"' : ''; ?> ><?php _e('Yes', 'jm-tc'); ?></option>
	<option value="no" <?php echo $opts['twitterCardCrop'] == 'no' ? 'selected="selected"' : ''; ?> ><?php _e('No', 'jm-tc'); ?></option>	
	</select>
	</p>
	
	<p>
	<label for="twitterImage"><?php _e('Enter URL for fallback image (image by default)', 'jm-tc'); ?> :</label>
	<input id="twitterImage" type="url" name="jm_tc[twitterImage]" class="regular-text" value="<?php echo $opts['twitterImage']; ?>" />
	</p>
	
	<p>
	(<em><?php _e('This settings regards only photo and product cards', 'jm-tc'); ?></em>)
	
	<label for="twitterImageWidth"><?php _e('Image width', 'jm-tc'); ?> :</label>
	<input id="twitterImageWidth" type="number" min="280" name="jm_tc[twitterImageWidth]" class="small-number" value="<?php echo $opts['twitterImageWidth']; ?>" />
	</p>
	<p>
	<label for="twitterImageHeight"><?php _e('Image height', 'jm-tc'); ?> :</label>
	<input id="twitterImageHeight" type="number" min="150" name="jm_tc[twitterImageHeight]" class="small-number" value="<?php echo $opts['twitterImageHeight']; ?>" />
	</p>
	<?php submit_button(null, 'primary', '_submit3a'); ?>	
	</fieldset>	
	
	<fieldset>  
	<legend id="tab4"><?php _e('Meta Box', 'jm-tc'); ?></legend>
	<p>
	<?php _e('If you activate this option, you can custom every single post (page or post or even attachment). You are able to choose creator and card type for each post.', 'jm-tc'); ?>
	</p>
	<p>
	<label for="twitterCardCustom"><?php _e('Get a <strong>custom metabox</strong> on each post type admin', 'jm-tc'); ?> :</label>
	<select id="twitterCardCustom" name="jm_tc[twitterCardCustom]">
	<option value="yes" <?php echo $opts['twitterCardCustom'] == 'yes' ? 'selected="selected"' : ''; ?> ><?php _e('yes', 'jm-tc'); ?></option>
	<option value="no" <?php echo $opts['twitterCardCustom'] == 'no' ? 'selected="selected"' : ''; ?> ><?php _e('no', 'jm-tc'); ?></option>
	</select>
	<br />
	(<em><?php _e('If enabled, a custom metabox will appear (admin panel) in your edit', 'jm-tc'); ?></em>)
	</p>
	
	<?php submit_button(null, 'primary', '_submit4'); ?>	
	</fieldset>  
	
	<fieldset>   
	<legend id="tab5">Home - <?php _e('Posts page', 'jm-tc'); ?></legend>  
	<p>
	<?php _e('In case you use home page as post page, this part will allow you to specify some parameters. Otherwise it would not work for this specific page. I know this is not ideal but until I find a better solution it fixes bug!','jm-tc'); ?>
	</p> 

	<p>
	<label for="twitterPostPageTitle"><strong><?php _e('Enter title for Posts Page :', 'jm-tc'); ?> </strong>:</label><br />
	<input id="twitterPostPageTitle" type="text" name="jm_tc[twitterPostPageTitle]" class="regular-text" value="<?php echo $opts['twitterPostPageTitle']; ?>" />
	</p>
	<p>
	<label for="twitterPostPageDesc"><strong><?php _e('Enter description for Posts Page (max: 70 words)', 'jm-tc'); ?> </strong>:</label><br />
	<textarea id="twitterPostPageDesc" rows="4" cols="80" name="jm_tc[twitterPostPageDesc]" class="regular-text"><?php echo $opts['twitterPostPageDesc']; ?></textarea>
	</p>

	<?php submit_button(null, 'primary', '_submit5'); ?>	
	</fieldset> 
	
	<fieldset>  
	<legend id="tab6"><?php _e('Product Cards', 'jm-tc') ?></legend>
	
	<p><?php _e('This is where you set fallback for product cards. You will find fields in metabox.','jm-tc');?><br />
	</p>
	<p><label for="twitterData1"><?php _e('Enter the first key data for product', 'jm-tc'); ?> :</label>
	<input id="twitterData1" type="text" name="jm_tc[twitterData1]" class="regular-text" value="<?php echo $opts['twitterData1']; ?>" />
	</p>
	<p>
	<label for="twitterLabel1"><?php _e('Enter the first key label for product', 'jm-tc'); ?> :</label>
	<input id="twitterLabel1" type="text" name="jm_tc[twitterLabel1]" class="regular-text" value="<?php echo $opts['twitterLabel1']; ?>" />
	</p>
	<p>
	<label for="twitterData2"><?php _e('Enter the second key data for product', 'jm-tc'); ?> :</label>
	<input id="twitterData2" type="text" name="jm_tc[twitterData2]" class="regular-text" value="<?php echo $opts['twitterData2']; ?>" />
	</p>
	<p>
	<label for="twitterLabel2"><?php _e('Enter the second key label for product', 'jm-tc'); ?> :</label>
	<input id="twitterLabel2" type="text" name="jm_tc[twitterLabel2]" class="regular-text" value="<?php echo $opts['twitterLabel2']; ?>" />
	</p>
	<br />
	(<em><?php _e('This is just a fallback, you will have to customize these details per each product!', 'jm-tc'); ?></em>)
	
	<?php submit_button(null, 'primary', '_submit6'); ?>
	</fieldset>
	
	</form>
	
	<div id="tab7" class="postbox medium">
	<h3 class="hndle"><span><?php _e('About the developer','jm-tc');?></span></h3>
	<div class="inside">
	<p><img src="http://www.gravatar.com/avatar/<?php echo md5( 'tweetpressfr'.'@'.'gmail'.'.'.'com' ); ?>" style="float:left;margin-right:10px;"/>
	<strong>Julien Maury</strong><br />
	<?php _e('I am a WordPress Developer, I like to make it simple.', 'jm-tc') ?> <br />
	<a href="http://www.tweetpress.fr" target="_blank" title="TweetPress.fr - WordPress and Twitter tips">www.tweetpress.fr</a> <br />
	<a href="http://profiles.wordpress.org/jmlapam/" title="on WordPress.org"><?php _e('My WordPress Profile', 'jm-tc') ?></a><br /><br />
	<a href="http://twitter.com/intent/user?screen_name=tweetpressfr" >@TweetPressFR</a>
	</p>
	</div>
	</div>

	<div class="postbox medium">
	<h3 class="hndle"><span><?php _e('Help me keep this free', 'jm-tc'); ?></span></h3>
	<div class="inside">
	<p><?php _e('Please help me keep this plugin free.', 'jm-tc'); ?></p>
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
	<input type="hidden" name="cmd" value="_s-xclick">
	<input type="hidden" name="hosted_button_id" value="2NBS57W3XG62L">
	<input type="image" src="https://www.paypalobjects.com/fr_FR/FR/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - la solution de paiement en ligne la plus simple et la plus sécurisée !">
	<img alt="" border="0" src="https://www.paypalobjects.com/fr_FR/i/scr/pixel.gif" width="1" height="1">
	</form>
	</div>
	</div>
	
	<div class="postbox large">
	<h3 class="hndle"><span><?php _e('Plugin - Doc', 'jm-tc'); ?></span></h3>
	<div class="inside">
	<p><?php _e('If you missed the documentation, you can go read it now.','jm-tc');?><br />
	</p>
	<a class="button button-secondary" target="_blank" href="<?php echo plugins_url('documentation.html',__FILE__);?>"><?php _e('See  Documentation','jm-tc');?></a>
	</div>
	</div>
	
	<div class="postbox large">
	<h3 class="hndle"><span><?php _e('Other plugins you might dig','jm-tc');?></span></h3>
	<div class="inside">
	<ul>
	<li><a href="http://wordpress.org/plugins/jm-last-twit-shortcode/">JM Last Twit Shortcode</a> - <?php _e('Display any timeline you want the Twitter 1.1 way with a simple shortcode','jm-tc');?></li>
	<li><a href="http://wordpress.org/plugins/jm-html5-and-responsive-gallery/">JM HTML5 and Responsive Gallery</a> - <?php _e('Fix poor native markup for WordPress gallery with some HTML5 markup and add responsive rules.','jm-tc');?></li>
	<li><a href="http://wordpress.org/plugins/jm-twit-this-comment/">JM Twit This Comment</a> - <?php _e('Make your comments tweetable','jm-tc');?></li>
	<li><a href="http://wordpress.org/plugins/jm-widget-feed-panel/">JM Widget Feed Panel</a> - <?php _e('Add a third RSS widget to your dashboard','jm-tc');?></li>
	<li><a href="http://wordpress.org/plugins/jm-twitter-status-api-monitor/">JM Twitter Status API Monitor</a> - <?php _e('Monitor the Twitter API 1.1 from dashboard','jm-tc');?></li>
	</ul>
	</div>
	</div>	
	
	
	</div>
	
	<?php
}

/*
* OPTIONS TREATMENT
*/

// Process options when submitted
function jm_tc_sanitize($options) {
	return array_merge(jm_tc_get_options(), jm_tc_sanitize_options($options));
}

// Sanitize options
function jm_tc_sanitize_options($options) {
	$new = array();

	if ( !is_array($options) )
	return $new;

	if ( isset($options['twitterCardType']) )
	$new['twitterCardType']      = $options['twitterCardType'];
	if ( isset($options['twitterCreator']) )
	$new['twitterCreator']		 = esc_attr(strip_tags( jm_tc_remove_at($options['twitterCreator']) ));
	if ( isset($options['twitterSite']) )
	$new['twitterSite']          = esc_attr(strip_tags(jm_tc_remove_at($options['twitterSite']) ));
	if ( isset($options['twitterExcerptLength']) )
	$new['twitterExcerptLength'] = (int) $options['twitterExcerptLength'];
	if ( isset($options['twitterImage']) )
	$new['twitterImage']         = esc_url($options['twitterImage']);
	if ( isset($options['twitterImageWidth']) )
	$new['twitterImageWidth']    = (int) $options['twitterImageWidth'];
	if ( isset($options['twitterImageHeight']) )
	$new['twitterImageHeight']   = (int) $options['twitterImageHeight'];
	if ( isset($options['twitterCardCustom']) )
	$new['twitterCardCustom']    = $options['twitterCardCustom'];
	if ( isset($options['twitterProfile']) )
	$new['twitterProfile']       = $options['twitterProfile'];
	if ( isset($options['twitterPostPageTitle']) )
	$new['twitterPostPageTitle'] = esc_attr(strip_tags($options['twitterPostPageTitle']));
	if ( isset($options['twitterPostPageDesc']) )
	$new['twitterPostPageDesc']  = esc_attr(strip_tags($options['twitterPostPageDesc']));
	if ( isset($options['twitterCardSEOTitle']) )
	$new['twitterCardSEOTitle']  = $options['twitterCardSEOTitle'];
	if ( isset($options['twitterCardSEODesc']) )
	$new['twitterCardSEODesc']   = $options['twitterCardSEODesc'];
	if ( isset($options['twitterData1']) )
	$new['twitterData1']         = esc_attr(strip_tags($options['twitterData1']));
	if ( isset($options['twitterLabel1']) )
	$new['twitterLabel2']        = esc_attr(strip_tags($options['twitterLabel2']));
	if ( isset($options['twitterData2']) )
	$new['twitterData2']         = esc_attr(strip_tags($options['twitterData2']));
	if ( isset($options['twitterLabel2']) )
	$new['twitterLabel2']        = esc_attr(strip_tags($options['twitterLabel2']));
	if ( isset($options['twitterCardImgSize']) )
	$new['twitterCardImgSize']   = $options['twitterCardImgSize'];
	if ( isset($options['twitterCardTitle']) )
	$new['twitterCardTitle']     = esc_attr(strip_tags($options['twitterCardTitle']));
	if ( isset($options['twitterCardDesc']) )
	$new['twitterCardDesc']      = esc_attr(strip_tags($options['twitterCardDesc']));
	if ( isset($options['twitterCardCrop']) )
	$new['twitterCardCrop']      = $options['twitterCardCrop'];
	return $new;
}

// Return default options
function jm_tc_get_default_options() {	

	return array(
	'twitterCardType'           => 'summary',
	'twitterCreator'		    => 'TweetPressFr',
	'twitterSite'               => 'TweetPressFr',
	'twitterExcerptLength'	    => 35,
	'twitterImage'              => 'http://www.tweetpress.fr/tweetpress.png',
	'twitterImageWidth'         => '280',
	'twitterImageHeight'        => '150',
	'twitterCardCustom'         => 'no',
	'twitterProfile'            => 'no',
	'twitterPostPageTitle' 		=> get_bloginfo ( 'name' ),// filter used by plugin to customize title
	'twitterPostPageDesc'       => __('Welcome to','jm-tc').' '.get_bloginfo ( 'name' ).' - '. __('see blog posts','jm-tc'),
	'twitterCardSEOTitle'       => 'yes',
	'twitterCardSEODesc'        => 'yes',
	'twitterData1'     		    => 'France',
	'twitterLabel1'       	    => 'COUNTRY',
	'twitterData2'              => '5 stars',
	'twitterLabel2'             => 'NOTE',
	'twitterCardImgSize'		=> 'small',
	'twitterCardTitle'			=> '',
	'twitterCardDesc'			=> '',
	'twitterCardCrop'			=> 'yes'
	);
}

// Retrieve and sanitize options
function jm_tc_get_options() {
	$options = get_option( 'jm_tc' );
	return array_merge(jm_tc_get_default_options(), jm_tc_sanitize_options($options));
}

