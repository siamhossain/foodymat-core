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

class Testimonial extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'RT Testimonial', 'foodymat-core' );
		$this->rt_base = 'rt-testimonial';
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

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'image',
			[
				'label'   => __( 'Choose Image', 'foodymat-core' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'name',
			[
				'label'       => __( 'Name', 'foodymat-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'Enter Name', 'foodymat-core' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'designation',
			[
				'label'       => __( 'Designation', 'foodymat-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'Enter Designation', 'foodymat-core' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'content',
			[
				'label'   => __( 'Content', 'foodymat-core' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __( 'Enter Designation', 'foodymat-core' ),
			]
		);

		$repeater->add_control(
			'rating',[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Rating', 'foodymat-core' ),
				'default' => '5',
				'options' => [
					'1' => esc_html__( 'Rating 1', 'foodymat-core' ),
					'2' => esc_html__( 'Rating 2', 'foodymat-core' ),
					'3' => esc_html__( 'Rating 3', 'foodymat-core' ),
					'4' => esc_html__( 'Rating 4', 'foodymat-core' ),
					'5' => esc_html__( 'Rating 5', 'foodymat-core' ),
				],
			]
		);

		$this->add_control(
			'layout',
			[
				'label'   => __( 'Layout', 'foodymat-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'layout-1',
				'options' => [
					'layout-1' => __( 'Slider', 'foodymat-core' ),
					'layout-2' => __( 'Big Author Slider', 'foodymat-core' ),
					'layout-3' => __( 'Thumb Slider', 'foodymat-core' ),
					'layout-4' => __( 'Card Slider', 'foodymat-core' ),
					'layout-5' => __( 'Marquee Horizontal', 'foodymat-core' ),
					'layout-6' => __( 'Marquee Vertical', 'foodymat-core' ),
					'layout-7' => __( 'Grid 01', 'foodymat-core' ),
					'layout-8' => __( 'Grid 02', 'foodymat-core' ),
					'layout-9' => __( 'Grid 03', 'foodymat-core' ),
				],
			]
		);

		$this->add_control(
			'main_title',
			[
				'label'       => esc_html__( 'Title', 'foodymat-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => __( 'Join Thousands of Satisfied Customers', 'foodymat-core' ),
				'condition' => [
					'layout' => 'layout-2',
				],
			]
		);

		$this->add_control(
			'marquee_direction',
			[
				'label'   => __( 'Marquee', 'foodymat-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'marquee-left',
				'options' => [
					'marquee-left' => __( 'Left Direction', 'foodymat-core' ),
					'marquee-right' => __( 'Right Direction', 'foodymat-core' ),
				],
				'condition' => [
					'layout' => 'layout-5',
				],
			]
		);

		$this->add_control(
			'marquee_direction_two',
			[
				'label'   => __( 'Marquee', 'foodymat-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'marquee-top',
				'options' => [
					'marquee-top' => __( 'Top Direction', 'foodymat-core' ),
					'marquee-bottom' => __( 'Bottom Direction', 'foodymat-core' ),
				],
				'condition' => [
					'layout' => 'layout-6',
				],
			]
		);

		$this->add_control(
			'items',
			[
				'label'       => __( 'Testimonial List', 'foodymat-core' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'name'        => __( 'Mr.Marke Josefer', 'foodymat-core' ),
						'designation' => __( 'CEO, PSDBOSS', 'foodymat-core' ),
						'content'     => __( 'Manage and streamline operations acrosers multiple locations wear sales channels, and employees toter improve efficiency streamline',
							'foodymat-core' ),
					],
					[
						'name'        => __( 'Ronald Richards', 'foodymat-core' ),
						'designation' => __( 'WordPress Developer', 'foodymat-core' ),
						'content'     => __( 'Manage and streamline operations acrosers multiple locations wear sales channels, and employees toter improve efficiency streamline',
							'foodymat-core' ),
					],
					[
						'name'        => __( 'Merry Jiucy', 'foodymat-core' ),
						'designation' => __( 'Web Designer', 'foodymat-core' ),
						'content'     => __( 'Manage and streamline operations acrosers multiple locations wear sales channels, and employees toter improve efficiency streamline', 'foodymat-core' ),
					],

				],
				'title_field' => '{{{ name }}}',
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
					'layout' => ['layout-7', 'layout-8', 'layout-9'],
				],
			]
		);

		$this->add_control(
			'quote_icon',
			[
				'label'            => __( 'Quote Icon', 'foodymat-core' ),
				'type'      => \Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default'          => [
					'value'   => 'icon-rt-quote-2',
					'library' => 'solid',
				],
			]
		);

		$this->end_controls_section();

		//Option setting
		$this->start_controls_section(
			'section_option',
			[
				'label' => __( 'Option', 'foodymat-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'rating_display',
			[
				'label'        => __( 'Rating Display', 'foodymat-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'foodymat-core' ),
				'label_off'    => __( 'Hide', 'foodymat-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'thumb_display',
			[
				'label'        => __( 'Thumb Display', 'foodymat-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'foodymat-core' ),
				'label_off'    => __( 'Hide', 'foodymat-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'designation_display',
			[
				'label'        => __( 'Designation Display', 'foodymat-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'foodymat-core' ),
				'label_off'    => __( 'Hide', 'foodymat-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'quote_display',
			[
				'label'        => __( 'Quote Display', 'foodymat-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'foodymat-core' ),
				'label_off'    => __( 'Hide', 'foodymat-core' ),
				'return_value' => 'no',
				'default'      => 'no',
			]
		);

		$this->add_responsive_control(
			'box_padding',
			[
				'label'      => __( 'Padding', 'foodymat-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-testimonial-slider .slider-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'box_radius',
			[
				'label'      => __( 'Radius', 'foodymat-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-testimonial-slider .slider-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		
		
		//Start countdown Style Tab
		$this->start_controls_tabs(
			'style_tabs'
		);
		
		//Normal Style
		$this->start_controls_tab(
			'style_normal_tab',
			[
				'label' => __( 'Normal', 'foodymat-core' ),
			]
		);
		
		$this->add_control(
			'box_bag_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-testimonial-slider .slider-item' => 'background-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'selector' => '{{WRAPPER}} .rt-testimonial-slider .slider-item',
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => __('Box Shadow', 'foodymat-core'),
				'selector' => '{{WRAPPER}} .rt-testimonial-slider .slider-item',
			]
		);
		
		$this->end_controls_tab();
		
		//Hover Style
		$this->start_controls_tab(
			'style_hover_tab',
			[
				'label' => __( 'Hover', 'foodymat-core' ),
			]
		);
		
		$this->add_control(
			'bg_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-testimonial-slider .slider-item:hover'  => 'background-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border_hover',
				'selector' => '{{WRAPPER}} .rt-testimonial-slider .slider-item:hover',
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow_hover',
				'label' => __('Box Shadow', 'foodymat-core'),
				'selector' => '{{WRAPPER}} .rt-testimonial-slider .slider-item:hover',
			]
		);
		
		$this->end_controls_tab();
		
		$this->end_controls_tabs();
		
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
					'{{WRAPPER}} .rt-testimonial-slider .slider-item' => 'text-align: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		// Content setting
		$this->start_controls_section(
			'content_style',
			[
				'label' => esc_html__( 'Content Style', 'foodymat-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'thumb_style_heading',
			[
				'label' => __( 'Thumb Style', 'foodymat-core' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_responsive_control(
			'thumb_size',
			[
				'label'      => __( 'Thumb Size', 'foodymat-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
					'%' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-testimonial-slider .testimonial-img img' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'thumb_radius',
			[
				'label'      => __( 'Radius', 'foodymat-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-testimonial-slider .testimonial-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'name_style_heading',
			[
				'label'     => __( 'Name Style', 'foodymat-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typo',
				'label'    => esc_html__( 'Name Typo', 'foodymat-core' ),
				'selector' => '{{WRAPPER}} .rt-testimonial-slider .slider-item .rt-title',
			]
		);

		$this->add_control(
			'title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Name Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-testimonial-slider .slider-item .rt-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_border_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Border Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-testimonial-layout-1 .rt-title:after' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'layout' => 'layout-1',
				],
			]
		);
		$this->add_responsive_control(
			'title_space',
			[
				'label'      => __( 'Name Space', 'foodymat-core' ),
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
					'{{WRAPPER}} .rt-testimonial-slider .rt-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'designation_style_heading',
			[
				'label'     => __( 'Designation Style', 'foodymat-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'designation_typo',
				'label'    => esc_html__( 'Designation Typo', 'foodymat-core' ),
				'selector' => '{{WRAPPER}} .rt-testimonial-slider .slider-item .rt-subtitle',
			]
		);

		$this->add_control(
			'designation_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Designation', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-testimonial-slider .slider-item .rt-subtitle' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'designation_space',
			[
				'label'      => __( 'Designation Space', 'foodymat-core' ),
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
					'{{WRAPPER}} .rt-testimonial-slider .slider-item .rt-subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'content_style_heading',
			[
				'label'     => __( 'Content Style', 'foodymat-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'content_typo',
				'label'    => esc_html__( 'Content Typo', 'foodymat-core' ),
				'selector' => '{{WRAPPER}} .rt-testimonial-slider .slider-item .rt-content',
			]
		);

		$this->add_control(
			'content_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Content', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-testimonial-slider .slider-item .rt-content' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'content_space',
			[
				'label'      => __( 'Content Space', 'foodymat-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-testimonial-slider .slider-item .rt-content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'quote_style_heading',
			[
				'label'     => __( 'Quote Icon Style', 'foodymat-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'quote_icon_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Quote Icon', 'foodymat-core' ),
				'description' => esc_html__( 'If you would like to use only icon color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-testimonial-slider .slider-item .quote' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-testimonial-layout-3 .quote' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'quote_icon_size',
			[
				'type'      => Controls_Manager::NUMBER,
				'label'     => esc_html__( 'Quote Size', 'foodymat-core' ),
				'description' => esc_html__( 'If you would like to use only icon size', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-testimonial-slider .slider-item .quote' => 'font-size: {{VALUE}}px',
					'{{WRAPPER}} .rt-testimonial-layout-3 .quote' => 'font-size: {{VALUE}}px',
				],
			]
		);

		$this->add_responsive_control(
			'quote_icon_horizontal',
			[
				'label'      => __( 'Horizontal Position', 'foodymat-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'%' => [
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					],
					'px' => [
						'min'  => -1000,
						'max'  => 1000,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-testimonial-slider .slider-item .quote' => 'right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-testimonial-layout-3 .quote' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'quote_icon_vertical',
			[
				'label'      => __( 'Vertical Position', 'foodymat-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'%' => [
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					],
					'px' => [
						'min'  => -1000,
						'max'  => 1000,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-testimonial-slider .slider-item .quote' => 'bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-testimonial-layout-3 .quote' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'rating_style_heading',
			[
				'label'     => __( 'Rating Style', 'foodymat-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'rating_display' => 'yes',
				],
			]
		);

		$this->add_control(
			'rating_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Rating Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-testimonial-slider .slider-item .item-rating .deactive' => 'color: {{VALUE}}',
				],
				'condition' => [
					'rating_display' => 'yes',
				],
			]
		);
		$this->add_control(
			'rating_active_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Rating Active Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-testimonial-slider .slider-item .item-rating .active' => 'color: {{VALUE}}',
				],
				'condition' => [
					'rating_display' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'rating_size',
			[
				'label'     => __( 'Font Size', 'foodymat-core' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 10,
				'max'       => 50,
				'step'      => 1,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rt-testimonial-slider .slider-item .item-rating' => 'font-size: {{VALUE}}px',
				],
				'condition' => [
					'rating_display' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'rating_space',
			[
				'label'      => __( 'Rating Space', 'foodymat-core' ),
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
					'{{WRAPPER}} .rt-testimonial-slider .slider-item .item-rating' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-testimonial-layout-4 .slider-item .item-rating' => 'top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-testimonial-layout-9 .slider-item .item-rating' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Slider setting
		$this->start_controls_section(
			'slider_style',
			[
				'label' => esc_html__( 'Slider Style', 'foodymat-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout' => ['layout-1', 'layout-2', 'layout-3', 'layout-4'],
				],
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
			]
		);

		$this->add_responsive_control(
			'arrow_radius',
			[
				'label'      => __( 'Radius', 'foodymat-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .swiper-navigation .swiper-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'condition'   => [
					'display_arrow' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'navigation_width',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Navigation Width', 'foodymat-core' ),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-navigation .swiper-button' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition'   => [
					'display_arrow' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'navigation_height',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Navigation Height', 'foodymat-core' ),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-navigation .swiper-button' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition'   => [
					'display_arrow' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'nex_prev_arrow',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Arrow Top / Bottom', 'foodymat-core' ),
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
					'{{WRAPPER}} .swiper-navigation .swiper-button' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition'   => [
					'display_arrow' => 'yes', 'layout!' => 'layout-4',
				],
			]
		);
		$this->add_responsive_control(
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
						'min' => -500,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-navigation .swiper-button-prev' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition'   => [
					'display_arrow' => 'yes', 'layout!' => 'layout-4',
				],
			]
		);
		$this->add_responsive_control(
			'next_arrow',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Next Arrow', 'foodymat-core' ),
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
					'{{WRAPPER}} .swiper-navigation .swiper-button-next' => 'right: {{SIZE}}{{UNIT}};',
				],
				'condition'   => [
					'display_arrow' => 'yes', 'layout!' => 'layout-4',
				],
			]
		);

		$this->start_controls_tabs(
			'navigation_style_tabs',
			[
				'condition'   => [
					'display_arrow' => 'yes',
				],
			]

		);

		$this->start_controls_tab(
			'navigation_style_tab',
			[
				'label' => __( 'Normal', 'foodymat-core' ),
			]
		);
		$this->add_control(
			'arrow_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Arrow Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .swiper-navigation .swiper-button' => 'color: {{VALUE}}',
				],
				'condition'   => [
					'display_arrow' => 'yes',
				],
			]
		);
		$this->add_control(
			'arrow_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Arrow BG Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .swiper-navigation .swiper-button' => 'background-color: {{VALUE}}',
				],
				'condition'   => [
					'display_arrow' => 'yes',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'selector' => '{{WRAPPER}} .swiper-navigation .swiper-button',
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
			'arrow_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'ArrowHover Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .swiper-navigation .swiper-button:hover' => 'color: {{VALUE}}',
				],
				'condition'   => [
					'display_arrow' => 'yes',
				],
			]
		);

		$this->add_control(
			'arrow_bg_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Arrow BG Hover Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .swiper-navigation .swiper-button:hover' => 'background-color: {{VALUE}}',
				],
				'condition'   => [
					'display_arrow' => 'yes',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'button_hover_border',
				'selector' => '{{WRAPPER}} .swiper-navigation .swiper-button:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'pagination_heading',
			[
				'label'     => __( 'Pagination Style', 'foodymat-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition'   => [
					'display_pagination' => 'yes',
				],
			]
		);

		$this->add_control(
			'pagination_color',
			[
				'label'     => __( 'Pagination Color', 'foodymat-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet' => 'background-color: {{VALUE}}',
				],
				'condition'   => [
					'display_pagination' => 'yes',
				],
			]
		);
		$this->add_control(
			'pagination_active_color',
			[
				'label'     => __( 'Pagination Active Color', 'foodymat-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet-active' => 'background-color: {{VALUE}}',
				],
				'condition'   => [
					'display_pagination' => 'yes',
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
					'layout' => ['layout-7', 'layout-8', 'layout-9'],
				],
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

		// Slider responsive
		$this->start_controls_section(
			'section_slider_grid',
			[
				'label' => __( 'Slider Grid', 'foodymat-core' ),
				'condition' => [
					'layout' => ['layout-1', 'layout-2', 'layout-3', 'layout-4'],
				],
			]
		);

		$this->add_control(
			'desktop',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Desktops: > 1600px', 'foodymat-core' ),
				'default' => '2',
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
			'md_desktop',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Desktops: > 1200px', 'foodymat-core' ),
				'default' => '2',
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
			'sm_desktop',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Desktops: > 992px', 'foodymat-core' ),
				'default' => '1',
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
			'tablet',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Tablets: > 768px', 'foodymat-core' ),
				'default' => '1',
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
				'default' => '1',
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
			'sm_mobile',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Phones: > 425px', 'foodymat-core' ),
				'default' => '1',
				'options' => array(
					'1' => esc_html__( '1', 'foodymat-core' ),
					'2' => esc_html__( '2', 'foodymat-core' ),
					'3' => esc_html__( '3',  'foodymat-core' ),
					'4' => esc_html__( '4',  'foodymat-core' ),
					'5' => esc_html__( '5',  'foodymat-core' ),
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
					'layout' => ['layout-1', 'layout-2', 'layout-3', 'layout-4'],
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
				'default'     => 'yes',
				'description' => esc_html__( 'Navigation Arrow. Default: On', 'foodymat-core' ),
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
				'default' => array(
					'size' => 1,
				),
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

		if ( 'layout-4' == $data['layout'] ) {
			$swiper_data['effect'] = "cards";
		}

		$data['swiper_data'] = json_encode( $swiper_data );

		//$template = 'view-1';

		if ( 'layout-1' == $data['layout'] ) {
			$template = 'view-1';
		} elseif ( 'layout-2' == $data['layout'] ) {
			$template = 'view-2';
		} elseif ( 'layout-3' == $data['layout'] ) {
			$template = 'view-3';
		} elseif ( 'layout-4' == $data['layout'] ) {
			$template = 'view-4';
		} elseif ( 'layout-5' == $data['layout'] ) {
			$template = 'view-5';
		} elseif ( 'layout-6' == $data['layout'] ) {
			$template = 'view-6';
		} elseif ( 'layout-7' == $data['layout'] ) {
			$template = 'view-grid-1';
		} elseif ( 'layout-8' == $data['layout'] ) {
			$template = 'view-grid-2';
		} elseif ( 'layout-9' == $data['layout'] ) {
			$template = 'view-grid-3';
		}

		Fns::get_template( "elementor/testimonial/$template", $data );
	}

}