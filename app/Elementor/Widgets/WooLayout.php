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
		
		$list_dropdown = array( '0' => esc_html__( 'All Variation', 'panpie-core' ) );
		
		foreach ( $lists as $key=>$value ) {
			$list_dropdown[$key] = $value;
		}
		
		// find the category of products
		
		$terms  = get_terms( array( 'taxonomy' => 'product_cat', 'fields' => 'id=>name' ) );
		$category_dropdown = array( '0' => __( 'Please Selecet category', 'digeco-core' ) );
		
		foreach ( $terms as $id => $name ) {
			$category_dropdown[$id] = $name;
		}
		
		$this->start_controls_section(
			'sec_general',
			[
				'label'   => esc_html__( 'General', 'panpie-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			],
		);
		
		$this->add_control(
			'style',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Style', 'panpie-core' ),
				'options' => array(
					'style1' => esc_html__( 'Style 1', 'panpie-core' ),
					'style2' => esc_html__( 'Style 2', 'panpie-core' ),
					'style5' => esc_html__( 'Style 3', 'panpie-core' ),
					'style6' => esc_html__( 'Style 4', 'panpie-core' ),
					'style10' => esc_html__( 'Style 5', 'panpie-core' ),
					'style3' => esc_html__( 'Food Menu Isotope', 'panpie-core' ),
					'style8' => esc_html__( 'Food Menu Isotope 2', 'panpie-core' ),
					'style9' => esc_html__( 'Food Menu Isotope 3', 'panpie-core' ),
					'style11' => esc_html__( 'Food Menu Isotope 4', 'panpie-core' ),
					'style4' => esc_html__( 'Food Menu Carousel', 'panpie-core' ),
					'style7' => esc_html__( 'Food Menu Carousel 2', 'panpie-core' ),
				),
				'default' => 'style1',
			],
		);
		
		$this->add_control(
			'title_showhide',
			[
				'type'    => Controls_Manager::SWITCHER,
				'id'      => 'title_showhide',
				'label'   => esc_html__( 'Title', 'panpie-core' ),
				'label_on'    => esc_html__( 'Show', 'panpie-core' ),
				'label_off'   => esc_html__( 'Hide', 'panpie-core' ),
				'default'     => 'yes',
			],
		);
		
		$this->add_control(
			'title_count',
			[
				'type'    => Controls_Manager::NUMBER,
				
				'label'   => esc_html__( 'Title Word count', 'panpie-core' ),
				'default' => 5,
				'description' => esc_html__( 'Maximum number of words', 'panpie-core' ),
			],
		);
		
		$this->add_control(
			'variation_cat',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Variations', 'panpie-core' ),
				'options' => $list_dropdown,
				'default' => '0',
				'condition'   => array( 'style' => array( 'style2',  'style6', 'style10', 'style3', 'style8', 'style9' ) ),
			],
		);
		
		$this->add_control(
			'attribute_limit',
			[
				'type'    => Controls_Manager::SELECT2,
				
				'label'   => esc_html__( 'Product Attribute Limit', 'panpie-core' ),
				'description' => esc_html__( 'Note: This is not attribute item.', 'panpie-core' ),
				'options' => array(
					1 => esc_html__( '1', 'panpie-core' ),
					2 => esc_html__( '2', 'panpie-core' ),
					3 => esc_html__( '3', 'panpie-core' ),
					4 => esc_html__( '4', 'panpie-core' ),
					5 => esc_html__( '5', 'panpie-core' ),
				),
				'default' => 1,
				'condition'   => array( 'style' => array('style1', 'style4', 'style5', 'style7' ) ),
			],
		);
		
		$this->add_control(
			'cat_single_box',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Categories', 'panpie-core' ),
				'options' => $category_dropdown,
				'default'   => '0',
				'multiple'  => false,
				'condition'   => array( 'style' => array( 'style1', 'style2', 'style4', 'style6', 'style7', 'style10' ) ),
			],
		);
		
		$this->add_control(
			'category_list',
			[
				'type'    => Controls_Manager::REPEATER,
				
				'label'   => esc_html__( 'Add as many Categories as you want', 'panpie-core' ),
				'fields'  => array(
					array(
						'type'    => Controls_Manager::SELECT2,
						'name'    => 'cat_multi_box',
						'label'   => esc_html__( 'Categories', 'panpie-core' ),
						'options' => $category_dropdown,
						'multiple'=> false,
						'default' => '1',
					),
				),
				'condition'   => array( 'style' => array( 'style5', 'style3', 'style8', 'style9', 'style11' ) ),
			],
		);
		
		$this->add_control(
			'posts_not_in',
			[
				'type'    => Controls_Manager::REPEATER,
				'label'   => esc_html__( 'Enter Post ID that will not display', 'panpie-core' ),
				'fields'  => array(
					array(
						'type'    => Controls_Manager::NUMBER,
						'name'    => 'post_not_in',
						'label'   => esc_html__( 'Post ID', 'panpie-core' ),
						'default' => '0',
					),
				),
				'condition'   => array( 'style' => array( 'style5', 'style3', 'style8', 'style9', 'style11' ) ),
			],
		);
		
		$this->add_control(
			'price_showhide',
			[
				'type'    => Controls_Manager::SWITCHER,
				'label'   => esc_html__( 'Price Show/Hide', 'panpie-core' ),
				'label_on'    => esc_html__( 'Show', 'panpie-core' ),
				'label_off'   => esc_html__( 'Hide', 'panpie-core' ),
				'default'     => 'yes',
			],
		);
		
		$this->add_control(
			'rating_showhide',
			[
				'type'    => Controls_Manager::SWITCHER,
				'label'   => esc_html__( 'Rating Show/Hide', 'panpie-core' ),
				'label_on'    => esc_html__( 'Show', 'panpie-core' ),
				'label_off'   => esc_html__( 'Hide', 'panpie-core' ),
				'default'     => 'yes',
				'condition'   => array( 'style' => array( 'style7', 'style10', 'style11' ) ),
			],
		);
					
		$this->add_control(
			'excerpt_display',
			[
				'type'    => Controls_Manager::SWITCHER,
				'label'   => esc_html__( 'Short Detail Show/Hide', 'panpie-core' ),
				'label_on'    => esc_html__( 'Show', 'panpie-core' ),
				'label_off'   => esc_html__( 'Hide', 'panpie-core' ),
				'default'     => 'yes',
				'condition'   => array( 'style' => array( 'style2', 'style3', 'style5', 'style6', 'style8', 'style9', 'style10', 'style11' ) ),
			],
		);
						
		$this->add_control(
			'excerpt_count',
			[
				'type'    => Controls_Manager::NUMBER,
				'label'   => esc_html__( 'Word count', 'panpie-core' ),
				'default' => 13,
				'description' => esc_html__( 'Maximum number of words', 'panpie-core' ),
				'condition'   => array( 'excerpt_display' => array( 'yes' ), 'style' => array( 'style2', 'style3', 'style5', 'style6', 'style8', 'style9', 'style10', 'style11' ) ),
			],
		);
		
		$this->add_control(
			'all_button',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Show All Button', 'panpie-core' ),
				'options' => array(
					'show'        => esc_html__( 'Show', 'panpie-core' ),
					'hide'        => esc_html__( 'Hide', 'panpie-core' ),
				),
				'default' => 'show',
				'condition'   => array( 'style' => array( 'style3', 'style5', 'style8', 'style9', 'style11' ) ),
			],
		);
		/*Isotope End*/
		
		/*Post Order*/
		$this->add_control(
			'post_ordering',
			[
				'type'    => Controls_Manager::SELECT2,
				
				'label'   => esc_html__( 'Post Ordering', 'panpie-core' ),
				'options' => array(
					'DESC'	=> esc_html__( 'Desecending', 'panpie-core' ),
					'ASC'	=> esc_html__( 'Ascending', 'panpie-core' ),
				),
				'default' => 'DESC',
			],
		);
		
		$this->add_control(
			'orderby',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Post Sorting', 'panpie-core' ),
				'options' => array(
					'recent' 		=> esc_html__( 'Recent Post', 'panpie-core' ),
					'rand' 			=> esc_html__( 'Random Post', 'panpie-core' ),
					'menu_order' 	=> esc_html__( 'Custom Order', 'panpie-core' ),
					'title' 		=> esc_html__( 'By Name', 'panpie-core' ),
				),
				'default' => 'recent',
			],
		);
		
		$this->add_control(
			'itemnumber',
			[
				'type'    => Controls_Manager::NUMBER,
				'label'   => esc_html__( 'Item Number', 'panpie-core' ),
				'default' => -1,
				'description' => esc_html__( 'Use -1 for showing all items( Showing items per category )', 'panpie-core' ),
			],
		);
		
		$this->add_control(
			'more_button',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'More Button', 'panpie-core' ),
				'options' => array(
					'show'        => esc_html__( 'Show', 'panpie-core' ),
					'hide'        => esc_html__( 'Hide', 'panpie-core' ),
				),
				'default' => 'hide',
				'condition'   => array( 'style' => array( 'style1','style2','style3', 'style6', 'style8', 'style9', 'style10', 'style11' ) ),
			],
		);
		
		$this->add_control(
			'see_button_text',
			[
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Button Text', 'panpie-core' ),
				'condition'   => array( 'more_button' => array( 'show' ), 'style' => array( 'style1','style2','style3', 'style6', 'style8', 'style9', 'style10', 'style11' ) ),
				'default' => esc_html__( 'Show More', 'panpie-core' ),
			],
		);
		
		$this->add_control(
			'see_button_link',
			[
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Button Link', 'panpie-core' ),
				'condition'   => array( 'more_button' => array( 'show' ), 'style' => array( 'style1','style2','style3', 'style6', 'style8', 'style9', 'style10', 'style11' )),
			],
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'sec_colors',
			[
				'label'   => esc_html__( 'Colors', 'panpie-core' ),
				'tab'     => Controls_Manager::TAB_CONTENT,
			],
		);
		
		$this->add_control(
			'title_color',
			[
				'type'    => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Title Color', 'panpie-core' ),
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
				'label'   => esc_html__( 'Title Font Size', 'panpie-core' ),
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
				'default' => '2',
			]
		);
		
		$this->add_control(
			'col_lg',
			[
				'type' => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Desktops: > 991px', 'foodymat-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '2',
			]
		);
		
		$this->add_control(
			'col_md',
			[
				'type' => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Tablets: > 767px', 'foodymat-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '4',
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