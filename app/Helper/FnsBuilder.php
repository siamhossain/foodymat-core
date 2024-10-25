<?php

namespace RT\FoodymatCore\Helper;

class FnsBuilder {

	/**
	 * Get builder type options for metabox
	 * @return mixed|null
	 */
	public static function get_builder_type() {

		$allPost = [
			'post' => __( 'Post', 'foodymat-core' ),
			'page' => __( 'Post', 'foodymat-core' ),
		];
		if ( defined( 'FOODYMAT_CORE' ) ) {
			$allPost = Fns::get_post_types();
		}

		$default_pages = [
			'is_front_page' => __( 'Front Page', 'foodymat-core' ),
			'is_home'       => __( 'Blog / Posts Page', 'foodymat-core' ),
			'is_search'     => __( 'Search Page', 'foodymat-core' ),
			'is_archive'    => __( 'Archive', 'foodymat-core' ),
			'is_404'        => __( '404 Page', 'foodymat-core' ),
		];

		if ( class_exists( 'WooCommerce' ) ) {
			$default_pages['is_shop'] = __( 'WooCommerce Shop Page', 'foodymat-core' );
		}

		$selection_options = [
			'sitewide' => [
				'label' => __( 'Sitewide', 'foodymat-core' ),
				'value' => [
					'sitewide-global'    => __( 'Entire Website', 'foodymat-core' ),
					'sitewide-singulars' => __( 'All Singulars', 'foodymat-core' ),
					'sitewide-archives'  => __( 'All Archives', 'foodymat-core' ),
				],
			],

			'default-pages' => [
				'label' => __( 'Default Pages', 'foodymat-core' ),
				'value' => $default_pages,
			],
		];


		foreach ( $allPost as $post_type => $post_type_name ) {
			$pTypeVal = [];
			if ( $post_type == 'page' ) {
				$pTypeVal['single|page'] = __( "All Pages", "foodymat-core" );
			} else {
				$pTypeVal = [
					"single-$post_type"  => sprintf( __( 'All %s Single', 'foodymat-core' ), $post_type_name ),
					"archive-$post_type" => sprintf( __( 'All %s Archive', 'foodymat-core' ), $post_type_name ),
				];
			}

			$taxonomies = get_taxonomies( [
				'object_type' => [ $post_type ]
			], 'object' );

			if ( $taxonomies ) {
				foreach ( $taxonomies as $taxonomy ) {
					if ( in_array( $taxonomy->name, [ 'post_format' ] ) ) {
						continue;
					}
					$pTypeVal[ 'tax-' . $taxonomy->name ] = $taxonomy->label;
				}
			}

			$selection_options[ $post_type ] = [
				'label' => $post_type_name,
				'value' => $pTypeVal,
			];

		}

		/*//Custom Page / Post
		$selection_options['custom'] = [
			'label' => __( 'Custom Page / Post', 'foodymat-core' ),
			'value' => [
				'custom' => __( 'Choose custom page / post', 'foodymat-core' )
			]
		];*/

		return apply_filters( 'foodymat_builder_type', $selection_options );

	}

	/**
	 * Check meta condition for sitewide
	 *
	 * @param $current_page
	 * @param $show_on
	 * @param $choose_post
	 *
	 * @return bool
	 */
	public static function condition_by_sitewide( $current_page, $show_on, $choose_post ) {


		if ( 'is_singular' == $current_page && ( is_array( $choose_post ) && in_array( get_the_ID(), $choose_post ) ) ) {
			//Check selected singular page dependent on the 'choose_post' meta
			return true;
		}

		if ( ! $show_on ) {
			return false;
		}

		if ( 'is_singular' == $current_page && in_array( 'sitewide-singulars', $show_on ) ) {
			return true;
		}

		if ( 'is_archive' == $current_page ) {
			if ( in_array( 'sitewide-archives', $show_on ) ) {
				return true;
			}
		}

		if ( in_array( 'sitewide-global', $show_on ) ) {
			return true;
		}


		return false;

	}

	/**
	 * Check condition for all page type of custom post type
	 *
	 * @param $current_page
	 * @param $show_on
	 *
	 * @return bool
	 */
	public static function condition_by_cpt( $current_page, $show_on ) {
		$custom_post = Fns::get_post_types( [ 'page' ] );
		if ( ! empty( $custom_post ) ) {
			foreach ( $custom_post as $post_type => $label ) {

				//Check CPT Archive page
				if ( 'is_archive' == $current_page && is_post_type_archive( $post_type ) && in_array( 'archive-' . $post_type, $show_on ) ) {
					return true;
				}

				//Check CPT Single page
				if ( 'is_singular' == $current_page && is_singular( $post_type ) && in_array( 'single-' . $post_type, $show_on ) ) {
					return true;
				}

				//Check CPT Taxonomy page
				if ( 'is_tax' == $current_page ) {
					$taxonomies = get_taxonomies( [
						'object_type' => [ $post_type ]
					], 'object' );

					if ( $taxonomies ) {
						foreach ( $taxonomies as $taxonomy ) {
							if ( is_tax( $taxonomy->name ) && in_array( 'tax-' . $taxonomy->name, $show_on ) ) {
								return true;
							}
						}
					}
				}

			}
		}


		return false;
	}

	/**
	 * Get
	 *
	 * @param $type
	 *
	 * @return int[]|\WP_Post[]
	 */
	public static function get_template_type( $type ) {
		return get_posts( [
			'post_type'      => 'elementor-foodymat',
			'posts_per_page' => - 1,
			'post_status'    => 'publish',
			'fields'         => 'ids',
			'meta_query'     => [
				[
					'key'     => 'template_type',
					'value'   => $type,
					'compare' => '=',
				]
			]
		] );
	}

}
