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

class IconLists extends ElementorBase {

	public function __construct($data = [], $args = null) {
		$this->rt_name = esc_html__('RT Icon List', 'foodymat-core');
		$this->rt_base = 'rt-icon-list';
		parent::__construct($data, $args);
	}

	protected function register_controls() {
		$this->start_controls_section(
			'rt_icon_list',
			[
				'label' => esc_html__('Icon List', 'foodymat-core'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'icon_list_style',
			[
				'label'       => esc_html__( 'Category Style', 'foodymat-core' ),
				'type'        => Controls_Manager::SELECT2,
				'options'   => [
					'style1' => __( 'Icon List Style 01', 'foodymat-core' ),
					'style2' => __( 'Icon List Style 02', 'foodymat-core' ),
				],
				'default'     => 'style1',
			]
		);

		$this->add_control(
			'arrow_icon_display',
			[
				'label'        => __( 'Arrow Icon', 'foodymat-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'foodymat-core' ),
				'label_off'    => __( 'Hide', 'foodymat-core' ),
				'default'      => 'no',
			]
		);

		// Features
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'title', [
				'label' => __('Feature Title', 'foodymat-core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __('List Title', 'foodymat-core'),
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
					'{{WRAPPER}} .rt-icon-list .list-items {{CURRENT_ITEM}} i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-icon-list .list-items {{CURRENT_ITEM}} svg path' => 'fill: {{VALUE}}',
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
					'{{WRAPPER}} .rt-icon-list .list-items {{CURRENT_ITEM}} .title-link' => 'color: {{VALUE}}',
				],
			]
		);


		$this->add_control(
			'list',
			[
				'label' => __('Icon List', 'foodymat-core'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => __('Financing Management', 'foodymat-core'),
						'list_icon' => [
							'value' => 'icon-rt-data-service',
							'library' => 'solid',
						],
					],
					[
						'title' => __('Business Analytics', 'foodymat-core'),
						'list_icon' => [
							'value' => 'icon-rt-secure-data-service',
							'library' => 'solid',
						],
					],
					[
						'title' => __('Investment Planning', 'foodymat-core'),
						'list_icon' => [
							'value' => 'icon-rt-app-service-alt',
							'library' => 'solid',
						],
					],
					[
						'title' => __('Tax Advisory', 'foodymat-core'),
						'list_icon' => [
							'value' => 'icon-rt-tax-service',
							'library' => 'solid',
						],
					],
					[
						'title' => __('Financial Guidance', 'foodymat-core'),
						'list_icon' => [
							'value' => 'icon-rt-guidance-service',
							'library' => 'solid',
						],
					],
					[
						'title' => __('Money Analytics', 'foodymat-core'),
						'list_icon' => [
							'value' => 'icon-rt-money-analysis-service',
							'library' => 'solid',
						],
					],
				],
				'title_field' => '{{{ title }}}',
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
				'selector' => '{{WRAPPER}} .rt-icon-list .title-link',
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
					'{{WRAPPER}} .rt-icon-list .title-link' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .rt-icon-list .title-link:hover' => 'color: {{VALUE}}',

				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// Icon Settings
		$this->start_controls_section(
			'icon_settings',
			[
				'label' => esc_html__('Icon Settings', 'foodymat-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_display',
			[
				'label'        => __( 'Icon Display', 'foodymat-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'foodymat-core' ),
				'label_off'    => __( 'Hide', 'foodymat-core' ),
				'default'      => 'yes',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'icon_typo',
				'label' => esc_html__('Typo', 'foodymat-core'),
				'selector' => '{{WRAPPER}} .rt-icon-list .title-link i',
			]
		);
		$this->add_responsive_control(
			'icon_gap',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Icon Gap', 'foodymat-core' ),
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
					'{{WRAPPER}} .rt-icon-list .title-link' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'icon_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Color', 'foodymat-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-icon-list .title-link i' => 'color: {{VALUE}}',

				],
			]
		);
		$this->add_control(
			'icon_hover_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Hover Color', 'foodymat-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-icon-list .title-link:hover i' => 'color: {{VALUE}}',

				],
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

		$this->add_responsive_control(
			'box_gap',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Gap', 'foodymat-core' ),
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
					'{{WRAPPER}} .rt-icon-list ul li' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// box tab
		$this->start_controls_tabs(
			'box_style_tabs'
		);

		$this->start_controls_tab(
			'box_normal_tab',
			[
				'label' => __('Normal', 'foodymat-core'),
			]
		);

		$this->add_control(
			'box_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Background Color', 'foodymat-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-icon-list .title-link' => 'background-color: {{VALUE}}',

				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'label' => __('Border', 'foodymat-core'),
				'selector' => '{{WRAPPER}} .rt-icon-list .title-link',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'box_hover_tab',
			[
				'label' => __('Hover', 'foodymat-core'),
			]
		);

		$this->add_control(
			'box_hover_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Background Hover Color', 'foodymat-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-icon-list .title-link:hover' => 'background-color: {{VALUE}}',

				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'box_hover_border',
				'label' => __('Border', 'foodymat-core'),
				'selector' => '{{WRAPPER}} .rt-icon-list .title-link:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'box_padding',
			[
				'label' => __('Padding', 'foodymat-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rt-icon-list .title-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' =>'before',
			]
		);
		$this->add_responsive_control(
			'box_radius',
			[
				'label' => __('Radius', 'foodymat-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rt-icon-list .title-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' =>'before',
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
		
		switch ( $data['icon_list_style'] ) {
			case 'style2':
				$template = 'view-2';
				break;
			default:
				$template = 'view-1';
				break;
		}
		Fns::get_template( "elementor/icon-list/$template", $data );
	}
}