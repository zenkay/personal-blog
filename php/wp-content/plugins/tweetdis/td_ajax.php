<?php
    require_once('../../../wp-load.php');
     //include '/../../wp-includes/wp-db.php';
     global $wpdb;
     $table_seting_tabs = $wpdb->prefix . "tweetdis_seting_tabs";
     $table_seting = $wpdb->prefix . "tweetdis_setings";
     $res_seting_tabs;
     if(isset($_REQUEST['def'])){
         if($_REQUEST['tabs']==1){
              if($_REQUEST['perset']=='box_1'){
                  $wpdb->query( "UPDATE $table_seting_tabs SET `font_family`='Montserrat',`font_size`=30,`font_color`='#333333',`hover_color`='#333333',`marginvertical`=10,`marginhorisontal`=10,`callforaction`='Click to tweet',`fontsizeaction`=12 WHERE tabs = ".$_REQUEST['tabs']." AND preset='".$_REQUEST['perset']."'");
              }else if($_REQUEST['perset']=='box_2'){
                  $wpdb->query( "UPDATE $table_seting_tabs SET `font_family`='PT Serif',`font_size`=30,`font_color`='#333333',`hover_color`='#333333',`marginvertical`=10,`marginhorisontal`=10,`callforaction`='Click to tweet',`fontsizeaction`=12 WHERE tabs = ".$_REQUEST['tabs']." AND preset='".$_REQUEST['perset']."'");
              }else if($_REQUEST['perset']=='box_3'){
                  $wpdb->query( "UPDATE $table_seting_tabs SET `font_family`='Roboto',`font_size`=30,`font_color`='#333333',`hover_color`='#ffffff',`marginvertical`=10,`marginhorisontal`=10,`callforaction`='Click to tweet',`fontsizeaction`=12 WHERE tabs = ".$_REQUEST['tabs']." AND preset='".$_REQUEST['perset']."'");
              }else if($_REQUEST['perset']=='box_4'){
                  $wpdb->query( "UPDATE $table_seting_tabs SET `font_family`='Open Sans Condensed',`font_size`=22,`font_color`='#333333',`hover_color`='#333333',`marginvertical`=10,`marginhorisontal`=10,`callforaction`='Click to tweet',`fontsizeaction`=12 WHERE tabs = ".$_REQUEST['tabs']." AND preset='".$_REQUEST['perset']."'");
              }else if($_REQUEST['perset']=='box_5'){
                  $wpdb->query( "UPDATE $table_seting_tabs SET `font_family`='Mate',`font_size`=22,`font_color`='#333333',`hover_color`='#333333',`marginvertical`=10,`marginhorisontal`=10,`callforaction`='Click to tweet',`fontsizeaction`=12 WHERE tabs = ".$_REQUEST['tabs']." AND preset='".$_REQUEST['perset']."'");
              }else if($_REQUEST['perset']=='box_6'){
                  $wpdb->query( "UPDATE $table_seting_tabs SET `font_family`='Roboto',`font_size`=24,`font_color`='#FFFFFF',`hover_color`='#676767',`marginvertical`=10,`marginhorisontal`=10,`callforaction`='Click to tweet',`fontsizeaction`=12 WHERE tabs = ".$_REQUEST['tabs']." AND preset='".$_REQUEST['perset']."'");
              }else if($_REQUEST['perset']=='box_7'){
                  $wpdb->query( "UPDATE $table_seting_tabs SET `font_family`='Open Sans',`font_size`=20,`font_color`='#5f5f5f',`hover_color`='#5f5f5f',`marginvertical`=10,`marginhorisontal`=10,`callforaction`='Click to tweet',`fontsizeaction`=12 WHERE tabs = ".$_REQUEST['tabs']." AND preset='".$_REQUEST['perset']."'");
              }
         }
         if($_REQUEST['tabs']==2){
             if($_REQUEST['perset']=='hint_1'){
                  $wpdb->query( "UPDATE $table_seting_tabs SET `link_style`='none', `thikness`='3',`font_color`='#f50505',`hover_color`='#75c781',`callforaction`='Tweet this!',`fontsizeaction`=18,`font_family_call`='Georgia',`background_color`='#6e9b76',`Call_to_action_color`='#ffffff' WHERE tabs = ".$_REQUEST['tabs']." AND preset='".$_REQUEST['perset']."'");
             }else if($_REQUEST['perset']=='hint_2'){
                  $wpdb->query( "UPDATE $table_seting_tabs SET `link_style`='none', `thikness`='3',`font_color`='#f50505',`hover_color`='#75c781',`callforaction`='Tweet this!',`fontsizeaction`=18,`font_family_call`='Georgia',`background_color`='',`Call_to_action_color`='#6e9b76' WHERE tabs = ".$_REQUEST['tabs']." AND preset='".$_REQUEST['perset']."'");
             }else if($_REQUEST['perset']=='hint_3'){
                  $wpdb->query( "UPDATE $table_seting_tabs SET `link_style`='none', `thikness`='3',`font_color`='#f50505',`hover_color`='#75c781',`callforaction`='Tweet this!',`fontsizeaction`=18,`font_family_call`='Georgia',`background_color`='#f0efe1',`Call_to_action_color`='#00ade8' WHERE tabs = ".$_REQUEST['tabs']." AND preset='".$_REQUEST['perset']."'");
             }else if($_REQUEST['perset']=='hint_4'){
                  $wpdb->query( "UPDATE $table_seting_tabs SET `link_style`='none', `thikness`='3',`font_color`='#f50505',`hover_color`='#75c781',`callforaction`='Tweet this!',`fontsizeaction`=18,`font_family_call`='Georgia',`background_color`='#ff6633',`Call_to_action_color`='#ffffff' WHERE tabs = ".$_REQUEST['tabs']." AND preset='".$_REQUEST['perset']."'");
             }else if($_REQUEST['perset']=='hint_5'){
                  $wpdb->query( "UPDATE $table_seting_tabs SET `link_style`='none', `thikness`='3',`font_color`='#f50505',`hover_color`='#75c781',`callforaction`='Tweet this!',`fontsizeaction`=18,`font_family_call`='Georgia',`background_color`='#00acff',`Call_to_action_color`='#ffffff' WHERE tabs = ".$_REQUEST['tabs']." AND preset='".$_REQUEST['perset']."'");
             }
         }
     }  
     if(isset($_REQUEST['perset_box_save']) && isset($_REQUEST['font_family'])){
         $wpdb->query( "UPDATE $table_seting_tabs SET `font_family`='".$_REQUEST['font_family']."',`font_size`=".$_REQUEST['font_size'].",`font_color`='".$_REQUEST['font_color']."',`hover_color`='".$_REQUEST['hover_color']."',`marginvertical`=".$_REQUEST['marginvertical'].",`marginhorisontal`=".$_REQUEST['marginhorisontal'].",`callforaction`='".$_REQUEST['callforaction']."',`fontsizeaction`=".$_REQUEST['fontsizeaction']." WHERE tabs = ".$_REQUEST['tabs']." AND preset='".$_REQUEST['perset_box_save']."'");
     }
     if(isset($_REQUEST['save_account'])){                                                                                                                                                                                                                                                                            
           $wpdb->query( "UPDATE $table_seting SET `preposition`='".$_REQUEST['preposition']."',`twitter_account`='".(isset($_REQUEST['twitter-account'])?$_REQUEST['twitter-account']:'')."',`shortener`='".$_REQUEST['shortener']."',`login`='".(isset($_REQUEST['login'])?$_REQUEST['login']:'')."',`password`='".(isset($_REQUEST['password'])?$_REQUEST['password']:'')."',`access_token`='".(isset($_REQUEST['connect_status'])?$_REQUEST['connect_status']:'no_conect')."'");
     }
     if(isset($_REQUEST['connect_logaut'])){                                                                                                                                                                                                                                                                            
           $wpdb->query( "UPDATE $table_seting SET `access_token`='".(isset($_REQUEST['connect_logaut'])?$_REQUEST['connect_logaut']:'no_conect')."'");
     }
     if(isset($_REQUEST['perset_hint_save'])){
         $wpdb->query( "UPDATE $table_seting_tabs SET `link_style`='".$_REQUEST['link_style']."', `thikness`='".$_REQUEST['thikness']."',`font_color`='".$_REQUEST['font_color']."',`hover_color`='".$_REQUEST['hover_color']."',`callforaction`='".$_REQUEST['callforaction']."',`fontsizeaction`=".$_REQUEST['fontsizeaction'].",`font_family_call`='".$_REQUEST['font_family_call']."',`background_color`='".$_REQUEST['background_color']."',`Call_to_action_color`='".$_REQUEST['Call_to_action_color']."' WHERE tabs = ".$_REQUEST['tabs']." AND preset='".$_REQUEST['perset_hint_save']."'");
     }
     if(isset($_REQUEST['active_save'])){
         $wpdb->query( "UPDATE $table_seting_tabs SET `active`=0 WHERE tabs = ".$_REQUEST['tabs']);
         $wpdb->query( "UPDATE $table_seting_tabs SET `active`=1 WHERE tabs = ".$_REQUEST['tabs']." AND preset='".$_REQUEST['perset']."'");
     }
     if(isset($_REQUEST['tabs'])){
        $res_seting_tabs = $wpdb->get_results( "SELECT * FROM $table_seting_tabs WHERE tabs = ".$_REQUEST['tabs']." AND preset='".$_REQUEST['perset']."'" );
     }else{
        $res_seting_tabs = $wpdb->get_results( "SELECT * FROM $table_seting_tabs WHERE tabs = 1 AND preset='box_1'" ); 
     } 

    $res_seting = $wpdb->get_results( "SELECT * FROM $table_seting" );
     if($res_seting_tabs){  ?>
            <?php if($_REQUEST['tabs'] == 1){?>
            <script type="text/javascript">
            jQuery(document).ready(function () {
                    jQuery('#actionTpB').on('input', function() {
                        jQuery('.click-to-tweet').html('<i></i>'+jQuery(this).val());
                    });
                    jQuery( "#tweetbox_fontfamily_01" ).change(function() {
                        jQuery('.tweet-box p').css('font-family', jQuery("#tweetbox_fontfamily_01 option:selected").val());
                    });
                    jQuery('#colorSelector1').ColorPicker({
                        color: '#000000',
                        onShow: function (colpkr) {
                            jQuery(colpkr).fadeIn(500);
                            return false;
                        },
                        onHide: function (colpkr) {
                            jQuery(colpkr).fadeOut(500);
                            return false;
                        },
                        onChange: function (hsb, hex, rgb) {
                            jQuery('#colorSelector1 div').css('backgroundColor', '#' + hex);
                            jQuery('.tweet-box p').css('color', '#' + hex);
                            jQuery('#colorSelector1').parent().parent().find('input').val('#' + hex);
                        }
                    });
                    jQuery('#colorSelector2').ColorPicker({
                        color: '#000000',
                        onShow: function (colpkr) {
                            jQuery(colpkr).fadeIn(500);
                            return false;
                        },
                        onHide: function (colpkr) {
                            jQuery(colpkr).fadeOut(500);
                            return false;
                        },
                        onChange: function (hsb, hex, rgb) {
                            jQuery('#colorSelector2 div').css('backgroundColor', '#' + hex);
                            //jQuery('#col_hov').val('#' + hex);
                            jQuery('#colorSelector2').parent().parent().find('input').val('#' + hex);
                        }
                    });
                    jQuery("#tweet-box").hover(          
                      function () {
                        jQuery('.tweet-box p').css('color', jQuery('#colorSelector2').parent().parent().find('input').val());
                      },
                      function () {
                        jQuery('.tweet-box p').css('color', jQuery('#colorSelector1').parent().parent().find('input').val());
                      }
                    );
                    jQuery('.tweetThisReset').click(function() {
                        
                         var data = "tabs=1&perset="+jQuery(".designboxTD input[type='radio']:checked").val()+"&def=1";
                           jQuery.ajax({
                           type: "POST",
                           url: "<?php echo TWEET_DIS_PLUGIN_URL; ?>td_ajax.php",
                           data: data,
                           success: function(msg){
                             jQuery('#box_prev').html(msg);
                             jQuery('.done_inf').show();
                              setTimeout(function(){ jQuery('.done_inf').hide();},2000);
                           }
                         });
                    });
                    jQuery('.tweetThisSave').click(function() {
                        var data = "tabs=1&perset=<?php echo $res_seting_tabs[0]->preset?>";
                        var data_save = '&font_family='+jQuery("#tweetbox_fontfamily_01 option:selected").val();
                        data_save = data_save + '&font_size='+jQuery('#rangeP').val();
                        data_save = data_save + '&font_color='+jQuery('#colorSelector1').parent().parent().find('input').val();
                        data_save = data_save + '&hover_color='+jQuery('#colorSelector2').parent().parent().find('input').val();
                        data_save = data_save + '&marginvertical='+jQuery('#rangePMV').val();
                        data_save = data_save + '&marginhorisontal='+jQuery('#rangePMH').val();
                        data_save = data_save + '&callforaction='+jQuery('#actionTpB').val();
                        data_save = data_save + '&fontsizeaction='+jQuery('#rangeFS').val();
                        data = data + '&perset_box_save=<?php echo $res_seting_tabs[0]->preset?>' + data_save;
                        data = data + '&active_save=1';
                        var res_seting = '&preposition='+jQuery(".prtxtTD input[type='radio']:checked").val();
                        res_seting = res_seting + '&shortener='+jQuery(".shrtUrlTD input[type='radio']:checked").val();
                        res_seting = res_seting + '&save_account=1';
                        res_seting = res_seting + '&twitter-account=' + jQuery('#twAthr').val();
                        //res_seting = res_seting + '&shortener=' + jQuery('#twAthr').val();
                        res_seting = res_seting + '&login=' + jQuery(".bitlyCreds input[name='bitly_login']").val();
                        res_seting = res_seting + '&password=' + jQuery(".bitlyCreds input[name='bitly_pass']").val();
                        res_seting = res_seting + '&connect_status=' + jQuery("#connect_status").val();
                        data = data + res_seting;
                        //alert(data);
                        jQuery.ajax({
                           type: "POST",
                           url: "<?php echo TWEET_DIS_PLUGIN_URL; ?>td_ajax.php",
                           data: data,
                           success: function(msg){
                              jQuery('#box_prev').html(msg);
                              jQuery('.saved').show();
                              setTimeout(function(){ jQuery('.saved').hide();},2000);
                           }
                         });
                    })
                    jQuery('.shrtUrlTD input:radio').click(function() {
                        var value = jQuery(".shrtUrlTD input[type='radio']:checked").val();
                        if(value == 'bit.ly'){
                            jQuery('#bitlyCreds').show();
                            jQuery('.tweetCnt a').html('http://bit.ly/d7s924w');
                            jQuery('.tweetCnt a').attr('href','http://bit.ly/d7s924w');
                        }else if(value == 'tinyurl.com'){
                            jQuery('.tweetCnt a').html('http://tinyurl.com/d7s924w');
                            jQuery('.tweetCnt a').attr('href','http://tinyurl.com/d7s924w');
                        }
                        else if(value == 'rawurl'){
                            jQuery('.tweetCnt a').html('http://rawurl/d7s924w');
                            jQuery('.tweetCnt a').attr('href','http://rawurl/d7s924w');
                        }
                    });
                     jQuery('.prtxtTD input:radio').click(function() {
                        var value = jQuery(".prtxtTD input[type='radio']:checked").val();
                        if(value == 'RT'){
                            jQuery('.by_rt').html('RT');
                            jQuery('.by_rt').show();
                            jQuery('.twcnt_rt').html('@'+jQuery('#twAthr').val());
                            jQuery('.twcnt_rt').show();
                        }else if(value == 'by'){
                            jQuery('.by').html('by');
                            jQuery('.by').show();
                            jQuery('.twcnt').html('@'+jQuery('#twAthr').val());
                            jQuery('.twcnt').show();
                        }
                        else if(value == 'via'){
                            jQuery('.by').html('via');
                            jQuery('.by').show();
                            jQuery('.twcnt').html('@'+jQuery('#twAthr').val());
                            jQuery('.twcnt').show();
                        }else{
                            jQuery('.by').hide();
                            jQuery('.twcnt').hide();
                            jQuery('.by_rt').hide();
                            jQuery('.twcnt_rt').hide();
                        }
                    });
                    jQuery('.designboxTD input:radio').click(function() {
                        var data = "tabs=1&perset="+jQuery(".designboxTD input[type='radio']:checked").val();
                        var data_save = '&font_family='+jQuery("#tweetbox_fontfamily_01 option:selected").val();
                        data_save = data_save + '&font_size='+jQuery('#rangeP').val();
                        data_save = data_save + '&font_color='+jQuery('#colorSelector1').parent().parent().find('input').val();
                        data_save = data_save + '&hover_color='+jQuery('#colorSelector2').parent().parent().find('input').val();
                        data_save = data_save + '&marginvertical='+jQuery('#rangePMV').val();
                        data_save = data_save + '&marginhorisontal='+jQuery('#rangePMH').val();
                        data_save = data_save + '&callforaction='+jQuery('#actionTpB').val();
                        data_save = data_save + '&fontsizeaction='+jQuery('#rangeFS').val();
                        data = data + '&perset_box_save=<?php echo $res_seting_tabs[0]->preset?>' + data_save;
                        
                        jQuery.ajax({
                           type: "POST",
                           url: "<?php echo TWEET_DIS_PLUGIN_URL; ?>td_ajax.php",
                           data: data,
                           success: function(msg){
                              jQuery('#box_prev').html(msg);
                           }
                         });
                    });
            });
			
            </script>
            <?php
                  $line_h = $res_seting_tabs[0]->font_size/2;
                  $line_h = round($line_h, 0);
            ?>
            <table class="form-table tweetThisTable box">
            <tbody><tr class="prv blockTr">
                <td>
                    <div class="block">
						<p class="box__title">Preview:</p>
                    
                            
                              <div id="tweetPrv" class="box__previewCont">
                                You don’t have to read this text as it’s just an example of how paragraphs of text in your article look like.
                                We need it here to show you how you can style a piece of text that you want to make “tweetable” and here it goes:
                                <?php if($res_seting_tabs[0]->preset=='box_1'){ ?>
                                    <div id="tweet-box" class="tweets-block-wrap tweet-box" style="margin: <?php echo $res_seting_tabs[0]->marginvertical;?>px <?php echo $res_seting_tabs[0]->marginhorisontal;?>px;">
                                        <a id="tweet-box-link" class="tweets-themes-01" href="" onclick="window.open('https://twitter.com/intent/tweet?lang=en&amp;text=TweetDis+is+an+awesome+plugin+for+Wordpress%2C+that+makes+any+phrase+%22tweetable%22.++http%3A%2F%2Ftinyurl.com%2Fd7s924w+%26count%3Dnone','_blank','width=500,height=500'); return false;">
                                            <p style="line-height: <?php echo ($res_seting_tabs[0]->font_size+$line_h)?>px;font-size: <?php echo $res_seting_tabs[0]->font_size;?>px; font-family: '<?php echo $res_seting_tabs[0]->font_family;?>'; color: <?php echo $res_seting_tabs[0]->font_color;?>;">The little vessel continued to beat its way seaward, and the ironclads receded slowly towards the coast</p>
                                            <span class="clear">
                                            <span class="click-to-tweet" style="font-size: <?php echo $res_seting_tabs[0]->fontsizeaction;?>px;"><i></i><?php echo $res_seting_tabs[0]->callforaction;?></span> </span>
                                        </a>
                                    </div>
                                <?php } else if ($res_seting_tabs[0]->preset=='box_2'){?>
                                    <div id="tweet-box" class="tweets-block-wrap tweet-box" style="margin: <?php echo $res_seting_tabs[0]->marginvertical;?>px <?php echo $res_seting_tabs[0]->marginhorisontal;?>px;">
                                        <a id="tweet-box-link" class="tweets-themes-02" href="" onclick="window.open('https://twitter.com/intent/tweet?lang=en&amp;text=TweetDis+is+an+awesome+plugin+for+Wordpress%2C+that+makes+any+phrase+%22tweetable%22.++http%3A%2F%2Ftinyurl.com%2Fd7s924w+%26count%3Dnone','_blank','width=500,height=500'); return false;">
                                        <p style="line-height: <?php echo ($res_seting_tabs[0]->font_size+$line_h)?>px;font-size: <?php echo $res_seting_tabs[0]->font_size;?>px; font-family: '<?php echo $res_seting_tabs[0]->font_family;?>'; color: <?php echo $res_seting_tabs[0]->font_color;?>;">The little vessel continued to beat its way seaward, and the ironclads receded slowly towards the coast</p>
                                        <span class="clear">
                                        <span class="click-to-tweet" style="font-size: <?php echo $res_seting_tabs[0]->fontsizeaction;?>px;"><i></i><?php echo $res_seting_tabs[0]->callforaction;?></span> </span></a>
                                    </div>
                                <?php } else if ($res_seting_tabs[0]->preset=='box_3'){?>
                                   <div id="tweet-box" class="tweets-block-wrap tweet-box" style="margin: <?php echo $res_seting_tabs[0]->marginvertical;?>px <?php echo $res_seting_tabs[0]->marginhorisontal;?>px;">
                                    <a id="tweet-box-link" class="tweets-themes-03" href="" onclick="window.open('https://twitter.com/intent/tweet?lang=en&amp;text=TweetDis+is+an+awesome+plugin+for+Wordpress%2C+that+makes+any+phrase+%22tweetable%22.++http%3A%2F%2Ftinyurl.com%2Fd7s924w+%26count%3Dnone','_blank','width=500,height=500'); return false;">
                                        <p style="line-height: <?php echo ($res_seting_tabs[0]->font_size+$line_h)?>px;font-size: <?php echo $res_seting_tabs[0]->font_size;?>px; font-family: '<?php echo $res_seting_tabs[0]->font_family;?>'; color: <?php echo $res_seting_tabs[0]->font_color;?>;">The little vessel continued to beat its way seaward, and the ironclads receded slowly towards the coast</p>
                                        <span class="clear">
                                        <span class="click-to-tweet" style="font-size: <?php echo $res_seting_tabs[0]->fontsizeaction;?>px;"><i></i><?php echo $res_seting_tabs[0]->callforaction;?></span> </span>
                                    </a>
                                    </div>
                                <?php } else if ($res_seting_tabs[0]->preset=='box_4'){?>
                                   <div id="tweet-box" class="tweets-block-wrap tweet-box" style="margin: <?php echo $res_seting_tabs[0]->marginvertical;?>px <?php echo $res_seting_tabs[0]->marginhorisontal;?>px;">
                                        <a id="tweet-box-link" class="tweets-themes-04" href="" onclick="window.open('https://twitter.com/intent/tweet?lang=en&amp;text=TweetDis+is+an+awesome+plugin+for+Wordpress%2C+that+makes+any+phrase+%22tweetable%22.++http%3A%2F%2Ftinyurl.com%2Fd7s924w+%26count%3Dnone','_blank','width=500,height=500'); return false;">
                                            <span class="clear">
                                            <span class="click-to-tweet" style="font-size: <?php echo $res_seting_tabs[0]->fontsizeaction;?>px;"><?php echo $res_seting_tabs[0]->callforaction;?></span>
                                            <span class="quote-left-top"></span></span>
                                            <p style="line-height: <?php echo ($res_seting_tabs[0]->font_size+$line_h)?>px;font-size: <?php echo $res_seting_tabs[0]->font_size;?>px; font-family: '<?php echo $res_seting_tabs[0]->font_family;?>'; color: <?php echo $res_seting_tabs[0]->font_color;?>;">The little vessel continued to beat its way seaward, and the ironclads receded slowly towards the coast</p>
                                        </a>
                                    </div>
                                <?php } else if ($res_seting_tabs[0]->preset=='box_5'){?>
                                   <div id="tweet-box" class="tweets-block-wrap tweet-box" style="margin: <?php echo $res_seting_tabs[0]->marginvertical;?>px <?php echo $res_seting_tabs[0]->marginhorisontal;?>px;">
                                        <a id="tweet-box-link" class="tweets-themes-06" href="" onclick="window.open('https://twitter.com/intent/tweet?lang=en&amp;text=TweetDis+is+an+awesome+plugin+for+Wordpress%2C+that+makes+any+phrase+%22tweetable%22.++http%3A%2F%2Ftinyurl.com%2Fd7s924w+%26count%3Dnone','_blank','width=500,height=500'); return false;">
                                        <span class="tweets-themes-06-top"></span>
                                        <span class="tweets-themes-06-left">
                                        <span class="tweets-themes-06-right">
                                        <p style="line-height: <?php echo ($res_seting_tabs[0]->font_size+$line_h)?>px;font-size: <?php echo $res_seting_tabs[0]->font_size;?>px; font-family: '<?php echo $res_seting_tabs[0]->font_family;?>'; color: <?php echo $res_seting_tabs[0]->font_color;?>;">The little vessel continued to beat its way seaward, and the ironclads receded slowly towards the coast</p>
                                        <span class="clear">
                                        <span class="click-to-tweet" style="font-size: <?php echo $res_seting_tabs[0]->fontsizeaction;?>px;"><i></i><?php echo $res_seting_tabs[0]->callforaction;?></span></span></span></span>
                                        <span class="tweets-themes-06-bot"></span></a>
                                   </div>
                                   
                                <?php } else if ($res_seting_tabs[0]->preset=='box_6'){?>
                                   <div id="tweet-box" class="tweets-block-wrap tweet-box" style="margin: <?php echo $res_seting_tabs[0]->marginvertical;?>px <?php echo $res_seting_tabs[0]->marginhorisontal;?>px;">
                                    <a id="tweet-box-link" class="tweets-themes-07" href="" onclick="window.open('https://twitter.com/intent/tweet?lang=en&amp;text=TweetDis+is+an+awesome+plugin+for+Wordpress%2C+that+makes+any+phrase+%22tweetable%22.++http%3A%2F%2Ftinyurl.com%2Fd7s924w+%26count%3Dnone','_blank','width=500,height=500'); return false;">
                                        <span class="tweets-themes-07-bg">
                                        <span class="tweets-themes-07-bird">
                                        <p style="line-height: <?php echo ($res_seting_tabs[0]->font_size+$line_h)?>px;font-size: <?php echo $res_seting_tabs[0]->font_size;?>px; font-family: '<?php echo $res_seting_tabs[0]->font_family;?>'; color: <?php echo $res_seting_tabs[0]->font_color;?>;">The little vessel continued to beat its way seaward, and the ironclads receded slowly towards the coast</p>
                                        </span></span>
                                        <span class="click-to-tweet-box clear">
                                        <span class="click-to-tweet" style="font-size: <?php echo $res_seting_tabs[0]->fontsizeaction;?>px;"><i></i><?php echo $res_seting_tabs[0]->callforaction;?></span></span></a></div>
                                <?php } else if ($res_seting_tabs[0]->preset=='box_7'){?>
                                   <div id="tweet-box" class="tweets-block-wrap tweet-box" style="margin: <?php echo $res_seting_tabs[0]->marginvertical;?>px <?php echo $res_seting_tabs[0]->marginhorisontal;?>px;">
                                   <a id="tweet-box-link" class="tweets-themes-08" href="" onclick="window.open('https://twitter.com/intent/tweet?lang=en&amp;text=TweetDis+is+an+awesome+plugin+for+Wordpress%2C+that+makes+any+phrase+%22tweetable%22.++http%3A%2F%2Ftinyurl.com%2Fd7s924w+%26count%3Dnone','_blank','width=500,height=500'); return false;">
                                    <span class="tweets-themes-08-sky-top-left"></span>
                                    <span class="tweets-themes-08-sky-top-right"></span>
                                    <span class="tweets-themes-08-border"></span>
                                    <span class="tweets-themes-08-bg">
                                        <p style="line-height: <?php echo ($res_seting_tabs[0]->font_size+$line_h)?>px;font-size: <?php echo $res_seting_tabs[0]->font_size;?>px; font-family: '<?php echo $res_seting_tabs[0]->font_family;?>'; color: <?php echo $res_seting_tabs[0]->font_color;?>;">The little vessel continued to beat its way seaward, and the ironclads receded slowly towards the coast</p></span>
                                        <span class="tweets-themes-08-bird-bot-left"></span>
                                        <span class="tweets-themes-08-sky-bot-right"></span>
                                        <span class="click-to-tweet" style="font-size: <?php echo $res_seting_tabs[0]->fontsizeaction;?>px;"><i></i><?php echo $res_seting_tabs[0]->callforaction;?></span><span class="tweets-themes-08-border"></span></a></div>
                                <?php } ?>
                                We have several designs of this box and you can switch between them using the "Preset" option below.
                                Please also review instructions to the right..<br>
                            </div>
                        
                        

                        <div class="presetTr">
                            <div class="designboxTD"><div class="label">Preset:</div>
                                <div class="wrp" style="display: block;">
                                    <input name="td_action_design_box" id="box_1_r" value="box_1" type="radio" class="radio leftline__radio radioCustom" <?php echo($res_seting_tabs[0]->preset=='box_1'?'checked="checked"':'') ?>>
                                    <label  for="box_1_r">
                                        Minimal
                                    </label>
                                    <input name="td_action_design_box" id="box_2_r" value="box_2" type="radio" class="radio leftline__radio radioCustom" <?php echo($res_seting_tabs[0]->preset=='box_2'?'checked="checked"':'') ?>>
                                    <label for="box_2_r">
                                        
                                        Shade
                                    </label>
                                    <input name="td_action_design_box" id="box_3_r" value="box_3" type="radio" class="radio leftline__radio radioCustom" <?php echo($res_seting_tabs[0]->preset=='box_3'?'checked="checked"':'') ?>>
                                    <label for="box_3_r">
                                        
                                        Flat
                                    </label>
                                    <input name="td_action_design_box" id="box_4_r" value="box_4" type="radio" class="radio leftline__radio radioCustom" <?php echo($res_seting_tabs[0]->preset=='box_4'?'checked="checked"':'') ?>>
                                    <label for="box_4_r">
                                        
                                        Logo
                                    </label>
                                    <input name="td_action_design_box" id="box_5_r" value="box_5" type="radio" class="radio leftline__radio radioCustom" <?php echo($res_seting_tabs[0]->preset=='box_5'?'checked="checked"':'') ?>>
                                    <label for="box_5_r">
                                        
                                        Traces
                                    </label>
                                    <input name="td_action_design_box" id="box_6_r" value="box_6" type="radio" class="radio leftline__radio radioCustom" <?php echo($res_seting_tabs[0]->preset=='box_6'?'checked="checked"':'') ?>>
                                    <label for="box_6_r">
                                        
                                        Edgy
                                    </label>
                                    <input name="td_action_design_box" id="box_7_r" value="box_7" type="radio" class="radio leftline__radio radioCustom" <?php echo($res_seting_tabs[0]->preset=='box_7'?'checked="checked"':'') ?>>
                                    <label for="box_7_r">
                                        
                                        Childish
                                    </label>
                                </div></div>

                        </div>
                    </div>
                    <div class="block" style="width: 300px;">
                        <table>
                            <tbody><tr class="blockTr2">
                                <td>
                                    <div class="ttl">
                                        <span class="h">How it works: </span>
                                    </div>


                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="ttl2">
                                        <span class="h2">In “Visual” editor: </span>
                                    </div>
                                    <img src="<?php echo TWEET_DIS_PLUGIN_URL; ?>images/visEditbox.png">

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="ttl2">
                                        <span class="h2">In “Text” editor: </span>
                                    </div>

                                    <div class="ttl3">
                                        <span>[tweet_box]</span> your text goes here  <span>[/tweet_box]</span>
                                        - wrap any piece of text with this shortcode.
                                        <br><br>
                                        <i>*If the text is too long, the plugin will automatically cut it, as the maximum length of a tweet is 140 characters.</i>
                                    </div>
                                </td>
                            </tr>
                        </tbody></table>


                    </div>
                </td>

            </tr>

            <tr class="prv blockTr sett">
            <td>
				<div class="box__middle">
					<div class="middle__left">
						<p class="box__title">1. Box settings</p>
						<table class="tweetThisTable middle__table">
							<tr>
								<td class="middle__leftColumn">Font family:</td>
								<td class="fontfamilyTd middle__rightColumn">
									<select class="boxFontFamily middle__fontFamily" id="tweetbox_fontfamily_01" name="tweetbox_fontfamily_01" value="Montserrat">
										<option value="Open Sans" <?php echo($res_seting_tabs[0]->font_family=='Open Sans'?'selected=""':'') ?>>Open Sans</option>
										<option value="Open Sans Condensed" <?php echo($res_seting_tabs[0]->font_family=='Open Sans Condensed'?'selected=""':'') ?>>Open Sans Condensed</option>
										<option value="Mate" <?php echo($res_seting_tabs[0]->font_family=='Mate'?'selected=""':'') ?>>Mate</option>
										<option value="Roboto" <?php echo($res_seting_tabs[0]->font_family=='Roboto'?'selected=""':'') ?>>Roboto</option>
										<option value="PT Serif" <?php echo($res_seting_tabs[0]->font_family=='PT Serif'?'selected=""':'') ?>>PT Serif</option>
										<option value="Montserrat" <?php echo($res_seting_tabs[0]->font_family=='Montserrat'?'selected=""':'') ?>>Montserrat</option>
									</select>
									<label>
									</label>                         
								</td>
							</tr>                                                         
							<tr>
								<td class="middle__leftColumn">Font-size:</td>
								<td class="sliderTD middle__rightColumn">
									<div class="wrp"> 
									   <input type="range" oninput="onchangeWidth()" id="rangeP" name="font_size" min="1" max="50" value="<?php echo $res_seting_tabs[0]->font_size;?>" />
										<output id="rangevalue"></output>
										<span id="px_fontsize"><?php echo $res_seting_tabs[0]->font_size;?> px</span>
									</div>
								</td>
							</tr>
							<tr>
								<td class="middle__leftColumn">Font color:</td>
								<td class="middle__rightColumn">
									<div class="wrp" >
										<div class="cPrevColorBox" id="colorSelector1">
											<div style="background-color:  <?php echo $res_seting_tabs[0]->font_color;?>" class="cPrevColorBox_inside middle__fontColorExample"></div>
										</div>
									</div>
									<input type="text" id="colorpickerField2" class="cInput middle__fontColorInput" name="background" value="<?php echo $res_seting_tabs[0]->font_color;?>" style="width: 80px;"/>
								</td>
							</tr>
							<tr>
								<td class="middle__leftColumn">Hover color:</td>
								<td  class="middle__rightColumn">                               
									<div class="label"></div> <div class="wrp" >
										<div class="cPrevColorBox" id="colorSelector2">
											<div style="background-color:  <?php echo $res_seting_tabs[0]->hover_color;?>" class="cPrevColorBox_inside middle__fontColorExample"></div>
										</div>
									</div>
									<input type="text" id="colorpickerField2" class="cInput middle__fontColorInput" name="background" value="<?php echo $res_seting_tabs[0]->hover_color;?>" style="width: 80px;" />
								</td>
							</tr>
							<tr>
								<td class="middle__leftColumn">Margin Vertical:</td>
								<td class="sliderTD middle__rightColumn">
									<div class="wrp">
										<input type="range" oninput="onchangeWidthMV()" id="rangePMV" name="font_size" min="1" max="50" value="<?php echo $res_seting_tabs[0]->marginvertical;?>" />
										<output id="rangevaluemv"></output>
										<span id="px_marginver"><?php echo $res_seting_tabs[0]->marginvertical;?> px</span>
									</div>
								</td>
							</tr>
							<tr>
								<td class="middle__leftColumn">Margin Horisontal:</td>
								<td class="sliderTD middle__rightColumn">
									<div class="wrp">
										<input type="range" oninput="onchangeWidthMH()" id="rangePMH" name="font_size" min="1" max="50" value="<?php echo $res_seting_tabs[0]->marginhorisontal;?>" />
										<output id="rangevaluemh"></output>
										<span id="px_marginhor"><?php echo $res_seting_tabs[0]->marginhorisontal;?> px</span>
									</div>
								</td>
							</tr>
						</table>
					</div>
					<div class="middle__right">
						<p class="box__title">2. Call to action settings</p>
						<table class="middle__table">
							<tr>
								<td class="middle__leftColumn">Call for action:</td>
								<td class="middle__rightColumn">
									<input type="text" id="actionTpB" name="td_actionTpB" class="middle__CallInput" value="<?php echo $res_seting_tabs[0]->callforaction;?>">
									<p class="middle__CallDescr">We recommend you to<br> use short phrases</p>
	
								</td>
							</tr>
							<tr>
								<td class="middle__leftColumn">Font size:</td>
								<td class="sliderTD middle__rightColumn">
									<input type="range" oninput="onchangeWidthFS()" id="rangeFS" name="font_size" min="1" max="50" value="<?php echo $res_seting_tabs[0]->fontsizeaction;?>" />
										<output id="rangevaluefs"></output>
										<span id="px_fs"><?php echo $res_seting_tabs[0]->fontsizeaction;?> px</span>
								</td>
							</tr>
						</table>
					</div>
				</div>
				

            </td>

            </tr>
            </tbody>
		</table>
        
        <?php } else {?>

        
        
        <script type="text/javascript">
            function onchangeFSA() {
                jQuery('#px_fsa').html(jQuery('#rangefsa').val() + 'px');
                jQuery('#cloudP').css('font-size',jQuery('#rangefsa').val() + 'px');
            }
            jQuery(document).ready(function () {
                    jQuery('#actionTp').on('input', function() {
                        jQuery('#cloudP .cloudPText').html(jQuery(this).val());
                    });
                    jQuery('#colorSelector1').ColorPicker({
                        color: '#000000',
                        onShow: function (colpkr) {
                            jQuery(colpkr).fadeIn(500);
                            return false;
                        },
                        onHide: function (colpkr) {
                            jQuery(colpkr).fadeOut(500);
                            return false;
                        },
                        onChange: function (hsb, hex, rgb) {
                            jQuery('#colorSelector1 div').css('backgroundColor', '#' + hex);
                            jQuery('#tweet').css('color', '#' + hex);
                            jQuery('#colorSelector1').parent().parent().find('input').val('#' + hex);
                        }
                    });
                    jQuery('#colorSelector2').ColorPicker({
                        color: '#000000',
                        onShow: function (colpkr) {
                            jQuery(colpkr).fadeIn(500);
                            return false;
                        },
                        onHide: function (colpkr) {
                            jQuery(colpkr).fadeOut(500);
                            return false;
                        },
                        onChange: function (hsb, hex, rgb) {
                            jQuery('#colorSelector2 div').css('backgroundColor', '#' + hex);
                            //jQuery('#col_hov').val('#' + hex);
                            jQuery('#colorSelector2').parent().parent().find('input').val('#' + hex);
                        }
                    });
                    
                    function rgb2hsl(HTMLcolor) {
                        r = parseInt(HTMLcolor.substring(0,2),16) / 255;
                        g = parseInt(HTMLcolor.substring(2,4),16) / 255;
                        b = parseInt(HTMLcolor.substring(4,6),16) / 255;
                        var light = (this.r * 0.8 + this.g + this.b * 0.2) / 510 * 100;

                        return light; // H - цветовой тон, S - насыщенность, L - светлота
                    }

                     function colorLuminance(hex, lum) {
                        // validate hex string
                        hex = String(hex).replace(/[^0-9a-f]/gi, '');
                        if (hex.length < 6) {
                            hex = hex[0]+hex[0]+hex[1]+hex[1]+hex[2]+hex[2];
                        }
                        lum = lum || 0;
                        // convert to decimal and change luminosity
                        var rgb = "#", c, i;
                        for (i = 0; i < 3; i++) {
                            c = parseInt(hex.substr(i*2,2), 16);
                            c = Math.round(Math.min(Math.max(0, c + (c * lum)), 255)).toString(16);
                            rgb += ("00"+c).substr(c.length);
                        }
                        return rgb;
                    }

                    jQuery('#colorSelector3').ColorPicker({
                        color: '#000000',
                        onShow: function (colpkr) {
                            jQuery(colpkr).fadeIn(500);
                            return false;
                        },
                        onHide: function (colpkr) {
                            jQuery(colpkr).fadeOut(500);
                            return false;
                        },
                        onChange: function (hsb, hex, rgb) {
                            var hint_val = jQuery(".preset_line input[type='radio']:checked").val();
                            if(hint_val == 'hint_1'){
                                jQuery('#cloud').css('backgroundColor', '#' + hex);
                                jQuery('.cloudBrd').css('backgroundColor', '#' + hex);
                                jQuery('.arrow').css('border-top-color', '#' + hex); 
                            }else if(hint_val == 'hint_2'){
                                
                            } else if(hint_val == 'hint_3'){
                                jQuery('#cloud').css('border-color', '#' + hex); 
                                jQuery('.arrow').css('border-top-color', '#' + hex); 
                                jQuery('.cloudBrd').css('border-top-color', '#' + hex);  
                                jQuery('.arrowRght').css('border-top-color', '#' + hex);  
                            }else if(hint_val == 'hint_4'){
                                jQuery('#cloud').css('backgroundColor', '#' + hex);
                                jQuery('#cloud').css('border-color', '#' + hex);
                                jQuery('#cloudP').css('backgroundColor', '#' + hex);
                                jQuery('.cloudBrd').css('background', '#' + hex);
                                jQuery('.arrow').css('border-top-color', '#' + hex);
                                jQuery('.arrowRght2').css('border-top-color', '#' + hex);
                            } else if(hint_val == 'hint_5'){
                                jQuery('#cloud').css('border-color', '#' + hex);
                                jQuery('.arrowRght').css('border-top-color', '#' + hex);
                                var col_hsl = colorLuminance(hex, 55);
                                jQuery('#cloud').css('background', '-webkit-gradient(linear, 0% 0%, 0% 100%, from('+col_hsl+'), to(#'+ hex+'))');
                            }

                            jQuery('#colorSelector3 div').css('backgroundColor', '#' + hex);
                            jQuery('#colorSelector3').parent().parent().find('input').val('#' + hex);
                        }
                    });
                    jQuery('#colorSelector4').ColorPicker({
                        color: '#000000',
                        onShow: function (colpkr) {
                            jQuery(colpkr).fadeIn(500);
                            return false;
                        },
                        onHide: function (colpkr) {
                            jQuery(colpkr).fadeOut(500);
                            return false;
                        },
                        onChange: function (hsb, hex, rgb) {
                            jQuery('#colorSelector4 div').css('backgroundColor', '#' + hex);
                            jQuery('.bird').css('backgroundColor', '#' + hex);
                            jQuery('#cloud').css('color', '#' + hex);
                            jQuery('#colorSelector4').parent().parent().find('input').val('#' + hex);
                        }
                    });   
                    jQuery('.borderTD input:radio').click(function() {
                        jQuery('#tweet').css('border-bottom-style', jQuery(".borderTD input[type='radio']:checked").val());
                    });
                    jQuery('.fontfamilyTd input:radio').click(function() {
                        jQuery('#cloudP').css('font-family', jQuery(".fontfamilyTd input[type='radio']:checked").val());
                    });
                    jQuery("#tweet").hover(          
                      function () {
                        jQuery('#tweet').css('color', jQuery('#colorSelector2').parent().parent().find('input').val());
                      },
                      function () {
                        jQuery('#tweet').css('color', jQuery('#colorSelector1').parent().parent().find('input').val());
                      }
                    );
                     jQuery('.tweetThisReset ').click(function() {
                         var data = "tabs=2&perset=<?php echo $res_seting_tabs[0]->preset?>&def=1";
                           jQuery.ajax({
                           type: "POST",
                           url: "<?php echo TWEET_DIS_PLUGIN_URL; ?>td_ajax.php",
                           data: data,
                           success: function(msg){
                              jQuery('#box_prev').html(msg);
                              jQuery('.done_inf').show();
                              setTimeout(function(){ jQuery('.done_inf').hide();},2000);
                           }
                         });
                    });
                    jQuery('.tweetThisSave').click(function() {
                        var data = "tabs=2&perset=<?php echo $res_seting_tabs[0]->preset?>"//+jQuery(".preset_line input[type='radio']:checked").val();
                       // var data_save = '&font_family='+jQuery("#tweetbox_fontfamily_01 option:selected").val();
                        var data_save = '';
                        data_save = data_save + '&link_style='+jQuery(".link_style input[type='radio']:checked").val();
                        data_save = data_save + '&thikness='+jQuery('#rangeThiknes').val();
                        data_save = data_save + '&font_color='+jQuery('#colorSelector1').parent().parent().find('input').val();
                        data_save = data_save + '&hover_color='+jQuery('#colorSelector2').parent().parent().find('input').val();
                        data_save = data_save + '&callforaction='+jQuery('#actionTp').val();
                        data_save = data_save + '&fontsizeaction='+jQuery('#rangefsa').val(); 
                        data_save = data_save + '&font_family_call='+jQuery(".fontfamilyTd input[type='radio']:checked").val();
                        if(jQuery('#colorSelector3').parent().parent().find('input').length>0 ){
                            data_save = data_save + '&background_color='+jQuery('#colorSelector3').parent().parent().find('input').val();
                        } else {
                             data_save = data_save + '&background_color=""';
                        }
                        data_save = data_save + '&Call_to_action_color='+jQuery('#colorSelector4').parent().parent().find('input').val();
                        data = data + '&perset_hint_save=<?php echo $res_seting_tabs[0]->preset?>' + data_save; 
                        data = data + '&active_save=1';
                        var res_seting = '&preposition='+jQuery(".prtxtTD input[type='radio']:checked").val();
                        res_seting = res_seting + '&shortener='+jQuery(".shrtUrlTD input[type='radio']:checked").val();
                        res_seting = res_seting + '&save_account=1';
                        res_seting = res_seting + '&twitter-account=' + jQuery('#twAthr').val();
                        //res_seting = res_seting + '&shortener=' + jQuery('#twAthr').val();
                        res_seting = res_seting + '&login=' + jQuery(".bitlyCreds input[name='bitly_login']").val();
                        res_seting = res_seting + '&password=' + jQuery(".bitlyCreds input[name='bitly_pass']").val();
                        res_seting = res_seting + '&connect_status=' + jQuery("#connect_status").val();
                        data = data + res_seting;
                        //alert(data);
                        jQuery.ajax({
                           type: "POST",
                           url: "<?php echo TWEET_DIS_PLUGIN_URL; ?>td_ajax.php",
                           data: data,
                           success: function(msg){
                              jQuery('#box_prev').html(msg);
                              jQuery('.saved').show();
                              setTimeout(function(){ jQuery('.saved').hide();},2000);
                           }
                         });
                    })
                    jQuery('.link_style input:radio').click(function() {
                        var border = jQuery(".link_style input[type='radio']:checked").val();
                        var px_thikness = jQuery('#px_thikness').val();
                        jQuery('#tweet').css('border-bottom-style', border);
                        jQuery('#tweet').css('border-bottom-width', px_thikness+'px');
                    });
                    jQuery('.preset_line input:radio').click(function() {
                        var data = "tabs=2&perset="+jQuery(".preset_line input[type='radio']:checked").val();
                        var data_save = '&font_family='+jQuery("#tweetbox_fontfamily_01 option:selected").val();
                        data_save = data_save + '&link_style='+jQuery(".link_style input[type='radio']:checked").val();
                        data_save = data_save + '&thikness='+jQuery('#rangeThiknes').val();
                        data_save = data_save + '&font_color='+jQuery('#colorSelector1').parent().parent().find('input').val();
                        data_save = data_save + '&hover_color='+jQuery('#colorSelector2').parent().parent().find('input').val();
                        data_save = data_save + '&callforaction='+jQuery('#actionTp').val();
                        data_save = data_save + '&fontsizeaction='+jQuery('#rangefsa').val(); 
                        data_save = data_save + '&font_family_call='+jQuery(".fontfamilyTd input[type='radio']:checked").val();
                        if(jQuery('#colorSelector3').parent().parent().find('input').length>0 ){
                            data_save = data_save + '&background_color='+jQuery('#colorSelector3').parent().parent().find('input').val();
                        } else {
                             data_save = data_save + '&background_color=""';
                        }
                        data_save = data_save + '&Call_to_action_color='+jQuery('#colorSelector4').parent().parent().find('input').val();
                        data = data + '&perset_hint_save=<?php echo $res_seting_tabs[0]->preset?>' + data_save; 
                        jQuery.ajax({
                           type: "POST",
                           url: "<?php echo TWEET_DIS_PLUGIN_URL; ?>td_ajax.php",
                           data: data,
                           success: function(msg){
                              jQuery('#box_prev').html(msg);
                           }
                         });
                    });
                    
            });
                jQuery(document).ready(function(){ 
                    jQuery( "#tweet" ).hover(
                      function() {
                        jQuery("#cloud").addClass('act_move');
                      }, function() {
                        //jQuery("#cloud").fadeOut();
                        jQuery("#cloud").removeClass('act_move');  
                        jQuery("#cloud").css('left','50%').css('top','0'); 
                       // jQuery("#cloud").fadeIn(); 
                      }
                    );
                   jQuery('#tweet').mousemove(function (pos) { 
                        var hint_val = jQuery(".preset_line input[type='radio']:checked").val();
                        
                        var with_bl = jQuery(this).find("#cloud").width();
                        var offset = jQuery(this).offset();
                        var pos_x = pos.pageX - offset.left-(with_bl/2)-7;
                        if(hint_val == "hint_4"){
                            pos_x = pos.pageX - offset.left + 7;      
                        }else if(hint_val == "hint_5"){
                             pos_x = pos.pageX - offset.left - 7;
                        }
                        
             
                        jQuery(".act_move").css("left",( pos_x)+"px").css("top",(pos.pageY - offset.top - 30)+"px"); 
                   }); 
                   
                }); 
            </script>
    <table class="form-table tweetThisTable">
    <tbody><tr class="prv blockTr">
        <td>
            <div class="block up__left">
				<p class="box__title">Preview:</p>
                <div id="tweetPrv" class="box__previewCont box__previewCont-hint">
					<p>
						You don’t have to read this text as it’s just an example of how paragraphs of text in your article look like.
						We need it here to show you how you can style a piece of text that you want to make “tweetable” and here it goes:</p>
						<?php if($res_seting_tabs[0]->preset == 'hint_1') {?>
						<div id="tweet" class="tip" style="border-bottom-style: <?php echo $res_seting_tabs[0]->link_style?>; border-bottom-width: <?php echo $res_seting_tabs[0]->thikness;?>px; color: <?php echo $res_seting_tabs[0]->font_color;?>">
							<a href="https://twitter.com/intent/tweet?lang=en&amp;text=TweetDis+is+an+awesome+plugin+for+Wordpress%2C+that+makes+any+phrase+%22tweetable%22.++http%3A%2F%2Ftinyurl.com%2Fd7s924w+%26count%3Dnone" onclick="window.open(this.href,'_blank','width=500,height=500'); return false;">
								So here is the sentence that you want people to tweet. Make sure it short,
								as Tweets can’t be longer than 140 symbols.
							</a>
							<div id="cloud" style="color: <?php echo $res_seting_tabs[0]->Call_to_action_color?>; margin-top: -51px; margin-left: 0px; opacity: 1; visibility: visible; background: <?php echo $res_seting_tabs[0]->background_color?>;" class="defaultDsgn">
								<span id="cloudP" style="font-size: <?php echo $res_seting_tabs[0]->fontsizeaction;?>px; font-family: <?php echo $res_seting_tabs[0]->font_family_call?>; background: transparent;">
									<span class="bird" style="background-color: rgb(255, 255, 255);">
										<img src="<?php echo TWEET_DIS_PLUGIN_URL; ?>images/bird.png" alt="">
									</span>
									<span class="cloudPText"><?php echo $res_seting_tabs[0]->callforaction;?></span>            </span>
												<span class="arrow" style="border-top-color:  <?php echo $res_seting_tabs[0]->background_color?>;"></span>
												<span class="arrowRght"></span>
								<span class="cloudBrd" style="background-color:  <?php echo $res_seting_tabs[0]->background_color?>;">
									<span class="arrowRght2" style="border-top-color:  <?php echo $res_seting_tabs[0]->background_color?>;"></span>
									<span class="arrow" style="border-top-color:  <?php echo $res_seting_tabs[0]->background_color?>;"></span>
								</span>
							</div>
						</div>
						<?php } else if($res_seting_tabs[0]->preset == 'hint_2') {?>
						
							<div id="tweet" class="tip" style="border-bottom-style: <?php echo $res_seting_tabs[0]->link_style?>; border-bottom-width: <?php echo $res_seting_tabs[0]->thikness;?>px; color: <?php echo $res_seting_tabs[0]->font_color;?>;">
											<a href="https://twitter.com/intent/tweet?lang=en&amp;text=TweetDis+is+an+awesome+plugin+for+Wordpress%2C+that+makes+any+phrase+%22tweetable%22.++http%3A%2F%2Ftinyurl.com%2Fd7s924w+%26count%3Dnone" onclick="window.open(this.href,'_blank','width=500,height=500'); return false;">
												So here is the sentence that you want people to tweet. Make sure it short,
												as Tweets can’t be longer than 140 symbols.
											</a>
												<div id="cloud" style="color: <?php echo $res_seting_tabs[0]->Call_to_action_color?>; margin-top: -10px; margin-left: 0px; opacity: 1; visibility: visible; background: <?php echo $res_seting_tabs[0]->background_color?>;" class="blankyDsgn">
									<span id="cloudP" style="font-size: <?php echo $res_seting_tabs[0]->fontsizeaction;?>px; font-family: <?php echo $res_seting_tabs[0]->font_family_call?>; background: transparent;">
										<span class="bird" style="background-color: rgb(110, 155, 118);">
											<img src="<?php echo TWEET_DIS_PLUGIN_URL; ?>images/bird.png" alt="">
										</span>
										<span class="cloudPText"><?php echo $res_seting_tabs[0]->callforaction;?></span>            </span>
													<span class="arrow" style="border-top-color: <?php echo $res_seting_tabs[0]->background_color?>;"></span>
													<span class="arrowRght"></span>
									<span class="cloudBrd" style="background-color: <?php echo $res_seting_tabs[0]->background_color?>;">
										<span class="arrowRght2" style="border-top-color: <?php echo $res_seting_tabs[0]->background_color?>;"></span>
										<span class="arrow" style="border-top-color: <?php echo $res_seting_tabs[0]->background_color?>;"></span>
									</span>
								</div>
							</div>
						 <?php } else if($res_seting_tabs[0]->preset == 'hint_3') {?>
						
							<div id="tweet" class="tip" style="border-bottom-style: <?php echo $res_seting_tabs[0]->link_style?>; border-bottom-width: <?php echo $res_seting_tabs[0]->thikness;?>px; color: <?php echo $res_seting_tabs[0]->font_color;?>;">
										<a href="https://twitter.com/intent/tweet?lang=en&amp;text=TweetDis+is+an+awesome+plugin+for+Wordpress%2C+that+makes+any+phrase+%22tweetable%22.++http%3A%2F%2Ftinyurl.com%2Fd7s924w+%26count%3Dnone" onclick="window.open(this.href,'_blank','width=500,height=500'); return false;">
											So here is the sentence that you want people to tweet. Make sure it short,
											as Tweets can’t be longer than 140 symbols.
										</a>
										<div id="cloud" style="color:  <?php echo $res_seting_tabs[0]->Call_to_action_color?>; margin-top: -10px; margin-left: 0px; opacity: 1; visibility: visible; border-color: <?php echo $res_seting_tabs[0]->background_color?>; background: <?php echo $res_seting_tabs[0]->background_color?>;" class="edgebirdDsgn">
							<span id="cloudP" style="font-size: <?php echo $res_seting_tabs[0]->fontsizeaction;?>px; font-family: <?php echo $res_seting_tabs[0]->font_family_call?>; background: transparent;">
								<span class="bird" style="background-color: <?php echo $res_seting_tabs[0]->Call_to_action_color?>;">
									<img src="<?php echo TWEET_DIS_PLUGIN_URL; ?>images/bird-new.png" alt="">
								</span>
								<span class="cloudPText"><?php echo $res_seting_tabs[0]->callforaction;?></span>            </span>
											<span class="arrow" style="border-top-color: <?php echo $res_seting_tabs[0]->background_color?>;"></span>
											<span class="arrowRght" style="border-top-color: <?php echo $res_seting_tabs[0]->background_color?>;"></span>
							<span class="cloudBrd" style="background-color: <?php echo $res_seting_tabs[0]->background_color?>;">
								<span class="arrowRght2" style="border-top-color: <?php echo $res_seting_tabs[0]->background_color?>;"></span>
								<span class="arrow" style="border-top-color: <?php echo $res_seting_tabs[0]->background_color?>;"></span>
							</span>
							</div>
						</div>
						<?php } else if($res_seting_tabs[0]->preset == 'hint_4') {?>
						
							<div id="tweet" class="tip" style="border-bottom-style: <?php echo $res_seting_tabs[0]->link_style?>; border-bottom-width: <?php echo $res_seting_tabs[0]->thikness;?>px; color: <?php echo $res_seting_tabs[0]->font_color;?>;">
							<a href="https://twitter.com/intent/tweet?lang=en&amp;text=TweetDis+is+an+awesome+plugin+for+Wordpress%2C+that+makes+any+phrase+%22tweetable%22.++http%3A%2F%2Ftinyurl.com%2Fd7s924w+%26count%3Dnone" onclick="window.open(this.href,'_blank','width=500,height=500'); return false;">
								So here is the sentence that you want people to tweet. Make sure it short,
								as Tweets can’t be longer than 140 symbols.
							</a>
							<div id="cloud" style="color: <?php echo $res_seting_tabs[0]->Call_to_action_color?>; margin-top: -10px; margin-left: 0px; opacity: 1; visibility: visible; border-color: rgb(240, 239, 225); background: <?php echo $res_seting_tabs[0]->background_color?>;" class="coginuDsgn">
							<span id="cloudP" style="font-size: <?php echo $res_seting_tabs[0]->fontsizeaction;?>px; font-family: <?php echo $res_seting_tabs[0]->font_family_call?>; background: <?php echo $res_seting_tabs[0]->background_color?>;">
								<span class="bird" style="background-color: rgb(255, 255, 255);">
									<img src="<?php echo TWEET_DIS_PLUGIN_URL; ?>images/bird.png" alt="">
								</span>
								<span class="cloudPText"><?php echo $res_seting_tabs[0]->callforaction;?></span>           </span>
											<span class="arrow" style="border-top-color: <?php echo $res_seting_tabs[0]->background_color?>;"></span>
											<span class="arrowRght" style="border-top-color: <?php echo $res_seting_tabs[0]->background_color?>;"></span>
							<span class="cloudBrd" style="background: <?php echo $res_seting_tabs[0]->background_color?>;">
								<span class="arrowRght2" style="border-top-color: <?php echo $res_seting_tabs[0]->background_color?>;"></span>
								<span class="arrow" style="border-top-color: <?php echo $res_seting_tabs[0]->background_color?>;"></span>
							</span>
							</div>
						</div>
						<?php } else if($res_seting_tabs[0]->preset == 'hint_5') {?>
                             <script>
                                 jQuery(document).ready(function(){ 
                                      function colorLuminance2(hex, lum) {
                                        // validate hex string
                                        hex = String(hex).replace(/[^0-9a-f]/gi, '');
                                        if (hex.length < 6) {
                                            hex = hex[0]+hex[0]+hex[1]+hex[1]+hex[2]+hex[2];
                                        }
                                        lum = lum || 0;
                                        // convert to decimal and change luminosity
                                        var rgb = "#", c, i;
                                        for (i = 0; i < 3; i++) {
                                            c = parseInt(hex.substr(i*2,2), 16);
                                            c = Math.round(Math.min(Math.max(0, c + (c * lum)), 255)).toString(16);
                                            rgb += ("00"+c).substr(c.length);
                                        }
                                        return rgb;
                                    }
                                   var col_hsl2 = colorLuminance2('<?php echo $res_seting_tabs[0]->background_color?>', 55);
                                    jQuery('#cloud').css('background', '-webkit-gradient(linear, 0% 0%, 0% 100%, from('+col_hsl2+'), to( <?php echo $res_seting_tabs[0]->background_color?>))');
                                 });
                             </script>
                             
						   <div id="tweet" class="tip" style="border-bottom-style: <?php echo $res_seting_tabs[0]->link_style?>; border-bottom-width: <?php echo $res_seting_tabs[0]->thikness;?>px; color: <?php echo $res_seting_tabs[0]->font_color;?>;">
							<a href="https://twitter.com/intent/tweet?lang=en&amp;text=TweetDis+is+an+awesome+plugin+for+Wordpress%2C+that+makes+any+phrase+%22tweetable%22.++http%3A%2F%2Ftinyurl.com%2Fd7s924w+%26count%3Dnone" onclick="window.open(this.href,'_blank','width=500,height=500'); return false;">
								So here is the sentence that you want people to tweet. Make sure it short,
								as Tweets can’t be longer than 140 symbols.
							</a>
							<div id="cloud" style="color: <?php echo $res_seting_tabs[0]->Call_to_action_color?>; margin-top: -10px; margin-left: 0px; opacity: 1; visibility: visible; border-color: <?php echo $res_seting_tabs[0]->background_color?>; background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(rgb(0, 255, 255)), to(<?php echo $res_seting_tabs[0]->background_color?>));" class="gigabugDsgn">
								<span id="cloudP" style="font-size: <?php echo $res_seting_tabs[0]->fontsizeaction;?>px; font-family: <?php echo $res_seting_tabs[0]->font_family_call?>; background: transparent;">
									<span class="bird" style="background-color: rgb(255, 255, 255);">
										<img src="<?php echo TWEET_DIS_PLUGIN_URL; ?>images/bird.png" alt="">
									</span>
									<span class="cloudPText"><?php echo $res_seting_tabs[0]->callforaction;?></span>            </span>
												<span class="arrow" style="border-top-color: <?php echo $res_seting_tabs[0]->background_color?>;"></span>
												<span class="arrowRght" style="border-top-color: <?php echo $res_seting_tabs[0]->background_color?>;"></span>
								<span class="cloudBrd" style="background: <?php echo $res_seting_tabs[0]->background_color?>;">
									<span class="arrowRght2" style="border-top-color: <?php echo $res_seting_tabs[0]->background_color?>;"></span>
									<span class="arrow" style="border-top-color: <?php echo $res_seting_tabs[0]->background_color?>;"></span>
								</span>
							</div>
						</div>
						<?php } ?>
						
						   
						
					<p>
						This sentence can be followed
						by another “regular” sentence, which will not appear in a tweet.<br><br>
						That’s the difference between “box” and “hint”. You can use both os them in
						the same article.<br><br>
						You can switch between different designs of the “hint” by using the “Preset” settings below and you can also customize them if you want to.<br><br>
						All in all, we really hope you enjoy this plugin &amp; good luck with your tweets!<br><br>
					</p>
                </div>
				<ul class="up__leftLine radioLine preset_line">
					<li class="leftLine__title">Preset:</li>
					<li class="leftline__element">
						<input id="Flatty" type="radio" name="perset" class="leftline__radio radioCustom" value="hint_1" <?php echo ($res_seting_tabs[0]->preset == 'hint_1'?'checked="checked"':'')?>>
						<label for="Flatty">Flatty</label>
					</li>
					<li class="leftline__element">
						<input id="Blanky" type="radio" name="perset" class="leftline__radio radioCustom" value="hint_2" <?php echo ($res_seting_tabs[0]->preset == 'hint_2'?'checked="checked"':'')?>>
						<label for="Blanky">Blanky</label>
					</li>
					<li class="leftline__element">
						<input id="Birdy" type="radio" name="perset" class="leftline__radio radioCustom" value="hint_3" <?php echo ($res_seting_tabs[0]->preset == 'hint_3'?'checked="checked"':'')?>>
						<label for="Birdy">Birdy</label>
					</li>
					<li class="leftline__element">
						<input id="Edgy" type="radio" name="perset" class="leftline__radio radioCustom" value="hint_4" <?php echo ($res_seting_tabs[0]->preset == 'hint_4'?'checked="checked"':'')?>>
						<label for="Edgy">Edgy</label>
					</li>
					<li class="leftline__element">
						<input id="Bulby" type="radio" name="perset" class="leftline__radio radioCustom" value="hint_5" <?php echo ($res_seting_tabs[0]->preset == 'hint_5'?'checked="checked"':'')?>>
						<label for="Bulby">Bulby</label>
					</li>

				</ul>
            </div>
			<div class="up__right">
				 <p class="box__title">How to use:</p>
				 <p class="up__subTitle">In “Visual” editor:</p>
				 <div class="up__visualCont">
					<img src="<?php echo TWEET_DIS_PLUGIN_URL; ?>/i/visual.png" height="171" width="241" alt="">
					 <p class="up__visualDescr">Highlight text <br>&amp; click this button</p>
				 </div>
				 <p class="up__subTitle">In “Text” editor:</p>
				 <p class="up__textEditor"><span class="up__textEditor-orange">[tweet_box]</span> your text goes here <span class="up__textEditor-orange">[/tweet_box]</span> - wrap any piece of text with this shortcode.</p>
				 <p class="up__textEditor"><em>*If the text is too long, the plugin will automatically cut it, as the maximum length of a tweet is 140 characters.</em></p>

			</div>
        </td>

    </tr>

    <tr class="prv blockTr sett">
        <td>
		<div class="box__middle">
			<div class="middle__left">
				<p class="box__title">1. Quote settings</p>
				<table class="middle__table quote_set">
					<tbody>
						<tr>

							<td class="middle__leftColumn">Underline:</td>
							<td class="middle__rightColumn">
								<ul class="up__leftLine radioLine link_style">
									<li class="leftline__element leftline__element-marginSmall">
										<input id="None" type="radio" name="Preset" class="leftline__radio radioCustom" value="none" <?php echo ($res_seting_tabs[0]->link_style == 'none'?'checked="checked"':'')?>>
										<label for="None">None</label>
									</li>
									<li class="leftline__element leftline__element-marginSmall">
										<input id="Solid" type="radio" name="Preset" class="leftline__radio radioCustom" value="solid" <?php echo ($res_seting_tabs[0]->link_style == 'solid'?'checked="checked"':'')?>>
										<label for="Solid">Solid</label>
									</li>
									<li class="leftline__element leftline__element-marginSmall">
										<input id="Dashed" type="radio" name="Preset" class="leftline__radio radioCustom" value="dashed" <?php echo ($res_seting_tabs[0]->link_style == 'dashed'?'checked="checked"':'')?>>
										<label for="Dashed">Dashed</label>
									</li>
									<li class="leftline__element leftline__element-marginSmall">
										<input id="Dotted" type="radio" name="Preset" class="leftline__radio radioCustom" value="dotted" <?php echo ($res_seting_tabs[0]->link_style == 'dotted'?'checked="checked"':'')?>>
										<label for="Dotted">Dotted</label>
									</li>
								</ul>
							</td>
						</tr>
						 <tr>
							<td class="middle__leftColumn">Thikness:</td>
							<td class="middle__rightColumn">
                            
                            <div class="rangeChoose middle__rangeChoose wrp">
                               <input type="range" oninput="onchangeThikness()" id="rangeThiknes" name="font_size" min="1" max="4" value="<?php echo $res_seting_tabs[0]->marginhorisontal;?>" />
                                <output id="rangevaluethiknes"></output>
                                <span id="px_thikness">0.<?php echo $res_seting_tabs[0]->thikness;?> px</span>
                            </div>
                            </td>
                            
						</tr>
						 <tr>
							<td class="middle__leftColumn">Quote color:</td>
							<td class="middle__rightColumn">
                                <div class="cPrevColorBox" id="colorSelector1">
                                    <div style="background-color:  <?php echo $res_seting_tabs[0]->font_color;?>" class="middle__fontColorExample"></div>
                                </div>
                                <input type="text" class="middle__fontColorInput" id="colorpickerField1" class="cInput" name="background" value="<?php echo $res_seting_tabs[0]->font_color;?>" style="width: 80px;margin-left: 10px;" />

                            </td>
						</tr>
						 <tr>
							<td class="middle__leftColumn">Hover color:</td>
							<td class="middle__rightColumn">
                             <div class="cPrevColorBox" id="colorSelector2">
                                <div style="background-color:  <?php echo $res_seting_tabs[0]->hover_color;?>" class="middle__fontColorExample"></div>
                            </div>
                             <input type="text" class="middle__fontColorInput" id="colorpickerField2" class="cInput" name="background" value="<?php echo $res_seting_tabs[0]->hover_color;?>" style="width: 80px;margin-left: 10px;" />
                            </td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="middle__right">
				 <p class="box__title">2. Call to action settings</p>
				<table class="middle__table action_settings">
					<tbody>
						 <tr>
							<td class="middle__leftColumn">Call to action:</td>
							<td class="middle__rightColumn">
                                <input type="text" id="actionTp" name="td_actionTp" class="middle__CallInput" value="<?php echo $res_seting_tabs[0]->callforaction;?>" style="margin-left: -40px;padding-left: 8px;"><p class="middle__CallDescr">We recommend you to <br>use short phrases</p></td>
						</tr>
						 <tr>
							<td class="middle__leftColumn">Font size:</td>
							<td class="middle__rightColumn">
                               
                                <div class="rangeChoose middle__rangeChoose">
                                     <input type="range" oninput="onchangeFSA()" id="rangefsa" name="font_size" min="1" max="20" value="<?php echo $res_seting_tabs[0]->fontsizeaction;?>" />
                                    <output id="rangevaluefsa"></output>
                                    <span id="px_fsa"><?php echo $res_seting_tabs[0]->fontsizeaction;?> px</span>
                                </div>
                            </td>
						</tr>
                        <tr>
                            <td class="middle__leftColumn">Font family:</td>
                            <td class="middle__rightColumn fontfamilyTd"> 
                           
                            <ul class="up__leftLine radioLine">
                                <li class="leftline__element leftline__element-marginSmall">
                                    <input value="Arial" type="radio" name="tweet_fontfamily" id="Arialfnt" class="leftline__radio radioCustom"  <?php echo ($res_seting_tabs[0]->font_family_call == 'Arial'?'checked="checked"':'')?>>
                                    <label for="Arialfnt">Arial</label>
                                </li>
                                <li class="leftline__element leftline__element-marginSmall">
                                    <input value="Georgia" type="radio" name="tweet_fontfamily" id="Georgiafnt" class="leftline__radio radioCustom" <?php echo ($res_seting_tabs[0]->font_family_call == 'Georgia'?'checked="checked"':'')?>>
                                    <label for="Georgiafnt">Georgia</label>
                                </li>
                            </ul>
                            </td>
                        </tr>
                             <?php
                        if($res_seting_tabs[0]->background_color!=''){
                            ?>
                             <tr>
                                <td class="middle__leftColumn">Background color:</td>
                                <td class="middle__rightColumn">
                                 <div class="cPrevColorBox" id="colorSelector3">
                                        <div style="background-color:  <?php echo $res_seting_tabs[0]->background_color;?>" class="cPrevColorBox_inside middle__fontColorExample"></div>
                                    </div>
                                
                                <input type="text" id="colorpickerField3" class="cInput middle__fontColorInput" name="background" value="<?php echo $res_seting_tabs[0]->background_color;?>" style="width: 80px;margin-left: 10px;" />
                                </td>
                            </tr>
                      
                        <?php
                                }
                        ?>
						
						 <tr>
							<td class="middle__leftColumn">Call to action color:</td>
							<td class="middle__rightColumn">
                                <div class="cPrevColorBox" id="colorSelector4">
                                    <div style="background-color:  <?php echo $res_seting_tabs[0]->Call_to_action_color;?>" class="cPrevColorBox_inside middle__fontColorExample"></div>
                                </div>
                                <input type="text" id="colorpickerField4" class="cInput middle__fontColorInput" name="background" value="<?php echo $res_seting_tabs[0]->Call_to_action_color;?>" style="width: 80px;margin-left: 10px;" />
                            </td>
						</tr>
                        
					</tbody>
				</table>
			</div>
		</div>
        </td>
    </tr>

    </tbody>

    </table>
    

            
        <?php }?>
        
        <table class="tweetThisTable">
       <tbody>

       <tr>
           <td style="padding-top: 37px;">
            <div class="box__bottom">
                <div class="bottom__left">
                     <p class="box__title">3. Resulting tweet settings</p>
                    <table class="bottom__table">
                        <tbody>
                             <tr>
                                <td class="bottom__leftColumn">Preposition:</td>
                                <td class="bottom__rightColumn prtxtTD">
                                <ul class="up__leftLine radioLine">
                                    <li class="leftline__element">
                                        <input id="RT" type="radio" name="tweet_pretext" value="RT" class="leftline__radio radioCustom">
                                        <label for="RT">RT</label>
                                    </li>
                                    <li class="leftline__element">
                                        <input id="by" type="radio" name="tweet_pretext" value="by" class="leftline__radio radioCustom">
                                        <label for="by">by</label>
                                    </li>
                                    <li class="leftline__element">
                                        <input id="via" type="radio" name="tweet_pretext" value="via" class="leftline__radio radioCustom">
                                        <label for="via">via</label>
                                    </li>
                                    <li class="leftline__element">
                                        <input id="none" type="radio" name="tweet_pretext" value="none" class="leftline__radio radioCustom">
                                        <label for="none">none</label>
                                    </li>
                                </ul>
                                </td>
                            </tr>
                             <tr>
                                <td class="bottom__leftColumn">Default twitter account:</td>
                                <td class="bottom__rightColumn"><input type="text" class="bottom__accaunt" id="twAthr" value="<?php echo $res_seting[0]->twitter_account?>"></td>
                            </tr>
                            <tr>
                                <td class="bottom__leftColumn bottom__Column-high">Default URL shortener:</td>
                                <td class="bottom__rightColumn bottom__Column-high shrtUrlTD">
                                    <ul class="up__leftLine radioLine" style="margin-bottom: 10px;">
                                        <li class="leftline__element leftline__element-marginSmall">
                                            <input id="Bit.ly" type="radio" value="bit.ly" name="url_shortener" class="leftline__radio radioCustom">
                                            <label for="Bit.ly">Bit.ly</label>
                                        </li>
                                        <li class="leftline__element leftline__element-marginSmall">
                                            <input id="Tiny URL" type="radio" value="tinyurl.com" name="url_shortener" class="leftline__radio radioCustom">
                                            <label for="Tiny URL">Tiny URL</label>
                                        </li>
                                        <li class="leftline__element leftline__element-marginSmall">
                                            <input id="Raw URL" type="radio" value="rawurl" name="url_shortener" class="leftline__radio radioCustom">
                                            <label for="Raw URL">Full URL</label>
                                        </li>
                                    </ul>
                                    <input type="hidden" value="<?php echo $res_seting[0]->access_token?>" id="connect_status"> 
                                    <div class="bitlyCreds" style="display: none;">
                                        <input type="text" class="bottom__timsoulo" name="bitly_login" value="<?php echo $res_seting[0]->login?>">
                                        <input type="password" class="bottom__pass" name="bitly_pass" value="<?php echo $res_seting[0]->password?>">
                                        <p class="bottom__cant invalid_login">Can’t connect with your login details.</p>
                                        <div class="loader_l"><img src="<?php echo TWEET_DIS_PLUGIN_URL; ?>images/loader.gif"></div>
                                        <!--<a href="javascript: void(0);" class="boxes__button-login  boxes__button" style="float: right;margin-right: 57px;" onclick="bit_ly_login(jQuery(this)); return false;">Login</a> -->    
                                        <button class="boxes__button-login  boxes__button" style="float: right;margin-right: 57px;" onclick="bit_ly_login(jQuery(this)); return false;">Login</button>   
                                    </div>
                                   
                                    <div class="bitlyCreds_stage_2" style="display: none;text-align: center;width: 288px;">
                                       <label style="float: none;margin: 0 auto;">
                                           <div class="details" style="color:#999999">Bit.Ly account in use: <?php echo $res_seting[0]->login?></div>
                                       </label>
                                       <label style="float: none;margin: 0 auto;">
                                            <!--<button style="margin-left: 0;" class="boxes__button-login  boxes__button" onclick="bit_ly_logout(jQuery(this)); return false;">Logout</a> -->
                                            <button style="margin-left: 0;" class="boxes__button-login  boxes__button" onclick="bit_ly_logout(jQuery(this)); return false;">Logout</button>
                                           
                                       </label>
                                   </div>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
               <div class="bottom__right" style="width: 45%;">
                        <p class="box__title">How the tweet looks: </p>
                        <div class="bottom__tweetlooks">
                            <div id="tweetLook" style="margin-top: 0px;">
                           <div class="userAr">
                                <span class="twAva"><img src="<?php echo TWEET_DIS_PLUGIN_URL; ?>images/avaTw.png"></span><span class="brd"><span class="name">Tim Soulo</span> <span class="twAcc">@timsoulo</span></span>
                           </div>
                           <div class="follow"></div>
                           <div class="tweetCnt">
                               <span class="by_rt" style="display: none;">none</span>
                               <span class="twcnt_rt" style="display: none;">@postAuthor</span>

                               TweetDis is an awesome plugin for Wordpress, that makes any phrase "tweetable".
                               <a href="http://tinyurl.com/d7s924w" target="_blank">http://tinyurl.com/d7s924w</a>

                               <span class="by" style="display: none;">none</span>
                               <span class="twcnt" style="display: none;">@postAuthor</span>
                           </div>
                           <div class="twetLinks"></div>
                       </div>
                            
                        </div>
                    </div>
            </div>
            
            
            
           </td>
       </tr>
        <tr class="blockTr btnsTr">
            <td>
                <div class="box__buttons">
                    <input type="button" class="tweetThisSave tweetThisBtn bottom__buttons  boxes__button" value="Save All Changes">
                    <input type="button" accept="" class="tweetThisReset tweetThisBtn bottom__buttons boxes__button-def boxes__button boxes__button-gray"  value="Default" id="tweetThisReset">
                    <div class="saved">Saved</div>
                    <div class="done_inf">Done</div>
                </div>
            </td>
        </tr>

        </tbody>

        </table>
        <script>
                
               jQuery(document).ready(function () {
                   jQuery(".prtxtTD input[value='<?php echo $res_seting[0]->preposition?>']").click();
                   jQuery(".shrtUrlTD input[value='<?php echo $res_seting[0]->shortener?>']").click();
                   jQuery('#twAthr').on('input', function() {
                        if (jQuery('input[name=tweet_pretext]:checked').length > 0) {
                            var value = jQuery('input[name=tweet_pretext]:checked').val();
                            jQuery('.tweetCnt .by_rt').html(value);
                            jQuery('.tweetCnt .twcnt_rt').html('@' + jQuery('#twAthr').val());
                            jQuery('.tweetCnt .by').html(value);
                            jQuery('.tweetCnt .twcnt').html('@' + jQuery('#twAthr').val());
                            setPreposition ();
                        }
                   });
                    
                   function setPreposition () {
                        if (jQuery('input[name=tweet_pretext]:checked').length > 0) {
                            var value = jQuery('input[name=tweet_pretext]:checked').val();
                            jQuery('.tweetCnt .by_rt').html(value);
                            jQuery('.tweetCnt .twcnt_rt').html('@' + jQuery('#twAthr').val());
                            jQuery('.tweetCnt .by').html(value);
                            jQuery('.tweetCnt .twcnt').html('@' + jQuery('#twAthr').val());

                            if (value == 'none') {
                                    jQuery('.tweetCnt .by').hide();
                                    jQuery('.tweetCnt .by_rt').hide();
                                    jQuery('.tweetCnt .twcnt_rt').hide();
                                    if(jQuery('#twAthr').val()!=''){
                                        jQuery('.tweetCnt .twcnt').show();
                                    }else{
                                        jQuery('.tweetCnt .twcnt').hide();
                                    }
                                    
                            } else if (value == 'RT') { 
                                    jQuery('.tweetCnt .by').hide();
                                    jQuery('.tweetCnt .twcnt').hide();
                                    jQuery('.tweetCnt .by_rt').show();
                                    jQuery('.tweetCnt .twcnt_rt').show();
                            }  else {
                                    jQuery('.tweetCnt .by_rt').hide();
                                    jQuery('.tweetCnt .twcnt_rt').hide();
                                    jQuery('.tweetCnt .twcnt').show();
                                    jQuery('.tweetCnt .by').show();                
                            }
                        }
                    }
                    
                    setPreposition();

                    jQuery('.prtxtTD input:radio').click(function() {
                        setPreposition();
                    });
                    
                    function setShortener () {
                        if (jQuery('input[name=url_shortener]:checked').length > 0) {
                            var val = jQuery('input[name=url_shortener]:checked').val();
                            if(val == 'rawurl'){
                               jQuery('.tweetCnt a').attr('href','http://your-blog.com/your-post');
                               jQuery('.tweetCnt a').html('http://your-blog.com/your-post'); 
                            }else{
                                jQuery('.tweetCnt a').attr('href','http://' + val + '/d7s924w');
                                jQuery('.tweetCnt a').html('http://' + val + '/d7s924w');
                            }
                            if ( val == 'bit.ly' ) {
                                var status = '<?php echo $res_seting[0]->access_token?>';
                                if(status!='no_conect'){
                                    jQuery('.bitlyCreds_stage_2').show();
                                }else{
                                    jQuery('.bitlyCreds').show();
                                }
                                
                            } else {
                                
                                    jQuery('.bitlyCreds_stage_2').hide();
                                
                                    jQuery('.bitlyCreds').hide();
                                
                            }
                        }
                    }
                    
                    setShortener();
                    
                    jQuery('.shrtUrlTD input:radio').click(function() {
                        setShortener();
                    });
                   
               });
               jQuery(document).ready(function(){
                    var val = jQuery('input[name=url_shortener]:checked').val();
                    if ( val == 'bit.ly' ) {
                        var status = '<?php echo $res_seting[0]->access_token?>';
                                if(status!='no_conect'){
                            jQuery('.bitlyCreds').hide();
                            jQuery('.bitlyCreds_stage_2').show();
                            //alert('sadf');
                        }
                        
                        else
                        {
                            //alert('2222');
                            jQuery('.bitlyCreds').show();
                            jQuery('.invalid_login').hide();
                            jQuery('.bitlyCreds_stage_2').hide();
                        }
                    } else{
                       jQuery('.bitlyCreds').hide();
                            jQuery('.invalid_login').hide();
                            jQuery('.bitlyCreds_stage_2').hide(); 
                    }
                })
                function bit_ly_login(el){
                    var login = jQuery('.bottom__timsoulo').val(),
                        pass = jQuery('.bottom__pass').val();
                        jQuery('.loader_l').show();
                    jQuery.ajax({
                        type    : "GET",
                        url     : "<?php echo TWEET_DIS_PLUGIN_URL; ?>ajax.php",
                        data    : {check_bitly: "true", login : login, pass : pass},
                        success : function(resp){
                            var text_mes = '';
                            //var obj = jQuery.parseJSON(resp);
                            try
                            {
                               var json = JSON.parse(resp);
                               text_mes = json.status_txt;
                            }
                            catch(e)
                            {
                               text_mes =  resp;
                            } 
                            jQuery('.loader_l').hide();
                            //alert(text_mes);
                            if (text_mes != 'INVALID_LOGIN')
                            {
                                jQuery('.bitlyCreds').hide();
                                jQuery('.bitlyCreds_stage_2 .details').html('Bit.Ly account in use: '+login);
                                jQuery('.bitlyCreds_stage_2').show();
                                jQuery('.bitlyCreds_stage_2').append(
                                    '<input  name="bitly_login"  value="' + login + '" type="hidden" placeholder="login">' +
                                    '<input name="bitly_pass" value="' + pass + '" type="hidden" placeholder="pasword">'
                                ); 
                                jQuery.cookie('bitly_tweetdis',1);
                                jQuery('#connect_status').val(text_mes);
                                jQuery('.tweetThisSave').trigger('click');
                                
                                // alert(jQuery.cookie('bitly_tweetdis'));

                            }
                            else
                            {
                                jQuery('.invalid_login').show();
                                jQuery('.bitlyCreds_stage_2').hide();
                            }

                        },
                        error   : function(resp){

                        }
                    });
                    return false;
                }
                
                function bit_ly_logout(){
                    jQuery.cookie('bitly_tweetdis',null);
                    jQuery('.bitlyCreds').show();
                    jQuery('.invalid_login').hide();
                    jQuery('.bitlyCreds_stage_2').hide();
                    jQuery('#connect_status').val('no_conect');
                    var data = 'connect_logaut=no_conect';
                    jQuery.ajax({
                       type: "POST",
                       url: "<?php echo TWEET_DIS_PLUGIN_URL; ?>td_ajax.php",
                       data: data,
                       success: function(msg){
                        
                       }
                     });
                  
                }
        </script>
				

    <?php }  
?>