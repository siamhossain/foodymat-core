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

class WorkingProcess extends ElementorBase {

	public function __construct($data = [], $args = null) {
		$this->rt_name = esc_html__('RT Working Process', 'foodymat-core');
		$this->rt_base = 'rt-working-process';
		$this->rt_translate = array(
			'cols'  => array(
				'12' => esc_html__( '1 Col', 'foodymat-core' ),
				'6'  => esc_html__( '2 Col', 'foodymat-core' ),
				'4'  => esc_html__( '3 Col', 'foodymat-core' ),
				'3'  => esc_html__( '4 Col', 'foodymat-core' ),
				'2'  => esc_html__( '6 Col', 'foodymat-core' ),
			),
		);
		parent::__construct($data, $args);
	}

	protected function register_controls() {
		$this->start_controls_section(
			'rt_process_item',
			[
				'label' => esc_html__('Process Item', 'foodymat-core'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		// Features
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'step', [
				'label' => __('Step', 'foodymat-core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __('STEP', 'foodymat-core'),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'number', [
				'label' => __('Number', 'foodymat-core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '01',
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'title', [
				'label' => __('Title', 'foodymat-core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __('Online Application', 'foodymat-core'),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'content', [
				'label' => __('Content', 'foodymat-core'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __('Donec Sodales Sagittis Neamagna Cras Dapibus. Praesent Utter Ligula Varius Sagittis.', 'foodymat-core'),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'url', [
				'label' => __('Link', 'foodymat-core'),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __('https://your-link.com', 'foodymat-core'),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => false,
					'nofollow' => false,
				],
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'step_color',
			[
				'label' => __('Step Color', 'foodymat-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rt-icon-list .list-items {{CURRENT_ITEM}} .title-link' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'layout',
			[
				'label'   => esc_html__( 'Layout', 'foodymat-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'layout-1',
				'options' => [
					'layout-1' => __( 'Layout 1', 'foodymat-core' ),
					'layout-2' => __( 'Layout 2', 'foodymat-core' ),
					'layout-3' => __( 'Layout 3', 'foodymat-core' ),
				],

			]
		);

		$this->add_control(
			'process_list',
			[
				'label' => __('Process List', 'foodymat-core'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'step' => __('STEP', 'foodymat-core'),
						'number' => __('01', 'foodymat-core'),
						'title' => __('Online Application', 'foodymat-core'),
						'content' => __('Donec Sodales Sagittis Neamagna Cras Dapibus. Praesent Utter Ligula Varius Sagittis.', 'foodymat-core'),
					],
					[
						'step' => __('STEP', 'foodymat-core'),
						'number' => __('02', 'foodymat-core'),
						'title' => __('Pick A Plan', 'foodymat-core'),
						'content' => __('Donec Sodales Sagittis Neamagna Cras Dapibus. Praesent Utter Ligula Varius Sagittis.', 'foodymat-core'),
					],
					[
						'step' => __('STEP', 'foodymat-core'),
						'number' => __('03', 'foodymat-core'),
						'title' => __('Compare Quotes', 'foodymat-core'),
						'content' => __('Donec Sodales Sagittis Neamagna Cras Dapibus. Praesent Utter Ligula Varius Sagittis.', 'foodymat-core'),
					],
					[
						'step' => __('STEP', 'foodymat-core'),
						'number' => __('01', 'foodymat-core'),
						'title' => __('Sign Your Contract', 'foodymat-core'),
						'content' => __('Donec Sodales Sagittis Neamagna Cras Dapibus. Praesent Utter Ligula Varius Sagittis.', 'foodymat-core'),
					],
				],
				'title_field' => '{{{ title }}}',
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

		$this->add_responsive_control(
			'alignment',
			[
				'label'     => __( 'Alignment', 'foodymat-core' ),
				'type'      => Controls_Manager::CHOOSE,
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
					'{{WRAPPER}} .rt-working-process .process-item' => 'text-align: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

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
				'default' => '3',
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

		// Title Settings
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
				'name' => 'title_typo',
				'label' => esc_html__('Typo', 'foodymat-core'),
				'selector' => '{{WRAPPER}} .rt-working-process .rt-title',
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
			'title_space',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Space', 'foodymat-core' ),
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
					'{{WRAPPER}} .rt-working-process .rt-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .rt-working-process .rt-title' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-working-process .rt-title .title-link' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .rt-working-process .rt-title .title-link:hover' => 'color: {{VALUE}}',

				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// Step Settings
		$this->start_controls_section(
			'step_settings',
			[
				'label' => esc_html__('Step Settings', 'foodymat-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'step_display',
			[
				'label'        => __( 'Step Display', 'foodymat-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'foodymat-core' ),
				'label_off'    => __( 'Hide', 'foodymat-core' ),
				'default'      => 'yes',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'step_typo',
				'label' => esc_html__('Typo', 'foodymat-core'),
				'selector' => '{{WRAPPER}} .rt-working-process .rt-step',
				'condition'   => [
					'step_display' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'step_space',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Space', 'foodymat-core' ),
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
					'{{WRAPPER}} .rt-working-process .rt-step' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'   => [
					'step_display' => 'yes',
				],
			]
		);
		$this->add_control(
			'step_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Color', 'foodymat-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-working-process .rt-step' => 'color: {{VALUE}}',
				],
				'condition'   => [
					'step_display' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		// Number Settings
		$this->start_controls_section(
			'number_settings',
			[
				'label' => esc_html__('Number Settings', 'foodymat-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'number_display',
			[
				'label'        => __( 'Number Display', 'foodymat-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'foodymat-core' ),
				'label_off'    => __( 'Hide', 'foodymat-core' ),
				'default'      => 'yes',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'number_typo',
				'label' => esc_html__('Typo', 'foodymat-core'),
				'selector' => '{{WRAPPER}} .rt-working-process .rt-number',
				'condition'   => [
					'number_display' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'number_space',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Space', 'foodymat-core' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => -100,
						'max' => 100,
					],
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-process-layout-1 .rt-number' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-process-layout-2 .rt-number' => 'top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-process-layout-3 .rt-number' => 'bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'   => [
					'number_display' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'number_radius',
			[
				'label'              => __( 'Radius', 'foodymat-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-working-process .rt-number' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' => 'before',
				'condition'   => [
					'number_display' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'number_width',
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
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-working-process .rt-number' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition'   => [
					'number_display' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'number_height',
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
					'{{WRAPPER}} .rt-working-process .rt-number' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition'   => [
					'number_display' => 'yes',
				],
			]
		);

		// Number tab
		$this->start_controls_tabs(
			'number_style_tabs',
		);

		$this->start_controls_tab(
			'number_normal_tab',
			[
				'label' => __('Normal', 'foodymat-core'),
				'condition'   => [
					'number_display' => 'yes',
				],
			]
		);

		$this->add_control(
			'number_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Color', 'foodymat-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-working-process .rt-number' => 'color: {{VALUE}}',
				],
				'condition'   => [
					'number_display' => 'yes',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'number_bg_color',
				'label' => __('Background', 'foodymat-core'),
				'types' => ['classic', 'gradient'],
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Background', 'foodymat-core' ),
					],
				],
				'selector' => '{{WRAPPER}} .rt-working-process .rt-number',
				'condition'   => [
					'number_display' => 'yes',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'number_border',
				'selector' => '{{WRAPPER}} .rt-working-process .rt-number',
				'condition'   => [
					'number_display' => 'yes',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'number_box_shadow',
				'label' => __('Box Shadow', 'foodymat-core'),
				'selector' => '{{WRAPPER}} .rt-working-process .rt-number',
				'condition'   => [
					'number_display' => 'yes',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'number_hover_tab',
			[
				'label' => __('Hover', 'foodymat-core'),
				'condition'   => [
					'number_display' => 'yes',
				],
			]
		);

		$this->add_control(
			'number_hover_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Color', 'foodymat-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-working-process .process-item:hover .rt-number' => 'color: {{VALUE}}',
				],
				'condition'   => [
					'number_display' => 'yes',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'number_bg_hover_color',
				'label' => __('Background', 'foodymat-core'),
				'types' => ['classic', 'gradient'],
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Background', 'foodymat-core' ),
					],
				],
				'selector' => '{{WRAPPER}} .rt-working-process .process-item:hover .rt-number',
				'condition'   => [
					'number_display' => 'yes',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'number_hover_border',
				'selector' => '{{WRAPPER}} .rt-working-process .process-item:hover .rt-number',
				'condition'   => [
					'number_display' => 'yes',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'number_box_hover_shadow',
				'label' => __('Box Shadow', 'foodymat-core'),
				'selector' => '{{WRAPPER}} .rt-working-process .process-item:hover .rt-number',
				'condition'   => [
					'number_display' => 'yes',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// Content Settings
		$this->start_controls_section(
			'content_settings',
			[
				'label' => esc_html__('Content Settings', 'foodymat-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'content_typo',
				'label'    => esc_html__( 'Typo', 'foodymat-core' ),
				'selector' => '{{WRAPPER}} .rt-working-process .rt-content',
			]
		);

		$this->add_control(
			'content_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-working-process .rt-content' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'content_bg_color',
				'label' => __('Background', 'foodymat-core'),
				'types' => ['classic', 'gradient'],
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Background', 'foodymat-core' ),
					],
				],
				'selector' => '{{WRAPPER}} .rt-working-process .process-content',
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label' => __('Padding', 'foodymat-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rt-working-process .process-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' =>'before',
			]
		);

		$this->add_responsive_control(
			'content_radius',
			[
				'label' => __('Radius', 'foodymat-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rt-working-process .process-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' =>'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'content_border',
				'selector' => '{{WRAPPER}} .rt-working-process .process-content',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'content_shadow',
				'label' => __('Shadow', 'foodymat-core'),
				'selector' => '{{WRAPPER}} .rt-working-process .process-content',
			]
		);

		$this->end_controls_section();

		// Box Settings
		$this->start_controls_section(
			'box_settings',
			[
				'label' => esc_html__('Box Settings', 'foodymat-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'box_bg_color',
				'label' => __('Background', 'foodymat-core'),
				'types' => ['classic', 'gradient'],
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Background', 'foodymat-core' ),
					],
				],
				'selector' => '{{WRAPPER}} .rt-working-process .process-item',
			]
		);

		$this->add_responsive_control(
			'box_padding',
			[
				'label' => __('Padding', 'foodymat-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rt-working-process .process-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'box_radius',
			[
				'label' => __('Radius', 'foodymat-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rt-working-process .process-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' =>'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'selector' => '{{WRAPPER}} .rt-working-process .process-item',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => __('Shadow', 'foodymat-core'),
				'selector' => '{{WRAPPER}} .rt-working-process .process-item',
			]
		);

		$this->add_responsive_control(
			'info_wrap_space',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Info Wrap Space', 'foodymat-core' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-working-process .process-info' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'line_heading',
			[
				'label'     => __( 'Line Shape Style', 'foodymat-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'line_space',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Line Space', 'foodymat-core' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-process-layout-1 .rt-center-line' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition'   => [
					'layout' => [ 'layout-1' ]
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'selector' => '{{WRAPPER}} .rt-process-layout-1 .rt-center-line',
				'condition'   => [
					'layout' => [ 'layout-1' ]
				],
			]
		);

		$this->add_control(
			'line_round_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Round Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-process-layout-1 .rt-step-dot' => 'border-color: {{VALUE}}',
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
		$data = $this->get_settings();
		if ( 'layout-1' == $data['layout'] ) {
			$template = 'view-1';
		} elseif ( 'layout-2' == $data['layout'] ) {
			$template = 'view-2';
		} elseif ( 'layout-3' == $data['layout'] ) {
			$template = 'view-3';
		}
		Fns::get_template( "elementor/working-process/$template", $data );
	}
}