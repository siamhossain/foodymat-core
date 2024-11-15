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

class SocialIcon extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'RT Social Icon', 'foodymat-core' );
		$this->rt_base = 'rt-social-icon';
		parent::__construct( $data, $args );
	}
	protected function register_controls() {
		$this->start_controls_section(
			'rt_social_setting',
			[
				'label' => esc_html__( 'RT Social Icon Setting', 'foodymat-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'social_icon',
			[
				'label' => esc_html__( 'Icon', 'foodymat-core' ),
				'type'      => \Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'social',
				'default' => [
					'value' => 'fab fa-wordpress',
					'library' => 'fa-brands',
				],
			]
		);

		$repeater->add_control(
			'link', [
				'type'  => Controls_Manager::URL,
				'label' => esc_html__( 'URL(optional)', 'foodymat-core' ),
				'label_block' => true,
				'placeholder' => esc_html__( 'https://your-link.com', 'foodymat-core' ),
			]
		);
		$repeater->add_control(
			'icon_color', [
				'type' => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Icon Color', 'foodymat-core' ),
				'default'  => '',
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'icon_bg_color', [
				'type' => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Icon BG ColorX', 'foodymat-core' ),
				'default'  => '',
				'label_block' => true,
			]
		);

		$this->add_control(
			'label',
			[
				'label'     => __('Label', 'foodymat-core'),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Follow Us On',

			]
		);

		$this->add_responsive_control(
			'alignment',
			[
				'label'     => __( 'Alignment', 'foodymat-core' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
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
					'{{WRAPPER}}' => 'text-align: {{VALUE}} !important',
				],
				'toggle'    => true,
			]
		);

		$this->add_control(
			'social_icon',
			[
				'label'   => esc_html__( 'Social Icon', 'foodymat-core' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default' => [
					[
						'title' => 'Facebook',
						'social_icon' => [
							'value' => 'fab fa-facebook-f',
							'library' => 'fa-brands',
						],
					],
					[
						'title' => 'Twitter',
						'social_icon' => [
							'value' => 'fab fa-x-twitter',
							'library' => 'fa-brands',
						],
					],
					[
						'title' => 'Instagram',
						'social_icon' => [
							'value' => 'fab fa-instagram',
							'library' => 'fa-brands',
						],
					],
					[
						'title' => 'Pinterest',
						'social_icon' => [
							'value' => 'fab fa-pinterest-p',
							'library' => 'fa-brands',
						],
					],
				],
			]
		);

		$this->add_control(
			'transform',
			[
				'label'        => __( 'Transform', 'foodymat-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'foodymat-core' ),
				'label_off'    => __( 'Off', 'foodymat-core' ),
				'return_value' => 'rotate',
			]
		);

		$this->add_responsive_control(
			'transform_rotate',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Rotate', 'foodymat-core' ),
				'size_units' => [ 'px', 'deg' ],
				'range'      => [
					'px' => [
						'min'  => -1000,
						'max'  => 1000,
						'step' => 1,
					],
					'deg' => [
						'min'  => -360,
						'max'  => 360,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-social-icon'   => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
				'condition'   => [
					'transform' => [ 'rotate' ],
				],

			]
		);

		$this->add_responsive_control(
			'rotate_position',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Left/Right', 'foodymat-core' ),
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => -1000,
						'max'  => 1000,
						'step' => 1,
					],
					'%' => [
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-social-icon'   => 'left: {{SIZE}}{{UNIT}}; position:relative;',
				],
				'condition'   => [
					'transform' => [ 'rotate' ],
				],

			]
		);

		$this->end_controls_section();

		// Title Settings
		//==============================================================
		$this->start_controls_section(
			'label_settings',
			[
				'label' => esc_html__( 'Label Settings', 'foodymat-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'flex_direction',
			[
				'label'     => __( 'Direction', 'foodymat-core' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'column' => [
						'title' => __( 'Column', 'foodymat-core' ),
						'icon'  => 'eicon-arrow-down',
					],
					'row'     => [
						'title' => __( 'Row', 'foodymat-core' ),
						'icon'  => 'eicon-arrow-right',
					],
					'column-reverse'   => [
						'title' => __( 'Column Reverse', 'foodymat-core' ),
						'icon'  => 'eicon-arrow-up',
					],
					'row-reverse'   => [
						'title' => __( 'Row Reverse', 'foodymat-core' ),
						'icon'  => 'eicon-arrow-left',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-social-icon' => 'flex-direction: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'flex_alignment',
			[
				'label'     => __( 'Alignment', 'foodymat-core' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'flex-start' => [
						'title' => __( 'Left', 'foodymat-core' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center'     => [
						'title' => __( 'Center', 'foodymat-core' ),
						'icon'  => 'eicon-text-align-center',
					],
					'flex-end'   => [
						'title' => __( 'Right', 'foodymat-core' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-social-icon' => 'align-items: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'label_typo',
				'label'    => esc_html__( 'Typo', 'foodymat-core' ),
				'selector' => '{{WRAPPER}} .rt-social-icon label',
			]
		);

		$this->add_control(
			'label_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-social-icon label'   => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'label_gap',
			[
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Gap', 'foodymat-core' ),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-social-icon' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Social List
		//==============================================================
		$this->start_controls_section(
			'social_item_settings',
			[
				'label'     => esc_html__( 'Social Icon Item', 'foodymat-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'social_typo',
				'label'    => esc_html__( 'Social Typo', 'foodymat-core' ),
				'selector' => '{{WRAPPER}} .rt-social-icon .rt-social-item i',
			]
		);

		$this->add_responsive_control(
			'social_gap',
			[
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Social Gap', 'foodymat-core' ),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-social-icon .rt-social-item' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'social_width',
			[
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Social Width', 'foodymat-core' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-social-icon .rt-social-item a' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'social_height',
			[
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Social Height', 'foodymat-core' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-social-icon .rt-social-item a' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'social_radius',
			[
				'label'              => __( 'Social Radius', 'foodymat-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-social-icon .rt-social-item a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->start_controls_tabs(
			'social_style_tabs', [
			]
		);

		$this->start_controls_tab(
			'social_normal_tab',
			[
				'label' => __( 'Normal', 'foodymat-core' ),
			]
		);

		$this->add_control(
			'social_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-social-icon .rt-social-item a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'social_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-social-icon .rt-social-item a' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'social_border',
				'label'    => __( 'Border', 'foodymat-core' ),
				'selector' => '{{WRAPPER}} .rt-social-icon .rt-social-item a',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'button_style_hover_tab',
			[
				'label' => __( 'Hover', 'foodymat-core' ),
			]
		);

		$this->add_control(
			'social_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-social-icon .rt-social-item a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'social_bg_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-social-icon .rt-social-item a:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'social_hover_border',
				'label'    => __( 'Border', 'foodymat-core' ),
				'selector' => '{{WRAPPER}} .rt-social-icon .rt-social-item a:hover',
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
		$data     = $this->get_settings();
		$template = 'view-1';

		Fns::get_template( "elementor/social-icon/{$template}", $data );
	}

}