<?php
namespace TokenToMe\TwitterCards\Admin;
use TokenToMe\TwitterCards\Options;

if ( ! defined( 'JM_TC_VERSION' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

class Preview {
	/**
	 * Allows to show what could render the cards on Twitter
	 *
	 * @param $post_ID
	 *
	 * @return string
	 */
	public static function show_preview( $post_ID ) {

		$GLOBALS['jm_twitter_cards']['options'] = new Options;
		$options                                = $GLOBALS['jm_twitter_cards']['options'];
		$opts                                   = \jm_tc_get_options();

		$is_og = $opts['twitterCardOg'];

		/* most important meta */
		$cardType_arr    = $options->card_type( $post_ID );
		$creator_arr     = $options->creator_username( true );
		$site_arr        = $options->site_username();
		$title_arr       = $options->title( $post_ID );
		$description_arr = $options->description( $post_ID );
		$img_arr         = $options->image( $post_ID );

		/* secondary meta */
		$player_arr    = $options->player( $post_ID );
		$deep_link_arr = $options->deep_linking();

		// default
		$app          = '';
		$size         = 16;
		$class        = 'featured-image';
		$tag          = 'img';
		$close_tag    = '';
		$src          = 'src';
		$product_meta = '';
		$styles       = '';
		$position     = 'position:relative;';
		$hide         = '';
		$img          = ( 'yes' === $is_og ) ? $img_arr['image'] : $img_arr['image:src'];
		$img_summary  = '';
		$gallery_meta = '';

		// particular cases
		if ( in_array( 'summary_large_image', $cardType_arr ) ) {
			$styles = 'width:100%;';
			$size   = '100%';
		} elseif ( in_array( 'photo', $cardType_arr ) ) {
			$styles = 'width:100%;';
			$size   = '100%';
		} elseif ( in_array( 'player', $cardType_arr ) ) {
			$styles    = 'width:100%;';
			$img       = ( 'yes' === $is_og ) ? $img_arr['image'] : $img_arr['image:src'];
			$src       = 'controls poster';
			$tag       = 'video';
			$close_tag = '</video>';
			$size      = '100%';
		}  elseif ( in_array( 'summary', $cardType_arr ) ) {
			$styles      = 'width: 60px; height: 60px; margin-left:.6em;';
			$size        = 60;
			$hide        = 'hide';
			$class       = 'summary-image';
			$img_summary = '<img class="' . $class . '" width="' . $size . '" height="' . $size . '" style="' . $styles . ' -webkit-user-drag: none; " ' . $src . '="' . $img . '">';
			$float       = 'float:right;';
		} elseif ( in_array( 'app', $cardType_arr ) ) {
			$hide  = 'hide';
			$class = 'bg-opacity';
			$app   = '<div class="app-view" style="float:left;">';
			$app .= '<strong>' . __( 'Preview for app cards is not available yet.', 'jm-tc' ) . '</strong>';
			$app .= '</div>';
		} else {
			$styles = 'float:none;';
		}
		$output = '<div class="fake-twt">';
		$output .= $app;
		$output .= '<div class="e-content ' . $class . '">
							<div style="float:left;">
							' . get_avatar( false, 16 ) . '
							<span>' . __( 'Name associated with ', 'jm-tc' ) . $site_arr['site'] . '</span>

							<div style="float:left;" class="' . $hide . '">
								<' . $tag . ' class="' . $class . '" width="' . $size . '" height="' . $size . '" style="' . $styles . ' -webkit-user-drag: none; " ' . $src . '="' . $img . '">' . $close_tag . '
							
							' . $product_meta . '
							</div>
							</div>
							
							' . $gallery_meta . '
									
							<div style="float:left;">
							<div><strong>' . $title_arr['title'] . '</strong></div>
							<div><em>By ' . __( 'Name associated with ', 'jm-tc' ) . $creator_arr['creator'] . '</em></div>
							<div>' . $description_arr['description'] . '</div>
							</div>
							'
		           . $img_summary .
		           '<div style="float:left;" class="gray"><strong>' . __( 'View on the web', 'jm-tc' ) . '<strong></div></div></div>';
		$output .= '</div>';

		return $output;

	}
}