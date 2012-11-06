<?php


class WordPress_Social_Ring {
	
	private $options;
	private $post_url;
	private $post_encoded_url;
	private $post_title;
	private $post_encoded_title;
	
	function __construct() {
		$this->options = get_option(WP_SOCIAL_RING.'_options');
		$this->set_default_options();
		add_action('wp_head', array($this, 'frontend_css'));
		add_filter('the_content', array($this, 'add_sharing_buttons'));
		add_action('wp_footer', array($this, 'add_footer_js'));
		add_shortcode('socialring', array($this, 'shortcode'));
	}
	
	function set_default_options() {
		if(!isset($this->options['social_facebook_like_button'])) {
			$this->options['social_facebook_like_button'] = 1;
		}
		if(!isset($this->options['social_twitter_button'])) {
			$this->options['social_twitter_button'] = 1;
		}
		if(!isset($this->options['social_facebook_share_button'])) {
			$this->options['social_facebook_share_button'] = 0;
		}
		if(!isset($this->options['social_google_button'])) {
			$this->options['social_google_button'] = 1;
		}
		if(!isset($this->options['social_pin_it_button'])) {
			$this->options['social_pin_it_button'] = 0;
		}
		if(!isset($this->options['social_linkedin_button'])) {
			$this->options['social_linkedin_button'] = 0;
		}
		if(!isset($this->options['social_stumble_button'])) {
			$this->options['social_stumble_button'] = 0;
		}
		if(!isset($this->options['social_on_home'])) {
			$this->options['social_on_home'] = 0;
		}
		if(!isset($this->options['social_on_pages'])) {
			$this->options['social_on_pages'] = 0;
		}
		if(!isset($this->options['social_on_posts'])) {
			$this->options['social_on_posts'] = 1;
		}
		if(!isset($this->options['social_on_category'])) {
			$this->options['social_on_category'] = 0;
		}
		if(!isset($this->options['social_on_archive'])) {
			$this->options['social_on_archive'] = 0;
		}
		if(!isset($this->options['social_before_content'])) {
			$this->options['social_before_content'] = 1;
		}
		if(!isset($this->options['social_after_content'])) {
			$this->options['social_after_content'] = 0;
		}
		if(!isset($this->options['language'])) {
			$this->options['language'] = 'English';
		}
		if(!isset($this->options['facebook_language'])) {
			$this->options['facebook_language'] = 'en_US';
		}
		if(!isset($this->options['google_language'])) {
			$this->options['google_language'] = 'en-US';
		}
		if(!isset($this->options['twitter_language'])) {
			$this->options['twitter_language'] = 'en';
		}
		if(!isset($this->options['button_counter'])) {
			$this->options['button_counter'] = 'horizontal';
		}
	}
	
	function add_sharing_buttons($content) {
		if($this->print_check() == 1 && ($this->options['social_before_content'] == 1 || $this->options['social_after_content'] == 1)) {
			$html = $this->buttons_html();
			if($this->options['social_before_content'] == 1) {
				$content = $html.$content;
			} 
			if($this->options['social_after_content'] == 1) {
				$content = $content.$html;
			}	
		}
		return $content;
	}
	
	function frontend_css() {
	?> 
		<style type="text/css">
			.social-ring:after {
			    clear: both;
			    content: " ";
			    display: block;
			    font-size: 0;
			    height: 0;
			    line-height: 0;
			    visibility: hidden;
			    width: 0;
			}	
			.social-ring {
				margin: 0 !important;
				padding: 0 !important;
				line-height: 20px !important;
				height: auto;
				font-size: 11px;
			}
			.social-ring-button {
				float: left !important;
				<?php if($this->options['button_counter'] == 'vertical') { ?>
				height: 60px;	
				<?php } else { ?>
				height: 30px;
				<?php } ?>
				margin: 0 5px 0 0 !important;
				padding: 0 !important;
			}
			.social-ring .social-ring-button iframe {
				max-width: none !important;
			}
		</style>
	<?php
	}
	
	function buttons_html() {
		global $post;
		$this->post_url = (string) get_permalink($post->ID);
		$this->post_encoded_url = (string) urlencode($this->post_url);
		$this->post_title =  (string) $post->post_title;
		$this->post_encoded_title = (string) urlencode(esc_attr(strip_tags(stripslashes($post->post_title))));
		$html = '<!-- Social Ring Buttons Start --><div class="social-ring">'."\n";
		if($this->options['social_twitter_button'] == 1) {
			$html .= $this->button_before();
			$html .= $this->twitter_html();
			$html .= $this->button_after();	
		}
		if($this->options['social_google_button'] == 1) {
			$html .= $this->button_before();
			$html .= $this->google_plus_one_html();
			$html .= $this->button_after();	
		}
		if($this->options['social_facebook_share_button'] == 1) {
			$html .= $this->button_before();
			$html .= $this->facebook_share_html();
			$html .= $this->button_after();	
		}
		if($this->options['social_facebook_like_button'] == 1) {
			$html .= $this->button_before();
			$html .= $this->facebook_like_html();
			$html .= $this->button_after();
		}
		if($this->options['social_pin_it_button'] == 1) {
			$html .= $this->button_before();
			$html .= $this->pin_it_html();
			$html .= $this->button_after();
		}
		if($this->options['social_linkedin_button'] == 1) {
			$html .= $this->button_before();
			$html .= $this->linkedin_html();
			$html .= $this->button_after();
		}
		if($this->options['social_stumble_button'] == 1) {
			$html .= $this->button_before();
			$html .= $this->stumple_upon_html();
			$html .= $this->button_after();
		}
		$html .= '</div>';
		$html .= '<div style="clear:both;">&nbsp;</div><!-- Social Ring Buttons End -->'."\n";
		return $html;
		
	}
	
	function button_before() {
		return '<div class="social-ring-button">';
	}
	
	function button_after() {
		return "</div>\n";
	}
	
	function twitter_html() {
		$twitter_html = '<a href="http://twitter.com/share" lang="'.$this->options['twitter_language'].'" data-url="'.$this->post_url.'" data-text="'.$this->post_title.'" ';
		if($this->options['button_counter'] == "horizontal") {
			$twitter_html .= 'data-count="horizontal"';
		} elseif($this->options['button_counter'] == "vertical") {
			$twitter_html .= 'data-count="vertical"';
		} elseif($this->options['button_counter'] == "none") {
			$twitter_html .= 'data-count="none"';
		}
		$twitter_html .= ' class="sr-twitter-button twitter-share-button"></a>';
		return $twitter_html;
	}
	
	function google_plus_one_html() {
		$google_html = '<div class="g-plusone" ';
		if($this->options['button_counter'] == "horizontal") {
			$google_html .= 'data-size="medium" ';
		} elseif($this->options['button_counter'] == "vertical") {
			$google_html .= 'data-size="tall" ';
		} elseif($this->options['button_counter'] == "none") {
			$google_html .= 'data-size="medium" data-annotation="none" ';
		}
		$google_html .= '></div>';
		return $google_html;
	}
	
	function facebook_share_html() {
		$fb_share_html = '<fb:share-button expr:href="'.$this->post_url.'" width="140" ';
		if($this->options['button_counter'] == "horizontal") {
			$fb_share_html .= 'type="button_count"';
		} elseif($this->options['button_counter'] == "vertical") {
			$fb_share_html .= 'type="box_count"';
		} elseif($this->options['button_counter'] == "none") {
			$fb_share_html .= 'type="button"';
		}
		$fb_share_html .= '></fb:share>';
		return $fb_share_html;
	}
 	
	function facebook_like_html() {
		if($this->options['social_facebook_send_button'] == 1) {
			$send = 'true';
			$width = 180;
		} else {
			$send = 'false';
			$width = 140;
		}
		$fb_like_html = '<fb:like href="'.$this->post_url.'" width="'.$width.'" send="'.$send.'" showfaces="false" ';
		if($this->options['button_counter'] == "vertical") {
			$fb_like_html .= 'layout="box_count"';
		} else {
			$fb_like_html .= 'layout="button_count"';
		}
		$fb_like_html .= ' action="like"></fb:like>';
		return $fb_like_html;
	}
	
	function pin_it_html() {
		$pin_it_html = '<a href="http://pinterest.com/pin/create/button/?url='.$this->post_encoded_url;
		$image = $this->get_first_image();
		if($image > '') {
			$pin_it_html .= '&media='.urlencode($image);
		}
		$pin_it_html .= '&description='.$this->post_encoded_title.'" class="pin-it-button"';
		if($this->options['button_counter'] == "horizontal") {
			$pin_it_html .= 'count-layout="horizontal"';
		} elseif($this->options['button_counter'] == "vertical") {
			$pin_it_html .= 'count-layout="vertical"';
		} elseif($this->options['button_counter'] == "none") {
			$pin_it_html .= 'count-layout="none"';
		}
		$pin_it_html .='></a>';
		return $pin_it_html;
	}
	
	function linkedin_html() {
		$linkedin_html = '<script src="//platform.linkedin.com/in.js" type="text/javascript"></script><script type="IN/Share" data-url="'.$this->post_encoded_url.'" ';
		if($this->options['button_counter'] == "horizontal") {
			$linkedin_html .= 'data-counter="right" ';
		} elseif($this->options['button_counter'] == "vertical") {
			$linkedin_html .= 'data-counter="top" ';
		} elseif($this->options['button_counter'] == "none") {
			//no data-size attribute
		}
		$linkedin_html .=  '></script>';
		return $linkedin_html;
	}
	
	function stumple_upon_html() {
		
		$stumble_upon_html = '<su:badge ';
		if($this->options['button_counter'] == "horizontal") {
			$stumble_upon_html .= 'layout="1"';
		} elseif($this->options['button_counter'] == "vertical") {
			$stumble_upon_html .= 'layout="5"';
		} elseif($this->options['button_counter'] == "none") {
			$stumble_upon_html .= 'layout="4"';
		}
		$stumble_upon_html .= '></su:badge>';
		return $stumble_upon_html;
	}
	
	function get_first_image() {
		global $post;
		//check if post has thumbnail
		if ( function_exists('has_post_thumbnail') && has_post_thumbnail( $post->ID ) ) {
			$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
			if ( $thumbnail )
				$image = $thumbnail[0];
		//check if pots has image attachments
		} else {
			$files = get_children( 
				array( 
				'post_parent' => $post->ID,
				'post_type' => 'attachment',
				'post_mime_type' => 'image',
				) 
			);
			if ( $files ) {
				$keys = array_reverse( array_keys( $files ) );
				$image = image_downsize( $keys[0], 'thumbnail' );
				$image = $image[0];
			}
		}
		//if there's no attached image, try to grab first image in content
		if(empty($image)) {
			ob_start();
			ob_end_clean();
			$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i',
			     $post->post_content, $matches);
			if(!empty($matches[1][0])) {
			      $image = $matches[1][0];
			}
		}

		return $image;
	}
	
	/*
	function social_ring_shortcode() returns the code for
	[socialring] shortcode
        */
	function shortcode() {
		return $this->buttons_html();	
	}
	
	function add_footer_js() {
	?>
		<!-- Social Ring JS Start -->
	<div id="fb-root"></div><script src="http://connect.facebook.net/<?php echo $this->options['facebook_language']; ?>/all.js#xfbml=1"></script>
	<script type="text/javascript">
		window.___gcfg = {
		  lang: '<?php echo $this->options['google_language']; ?>'
		};
		(function() {
			var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
			po.src = 'https://apis.google.com/js/plusone.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
		})();
	</script>
	<script type='text/javascript' src='https://apis.google.com/js/plusone.js'></script>
	<script type='text/javascript' src='http://platform.twitter.com/widgets.js'></script>
        <script type="text/javascript" src="http://assets.pinterest.com/js/pinit.js"></script>
	<script type="text/javascript">
		(function() {
		  var li = document.createElement('script'); li.type = 'text/javascript'; li.async = true;
		  li.src = ('https:' == document.location.protocol ? 'https:' : 'http:') + '//platform.stumbleupon.com/1/widgets.js';
		  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(li, s);
		})();
	</script>
		<!-- Social Ring JS End -->
	<?php
	}
	
	function print_check() {
		if(is_single() && get_post_type() == "post") {
			return $this->options['social_on_posts'];
		}
		if(is_page() && get_post_type() == "page") {
			return $this->options['social_on_pages'];
		}
		if(is_home()) {
			return $this->options['social_on_home'];
		}
		if(is_category()) {
			return $this->options['social_on_category'];
		}
		if(is_archive()) {
			return $this->options['social_on_archive'];
		}
		return 0;
	}
	
}

/*
 function social_ring_show() is a template tag.
 It must be used inside the loop
*/
function social_ring_show() {

	$wp_social = new WordPress_Social_Ring();
	echo $wp_social->buttons_html();
	return;
	
}

new WordPress_Social_Ring();

?>