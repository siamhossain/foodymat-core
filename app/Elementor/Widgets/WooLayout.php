<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\FoodymatCore\Elementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use RT\FoodymatCore\Abstracts\ElementorBase;
use RT\FoodymatCore\Helper\Fns;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



class WooLayout extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'RT Woo Layout', 'foodymat-core' );
		$this->rt_base = 'rt-woo-layout';
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
		
		// find the variations
		$lists = wp_list_pluck(wc_get_attribute_taxonomies(), 'attribute_label', 'attribute_name');
		
		$list_dropdown = array( '0' => esc_html__( 'All Variation', 'foodymat-core' ) );
		
		foreach ( $lists as $key=>$value ) {
			$list_dropdown[$key] = $value;
		}
		
		// find the category of products
		
		$terms  = get_terms( array( 'taxonomy' => 'product_cat', 'fields' => 'id=>name' ) );
		$category_dropdown = [ '0' => __( 'Please Selecet category', 'foodymat-core' ) ];
		$options = [];
		
		$products = get_posts([
			'post_type' => 'product',
			'numberposts' => -1,
		]);
		
		foreach ( $terms as $id => $name ) {
			$category_dropdown[$id] = $name;
		}
		
		foreach ( $products as $product ) {
			$options[ $product->ID ] = $product->post_title;
		}
		
		$this->start_controls_section(
			'sec_general',
			[
				'label'   => esc_html__( 'General', 'foodymat-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			],
		);
		
		$this->add_control(
			'style',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Style', 'foodymat-core' ),
				'options' => array(
					'style1' => esc_html__( 'Style 1', 'foodymat-core' ),
					'style2' => esc_html__( 'Style 2', 'foodymat-core' ),
					'style3' => esc_html__( 'Style 3', 'foodymat-core' ),
					'style4' => esc_html__( 'Style 4', 'foodymat-core' ),
					'style5' => esc_html__( 'Slider 1', 'foodymat-core' ),
					'style6' => esc_html__( 'Slider 2', 'foodymat-core' ),
				),
				'default' => 'style1',
			],
		);
		
		$this->add_control(
			'title_showhide',
			[
				'type'    => Controls_Manager::SWITCHER,
				'id'      => 'title_showhide',
				'label'   => esc_html__( 'Title', 'foodymat-core' ),
				'label_on'    => esc_html__( 'Show', 'foodymat-core' ),
				'label_off'   => esc_html__( 'Hide', 'foodymat-core' ),
				'default'     => 'yes',
			],
		);
		
		$this->add_control(
			'title_count',
			[
				'type'    => Controls_Manager::NUMBER,
				
				'label'   => esc_html__( 'Title Word count', 'foodymat-core' ),
				'default' => 5,
				'description' => esc_html__( 'Maximum number of words', 'foodymat-core' ),
			],
		);
		
		$this->add_control(
			'variation_cat',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Variations', 'foodymat-core' ),
				'options' => $list_dropdown,
				'default' => '0',
			],
		);
		
		$this->add_control(
			'attribute_limit',
			[
				'type'    => Controls_Manager::SELECT2,
				
				'label'   => esc_html__( 'Product Attribute Limit', 'foodymat-core' ),
				'description' => esc_html__( 'Note: This is not attribute item.', 'foodymat-core' ),
				'options' => array(
					1 => esc_html__( '1', 'foodymat-core' ),
					2 => esc_html__( '2', 'foodymat-core' ),
					3 => esc_html__( '3', 'foodymat-core' ),
					4 => esc_html__( '4', 'foodymat-core' ),
					5 => esc_html__( '5', 'foodymat-core' ),
				),
				'default' => 1,
			],
		);
		
		$this->add_control(
			'cat_single_box',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Categories', 'foodymat-core' ),
				'options' => $category_dropdown,
				'default'   => '0',
				'multiple'  => false,
			],
		);
		
		$this->add_control(
			'product_ids',
			[
				'label' => __( 'Select Product', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'options' => $options,
				'default' => [],
				'multiple' => true,
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'category_list',
			[
				'type'    => Controls_Manager::REPEATER,
				
				'label'   => esc_html__( 'Add as many Categories as you want', 'foodymat-core' ),
				'fields'  => array(
					array(
						'type'    => Controls_Manager::SELECT2,
						'name'    => 'cat_multi_box',
						'label'   => esc_html__( 'Categories', 'foodymat-core' ),
						'options' => $category_dropdown,
						'multiple'=> false,
						'default' => '1',
					),
				),
				'condition' => [
					'style' => '!style1',
				],
			],
		);
		
		$this->add_control(
			'posts_not_in',
			[
				'type'    => Controls_Manager::REPEATER,
				'label'   => esc_html__( 'Enter Post ID that will not display', 'foodymat-core' ),
				'fields'  => array(
					array(
						'type'    => Controls_Manager::NUMBER,
						'name'    => 'post_not_in',
						'label'   => esc_html__( 'Post ID', 'foodymat-core' ),
						'default' => '0',
					),
				),
				'condition' => [
					'style' => '!style1',
				],
			],
		);
		
		$this->add_control(
			'price_showhide',
			[
				'type'    => Controls_Manager::SWITCHER,
				'label'   => esc_html__( 'Price Show/Hide', 'foodymat-core' ),
				'label_on'    => esc_html__( 'Show', 'foodymat-core' ),
				'label_off'   => esc_html__( 'Hide', 'foodymat-core' ),
				'default'     => 'yes',
			],
		);
		
		$this->add_control(
			'rating_showhide',
			[
				'type'    => Controls_Manager::SWITCHER,
				'label'   => esc_html__( 'Rating Show/Hide', 'foodymat-core' ),
				'label_on'    => esc_html__( 'Show', 'foodymat-core' ),
				'label_off'   => esc_html__( 'Hide', 'foodymat-core' ),
				'default'     => 'yes',
			],
		);
					
		$this->add_control(
			'excerpt_display',
			[
				'type'    => Controls_Manager::SWITCHER,
				'label'   => esc_html__( 'Short Detail Show/Hide', 'foodymat-core' ),
				'label_on'    => esc_html__( 'Show', 'foodymat-core' ),
				'label_off'   => esc_html__( 'Hide', 'foodymat-core' ),
				'default'     => 'yes',
			],
		);
		$this->add_control(
			'discount_flag_display',
			[
				'type'    => Controls_Manager::SWITCHER,
				'label'   => esc_html__( 'Discount Flag Show/Hide', 'foodymat-core' ),
				'label_on'    => esc_html__( 'Show', 'foodymat-core' ),
				'label_off'   => esc_html__( 'Hide', 'foodymat-core' ),
				'default'     => 'yes',
			],
		);
						
		$this->add_control(
			'excerpt_count',
			[
				'type'    => Controls_Manager::NUMBER,
				'label'   => esc_html__( 'Word count', 'foodymat-core' ),
				'default' => 13,
				'description' => esc_html__( 'Maximum number of words', 'foodymat-core' ),
			],
		);
		
		$this->add_control(
			'all_button',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Show All Button', 'foodymat-core' ),
				'options' => array(
					'show'        => esc_html__( 'Show', 'foodymat-core' ),
					'hide'        => esc_html__( 'Hide', 'foodymat-core' ),
				),
				'default' => 'show',
			],
		);
		/*Isotope End*/
		
		/*Post Order*/
		$this->add_control(
			'post_ordering',
			[
				'type'    => Controls_Manager::SELECT2,
				
				'label'   => esc_html__( 'Post Ordering', 'foodymat-core' ),
				'options' => array(
					'DESC'	=> esc_html__( 'Desecending', 'foodymat-core' ),
					'ASC'	=> esc_html__( 'Ascending', 'foodymat-core' ),
				),
				'default' => 'DESC',
			],
		);
		
		$this->add_control(
			'orderby',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Post Sorting', 'foodymat-core' ),
				'options' => array(
					'recent' 		=> esc_html__( 'Recent Post', 'foodymat-core' ),
					'rand' 			=> esc_html__( 'Random Post', 'foodymat-core' ),
					'menu_order' 	=> esc_html__( 'Custom Order', 'foodymat-core' ),
					'title' 		=> esc_html__( 'By Name', 'foodymat-core' ),
				),
				'default' => 'recent',
			],
		);
		
		$this->add_control(
			'itemnumber',
			[
				'type'    => Controls_Manager::NUMBER,
				'label'   => esc_html__( 'Item Number', 'foodymat-core' ),
				'default' => -1,
				'description' => esc_html__( 'Use -1 for showing all items( Showing items per category )', 'foodymat-core' ),
			],
		);
		
		$this->add_control(
			'more_button',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'More Button', 'foodymat-core' ),
				'options' => array(
					'show'        => esc_html__( 'Show', 'foodymat-core' ),
					'hide'        => esc_html__( 'Hide', 'foodymat-core' ),
				),
				'default' => 'hide',
			],
		);
		
		$this->add_control(
			'see_button_text',
			[
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Button Text', 'foodymat-core' ),
				'default' => esc_html__( 'Show More', 'foodymat-core' ),
			],
		);
		
		$this->add_control(
			'see_button_link',
			[
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Button Link', 'foodymat-core' ),
			],
		);
		
		$this->add_responsive_control(
			'show_more_btn_alignment',
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
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .default-woo-layout .rt-button' => 'text-align: {{VALUE}};',
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
					'style' => ['style1','style2','style3','style4',],
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
					'style' => ['style5','style6'],
				],
			]
		);
		
		$this->add_control(
			'desktop',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Desktops: > 1600px', 'foodymat-core' ),
				'default' => '4',
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
				'default' => '4',
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
				'default' => '3',
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
					'5' => esc_html__( '5',  'foodymat-core' ),
				),
			]
		);
		$this->add_control(
			'sm_mobile',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Phones: > 425px', 'foodymat-core' ),
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
		
		$this->end_controls_section();
		
		// Slider option
		$this->start_controls_section(
			'section_slider_option',
			[
				'label' => __( 'Slider Option', 'foodymat-core' ),
				'condition' => [
					'style' => ['style5','style6'],
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
		
		// Slider setting
		$this->start_controls_section(
			'slider_style',
			[
				'label' => esc_html__( 'Slider Navigation', 'foodymat-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'style' => ['style5','style6'],
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
				'condition'   => [
					'display_arrow' => 'yes',
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
					'display_arrow' => 'yes',
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
					'display_arrow' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
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
						'min' => -500,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-navigation .swiper-button-next' => 'right: {{SIZE}}{{UNIT}};',
				],
				'condition'   => [
					'display_arrow' => 'yes',
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
		
		$this->add_responsive_control(
			'pagination_up_down',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Pagination UP / Down', 'foodymat-core' ),
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
					'{{WRAPPER}} .swiper-pagination' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
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
		
		// Title Settings
		//==============================================================
		$this->start_controls_section(
			'title_settings',
			[
				'label' => esc_html__( 'Title', 'foodymat-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typo', 'foodymat-core' ),
				'selector' => '{{WRAPPER}} .product-item .item-content .item-title',
			]
		);
		
		$this->add_control(
			'title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .product-item .item-content .item-title a'   => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'title_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Hover Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .product-item .item-content .item-title a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_responsive_control(
			'title_spacing',
			[
				'label'      => __( 'Title Spacing', 'foodymat-core' ),
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
					'{{WRAPPER}} .product-item .item-content .item-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_section();
		
		
		// Category Settings
		//==============================================================
		$this->start_controls_section(
			'category_settings',
			[
				'label' => esc_html__( 'Category', 'foodymat-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'category_typography',
				'label'    => esc_html__( 'Typo', 'foodymat-core' ),
				'selector' => '{{WRAPPER}} .product-item .item-content .product-categories a',
			]
		);
		
		$this->add_responsive_control(
			'cat_radius',
			[
				'label'      => __( 'Border Radius', 'foodymat-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .product-item .item-content .product-categories a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
					'{{WRAPPER}} .product-item .item-content .product-categories a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		
		//Start Icon Style Tab
		$this->start_controls_tabs(
			'category_style_tabs'
		);
		
		//Normal Style
		$this->start_controls_tab(
			'category_style_normal_tab',
			[
				'label' => __( 'Normal', 'foodymat-core' ),
			]
		);
		$this->add_control(
			'category_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .product-item .item-content .product-categories a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'category_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .product-item .item-content .product-categories a'  => 'background-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'category_border',
				'label'    => __( 'Border', 'foodymat-core' ),
				'selector' => '{{WRAPPER}} .product-item .item-content .product-categories a',
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'category_box_shadow',
				'label' => __('Category Shadow', 'foodymat-core'),
				'selector' => '{{WRAPPER}} .product-item .item-content .product-categories a',
			]
		);
		
		$this->end_controls_tab();
		
		//Hover Style
		$this->start_controls_tab(
			'category_style_hover_tab',
			[
				'label' => __( 'Hover', 'foodymat-core' ),
			]
		);
		
		$this->add_control(
			'category_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color Hover', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .product-item .item-content .product-categories a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'category_bg_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .product-item .item-content .product-categories a:hover'  => 'background-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'category_border_hover',
				'label'    => __( 'Border', 'foodymat-core' ),
				'selector' => '{{WRAPPER}} .product-item .item-content .product-categories a:hover',
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'category_box_hover_shadow',
				'label' => __('Icon Shadow', 'foodymat-core'),
				'selector' => '{{WRAPPER}} .product-item .item-content .product-categories a:hover',
			]
		);
		
		$this->end_controls_tab();
		
		$this->end_controls_tabs();
		//End Icon Style Tab
		
		$this->add_responsive_control(
			'category_spacing',
			[
				'label'      => __( 'Category Spacing', 'foodymat-core' ),
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
					'{{WRAPPER}} .product-item .item-content .product-categories' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_section();
		
		// Discount Flag Settings
		//==============================================================
		$this->start_controls_section(
			'flag_settings',
			[
				'label' => esc_html__( 'Discount Flag', 'foodymat-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'flag_typography',
				'label'    => esc_html__( 'Typo', 'foodymat-core' ),
				'selector' => '{{WRAPPER}} .product-item .discount-flag',
			]
		);
		
		$this->add_responsive_control(
			'flag_box_radius',
			[
				'label'      => __( 'Border Radius', 'foodymat-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .product-item .discount-flag' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		
		//Start Icon Style Tab
		$this->start_controls_tabs(
			'flag_style_tabs'
		);
		
		//Normal Style
		$this->start_controls_tab(
			'flag_style_normal_tab',
			[
				'label' => __( 'Normal', 'foodymat-core' ),
			]
		);
		$this->add_control(
			'flag_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .product-item .discount-flag span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'flag_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .product-item .discount-flag'  => 'background-color: {{VALUE}}',
				],
			]
		);
		
		$this->end_controls_tab();
		
		//Hover Style
		$this->start_controls_tab(
			'flag_style_hover_tab',
			[
				'label' => __( 'Hover', 'foodymat-core' ),
			]
		);
		
		$this->add_control(
			'flag_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color Hover', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .product-item .discount-flag:hover span' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'flag_bg_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .product-item .discount-flag:hover'  => 'background-color: {{VALUE}}',
				],
			]
		);
		
		$this->end_controls_tab();
		
		$this->end_controls_tabs();
		//End Icon Style Tab
		
		$this->add_responsive_control(
			'category_spacing',
			[
				'label'      => __( 'Category Spacing', 'foodymat-core' ),
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
					'{{WRAPPER}} .product-item .item-content .product-categories' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_section();
		
		// Excerpt Settings
		//==============================================================
		$this->start_controls_section(
			'excerpt_settings',
			[
				'label' => esc_html__( 'Excerpt', 'foodymat-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'excerpt_typography',
				'label'    => esc_html__( 'Typo', 'foodymat-core' ),
				'selector' => '{{WRAPPER}} .product-item .item-content .excerpt',
			]
		);
		
		$this->add_control(
			'excerpt_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .product-item .item-content .excerpt'   => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_responsive_control(
			'excerpt_spacing',
			[
				'label'      => __( 'Excerpt Spacing', 'foodymat-core' ),
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
					'{{WRAPPER}} .product-item .item-content .excerpt' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_section();
		
		// price Settings
		//==============================================================
		$this->start_controls_section(
			'price_settings',
			[
				'label' => esc_html__( 'Price', 'foodymat-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'sale_price_typography',
				'label'    => esc_html__( 'Sale Price Typo', 'foodymat-core' ),
				'selector' => '{{WRAPPER}} .product-item .item-content .item-price .sale-price',
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'original_price_typography',
				'label'    => esc_html__( 'Original Price Typo', 'foodymat-core' ),
				'selector' => '{{WRAPPER}} .product-item .item-content .item-price .original-price',
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'variable_price_typography',
				'label'    => esc_html__( 'Variable Price Typo', 'foodymat-core' ),
				'selector' => '{{WRAPPER}} .product-item .item-content .item-price',
			]
		);
		
		$this->add_control(
			'sale_price_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Sale Price Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .product-item .item-content .item-price .sale-price'   => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'original_price_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Original Price Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .product-item .item-content .item-price .original-price'   => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'variable_price_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Variable Price Color', 'foodymat-core' ),
				'selectors' => [
					'{{WRAPPER}} .product-item .item-content .item-price'   => 'color: {{VALUE}}',
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
		
		switch ( $data['style'] ) {
			case 'style6':
				$data['swiper_data'] = json_encode( $swiper_data );
				$template = 'view-slider-2';
				break;
			case 'style5':
				$data['swiper_data'] = json_encode( $swiper_data );
				$template = 'view-slider-1';
				break;
			case 'style4':
				$template = 'view-4';
				break;
			case 'style3':
				$template = 'view-3';
				break;
			case 'style2':
				$template = 'view-2';
				break;
			default:
				$template = 'view-1';
				break;
		}
	
		Fns::get_template( "elementor/woo-layout/$template", $data );
	}

}