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
				'default' => [''],
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
		
		$this->start_controls_section(
			'sec_colors',
			[
				'label'   => esc_html__( 'Colors', 'foodymat-core' ),
				'tab'     => Controls_Manager::TAB_CONTENT,
			],
		);
		
		$this->add_control(
			'title_color',
			[
				'type'    => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Title Color', 'foodymat-core' ),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .food-box .item-content .item-title a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .shop-layout-style7 .food-box .item-header .item-title a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .food-menu-combo .food-box-2 .item-content .item-title a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .food-menu-isotop-style11 .item-box .item-body .item-title a' => 'color: {{VALUE}}',
				],
			],
		);
		
		$this->add_control(
			'title_size',
			[
				'type'    => Controls_Manager::NUMBER,
				'label'   => esc_html__( 'Title Font Size', 'foodymat-core' ),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .food-box .item-content .item-title' => 'font-size: {{VALUE}}px',
					'{{WRAPPER}} .shop-layout-style7 .food-box .item-header .item-title' => 'font-size: {{VALUE}}px',
					'{{WRAPPER}} .food-menu-combo .food-box-2 .item-content .item-title' => 'font-size: {{VALUE}}px',
					'{{WRAPPER}} .food-menu-isotop-style11 .item-box .item-body .item-title' => 'font-size: {{VALUE}}px',
				],
			],
		);
		
		$this->end_controls_section();
		
		// Responsive Settings
		$this->start_controls_section(
			'sec_grid_responsive',
			[
				'label' => esc_html__( 'Number of Responsive Columns', 'foodymat-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
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

	}
	
	
	protected function render() {
		$data     = $this->get_settings();
		
		switch ( $data['style'] ) {
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