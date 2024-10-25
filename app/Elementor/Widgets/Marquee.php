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

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Marquee extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'RT Marquee', 'foodymat-core' );
		$this->rt_base = 'rt-marquee';
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

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'title',
			[
				'label'       => __( 'Title', 'foodymat-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'Enter Name', 'foodymat-core' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'url',
			[
				'label'       => __( 'Title Link', 'foodymat-core' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'foodymat-core' ),
				'show_label'  => false,
			]
		);

		$this->add_control(
			'items',
			[
				'label'       => __( 'Marquee List', 'foodymat-core' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',
				'default'     => [
					[ 'title' => 'Marketing Agency', ],
					[ 'title' => 'Let Talk', ],
					[ 'title' => 'Web Design Agency', ],
					[ 'title' => 'Modern Technology', ],
					[ 'title' => 'Web Development', ],
				],
			]
		);
		
		$this->add_control(
			'marquee_direction',
			[
				'label'     => __( 'Marquee', 'foodymat-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'marquee-left',
				'options'   => [
					'marquee-left'  => __( 'Left Direction', 'foodymat-core' ),
					'marquee-right' => __( 'Right Direction', 'foodymat-core' ),
				],
			]
		);


		$this->add_control(
			'heading_tag',
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

		$this->end_controls_section();

		// Box setting
		$this->start_controls_section(
			'box_style',
			[
				'label' => esc_html__( 'Box Style', 'foodymat-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'box_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-marquee-slider .rt-marquee' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'box_padding',
			[
				'label'      => __( 'Padding', 'foodymat-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-marquee-slider .rt-marquee' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'box_radius',
			[
				'label'      => __( 'Radius', 'foodymat-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-marquee-slider .rt-marquee' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'box_transform',
			[
				'type'      => Controls_Manager::NUMBER,
				'label'     => esc_html__( 'Transform Value', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-marquee-slider' => 'transform: rotate({{VALUE}}deg)',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'box_position',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Box Top / Bottom', 'foodymat-core' ),
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
					'{{WRAPPER}} .rt-marquee-slider' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'box_margin',
			[
				'label'      => __( 'Margin', 'foodymat-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-marquee-slider' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		// Title setting
		$this->start_controls_section(
			'title_style',
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
				'selector' => '{{WRAPPER}} .rt-marquee-slider .rt-marquee-item .entry-title',
			]
		);

		$this->add_control(
			'title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Title Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-marquee-slider .rt-marquee-item .entry-title' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-marquee-slider .rt-marquee-item .entry-title a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Title Hover Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-marquee-slider .rt-marquee-item .entry-title:before' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_shadow_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Title Stroke Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-marquee-slider .rt-marquee-item .entry-title' => '-webkit-text-stroke-color: {{VALUE}}',
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
					'{{WRAPPER}} .rt-marquee-slider .rt-marquee-item .entry-title' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'gradient_display',
			[
				'label'        => __( 'Gradient Display', 'foodymat-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'foodymat-core' ),
				'label_off'    => __( 'Hide', 'foodymat-core' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'title_gradient',
				'types' => [ 'gradient' ],
				'selector' => '{{WRAPPER}} .rt-marquee-slider .rt-marquee-item .title-gradient',
				'condition' => [
					'gradient_display' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		// Icon setting
		$this->start_controls_section(
			'icon_style',
			[
				'label' => esc_html__( 'Icon Style', 'foodymat-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_type',
			[
				'label' => __('Icon Type', 'foodymat-core'),
				'type' => Controls_Manager::SELECT,
				'default' => 'icon',
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

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'icon_typo',
				'label'    => esc_html__( 'Icon Typo', 'foodymat-core' ),
				'selector' => '{{WRAPPER}} .rt-marquee-slider .rt-marquee-item .icon-holder',
			]
		);

		$this->add_responsive_control(
			'icon_typo',
			[
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Icon Size', 'toyup-core' ),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-marquee-slider .rt-marquee-item .icon-holder' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-marquee-slider .rt-marquee-item .icon-holder svg' => 'transform: scale({{SIZE}});',
				],

			]
		);

		$this->add_control(
			'icon_fill_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon Fill Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-marquee-slider .rt-marquee-item .icon-holder' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-marquee-slider .rt-marquee-item .icon-holder path' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'icon_stroke_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon Stroke Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-marquee-slider .rt-marquee-item .icon-holder' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-marquee-slider .rt-marquee-item .icon-holder path' => 'stroke: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'icon_gap',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'    => 'responsive',
				'label'   => esc_html__( 'Icon Gap', 'toyup-core' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-marquee-slider .rt-marquee-item .icon-holder' => 'width: {{SIZE}}{{UNIT}};',
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
		$data  = $this->get_settings();
		$template = 'view-1';
		Fns::get_template( "elementor/marquee/$template", $data );
	}

}