<?php
/**
 * @package Tweet is
 */
class Tweet_dis_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'tweet_dis_widget',
			__( 'Tweet Dis Widget' ),
			array( 'description' => __( 'Display the number of spam comments Pindis has caught' ) )
		);
        $this->create_table();
	}
    
	function create_table() {
		global $wpdb;
        $table_seting_tabs = $wpdb->prefix . "tweetdis_seting_tabs";
        $table_seting = $wpdb->prefix . "tweetdis_setings";
        $table_lic = $wpdb->prefix . "tweetdis";       

        if($wpdb->get_var("SHOW TABLES LIKE '$table_lic'") != $table_lic){

            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            $sql = "CREATE TABLE IF NOT EXISTS `" . $wpdb->prefix . "tweetdis` (
              `domain` text NOT NULL,
              `key` text NOT NULL,
              `time` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
              `active` INT(8) DEFAULT NULL
              ) DEFAULT CHARSET=utf8;";
            dbDelta($sql);
            $sql = "Insert into `" . $wpdb->prefix . "tweetdis` values('".$_SERVER['SERVER_NAME']."','none',now(),0)";
            $wpdb->query($sql);
        }
        if($wpdb->get_var("SHOW TABLES LIKE '$table_seting_tabs'") != $table_seting_tabs){
          
            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            $sql = "CREATE TABLE IF NOT EXISTS `".$table_seting_tabs."` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `tabs` int(11) NOT NULL,
              `preset` varchar(11) NOT NULL,
              `font_family` varchar(255) NOT NULL,
              `font_size` int(11) NOT NULL,
              `font_color` varchar(255) NOT NULL,
              `hover_color` varchar(255) NOT NULL,
              `marginvertical` int(11) NOT NULL,
              `marginhorisontal` int(11) NOT NULL,
              `callforaction` varchar(255) NOT NULL,
              `fontsizeaction` int(11) NOT NULL,
              `link_style` varchar(255) NOT NULL,
              `thikness` int(11) NOT NULL,
              `font_family_call` varchar(255) NOT NULL,
              `background_color` varchar(255) NOT NULL,
              `Call_to_action_color` varchar(255) NOT NULL,
              `active` int(1) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1;";
            dbDelta($sql);
            

             $wpdb->insert( $table_seting_tabs, array( 'tabs' => 1, 'preset' => 'box_1', 'font_family' => 'Montserrat', 'font_size' => 30, 'font_color' => '#333333', 'hover_color' => '#333333', 'marginvertical' => 10, 'marginhorisontal' => 10, 'callforaction' => 'Click to tweet', 'fontsizeaction' => 12, 'link_style' => '', 'thikness' => 0, 'font_family_call' => '', 'background_color' => '', 'Call_to_action_color' => '', 'active' => 1 ), array( '%d', '%s', '%s', '%d', '%s', '%s', '%d', '%d', '%s', '%d', '%s', '%d', '%s', '%s', '%s', '%d' ) );
             $wpdb->insert( $table_seting_tabs, array( 'tabs' => 1, 'preset' => 'box_2', 'font_family' => 'PT Serif', 'font_size' => 30, 'font_color' => '#333333', 'hover_color' => '#333333', 'marginvertical' => 10, 'marginhorisontal' => 10, 'callforaction' => 'Click to tweet', 'fontsizeaction' => 12, 'link_style' => '', 'thikness' => 0, 'font_family_call' => '', 'background_color' => '', 'Call_to_action_color' => '', 'active' => 0 ), array( '%d', '%s', '%s', '%d', '%s', '%s', '%d', '%d', '%s', '%d', '%s', '%d', '%s', '%s', '%s', '%d' ) );
             $wpdb->insert( $table_seting_tabs, array( 'tabs' => 1, 'preset' => 'box_3', 'font_family' => 'Roboto', 'font_size' => 30, 'font_color' => '#333333', 'hover_color' => '#ffffff', 'marginvertical' => 10, 'marginhorisontal' => 10, 'callforaction' => 'Click to tweet', 'fontsizeaction' => 12, 'link_style' => '', 'thikness' => 0, 'font_family_call' => '', 'background_color' => '', 'Call_to_action_color' => '', 'active' => 0 ), array( '%d', '%s', '%s', '%d', '%s', '%s', '%d', '%d', '%s', '%d', '%s', '%d', '%s', '%s', '%s', '%d' ) );
             $wpdb->insert( $table_seting_tabs, array( 'tabs' => 1, 'preset' => 'box_4', 'font_family' => 'Open Sans Condensed', 'font_size' => 22, 'font_color' => '#333333', 'hover_color' => '#333333', 'marginvertical' => 10, 'marginhorisontal' => 10, 'callforaction' => 'Click to tweet', 'fontsizeaction' => 12, 'link_style' => '', 'thikness' => 0, 'font_family_call' => '', 'background_color' => '', 'Call_to_action_color' => '', 'active' => 0 ), array( '%d', '%s', '%s', '%d', '%s', '%s', '%d', '%d', '%s', '%d', '%s', '%d', '%s', '%s', '%s', '%d' ) );
             $wpdb->insert( $table_seting_tabs, array( 'tabs' => 1, 'preset' => 'box_5', 'font_family' => 'Mate', 'font_size' => 22, 'font_color' => '#333333', 'hover_color' => '#333333', 'marginvertical' => 10, 'marginhorisontal' => 10, 'callforaction' => 'Click to tweet', 'fontsizeaction' => 12, 'link_style' => '', 'thikness' => 0, 'font_family_call' => '', 'background_color' => '', 'Call_to_action_color' => '', 'active' => 0 ), array( '%d', '%s', '%s', '%d', '%s', '%s', '%d', '%d', '%s', '%d', '%s', '%d', '%s', '%s', '%s', '%d' ) );
             $wpdb->insert( $table_seting_tabs, array( 'tabs' => 1, 'preset' => 'box_6', 'font_family' => 'Roboto', 'font_size' => 24, 'font_color' => '#FFFFFF', 'hover_color' => '#676767', 'marginvertical' => 10, 'marginhorisontal' => 10, 'callforaction' => 'Click to tweet', 'fontsizeaction' => 12, 'link_style' => '', 'thikness' => 0, 'font_family_call' => '', 'background_color' => '', 'Call_to_action_color' => '', 'active' => 0 ), array( '%d', '%s', '%s', '%d', '%s', '%s', '%d', '%d', '%s', '%d', '%s', '%d', '%s', '%s', '%s', '%d' ) );
             $wpdb->insert( $table_seting_tabs, array( 'tabs' => 1, 'preset' => 'box_7', 'font_family' => 'Open Sans', 'font_size' => 20, 'font_color' => '#5f5f5f', 'hover_color' => '#5f5f5f', 'marginvertical' => 10, 'marginhorisontal' => 10, 'callforaction' => 'Click to tweet', 'fontsizeaction' => 12, 'link_style' => '', 'thikness' => 0, 'font_family_call' => '', 'background_color' => '', 'Call_to_action_color' => '', 'active' => 0 ), array( '%d', '%s', '%s', '%d', '%s', '%s', '%d', '%d', '%s', '%d', '%s', '%d', '%s', '%s', '%s', '%d' ) );
            
             $wpdb->insert( $table_seting_tabs, array( 'tabs' => 2, 'preset' => 'hint_1', 'font_family' => '', 'font_size' => 0, 'font_color' => '#f50505', 'hover_color' => '#75c781', 'marginvertical' => 0, 'marginhorisontal' => 0, 'callforaction' => 'Tweet this!', 'fontsizeaction' => 18, 'link_style' => 'none', 'thikness' => 1, 'font_family_call' => 'Georgia', 'background_color' => '#6e9b76', 'Call_to_action_color' => '#ffffff', 'active' => 1 ), array( '%d', '%s', '%s', '%d', '%s', '%s', '%d', '%d', '%s', '%d', '%s', '%d', '%s', '%s', '%s', '%d' ) );
             $wpdb->insert( $table_seting_tabs, array( 'tabs' => 2, 'preset' => 'hint_2', 'font_family' => '', 'font_size' => 0, 'font_color' => '#f50505', 'hover_color' => '#75c781', 'marginvertical' => 0, 'marginhorisontal' => 0, 'callforaction' => 'Tweet this!', 'fontsizeaction' => 18, 'link_style' => 'none', 'thikness' => 1, 'font_family_call' => 'Georgia', 'background_color' => '""', 'Call_to_action_color' => '#6e9b76', 'active' => 0 ), array( '%d', '%s', '%s', '%d', '%s', '%s', '%d', '%d', '%s', '%d', '%s', '%d', '%s', '%s', '%s', '%d' ) );
             $wpdb->insert( $table_seting_tabs, array( 'tabs' => 2, 'preset' => 'hint_3', 'font_family' => '', 'font_size' => 0, 'font_color' => '#f50505', 'hover_color' => '#75c781', 'marginvertical' => 0, 'marginhorisontal' => 0, 'callforaction' => 'Tweet this!', 'fontsizeaction' => 18, 'link_style' => 'none', 'thikness' => 1, 'font_family_call' => 'Georgia', 'background_color' => '#f0efe1', 'Call_to_action_color' => '#00ade8', 'active' => 0 ), array( '%d', '%s', '%s', '%d', '%s', '%s', '%d', '%d', '%s', '%d', '%s', '%d', '%s', '%s', '%s', '%d' ) );
             $wpdb->insert( $table_seting_tabs, array( 'tabs' => 2, 'preset' => 'hint_4', 'font_family' => '', 'font_size' => 0, 'font_color' => '#f50505', 'hover_color' => '#75c781', 'marginvertical' => 0, 'marginhorisontal' => 0, 'callforaction' => 'Tweet this!', 'fontsizeaction' => 18, 'link_style' => 'none', 'thikness' => 1, 'font_family_call' => 'Georgia', 'background_color' => '#ff6633', 'Call_to_action_color' => '#ffffff', 'active' => 0 ), array( '%d', '%s', '%s', '%d', '%s', '%s', '%d', '%d', '%s', '%d', '%s', '%d', '%s', '%s', '%s', '%d' ) );
             $wpdb->insert( $table_seting_tabs, array( 'tabs' => 2, 'preset' => 'hint_5', 'font_family' => '', 'font_size' => 0, 'font_color' => '#f50505', 'hover_color' => '#75c781', 'marginvertical' => 0, 'marginhorisontal' => 0, 'callforaction' => 'Tweet this!', 'fontsizeaction' => 18, 'link_style' => 'none', 'thikness' => 3, 'font_family_call' => 'Georgia', 'background_color' => '#00acff', 'Call_to_action_color' => '#ffffff', 'active' => 0 ), array( '%d', '%s', '%s', '%d', '%s', '%s', '%d', '%d', '%s', '%d', '%s', '%d', '%s', '%s', '%s', '%d' ) );
        }
        
		if($wpdb->get_var("SHOW TABLES LIKE '$table_seting'") != $table_seting) {
       			
		    $sql = "CREATE TABLE IF NOT EXISTS `".$table_seting."` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `preposition` varchar(255) NOT NULL,
              `twitter_account` varchar(255) NOT NULL,
              `shortener` varchar(255) NOT NULL,
              `login` varchar(255) NOT NULL,
              `password` varchar(255) NOT NULL,
              `access_token` varchar(255) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1";

		    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		    dbDelta($sql);
            $wpdb->insert( $table_seting, array( 'preposition' => 'none', 'twitter_account' => '', 'shortener' => 'tinyurl.com', 'login' => '', 'password' => '', 'access_token' => 'no_conect' ), array( '%s', '%s', '%s', '%s', '%s', '%s') );
        }                              
	}
}

 function file_get_contents_curl_td_tweet_dis($url) {
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    
    $data = curl_exec($ch);
    curl_close($ch);
    
    return $data;
}


function tweet_dis_register_widgets() {
	register_widget( 'Tweet_dis_Widget' );
}

add_action( 'widgets_init', 'tweet_dis_register_widgets' );

function td_hint($attr, $text=''){
    global $wpdb;
     $table_seting_tabs = $wpdb->prefix . "tweetdis_seting_tabs";
     $table_seting = $wpdb->prefix . "tweetdis_setings";
    $res_seting_tabs = $wpdb->get_results( "SELECT * FROM $table_seting_tabs WHERE tabs = 2 AND active=1" );
        $res_seting = $wpdb->get_results( "SELECT * FROM $table_seting" );


    $urlShrt=$res_seting[0]->shortener;
    $turl='';
    if ( $urlShrt == 'tinyurl.com' ) {
        $turl = getTinyUrlTD(get_permalink());
    } else if  ( $urlShrt == 'bit.ly' )  {
        $turl = getBitLyUrlTd(get_permalink());
    } else {
        $turl = get_permalink();
    }
    
    
    $tweetname = $res_seting[0]->twitter_account;
    $by=$res_seting[0]->preposition;
    if($by=='via'){$by=' via @';}
    elseif($by=='by'){$by=' by @';}
    elseif ($by=='none') { $by=' @';}
    elseif ($by=='RT') { $by='RT @';}
    //$urln=strlen($turl)+1;
    $urln=22;
    $vialn= 0;
    if($tweetname) $vialn= strlen ($by.$tweetname);
    $limitLen=140-$vialn-$urln;

    
    $text = strip_tags(html_entity_decode($text, ENT_QUOTES, 'UTF-8'));
    $cont=do_shortcode($text);
     
    $cont=preg_replace('#<[^>]+>#', ' ', $cont);
    $contLen = strlen($cont);
    if ( strlen($cont) >= $limitLen ) {
        $cont = substr($cont,0,$limitLen);
        $lastSpace = strrpos($cont, ' ');
        $cont = substr($cont,0,$lastSpace);

        if ( strlen($cont) <= ($limitLen-3) ) {
            $cont .= (substr($cont, -1) == '.') ? '..' : '...';
        }
    }
    $rel = 'https://twitter.com/intent/tweet?lang=en&text=';
    if ($by == 'RT @') $rel .= $by.$tweetname.' ';
    //if ($by == ' @') $rel .= $by.$tweetname.' ';
    $rel .= urlencode($cont);
    $data_url='';
    $rel .= ' '.$turl;
   // if($by == 'none') $by=' @';
    if ( $tweetname && $by != 'RT @' ) $rel .= $by.$tweetname;
    $rel .= '&count=none';
    wp_register_style( 'tweet_dis_css_site.css', TWEET_DIS_PLUGIN_URL . 'css/tweet_dis_css_site.css', array(), '2.5.9' );
    wp_enqueue_style( 'tweet_dis_css_site.css');
    
    wp_register_script( 'td_site.js', TWEET_DIS_PLUGIN_URL . 'js/td_site.js', array('jquery') );
    wp_enqueue_script( 'td_site.js' );
    wp_localize_script( 'td_site.js', 'WPTweetDis', array(
        'comment_author_url_nonce' => wp_create_nonce( 'comment_author_url_nonce' )
    ) );
   // print_r($rel); 
    $out = ' 

       <style>
       .defaultDsgn{
           display:none;
       }
       .blankyDsgn{
           display:none;
       }
       .edgebirdDsgn{
            display:none;
       }
       .coginuDsgn{
           display:none;
       }
       .gigabugDsgn{
           display:none;
       }
       .tweet:hover{
           color:'.$res_seting_tabs[0]->hover_color.'!important;
       }
       </style> ' ;

           
            //$text = $cont;
            $out .= '<input type="hidden" class="hint_type" value="'.$res_seting_tabs[0]->preset.'">';
      if($res_seting_tabs[0]->preset == 'hint_1') {
                       $out .= '<span class="tweetdis_bl tweet tip" style="color: '.$res_seting_tabs[0]->font_color.'">
                            <a '.$data_url.' href="'.$rel.'" onclick="window.open(this.href,\'_blank\',\'width=500,height=500\'); return false;" style="border-bottom-style: '.$res_seting_tabs[0]->link_style.'; border-bottom-width: '.$res_seting_tabs[0]->thikness.'px;">
                                '.$text.'
                            </a>
                            <span style="color: '.$res_seting_tabs[0]->Call_to_action_color.'; margin-top: -51px; margin-left: 0px; opacity: 1; visibility: visible; background: '.$res_seting_tabs[0]->background_color.';" class="cloud defaultDsgn">
                                <span class="cloudP" style="font-size: '.$res_seting_tabs[0]->fontsizeaction.'px; font-family: '.$res_seting_tabs[0]->font_family_call.'; background: transparent;">
                                    <span class="bird" style="background-color: rgb(255, 255, 255);">
                                        <img src="'.TWEET_DIS_PLUGIN_URL.'images/bird.png" alt="">
                                    </span>
                                    <span class="cloudPText">'.$res_seting_tabs[0]->callforaction.'</span>            </span>
                                                <span class="arrow" style="border-top-color:  '.$res_seting_tabs[0]->background_color.';"></span>
                                                <span class="arrowRght"></span>
                                <span class="cloudBrd" style="background-color:  '.$res_seting_tabs[0]->background_color.';">
                                    <span class="arrowRght2" style="border-top-color:  '.$res_seting_tabs[0]->background_color.';"></span>
                                    <span class="arrow" style="border-top-color:  '.$res_seting_tabs[0]->background_color.';"></span>
                                </span>
                            </span>
                        </span>';
                       } else if($res_seting_tabs[0]->preset == 'hint_2') {
                        
                            $out .= '<span class="tweetdis_bl tweet tip" style="color: '.$res_seting_tabs[0]->font_color.';">
                                             <a '.$data_url.' href="'.$rel.'" onclick="window.open(this.href,\'_blank\',\'width=500,height=500\'); return false;" style="border-bottom-style: '.$res_seting_tabs[0]->link_style.'; border-bottom-width: '.$res_seting_tabs[0]->thikness.'px;">
                                                '.$text.'
                                            </a>
                                                <span style="color: '.$res_seting_tabs[0]->Call_to_action_color.'; margin-top: -10px; margin-left: 0px; opacity: 1; visibility: visible; background: '.$res_seting_tabs[0]->background_color.';" class="cloud blankyDsgn">
                                    <span class="cloudP" style="font-size: '.$res_seting_tabs[0]->fontsizeaction.'px; font-family: '.$res_seting_tabs[0]->font_family_call.'; background: transparent;">
                                        <span class="bird" style="background-color: rgb(110, 155, 118);">
                                            <img src="'.TWEET_DIS_PLUGIN_URL.'images/bird.png" alt="">
                                        </span>
                                        <span class="cloudPText">'.$res_seting_tabs[0]->callforaction.'</span>            </span>
                                                    <span class="arrow" style="border-top-color: '.$res_seting_tabs[0]->background_color.';"></span>
                                                    <span class="arrowRght"></span>
                                    <span class="cloudBrd" style="background-color: '.$res_seting_tabs[0]->background_color.';">
                                        <span class="arrowRght2" style="border-top-color: '.$res_seting_tabs[0]->background_color.';"></span>
                                        <span class="arrow" style="border-top-color: '.$res_seting_tabs[0]->background_color.';"></span>
                                    </span>
                                </span>
                            </span>';
                         } else if($res_seting_tabs[0]->preset == 'hint_3') {
                        
                            $out .= '<span class="tweetdis_bl tweet tip" style="color: '.$res_seting_tabs[0]->font_color.';">
                                         <a '.$data_url.' href="'.$rel.'" onclick="window.open(this.href,\'_blank\',\'width=500,height=500\'); return false;" style="border-bottom-style: '.$res_seting_tabs[0]->link_style.'; border-bottom-width: '.$res_seting_tabs[0]->thikness.'px;">
                                            '.$text.'
                                        </a>
                                        <span style="color:  '.$res_seting_tabs[0]->Call_to_action_color.'; margin-top: -10px; margin-left: 0px; opacity: 1; visibility: visible; border-color: '.$res_seting_tabs[0]->background_color.'; background: '.$res_seting_tabs[0]->background_color.';" class="cloud edgebirdDsgn">
                            <span class="cloudP" style="font-size: '.$res_seting_tabs[0]->fontsizeaction.'px; font-family: '.$res_seting_tabs[0]->font_family_call.'; background: transparent;">
                                <span class="bird" style="background-color: '.$res_seting_tabs[0]->Call_to_action_color.';">
                                    <img src="'.TWEET_DIS_PLUGIN_URL.'images/bird-new.png" alt="">
                                </span>
                                <span class="cloudPText">'.$res_seting_tabs[0]->callforaction.'</span>            </span>
                                            <span class="arrow" style="border-top-color: '.$res_seting_tabs[0]->background_color.';"></span>
                                            <span class="arrowRght" style="border-top-color: '.$res_seting_tabs[0]->background_color.';"></span>
                            <span class="cloudBrd" style="background-color: '.$res_seting_tabs[0]->background_color.';">
                                <span class="arrowRght2" style="border-top-color: '.$res_seting_tabs[0]->background_color.';"></span>
                                <span class="arrow" style="border-top-color: '.$res_seting_tabs[0]->background_color.';"></span>
                            </span>
                            </span>
                        </span>';
                         } else if($res_seting_tabs[0]->preset == 'hint_4') {
                        
                            $out .= '<span class="tweetdis_bl tweet tip" style="color: '.$res_seting_tabs[0]->font_color.';">
                            <a '.$data_url.' href="'.$rel.'" onclick="window.open(this.href,\'_blank\',\'width=500,height=500\'); return false;" style="border-bottom-style: '.$res_seting_tabs[0]->link_style.'; border-bottom-width: '.$res_seting_tabs[0]->thikness.'px;">
                                '.$text.'
                            </a>
                            <span style="color: '.$res_seting_tabs[0]->Call_to_action_color.'; margin-top: -10px; margin-left: 0px; opacity: 1; visibility: visible; border-color: rgb(240, 239, 225); background: '.$res_seting_tabs[0]->background_color.';" class="cloud coginuDsgn">
                            <span class="cloudP" style="font-size: '.$res_seting_tabs[0]->fontsizeaction.'px; font-family: '.$res_seting_tabs[0]->font_family_call.'; background: '.$res_seting_tabs[0]->background_color.';">
                                <span class="bird" style="background-color: rgb(255, 255, 255);">
                                    <img src="'.TWEET_DIS_PLUGIN_URL.'images/bird.png" alt="">
                                </span>
                                <span class="cloudPText">'.$res_seting_tabs[0]->callforaction.'</span>           </span>
                                            <span class="arrow" style="border-top-color: '.$res_seting_tabs[0]->background_color.';"></span>
                                            <span class="arrowRght" style="border-top-color: '.$res_seting_tabs[0]->background_color.';"></span>
                            <span class="cloudBrd" style="background: '.$res_seting_tabs[0]->background_color.';">
                                <span class="arrowRght2" style="border-top-color: '.$res_seting_tabs[0]->background_color.';"></span>
                                <span class="arrow" style="border-top-color: '.$res_seting_tabs[0]->background_color.';"></span>
                            </span>
                            </span>
                        </span>';
                         } else if($res_seting_tabs[0]->preset == 'hint_5') {
                            $out .= ' <script>
                                 jQuery(document).ready(function(){ 
                                      
                                    var col_hsl2 = colorLuminance2("'.$res_seting_tabs[0]->background_color.'", 55);
                                    jQuery(".cloud").css("background", "-webkit-gradient(linear, 0% 0%, 0% 100%, from("+col_hsl2+"), to( '.$res_seting_tabs[0]->background_color.'))");
                                 });
                             </script>
                             
                           <span class="tweetdis_bl tweet tip" style="color: '.$res_seting_tabs[0]->font_color.';">
                             <a '.$data_url.' href="'.$rel.'" onclick="window.open(this.href,\'_blank\',\'width=500,height=500\'); return false;" style="border-bottom-style: '.$res_seting_tabs[0]->link_style.'; border-bottom-width: '.$res_seting_tabs[0]->thikness.'px;">
                                '.$text.'
                            </a>
                            <span style="color: '.$res_seting_tabs[0]->Call_to_action_color.'; margin-top: -10px; margin-left: 0px; opacity: 1; visibility: visible; border-color: '.$res_seting_tabs[0]->background_color.'; background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(rgb(0, 255, 255)), to('.$res_seting_tabs[0]->background_color.'));" class="cloud gigabugDsgn">
                                <span class="cloudP" style="font-size: '.$res_seting_tabs[0]->fontsizeaction.'px; font-family: '.$res_seting_tabs[0]->font_family_call.'; background: transparent;">
                                    <span class="bird" style="background-color: rgb(255, 255, 255);">
                                        <img src="'.TWEET_DIS_PLUGIN_URL.'images/bird.png" alt="">
                                    </span>
                                    <span class="cloudPText">'.$res_seting_tabs[0]->callforaction.'</span>            </span>
                                                <span class="arrow" style="border-top-color: '.$res_seting_tabs[0]->background_color.';"></span>
                                                <span class="arrowRght" style="border-top-color: '.$res_seting_tabs[0]->background_color.';"></span>
                                <span class="cloudBrd" style="background: '.$res_seting_tabs[0]->background_color.';">
                                    <span class="arrowRght2" style="border-top-color: '.$res_seting_tabs[0]->background_color.';"></span>
                                    <span class="arrow" style="border-top-color: '.$res_seting_tabs[0]->background_color.';"></span>
                                </span>
                            </span>
                        </span> ';
                         } 
                            return $out;
                        
}

add_shortcode('tweet_dis', 'td_hint'); 

function td_box($attr, $text=''){
    global $wpdb;
    $table_seting_tabs = $wpdb->prefix . "tweetdis_seting_tabs";
     $table_seting = $wpdb->prefix . "tweetdis_setings";
    $res_seting_tabs = $wpdb->get_results( "SELECT * FROM $table_seting_tabs WHERE tabs = 1 AND active=1" );
    $res_seting = $wpdb->get_results( "SELECT * FROM $table_seting" );
    
    /*extract(shortcode_atts(array(
        'id' => get_the_author_meta('ID')
    ), $atts)); */ 


    $urlShrt=$res_seting[0]->shortener;
    $turl='';
    if ( $urlShrt == 'tinyurl.com' ) {
        $turl = getTinyUrlTD(get_permalink());
    } else if  ( $urlShrt == 'bit.ly' )  {
        $turl = getBitLyUrlTd(get_permalink());
    } else {
        $turl = get_permalink();
    }
    
    
    $tweetname = $res_seting[0]->twitter_account;
    $by=$res_seting[0]->preposition;
    
    if($by=='via'){$by=' via @';}
    elseif($by=='by'){$by=' by @';}
    elseif ($by=='none') { $by=' @';}
    elseif ($by=='RT') { $by='RT @';}
    //$urln=strlen($turl)+1;
    $urln=22;
    $vialn= 0;
    if($tweetname) $vialn= strlen ($by.$tweetname);
    $limitLen=140-$vialn-$urln;
    $text = strip_tags(html_entity_decode($text, ENT_QUOTES, 'UTF-8'));
    $cont=do_shortcode($text);
    $cont=preg_replace('#<[^>]+>#', ' ', $cont);
    $contLen = strlen($cont); 
    if ( strlen($cont) >= $limitLen ) {
        $cont = substr($cont,0,$limitLen);
        $lastSpace = strrpos($cont, ' ');
        $cont = substr($cont,0,$lastSpace);

        if ( strlen($cont) <= ($limitLen-3) ) {
            $cont .= (substr($cont, -1) == '.') ? '..' : '...';
        }
    }
    $rel = 'https://twitter.com/intent/tweet?lang=en&text=';
    if ($by == 'RT @') $rel .= $by.$tweetname.' ';
    //if ($by == ' @') $rel .= $by.$tweetname.' ';
    $rel .= urlencode($cont);
    $rel .= ' '.$turl;
    if ( $tweetname && $by != 'RT @' ) $rel .= $by.$tweetname;
    $rel .= '&count=none'; 
    
    wp_register_style( 'tweet_dis_css_site.css', TWEET_DIS_PLUGIN_URL . 'css/tweet_dis_css_site.css', array(), '2.5.9' );
    wp_enqueue_style( 'tweet_dis_css_site.css'); 
    $out = ' 
    <script type="text/javascript">
        jQuery(document).ready(function () {
             jQuery(".tweet-box").hover(          
                  function () {
                    jQuery(this).find("p").css("color", "'.$res_seting_tabs[0]->hover_color.'");
                  },
                  function () {
                    jQuery(this).find("p").css("color", "'.$res_seting_tabs[0]->font_color.'");
                  }
            );
        });
     </script> ';
          $line_h = $res_seting_tabs[0]->font_size/2;
          $line_h = round($line_h, 0);
          if($res_seting_tabs[0]->preset=='box_1'){ 
                                   $out .= ' <div class="tweetdis_bl tweets-block-wrap tweet-box" style="margin: '.$res_seting_tabs[0]->marginvertical.'px '.$res_seting_tabs[0]->marginhorisontal.'px;">
                                        <a class="tweet-box-link tweets-themes-01" href="" onclick="window.open(\''.$rel.'\',\'_blank\',\'width=500,height=500\'); return false;">
                                            <p style="line-height: '.($res_seting_tabs[0]->font_size+$line_h).'px;font-size: '.$res_seting_tabs[0]->font_size.'px; font-family: \''.$res_seting_tabs[0]->font_family.'\'; color: '.$res_seting_tabs[0]->font_color.';">'.$text.'</p>
                                            <span class="clear">
                                            <span class="click-to-tweet" style="font-size: '.$res_seting_tabs[0]->fontsizeaction.'px;"><i></i>'.$res_seting_tabs[0]->callforaction.'</span> </span>
                                        </a>
                                    </div> ';
                                 } else if ($res_seting_tabs[0]->preset=='box_2'){
                                    $out .= '<div class="tweetdis_bl tweets-block-wrap tweet-box" style="margin: '.$res_seting_tabs[0]->marginvertical.'px '.$res_seting_tabs[0]->marginhorisontal.'px;">
                                        <a class="tweet-box-link tweets-themes-02" href="" onclick="window.open(\''.$rel.'\',\'_blank\',\'width=500,height=500\'); return false;">
                                        <p style="line-height: '.($res_seting_tabs[0]->font_size+$line_h).'px;font-size: '.$res_seting_tabs[0]->font_size.'px; font-family: \''.$res_seting_tabs[0]->font_family.'\'; color: '.$res_seting_tabs[0]->font_color.';">'.$text.'</p>
                                        <span class="clear">
                                        <span class="click-to-tweet" style="font-size: '.$res_seting_tabs[0]->fontsizeaction.'px;"><i></i>'.$res_seting_tabs[0]->callforaction.'</span> </span></a>
                                    </div>';
                                 } else if ($res_seting_tabs[0]->preset=='box_3'){
                                   $out .= '<div class="tweets-block-wrap tweet-box" style="margin: '.$res_seting_tabs[0]->marginvertical.'px '.$res_seting_tabs[0]->marginhorisontal.'px;">
                                    <a class="tweet-box-link tweets-themes-03" href="" onclick="window.open(\''.$rel.'\',\'_blank\',\'width=500,height=500\'); return false;">
                                        <p style="line-height: '.($res_seting_tabs[0]->font_size+$line_h).'px;font-size: '.$res_seting_tabs[0]->font_size.'px; font-family: \''.$res_seting_tabs[0]->font_family.'\'; color: '.$res_seting_tabs[0]->font_color.';">'.$text.'</p>
                                        <span class="clear">
                                        <span class="click-to-tweet" style="font-size: '.$res_seting_tabs[0]->fontsizeaction.'px;"><i></i>'.$res_seting_tabs[0]->callforaction.'</span> </span>
                                    </a>
                                    </div>';
                                 } else if ($res_seting_tabs[0]->preset=='box_4'){
                                   $out .= '<div class="tweetdis_bl tweets-block-wrap tweet-box" style="margin: '.$res_seting_tabs[0]->marginvertical.'px '.$res_seting_tabs[0]->marginhorisontal.'px;">
                                        <a class="tweet-box-link tweets-themes-04" href="" onclick="window.open(\''.$rel.'\',\'_blank\',\'width=500,height=500\'); return false;">
                                            <span class="clear">
                                            <span class="click-to-tweet" style="font-size: '.$res_seting_tabs[0]->fontsizeaction.'px;">'.$res_seting_tabs[0]->callforaction.'</span>
                                            <span class="quote-left-top"></span></span>
                                            <p style="line-height: '.($res_seting_tabs[0]->font_size+$line_h).'px;font-size: '.$res_seting_tabs[0]->font_size.'px; font-family: \''.$res_seting_tabs[0]->font_family.'\'; color: '.$res_seting_tabs[0]->font_color.';">'.$text.'</p>
                                        </a>
                                    </div>';
                                 } else if ($res_seting_tabs[0]->preset=='box_5'){
                                   $out .= '<div class="tweetdis_bl tweets-block-wrap tweet-box" style="margin: '.$res_seting_tabs[0]->marginvertical.'px '.$res_seting_tabs[0]->marginhorisontal.'px;">
                                        <a class="tweet-box-link tweets-themes-06" href="" onclick="window.open(\''.$rel.'\',\'_blank\',\'width=500,height=500\'); return false;">
                                        <span class="tweets-themes-06-top"></span>
                                        <span class="tweets-themes-06-left">
                                        <span class="tweets-themes-06-right">
                                        <p style="line-height: '.($res_seting_tabs[0]->font_size+$line_h).'px;font-size: '.$res_seting_tabs[0]->font_size.'px; font-family: \''.$res_seting_tabs[0]->font_family.'\'; color: '.$res_seting_tabs[0]->font_color.';">'.$text.'</p>
                                        <span class="clear">
                                        <span class="click-to-tweet" style="font-size: '.$res_seting_tabs[0]->fontsizeaction.'px;"><i></i>'.$res_seting_tabs[0]->callforaction.'</span></span></span></span>
                                        <span class="tweets-themes-06-bot"></span></a>
                                   </div>';
                                   
                                 } else if ($res_seting_tabs[0]->preset=='box_6'){
                                   $out .= '<div class="tweetdis_bl tweets-block-wrap tweet-box" style="margin: '.$res_seting_tabs[0]->marginvertical.'px '.$res_seting_tabs[0]->marginhorisontal.'px;">
                                    <a class="tweet-box-link tweets-themes-07" href="" onclick="window.open(\''.$rel.'\',\'_blank\',\'width=500,height=500\'); return false;">
                                        <span class="tweets-themes-07-bg">
                                        <span class="tweets-themes-07-bird">
                                        <p style="line-height: '.($res_seting_tabs[0]->font_size+$line_h).'px;font-size: '.$res_seting_tabs[0]->font_size.'px; font-family: \''.$res_seting_tabs[0]->font_family.'\'; color: '.$res_seting_tabs[0]->font_color.';">'.$text.'</p>
                                        </span></span>
                                        <span class="click-to-tweet-box clear">
                                        <span class="click-to-tweet" style="font-size: '.$res_seting_tabs[0]->fontsizeaction.'px;"><i></i>'.$res_seting_tabs[0]->callforaction.'</span></span></a></div>';
                                } else if ($res_seting_tabs[0]->preset=='box_7'){
                                   $out .= '<div class="tweetdis_bl tweets-block-wrap tweet-box" style="margin: '.$res_seting_tabs[0]->marginvertical.'px '.$res_seting_tabs[0]->marginhorisontal.'px;">
                                   <a class="tweet-box-link tweets-themes-08" href="" onclick="window.open(\''.$rel.'\',\'_blank\',\'width=500,height=500\'); return false;">
                                    <span class="tweets-themes-08-sky-top-left"></span>
                                    <span class="tweets-themes-08-sky-top-right"></span>
                                    <span class="tweets-themes-08-border"></span>
                                    <span class="tweets-themes-08-bg">
                                        <p style="line-height: '.($res_seting_tabs[0]->font_size+$line_h).'px;font-size: '.$res_seting_tabs[0]->font_size.'px; font-family: \''.$res_seting_tabs[0]->font_family.'\'; color: '.$res_seting_tabs[0]->font_color.';">'.$text.'</p></span>
                                        <span class="tweets-themes-08-bird-bot-left"></span>
                                        <span class="tweets-themes-08-sky-bot-right"></span>
                                        <span class="click-to-tweet" style="font-size: '.$res_seting_tabs[0]->fontsizeaction.'px;"><i></i>'.$res_seting_tabs[0]->callforaction.'</span><span class="tweets-themes-08-border"></span></a></div>';
                                } 
                                  return $out;
}

add_shortcode('tweet_box', 'td_box');



add_action('init', 'add_tweetdis_button');
function add_tweetdis_button() {
    if ( 1==1 || current_user_can('edit_posts') &&  current_user_can('edit_pages') )
    {
        add_filter('mce_external_plugins', 'add_tweetdis_plugin');
        add_filter('mce_buttons', 'register_tweetdis_button');
    }
}
function register_tweetdis_button($buttons) {
    array_push($buttons, "tweet_dis");
    array_push($buttons, "tweet_box");
    return $buttons;
}

function add_tweetdis_plugin($plugin_array) {
    $plugin_array['tweet_dis'] = TWEET_DIS_PLUGIN_URL . 'js/td_td.js';
    return $plugin_array;
}

function file_get_contents_curl_td($url) {
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    
    $data = curl_exec($ch);
    curl_close($ch);
    
    return $data;
}
function getTinyUrlTD($url) {
    $tinyurl = file_get_contents_curl_td("http://tinyurl.com/api-create.php?url=".$url);
    return $tinyurl;
}

function get_bitly_access_token() {
     global $wpdb;
     $table_seting = $wpdb->prefix . "tweetdis_setings";
     $res_seting = $wpdb->get_results( "SELECT * FROM $table_seting" );
    $bitlyLogin = $res_seting[0]->login;
    $bitlyPass = $res_seting[0]->password;
    $conect_status =  $res_seting[0]->access_token;
    if($conect_status != 'no_conect'){
       $access_token = $conect_status;
    }else{
        $bitlyAuth = 'Basic ' . base64_encode($bitlyLogin.':'.$bitlyPass);
        $url = 'https://api-ssl.bitly.com/oauth/access_token';

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
          curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: '.$bitlyAuth,
            'Content-Type: application/x-www-form-urlencoded',
            'Content-Length: 0'.$_SERVER['CONTENT_LENGTH']
            ));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $access_token = curl_exec($ch);
        curl_close($ch);
    }

    return $access_token;
}

function get_bitly_short_url($access_token, $longUrl) {
    $url = 'https://api-ssl.bitly.com/v3/shorten';
   // print_r($access_token);
    $url .= '?access_token='.$access_token;
    $url .= '&longUrl='.$longUrl;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    $json = curl_exec($ch);
    curl_close($ch);
    
    $jsonArr = json_decode($json, true);
    
    return $jsonArr['data']['url'];
}

function getBitLyUrlTd($longUrl) {
    $access_token = get_bitly_access_token();
    return get_bitly_short_url($access_token, $longUrl);
}
?>