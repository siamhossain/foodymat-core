<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\FoodymatCore\Elementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Group_Control_Text_Shadow;
use RT\FoodymatCore\Abstracts\ElementorBase;
use RT\FoodymatCore\Helper\Fns;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Title extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'RT Section Title', 'foodymat-core' );
		$this->rt_base = 'rt-title';
		parent::__construct( $data, $args );
	}

	public function get_script_depends() {
		return [ 'rt-animated-headline' ];
	}
	public function get_style_depends() {
		return [ 'rt-animated-headline' ];
	}

	protected function register_controls() {
		/* General Options */

		$this->start_controls_section(
			'sec_general',
			[
				'label' => esc_html__( 'General', 'foodymat-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title_layout',
			[
				'label'       => esc_html__( 'Title Layout', 'foodymat-core' ),
				'type'        => Controls_Manager::SELECT2,
				'options'   => [
					'layout-1' => __( 'Layout 01', 'foodymat-core' ),
					'layout-2' => __( 'Layout 02', 'foodymat-core' ),
				],
				'default'     => 'layout-1',
			]
		);

		$this->add_control(
			'top_sub_title',
			[
				'label'       => esc_html__( 'Top Sub Title', 'foodymat-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => __( 'Why Choose Our About', 'foodymat-core' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Main Title', 'foodymat-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 4,
				'default'     => __( 'Welcome To Our Foodymat', 'foodymat-core' ),
				'description' => esc_html__( "If you would like to use different color then separate word by <span>.", 'foodymat-core' ),
			]
		);

		$this->add_control(
			'shadow_title_display',
			[
				'label'        => __( 'Shadow Title Display', 'foodymat-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'foodymat-core' ),
				'label_off'    => __( 'Off', 'foodymat-core' ),
				'default'       => 'no',
				'condition'  => [
					'title_layout' => 'layout-1',
				],
			]
		);

		$this->add_control(
			'shadow_title',
			[
				'label'       => esc_html__( 'Shadow Title', 'foodymat-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 3,
				'default'     => __('About', 'foodymat-core' ),
				'description' => esc_html__( 'Only use layout 1', 'foodymat-core' ),
				'condition'  => [
					'shadow_title_display' => 'yes',
				],
			]
		);

		$this->add_control(
			'animation_headline_display',
			[
				'label'        => __( 'Animation Headline Display', 'foodymat-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'foodymat-core' ),
				'label_off'    => __( 'Off', 'foodymat-core' ),
				'default'       => 'no',
			]
		);

		$this->add_control(
			'headline_title',
			[
				'label'       => esc_html__( 'Headline Title', 'foodymat-core' ),
				'type'        => Controls_Manager::WYSIWYG,
				'rows'        => 3,
				'default'     => __('About', 'foodymat-core' ),
				'condition'  => [
					'animation_headline_display' => 'yes',
				],
			]
		);

		$this->add_control(
			'description',
			[
				'label'   => esc_html__( 'Description', 'foodymat-core' ),
				'type'    => Controls_Manager::WYSIWYG,
				'default'     => __('Manage and streamline operations across multiple locations, sales channels, and employees to improve efficiency and your bottom line.', 'foodymat-core' ),
				'condition'  => [
					'title_layout' => 'layout-1',
				],
			]
		);

		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'list_text',
			[
				'label'       => __( 'List Text', 'foodymat-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'Powerful database store', 'foodymat-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'list_icon',
			[
				'label'            => __( 'Choose Icon', 'foodymat-core' ),
				'type'      => \Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default'          => [
					'value'   => 'icon-rt-correct',
					'library' => 'solid',
				],
			]
		);

		$this->add_control(
			'show_feature_list',
			[
				'label'        => __( 'Feature List', 'foodymat-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'foodymat-core' ),
				'label_off'    => __( 'Off', 'foodymat-core' ),
				'return_value' => 'is-feature',
				'condition'  => [
					'title_layout' => 'layout-1',
				],
			]
		);

		$this->add_control(
			'feature_lists',
			[
				'label'       => __( 'Feature List', 'foodymat-core' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'list_text'        => __( 'Powerful database store', 'foodymat-core' ),
					],
					[
						'list_text'        => __( 'Easy to access all projects', 'foodymat-core' ),
					],
					[
						'list_text'        => __( 'Effortless courier allocation', 'foodymat-core' ),
					],
					[
						'list_text'        => __( 'Widest coverage network', 'foodymat-core' ),
					],

				],
				'title_field' => '{{{ name }}}',
				'condition'   => [
					'show_feature_list' => [ 'is-feature' ],
					'title_layout' => ['layout-1'],
				],
			]
		);

		$this->add_responsive_control(
			'alignment',
			[
				'label'     => __( 'Alignment', 'foodymat-core' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'       => '',
				'options'   => [
					'left'   => [
						'title' => __( 'Left', 'foodymat-core' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'foodymat-core' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'foodymat-core' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper' => 'text-align: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		// Main Title Settings
		$this->start_controls_section(
			'title_settings',
			[
				'label' => esc_html__( 'Title Settings', 'foodymat-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .main-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_color_two',
			[
				'type'        => Controls_Manager::COLOR,
				'label'       => esc_html__( 'Color 2', 'foodymat-core' ),
				'description' => esc_html__( "If you would like to use different color then separate word by <span> from main title.", 'foodymat-core' ),
				'selectors'   => [
					'{{WRAPPER}} .section-title-wrapper .main-title span' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_gradient_change_display',
			[
				'label'        => __( 'Gradient Title', 'foodymat-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'foodymat-core' ),
				'label_off'    => __( 'Hide', 'foodymat-core' ),
				'return_value' => 'title-gradient',
				'default'      => 'no',
				'condition' => [
					'title_layout' => 'layout-1',
				],
			]
		);

		$this->add_control(
			'title_gradient_animation',
			[
				'label'       => esc_html__( 'Title Animation', 'foodymat-core' ),
				'type'        => Controls_Manager::SELECT2,
				'options'   => [
					'default-animation' => __( 'Default', 'foodymat-core' ),
					'title-gradient-animation' => __( 'Animation', 'foodymat-core' ),
				],
				'default'     => 'title-gradient-animation',
				'condition' => [
					'title_layout' => ['layout-1'], 'title_gradient_change_display' => ['title-gradient'],
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'title_gradient_color',
				'types' => [ 'gradient' ],
				'selector' => '{{WRAPPER}} .section-title-wrapper .title-gradient',
				'return_value' => 'title-gradient',
				'condition' => [
					'title_layout' => ['layout-1'], 'title_gradient_change_display' => ['title-gradient'],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typo',
				'label'    => esc_html__( 'Typo', 'foodymat-core' ),
				'selector' => '{{WRAPPER}} .section-title-wrapper .main-title',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_span_typo',
				'label'    => esc_html__( 'Typo 2', 'foodymat-core' ),
				'selector' => '{{WRAPPER}} .section-title-wrapper .main-title span',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'text_stroke',
				'selector' => '{{WRAPPER}} .section-title-wrapper .main-title',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow',
				'selector' => '{{WRAPPER}} .section-title-wrapper .main-title',
			]
		);

		$this->add_responsive_control(
			'heading_margin',
			[
				'label'              => __( 'Margin', 'foodymat-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px', '%' ],
				'selectors'          => [
					'{{WRAPPER}} .main-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'title_image_aline',
			[
				'label'       => esc_html__( 'Title Inline Image Align', 'foodymat-core' ),
				'type'        => Controls_Manager::SELECT2,
				'options'   => [
					'baseline' => __( 'Baseline', 'foodymat-core' ),
					'middle' => __( 'Middle', 'foodymat-core' ),
					'bottom' => __( 'Bottom', 'foodymat-core' ),
				],
				'default'     => 'middle',
			]
		);

		$this->add_control(
			'main_title_tag',
			[
				'label'   => esc_html__( 'Main Title Tag', 'foodymat-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => [
					'h1' => esc_html__( 'H1', 'foodymat-core' ),
					'h2' => esc_html__( 'H2', 'foodymat-core' ),
					'h3' => esc_html__( 'H3', 'foodymat-core' ),
					'h4' => esc_html__( 'H4', 'foodymat-core' ),
					'h5' => esc_html__( 'H5', 'foodymat-core' ),
					'h6' => esc_html__( 'H6', 'foodymat-core' ),
					'span' => esc_html__( 'Span', 'foodymat-core' ),
					'div' => esc_html__( 'Div', 'foodymat-core' ),
				],
			]
		);

		$this->end_controls_section();

		// Top Sub Title
		$this->start_controls_section(
			'top_title_settings',
			[
				'label' => esc_html__( 'Sub Title Settings', 'foodymat-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'sub_title_style',
			[
				'label'     => __( 'Sub Title Style', 'foodymat-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'default',
				'options'   => [
					'default'  => __( 'Default', 'foodymat-core' ),
					'left-right-shape'  => __( 'Sub Title Shape', 'foodymat-core' ),
				],
			]
		);

		$this->add_control(
			'top_title_icon',
			[
				'label'   => __( 'Choose Icons', 'foodymat-core' ),
				'type'    => \Elementor\Controls_Manager::ICON,
				'include' => [
					'icon-rt-arrow-right-1',
					'icon-rt-correct',
					'icon-rt-arrow-vector',
					'icon-rt-chevron-right',
				],
				'default' => '',
			]
		);


		$this->add_control(
			'icon_position',
			[
				'label'     => __( 'Icon Position', 'foodymat-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'left',
				'options'   => [
					'left'  => __( 'Left', 'foodymat-core' ),
					'right' => __( 'Right', 'foodymat-core' ),
					'both'  => __( 'Both', 'foodymat-core' ),
				],
				'condition' => [
					'top_title_icon!' => '',
				],
			]
		);

		$this->add_control(
			'top_title_icon_size',
			[
				'label'      => __( 'Icon Size', 'foodymat-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 5,
						'max'  => 40,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .section-title-wrapper .top-sub-title i'   => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'top_title_icon!' => '',
				],
			]
		);

		$this->add_control(
			'top_title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .top-sub-title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'top_title_icon_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .top-sub-title i'        => 'color: {{VALUE}}',
					'{{WRAPPER}} .section-title-wrapper .top-sub-title svg path' => 'fill: {{VALUE}}',
				],
				'condition' => [
					'top_title_icon!' => '',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'top_title_bg_color',
				'label' => __('Background', 'foodymat-core'),
				'types' => ['classic', 'gradient'],
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Background', 'foodymat-core' ),
					],
				],
				'selector' => '{{WRAPPER}} .section-title-wrapper .top-sub-title',
				'condition' => [
					'sub_title_style!' => 'default',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'top_title_typo',
				'label'    => esc_html__( 'Typography', 'foodymat-core' ),
				'selector' => '{{WRAPPER}} .section-title-wrapper .top-sub-title',
			]
		);

		$this->add_responsive_control(
			'top_title_padding',
			[
				'label'              => __( 'Padding', 'foodymat-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px', '%'],
				'selectors'          => [
					'{{WRAPPER}} .top-sub-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'condition' => [
					'sub_title_style!' => 'default',
				],
			]
		);

		$this->add_responsive_control(
			'top_title_margin',
			[
				'label'              => __( 'Margin', 'foodymat-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px', '%'],
				'selectors'          => [
					'{{WRAPPER}} .top-sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		// Line Shape Settings
		$this->start_controls_section(
			'line_shape_settings',
			[
				'label' => esc_html__( 'Line Shape Settings', 'foodymat-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'description' => esc_html__( 'Only use layout 1', 'foodymat-core' ),
				'condition'  => [
					'title_layout' => 'layout-1',
				],
			]
		);

		$this->add_control(
			'title_line_shape',
			[
				'label'        => __( 'Title Line Shape', 'foodymat-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'foodymat-core' ),
				'label_off'    => __( 'Off', 'foodymat-core' ),
				'default'       => 'no',
				'return_value' => 'line-shape has-animation',
			]
		);

		$this->add_control(
			'line_shape_color',
			[
				'type'        => Controls_Manager::COLOR,
				'label'       => esc_html__( 'Shape Color', 'foodymat-core' ),
				'selectors'   => [
					'{{WRAPPER}} .section-title-wrapper .line-shape:after' => 'background-color: {{VALUE}}',
				],
				'condition'  => [
					'title_line_shape' => 'line-shape has-animation',
				],
			]
		);

		$this->add_responsive_control(
			'line_shape_width',
			[
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Shape Width', 'foodymat-core' ),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .line-shape.active-animation:after' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'title_line_shape' => 'line-shape has-animation',
				],
			]
		);

		$this->add_responsive_control(
			'line_shape_height',
			[
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Shape Height', 'foodymat-core' ),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .line-shape:after' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'title_line_shape' => 'line-shape has-animation',
				],
			]
		);

		$this->add_responsive_control(
			'line_shape_horizontal',
			[
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Shape Horizontal', 'foodymat-core' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => -100,
						'max' => 100,
					],
					'px' => [
						'min' => -500,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .line-shape:after' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'title_line_shape' => 'line-shape has-animation',
				],
			]
		);
		$this->add_responsive_control(
			'line_shape_vertical',
			[
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Shape Vertical', 'foodymat-core' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => -100,
						'max' => 100,
					],
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .line-shape:after' => 'bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'title_line_shape' => 'line-shape has-animation',
				],
			]
		);

		$this->add_responsive_control(
			'line_shape_radius',
			[
				'label'              => __( 'Shape Radius', 'foodymat-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .section-title-wrapper .line-shape:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'condition'  => [
					'title_line_shape' => 'line-shape has-animation',
				],
			]
		);

		$this->end_controls_section();

		// Title Shadow Settings
		$this->start_controls_section(
			'title_shadow_settings',
			[
				'label' => esc_html__( 'Shadow Title Settings', 'foodymat-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'description' => esc_html__( 'Only use layout 1', 'foodymat-core' ),
				'condition'  => [
					'shadow_title_display' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_shadow_typo',
				'label'    => esc_html__( 'Typo', 'foodymat-core' ),
				'selector' => '{{WRAPPER}} .section-title-wrapper .shadow-title-wrap .shadow-title',
			]
		);

		$this->add_control(
			'title_shadow_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Title Stroke Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .shadow-title-wrap .shadow-title' => '-webkit-text-stroke-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'shadow_title_horizontal',
			[
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Position Horizontal', 'foodymat-core' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => -100,
						'max' => 100,
					],
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .shadow-title-wrap' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_stroke_width',
			[
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Stroke Width', 'foodymat-core' ),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 20,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .shadow-title-wrap .shadow-title' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Animation Headline Settings
		$this->start_controls_section(
			'animation_headline_settings',
			[
				'label' => esc_html__( 'Animation Headline Settings', 'foodymat-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition'  => [
					'animation_headline_display' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'headline_title_typo',
				'label'    => esc_html__( 'Typo', 'foodymat-core' ),
				'selector' => '{{WRAPPER}} .rt-animated-headline .ah-words-wrapper p',
			]
		);

		$this->add_control(
			'headline_title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Headline Title Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-animated-headline .ah-words-wrapper p' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'headline_settings',
			[
				'label'     => __( 'Headline Border Style', 'foodymat-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'headline_border_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Title Border Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-animated-headline .ah-headline.clip .ah-words-wrapper:after' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'headline_border_width',
			[
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Border Width', 'foodymat-core' ),
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-animated-headline .ah-headline.clip .ah-words-wrapper:after' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'headline_border_height',
			[
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Border Height', 'foodymat-core' ),
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 10,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-animated-headline .ah-headline.clip .ah-words-wrapper:after' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'headline_border_bottom',
			[
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Border Bottom', 'foodymat-core' ),
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-animated-headline .ah-headline.clip .ah-words-wrapper:after' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'headline_border_right',
			[
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Border Right', 'foodymat-core' ),
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-animated-headline .ah-headline.clip .ah-words-wrapper:after' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Description Settings
		$this->start_controls_section(
			'description_settings',
			[
				'label' => esc_html__( 'Description & List Settings', 'foodymat-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition'  => [
					'title_layout' => 'layout-1',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'description_typo',
				'label'    => esc_html__( 'Typography', 'foodymat-core' ),
				'selector' => '{{WRAPPER}} .section-title-wrapper .description',
			]
		);

		$this->add_control(
			'description_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .description' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'description_margin',
			[
				'label'              => __( 'Margin', 'foodymat-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ '%','px' ],
				'selectors'          => [
					'{{WRAPPER}} .section-title-wrapper .description p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'list_settings',
			[
				'label'     => __( 'List Settings (if you use list item in description)', 'foodymat-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'list_typo',
				'label'    => esc_html__( 'List Typo', 'foodymat-core' ),
				'selector' => '{{WRAPPER}} .section-title-wrapper ul.feature-list li',
			]
		);

		$this->add_control(
			'list_column',
			[
				'label'     => __( 'List Column', 'foodymat-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'default',
				'options'   => [
					'default'  => __( 'One Column', 'foodymat-core' ),
					'two-column' => __( 'Two Column', 'foodymat-core' ),
				],
			]
		);

		$this->add_control(
			'list_layout',
			[
				'label'     => __( 'List Layout', 'foodymat-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'list-layout-1',
				'options'   => [
					'list-layout-1' => __( 'Layout 1', 'foodymat-core' ),
					'list-layout-2' => __( 'layout 2', 'foodymat-core' ),
				],
			]
		);

		$this->add_control(
			'list_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'List Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .feature-list li' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'list_icon_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'List Icon Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .feature-list li span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'list_icon_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'List Icon BG Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .feature-list li span' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'list_icon_border',
				'label'    => __( 'Border', 'foodymat-core' ),
				'selector' => '{{WRAPPER}} .section-title-wrapper .feature-list li span',
			]
		);
		$this->add_responsive_control(
			'list_icon_radius',
			[
				'label'              => __( 'Radius', 'foodymat-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .section-title-wrapper .feature-list li span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'list_padding',
			[
				'label'              => __( 'Padding', 'foodymat-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ '%','px' ],
				'selectors'          => [
					'{{WRAPPER}} .section-title-wrapper ul.feature-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		// Background Title Settings
		//==============================================================
		$this->start_controls_section(
			'Common Settings',
			[
				'label' => esc_html__( 'Common Settings', 'foodymat-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'section_title_wrap_margin',
			[
				'label'              => __( 'Wrapper Margin', 'foodymat-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'allowed_dimensions' => 'vertical',
				'selectors'          => [
					'{{WRAPPER}} .section-title-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
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

		switch ( $data['title_layout'] ) {
			case 'layout-2':
				$template = 'view-2';
				break;
			default:
				$template = 'view-1';
				break;
		}

		Fns::get_template( "elementor/title/$template", $data );
	}

}