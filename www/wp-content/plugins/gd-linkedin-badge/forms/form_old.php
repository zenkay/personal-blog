<fieldset style="border: 1px gray solid; padding: 6px">
<legend><?php _e("Title", "gd-linkedin-badge"); ?>:</legend>
    <input class="widefat" style="width: 97%;" id="gdlb-title" name="gdlb-title" type="text" value="<?php echo $title; ?>" />
</fieldset>

<fieldset style="border: 1px gray solid; padding: 6px">
<legend><?php _e("Settings", "gd-linkedin-badge"); ?>:</legend>
    <label for="gdlb-text"><?php _e("Text", "gd-linkedin-badge"); ?>:</label>
    <br /><input class="widefat" style="width: 97%;" id="gdlb-text" name="gdlb-text" type="text" value="<?php echo $text; ?>" />
    <label for="gdlb-description"><?php _e("Description", "gd-linkedin-badge"); ?>:</label>
    <br /><input class="widefat" style="width: 97%;" id="gdlb-description" name="gdlb-description" type="text" value="<?php echo $description; ?>" />
    <label for="gdlb-url"><?php _e("LinkedIn URL", "gd-linkedin-badge"); ?>:</label>
    <br /><input class="widefat" style="width: 97%;" id="gdlb-url" name="gdlb-url" type="text" value="<?php echo $url; ?>" />
    <label for="gdlb-url"><?php _e("URL Target", "gd-linkedin-badge"); ?>:</label>
    <br /><input class="widefat" style="width: 97%;" id="gdlb-target" name="gdlb-target" type="text" value="<?php echo $target; ?>" />
    <label for="gdlb-url"><?php _e("Alignment", "gd-linkedin-badge"); ?>:</label>
    <br /><input class="widefat" style="width: 97%;" id="gdlb-align" name="gdlb-align" type="text" value="<?php echo $align; ?>" />
</fieldset>

<fieldset style="border: 1px gray solid; padding: 6px">
<legend><?php _e("Badge Style", "gd-linkedin-badge"); ?>:</legend>
    <select style="width: 100%;" name="gdlb-badge" id="gdlb-badge" onchange="gdlbImageSelection(this.options[this.selectedIndex].value, 'gdlb-badge-image')"><?php $this->make_options($badge) ?></select>
    <div align="center" style="width:100%; padding-top:5px;"><img id="gdlb-badge-image" src="#" border="0" alt="" /></div>
</fieldset>
<br />
<input type="hidden" id="gdlb-submit" name="gdlb-submit" value="1" />
<script>gdlbImageSelection(<?php echo $badge; ?>, 'gdlb-badge-image');</script>
