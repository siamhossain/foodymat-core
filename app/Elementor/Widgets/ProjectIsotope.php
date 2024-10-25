<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\FoodymatCore\Elementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use RT\FoodymatCore\Abstracts\ElementorBase;
use RT\FoodymatCore\Helper\Fns;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ProjectIsotope extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'RT Project Isotope', 'foodymat-core' );
		$this->rt_base = 'rt-project-isotope';
		$this->rt_translate = array(
			'cols'  => array(
				'12' => esc_html__( '1 Col', 'foodymat-core' ),
				'6'  => esc_html__( '2 Col', 'foodymat-core' ),
				'4'  => esc_html__( '3 Col', 'foodymat-core' ),
				'3'  => esc_html__( '4 Col', 'foodymat-core' ),
				'2'  => esc_html__( '6 Col', 'foodymat-core' ),
			),
		);
		parent::__construct( $data, $args );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'sec_general',
			[
				'label' => esc_html__( 'General', 'foodymat-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'layout',
			[
				'label'       => esc_html__( 'Project Layout', 'foodymat-core' ),
				'type'        => Controls_Manager::SELECT2,
				'options'   => [
					'layout-1' => esc_html__( 'Project Grid 01', 'foodymat-core' ),
					'layout-2' => esc_html__( 'Project Grid 02', 'foodymat-core' ),
					'layout-3' => esc_html__( 'Project Grid 03', 'foodymat-core' ),
					'layout-4' => esc_html__( 'Project Grid 04', 'foodymat-core' ),
					'layout-5' => esc_html__( 'Project Grid 05', 'foodymat-core' ),
					'layout-6' => esc_html__( 'Project Grid 06', 'foodymat-core' ),
					'layout-7' => esc_html__( 'Project Grid 07', 'foodymat-core' ),
				],
				'default'     => 'layout-1',
			]
		);

		$this->add_responsive_control(
			'alignment',
			[
				'label'     => esc_html__( 'Alignment', 'foodymat-core' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => esc_html__( 'Left', 'foodymat-core' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'foodymat-core' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => esc_html__( 'Right', 'foodymat-core' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-project-default .project-item' => 'text-align: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'post_limit',
			[
				'label'       => esc_html__( 'Project Limit', 'foodymat-core' ),
				'type'        => \Elementor\Controls_Manager::NUMBER,
				'placeholder' => esc_html__( 'Enter Project Limit', 'foodymat-core' ),
				'description' => esc_html__( 'Enter number of team to show.', 'foodymat-core' ),
				'default'     => '6',
			]
		);

		$this->add_control(
			'item_space',
			[
				'type'        => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Item Gutter', 'foodymat-core' ),
				'options' => [
					'g-0' => __( 'Gutters 0', 'foodymat-core' ),
					'g-1' => __( 'Gutters 1', 'foodymat-core' ),
					'g-2' => __( 'Gutters 2', 'foodymat-core' ),
					'g-3' => __( 'Gutters 3', 'foodymat-core' ),
					'g-4' => __( 'Gutters 4', 'foodymat-core' ),
					'g-5' => __( 'Gutters 5', 'foodymat-core' ),
				],
				'default' => 'g-4',
			]
		);

		$this->add_control(
			'query_type',
			[
				'label' => esc_html__( 'Query type', 'foodymat-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'category',
				'options' => array(
					'category'  => esc_html__( 'Category', 'foodymat-core' ),
					'posts' => esc_html__( 'Posts', 'foodymat-core' ),
				),
			]
		);

		$this->add_control(
			'post_id',
			[
				'label' => esc_html__( 'Selects posts', 'foodymat-core' ),
				'type' => Controls_Manager::SELECT2,
				'options'     => rt_all_posts('rt-project'),
				'label_block' => true,
				'multiple' => true,
				'condition' => [
					'query_type' => 'posts',
				],
			]
		);

		$this->add_control(
			'cat_id',
			[
				'label' => esc_html__( 'Selects Category', 'foodymat-core' ),
				'type' => Controls_Manager::SELECT2,
				'options' => rt_taxonomy_post('rt-project-category'),
				'label_block' => true,
				'multiple' => true,
				'condition' => [
					'query_type' => 'category',
				],
			]
		);

		$this->add_control(
			'all_button',
			[
				'type'        => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Show All Button', 'foodymat-core' ),
				'options' => [
					'show'        => esc_html__( 'Show', 'foodymat-core' ),
					'hide'        => esc_html__( 'Hide', 'foodymat-core' ),
				],
				'default' => 'show',
			]
		);

		$this->add_control(
			'post_ordering',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Post Ordering', 'foodymat-core' ),
				'options' => [
					'DESC'	=> esc_html__( 'Desecending', 'foodymat-core' ),
					'ASC'	=> esc_html__( 'Ascending', 'foodymat-core' ),
				],
				'default' => 'DESC',
			]
		);

		$this->add_control(
			'post_orderby',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Post Sorting', 'foodymat-core' ),
				'options' => [
					'recent' 		=> esc_html__( 'Recent Post', 'foodymat-core' ),
					'rand' 			=> esc_html__( 'Random Post', 'foodymat-core' ),
					'title' 		=> esc_html__( 'By Name', 'foodymat-core' ),
				],
				'default' => 'recent',
			]
		);

		$this->end_controls_section();

		// Option Settings
		$this->start_controls_section(
			'sec_option',
			[
				'label' => esc_html__( 'Option', 'foodymat-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'category_display',
			[
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Category Display', 'foodymat-core' ),
				'label_on'    => esc_html__( 'On', 'foodymat-core' ),
				'label_off'   => esc_html__( 'Off', 'foodymat-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Show or Hide Category. Default: On', 'foodymat-core' ),
			]
		);

		$this->add_control(
			'content_display',
			[
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Content Display', 'foodymat-core' ),
				'label_on'    => esc_html__( 'On', 'foodymat-core' ),
				'label_off'   => esc_html__( 'Off', 'foodymat-core' ),
				'default'     => 'no',
				'description' => esc_html__( 'Show or Hide Content. Default: off', 'foodymat-core' ),
			]
		);

		$this->add_control(
			'content_type',
			[
				'type'    => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Content Type', 'foodymat-core' ),
				'options' => array(
					'content' => esc_html__( 'Conents', 'foodymat-core' ),
					'excerpt' => esc_html__( 'Excerpts', 'foodymat-core' ),
				),
				'default'     => 'content',
				'description' => esc_html__( 'Display contents from Editor or Excerpt field', 'foodymat-core' ),
				'condition'   => [
					'content_display' => ['yes'],
				],
			]
		);

		$this->add_control(
			'content_count',
			[
				'type'    => Controls_Manager::NUMBER,
				'label'   => esc_html__( 'Word count', 'foodymat-core' ),
				'description' => esc_html__( 'Maximum number of words', 'foodymat-core' ),
				'default' => 17,
				'condition'   => [
					'content_display' => ['yes'],
				],
			]
		);

		$this->add_control(
			'button_display',
			[
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Button Display', 'foodymat-core' ),
				'label_on'    => esc_html__( 'On', 'foodymat-core' ),
				'label_off'   => esc_html__( 'Off', 'foodymat-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Show or Hide Button. Default: On', 'foodymat-core' ),
			]
		);

		$this->add_control(
			'item_heading',
			[
				'label'     => __( 'Box Item Style', 'foodymat-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'box_item_radius',
			[
				'label'      => __( 'Box Radius', 'foodymat-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-project-default .project-item .project-thumbs' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'project_thumbnail_size',
			[
				'label'     => esc_html__( 'Image Size', 'foodymat-core' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => rt_get_all_image_sizes(),
			]
		);

		$this->add_control(
			'grayscale_display',
			[
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Grayscale Display', 'foodymat-core' ),
				'label_on'    => esc_html__( 'On', 'foodymat-core' ),
				'label_off'   => esc_html__( 'Off', 'foodymat-core' ),
				'return_value' => 'is-blend',
				'description' => esc_html__( 'Show or Hide Image Grayscale. Default: Off', 'foodymat-core' ),
			]
		);

		$this->add_control(
			'link_popup',
			[
				'type'    => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Link Button Option', 'foodymat-core' ),
				'description' => esc_html__( 'Display contents details and image popup', 'foodymat-core' ),
				'options' => array(
					'default' => esc_html__( 'Default', 'foodymat-core' ),
					'popup' => esc_html__( 'Image Popup', 'foodymat-core' ),
				),
				'default'     => 'default',
			]
		);

		$this->end_controls_section();

		// Tab Settings
		$this->start_controls_section(
			'sec_tab_style',
			[
				'label' => esc_html__( 'Tab Style', 'foodymat-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'flex_alignment',
			[
				'label'     => esc_html__( 'Alignment', 'foodymat-core' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => esc_html__( 'Left', 'foodymat-core' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'foodymat-core' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => esc_html__( 'Right', 'foodymat-core' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-project-default .rt-project-tab .case-cat-tab' => 'justify-content: {{VALUE}};',
				],
				'default' => 'center',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'tab_typo',
				'label'    => esc_html__( 'Typo', 'foodymat-core' ),
				'selector' => '{{WRAPPER}} .rt-project-default .rt-project-tab .case-cat-tab a',
			]
		);

		$this->add_responsive_control(
			'tab_padding',
			[
				'label'              => __( 'Padding', 'foodymat-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-project-default .rt-project-tab .case-cat-tab a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'tab_radius',
			[
				'label'              => __( 'Radius', 'foodymat-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-project-default .rt-project-tab .case-cat-tab a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		// isotope tab
		$this->start_controls_tabs(
			'isotope_style_tabs', [
			]
		);

		$this->start_controls_tab(
			'isotope_style_normal_tab',
			[
				'label' => __( 'Normal', 'foodymat-core' ),
			]
		);

		$this->add_control(
			'tab_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-project-default .rt-project-tab .case-cat-tab a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'tab_bg_color',
				'label' => __('Background', 'foodymat-core'),
				'types' => ['classic', 'gradient'],
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Background', 'foodymat-core' ),
					],
				],
				'selector' => '{{WRAPPER}} .rt-project-default .rt-project-tab .case-cat-tab a',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'tab_border',
				'selector' => '{{WRAPPER}} .rt-project-default .rt-project-tab .case-cat-tab a',
			]
		);


		$this->end_controls_tab();

		$this->start_controls_tab(
			'isotope_style_hover_tab',
			[
				'label' => __( 'Hover', 'foodymat-core' ),
			]
		);

		$this->add_control(
			'tab_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Active / Hover Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-project-default .rt-project-tab .case-cat-tab a:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-project-default .rt-project-tab .case-cat-tab a.current' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'tab_bg_hover_color',
				'label' => __('Background', 'foodymat-core'),
				'types' => ['classic', 'gradient'],
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Background', 'foodymat-core' ),
					],
				],
				'selector' => '{{WRAPPER}} .rt-project-default .rt-project-tab .case-cat-tab a:hover',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'tab_hover_border',
				'selector' => '{{WRAPPER}} .rt-project-default .rt-project-tab .case-cat-tab a:hover',
			]
		);


		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'tab_item_space',
			[
				'label'      => __( 'Tab Item Space', 'foodymat-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-project-default .rt-project-tab .case-cat-tab' => 'column-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'tab_space',
			[
				'label'      => __( 'Tab Bottom Space', 'foodymat-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-project-default .rt-project-tab' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'tab_separator_display',
			[
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Tab Separator Display', 'foodymat-core' ),
				'label_on'    => esc_html__( 'On', 'foodymat-core' ),
				'label_off'   => esc_html__( 'Off', 'foodymat-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Show or Hide Separator. Default: On', 'foodymat-core' ),
			]
		);

		$this->end_controls_section();

		// Title Settings
		$this->start_controls_section(
			'sec_title_style',
			[
				'label' => esc_html__( 'Title Style', 'foodymat-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typo',
				'label'    => esc_html__( 'Title Typo', 'foodymat-core' ),
				'selector' => '{{WRAPPER}} .rt-project-default .project-item .project-title',
			]
		);

		$this->add_control(
			'title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Title Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-project-default .project-item .project-title a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Title Hover Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-project-default .project-item .project-title a:hover' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'title_space',
			[
				'label'      => __( 'Title Space', 'foodymat-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-project-default .project-item .project-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'   => esc_html__( 'Title Tag', 'the-post-grid' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => [
					'h1' => esc_html__( 'H1', 'the-post-grid' ),
					'h2' => esc_html__( 'H2', 'the-post-grid' ),
					'h3' => esc_html__( 'H3', 'the-post-grid' ),
					'h4' => esc_html__( 'H4', 'the-post-grid' ),
					'h5' => esc_html__( 'H5', 'the-post-grid' ),
					'h6' => esc_html__( 'H6', 'the-post-grid' ),
				],
			]
		);

		$this->end_controls_section();

		// Category Settings
		$this->start_controls_section(
			'sec_category_style',
			[
				'label' => esc_html__( 'Category Style', 'foodymat-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'cat_typo',
				'label'    => esc_html__( 'Typo', 'foodymat-core' ),
				'selector' => '{{WRAPPER}} .rt-project-default .project-cat',
			]
		);

		$this->add_control(
			'cat_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-project-default .project-cat a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'cat_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Hover Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-project-default .project-cat a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		// Content Settings
		$this->start_controls_section(
			'sec_content_style',
			[
				'label' => esc_html__( 'Content Style', 'foodymat-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'content_typo',
				'label'    => esc_html__( 'Content Typo', 'foodymat-core' ),
				'selector' => '{{WRAPPER}} .rt-project-default .project-item .project-excerpt',
			]
		);

		$this->add_control(
			'content_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Content Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-project-default .project-item .project-excerpt' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'content_space',
			[
				'label'      => __( 'Content Space', 'foodymat-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-project-default .project-item .project-excerpt' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Button More Settings
		//==============================================================
		$this->start_controls_section(
			'button_settings',
			[
				'label' => esc_html__('Button Settings', 'foodymat-core'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition'   => [
					'button_display' => 'yes',
				],
			]
		);

		$this->add_control(
			'button_icon',
			[
				'label'            => __( 'Choose Icon', 'foodymat-core' ),
				'type'      => \Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default'          => [
					'value'   => 'icon-rt-right-arrow',
					'library' => 'solid',
				],
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => esc_html__('Radius', 'foodymat-core'),
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .rt-project-default .rt-button .btn' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'label' => esc_html__('Typography', 'foodymat-core'),
				'selector' => '{{WRAPPER}} .rt-project-default .rt-button .btn',
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label' => __('Padding', 'foodymat-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rt-project-default .rt-button .btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		//Start button Style Tab
		$this->start_controls_tabs(
			'button_style_tabs'
		);

		//Normal Style
		$this->start_controls_tab(
			'button_style_normal_tab',
			[
				'label' => __('Normal', 'foodymat-core'),
			]
		);

		$this->add_control(
			'button_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Color', 'foodymat-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-project-default .rt-button .btn' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-project-default .rt-button .btn i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-project-default .rt-button .btn path' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'button_bg',
				'label' => __('Background', 'foodymat-core'),
				'types' => ['classic', 'gradient'],
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Background', 'foodymat-core' ),
					],
				],
				'selector' => '{{WRAPPER}} .rt-project-default .rt-button .btn:before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'label' => __('Box Shadow', 'foodymat-core'),
				'selector' => '{{WRAPPER}} .rt-project-default .rt-button .btn',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'label' => __('Border', 'foodymat-core'),
				'selector' => '{{WRAPPER}} .rt-project-default .rt-button .btn',
			]
		);

		$this->end_controls_tab();

		//Hover Style
		$this->start_controls_tab(
			'button_style_hover_tab',
			[
				'label' => __('Hover', 'foodymat-core'),
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Color Hover', 'foodymat-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-project-default .rt-button .btn:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-project-default .rt-button .btn:hover i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-project-default .rt-button .btn:hover path' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'button_bg_hover',
				'label' => __('Background', 'foodymat-core'),
				'types' => ['classic', 'gradient'],
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Background', 'foodymat-core' ),
					],
				],
				'selector' => '{{WRAPPER}} .rt-project-default .rt-button .btn:after',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow_hover',
				'label' => __('Box Shadow Hover', 'foodymat-core'),
				'selector' => '{{WRAPPER}} .rt-project-default .rt-button .btn:hover',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'button_border_hover',
				'label' => __('Border', 'foodymat-core'),
				'selector' => '{{WRAPPER}} .rt-project-default .rt-button .btn:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// Responsive Settings
		$this->start_controls_section(
			'sec_grid_responsive',
			[
				'label' => esc_html__( 'Number of Responsive Columns', 'foodymat-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'col_xl',
			[
				'type' => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Desktops: > 1199px', 'foodymat-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '4',
			]
		);
		$this->add_control(
			'col_lg',
			[
				'type' => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Desktops: > 991px', 'foodymat-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '4',
			]
		);
		$this->add_control(
			'col_md',
			[
				'type' => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Tablets: > 767px', 'foodymat-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '6',
			]
		);
		$this->add_control(
			'col_sm',
			[
				'type' => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Phones: < 768px', 'foodymat-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '6',
			]
		);
		$this->add_control(
			'col_xs',
			[
				'type' => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Small Phones: < 480px', 'foodymat-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '12',
			]
		);

		$this->end_controls_section();

		//Animation setting
		$this->start_controls_section(
			'animation_style',
			[
				'label' => esc_html__( 'Animation Style', 'foodymat-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'animation',
			[
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Animation', 'foodymat-core' ),
				'options' => [
					'wow' => esc_html__( 'On', 'foodymat-core' ),
					'wow-off'         => esc_html__( 'Off', 'foodymat-core' ),
				],
				'default' => 'wow-off',
			]
		);

		$this->add_control(
			'animation_effect',
			[
				'type'    => Controls_Manager::SELECT,
				'id'      => 'animation_effect',
				'label'   => esc_html__( 'Entrance Animation', 'foodymat-core' ),
				'options' => [
					'bounce' => esc_html__( 'bounce', 'foodymat-core' ),
					'flash' => esc_html__( 'flash', 'foodymat-core' ),
					'pulse' => esc_html__( 'pulse', 'foodymat-core' ),
					'headShake' => esc_html__( 'headShake', 'foodymat-core' ),
					'swing' => esc_html__( 'swing', 'foodymat-core' ),
					'hinge' => esc_html__( 'hinge', 'foodymat-core' ),
					'flipInX' => esc_html__( 'flipInX', 'foodymat-core' ),
					'flipInY' => esc_html__( 'flipInY', 'foodymat-core' ),
					'fadeIn' => esc_html__( 'fadeIn', 'foodymat-core' ),
					'fadeInUp' => esc_html__( 'fadeInUp', 'foodymat-core' ),
					'fadeInDown' => esc_html__( 'fadeInDown', 'foodymat-core' ),
					'fadeInLeft' => esc_html__( 'fadeInLeft', 'foodymat-core' ),
					'fadeInRight' => esc_html__( 'fadeInRight', 'foodymat-core' ),
					'bounceIn' => esc_html__( 'bounceIn', 'foodymat-core' ),
					'bounceInUp' => esc_html__( 'bounceInUp', 'foodymat-core' ),
					'bounceInDown' => esc_html__( 'bounceInDown', 'foodymat-core' ),
					'bounceInLeft' => esc_html__( 'bounceInLeft', 'foodymat-core' ),
					'bounceInRight' => esc_html__( 'bounceInRight', 'foodymat-core' ),
					'slideInUp' => esc_html__( 'slideInUp', 'foodymat-core' ),
					'slideInDown' => esc_html__( 'slideInDown', 'foodymat-core' ),
					'slideInLeft' => esc_html__( 'slideInLeft', 'foodymat-core' ),
					'slideInRight' => esc_html__( 'slideInRight', 'foodymat-core' ),
					'zoomIn' => esc_html__( 'zoomIn', 'foodymat-core' ),
					'zoomInDown' => esc_html__( 'zoomInDown', 'foodymat-core' ),
					'zoomInUp' => esc_html__( 'zoomInUp', 'foodymat-core' ),
					'zoomInLeft' => esc_html__( 'zoomInLeft', 'foodymat-core' ),
					'zoomInRight' => esc_html__( 'zoomInRight', 'foodymat-core' ),
					'zoomOut' => esc_html__( 'zoomOut', 'foodymat-core' ),
				],
				'default' => 'fadeInUp',
				'condition'   => [
					'animation' => [ 'wow' ]
				],
			]
		);

		$this->add_control(
			'delay',
			[
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Delay', 'foodymat-core' ),
				'default' => '200',
				'condition'   => [
					'animation' => [ 'wow' ]
				],
			],
		);

		$this->add_control(
			'duration',
			[
				'type'    => Controls_Manager::TEXT,
				'id'      => 'duration',
				'label'   => esc_html__( 'Duration', 'foodymat-core' ),
				'default' => '1200',
				'condition'   => [
					'animation' => [ 'wow' ]
				],
			],
		);

		$this->end_controls_section();

	}

	protected function render() {
		$data     = $this->get_settings();

		switch ( $data['layout'] ) {

			case 'layout-7':
				$template = 'view-7';
				break;
			case 'layout-6':
				$template = 'view-6';
				break;
			case 'layout-5':
				$template = 'view-5';
				break;
			case 'layout-4':
				$template = 'view-4';
				break;
			case 'layout-3':
				$template = 'view-3';
				break;
			case 'layout-2':
				$template = 'view-2';
				break;
			default:
				$template = 'view-1';
				break;
		}

		Fns::get_template( "elementor/project-isotope/$template", $data );
	}

}