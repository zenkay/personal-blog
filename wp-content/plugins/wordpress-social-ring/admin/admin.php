<?php

class WordPress_Social_Ring_Admin {
	
	private $options;
	private $languages = array(	
		
		'Afrikaans' => array(
			'Facebook'	=> 	'af_ZA',
			'Google'	=> 	'af',
			'Twitter' 	=>	'af'
		),
		'Arabic' => array(
			'Facebook'	=> 	'ar_AR',
			'Google'	=> 	'ar',
			'Twitter' 	=>	'ar'
		),
		'Czech' => array(
			'Facebook'	=> 	'cs_CZ',
			'Google'	=> 	'cs',
			'Twitter' 	=>	'cs'
		),
		'Danish' => array(
			'Facebook'	=> 	'da_DK',
			'Google'	=> 	'da',
			'Twitter' 	=>	'da'
		),
		'Filipino' => array(
			'Facebook'	=> 	'en_US',
			'Google'	=> 	'en-US',
			'Twitter' 	=>	'en'
		),
		'Finnish' => array(
			'Facebook'	=> 	'en_US',
			'Google'	=> 	'en-US',
			'Twitter' 	=>	'en'
		),
		'French' => array(
			'Facebook'	=> 	'fr_FR',
			'Google'	=> 	'fr',
			'Twitter' 	=>	'fr'
		),
		'English' => array(
			'Facebook'	=> 	'en_US',
			'Google'	=> 	'en-US',
			'Twitter' 	=>	'en'
		),
		'German' => array(
			'Facebook'	=> 	'de_DE',
			'Google'	=> 	'de',
			'Twitter' 	=>	'de'
		),
		'Greek' => array(
			'Facebook'	=> 	'el_GR',
			'Google'	=> 	'el',
			'Twitter' 	=>	'el'
		),
		'Hebrew' => array(
			'Facebook'	=> 	'he_IL',
			'Google'	=> 	'he',
			'Twitter' 	=>	'he'
		),	
		'Hindi' => array(
			'Facebook'	=> 	'hi_IN',
			'Google'	=> 	'hi',
			'Twitter' 	=>	'hi'
		),
		'Hungarian' => array(
			'Facebook'	=> 	'hu_HU',
			'Google'	=> 	'hu',
			'Twitter' 	=>	'hu'
		),
		'Icelandic' => array(
			'Facebook'	=> 	'is_IS',
			'Google'	=> 	'is',
			'Twitter' 	=>	'is'
		),
		'Indonesian' => array(
			'Facebook'	=> 	'id_ID',
			'Google'	=> 	'id',
			'Twitter' 	=>	'id'
		),
		'Italian' => array(
			'Facebook'	=> 	'it_IT',
			'Google'	=> 	'it',
			'Twitter' 	=>	'it'
		),
		'Japanese' => array(
			'Facebook'	=> 	'ja_JP',
			'Google'	=> 	'ja',
			'Twitter' 	=>	'ja'
		),
		'Norwegian' => array(
			'Facebook'	=> 	'nn_NO',
			'Google'	=> 	'no',
			'Twitter' 	=>	'no'
		),
		'Polish' => array(
			'Facebook'	=> 	'pl_PL',
			'Google'	=> 	'pl',
			'Twitter' 	=>	'pl'
		),
		'Portuguese (Brazil)' => array(
			'Facebook'	=> 	'pt_BR',
			'Google'	=> 	'pt-BR',
			'Twitter' 	=>	'pt'
		),
		'Portuguese (Portugal)' => array(
			'Facebook'	=> 	'pt_PT',
			'Google'	=> 	'pt-PT',
			'Twitter' 	=>	'pt'
		),
		'Romanian' => array(
			'Facebook'	=> 	'ro_RO',
			'Google'	=> 	'ro',
			'Twitter' 	=>	'ro'
		),
		'Russian' => array(
			'Facebook'	=> 	'ru_RU',
			'Google'	=> 	'ru',
			'Twitter' 	=>	'ru'
		),
		'Serbian' => array(
			'Facebook'	=> 	'sr_RS',
			'Google'	=> 	'sr',
			'Twitter' 	=>	'sr'
		),
		'Slovak' => array(
			'Facebook'	=> 	'sk_SK',
			'Google'	=> 	'sk',
			'Twitter' 	=>	'sk'
		),
		'Slovenian' => array(
			'Facebook'	=> 	'sl_SI',
			'Google'	=> 	'sl',
			'Twitter' 	=>	'sl'
		),
		'Spanish' => array(
			'Facebook'	=> 	'es_ES',
			'Google'	=> 	'es',
			'Twitter' 	=>	'es'
		),
		
		'Swedish' => array(
			'Facebook'	=> 	'sv_SE',
			'Language'	=> 	'sv',
			'Twitter' 	=>	'sv'
		),
		'Turkish' => array(
			'Facebook'	=> 	'tr_TR',
			'Google'	=> 	'tr',
			'Twitter' 	=>	'tr'
		),
		'Ukrainian' => array(
			'Facebook'	=> 	'uk_UA',
			'Google'	=> 	'uk',
			'Twitter' 	=>	'uk'
		)
	);
	
	function __construct() {
		$this->options = get_option(WP_SOCIAL_RING.'_options');
		$this->set_default_options();
		add_action('admin_menu', array($this, 'register_option_page'));
		add_action('admin_init', array($this, 'register_options'));
	}
	
	function set_default_options() {
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
	}
	
	function register_option_page() {
		$page = add_options_page(__('Social Sharing', WP_SOCIAL_RING), __('Social Sharing', WP_SOCIAL_RING), 'manage_options', 'wp_social_ring', array($this, 'print_option_page'));
		add_action('admin_print_styles-' . $page, array($this, 'equeue_admin_css_js'));
	}
	
	function print_option_page() {
	?>
	<div class="wrap">
		<?php screen_icon('plugins'); ?>
		<h2><?php _e('Social Network Settings',WP_SOCIAL_RING); ?></h2>
		<div id="wp-social-ring">
			<div class="postbox-container" style="width:70%;">
				<form action="options.php" method="post">
						<div class="postbox">
							<?php settings_fields(WP_SOCIAL_RING.'_options'); ?>
							<?php do_settings_sections(WP_SOCIAL_RING); ?>
						</div>
						<div class="postbox">
							<h3><?php _e('Extra',WP_SOCIAL_RING); ?></h3>
							<div style="margin-left:10px;">
								<p style="margin-top:10px;">
									<?php _e('<b>Custom position</b>',WP_SOCIAL_RING); ?>
								</p>	
								<p>
									<?php _e('You can give Social buttons a custom position by calling this function in your theme.',WP_SOCIAL_RING); ?>
								</p>
								<pre>&lt;?php if(function_exists('social_ring_show')){ social_ring_show();} ?&gt;</pre>
								<p>
									<?php _e('Pay Attention: it must called <b>inside the loop</b> to work properly!',WP_SOCIAL_RING); ?>
								</p>
								<p style="margin-top:20px;">
									<?php _e('<b>Shortcode</b>',WP_SOCIAL_RING); ?>
								</p>
								<p>
									<?php _e('You can also place social buttons inside your posts by using the shortcode:',WP_SOCIAL_RING); ?>
								</p>
								<pre style="margin-bottom:20px;">[socialring]</pre>
							</div>
						</div>
						<input name="submit" class="button-primary" type="submit" value="<?php _e('Save Changes',WP_SOCIAL_RING); ?>" />
				</form>
			</div>
			<div class="postbox-container" style="margin-left:15px;">
				<div class="postbox">
					<h3><?php _e('Help', WP_SOCIAL_RING); ?></h3>
					<ul style="list-style:circle; padding:10px 0 10px 30px;">
						<li><a target="_blank" href="http://wordpress.altervista.org/wordpress-social-ring/faq/">FAQ</a></li>
						<li><a target="_blank" href="http://wordpress.org/support/plugin/wordpress-social-ring">Forum</a></li>
					</ul>
				</div>
				<div class="postbox">
					<h3><?php _e('News', WP_SOCIAL_RING); ?></h3>
					<ul style="list-style:circle; padding:10px 0 10px 30px;">
						<li><a target="_blank" href="http://wordpress.altervista.org/wordpress-social-ring-1-2-2/">WordPress Social Ring 1.2.2</a></li>
						<li><a target="_blank" href="http://wordpress.altervista.org/wp-social-ring-1-2-0/">WordPress Social Ring 1.2.0</a></li>
						<li><a target="_blank" href="http://wordpress.altervista.org/wordpress-social-ring-1-1-9/">WordPress Social Ring 1.1.9</a></li>
						<li><a target="_blank" href="http://wordpress.altervista.org/wordpress-social-ring-1-1-2-shortcode/">WordPress Social Ring 1.1.2</a></li>
						<li><a target="_blank" href="http://wordpress.altervista.org/wordpress-social-ring-1-1-template-tag-and-social-widget/">WordPress Social Ring 1.1.1</a></li>
					</ul>
				</div>
				<?php if(strpos($_SERVER['HTTP_HOST'], 'altervista') == false && strpos($_SERVER['HTTP_HOST'], 'giallozafferano') == false) { ?>
				<div class="postbox" style="min-width:180px !important;margin-top:5px;text-align:center;padding: 8px 0;">
					<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
						<input type="hidden" name="cmd" value="_s-xclick">
						<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
						">
						<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
						<img alt="" border="0" src="https://www.paypalobjects.com/it_IT/i/scr/pixel.gif" width="1" height="1">
					</form>
				</div>
				<div style="text-align:center">
					<a target="_blank" href="<?php _e('http://en.altervista.org/create-free-blog.html?ref=socialring',WP_SOCIAL_RING); ?>">
								<img alt="<?php _e('Create your free blog!');?>" title="<?php _e('Create your free blog!');?>" src="http://im.altervista.org/wordpress/images/promo.gif" height="300" width="180" />
					</a>
				</div>
				<?php } ?>
			</div>
			
		</div>
	</div>
	<?php
	}
	
	function equeue_admin_css_js() {
		wp_enqueue_style( WP_SOCIAL_RING.'-style', WP_SOCIAL_RING_URL.'admin/css/style.css');
		wp_enqueue_script( WP_SOCIAL_RING.'_facebook_js', 'http://connect.facebook.net/'.$this->options['facebook_language'].'/all.js#xfbml=1', array(), false, true);
		wp_enqueue_script( WP_SOCIAL_RING.'_gplus_js', 'https://apis.google.com/js/plusone.js', array(), false, true);
		wp_enqueue_script( WP_SOCIAL_RING.'_twitter_js', 'http://platform.twitter.com/widgets.js', array(), false, true);
		wp_enqueue_script( WP_SOCIAL_RING.'_pin_it_js', 'http://assets.pinterest.com/js/pinit.js', array(), false, true);
		wp_enqueue_script( WP_SOCIAL_RING.'_linkedin_js', 'http://platform.linkedin.com/in.js', array(), false, true);
		wp_enqueue_script( WP_SOCIAL_RING.'_stumble_js', 'http://platform.stumbleupon.com/1/widgets.js', array(), false, true);
	}

	function register_options(){
		register_setting(
			WP_SOCIAL_RING.'_options',
			WP_SOCIAL_RING.'_options',
			array($this, 'validate_options')
		);
		add_settings_section(
			WP_SOCIAL_RING.'_setting_section',
			__('General Settings', WP_SOCIAL_RING),
			array($this, 'settings_description'),
			WP_SOCIAL_RING
		);
		add_settings_field(
			'wp_social_ring_active_buttons',
			__('Buttons', WP_SOCIAL_RING),
			array($this, 'active_buttons_setting'),
			WP_SOCIAL_RING,
			WP_SOCIAL_RING.'_setting_section'
		);
		add_settings_field(
			'wp_social_ring_position',
			__('Position',WP_SOCIAL_RING),
			array($this, 'position_setting'),
			WP_SOCIAL_RING,
			WP_SOCIAL_RING.'_setting_section'
		);
		add_settings_field(
			'wp_social_ring_show_on',
			__('Show on', WP_SOCIAL_RING),
			array($this, 'show_on_setting'),
			WP_SOCIAL_RING,
			WP_SOCIAL_RING.'_setting_section'
		);
		add_settings_field(
			'wp_social_ring_counter',
			__('Counter', WP_SOCIAL_RING),
			array($this, 'counter_setting'),
			WP_SOCIAL_RING,
			WP_SOCIAL_RING.'_setting_section'
		);
		add_settings_field(
			'wp_social_ring_language',
			__('Buttons Language',WP_SOCIAL_RING),
			array($this, 'language_setting'),
			WP_SOCIAL_RING,
			WP_SOCIAL_RING.'_setting_section'
		);
	}
	
	function settings_description() {
	?>
		<div class="explain"><?php _e('Choose sharing buttons position and behavior', WP_SOCIAL_RING); ?></div>
	<?php
	}
	
	function counter_setting() {
	?>
		<span>
			<input id="horizontal" type="radio" name="wp_social_ring_options[button_counter]" value="horizontal" <?php checked($this->options['button_counter'], 'horizontal') ?>/>
			<label for="horizontal"><?php _e('Horizontal', WP_SOCIAL_RING); ?></label>
		</span>
		<span style="padding-left:30px;">
			<input id="vertical" type="radio" name="wp_social_ring_options[button_counter]" value="vertical" <?php checked($this->options['button_counter'], 'vertical') ?>/>
			<label for="vertical"><?php _e('Vertical', WP_SOCIAL_RING); ?></label>
		</span>
		<span style="padding-left:30px;">
			<input id="none" type="radio" name="wp_social_ring_options[button_counter]" value="none" <?php checked($this->options['button_counter'], 'none') ?>/>
			<label for="none"><?php _e('None', WP_SOCIAL_RING); ?></label>
		</span>
	<?php
	}
	
	function position_setting() {
		?>
			<ul>
				<li>
					<span><input id='social_before_content' name='wp_social_ring_options[social_before_content]' type='checkbox' value="1" <?php if($this->options['social_before_content'] == 1) echo "checked"; ?> /></span>
					<span><?php _e('Before content',WP_SOCIAL_RING) ?></span>
				</li>
				<li>
					<span><input id='social_after_content' name='wp_social_ring_options[social_after_content]' type='checkbox' value="1" <?php if($this->options['social_after_content'] == 1) echo "checked"; ?> /></span>
					<span><?php _e('After content',WP_SOCIAL_RING) ?></span>
				</li>
			</ul>
		<?php
	}
	
	function active_buttons_setting() {
	?>
		<ul>
			<li style="clear:both;">
				<div style="float:left;"><input id='social_facebook_like_button' name='wp_social_ring_options[social_facebook_like_button]' type='checkbox' value="1" <?php checked($this->options['social_facebook_like_button'], 1); ?> /></div>
				<div style="float:left;margin-left:20px;width:150px;"><?php _e('Facebook Like',WP_SOCIAL_RING) ?></div>
				<div style="float:left;margin-left:20px;"><fb:like href="http://www.facebook.com/pages/DrWordPress/166397626712895" send="false" showfaces="false" width="108" layout="button_count" action="like"/></fb:like></div>
			</li>
			<li style="clear:both;padding-top:10px;">
				<div style="float:left;"><input id='social_facebook_send_button' name='wp_social_ring_options[social_facebook_send_button]' type='checkbox' value="1" <?php checked($this->options['social_facebook_send_button'], 1); ?> /></div>
				<div style="float:left;margin-left:20px;width:150px;"><?php _e('Facebook Send',WP_SOCIAL_RING) ?></div>
				<div style="float:left;margin-left:20px;"><fb:like href="http://www.facebook.com/pages/DrWordPress/166397626712895" send="true" showfaces="false" width="164" layout="button_count" action="like"/></fb:like></div>
				<div id="fb-root"></div>
			</li>
			<li style="clear:both;padding-top:10px;">
				<div style="float:left;"><input id='social_facebook_share_button' name='wp_social_ring_options[social_facebook_share_button]' type='checkbox' value="1" <?php checked($this->options['social_facebook_share_button'], 1); ?> /></div>
				<div style="float:left;margin-left:20px;width:150px;"><?php _e('Facebook Share',WP_SOCIAL_RING) ?></div>
				<div style="float:left;margin-left:20px;"><fb:share-button expr:href="http://wordpress.altervista.org/" width="140" type="button_count"></fb:share></div>
			</li>
			<li style="clear:both;padding-top:10px;">
				<div style="float:left;"><input id='social_twitter_button' name='wp_social_ring_options[social_twitter_button]' type='checkbox' value="1" <?php checked($this->options['social_twitter_button'], 1); ?> /></div>
				<div style="float:left;margin-left:20px;width:150px;"><?php _e('Twitter',WP_SOCIAL_RING) ?></div>
				<div style="float:left;margin-left:20px;"><a href="http://twitter.com/share" lang="<?php echo $this->options['twitter_language']; ?>" data-url="<?php echo site_url(); ?>" data-text="<?php _e('I use WordPress Social Ring on my blog', WP_SOCIAL_RING); ?>" data-via="dottorwordpress" data-count="horizontal" class="sr-twitter-button twitter-share-button"></a></div>
			</li>
			<li style="clear:both;padding-top:10px;">
				<div style="float:left;"><input id='social_google_button' name='wp_social_ring_options[social_google_button]' type='checkbox' value="1" <?php checked($this->options['social_google_button'], 1); ?> /></div>
				<div style="float:left;margin-left:20px;width:150px;"><?php _e('Google +1',WP_SOCIAL_RING) ?></div>
				<div style="float:left;margin-left:20px;"><g:plusone href="<?php _e('http://wordpress.altervista.org/', WP_SOCIAL_RING); ?>" size="medium" callback="plusone_vote"></g:plusone></div>
				<script type="text/javascript">
					window.___gcfg = {
					  lang: '<?php echo $this->options['google_language']; ?>'
					};
				</script>
			</li>
			
			<li style="clear:both;padding-top:10px;">
				<div style="float:left;"><input id='social_linkedin_button' name='wp_social_ring_options[social_linkedin_button]' type='checkbox' value="1" <?php checked($this->options['social_linkedin_button'], 1); ?> /></div>
				<div style="float:left;margin-left:20px;width:150px;"><?php _e('LinkedIn',WP_SOCIAL_RING) ?></div>
				<div style="float:left;margin-left:20px;"><div class="social-ring-button"><script type="IN/Share" data-url="http://wordpress.altervista.org/" data-counter="right"></script></div>
			</li>
			
			<li style="clear:both;padding-top:10px;">
				<div style="float:left;"><input id='social_pin_it_button' name='wp_social_ring_options[social_pin_it_button]' type='checkbox' value="1" <?php checked($this->options['social_pin_it_button'], 1); ?> /></div>
				<div style="float:left;margin-left:20px;width:150px;"><?php _e('Pin it',WP_SOCIAL_RING) ?></div>
				<div style="float:left;margin-left:20px;"><a href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(__('http://wordpress.altervista.org/', WP_SOCIAL_RING)); ?>&media=<?php echo urlencode('http://wordpress.altervista.org/logo.jpg'); ?>&description=<?php echo urlencode(__('WordPress tutorials, plugin and themes.', WP_SOCIAL_RING)." ".site_url()); ?>" class="pin-it-button" count-layout="horizontal"></a></div>
			</li>
			<li style="clear:both;padding-top:10px;">
				<div style="float:left;"><input id='social_stumble_button' name='wp_social_ring_options[social_stumble_button]' type='checkbox' value="1" <?php checked($this->options['social_stumble_button'], 1); ?> /></div>
				<div style="float:left;margin-left:20px;width:150px;"><?php _e('StumbleUpon',WP_SOCIAL_RING) ?></div>
				<div style="float:left;margin-left:20px;"><su:badge layout="1"></su:badge></div>
			</li>
		</ul>
	<?php
	}
	
	function show_on_setting() {
	?>
		<ul>
			<li>
				<span><input id='social_on_home' name='wp_social_ring_options[social_on_home]' type='checkbox' value="1" <?php checked($this->options['social_on_home'], 1); ?> /></span>
				<span><?php _e('Home',WP_SOCIAL_RING) ?></span>
			</li>
			<li>
				<span><input id='social_on_pages' name='wp_social_ring_options[social_on_pages]' type='checkbox' value="1" <?php checked($this->options['social_on_pages'], 1); ?> /></span>
				<span><?php _e('Pages',WP_SOCIAL_RING) ?></span>
			</li>
			<li>
				<span><input id='social_on_posts' name='wp_social_ring_options[social_on_posts]' type='checkbox' value="1" <?php checked($this->options['social_on_posts'], 1); ?> /></span>
				<span><?php _e('Posts',WP_SOCIAL_RING) ?></span>
			</li>
			<li>
				<span><input id='social_on_category' name='wp_social_ring_options[social_on_category]' type='checkbox' value="1" <?php checked($this->options['social_on_category'], 1); ?> /></span>
				<span><?php _e('Categories',WP_SOCIAL_RING) ?></span>
			</li>
			<li>
				<span><input id='social_on_archive' name='wp_social_ring_options[social_on_archive]' type='checkbox' value="1" <?php checked($this->options['social_on_archive'], 1); ?> /></span>
				<span><?php _e('Archive',WP_SOCIAL_RING) ?></span>
			</li>
		</ul>
	<?php
	}
	
	function language_setting() {
		?>
		<select id="language" name="wp_social_ring_options[language]">
		<?php foreach ($this->languages as $lang => $codes) { ?>
			<option value="<?php echo $lang; ?>" <?php selected($this->options['language'], $lang); ?>><?php echo $lang; ?></option>
		<?php } ?>
		</select>
		* <?php _e('LinkedIn, Pin It and StumbleUpon don\'t support localization', WP_SOCIAL_RING); ?>
		<?php
	}

	function validate_options( $input ) {
		$valid['social_facebook_like_button'] = (isset( $input['social_facebook_like_button'])) ? 1 : 0;
		$valid['social_facebook_send_button'] = (isset( $input['social_facebook_send_button'])) ? 1 : 0;
		if($valid['social_facebook_send_button'] == 1) {
			$valid['social_facebook_like_button'] = 1;
		}
		$valid['social_facebook_share_button'] = (isset( $input['social_facebook_share_button'])) ? 1 : 0;
		$valid['social_twitter_button'] = (isset( $input['social_twitter_button'])) ? 1 : 0;
		$valid['social_google_button'] = (isset( $input['social_google_button'])) ? 1 : 0;
		$valid['social_pin_it_button'] = (isset( $input['social_pin_it_button'])) ? 1 : 0;
		$valid['social_linkedin_button'] = (isset( $input['social_linkedin_button'])) ? 1 : 0;
		$valid['social_stumble_button'] = (isset( $input['social_stumble_button'])) ? 1 : 0;
		$valid['social_on_home'] = (isset( $input['social_on_home'])) ? 1 : 0;
		$valid['social_on_pages'] = (isset( $input['social_on_pages'])) ? 1 : 0;
		$valid['social_on_posts'] = (isset( $input['social_on_posts'])) ? 1 : 0;
		$valid['social_on_category'] = (isset( $input['social_on_category'])) ? 1 : 0;
		$valid['social_on_archive'] = (isset( $input['social_on_archive'])) ? 1 : 0;
		$valid['social_before_content'] = (isset( $input['social_before_content'])) ? 1 : 0;
		$valid['social_after_content'] = (isset( $input['social_after_content'])) ? 1 : 0;
		$valid['button_counter'] = ($input['button_counter'] == 'vertical') || ($input['button_counter'] == 'none') ? $input['button_counter'] : 'horizontal';
		if(isset($this->languages[$input['language']])) {
			$valid['language'] = $input['language'];
			$valid['facebook_language'] = $this->languages[$input['language']]['Facebook'];
			$valid['google_language'] = $this->languages[$input['language']]['Google'];
			$valid['twitter_language'] = $this->languages[$input['language']]['Twitter'];
		}
		return $valid;
	}

}

new WordPress_Social_Ring_Admin();

?>