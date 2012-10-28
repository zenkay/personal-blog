<fieldset class="gdlb-fieldset">
<legend><?php _e("Title", "gd-linkedin-badge"); ?>:</legend>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</fieldset>

<fieldset class="gdlb-fieldset">
<legend><?php _e("Settings", "gd-linkedin-badge"); ?>:</legend>
    <label for="<?php echo $this->get_field_id('text'); ?>"><?php _e("Text", "gd-linkedin-badge"); ?>:</label>
    <br />
    <input class="widefat gdlb-input" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" type="text" value="<?php echo $text; ?>" />
    <label for="<?php echo $this->get_field_id('description'); ?>"><?php _e("Description", "gd-linkedin-badge"); ?>:</label>
    <br />
    <input class="widefat gdlb-input" id="<?php echo $this->get_field_id('description'); ?>" name="<?php echo $this->get_field_name('description'); ?>" type="text" value="<?php echo $description; ?>" />
    <label for="<?php echo $this->get_field_id('url'); ?>"><?php _e("LinkedIn URL", "gd-linkedin-badge"); ?>:</label>
    <br />
    <input class="widefat gdlb-input" id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>" type="text" value="<?php echo $url; ?>" />
    <label for="<?php echo $this->get_field_id('url'); ?>"><?php _e("URL Target", "gd-linkedin-badge"); ?>:</label>
    <br />
    <input class="widefat gdlb-input" id="<?php echo $this->get_field_id('target'); ?>" name="<?php echo $this->get_field_name('target'); ?>" type="text" value="<?php echo $target; ?>" />
    <label for="<?php echo $this->get_field_id('url'); ?>"><?php _e("Alignment", "gd-linkedin-badge"); ?>:</label>
    <br />
    <input class="widefat gdlb-input" id="<?php echo $this->get_field_id('align'); ?>" name="<?php echo $this->get_field_name('align'); ?>" type="text" value="<?php echo $align; ?>" />
</fieldset>

<fieldset class="gdlb-fieldset">
<legend><?php _e("Badge Style", "gd-linkedin-badge"); ?>:</legend>
    <select style="width: 100%;" name="<?php echo $this->get_field_name('badge'); ?>" id="<?php echo $this->get_field_id('badge'); ?>" onchange="gdlbImageSelection(this.options[this.selectedIndex].value, '<?php echo $this->get_field_id('image'); ?>')">
        <?php $gdlb->make_options($badge) ?>
    </select>
    <div align="center" style="width:100%; padding-top:5px;">
        <img id="<?php echo $this->get_field_id('image'); ?>" src="#" border="0" alt="" />
    </div>
</fieldset>

<script type="text/javascript">gdlbImageSelection(<?php echo $badge; ?>, '<?php echo $this->get_field_id('image'); ?>');</script>
