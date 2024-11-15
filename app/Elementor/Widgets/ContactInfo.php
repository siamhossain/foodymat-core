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

class ContactInfo extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'RT Contact Info', 'foodymat-core' );
		$this->rt_base = 'rt-contact-info';
		parent::__construct( $data, $args );
	}
	protected function register_controls() {
		$this->start_controls_section(
			'rt_info_box',
			[
				'label' => esc_html__( 'Contact Info Settings', 'foodymat-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		
		$repeater = new \Elementor\Repeater();
		
		$repeater->add_control(
			'list_type', [
				'type'    	  => Controls_Manager::SELECT2,
				'label'   	  => esc_html__( 'List Type', 'foodymat-core' ),
				'options' 	  => array(
					'default'    => esc_html__( 'Default List', 'foodymat-core' ),
					'title_list' => esc_html__( 'Title List', 'foodymat-core' ),
					'icon_list'  => esc_html__( 'Icon List', 'foodymat-core' ),
				),
				'default' 	  => 'default',
				'description' => esc_html__( '2 list type available here. (default list is normal text list)', 'foodymat-core' ),
			]
		);
		$repeater->add_control(
			'list_title', [
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Title', 'foodymat-core' ),
				'default' => 'List title put here',
				'condition' => [
					'list_type' => 'title_list',
				],
			]
		);
		
		$repeater->add_control(
			'list_icon', [
				'type'      => \Elementor\Controls_Manager::ICONS,
				'label'   => esc_html__( 'Icon', 'foodymat-core' ),
				'default' => [
					'value' => 'fas fa-map-marker-alt',
					'library' => 'fa-solid',
				],
				'condition' => [
					'list_type' => 'icon_list',
				],
			]
		);
		
		$repeater->add_control(
			'list_text', [
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'List Text', 'foodymat-core' ),
				'default' => 'Lists text put here',
			]
		);
		
		
		$this->add_control(
			'title',
			[
				'label'     => __('Title', 'foodymat-core'),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'List Title',
			
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'   => esc_html__( 'Main Title Tag', 'foodymat-core' ),
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
			'text_align',
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
					'{{WRAPPER}} .rt-contact-info' => 'text-align: {{VALUE}} !important',
				],
				'toggle'    => true,
			]
		);
		
		$this->add_control(
			'items',
			[
				'label'   => esc_html__( 'Contact info Repeater', 'foodymat-core' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[ 'list_text'        => __( '4140 Parker Rd. Allentown, New Mexico 31134', 'foodymat-core' ), ],
					[ 'list_text'        => __( '(+1) 123-456-3389', 'foodymat-core' ),],
					[ 'list_text'        => __( 'info@example.com', 'foodymat-core' ),],
				],
			]
		);
		
		$this->end_controls_section();
		
		// Title Settings
		//==============================================================
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
					'{{WRAPPER}} .rt-contact-info .info-title'   => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typo', 'foodymat-core' ),
				'selector' => '{{WRAPPER}} .rt-contact-info .info-title',
			]
		);
		
		$this->add_responsive_control(
			'title_spacing',
			[
				'label'              => __( 'Title Spacing', 'foodymat-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-contact-info .info-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		
		$this->end_controls_section();
		
		// Contact List
		//==============================================================
		$this->start_controls_section(
			'list_item_settings',
			[
				'label'     => esc_html__( 'List Item', 'foodymat-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'list_item_layout',
			[
				'label'   => esc_html__( 'List Layout', 'foodymat-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'list-vertical',
				'options' => [
					'list-vertical' => esc_html__( 'Vertical', 'foodymat-core' ),
					'list-horizontal' => esc_html__( 'Horizontal', 'foodymat-core' ),
				],
			]
		);
		
		$this->add_control(
			'list_item_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'List Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-contact-info .contact-list li' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'list_item_link_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Link Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-contact-info .contact-list li a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'list_item_link_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Link Hover Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-contact-info .contact-list li a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'list_item_typo',
				'label'    => esc_html__( 'List Typo', 'foodymat-core' ),
				'selector' => '{{WRAPPER}} .rt-contact-info .contact-list li',
			]
		);
		
		$this->add_responsive_control(
			'list_item_spacing',
			[
				'label'              => __( 'List Spacing', 'foodymat-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-contact-info .contact-list li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'title_list_heading',
			[
				'label'     => __( 'List Heading Setting', 'foodymat-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'list_item_heading_typo',
				'label'    => esc_html__( 'List Heading Typo', 'foodymat-core' ),
				'selector' => '{{WRAPPER}} .rt-contact-info .contact-list li span',
			]
		);

		$this->add_control(
			'list_item_heading_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'List Heading Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-contact-info .contact-list li span' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'list_item_heading_space',
			[
				'label'      => __( 'List Heading Space', 'foodymat-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 5,
						'max'  => 50,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-contact-info .contact-list li span'   => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_list_heading',
			[
				'label'     => __( 'List Icon Setting', 'foodymat-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'list_item_icon_size',
			[
				'label'      => __( 'List Icon Size', 'foodymat-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 12,
						'max'  => 50,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-contact-info .contact-list li i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-contact-info .contact-list li svg'   => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'list_item_icon_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'List Icon Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-contact-info .contact-list li i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-contact-info .contact-list li svg' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'list_item_icon_space',
			[
				'label'      => __( 'List Icon Space', 'foodymat-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 5,
						'max'  => 50,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-contact-info .contact-list li i'   => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-contact-info .contact-list li svg'   => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'phone_list_heading',
			[
				'label'     => __( 'Phone Number Setting', 'foodymat-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'list_item_phone_typo',
				'label'    => esc_html__( 'Phone Typo', 'foodymat-core' ),
				'selector' => '{{WRAPPER}} .rt-contact-info .contact-list li.phone-no a',
			]
		);

		$this->add_control(
			'list_item_phone_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Phone Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-contact-info .contact-list li.phone-no a' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'email_list_heading',
			[
				'label'     => __( 'Email Setting', 'foodymat-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'list_item_email_typo',
				'label'    => esc_html__( 'Email Typo', 'foodymat-core' ),
				'selector' => '{{WRAPPER}} .rt-contact-info .contact-list li.email a',
			]
		);
		
		$this->add_control(
			'list_item_email_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Email Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-contact-info .contact-list li.email a' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->end_controls_section();

		// Box Settings
		//==============================================================
		$this->start_controls_section(
			'box_settings',
			[
				'label' => esc_html__( 'Box Settings', 'foodymat-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'box_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-contact-info' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'box_radius',
			[
				'label'      => __( 'Border Radius', 'foodymat-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-contact-info' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'box_padding',
			[
				'label'      => __( 'Box Padding', 'foodymat-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-contact-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
		$template = 'view-1';
		Fns::get_template( "elementor/contact-info/{$template}", $data );
	}

}