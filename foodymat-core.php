<?php
/*
Plugin Name: Foodymat Core
Plugin URI: https://www.radiustheme.com
Description: Foodymat Theme Core Plugin
Version: 1.0.3
Author: RadiusTheme
Author URI: https://www.radiustheme.com
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'FOODYMAT_CORE' ) ) {
	define( 'FOODYMAT_CORE', '1.0.1' );
	define( 'FOODYMAT_CORE_PREFIX', 'foodymat' );
	define( 'FOODYMAT_CORE_BASE_URL', plugin_dir_url( __FILE__ ) );
	define( 'FOODYMAT_CORE_BASE_DIR', plugin_dir_path( __FILE__ ) );
}

if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) :
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
endif;

if ( class_exists( 'RT\\FoodymatCore\\Init' ) ) :
	RT\FoodymatCore\Init::instance();
endif;

define( 'RDTHEME_CORE_DEMO_CONTENT', plugin_dir_path( __FILE__ ) . '/demo-content/' );
define( 'RDTHEME_CORE_BASE_URL', plugin_dir_url( __FILE__ ) . 'demo-content/' );

require_once RDTHEME_CORE_DEMO_CONTENT . 'demo-content.php';