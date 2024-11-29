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

class AjaxSearch extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'RT Ajax Search', 'foodymat-core' );
		$this->rt_base = 'rt-ajax-search';
		parent::__construct( $data, $args );
	}

	public function get_script_depends() {
		return [ 'rt-nice-select' ];
	}

	protected function register_controls() {

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'searches_word', array(
				'type' => \Elementor\Controls_Manager::TEXT,
				'label' => esc_html__( 'Search Word', 'docfi-core' ),
				'default' => esc_html__( 'WordPress' , 'docfi-core' ),
				'label_block' => true,
			)
		);

		$this->start_controls_section(
			'sec_general',
			[
				'label' => esc_html__( 'General', 'foodymat-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'layout',
			[
				'label'       => esc_html__( 'Search Layout', 'foodymat-core' ),
				'type'        => Controls_Manager::SELECT2,
				'options'   => [
					'layout-1' => __( 'Blog Search', 'foodymat-core' ),
					'layout-2' => __( 'Product Search', 'foodymat-core' ),
				],
				'default'     => 'layout-1',
			]
		);

		$this->add_control(
			'placeholder',
			[
				'type'        => Controls_Manager::TEXT,
				'label'       => esc_html__( 'Placeholder Text', 'foodymat-core' ),
				'default'     => __( 'Describe what you want or hit a  tag below . . ', 'foodymat-core' ),
				'condition' => [
					'layout' => ['layout-1'],
				],
			]
		);
		
		$this->add_control(
			'product_placeholder',
			[
				'type'        => Controls_Manager::TEXT,
				'label'       => esc_html__( 'Placeholder Text', 'foodymat-core' ),
				'default'     => __( 'Type Your Products ...', 'foodymat-core' ),
				'condition' => [
					'layout' => ['layout-2'],
				],
			]
		);

		$this->add_control(
			'category_display',
			[
				'label'        => __( 'Category Display', 'foodymat-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'foodymat-core' ),
				'label_off'    => __( 'Off', 'foodymat-core' ),
				'default'       => 'yes',
			]
		);

		$this->add_control(
			'btn_display',
			[
				'label'        => __( 'Button Text Display', 'foodymat-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'foodymat-core' ),
				'label_off'    => __( 'Off', 'foodymat-core' ),
				'default'       => 'yes',
				'condition' => [
					['layout-1', 'layout-2'],
				],
			]
		);

		$this->add_control(
			'button_text',
			[
				'type'        => Controls_Manager::TEXT,
				'label'       => esc_html__( 'Button Text', 'foodymat-core' ),
				'default'     => __( 'Generate', 'foodymat-core' ),
				'condition' => [
					'layout' => ['layout-1', 'layout-2'],
					'btn_display' => ['yes'],
				],
			]
		);

		$this->add_control(
			'popular_text',
			[
				'type'        => Controls_Manager::TEXT,
				'label'       => esc_html__( 'Popular Search', 'foodymat-core' ),
				'default'     => __( 'Popular Search:', 'foodymat-core' ),
				'condition' => [
					'layout' => ['layout-1'],
				],
			]
		);

		$this->add_control(
			'word_repeat',
			[
				'label'   => esc_html__( 'Words Repeater', 'foodymat-core' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ searches_word }}}',
				'default'     => [
					['searches_word' => 'Creative', ],
					['searches_word' => 'Business', ],
					['searches_word' => 'Agency', ],
					['searches_word' => 'Portfolio', ],
				],
				'condition' => [
					'layout' => ['layout-1'],
				],
			]
		);

		$this->end_controls_section();

		// Input Settings
		$this->start_controls_section(
			'input_settings',
			[
				'label' => esc_html__( 'Input Settings', 'foodymat-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'input_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-search-box-form .search-box-input' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-advanced-search .product-search-form' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'input_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-search-box-form' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rt-search-box-wrap form' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'input_height',
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
					'{{WRAPPER}} .rt-search-box-form .search-box-input' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} ul.rt-action-list .rt-btn' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-advanced-search .product-search-form' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'input_padding',
			[
				'label'              => __( 'Padding', 'foodymat-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-search-box-form' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
					'{{WRAPPER}} .rt-search-box-wrap form' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'input_radius',
			[
				'label'              => __( 'Radius', 'foodymat-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-search-box-form' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
					'{{WRAPPER}} .rt-search-box-wrap form' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'input_border',
				'selector' => '{{WRAPPER}} .rt-search-box-form',
				'condition' => [
					'layout' => ['layout-1'],
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'input_product_border',
				'selector' => '{{WRAPPER}} .rt-search-box-wrap form',
				'condition' => [
					'layout' => ['layout-2'],
				],
			]
		);

		$this->end_controls_section();

		// Button Settings
		$this->start_controls_section(
			'button_settings',
			[
				'label' => esc_html__( 'Button Settings', 'foodymat-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button_typo',
				'label'    => esc_html__( 'Typo', 'foodymat-core' ),
				'selector' => '{{WRAPPER}} .rt-search-box-form .rt-search-box-btn, {{WRAPPER}} .rt-advanced-search .input-group-append button',
			]
		);

		$this->add_responsive_control(
			'button_radius',
			[
				'label'              => __( 'Radius', 'foodymat-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-search-box-form .rt-search-box-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
					'{{WRAPPER}} .rt-advanced-search .input-group-append button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' => 'before',
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
					'{{WRAPPER}} .rt-search-box-form .rt-search-box-btn' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-advanced-search .input-group-append button' => 'width: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .rt-search-box-form .rt-search-box-btn' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-advanced-search .input-group-append button' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		//Button style Tabs
		$this->start_controls_tabs(
			'button_style_tabs', [
			]
		);

		$this->start_controls_tab(
			'button_style_normal_tab',
			[
				'label' => __( 'Normal', 'foodymat-core' ),
			]
		);
		$this->add_control(
			'button_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-search-box-form .rt-search-box-btn' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-advanced-search .input-group-append button' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'button_bg_color',
				'label' => __('Background', 'foodymat-core'),
				'types' => ['classic', 'gradient'],
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Background', 'foodymat-core' ),
					],
				],
				'selector' => '{{WRAPPER}} .rt-search-box-form .rt-search-box-btn, {{WRAPPER}} .rt-advanced-search .input-group-append button',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'selector' => '{{WRAPPER}} .rt-search-box-form .rt-search-box-btn, {{WRAPPER}} .rt-advanced-search .input-group-append button',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'label' => __('Box Shadow', 'foodymat-core'),
				'selector' => '{{WRAPPER}} .rt-search-box-form .rt-search-box-btn, {{WRAPPER}} .rt-advanced-search .input-group-append button',
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
			'button_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-search-box-form .rt-search-box-btn:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-advanced-search .input-group-append button:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'button_bg_hover_color',
				'label' => __('Background', 'foodymat-core'),
				'types' => ['classic', 'gradient'],
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Background', 'foodymat-core' ),
					],
				],
				'selector' => '{{WRAPPER}} .rt-search-box-form .rt-search-box-btn:hover, {{WRAPPER}} .rt-advanced-search .input-group-append button:hover',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'button_hover_border',
				'selector' => '{{WRAPPER}} .rt-search-box-form .rt-search-box-btn:hover, {{WRAPPER}} .rt-advanced-search .input-group-append button:hover',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_hover_box_shadow',
				'label' => __('Box Shadow', 'foodymat-core'),
				'selector' => '{{WRAPPER}} .rt-search-box-form .rt-search-box-btn:hover, {{WRAPPER}} .rt-advanced-search .input-group-append button:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// Input Settings
		$this->start_controls_section(
			'other_settings',
			[
				'label' => esc_html__( 'Other Settings', 'foodymat-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'cat_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Category Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-search-box-form .category-selector .nice-select span' => 'color: {{VALUE}}',
					'{{WRAPPER}} ul.rt-action-list .rt-btn' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'cat_list_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Category List Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-search-box-form .category-selector .nice-select .list li' => 'color: {{VALUE}}',
					'{{WRAPPER}} ul.rt-action-list .rt-drop-menu li' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'cat_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Category Background Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-search-box-form .category-selector .nice-select .list' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} ul.rt-action-list .rt-drop-menu' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'Popular_heading',
			[
				'label'     => __( 'Popular search item use for layout 1', 'foodymat-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'pop_label_typo',
				'label'    => esc_html__( 'Label Typo', 'foodymat-core' ),
				'selector' => '{{WRAPPER}} .rt-search-text .popular-label',
			]
		);

		$this->add_control(
			'pop_search_label_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Popular Label Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-search-text .popular-label' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'pop_item_typo',
				'label'    => esc_html__( 'Popular Item Typo', 'foodymat-core' ),
				'selector' => '{{WRAPPER}} .rt-search-text .rt-search-key li a',
			]
		);

		$this->add_control(
			'pop_search_item_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Popular Search Item Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-search-text .rt-search-key li a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'pop_search_item_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Popular Search Item BG Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-search-text .rt-search-key li a' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'pop_search_item_padding',
			[
				'label'              => __( 'Padding', 'foodymat-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-search-text .rt-search-key li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$data     = $this->get_settings();

		switch ( $data['layout'] ) {
			case 'layout-2':
			$template = 'view-2';
			break;
			default:
			$template = 'view-1';
			break;
		}

		Fns::get_template( "elementor/ajax-search/$template", $data );
	}

}