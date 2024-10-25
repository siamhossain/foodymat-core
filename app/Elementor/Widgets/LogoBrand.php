<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\FoodymatCore\Elementor\Widgets;

use Elementor\Controls_Manager;
use RT\FoodymatCore\Helper\Fns;
use RT\FoodymatCore\Abstracts\ElementorBase;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class LogoBrand extends ElementorBase {
	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'RT Logo Brand', 'foodymat-core' );
		$this->rt_base = 'rt-logo-brand';
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

	public function get_script_depends() {
		return [
			'swiper',
		];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_slider',
			[
				'label' => __( 'Logo Option', 'foodymat-core' ),
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'image',
			[
				'label'   => __( 'Slider Image', 'foodymat-core' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'url',
			[
				'label'       => __( 'Logo Link', 'foodymat-core' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'foodymat-core' ),
				'show_label'  => false,
			]
		);

		$this->add_control(
			'layout',
			[
				'label'   => esc_html__( 'Layout', 'foodymat-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'layout-1',
				'options' => [
					'layout-1' => __( 'Layout Slider', 'foodymat-core' ),
					'layout-2' => __( 'Layout Grid', 'foodymat-core' ),
				],
			]
		);

		$this->add_control(
			'logos',
			[
				'label'   => esc_html__( 'Add as many logos as you want', 'foodymat-core' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
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
				'condition'  => [
					'layout' => ['layout-2'],
				],
			]
		);
		$this->end_controls_section();

		// Logo Settings
		$this->start_controls_section(
			'logo_settings',
			[
				'label' => esc_html__( 'Logo Settings', 'foodymat-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'logo_color_mode',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Logo Color Mode', 'foodymat-core' ),
				'options' => array(
					'normal' 		=> esc_html__( 'Default Color', 'foodymat-core' ),
					'gray' 		=> esc_html__( 'Gray Scale', 'foodymat-core' ),
					'brightness' 		=> esc_html__( 'Gray Brightness', 'foodymat-core' ),
				),
				'default' => 'gray',
			]
		);

		$this->add_control(
			'logo_bg_color',
			[
				'label'     => __( 'Background Color', 'foodymat-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-logo-brand .logo-box' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'logo_radius',
			[
				'label'      => __( 'Radius', 'foodymat-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-logo-brand .logo-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'logo_padding',
			[
				'label'      => __( 'Padding', 'foodymat-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-logo-brand .logo-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'logo_box_height',
			[
				'label'      => __( 'Box Height', 'foodymat-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-logo-brand .logo-box' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Navigation Settings
		$this->start_controls_section(
			'navigation_settings',
			[
				'label' => esc_html__( 'Navigation Settings', 'foodymat-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout' => ['layout-1'],
				],
			]
		);
		$this->add_control(
			'navigation_size',
			[
				'label'     => __( 'Icon Size', 'foodymat-core' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'selectors' => [
					'{{WRAPPER}} .swiper-navigation .swiper-button:after' => 'font-size: {{VALUE}}px',
				],
			]
		);

		$this->start_controls_tabs(
			'navigation_style_tabs'
		);

		$this->start_controls_tab(
			'navigation_style_tab',
			[
				'label' => __( 'Normal', 'foodymat-core' ),
			]
		);
		$this->add_control(
			'navigation_color',
			[
				'label'     => __( 'Color', 'foodymat-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-navigation .swiper-button' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'navigation_bg_color',
			[
				'label'     => __( 'Background Color', 'foodymat-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-navigation .swiper-button' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'navigation_style_hover_tab',
			[
				'label' => __( 'Hover', 'foodymat-core' ),
			]
		);

		$this->add_control(
			'navigation_hover_color',
			[
				'label'     => __( 'Hover Color', 'foodymat-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-navigation .swiper-button:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'navigation_bg_hover_color',
			[
				'label'     => __( 'Background Hover Color', 'foodymat-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-navigation .swiper-button:hover' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		// Pagination Settings

		$this->start_controls_section(
			'pagination_settings',
			[
				'label' => esc_html__( 'Pagination Settings', 'foodymat-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout' => ['layout-1'],
				],
			]
		);
		$this->add_control(
			'pagination_color',
			[
				'label'     => __( 'Color', 'foodymat-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'pagination_active_color',
			[
				'label'     => __( 'Active Color', 'foodymat-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet-active' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		// Responsive Settings
		$this->start_controls_section(
			'sec_grid_responsive',
			[
				'label' => esc_html__( 'Number of Responsive Columns', 'foodymat-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
				'condition'  => [
					'layout' => ['layout-2'],
				],
			]
		);

		$this->add_control(
			'col_xl',
			[
				'type' => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Desktops: > 1199px', 'foodymat-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '2',
			]
		);
		$this->add_control(
			'col_lg',
			[
				'type' => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Desktops: > 991px', 'foodymat-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '3',
			]
		);
		$this->add_control(
			'col_md',
			[
				'type' => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Tablets: > 767px', 'foodymat-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '3',
			]
		);
		$this->add_control(
			'col_sm',
			[
				'type' => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Phones: < 768px', 'foodymat-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '4',
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

		// Slider responsive
		$this->start_controls_section(
			'section_slider_grid',
			[
				'label' => __( 'Slider Grid', 'foodymat-core' ),
				'condition' => [
					'layout' => ['layout-1'],
				],
			]
		);

		$this->add_control(
			'desktop',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Desktops: > 1600px', 'foodymat-core' ),
				'default' => '5',
				'options' => array(
					'1' => esc_html__( '1', 'foodymat-core' ),
					'2' => esc_html__( '2', 'foodymat-core' ),
					'3' => esc_html__( '3',  'foodymat-core' ),
					'4' => esc_html__( '4',  'foodymat-core' ),
					'5' => esc_html__( '5',  'foodymat-core' ),
					'6' => esc_html__( '6',  'foodymat-core' ),
					'7' => esc_html__( '7',  'foodymat-core' ),
					'8' => esc_html__( '8',  'foodymat-core' ),
				),
			]
		);
		$this->add_control(
			'md_desktop',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Desktops: > 1200px', 'foodymat-core' ),
				'default' => '4',
				'options' => array(
					'1' => esc_html__( '1', 'foodymat-core' ),
					'2' => esc_html__( '2', 'foodymat-core' ),
					'3' => esc_html__( '3',  'foodymat-core' ),
					'4' => esc_html__( '4',  'foodymat-core' ),
					'5' => esc_html__( '5',  'foodymat-core' ),
					'6' => esc_html__( '6',  'foodymat-core' ),
					'7' => esc_html__( '7',  'foodymat-core' ),
				),
			]
		);
		$this->add_control(
			'sm_desktop',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Desktops: > 992px', 'foodymat-core' ),
				'default' => '3',
				'options' => array(
					'1' => esc_html__( '1', 'foodymat-core' ),
					'2' => esc_html__( '2', 'foodymat-core' ),
					'3' => esc_html__( '3',  'foodymat-core' ),
					'4' => esc_html__( '4',  'foodymat-core' ),
					'5' => esc_html__( '5',  'foodymat-core' ),
					'6' => esc_html__( '6',  'foodymat-core' ),
				),
			]
		);
		$this->add_control(
			'tablet',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Tablets: > 768px', 'foodymat-core' ),
				'default' => '2',
				'options' => array(
					'1' => esc_html__( '1', 'foodymat-core' ),
					'2' => esc_html__( '2', 'foodymat-core' ),
					'3' => esc_html__( '3',  'foodymat-core' ),
					'4' => esc_html__( '4',  'foodymat-core' ),
					'5' => esc_html__( '5',  'foodymat-core' ),
				),
			]
		);
		$this->add_control(
			'mobile',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Phones: > 576px', 'foodymat-core' ),
				'default' => '2',
				'options' => array(
					'1' => esc_html__( '1', 'foodymat-core' ),
					'2' => esc_html__( '2', 'foodymat-core' ),
					'3' => esc_html__( '3',  'foodymat-core' ),
					'4' => esc_html__( '4',  'foodymat-core' ),
				),
			]
		);
		$this->add_control(
			'sm_mobile',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Phones: > 425px', 'foodymat-core' ),
				'default' => '1',
				'options' => array(
					'1' => esc_html__( '1', 'foodymat-core' ),
					'2' => esc_html__( '2', 'foodymat-core' ),
					'3' => esc_html__( '3',  'foodymat-core' ),
				),
			]
		);

		$this->end_controls_section();

		// Slider option
		$this->start_controls_section(
			'section_slider_option',
			[
				'label' => __( 'Slider Option', 'foodymat-core' ),
				'condition' => [
					'layout' => ['layout-1'],
				],
			]
		);

		$this->add_control(
			'slider_autoplay',
			[
				'type'        => Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Autoplay', 'foodymat-core' ),
				'label_on'    => esc_html__( 'On', 'foodymat-core' ),
				'label_off'   => esc_html__( 'Off', 'foodymat-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Enable or disable autoplay. Default: On', 'foodymat-core' ),
			]
		);
		$this->add_control(
			'display_arrow',
			[
				'type'        => Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Navigation Arrow', 'foodymat-core' ),
				'label_on'    => esc_html__( 'On', 'foodymat-core' ),
				'label_off'   => esc_html__( 'Off', 'foodymat-core' ),
				'default'     => 'no',
				'description' => esc_html__( 'Navigation Arrow. Default: On', 'foodymat-core' ),
			]
		);
		$this->add_control(
			'arrow_hover_visibility',
			[
				'label'   => esc_html__( 'Arrow Visibility', 'foodymat-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => __( 'Default', 'foodymat-core' ),
					'hover-visibility' => __( 'Hover', 'foodymat-core' ),
				],
				'condition'   => [
					'display_arrow' => 'yes',
				],
			]
		);
		$this->add_control(
			'prev_arrow',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Prev Arrow', 'foodymat-core' ),
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
					'{{WRAPPER}} .rt-swiper-slider .swiper-navigation .swiper-button-prev' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition'   => [
					'display_arrow' => 'yes',
				],
			]
		);
		$this->add_control(
			'next_arrow',
			[
				'type'    => Controls_Manager::SLIDER,
				'id'      => 'next_arrow',
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Next Arrow', 'foodymat-core' ),
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
					'{{WRAPPER}} .rt-swiper-slider .swiper-navigation .swiper-button-next' => 'right: {{SIZE}}{{UNIT}};',
				],
				'condition'   => [
					'display_arrow' => 'yes',
				],
			]
		);
		$this->add_control(
			'display_pagination',
			[
				'type'        => Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Pagination', 'foodymat-core' ),
				'label_on'    => esc_html__( 'On', 'foodymat-core' ),
				'label_off'   => esc_html__( 'Off', 'foodymat-core' ),
				'default'     => 'no',
				'description' => esc_html__( 'Navigation Arrow. Default: On', 'foodymat-core' ),
			]
		);
		$this->add_control(
			'slides_per_group',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode' 			=> 'responsive',
				'label'   => esc_html__( 'slides Per Group', 'foodymat-core' ),
				'default' => [
					'size' => 1,
				],
				'description' => esc_html__( 'slides Per Group. Default: 1', 'foodymat-core' ),
			]
		);
		$this->add_control(
			'centered_slides',
			[
				'type'        => Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Centered Slides', 'foodymat-core' ),
				'label_on'    => esc_html__( 'On', 'foodymat-core' ),
				'label_off'   => esc_html__( 'Off', 'foodymat-core' ),
				'default'     => 'no',
				'description' => esc_html__( 'Centered Slides. Default: On', 'foodymat-core' ),
			]
		);
		$this->add_control(
			'slides_space',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode' 			=> 'responsive',
				'label'   => esc_html__( 'Slides Space', 'foodymat-core' ),
				'size_units' => array( 'px', '%' ),
				'default' => array(
					'unit' => 'px',
					'size' => 24,
				),
				'description' => esc_html__( 'Slides Space. Default: 24', 'foodymat-core' ),
			]
		);
		$this->add_control(
			'slider_autoplay_delay',
			[
				'type'    => Controls_Manager::NUMBER,
				'label'   => esc_html__( 'Autoplay Slide Delay', 'foodymat-core' ),
				'default' => 5000,
				'description' => esc_html__( 'Set any value for example 5 seconds to play it in every 5 seconds. Default: 5 Seconds', 'foodymat-core' ),
				'condition'   => [
					'slider_autoplay' => 'yes',
				],
			]
		);
		$this->add_control(
			'slider_autoplay_speed',
			[
				'type'    => Controls_Manager::NUMBER,
				'label'   => esc_html__( 'Autoplay Slide Speed', 'foodymat-core' ),
				'default' => 1000,
				'description' => esc_html__( 'Set any value for example .8 seconds to play it in every 2 seconds. Default: .8 Seconds', 'foodymat-core' ),
				'condition'   => [
					'slider_autoplay' => 'yes',
				],
			]
		);
		$this->add_control(
			'slider_loop',
			[
				'type'        => Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Loop', 'foodymat-core' ),
				'label_on'    => esc_html__( 'On', 'foodymat-core' ),
				'label_off'   => esc_html__( 'Off', 'foodymat-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Loop to first item. Default: On', 'foodymat-core' ),
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

		if($data['slider_autoplay']=='yes'){
			$data['slider_autoplay']=true;
		}
		else{
			$data['slider_autoplay']=false;
		}

		$swiper_data = array(
			'slidesPerView' 	=>2,
			'loop'				=>$data['slider_loop']=='yes' ? true:false,
			'spaceBetween'		=>$data['slides_space']['size'],
			'slidesPerGroup'	=>$data['slides_per_group']['size'],
			'centeredSlides'	=>$data['centered_slides']=='yes' ? true:false ,
			'slideToClickedSlide' =>true,
			'autoplay'				=>array(
				'delay'  => $data['slider_autoplay_delay'],
			),
			'speed'      =>$data['slider_autoplay_speed'],
			'breakpoints' =>array(
				'0'    =>array('slidesPerView' =>1),
				'425'    =>array('slidesPerView' =>$data['sm_mobile']),
				'576'    =>array('slidesPerView' =>$data['mobile']),
				'768'    =>array('slidesPerView' =>$data['tablet']),
				'992'    =>array('slidesPerView' =>$data['sm_desktop']),
				'1200'    =>array('slidesPerView' =>$data['md_desktop']),
				'1600'    =>array('slidesPerView' =>$data['desktop'])
			),
			'auto'   =>$data['slider_autoplay']
		);

		if ( 'layout-2' == $data['layout'] ) {
			$template = 'view-2';
		} elseif ( 'layout-1' == $data['layout'] ) {
			$data['swiper_data'] = json_encode( $swiper_data );
			$template = 'view-1';
		}

		Fns::get_template( "elementor/logo-brand/$template", $data );
	}

}