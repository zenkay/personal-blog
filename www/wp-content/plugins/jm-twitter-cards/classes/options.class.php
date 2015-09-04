<?php
namespace TokenToMe\TwitterCards;

if ( ! defined( 'JM_TC_VERSION' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

class Options {

	/**
	 * options
	 * @var array
	 */
	protected $opts = array();

	/**
	 * Constructor
	 * @since 5.3.2
	 */
	function __construct() {

		$this->opts = \jm_tc_get_options();

	}

	/**
	 * @param bool $post_ID
	 * @param string $type
	 *
	 * @return null|string|void
	 */
	public static function get_seo_plugin_datas( $post_ID = false, $type ) {

		$aioseop_title           = get_post_meta( $post_ID, '_aioseop_title', true );
		$aioseop_description     = get_post_meta( $post_ID, '_aioseop_description', true );
		$yoast_wpseo_title       = get_post_meta( $post_ID, '_yoast_wpseo_title', true );
		$yoast_wpseo_description = get_post_meta( $post_ID, '_yoast_wpseo_metadesc', true );

		$title = the_title_attribute( array( 'echo' => false ) );
		$desc  = Utilities::get_excerpt_by_id( $post_ID );

		if ( class_exists( 'WPSEO_Frontend' ) ) {
			$title = ! empty( $yoast_wpseo_title ) ? htmlspecialchars( stripcslashes( $yoast_wpseo_title ) ) : the_title_attribute( array( 'echo' => false ) );
			$desc  = ! empty( $yoast_wpseo_description ) ? htmlspecialchars( stripcslashes( $yoast_wpseo_description ) ) : Utilities::get_excerpt_by_id( $post_ID );

		} elseif ( class_exists( 'All_in_One_SEO_Pack' ) ) {
			$title = ! empty( $aioseop_title ) ? htmlspecialchars( stripcslashes( $aioseop_title ) ) : the_title_attribute( array( 'echo' => false ) );
			$desc  = ! empty( $aioseop_description ) ? htmlspecialchars( stripcslashes( $aioseop_description ) ) : Utilities::get_excerpt_by_id( $post_ID );
		}

		switch ( $type ) {
			case 'title' :
				$data = $title;
				break;
			case 'desc' :
				$data = $desc;
				break;
			default:
				$data = $title;
		}

		return $data;

	}


	/**
	 * @param bool $post_ID
	 *
	 * @return array
	 */
	public function card_type( $post_ID = false ) {

		$cardTypePost = get_post_meta( $post_ID, 'twitterCardType', true );

		$cardType = ( ! empty( $cardTypePost ) ) ? $cardTypePost : $this->opts['twitterCardType'];

		return array( 'card' => apply_filters( 'jm_tc_card_type', $cardType ) );
	}

	/**
	 * @param bool $post_author
	 * @param bool $post_ID
	 *
	 * @return array
	 */
	public function creator_username( $post_author = false, $post_ID = false ) {

		$post_obj    = get_post( $post_ID );
		$author_id   = $post_obj->post_author;
		$cardCreator = '@' . Utilities::remove_at( $this->opts['twitterCreator'] );

		if ( $post_author ) {

			//to be modified or left with the value 'jm_tc_twitter'

			$cardUsernameKey = $this->opts['twitterUsernameKey'];
			$cardCreator     = get_the_author_meta( $cardUsernameKey, $author_id );

			$cardCreator = ( ! empty( $cardCreator ) ) ? $cardCreator : $this->opts['twitterCreator'];
			$cardCreator = '@' . Utilities::remove_at( $cardCreator );
		}

		$creator = apply_filters( 'jm_tc_card_creator', $cardCreator );

		return array( 'creator' => $creator );
	}

	/**
	 * @return array
	 */
	public function site_username() {

		$cardSite = '@' . Utilities::remove_at( $this->opts['twitterSite'] );
		$site = apply_filters( 'jm_tc_card_site', $cardSite );

		return array( 'site' => $site );
	}


	/**
	 * @param bool $post_ID
	 *
	 * @return array
	 */
	public function title( $post_ID = false ) {

		$cardTitle = get_bloginfo( 'name' );

		if ( $post_ID ) {

			$cardTitle = the_title_attribute( array( 'echo' => false ) );

			if ( ! empty( $this->opts['twitterCardTitle'] ) ) {

				$title     = get_post_meta( $post_ID, $this->opts['twitterCardTitle'], true ); // this one is pretty hard to debug ^^
				$cardTitle = ! empty( $title ) ? htmlspecialchars( stripcslashes( $title ) ) : the_title_attribute( array( 'echo' => false ) );

			} elseif ( empty( $this->opts['twitterCardTitle'] ) && ( class_exists( 'WPSEO_Frontend' ) || class_exists( 'All_in_One_SEO_Pack' ) ) ) {

				$cardTitle = self::get_seo_plugin_datas( $post_ID, 'title' );
			}
		}

		return array( 'title' => apply_filters( 'jm_tc_get_title', $cardTitle ) );

	}

	/**
	 * @param bool $post_ID
	 *
	 * @return array
	 */
	public function description( $post_ID = false ) {

		$cardDescription = $this->opts['twitterPostPageDesc'];
		if ( $post_ID ) {

			$cardDescription = Utilities::get_excerpt_by_id( $post_ID );

			if ( ! empty( $this->opts['twitterCardDesc'] ) ) {
				$desc            = get_post_meta( $post_ID, $this->opts['twitterCardDesc'], true );
				$cardDescription = ! empty( $desc ) ? htmlspecialchars( stripcslashes( $desc ) ) : Utilities::get_excerpt_by_id( $post_ID );
			} elseif ( empty( $this->opts['twitterCardDesc'] ) && ( class_exists( 'WPSEO_Frontend' ) || class_exists( 'All_in_One_SEO_Pack' ) ) ) {
				$cardDescription = self::get_seo_plugin_datas( $post_ID, 'desc' );
			}
		}
		$cardDescription = Utilities::remove_lb( $cardDescription );

		return array( 'description' => apply_filters( 'jm_tc_get_excerpt', $cardDescription ) );

	}


	/**
	 * @param bool $post_ID
	 *
	 * @return array|bool
	 */
	public function image( $post_ID = false ) {

		$cardImage = get_post_meta( $post_ID, 'cardImage', true );

		//fallback
		$image = $this->opts['twitterImage'];

		if ( '' !== get_the_post_thumbnail( $post_ID ) ) {
			$image = $cardImage;
			if ( empty( $cardImage ) ) {
				$size             = Thumbs::thumbnail_sizes( $post_ID );
				$image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id( $post_ID ), $size );
				$image            = $image_attributes[0];
			}
		} elseif ( '' === get_the_post_thumbnail( $post_ID ) && ! empty( $cardImage ) ) {
			$image = $cardImage;
		} elseif ( 'attachment' === get_post_type() ) {
			$image = wp_get_attachment_url( $post_ID );
		} elseif ( false === $post_ID ) {
			$image = $this->opts['twitterImage'];
		}

		//In case Open Graph is on
		$img_meta = ( 'yes' === $this->opts['twitterCardOg'] ) ? 'image' : 'image:src';

		return array( $img_meta => apply_filters( 'jm_tc_image_source', $image ) );

	}

	/**
	 * @param $post_ID
	 *
	 * @return array|bool
	 */
	public function player( $post_ID ) {

		$cardType = apply_filters( 'jm_tc_card_type', get_post_meta( $post_ID, 'twitterCardType', true ) );

		if ( 'player' === $cardType ) {

			$playerUrl       = get_post_meta( $post_ID, 'cardPlayer', true );
			$playerStreamUrl = get_post_meta( $post_ID, 'cardPlayerStream', true );
			$playerWidth     = get_post_meta( $post_ID, 'cardPlayerWidth', true );
			$playerHeight    = get_post_meta( $post_ID, 'cardPlayerHeight', true );
			$playerCodec     = get_post_meta( $post_ID, 'cardPlayerCodec', true );
			$player          = array();

			//Player
			if ( empty( $playerUrl ) ) {
				return self::error( __( 'Warning : Player Card is not set properly ! There is no URL provided for iFrame player !', JM_TC_TEXTDOMAIN ) );
			}

			$player['player'] = apply_filters( 'jm_tc_player_url', $playerUrl );

			//Player stream
			if ( ! empty( $playerStreamUrl ) ) {
				$player['player:stream'] = apply_filters( 'jm_tc_player_stream_url', $playerStreamUrl );
			}

			$player['player:stream:content_type'] = esc_attr( apply_filters( 'jm_tc_player_codec', 'video/mp4; codecs="avc1.42E01E1, mp4a.40.2"' ) );

			if ( ! empty( $playerCodec ) ) {
				$player['player:stream:content_type'] = esc_attr( apply_filters( 'jm_tc_player_codec', $playerCodec ) );
			}

			//Player width and
			$player['player:width']  = apply_filters( 'jm_tc_player_default_width', 435 );
			$player['player:height'] = apply_filters( 'jm_tc_player_default_height', 251 );
			if ( ! empty( $playerWidth ) && ! empty( $playerHeight ) ) {
				$player['player:width']  = apply_filters( 'jm_tc_player_width', $playerWidth );
				$player['player:height'] = apply_filters( 'jm_tc_player_height', $playerHeight );
			}

			return $player;
		}

		return false;
	}


	/**
	 * @param bool $post_ID
	 *
	 * @return array|bool
	 */
	public function card_dim( $post_ID = false ) {

		$cardTypePost = get_post_meta( $post_ID, 'twitterCardType', true );
		$cardWidth    = get_post_meta( $post_ID, 'cardImageWidth', true );
		$cardHeight   = get_post_meta( $post_ID, 'cardImageHeight', true );
		$type         = ( ! empty( $cardTypePost ) ) ? $cardTypePost : $this->opts['twitterCardType'];

		if ( in_array( $type, array( 'photo', 'product', 'summary_large_image', 'player' ) ) ) {

			$width  = ( ! empty( $cardWidth ) ) ? $cardWidth : $this->opts['twitterImageWidth'];
			$height = ( ! empty( $cardHeight ) ) ? $cardHeight : $this->opts['twitterImageHeight'];

			$width  = apply_filters( 'jm_tc_image_width', $width );
			$height = apply_filters( 'jm_tc_image_height', $height );

			return array(
				'image:width'  => $width,
				'image:height' => $height,
			);

		} elseif ( in_array( $type, array( 'photo', 'product', 'summary_large_image', 'player' ) ) && ! $post_ID ) {

			return array(
				'image:width'  => $this->opts['twitterCardWidth'],
				'image:height' => $this->opts['twitterCardHeight'],
			);
		}

		return false;
	}


	/**
	 * @return array
	 */
	public function deep_linking() {

		$twitteriPhoneName     = ( ! empty( $this->opts['twitteriPhoneName'] ) ) ? $this->opts['twitteriPhoneName'] : '';
		$twitteriPadName       = ( ! empty( $this->opts['twitteriPadName'] ) ) ? $this->opts['twitteriPadName'] : '';
		$twitterGooglePlayName = ( ! empty( $this->opts['twitterGooglePlayName'] ) ) ? $this->opts['twitterGooglePlayName'] : '';
		$twitteriPhoneUrl      = ( ! empty( $this->opts['twitteriPhoneUrl'] ) ) ? $this->opts['twitteriPhoneUrl'] : '';
		$twitteriPadUrl        = ( ! empty( $this->opts['twitteriPadUrl'] ) ) ? $this->opts['twitteriPadUrl'] : '';
		$twitterGooglePlayUrl  = ( ! empty( $this->opts['twitterGooglePlayUrl'] ) ) ? $this->opts['twitterGooglePlayUrl'] : '';
		$twitteriPhoneId       = ( ! empty( $this->opts['twitteriPhoneId'] ) ) ? $this->opts['twitteriPhoneId'] : '';
		$twitteriPadId         = ( ! empty( $this->opts['twitteriPadId'] ) ) ? $this->opts['twitteriPadId'] : '';
		$twitterGooglePlayId   = ( ! empty( $this->opts['twitterGooglePlayId'] ) ) ? $this->opts['twitterGooglePlayId'] : '';
		$twitterAppCountry     = ( ! empty( $this->opts['twitterAppCountry'] ) ) ? $this->opts['twitterAppCountry'] : '';

		$twitteriPhoneName     = apply_filters( 'jm_tc_iphone_name', $twitteriPhoneName );
		$twitteriPadName       = apply_filters( 'jm_tc_ipad_name', $twitteriPadName );
		$twitterGooglePlayName = apply_filters( 'jm_tc_googleplay_name', $twitterGooglePlayName );
		$twitteriPhoneUrl      = apply_filters( 'jm_tc_iphone_url', $twitteriPhoneUrl );
		$twitteriPadUrl        = apply_filters( 'jm_tc_ipad_url', $twitteriPadUrl );
		$twitterGooglePlayUrl  = apply_filters( 'jm_tc_googleplay_url', $twitterGooglePlayUrl );
		$twitteriPhoneId       = apply_filters( 'jm_tc_iphone_id', $twitteriPhoneId );
		$twitteriPadId         = apply_filters( 'jm_tc_ipad_id', $twitteriPadId );
		$twitterGooglePlayId   = apply_filters( 'jm_tc_googleplay_id', $twitterGooglePlayId );
		$twitterAppCountry     = apply_filters( 'jm_tc_country', $twitterAppCountry );

		$app = array(
			'app:name:iphone'     => $twitteriPhoneName,
			'app:name:ipad'       => $twitteriPadName,
			'app:name:googleplay' => $twitterGooglePlayName,
			'app:url:iphone'      => $twitteriPhoneUrl,
			'app:url:ipad'        => $twitteriPadUrl,
			'app:url:googleplay'  => $twitterGooglePlayUrl,
			'app:id:iphone'       => $twitteriPhoneId,
			'app:id:ipad'         => $twitteriPadId,
			'app:id:googleplay'   => $twitterGooglePlayId,
			'app:id:country'      => $twitterAppCountry,
		);

		return $return = array_map( 'esc_attr', $app );

	}


	/**
	 * @param bool $error
	 *
	 * @return bool
	 */
	protected function error( $error = false ) {

		if ( $error && current_user_can( 'edit_posts' ) ) {
			return $error;
		}

		return false;

	}


}
