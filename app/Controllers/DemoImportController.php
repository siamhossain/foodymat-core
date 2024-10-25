<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\FoodymatCore\Controllers;
use \FW_Ext_Backups_Demo;
use RT\FoodymatCore\Traits\SingletonTraits;

class DemoImportController {
	use SingletonTraits;

	public function __construct() {
		add_filter( 'plugin_action_links_rt-demo-importer/rt-demo-importer.php', array( $this, 'add_action_links' ) );
		add_filter( 'rt_demo_installer_warning', array( $this, 'data_loss_warning' ) );
		add_filter( 'fw:ext:backups-demo:demos', array( $this, 'demo_config' ) );
	}

	public function add_action_links( $links ) {
		$mylinks = array(
			'<a href="' . esc_url( admin_url( 'tools.php?page=fw-backups-demo-content' ) ) . '">' . __( 'Install Demo Contents', 'foodymat-core' ) . '</a>',
		);

		return array_merge( $links, $mylinks );
	}

	public function data_loss_warning( $links ) {
		$html = '<div style="margin-top:20px; color:#fff; font-size:17px; line-height:1.3; font-weight:600; margin-bottom:40px; padding:10px 24px; background-color: #f00">';
		$html .= __( 'Warning: All your old data will be lost if you install One Click demo data from here, so it is suitable only for a new website.', 'foodymat-core' );
		$html .= '</div>';

		return $html;
	}

	public function demo_config( $demos ) {
		$demos_array = array(
			'demo1' => array(
				'title'        => __( 'Main ( Software )', 'foodymat-core' ),
				'screenshot'   => FOODYMAT_CORE_BASE_URL . 'screenshots/1.png',
				'preview_link' => 'https://www.radiustheme.com/demo/wordpress/themes/foodymat/',
				'download_link' => 'https://demo.radiustheme.com/wordpress/demo-content/foodymat/',
			),
			'demo2' => array(
				'title'        => __( 'Business Agency', 'foodymat-core' ),
				'screenshot'   => FOODYMAT_CORE_BASE_URL . 'screenshots/2.png',
				'preview_link' => 'https://www.radiustheme.com/demo/wordpress/themes/foodymat/agency/',
				'download_link' => 'https://demo.radiustheme.com/wordpress/demo-content/foodymat/',
			),
		);

		foreach ( $demos_array as $id => $data ) {
			$demo = new FW_Ext_Backups_Demo( $id, 'piecemeal', array(
				'url'     => $data['download_link'],
				'file_id' => $id,
			) );
			$demo->set_title( $data['title'] );
			$demo->set_screenshot( $data['screenshot'] );
			$demo->set_preview_link( $data['preview_link'] );

			$demos[ $demo->get_id() ] = $demo;

			unset( $demo );
		}

		return $demos;
	}
}
