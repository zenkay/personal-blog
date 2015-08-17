<?php
namespace TokenToMe\TwitterCards\Admin;

if ( ! defined( 'JM_TC_VERSION' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

?>
<div class="wrap">
	<h1 class="page-title-action">JM Twitter Cards : <?php echo esc_html( get_admin_page_title() ); ?></h1>

	<?php echo Tabs::admin_tabs(); ?>

	<p><?php esc_html_e( 'Updated' ); ?> : 14/05/2015</p>

	<p><a href="https://dev.twitter.com/cards/overview">Documentation</a></p>

</div>
