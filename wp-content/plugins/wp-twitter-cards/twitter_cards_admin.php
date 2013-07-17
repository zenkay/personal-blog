<div>
    <h2>Twitter Cards</h2>
    
    <form action="options.php" method="post">
        <?php settings_fields("twitter_cards")?>

        <?php do_settings_sections('twitter_cards'); ?>
     
    <input name="Submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" />
    </form>
</div>