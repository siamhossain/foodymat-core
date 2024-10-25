<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.2
 */

namespace RT\FoodymatCore\Elementor\Widgets;

use Elementor\Controls_Manager;
use RT\FoodymatCore\Helper\Fns;
use RT\FoodymatCore\Abstracts\ElementorBase;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Post extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name      = esc_html__( 'RT Post Grid', 'foodymat-core' );
		$this->rt_base      = 'rt-post';
		$this->rt_translate = [
			'cols' => [
				'3'  => __( '4 Columns', 'foodymat-core' ),
				'4'  => __( '3 Columns', 'foodymat-core' ),
				'6'  => __( '2 Columns', 'foodymat-core' ),
				'12' => __( '1 Columns', 'foodymat-core' ),
			],
		];
		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		// widget title
		$this->start_controls_section(
			'rt_post_grid',
			[
				'label' => esc_html__( 'Post Grid', 'foodymat-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'layout',
			[
				'label'   => esc_html__( 'Layout', 'foodymat-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => __( 'Post Grid 01', 'foodymat-core' ),
					'grid-2' => __( 'Post Grid 02', 'foodymat-core' ),
					'grid-3' => __( 'Post Grid 03', 'foodymat-core' ),
					'grid-4' => __( 'Post Grid 04', 'foodymat-core' ),
					'grid-5' => __( 'Post Grid 05', 'foodymat-core' ),
					'list-2' => __( 'Post List 01', 'foodymat-core' ),
				],

			]
		);

		$this->add_control(
			'gridcolumn-popover-toggle',
			[
				'label'        => __( 'Grid Column', 'foodymat-core' ),
				'type'         => \Elementor\Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'foodymat-core' ),
				'label_on'     => __( 'Custom', 'foodymat-core' ),
				'return_value' => 'yes',
			]
		);

		$this->start_popover();

		$this->add_control(
			'gird_column_desktop',
			[
				'label'   => esc_html__( 'Grid Column for Desktop', 'foodymat-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '4',
				'options' => $this->rt_translate['cols'],

			]
		);

		$this->add_control(
			'gird_column_tab',
			[
				'label'   => esc_html__( 'Grid Column for Tab', 'foodymat-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '6',
				'options' => $this->rt_translate['cols'],

			]
		);

		$this->add_control(
			'gird_column_mobile',
			[
				'label'   => esc_html__( 'Grid Column for Mobile', 'foodymat-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '12',
				'options' => $this->rt_translate['cols'],

			]
		);

		$this->end_popover();

		$this->add_control(
			'title_tag',
			[
				'label'   => esc_html__( 'Title Tag', 'foodymat-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h2',
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
			'title_count',
			[
				'label'       => __( 'Title Count', 'foodymat-core' ),
				'type'        => \Elementor\Controls_Manager::NUMBER,
				'default' => '15',
			]
		);

		$this->add_control(
			'post_limit',
			[
				'label'       => __( 'Post Limit', 'foodymat-core' ),
				'type'        => \Elementor\Controls_Manager::NUMBER,
				'description' => __( 'Enter number of post to show.', 'foodymat-core' ),
				'default'     => '3',
			]
		);

		$this->add_control(
			'post_source',
			[
				'label'       => __( 'Post Source', 'foodymat-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'options'     => [
					'most_recent' => __( 'From all recent post', 'foodymat-core' ),
					'by_category' => __( 'By Category', 'foodymat-core' ),
					'by_tags'     => __( 'By Tags', 'foodymat-core' ),
					'by_id'       => __( 'By Post ID', 'foodymat-core' ),
				],
				'default'     => [ 'most_recent' ],
				'description' => __( 'Select posts source that you like to show.', 'foodymat-core' ),
			]
		);

		$this->add_control(
			'categories',
			[
				'label'       => __( 'Choose Categories', 'foodymat-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'multiple'    => true,
				'options'     => rt_category_list(),
				'label_block' => true,
				'condition'   => [
					'post_source' => 'by_category',
				],
				'description' => __( 'Select post category\'s.', 'foodymat-core' ),
			]
		);

		$this->add_control(
			'tags',
			[
				'label'       => __( 'Choose Tags', 'foodymat-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'multiple'    => true,
				'options'     => rt_tag_list(),
				'label_block' => true,
				'condition'   => [
					'post_source' => 'by_tags',
				],
				'description' => __( 'Select post tag\'s.', 'foodymat-core' ),
			]
		);

		$this->add_control(
			'post_id',
			[
				'label'       => __( 'Enter post IDs', 'foodymat-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => __( 'Enter the post IDs separated by comma', 'foodymat-core' ),
				'label_block' => 'true',
				'condition'   => [
					'post_source' => 'by_id',
				],
			]
		);

		$this->add_control(
			'offset',
			[
				'label'       => __( 'Post offset', 'foodymat-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Post offset', 'foodymat-core' ),
				'description' => __( 'Number of post to displace or pass over. The offset parameter is ignored when post limit => -1 (show all posts) is used.', 'foodymat-core' ),
			]
		);

		$this->add_control(
			'exclude',
			[
				'label'       => __( 'Exclude posts', 'foodymat-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => 'true',
				'description' => __( 'Enter the post IDs separated by comma for exclude', 'foodymat-core' ),
			]
		);

		$this->add_control(
			'orderby',
			[
				'label'   => __( 'Order by', 'foodymat-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'recent' 		=> __('Recent Post', 'foodymat-core'),
					'popular' 		=> __('Popular Post', 'foodymat-core'),
					'date'           => __( 'Date', 'foodymat-core' ),
					'ID'             => __( 'Order by post ID', 'foodymat-core' ),
					'author'         => __( 'Author', 'foodymat-core' ),
					'title'          => __( 'Title', 'foodymat-core' ),
					'modified'       => __( 'Last modified date', 'foodymat-core' ),
					'parent'         => __( 'Post parent ID', 'foodymat-core' ),
					'comment_count'  => __( 'Number of comments', 'foodymat-core' ),
					'menu_order'     => __( 'Menu order', 'foodymat-core' ),
					'rand'           => __( 'Random order', 'foodymat-core' ),
				],
				'default'     => [ 'recent' ],
			]
		);

		$this->add_control(
			'order',
			[
				'label'   => __( 'Sort order', 'foodymat-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'ASC'  => __( 'ASC', 'foodymat-core' ),
					'DESC' => __( 'DESC', 'foodymat-core' ),
				],
				'default'     => [ 'ASC' ],
				'condition' => [
					'orderby!' => ['popular'],
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
			]
		);

		$this->end_controls_section();


		// Thumbnail style
		//========================================================
		$this->start_controls_section(
			'thumbnail_style',
			[
				'label' => __( 'Thumbnail Style', 'foodymat-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'thumbnail_visibility',
			[
				'label'   => __( 'Thumbnail Visibility', 'foodymat-core' ),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'visible' => [
						'title' => __( 'Visible', 'foodymat-core' ),
						'icon'  => 'eicon-check',
					],
					'hidden'  => [
						'title' => __( 'Hidden', 'foodymat-core' ),
						'icon'  => 'eicon-editor-close',
					],
				],
				'toggle'  => false,
				'default' => 'visible',
			]
		);

		$this->add_control(
			'project_thumbnail_size',
			[
				'label'     => esc_html__( 'Image Size', 'foodymat-core' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => rt_get_all_image_sizes(),
				'condition' => [
					'thumbnail_visibility' => 'visible',
				],
			]
		);

		$this->add_responsive_control(
			'image_width',
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
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .blog-list-2.rt-el-post-wrapper .post-thumbnail-wrap' => 'max-width: {{SIZE}}{{UNIT}};',
				],
                'condition' => [
				'layout' => 'list-2',
			],
			]
		);

		$this->add_responsive_control(
			'image_height',
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
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .blog-list-2.rt-el-post-wrapper .post-thumbnail-wrap' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .blog-list-2.rt-el-post-wrapper .post-thumbnail-wrap img' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'layout' => 'list-2',
				],
			]
		);

		$this->add_responsive_control(
			'thumb_box_radius',
			[
				'label'      => __( 'Thumbnail Radius', 'foodymat-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .article-inner-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .post-thumbnail-wrap .post-thumbnail' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .post-thumbnail-wrap .post-thumbnail img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'thumbnail_visibility' => 'visible',
				],
			]
		);

		$this->end_controls_section();


		// Title Settings
		//=====================================================================
		$this->start_controls_section(
			'title_style',
			[
				'label' => __( 'Title Style', 'foodymat-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .foodymat-post-card .entry-title',
			]
		);

		$this->add_control(
			'title_spacing',
			[
				'label'              => __( 'Title Spacing', 'foodymat-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .foodymat-post-card .entry-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'allowed_dimensions' => 'vertical',
				'default'            => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
					'isLinked' => false,
				],
			]
		);

		$this->start_controls_tabs(
			'title_style_tabs'
		);

		$this->start_controls_tab(
			'title_normal_tab',
			[
				'label' => __( 'Normal', 'foodymat-core' ),
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Title Color', 'foodymat-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodymat-post-card .entry-title a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'title_hover_tab',
			[
				'label' => __( 'Hover', 'foodymat-core' ),
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label'     => __( 'Title Hover Color', 'foodymat-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .foodymat-post-card .entry-title a:hover' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();


		// Content Settings
		//=====================================================================

		$this->start_controls_section(
			'content_style',
			[
				'label' => __( 'Excerpt Style', 'foodymat-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_visibility',
			[
				'label'   => __( 'Excerpt Visibility', 'foodymat-core' ),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'visible' => [
						'title' => __( 'Visible', 'foodymat-core' ),
						'icon'  => 'eicon-check',
					],
					'hidden'  => [
						'title' => __( 'Hidden', 'foodymat-core' ),
						'icon'  => 'eicon-editor-close',
					],
				],
				'toggle'  => false,
				'default' => 'hidden',
			]
		);


		$this->add_control(
			'content_limit',
			[
				'label'     => __( 'Excerpt Limit', 'foodymat-core' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'default'   => '20',
				'condition' => [
					'content_visibility' => 'visible',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'content_typography',
				'selector'  => '{{WRAPPER}} .entry-content',
				'condition' => [
					'content_visibility' => 'visible',
				],
			]
		);

		$this->add_control(
			'content_spacing',
			[
				'label'              => __( 'Excerpt Spacing', 'foodymat-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .entry-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'allowed_dimensions' => 'vertical',
				'default'            => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
					'isLinked' => false,
				],
				'condition'          => [
					'content_visibility' => 'visible',
				],
			]
		);

		$this->add_control(
			'content_color',
			[
				'label'     => __( 'Content Color', 'foodymat-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .entry-content' => 'color: {{VALUE}}',
				],
				'condition' => [
					'content_visibility' => 'visible',
				],
			]
		);

		$this->end_controls_section();

		// Meta Information Settings

		$this->start_controls_section(
			'meta_info_style',
			[
				'label' => __( 'Meta Info Style', 'foodymat-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'label' => __( 'Meta Typo', 'foodymat-core' ),
				'name'     => 'post_meta_typography',
				'selector' => '{{WRAPPER}} .rt-post-meta',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'label' => __( 'Meta Icon Typo', 'foodymat-core' ),
				'name'     => 'post_meta_icon_typo',
				'selector' => '{{WRAPPER}} .rt-post-meta ul li i',
			]
		);

		$this->add_control(
			'meta_spacing',
			[
				'label'              => __( 'Meta Spacing', 'foodymat-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-post-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'allowed_dimensions' => 'vertical',
				'default'            => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
					'isLinked' => false,
				],
			]
		);

		$this->add_responsive_control(
			'meta_list_spacing',
			[
				'label'      => __( 'Meta List Spacing', 'foodymat-core' ),
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
					'{{WRAPPER}} .rt-post-meta ul' => 'column-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs(
			'post_meta_style_tabs'
		);

		$this->start_controls_tab(
			'post_meta_normal_tab',
			[
				'label' => __( 'Normal', 'foodymat-core' ),
			]
		);


		$this->add_control(
			'post_meta_color',
			[
				'label'     => __( 'Meta Color', 'foodymat-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-post-meta' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-post-meta a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'post_meta_hover_tab',
			[
				'label' => __( 'Hover', 'foodymat-core' ),
			]
		);

		$this->add_control(
			'post_meta_color_hover',
			[
				'label'     => __( 'Meta Color', 'foodymat-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-post-meta a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'post_meta_icon_color',
			[
				'label'     => __( 'Icon Color', 'foodymat-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-post-meta ul li i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'hr1',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'author_visibility',
			[
				'label'        => __( 'Author Visibility', 'foodymat-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'foodymat-core' ),
				'label_off'    => __( 'Hide', 'foodymat-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'cat_visibility',
			[
				'label'        => __( 'Category Visibility', 'foodymat-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'foodymat-core' ),
				'label_off'    => __( 'Hide', 'foodymat-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'date_visibility',
			[
				'label'        => __( 'Date Visibility', 'foodymat-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'foodymat-core' ),
				'label_off'    => __( 'Hide', 'foodymat-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'comment_visibility',
			[
				'label'        => __( 'Comment Visibility', 'foodymat-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'foodymat-core' ),
				'label_off'    => __( 'Hide', 'foodymat-core' ),
				'return_value' => 'yes',
				'default'      => false,
			]
		);

		$this->add_control(
			'reading_visibility',
			[
				'label'        => __( 'Reading Visibility', 'foodymat-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'foodymat-core' ),
				'label_off'    => __( 'Hide', 'foodymat-core' ),
				'return_value' => 'yes',
				'default'      => false,
			]
		);

		$this->add_control(
			'views_visibility',
			[
				'label'        => __( 'Views Visibility', 'foodymat-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'foodymat-core' ),
				'label_off'    => __( 'Hide', 'foodymat-core' ),
				'return_value' => 'yes',
				'default'      => false,
			]
		);
		$this->end_controls_section();

		// Category Settings
		$this->start_controls_section(
			'category_settings',
			[
				'label' => esc_html__( 'Category Settings', 'foodymat-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition'     => [
					'layout!' => ['grid-2'],
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'cat_typo',
				'selector' => '{{WRAPPER}} .separate-meta a',
			]
		);

		$this->add_responsive_control(
			'cat_radius',
			[
				'label'      => __( 'Border Radius', 'foodymat-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .separate-meta a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'cat_padding',
			[
				'label'      => __( 'Padding', 'foodymat-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .separate-meta a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'cat_spacing',
			[
				'label'      => __( 'Spacing', 'foodymat-core' ),
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
					'{{WRAPPER}} .separate-meta a' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs(
			'cat_style_tabs'
		);

		$this->start_controls_tab(
			'cat_style_normal_tab',
			[
				'label' => __( 'Normal', 'foodymat-core' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'cat_shadow',
				'label'    => __( 'Shadow', 'foodymat-core' ),
				'selector' => '{{WRAPPER}} .separate-meta a',
			]
		);


		$this->add_control(
			'cat_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .separate-meta a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'           => 'cat_bg',
				'label'          => __( 'Background', 'foodymat-core' ),
				'fields_options' => [
					'background' => [
						'label' => esc_html__( 'Background', 'foodymat-core' ),
					],
				],
				'types'          => [ 'classic', 'gradient' ],
				'selector'       => '{{WRAPPER}} .separate-meta a',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'cat_border',
				'selector' => '{{WRAPPER}} .separate-meta a',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'cat_style_hover_tab',
			[
				'label' => __( 'Hover', 'foodymat-core' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'cat_shadow_hover',
				'label'    => __( 'Shadow', 'foodymat-core' ),
				'selector' => '{{WRAPPER}} .separate-meta a:hover',
			]
		);

		$this->add_control(
			'cat_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .separate-meta a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'           => 'cat_bg_hover',
				'label'          => __( 'Background', 'foodymat-core' ),
				'fields_options' => [
					'background' => [
						'label' => esc_html__( 'Box Background - Hover', 'foodymat-core' ),
					],
				],
				'types'          => [ 'classic', 'gradient' ],
				'selector'       => '{{WRAPPER}} .separate-meta a:hover',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'cat_hover_border',
				'selector' => '{{WRAPPER}} .separate-meta a:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		// Read More Style
		$this->start_controls_section(
			'readmore_style',
			[
				'label' => __( 'Read More Style', 'foodymat-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'readmore_visibility',
			[
				'label'   => __( 'Read More Visibility', 'foodymat-core' ),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'visible' => [
						'title' => __( 'Visible', 'foodymat-core' ),
						'icon'  => 'eicon-check',
					],
					'hidden'  => [
						'title' => __( 'Hidden', 'foodymat-core' ),
						'icon'  => 'eicon-editor-close',
					],
				],
				'toggle'  => false,
				'default' => 'hidden',
			]
		);

		$this->add_control(
			'readmore_text',
			[
				'label'       => __( 'Button Text', 'foodymat-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'See Details', 'foodymat-core' ),
				'placeholder' => __( 'Type your title here', 'foodymat-core' ),
				'condition'   => [
					'readmore_visibility' => [ 'visible' ],
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'readmore_typography',
				'selector'  => '{{WRAPPER}} .rt-button .btn',
				'condition' => [
					'readmore_visibility' => [ 'visible' ],
				],
			]
		);

		$this->add_control(
			'readmore_spacing',
			[
				'label'              => __( 'Button Spacing', 'foodymat-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'allowed_dimensions' => 'vertical',
				'default'            => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
					'isLinked' => false,
				],
				'selectors'          => [
					'{{WRAPPER}} .rt-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'          => [
					'readmore_visibility' => [ 'visible' ],
				],
			]
		);

		$this->add_control(
			'readmore_padding',
			[
				'label'      => __( 'Button Padding', 'foodymat-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-button .btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'readmore_visibility' => [ 'visible' ],
				],
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label'      => __( 'Radius', 'foodymat-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-button .btn' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'readmore_visibility' => [ 'visible' ],
				],
			]
		);


		//Button style Tabs
		$this->start_controls_tabs(
			'readmore_style_tabs', [
				'condition' => [
					'readmore_visibility' => [ 'visible' ],
				],
			]
		);

		$this->start_controls_tab(
			'readmore_style_normal_tab',
			[
				'label' => __( 'Normal', 'foodymat-core' ),
			]
		);

		$this->add_control(
			'readmore_color',
			[
				'label'     => __( 'Color', 'foodymat-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-button .btn' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-button .btn i' => 'color: {{VALUE}}',
				],
			]
		);


		$this->add_control(
			'readmore_bg',
			[
				'label'     => __( 'Background Color', 'foodymat-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-button .btn:before' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'selector' => '{{WRAPPER}} .rt-button .btn',
			]
		);


		$this->end_controls_tab();

		$this->start_controls_tab(
			'readmore_style_hover_tab',
			[
				'label' => __( 'Hover', 'foodymat-core' ),
			]
		);

		$this->add_control(
			'readmore_color_hover',
			[
				'label'     => __( 'Color', 'foodymat-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-button .btn:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-button .btn:hover i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'readmore_bg_hover',
			[
				'label'     => __( 'Background Color', 'foodymat-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-button .btn:after' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'hover_border',
				'selector' => '{{WRAPPER}} .rt-button .btn:hover',
			]
		);


		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		//Box setting
		$this->start_controls_section(
			'box_style',
			[
				'label' => esc_html__( 'Box Style', 'foodymat-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'box_padding',
			[
				'label'              => __( 'Item Wrap Padding', 'foodymat-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .article-inner-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'box_content_padding',
			[
				'label'              => __( 'Content Padding', 'foodymat-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .article-inner-wrapper .entry-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'box_radius',
			[
				'label'              => __( 'Radius', 'foodymat-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .article-inner-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		//Box Tabs
		$this->start_controls_tabs(
			'box_style_tabs', [
			]
		);

		$this->start_controls_tab(
			'box_style_normal_tab',
			[
				'label' => __( 'Normal', 'foodymat-core' ),
			]
		);

		$this->add_control(
			'box_bag',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .article-inner-wrapper' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'selector' => '{{WRAPPER}} .article-inner-wrapper',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_shadow',
				'label'    => __( 'Box Shadow', 'foodymat-core' ),
				'selector' => '{{WRAPPER}} .article-inner-wrapper',
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'box_style_hover_tab',
			[
				'label' => __( 'Hover', 'foodymat-core' ),
			]
		);

		$this->add_control(
			'box_hover_bag',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .foodymat-post-card:hover .article-inner-wrapper' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'box_hover_border',
				'selector' => '{{WRAPPER}} .foodymat-post-card:hover .article-inner-wrapper',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_hover_shadow',
				'label'    => __( 'Box Shadow', 'foodymat-core' ),
				'selector' => '{{WRAPPER}} .foodymat-post-card:hover .article-inner-wrapper',
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
		$data = $this->get_settings();

		$template = 'view-1';
		if ( 'grid-2' == $data['layout'] ) {
			$template = 'view-2';
		} elseif ( 'grid-3' == $data['layout'] ) {
			$template = 'view-3';
		} elseif ( 'grid-4' == $data['layout'] ) {
			$template = 'view-4';
		} elseif ( 'grid-5' == $data['layout'] ) {
			$template = 'view-5';
		} elseif ( 'list-2' == $data['layout'] ) {
			$template = 'view-6';
		}

		$args = [
			'post_type'           => 'post',
			'ignore_sticky_posts' => 1,
			'posts_per_page'      => $data['post_limit'],
			'post_status'         => 'publish',
		];

		if ( ! empty ( $data['orderby'] ) ) {
			$args['orderby'] = $data['orderby'];
		}
		if ( ! empty( $data['order'] ) ) {
			$args['order'] = $data['order'];
		}

		if( ! empty ( $data['orderby'] ) && $data['orderby'] == 'popular' ){
			$args['orderby'] = 'meta_value_num';
			$args['order'] = 'DESC';
			$args['meta_key'] = 'rt_post_views';
		}

		if ( $data['post_source'] == 'by_category' && $data['categories'] ) :
			$args = wp_parse_args(
				[
					'cat' => $data['categories'],
				]
				, $args );
		endif;

		if ( $data['post_source'] == 'by_tags' && $data['tags'] ) :
			$args = wp_parse_args(
				[
					'tag_slug__in' => $data['tags'],
				]
				, $args );
		endif;

		if ( $data['post_source'] == 'by_id' && $data['post_id'] ) :
			$post_ids         = explode( ',', $data['post_id'] );
			$args['post__in'] = $post_ids;
		endif;

		if ( $data['exclude'] ) :
			$excluded_ids         = explode( ',', $data['exclude'] );
			$args['post__not_in'] = $excluded_ids;
		endif;


		if ( $data['offset'] ) {
			$args['offset'] = $data['offset'];
		}

		$query               = new \WP_Query( $args );
		$gird_column_desktop = $data['gird_column_desktop'] ?? '4';
		$gird_column_tab     = $data['gird_column_tab'] ?? '6';
		$gird_column_mobile  = $data['gird_column_mobile'] ?? '6';

		$col_class = "col-lg-{$gird_column_desktop} col-md-{$gird_column_tab} col-sm-{$gird_column_mobile}";
		?>
        <div class="rt-el-post-wrapper blog-<?php echo esc_attr( $data['layout'] ) ?>">
			<?php if ( $query->have_posts() ) : ?>
                <div class="row <?php echo esc_attr( $data['item_space'] );?> justify-content-center">
					<?php $ade = $data['delay']; $adu = $data['duration'];
                    while ( $query->have_posts() ) : $query->the_post();
						echo '<article class="foodymat-post-card ' . esc_attr( $col_class ) . ' ' . esc_attr( $data['animation'] ) . ' ' . esc_attr( $data['animation_effect'] ) . '" data-wow-delay= ' . esc_attr( $ade ) . "ms" .' data-wow-duration=' . esc_attr( $adu ) . "ms" .'>';
						Fns::get_template( "elementor/post/$template", $data );
						echo '</article>';
	                    $ade = $ade + 200; $adu = $adu + 0; endwhile; ?>
                </div>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
        </div>
		<?php
	}
}