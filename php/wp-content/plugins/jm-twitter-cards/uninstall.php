<?php

// If cheating exit
if( !defined( 'ABSPATH') && !defined('WP_UNINSTALL_PLUGIN') )
exit();

/**
 * Delete postmeta from option table
 *
 */
$keys = array(
			'twitterCardType', 
			'cardImage',
			'cardPlayer',
			'cardPhotoWidth',
			'cardPhotoHeight',
			'cardProductWidth',
			'cardProductHeight',
			'cardPlayerWidth',
			'cardPlayerHeight',
			'cardPlayerStream',
			'cardData1',
			'cardLabel1',
			'cardData2',
			'cardLabel2',
			'cardImgSize',
			'twitterCardCancel'
		);
		
		
foreach($keys as $key)	{
global $wpdb;
	$wpdb->query( 
		$wpdb->prepare( 
			"
			 DELETE FROM $wpdb->postmeta
			 WHERE meta_key = %s
			",
			$key
			)
	);
}
