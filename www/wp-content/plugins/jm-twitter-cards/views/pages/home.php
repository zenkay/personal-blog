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

	<?php
	/**
	 * Fields for admin page home (page for posts/front page)
	 * @return array
	 */
	function jm_tc_home_options() {
		$plugin_options = array(
			'id'         => 'jm_tc',
			'show_on'    => array( 'key' => 'options-page', 'value' => array( 'jm_tc_home', ), ),
			'show_names' => true,
			'fields'     => array(

				array(
					'name' => __( 'Home meta desc', JM_TC_TEXTDOMAIN ),
					'desc' => __( 'Enter desc for Posts Page (max: 200 characters)', JM_TC_TEXTDOMAIN ),
					'id'   => 'twitterPostPageDesc',
					'type' => 'textarea_small',
				),

			)
		);

		return $plugin_options;
	}

	cmb_metabox_form( jm_tc_home_options(), Main::key() ); ?>
</div>


