<?php

namespace RT\FoodymatCore\Controllers;

use RT\FoodymatCore\Traits\SingletonTraits;

/**
 * Enqueue.
 */
class ScriptController {
	use SingletonTraits;

	/**
	 * register default hooks and actions for WordPress
	 * @return
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
	}

	/**
	 * Enqueue Scripts
	 * @return void
	 */
	public function enqueue_scripts() {
		//wp_register_script( 'pannellum', FOODYMAT_CORE_BASE_URL . 'assets/js/pannellum.js', '', '2.5.6', true );
		//wp_register_style( 'pannellum', FOODYMAT_CORE_BASE_URL . 'assets/css/pannellum.css', '', '2.5.6' );
		//wp_enqueue_style( 'pannellum' );
		//wp_enqueue_script( 'pannellum' );
	}


}
