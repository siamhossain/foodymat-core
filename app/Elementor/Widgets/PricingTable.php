<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\FoodymatCore\Elementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use RT\FoodymatCore\Helper\Fns;
use RT\FoodymatCore\Abstracts\ElementorBase;

if (!defined('ABSPATH')) {
	exit;
}

class PricingTable extends ElementorBase {

	public function __construct($data = [], $args = null) {
		$this->rt_name = esc_html__('RT Pricing Table', 'foodymat-core');
		$this->rt_base = 'rt-pricing-table';
		parent::__construct($data, $args);
	}

	protected function register_controls() {
		$this->start_controls_section(
			'rt_pricing_table',
			[
				'label' => esc_html__('Pricing Table Settings', 'foodymat-core'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'layout',
			[
				'label'   => esc_html__( 'Style', 'foodymat-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'layout-1',
				'options' => [
					'layout-1' => __( 'Layout 1', 'foodymat-core' ),
					'layout-2' => __( 'Layout 2', 'foodymat-core' ),
					'layout-3' => __( 'Layout 3', 'foodymat-core' ),
				],

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
					'{{WRAPPER}} .rt-pricing-box-wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__('Plan Name', 'foodymat-core'),
				'type' => Controls_Manager::TEXT,
				'default' => 'Standard',
				'label_block' => false,
			]
		);

		$this->add_control(
			'is_featured',
			[
				'label' => __('Is Featured ?', 'foodymat-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Yes', 'foodymat-core'),
				'label_off' => __('No', 'foodymat-core'),
				'return_value' => 'is-featured',
				'default' => false,
			]
		);

		$this->add_control(
			'featured_text',
			[
				'label' => esc_html__('Featured Text', 'foodymat-core'),
				'type' => Controls_Manager::TEXT,
				'default' => 'Featured',
				'label_block' => false,
				'condition' => [
					'is_featured' => 'is-featured',
				],
			]
		);

		$this->add_control(
			'subtitle',
			[
				'label' => esc_html__('Subtitle', 'foodymat-core'),
				'type' => Controls_Manager::TEXTAREA,
				'default' => 'Manage and streamline operations acr osers multiple locations wenels',
				'rows' => 3,
			]
		);

		$this->add_control(
			'price',
			[
				'label' => esc_html__('Price', 'foodymat-core'),
				'type' => Controls_Manager::TEXT,
				'default' => '$29.00',
				'label_block' => false,
			]
		);

		$this->add_control(
			'period',
			[
				'label' => esc_html__('Period', 'foodymat-core'),
				'type' => Controls_Manager::TEXT,
				'default' => 'billed per month',
				'label_block' => false,
			]
		);

		$this->add_control(
			'btn_text',
			[
				'label' => esc_html__('Button Text', 'foodymat-core'),
				'type' => Controls_Manager::TEXT,
				'default' => 'Get Started',
				'label_block' => false,
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __('Link', 'foodymat-core'),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __('https://your-link.com', 'foodymat-core'),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => false,
					'nofollow' => false,
				],
			]
		);

		// Features
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'faature_title', [
				'label' => __('Feature Title', 'foodymat-core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __('List Title', 'foodymat-core'),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'list_icon',
			[
				'label' => __('Icon', 'foodymat-core'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'icon-rt-correct',
					'library' => 'solid',
				],
			]
		);

		$repeater->add_control(
			'list_icon_color',
			[
				'label' => __('Icon Color', 'foodymat-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .feature-lists {{CURRENT_ITEM}} i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-pricing-box-wrapper .feature-lists {{CURRENT_ITEM}} svg path' => 'fill: {{VALUE}}',
				],
			]
		);

		$repeater->add_control(
			'list_title_color',
			[
				'label' => __('Title Color', 'foodymat-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .feature-lists {{CURRENT_ITEM}} .list-item' => 'color: {{VALUE}}',
				],
			]
		);


		$this->add_control(
			'list',
			[
				'label' => __('Feature List', 'foodymat-core'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'faature_title' => __('Sync between pages', 'foodymat-core'),
						'list_icon' => 'fas fa-check',
					],
					[
						'faature_title' => __('Powerful database store', 'foodymat-core'),
						'list_icon' => 'fas fa-check',
					],
					[
						'faature_title' => __('Free / Pro Ads', 'foodymat-core'),
						'list_icon' => 'fas fa-check',
					],
					[
						'faature_title' => __('Unlimited guests', 'foodymat-core'),
						'list_icon' => 'fas fa-check',
					],
					[
						'faature_title' => __('Version history', 'foodymat-core'),
						'list_icon' => 'fas fa-check',
					],
				],
				'title_field' => '{{{ faature_title }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'additional_settings',
			[
				'label' => esc_html__('Additional Settings', 'foodymat-core'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'icon_type',
			[
				'label' => __('Icon Type', 'foodymat-core'),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'icon' => __('Icon', 'foodymat-core'),
					'image' => __('Image', 'foodymat-core'),
					'none' => __('None', 'foodymat-core'),
				],
			]
		);

		$this->add_control(
			'bgicon',
			[
				'label' => __('Choose Icon', 'foodymat-core'),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-paper-plane',
					'library' => 'fa-solid',
				],
				'condition' => [
					'icon_type' => ['icon'],
				],
			]
		);

		$this->add_control(
			'image',
			[
				'label' => __('Choose Image', 'foodymat-core'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'icon_type' => ['image'],
				],
			]
		);

		$this->end_controls_section();

		// Title Settings
		//==============================================================
		$this->start_controls_section(
			'title_settings',
			[
				'label' => esc_html__('Title Settings', 'foodymat-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__('Typography', 'foodymat-core'),
				'selector' => '{{WRAPPER}} .rt-pricing-box-wrapper .plan-name',
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'   => esc_html__( 'Title Tag', 'foodymat-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => [
					'h1' => esc_html__( 'H1', 'foodymat-core' ),
					'h2' => esc_html__( 'H2', 'foodymat-core' ),
					'h3' => esc_html__( 'H3', 'foodymat-core' ),
					'h4' => esc_html__( 'H4', 'foodymat-core' ),
					'h5' => esc_html__( 'H5', 'foodymat-core' ),
					'h6' => esc_html__( 'H6', 'foodymat-core' ),
				],
			]
		);

		$this->add_responsive_control(
			'title_spacing',
			[
				'label' => __('Title Spacing', 'foodymat-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'allowed_dimensions' => 'vertical',
				'selectors' => [
					'{{WRAPPER}} .plan-name-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->start_controls_tabs(
			'title_style_tabs'
		);

		$this->start_controls_tab(
			'title_style_normal_tab',
			[
				'label' => __('Normal', 'foodymat-core'),
			]
		);

		$this->add_control(
			'title_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Color', 'foodymat-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .plan-name' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'title_style_hover_tab',
			[
				'label' => __('Hover', 'foodymat-core'),
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Hover Color', 'foodymat-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper:hover .plan-name' => 'color: {{VALUE}}',

				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// Price setting
		//==============================================================
		$this->start_controls_section(
			'price_settings',
			[
				'label' => esc_html__('Price Settings', 'foodymat-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'pricing_heading',
			[
				'label' => __('Pricing Options', 'foodymat-core'),
				'type' => \Elementor\Controls_Manager::HEADING,
				// 'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'price_typography',
				'label' => esc_html__('Typography', 'foodymat-core'),
				'selector' => '{{WRAPPER}} .rt-pricing-box-wrapper .price-wrap .price',
			]
		);

		$this->start_controls_tabs(
			'price_style_tabs'
		);

		$this->start_controls_tab(
			'price_style_normal_tab',
			[
				'label' => __('Normal', 'foodymat-core'),
			]
		);

		$this->add_control(
			'price_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Price Color', 'foodymat-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .price-wrap .price' => 'color: {{VALUE}}',

				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'price_style_hover_tab',
			[
				'label' => __('Hover', 'foodymat-core'),
			]
		);

		$this->add_control(
			'price_hover_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Price Color Hover', 'foodymat-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper:hover .price-wrap .price' => 'color: {{VALUE}}',

				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'period_heading',
			[
				'label' => __('Period Options', 'foodymat-core'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'period_typography',
				'label' => esc_html__('Typography', 'foodymat-core'),
				'selector' => '{{WRAPPER}} .rt-pricing-box-wrapper .price-wrap .period',
			]
		);

		$this->start_controls_tabs(
			'period_style_tabs'
		);

		$this->start_controls_tab(
			'period_style_normal_tab',
			[
				'label' => __('Normal', 'foodymat-core'),
			]
		);

		$this->add_control(
			'period_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Period Color', 'foodymat-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .price-wrap .period' => 'color: {{VALUE}}',

				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'period_style_hover_tab',
			[
				'label' => __('Hover', 'foodymat-core'),
			]
		);

		$this->add_control(
			'period_hover_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Period Color Hover', 'foodymat-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper:hover .price-wrap .period' => 'color: {{VALUE}}',

				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'pricing_separator',
			[
				'label' => __('Pricing Separator Options', 'foodymat-core'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->start_controls_tabs(
			'separator_style_tabs'
		);

		$this->start_controls_tab(
			'separator_style_normal_tab',
			[
				'label' => __('Normal', 'foodymat-core'),
			]
		);

		$this->add_control(
			'separator_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Separator Color', 'foodymat-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .price-wrap .seperator' => 'color: {{VALUE}}',

				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'separator_style_hover_tab',
			[
				'label' => __('Hover', 'foodymat-core'),
			]
		);

		$this->add_control(
			'separator_color_hover',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Separator Color', 'foodymat-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper:hover .price-wrap .seperator' => 'color: {{VALUE}}',

				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'separator_size',
			[
				'label' => __('Separator Size', 'foodymat-core'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .price-wrap .seperator' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Sub Title
		//==============================================================
		$this->start_controls_section(
			'sub_title_settings',
			[
				'label' => esc_html__('Sub Title Settings', 'foodymat-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_typography',
				'label' => esc_html__('Typography', 'foodymat-core'),
				'selector' => '{{WRAPPER}} .rt-pricing-box-wrapper .subtitle',
			]
		);

		$this->add_responsive_control(
			'subtitle_list_spacing',
			[
				'label' => __('Spacing', 'foodymat-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'allowed_dimensions' => 'vertical',
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->start_controls_tabs(
			'subtitle_style_tabs'
		);

		$this->start_controls_tab(
			'subtitle_style_normal_tab',
			[
				'label' => __('Normal', 'foodymat-core'),
			]
		);

		$this->add_control(
			'subtitle_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Sub Title Color', 'foodymat-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .subtitle' => 'color: {{VALUE}}',

				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'subtitle_style_hover_tab',
			[
				'label' => __('Hover', 'foodymat-core'),
			]
		);

		$this->add_control(
			'subtitle_hover_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Sub Title Color Hover', 'foodymat-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper:hover .subtitle' => 'color: {{VALUE}}',

				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// Is Featured Settings
		//==============================================================
		$this->start_controls_section(
			'is_featured_settings',
			[
				'label' => esc_html__('Feature Badge Settings', 'foodymat-core'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'is_featured' => 'is-featured',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'is_featured_typography',
				'label' => esc_html__('Typography', 'foodymat-core'),
				'selector' => '{{WRAPPER}} .rt-pricing-box-wrapper .is-featured',
			]
		);

		$this->start_controls_tabs(
			'is_featured_style_tabs'
		);

		$this->start_controls_tab(
			'is_featured_style_normal_tab',
			[
				'label' => __('Normal', 'foodymat-core'),
			]
		);

		$this->add_control(
			'is_featured_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Color', 'foodymat-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .is-featured' => 'color: {{VALUE}}',

				],
			]
		);

		$this->add_control(
			'is_featured_bg_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Background Color', 'foodymat-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .is-featured' => 'background-color: {{VALUE}}',

				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'is_featured_style_hover_tab',
			[
				'label' => __('Hover', 'foodymat-core'),
			]
		);

		$this->add_control(
			'is_featured_hover_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Color Hover', 'foodymat-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper:hover .is-featured' => 'color: {{VALUE}}',

				],
			]
		);

		$this->add_control(
			'is_featured_bg_color_hover',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Background Color Hover', 'foodymat-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper:hover .is-featured' => 'background-color: {{VALUE}}',

				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// Feature List Style
		//==============================================================
		$this->start_controls_section(
			'feature_list_settings',
			[
				'label' => esc_html__('Feature List Settings', 'foodymat-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'feature_list_typography',
				'label' => esc_html__('Typography', 'foodymat-core'),
				'selector' => '{{WRAPPER}} .rt-pricing-box-wrapper .feature-lists',
			]
		);

		$this->add_responsive_control(
			'feature_list_spacing',
			[
				'label' => __('Spacing', 'foodymat-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'allowed_dimensions' => 'vertical',
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .feature-lists' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->start_controls_tabs(
			'feature_list_style_tabs'
		);

		$this->start_controls_tab(
			'feature_list_style_normal_tab',
			[
				'label' => __('Normal', 'foodymat-core'),
			]
		);

		$this->add_control(
			'feature_list_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Color', 'foodymat-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .list-item' => 'color: {{VALUE}}',
				],
				'description' => esc_html__('This color will work if you don\'t set color from the list', 'foodymat-core'),
			]
		);

		$this->add_control(
			'feature_icon_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('List Icon Color', 'foodymat-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .feature-lists i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-pricing-box-wrapper .feature-lists svg path' => 'fill: {{VALUE}}',
				],
				'description' => esc_html__('This color will work if you don\'t set color from the list', 'foodymat-core'),
			]
		);

		$this->add_control(
			'feature_icon_bg_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('List Icon BG Color', 'foodymat-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .feature-lists i' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'feature_list_style_hover_tab',
			[
				'label' => __('Hover', 'foodymat-core'),
			]
		);

		$this->add_control(
			'feature_list_hover_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Color Hover', 'foodymat-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper:hover .feature-lists li .list-item' => 'color: {{VALUE}}',

				],
			]
		);

		$this->add_control(
			'feature_icon_color_hover',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('List Icon Color Hover', 'foodymat-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper:hover .feature-lists i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-pricing-box-wrapper:hover .feature-lists svg path' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// Icon / Image Settings
		//==============================================================
		$this->start_controls_section(
			'image_icon_settings',
			[
				'label' => esc_html__('Image / Icon Settings', 'foodymat-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => esc_html__('Image/Icon Size', 'foodymat-core'),
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 400,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .icon-holder i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-pricing-box-wrapper .icon-holder img' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
				],

			]
		);

		$this->add_responsive_control(
			'icon_x_position',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => esc_html__('X Position', 'foodymat-core'),
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .icon-holder' => 'left: {{SIZE}}{{UNIT}};',
				],

			]
		);

		$this->add_responsive_control(
			'icon_y_position',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => esc_html__('Y Position', 'foodymat-core'),
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 700,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .icon-holder' => 'top: {{SIZE}}{{UNIT}};',
				],

			]
		);

		//Start Icon Style Tab
		$this->start_controls_tabs(
			'icon_style_tabs'
		);

		//Normal Style
		$this->start_controls_tab(
			'icon_style_normal_tab',
			[
				'label' => __('Normal', 'foodymat-core'),
			]
		);
		$this->add_control(
			'icon_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Color', 'foodymat-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .icon-holder i' => 'color: {{VALUE}}',
				],
				'condition' => [
					'icon_type' => ['icon'],
				],
			]
		);

		$this->add_responsive_control(
			'icon_opacity',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => esc_html__('Image/Icon Opacity', 'foodymat-core'),
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0.1,
						'max' => 1,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .icon-holder' => 'Opacity: {{SIZE}};',
				],
			]
		);

		$this->end_controls_tab();

		//Hover Style
		$this->start_controls_tab(
			'icon_style_hover_tab',
			[
				'label' => __('Hover', 'foodymat-core'),
			]
		);

		$this->add_control(
			'icon_hover_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Color Hover', 'foodymat-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper:hover .icon-holder i' => 'color: {{VALUE}}',
				],
				'condition' => [
					'icon_type' => ['icon'],
				],
			]
		);

		$this->add_responsive_control(
			'icon_opacity_hover',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => esc_html__('Image/Icon Opacity Hover', 'foodymat-core'),
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0.1,
						'max' => 1,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper:hover .icon-holder' => 'Opacity: {{SIZE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
		//End Icon Style Tab

		$this->end_controls_section();

		// Button More Settings
		//==============================================================
		$this->start_controls_section(
			'button_settings',
			[
				'label' => esc_html__('Button Settings', 'foodymat-core'),
				'tab' => Controls_Manager::TAB_STYLE,
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
				'label' => esc_html__('Border Radius', 'foodymat-core'),
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
					'{{WRAPPER}} .rt-button .btn' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'label' => esc_html__('Button Typography', 'foodymat-core'),
				'selector' => '{{WRAPPER}} .rt-button .btn',
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label' => __('Button Padding', 'foodymat-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rt-button .btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'button_width',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Width', 'foodymat-core' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-button .btn' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_height',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Height', 'foodymat-core' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-button .btn' => 'height: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .rt-button .btn' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-button .btn i' => 'color: {{VALUE}}',
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
				'selector' => '{{WRAPPER}} .rt-button .btn:before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'label' => __('Box Shadow', 'foodymat-core'),
				'selector' => '{{WRAPPER}} .rt-button .btn',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'label' => __('Border', 'foodymat-core'),
				'selector' => '{{WRAPPER}} .rt-button .btn',
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
					'{{WRAPPER}} .rt-button .btn:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-button .btn:hover i' => 'color: {{VALUE}}',
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
				'selector' => '{{WRAPPER}} .rt-button .btn:after',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow_hover',
				'label' => __('Box Shadow Hover', 'foodymat-core'),
				'selector' => '{{WRAPPER}} .rt-button .btn:hover',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'button_border_hover',
				'label' => __('Border', 'foodymat-core'),
				'selector' => '{{WRAPPER}} .rt-button .btn:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// Box Settings
		//==============================================================
		$this->start_controls_section(
			'box_settings',
			[
				'label' => esc_html__('Box Settings', 'foodymat-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'box_min_height',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => esc_html__('Box Min Height', 'foodymat-core'),
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 200,
						'max' => 1000,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper' => 'min-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'box_radius',
			[
				'label' => __('Border Radius', 'foodymat-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'box_padding',
			[
				'label' => __('Box Padding', 'foodymat-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'box_margin',
			[
				'label' => __('Box Margin', 'foodymat-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->start_controls_tabs(
			'box_style_tabs'
		);

		$this->start_controls_tab(
			'box_style_normal_tab',
			[
				'label' => __('Normal', 'foodymat-core'),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => __('Box Shadow', 'foodymat-core'),
				'selector' => '{{WRAPPER}} .rt-pricing-box-wrapper',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'box_bg',
				'label' => __('Background', 'foodymat-core'),
				'types' => ['classic', 'gradient'],
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Background', 'foodymat-core' ),
					],
				],
				'selector' => '{{WRAPPER}} .rt-pricing-box-wrapper::before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'label' => __('Border', 'foodymat-core'),
				'selector' => '{{WRAPPER}} .rt-pricing-box-wrapper',
			]
		);

		$this->add_control(
			'box_up',
			[
				'label' => __('Translate Y', 'foodymat-core'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -50,
						'max' => 50,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper' => 'transform: translateY( {{SIZE}}{{UNIT}} );',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'box_style_hover_tab',
			[
				'label' => __('Hover', 'foodymat-core'),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow_hover',
				'label' => __('Box Shadow Hover', 'foodymat-core'),
				'selector' => '{{WRAPPER}} .rt-pricing-box-wrapper:hover',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'box_bg_hover',
				'label' => __('Background Hover', 'foodymat-core'),
				'types' => ['classic', 'gradient'],
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Background - Hover', 'foodymat-core' ),
					],
				],
				'selector' => '{{WRAPPER}} .rt-pricing-box-wrapper::after',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'box_border_hover',
				'label' => __('Border Hover', 'foodymat-core'),
				'selector' => '{{WRAPPER}} .rt-pricing-box-wrapper:hover',
			]
		);

		$this->add_control(
			'box_up_hover',
			[
				'label' => __('Translate Y on Hover', 'foodymat-core'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -50,
						'max' => 50,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper:hover' => 'transform: translateY( {{SIZE}}{{UNIT}} );',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

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
		$data = $this->get_settings();

		switch ( $data['layout'] ) {
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

		Fns::get_template( "elementor/pricing-table/$template", $data );
	}
}