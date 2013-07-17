<?php 
    $prev_desc = get_post_meta($post->ID, "twitter_cards_post_description", true);
    $prev_title = get_post_meta($post->ID, "twitter_cards_post_title", true);
    $prev_creator = get_post_meta($post->ID, "twitter_cards_post_creator_username", true);
    $prev_type = get_post_meta($post->ID, "twitter_cards_post_type", true);
    $prev_img = get_post_meta($post->ID, "twitter_cards_post_image", true);
    $prev_iframe = get_post_meta($post->ID, "twitter_cards_post_iframe", true);
    $prev_stream = get_post_meta($post->ID, "twitter_cards_post_stream", true);
    wp_nonce_field( 'twitter_cards_post_nonce', 'twitter_cards_post_nonce' );
?>
 
<p><label for="twitter_cards_post_title"><b>Title</b></label></p>
<p><input class="large-text" type="text" placeholder="Maximum 70 chars" maxlength="70" name="twitter_cards_post_title" value="<?php echo $prev_title; ?>"></p>
<p><label for="twitter_cards_post_description"><b>Description</b></label></p>
<p><textarea cols="4" rows="4" class="large-text" placeholder="Maximum 200 chars" maxlength="200" name="twitter_cards_post_description"><?php echo $prev_desc; ?></textarea></p>
<p><label for="twitter_cards_post_image"><b>Image</b></label></p>
<p><input class="large-text" value="<?php echo $prev_img; ?>" type="url" value="<?php echo $prev_img; ?>" name="twitter_cards_post_image"></p>
<?php    echo "<h4>" . __( 'Twitter Settings', 'twitter_cards_trdom' ) . "</h4>"; ?>
<p><label for="twitter_cards_post_type"><b>Post Type</b></label></p>
<p>
    <select class="large-text" name="twitter_cards_post_type" id="twitter_cards_post_type" onchange="wptc_hide()">
        <option value="summary" <?php selected( 0, $prev_type, true)?>>Summary</option>
        <option value="photo" <?php selected( 0, $prev_type, true)?>>Photo</option>
        <option value="player" <?php selected( 0, $prev_type, true)?>>Player</option>
    </select>
</p>
<p id="twitter_cards_iframe_label"><label for="twitter_cards_post_iframe"><b>iFrame</b></label></p>
<p id="twitter_cards_iframe_input"><input class="large-text" placeholder="https url to an iFrame" value="<?php echo $prev_iframe; ?>" type="url" name="twitter_cards_post_iframe"></p>
<p id="twitter_cards_stream_label"><label for="twitter_cards_post_stream"><b>Stream</b></label></p>
<p id="twitter_cards_stream_input"><input class="large-text" placeholder="Driect link to media file" value="<?php echo $prev_stream; ?>" type="url" name="twitter_cards_post_stream"></p>
<p><label for="twitter_cards_post_creator_username"><b>Username</b></label></p>
<p><input class="large-text" type="text" placeholder="The @username of the creator" name="twitter_cards_post_creator_username" value="<?php echo $prev_creator; ?>"></p>

<script type="text/javascript">
    var stream = document.getElementById('twitter_cards_stream_input');
    var stream_label = document.getElementById('twitter_cards_stream_label');
    var iframe = document.getElementById('twitter_cards_iframe_input');
    var iframe_label = document.getElementById('twitter_cards_iframe_label');
    wptc_hide();

    function wptc_hide () {

        stream.style.display="none";
        stream_label.style.display="none";
        iframe.style.display="none";
        iframe_label.style.display="none";

        var card_type = document.getElementById('twitter_cards_post_type');
        card_type = card_type.options[card_type.selectedIndex].value;

        if (card_type == 'player') {
            stream.style.display="block";
            stream_label.style.display="block";
            iframe.style.display="block";
            iframe_label.style.display="block";
        }
    }
</script>