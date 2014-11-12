<?php
add_action( 'admin_menu', 'tweetdis_admin_menu' );

function tweetdis_admin_menu() {
        tweetdis_load_menu();
}

function tweetdis_load_menu() {  
        add_menu_page(__('Tweet Dis'), __('Tweet Dis'), 'edit_pages', __FILE__,  'tweet_dis_conf', TWEET_DIS_PLUGIN_URL .'images/icon.png');
}                                                

function tweetdis_admin_init() {
    add_meta_box('tweetdis-status', __('Comment History'), 'tweetdis_comment_status_meta_box', 'comment', 'normal');
}
add_action('admin_init', 'tweetdis_admin_init');

add_action( 'admin_enqueue_scripts', 'tweetdis_load_js_and_css' );
function tweetdis_load_js_and_css() {
    wp_register_style( 'tweet_dis_box.css', TWEET_DIS_PLUGIN_URL . 'css/tweet_dis_box.css', array(), '2.5.9' );
    wp_enqueue_style( 'tweet_dis_box.css');
    
    wp_register_style( 'tweet_dis_boxadmin.css', TWEET_DIS_PLUGIN_URL . 'css/tweet_dis_boxadmin.css', array(), '2.5.9' );
    wp_enqueue_style( 'tweet_dis_boxadmin.css');
    
    wp_register_style( 'tweet_dis_css.css', TWEET_DIS_PLUGIN_URL . 'css/tweet_dis_css.css', array(), '2.5.9' );
    wp_enqueue_style( 'tweet_dis_css.css');
    
    wp_register_style( 'tweet_dis_mooRainbow.css', TWEET_DIS_PLUGIN_URL . 'css/tweet_dis_mooRainbow.css', array(), '2.5.9' );
    wp_enqueue_style( 'tweet_dis_mooRainbow.css');
    
    wp_register_style( 'colorpicker.css', TWEET_DIS_PLUGIN_URL . 'colorpicker/css/colorpicker.css', array(), '2.5.9' );
    wp_enqueue_style( 'colorpicker.css');

    wp_register_script( 'colorpicker.js', TWEET_DIS_PLUGIN_URL . 'colorpicker/js/colorpicker.js', array('jquery') );
    wp_enqueue_script( 'colorpicker.js' );
    wp_localize_script( 'colorpicker.js', 'WPTweetdis_', array(
        'comment_author_url_nonce' => wp_create_nonce( 'comment_author_url_nonce' )
    ) );
    
    wp_register_script( 'eye.js', TWEET_DIS_PLUGIN_URL . 'colorpicker/js/eye.js', array('jquery') );
    wp_enqueue_script( 'eye.js' );
    wp_localize_script( 'eye.js', 'WPTweetdis_', array(
        'comment_author_url_nonce' => wp_create_nonce( 'comment_author_url_nonce' )
    ) );
    
    wp_register_script( 'utils.js', TWEET_DIS_PLUGIN_URL . 'colorpicker/js/utils.js', array('jquery') );
    wp_enqueue_script( 'utils.js' );
    wp_localize_script( 'utils.js', 'WPTweetdis_', array(
        'comment_author_url_nonce' => wp_create_nonce( 'comment_author_url_nonce' )
    ) );
    
    wp_register_script( 'td_script.js', TWEET_DIS_PLUGIN_URL . 'js/td_script.js', array('jquery'), '2.5.9' );
    wp_enqueue_script( 'td_script.js' );
    wp_localize_script( 'td_script.js', 'WPTweetdis_', array(
        'comment_author_url_nonce' => wp_create_nonce( 'comment_author_url_nonce' )
    ) );
    
    wp_register_script( 'td_jquery.cookie.js', TWEET_DIS_PLUGIN_URL . 'js/td_jquery.cookie.js', array('jquery'), '2.5.9' );
    wp_enqueue_script( 'td_jquery.cookie.js' );
    wp_localize_script( 'td_jquery.cookie.js', 'WPTweetdis_', array(
        'comment_author_url_nonce' => wp_create_nonce( 'comment_author_url_nonce' )
    ) );
    
}            
                                   


function tweet_dis_conf() {
     global $wpdb;
     $table_seting_tabs = $wpdb->prefix . "tweetdis_seting_tabs";
     $table_seting = $wpdb->prefix . "tweetdis_setings";
     $table_lic = $wpdb->prefix . "tweetdis";
     if(isset($_POST['seting-tab'])){
        $res_seting_tabs = $wpdb->get_results( "SELECT * FROM $table_seting_tabs WHERE tabs = ".$_POST['seting-tab'] );
     }else{
        $res_seting_tabs = $wpdb->get_results( "SELECT * FROM $table_seting_tabs WHERE tabs = 0" ); 
     }
     
      $res_active_box = $wpdb->get_results( "SELECT * FROM $table_seting_tabs WHERE tabs = 1 AND active=1" );
      $res_active_hint = $wpdb->get_results( "SELECT * FROM $table_seting_tabs WHERE tabs = 2 AND active=1" );
     
     
     
     $res_seting = $wpdb->get_results( "SELECT * FROM $table_seting" );
     
    if(isset($_REQUEST['send_activate'])&& $_REQUEST['send_activate']!=''){
        
        $lic = file_get_contents_curl_td_tweet_dis("http://tweetdis.com/activate.php?act=activate&domain=".$_REQUEST['domain']."&key=".$_REQUEST['key']."&email=".$_REQUEST['email']);

        if($lic == 23){
            $sql = "Update `".$table_lic."` set `key` = '".$_REQUEST['key']."' , time = now() ,active = 1 where domain = '".$_REQUEST['domain']."'";
            $wpdb->query($sql);
        }else{
            print $lic;
        }  

    }


    $license = $wpdb->get_row("SELECT * FROM `".$table_lic."` WHERE domain = '".$_SERVER['SERVER_NAME']."'" );
    if($license->key=='none'){
      ?>

        <form name='activate_form' id='activate_form'  method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
        <input type='hidden' name='domain' value='<?php echo $_SERVER['SERVER_NAME'];?>'>
        <input type='hidden' name='email' value='<?php echo get_option('admin_email');?>'>
        <input type='hidden' name='page' value='tweet_dis'>
        <input type='hidden' name='send_activate' value='true'>
        <table>
        <tr>
        <td>Please enter your Item Purchase Code in the field below</td>
        </tr>
        <tr>
        <td><input type='text' name='key'></td>
        </tr>
        <tr>
        <td>
        <input type='submit' id="activate_btn" value='Activate'>
        </td>
        </tr>
        </table>
        </form>

    <?php
        exit();
    }?>

   <h2>Tweet Dis Settings</h2>
      <div class="td_wrap">
       <div class="wrap">
       <script type="text/javascript">
            jQuery(document).ready(function(){
                  jQuery.ajax({
                   type: "POST",
                   url: "<?php echo TWEET_DIS_PLUGIN_URL; ?>td_ajax.php",
                   data: "tabs=1&perset=<?php echo $res_active_box[0]->preset?>",
				   context: document.body,
                   success: function(msg){
                      jQuery('#box_prev').html(msg);
                   }
                 });
                 jQuery( "#box-tab" ).click(function() {
                    jQuery.ajax({
                   type: "POST",
                   url: "<?php echo TWEET_DIS_PLUGIN_URL; ?>td_ajax.php",
                   data: "tabs=1&perset=<?php echo $res_active_box[0]->preset?>",
                   context: document.body,
                   success: function(msg){
                      jQuery('#box_prev').html(msg);
                   }
                 });
                });
                 jQuery( "#hint-tab" ).click(function() {
                     jQuery.ajax({
                       type: "POST",
                       url: "<?php echo TWEET_DIS_PLUGIN_URL; ?>td_ajax.php",
                       data: "tabs=2&perset=<?php echo $res_active_hint[0]->preset?>",
                       success: function(msg){
                          jQuery('#box_prev').html(msg);
                       }
                     });
                });
                 
            });
        </script>

        <form method="post" action="options.php">
        
            <div class="tabs td-tabs">
                <input type="radio" name="main-tabs" checked="checked" id="box-tab"/>
                <label class='maintabs-lables lable-box' for="box-tab">Box</label>
                <input type="radio" name="main-tabs" id="hint-tab"/>
                <label class='maintabs-lables lable-hint' for="hint-tab">Hint</label>

            <div id="box_prev">

            </div>


        </form>
    </div>
    </div>

<?php 
} ?>