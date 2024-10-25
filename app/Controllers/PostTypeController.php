<?php

namespace RT\FoodymatCore\Controllers;

use RT\FoodymatCore\Traits\SingletonTraits;
use RT\Foodymat\Options\Opt;
use \RT_Posts;

class PostTypeController {
	use SingletonTraits;

	public $post_type;

	public function __construct() {
		$this->post_type = RT_Posts::getInstance();
		add_action('init', [$this, 'register_post_type'], 5);
	}


	/**
	 * Register post_type and taxonomy
	 *
	 * @return void
	 */
	public function register_post_type() {
		$this->register_custom_post_type();
		$this->register_custom_taxonomy();
	}

	/**
	 * Register custom post type
	 * @return void
	 */
	private function register_custom_post_type() {
		$custom_posts = [
			[
				'id'            => 'rt-team',
				'slug'          => foodymat_option('rt_team_slug'),
				'singular'      => 'Team',
				'plural'        => 'Teams',
				'menu_icon'     => 'dashicons-admin-customizer',
				'menu_position' => 20,
				'supports'      => [ 'title', 'editor', 'thumbnail', 'excerpt', 'author', 'comments' ],
				'description'   => __( 'Teams Custom Post Type', 'foodymat-core' ),
			],
			[
				'id'            => 'rt-service',
				'slug'          => foodymat_option('rt_service_slug'),
				'singular'      => 'Service',
				'plural'        => 'Services',
				'menu_icon'     => 'dashicons-admin-customizer',
				'menu_position' => 21,
				'supports'      => [ 'title', 'editor', 'thumbnail', 'excerpt', 'author', 'comments' ],
				'description'   => __( 'Service Custom Post Type', 'foodymat-core' ),
			],
			[
				'id'            => 'rt-project',
				'slug'          => foodymat_option('rt_project_slug'),
				'singular'      => 'Project',
				'plural'        => 'Project',
				'menu_icon'     => 'dashicons-admin-customizer',
				'menu_position' => 22,
				'supports'      => [ 'title', 'editor', 'thumbnail', 'excerpt', 'author', 'comments' ],
				'description'   => __( 'Project Custom Post Type', 'foodymat-core' ),
			]
		];

		$this->post_type->add_post_types( $custom_posts );
	}

	/**
	 * Register custom taxonomy
	 * @return void
	 */
	private function register_custom_taxonomy() {
		$custom_posts = [
			[
				'id'        => 'rt-team-category',
				'post_type' => [ 'rt-team' ],
				'slug'      => foodymat_option('rt_team_cat_slug'),
				'singular'  => __( 'Team Category', 'foodymat-core' ),
				'plural'    => __( 'Team Categories', 'foodymat-core' ),
			],
			[
				'id'        => 'rt-service-category',
				'post_type' => [ 'rt-service' ],
				'slug'      => foodymat_option('rt_service_cat_slug'),
				'singular'  => __( 'Service Category', 'foodymat-core' ),
				'plural'    => __( 'Service Categories', 'foodymat-core' ),
			],
			[
				'id'        => 'rt-project-category',
				'post_type' => [ 'rt-project' ],
				'slug'      => foodymat_option('rt_project_cat_slug'),
				'singular'  => __( 'Project Category', 'foodymat-core' ),
				'plural'    => __( 'Project Categories', 'foodymat-core' ),
			]
		];

		$this->post_type->add_taxonomies( $custom_posts );
	}
}

