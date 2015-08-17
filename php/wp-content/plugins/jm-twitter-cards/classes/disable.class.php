<?php
namespace TokenToMe\TwitterCards;

if ( ! defined( 'JM_TC_VERSION' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

class Disable {

	/**
	 * Constructor
	 * @since 5.3.2
	 */
	function __construct() {

		add_action( 'admin_init', array( $this, 'disable_yoast_twitter' ) );
		//disable yoast markup but only twitter meta of course !

	}

	/**
	 * Disable Yoast cards
	 * @since 5.3.4
	 */
	public function disable_yoast_twitter() {

		$opt            = get_option( 'wpseo_social' );
		$opt['twitter'] = false;

		update_option( 'wpseo_social', $opt );

	}


}
