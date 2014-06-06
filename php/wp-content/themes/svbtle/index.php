<?php

get_header();

date_default_timezone_set('America/Toronto');


?>

<div class="entry-meta">

</div><!-- .entry-meta -->

<header id="begin">
	<time datetime="<?php echo date('Y-m-d'); ?>" id="top_time"><?php echo date('F d, Y'); ?></time>
</header>

<?php

get_template_part( 'loop', 'index' );

get_footer();

?>