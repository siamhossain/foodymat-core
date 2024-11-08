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

class CountDown extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'RT CountDown', 'foodymat-core' );
		$this->rt_base = 'rt-count-down';
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
			'countdown_date',
			[
				'label' => __( 'Countdown Date', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::DATE_TIME,
				'picker_options' => [
					'enableTime' => true,
				],
				'default' => '',
				'description' => __( 'Select the date and time for the countdown.', 'plugin-name' ),
			]
		);
		
		$this->add_control(
			'countdown_title',
			[
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Countdown Title', 'foodymat-core' ),
				'default' => 'Special Pizza',
			],
		);
		
		$this->add_control(
			'countdown_subtitle',
			[
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Countdown Subtitle', 'foodymat-core' ),
				'default' => 'Mega Sale',
			],
		);
		
		$this->add_control(
			'countdown_offer_text',
			[
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Countdown Offer Text', 'foodymat-core' ),
				'default' => 'UP TO 50% OFF',
			],
		);
		
		$this->add_control(
			'show_days',
			[
				'label' => __( 'Show Days', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'plugin-name' ),
				'label_off' => __( 'Hide', 'plugin-name' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'show_hours',
			[
				'label' => __( 'Show Hours', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'plugin-name' ),
				'label_off' => __( 'Hide', 'plugin-name' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'show_minutes',
			[
				'label' => __( 'Show Minutes', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'plugin-name' ),
				'label_off' => __( 'Hide', 'plugin-name' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'show_seconds',
			[
				'label' => __( 'Show Seconds', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'plugin-name' ),
				'label_off' => __( 'Hide', 'plugin-name' ),
				'return_value' => 'yes',
				'default' => 'yes',
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
					'{{WRAPPER}} .title-area' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .countdown-container ul' => 'justify-content: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);
		
		$this->end_controls_section();
		
		//Title Style
		$this->start_controls_section(
			'title_style',
			[
				'label' => esc_html__( 'Title Style', 'foodymat-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .title-area .title' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typo',
				'label'    => esc_html__( 'Typography', 'foodymat-core' ),
				'selector' => '{{WRAPPER}} .title-area .title',
			]
		);
		
		$this->add_responsive_control(
			'title_margin',
			[
				'label'              => __( 'Margin', 'foodymat-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px', '%'],
				'selectors'          => [
					'{{WRAPPER}} .title-area .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		
		$this->end_controls_section();
		
		//SubTitle Style
		$this->start_controls_section(
			'subtitle_style',
			[
				'label' => esc_html__( 'Sub Title Style', 'foodymat-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'subtitle_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .title-area .subtitle' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'subtitle_typo',
				'label'    => esc_html__( 'Typography', 'foodymat-core' ),
				'selector' => '{{WRAPPER}} .title-area .subtitle',
			]
		);
		
		$this->add_responsive_control(
			'subtitle_margin',
			[
				'label'              => __( 'Margin', 'foodymat-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px', '%'],
				'selectors'          => [
					'{{WRAPPER}} .title-area .subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		
		$this->end_controls_section();
		
		//Offer Text Style
		$this->start_controls_section(
			'offer_text_style',
			[
				'label' => esc_html__( 'Offer Text Style', 'foodymat-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_responsive_control(
			'offer_text_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .title-area .offer-text' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'offer_text_typo',
				'label'    => esc_html__( 'Typography', 'foodymat-core' ),
				'selector' => '{{WRAPPER}} .title-area .offer-text',
			]
		);
		
		$this->add_responsive_control(
			'offer_text_margin',
			[
				'label'              => __( 'Margin', 'foodymat-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px', '%'],
				'selectors'          => [
					'{{WRAPPER}} .title-area .offer-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		
		$this->end_controls_section();
		
		//countdown Label Style
		$this->start_controls_section(
			'label_style',
			[
				'label' => esc_html__( 'Countdown Label Style', 'foodymat-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'label_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .countdown-container .label' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'label_typo',
				'label'    => esc_html__( 'Typography', 'foodymat-core' ),
				'selector' => '{{WRAPPER}} .countdown-container .label',
			]
		);
		
		$this->add_responsive_control(
			'label_margin',
			[
				'label'              => __( 'Margin', 'foodymat-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px', '%'],
				'selectors'          => [
					'{{WRAPPER}} .countdown-container .label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Countdown Item Style', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		
		// Countdown Settings
		//==============================================================
		
		$this->add_responsive_control(
			'countdown_dimensions',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Countdown Box Dimensions', 'foodymat-core' ),
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 250,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .countdown-container .timer' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'countdown_typo',
				'label'    => esc_html__( 'Typo', 'foodymat-core' ),
				'selector' => '{{WRAPPER}} .countdown-container .timer',
			]
		);
		
		$this->add_control(
			'countdown_border_radius',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Border Radius', 'foodymat-core' ),
				'size_units' => [ '%' ],
				'range'      => [
					'%' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .countdown-container .timer'    => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);
		
		$this->add_responsive_control(
			'countdown_padding',
			[
				'label'      => __( 'Padding', 'foodymat-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .countdown-container .timer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		
		$this->add_responsive_control(
			'countdown_margin',
			[
				'label'      => __( 'Icon Margin', 'foodymat-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .countdown-container .timer' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		
		//Start countdown Style Tab
		$this->start_controls_tabs(
			'countdown_style_tabs'
		);
		
		//Normal Style
		$this->start_controls_tab(
			'countdown_style_normal_tab',
			[
				'label' => __( 'Normal', 'foodymat-core' ),
			]
		);
		
		$this->add_control(
			'countdown_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .countdown-container .timer'  => 'background-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'countdown_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .countdown-container .timer'  => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'countdown_border',
				'label'    => __( 'Border', 'foodymat-core' ),
				'selector' => '{{WRAPPER}} .countdown-container .timer',
			]
		);
		
		$this->end_controls_tab();
		
		//Hover Style
		$this->start_controls_tab(
			'countdown_style_hover_tab',
			[
				'label' => __( 'Hover', 'foodymat-core' ),
			]
		);
		
		$this->add_control(
			'countdown_bg_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .countdown-container .timer'  => 'background-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'countdown_border_hover',
				'label'    => __( 'Border', 'foodymat-core' ),
				'selector' => '{{WRAPPER}} .countdown-container .timer',
			]
		);
		
		$this->end_controls_tab();
		
		$this->end_controls_tabs();
		
		$this->end_controls_section();
	}

	protected function render() {
		$data     = $this->get_settings();
		$template = 'view-1';
		Fns::get_template( "elementor/count-down/$template", $data );
	}

}