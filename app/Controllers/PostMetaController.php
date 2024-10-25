<?php

namespace RT\FoodymatCore\Controllers;

use RT\Foodymat\Helpers\Fns;
use \RT_Postmeta;
use RT\FoodymatCore\Traits\SingletonTraits;
use RT\FoodymatCore\Builder\Builder;
use RT\FoodymatCore\Helper\FnsBuilder;
use RT\FoodymatCore\Modules\IconList;

class PostMetaController {
	use SingletonTraits;

	public $postmeta;

	public function __construct() {
		$this->postmeta = RT_Postmeta::getInstance();
//		$this->add_meta_box();
		add_action( 'init', [ $this, 'add_meta_box' ] );
	}

	/**
	 * Add all metabox
	 * @return void
	 */
	function add_meta_box() {

		$this->postmeta->add_meta_box(
			"rt_page_settings",
			__( 'Layout Settings', 'foodymat-core' ),
			[ 'page', 'post', 'rt-team', 'rt-service', 'rt-project' ],
			'',
			'',
			'high',
			[
				'fields' => [
					"rt_layout_meta_data" => [
						'label' => __( 'Layouts', 'foodymat-core' ),
						'type'  => 'group',
						'value' => $this->get_post_page_meta_args(),
					],
				],
			]
		);

		//Post Info
		$this->postmeta->add_meta_box(
			"rt_post_info",
			__( 'Post Info', 'foodymat-core' ),
			[ 'post' ],
			'',
			'',
			'high',
			[
				'fields' => $this->get_post_info_meta(),
			]
		);

		//Team meta
		$this->postmeta->add_meta_box(
			"rt_team_info",
			__( 'Team Info', 'foodymat-core' ),
			[ 'rt-team' ],
			'',
			'',
			'high',
			[
				'fields' => $this->get_team_info_meta(),
			]
		);
		$this->postmeta->add_meta_box(
			"rt_team_social",
			__( 'Team Social', 'foodymat-core' ),
			[ 'rt-team' ],
			'',
			'',
			'high',
			[
				'fields' => $this->get_team_social_meta(),
			]
		);

		$this->postmeta->add_meta_box(
			"rt_team_skill",
			__( 'Team Skill', 'foodymat-core' ),
			[ 'rt-team' ],
			'',
			'',
			'high',
			[
				'fields' => $this->get_team_skill_meta(),
			]
		);

		$this->postmeta->add_meta_box(
			"rt_team_contact",
			__( 'Team Contact', 'foodymat-core' ),
			[ 'rt-team' ],
			'',
			'',
			'high',
			[
				'fields' => $this->get_team_contact_meta(),
			]
		);

        //service meta
        $this->postmeta->add_meta_box(
            "rt_service_icon",
            __( 'Service Icon', 'foodymat-core' ),
            [ 'rt-service' ],
            '',
            '',
            'high',
            [
                'fields' => $this->get_service_icon_meta(),
            ]
        );

		//Project meta
		$this->postmeta->add_meta_box(
			"rt_project_info",
			__( 'Project Info', 'foodymat-core' ),
			[ 'rt-project' ],
			'',
			'',
			'high',
			[
				'fields' => $this->get_project_info_meta(),
			]
		);

        //header footer build
		$this->postmeta->add_meta_box(
			"rt_el_builder_settings",
			__( 'Header - Footer Builder Settings', 'foodymat-core' ),
			[ 'elementor-foodymat' ],
			'',
			'',
			'high',
			[
				'fields' => $this->get_el_builder_meta_args(),
			]
		);
	}

	function get_el_builder_meta_args() {
		return apply_filters( 'foodymat_layout_meta_field', [
			'template_type' => [
				'label'   => __( 'Template Type', 'foodymat-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Choose Options', 'foodymat-core' ),
					'header'  => __( 'Header', 'foodymat-core' ),
					'footer'  => __( 'Footer', 'foodymat-core' ),
				],
				'default' => 'default',
			],

			'show_on' => [
				'label'   => __( 'Show On', 'foodymat-core' ),
				'type'    => 'multi_select2',
				'options' => FnsBuilder::get_builder_type(),
				'default' => [],
				'class'   => 'rt-header-footer-select'
			],

			'choose_post' => [
				'label'       => __( 'Choose posts or pages', 'foodymat-core' ),
				'type'        => 'ajax_select',
				'data_source' => 'post',
				'default'     => [],
			],

		] );
	}

	function get_post_page_meta_args() {
		$sidebars = [ 'default' => __( 'Default from customizer', 'foodymat-core' ) ] + Fns::sidebar_lists();

		return apply_filters( 'foodymat_layout_meta_field', [
			'layout'            => [
				'label'   => __( 'Layout', 'foodymat-core' ),
				'type'    => 'select',
				'options' => [
					'default'       => __( 'Default from customizer', 'foodymat-core' ),
					'full-width'    => __( 'Full Width', 'foodymat-core' ),
					'left-sidebar'  => __( 'Left Sidebar', 'foodymat-core' ),
					'right-sidebar' => __( 'Right Sidebar', 'foodymat-core' ),
				],
				'default' => 'default',
			],
			'single_post_style' => [
				'label'   => __( 'Post View Style', 'foodymat-core' ),
				'type'    => 'select',
				'options' => [ 'default' => __( 'Default from customizer', 'foodymat-core' ) ] + Fns::single_post_style(),
				'default' => 'default',
			],
			'header_style'      => [
				'label'   => __( 'Header Style', 'foodymat-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'foodymat-core' ),
					'1'       => __( 'Layout 1', 'foodymat-core' ),
					'2'       => __( 'Layout 2', 'foodymat-core' ),
				],
				'default' => 'default',
			],
			'sidebar'           => [
				'label'   => __( 'Custom Sidebar', 'foodymat-core' ),
				'type'    => 'select',
				'options' => $sidebars,
				'default' => 'default',
			],
			'top_bar'           => [
				'label'   => __( 'Top Bar Visibility', 'foodymat-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'foodymat-core' ),
					'on'      => __( 'ON', 'foodymat-core' ),
					'off'     => __( 'OFF', 'foodymat-core' ),
				],
				'default' => 'default',
			],
			'topbar_style'      => [
				'label'   => __( 'Top Bar Style', 'foodymat-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'foodymat-core' ),
					'1'       => __( 'Layout 1', 'foodymat-core' ),
				],
				'default' => 'default',
			],
			'header_width'      => [
				'label'   => __( 'Header Width', 'foodymat-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'foodymat-core' ),
					'box'     => __( 'Box Width', 'foodymat-core' ),
					'full'    => __( 'Full Width', 'foodymat-core' ),
				],
				'default' => 'default',
			],
			'menu_alignment'    => [
				'label'   => __( 'Menu Alignment', 'foodymat-core' ),
				'type'    => 'select',
				'options' => [
					'default'     => __( 'Default from customizer', 'foodymat-core' ),
					'menu-left'   => __( 'Left Alignment', 'foodymat-core' ),
					'menu-center' => __( 'Center Alignment', 'foodymat-core' ),
					'menu-right'  => __( 'Right Alignment', 'foodymat-core' ),
				],
				'default' => 'default',
			],

			'tr_header'        => [
				'label'   => __( 'Transparent Header', 'foodymat-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'foodymat-core' ),
					'on'      => __( 'ON', 'foodymat-core' ),
					'off'     => __( 'OFF', 'foodymat-core' ),
				],
				'default' => 'default',
			],

			'tr_header_color' => [
				'label'   => __( 'Transparent color', 'foodymat-core' ),
				'type'    => 'select',
				'options' => [
					'default'   => __( 'Default from customizer', 'foodymat-core' ),
					'tr-header-light'   => __( 'Light Color', 'foodymat-core' ),
					'tr-header-dark'    => __( 'Dark Color', 'foodymat-core' ),
				],
				'default' => 'default',
			],

			'banner'           => [
				'label'   => __( 'Banner Visibility', 'foodymat-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'foodymat-core' ),
					'on'      => __( 'ON', 'foodymat-core' ),
					'off'     => __( 'OFF', 'foodymat-core' ),
				],
				'default' => 'default',
			],
			'breadcrumb_title' => [
				'label'   => __( 'Banner Title', 'foodymat-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'foodymat-core' ),
					'on'      => __( 'ON', 'foodymat-core' ),
					'off'     => __( 'OFF', 'foodymat-core' ),
				],
				'default' => 'default',
			],
			'breadcrumb'       => [
				'label'   => __( 'Banner Breadcrumb', 'foodymat-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'foodymat-core' ),
					'on'      => __( 'ON', 'foodymat-core' ),
					'off'     => __( 'OFF', 'foodymat-core' ),
				],
				'default' => 'default',
			],

			'banner_image'    => [
				'type'  => 'image',
				'label' => __( 'Banner Background Image', 'foodymat-core' ),
			],
			'banner_color'    => [
				'type'  => 'color_picker',
				'label' => __( 'Banner Background Color', 'foodymat-core' ),
			],


			'footer_style'     => [
				'label'   => __( 'Footer Layout', 'foodymat-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'foodymat-core' ),
					'1'       => __( 'Layout 1', 'foodymat-core' ),
					'2'       => __( 'Layout 2', 'foodymat-core' ),
				],
				'default' => 'default',
			],
			'footer_schema'    => [
				'label'   => __( 'Footer Schema', 'foodymat-core' ),
				'type'    => 'select',
				'options' => [
					'default'      => __( 'Default from customizer', 'foodymat-core' ),
					'footer-light' => __( 'Light Footer', 'foodymat' ),
					'footer-dark'  => __( 'Dark Footer', 'foodymat' ),
				],
				'default' => 'default',
			],
			'padding_top'    => [
				'label' => __( 'Padding Top (Page Content)', 'foodymat-core' ),
				'type'  => 'number',
			],
			'padding_bottom'   => [
				'label' => __( 'Padding Bottom (Page Content)', 'foodymat-core' ),
				'type'  => 'number',
			],
			'page_bg_image'    => [
				'type'  => 'image',
				'label' => __( 'Background Image', 'foodymat-core' ),
			],
			'page_bg_color'    => [
				'type'  => 'color_picker',
				'label' => __( 'Background Color', 'foodymat-core' ),
			],

		] );
	}

	function get_post_info_meta() {
		return apply_filters( 'rt_post_info', [
			'rt_youtube_link' => [
				'label'   => __( 'Youtube Link', 'foodymat-core' ),
				'type'    => 'text',
				'default' => '',
			],
			'rt_post_gallery' => [
				'label' => __( 'Post Gallery', 'foodymat-core' ),
				'type'  => 'gallery',
				'desc'  => __( 'Only work for the gallery post format', 'foodymat-core' ),
			],
		] );
	}

	//Team meta info
	function get_team_info_meta() {
		return apply_filters( 'rt_team_meta_field', [
			'rt_team_info_title' => array(
				'label' => __( 'Information Title', 'foodymat-core' ),
				'type'  => 'text',
			),

			'rt_team_designation' => [
				'label'   => __( 'Team Designation', 'foodymat-core' ),
				'type'    => 'text',
				'default' => '',
			],

			'rt_team_phone' => [
				'label'   => __( 'Team Phone', 'foodymat-core' ),
				'type'    => 'text',
				'default' => '',
			],

			'rt_team_website' => [
				'label'   => __( 'Team Website', 'foodymat-core' ),
				'type'    => 'text',
				'default' => '',
			],

			'rt_team_email' => [
				'label'   => __( 'Team Email', 'foodymat-core' ),
				'type'    => 'text',
				'default' => '',
			],

			'rt_team_address' => [
				'label'   => __( 'Team Address', 'foodymat-core' ),
				'type'    => 'text',
				'default' => '',
			],

		] );
	}
	function get_team_social_meta() {
		return apply_filters( 'rt_team_meta_social', [
			'rt_team_socials' => array(
				'type'  => 'group',
				'value' => Fns::get_team_socials(),
			),
		] );
	}

	function get_team_skill_meta() {
		return apply_filters( 'rt_team_meta_skill', [

			'rt_team_skill_title' => array(
				'label' => __( 'Skill Title', 'foodymat-core' ),
				'type'  => 'text',
			),

			'rt_team_skill_info' => [
				'label'   => __( 'Team Skill Info', 'foodymat-core' ),
				'type'    => 'textarea',
			],

			'rt_team_skill' => [
				'type'  => 'repeater',
				'button' => __( 'Add New Skill', 'foodymat-core' ),
				'value'  => [
					'skill_name' => [
						'label' => __( 'Skill Name', 'foodymat-core' ),
						'type'  => 'text',
						'desc'  => __( 'eg. Marketing', 'foodymat-core' ),
					],
					'skill_value' => [
						'label' => __( 'Skill Percentage (%)', 'foodymat-core' ),
						'type'  => 'text',
						'desc'  => __( 'eg. 75', 'foodymat-core' ),
					],
					'skill_color' => [
						'label' => __( 'Skill Color', 'foodymat-core' ),
						'type'  => 'color_picker',
						'desc'  => __( 'If not selected, primary color will be used', 'foodymat-core' ),
					],
				]
			],
		] );
	}

	function get_team_contact_meta() {
		return apply_filters( 'rt_team_meta_contact', [
			'rt_team_contact_form' => array(
				'label' => __( 'Contact Form Shortcode', 'foodymat-core' ),
				'type'  => 'text',
			),
		] );
	}

    // Service meta info

    function get_service_icon_meta() {
        return apply_filters( 'rt_service_meta_icon', [
            'rt_service_icon'    => [
                'label'   => __( 'Service Icon', 'foodymat-core' ),
                'type'    => 'select',
                'options' => IconList::fontello_service(),
            ],
            'rt_service_color'    => [
	            'label'   => __( 'Service Color', 'foodymat-core' ),
	            'type'  => 'color_picker',
            ],
        ] );
    }


	//Project meta info
	function get_project_info_meta() {
		return apply_filters( 'rt_project_meta_field', [
			'rt_project_title' => [
				'label'   => __( 'Info Title', 'foodymat-core' ),
				'type'    => 'text',
				'default' => __( 'Project Info', 'foodymat-core' ),
			],

			'rt_project_text' => [
				'label'   => __( 'Info Text', 'foodymat-core' ),
				'type'    => 'text',
				'default' => '',
			],

			'rt_project_client' => [
				'label'   => __( 'Client', 'foodymat-core' ),
				'type'    => 'text',
				'default' => '',
			],

			'rt_project_start' => [
				'label'   => __( 'Starts On', 'foodymat-core' ),
				'type'    => 'text',
				'default' => '',
			],

			'rt_project_end' => [
				'label'   => __( 'End On', 'foodymat-core' ),
				'type'    => 'text',
				'default' => '',
			],

			'rt_project_weblink' => [
				'label'   => __( 'Weblink', 'foodymat-core' ),
				'type'    => 'text',
				'default' => '',
			],

			'rt_project_rating' => [
				'label' => __( 'Select the Rating', 'foodymat-core' ),
				'type'  => 'select',
				'options' => array(
					'-1' => __( 'Default', 'foodymat-core' ),
					'1'    => '1',
					'2'    => '2',
					'3'    => '3',
					'4'    => '4',
					'5'    => '5'
				),
				'default'  => '-1',
			],

		] );
	}
}

