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

class Rating extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'RT Rating', 'foodymat-core' );
		$this->rt_base = 'rt-rating';
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
			'number',
			[
				'label'       => esc_html__( 'Count Number', 'foodymat-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '4.45/5',
			]
		);

		$this->add_control(
			'rating',
			[
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
			'label',
			[
				'label'       => esc_html__( 'Title', 'foodymat-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => __( 'Ratings', 'foodymat-core' ),
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
					'{{WRAPPER}} .rt-rating-layout' => 'text-align: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		// Rating setting
		$this->start_controls_section(
			'rating_style',
			[
				'label' => esc_html__( 'Rating Style', 'foodymat-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'number_style_heading',
			[
				'label'     => __( 'Rating Number Style', 'foodymat-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'number_typo',
				'label'    => esc_html__( 'Number Typo', 'foodymat-core' ),
				'selector' => '{{WRAPPER}} .rt-rating-layout .rating-number',
			]
		);

		$this->add_control(
			'number_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Number Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-rating-layout .rating-number' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'number_space',
			[
				'label'      => __( 'Number Space', 'foodymat-core' ),
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
					'{{WRAPPER}} .rt-rating-layout .rating-number' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'star_style_heading',
			[
				'label'     => __( 'Rating Star Style', 'foodymat-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'rating_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Rating Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-rating-layout .item-rating .deactive' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'rating_active_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Rating Active Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-rating-layout .item-rating .active' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rating_size',
			[
				'label'     => __( 'Font Size', 'foodymat-core' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 50,
				'step'      => 1,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rt-rating-layout .item-rating' => 'font-size: {{VALUE}}px',
				],
			]
		);

		$this->add_control(
			'rating_space',
			[
				'label'      => __( 'Rating Space', 'foodymat-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-rating-layout .item-rating' => 'column-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'rating_label_heading',
			[
				'label'     => __( 'Rating Label Style', 'foodymat-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'label_typo',
				'label'    => esc_html__( 'Label Typo', 'foodymat-core' ),
				'selector' => '{{WRAPPER}} .rt-rating-layout .rating-label',
			]
		);

		$this->add_control(
			'label_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Label Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-rating-layout .rating-label' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rating_label_space',
			[
				'label'      => __( 'Label Space', 'foodymat-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-rating-layout .rating-wrap' => 'column-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$data  = $this->get_settings();
		$template = 'view-1';
		Fns::get_template( "elementor/rating/$template", $data );
	}

}