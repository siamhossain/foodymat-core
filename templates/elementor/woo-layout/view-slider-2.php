<?php
	/**
	 * @author  RadiusTheme
	 * @since   1.0
	 * @version 1.0
	 * @var $data                       array
	 * @var $woo_categories             array
	 * @var $category_style             string
	 * @var $final_icon_image_url       string
	 * @var $final_icon_class           string
	 * @var $woo_category               string
	 * @var $cat_num_display            string
	 * @var $cat_multi_category         string
	 * @var $col_xl                     string
	 * @var $col_lg                     string
	 * @var $col_md                     string
	 * @var $col_sm                     string
	 * @var $col_xs                     string
	 * @var $item_space                 string
	 * @var $animation                  string
	 * @var $animation_effect           string
	 * @var $duration                   string
	 * @var $delay                      string
	 * @var $icon_class                 string
	 * @var $uncategorized              string
	 * @var $itemnumber                 string
	 * @var $orderby                    string
	 * @var $post_ordering              string
	 * @var $title_count                string
	 * @var $excerpt_count              string
	 * @var $cat_single_box             string
	 * @var $rating_showhide            string
	 * @var $product                    string
	 * @var $price_showhide             string
	 * @var $title_showhide             string
	 * @var $excerpt_display            string
	 * @var $args                       string
	 * @var $post_sorting               string
	 * @var $style                      string
	 * @var $more_button                string
	 * @var $see_button_link            string
	 * @var $discount_flag_display      string
     * @var $swiper_data                string
	 * @var $display_arrow              string
	 * @var $display_pagination         string
	 * @var $arrow_hover_visibility     string
	 * @var $animation                  string
	 * @var $animation_effect           string
	 * @var $delay                      string
	 * @var $duration                   string
	 */
	
	
	use RT\FoodMenuPro\Controllers\Discount\Discount;
	use RT\FoodMenuPro\Helpers\FnsPro;
	use RT\Foodymat\Modules\Pagination;
	
	if ( get_query_var('paged') ) {
		$paged = get_query_var('paged');
	}
	else if ( get_query_var('page') ) {
		$paged = get_query_var('page');
	}
	else {
		$paged = 1;
	}
	
	$number_of_post = $itemnumber;
	$post_sorting = $orderby;
	
	// Fetch and display WooCommerce products
	$args = array(
		'post_type'         => 'product',
		'post_status'       => 'publish',
		'orderby'           => $post_sorting,
		'order'             => $post_ordering,
		'posts_per_page'    => $number_of_post,
		'paged'             => $paged,
	);
	
	// If there are selected product IDs, filter by them
	if (!empty($product_ids)) {
		$args['post__in'] = $product_ids;  // Only show selected products
	}
	
	// Include category filter if set
	if ($cat_single_box !== '0') {
		$args['tax_query'] = [
			[
				'taxonomy' => 'product_cat',
				'field' => 'term_id',
				'terms' => $cat_single_box,
			],
		];
	}
	
	$query = new WP_Query($args);
	
	// Column classes
	$col_class = "col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-xs-{$col_xs}";
    
    //Discount data from FoodMenu
    $settings = FnsPro::get_settings_option();
	
	$discount_purchase_amount = '';
	$discount_amount = '';
	$discount_percentage = '';
    
    if (! empty( $settings['fmp_fixed_order_amount'] ) ) {
	    $discount_purchase_amount = wc_price( $settings['fmp_fixed_order_amount'] );
    }
    
    if (! empty( $settings['fmp_fixed_discount'] ) ) {
	    $discount_amount = wc_price( $settings['fmp_fixed_discount'] );
    }
    if (! empty( $settings['fmp_discount_percentage'] ) ) {
	    $discount_percentage = wc_price( $settings['fmp_discount_percentage'] );
    }

?>

<div class="default-woo-layout woo-layout-<?php echo esc_attr($style); ?>">

    <div class="rt-swiper-slider <?php echo esc_attr( $arrow_hover_visibility ) ?>" data-xld ="<?php echo esc_attr( $swiper_data );?>">
        <div class="swiper-wrapper">
            <?php if ($query->have_posts()) : ?>
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <?php
                    $id = get_the_ID();
                    $excerpt = wp_trim_words(get_the_excerpt(), $excerpt_count);
                    $product_title = wp_trim_words(get_the_title(), $title_count, '');
                    global $product;
                    $currency = get_woocommerce_currency_symbol();
                    $price = get_post_meta($id, '_regular_price', true);
                    $sale = get_post_meta($id, '_sale_price', true);
                    $ext_button_text = get_post_meta($id, '_button_text', true);
                    $ext_product_url = get_post_meta($id, '_product_url', true);
                    
                    $percentage_discount = get_post_meta($id, '_percentage_discount', true);
                    $min_subtotal = get_post_meta($id, '_min_subtotal', true);
                    $average_rating = $product->get_average_rating();
                    $rating_count = $product->get_rating_count();
                    ?>
                    <div class="swiper-slide <?php echo esc_attr( $animation );?> <?php echo esc_attr( $animation_effect );?>" data-wow-delay="<?php echo esc_attr( $delay );?>ms" data-wow-duration="<?php echo esc_attr( $duration );?>ms">
                        <div class="product-item product-item-style3 product-item-<?php echo esc_attr($style); ?>">
                            <div class="img-wrap">
                                <div class="item-img">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php
                                            if (has_post_thumbnail()) {
                                                the_post_thumbnail('foodymat-size9');
                                            } else {
                                                echo 'image not found';
                                            }
                                        ?>
                                    </a>
                                </div>
                                <?php if ( !empty ($discount_percentage ) && $discount_flag_display ) { ?>
                                    <div class="discount-flag">
                                        <span>
                                            <span class="price-percent"><?php echo $discount_percentage; ?></span>
                                            OFF
                                        </span>
                                    </div>
                                <?php } elseif (!empty ($discount_amount) && $discount_flag_display ) { ?>
                                    <div class="discount-flag">
                                        <span>
                                            <span class="price-percent"><?php echo $discount_amount; ?></span>
                                            OFF UPTO <?php echo $discount_purchase_amount; ?>
                                        </span>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="item-content">
                                <div class="product-categories">
                                    <?php
                                        $categories = wc_get_product_category_list($id, ' ');
                                        echo wp_kses($categories, 'alltext_allow');
                                    ?>
                                </div>
                                
                                <div class="title-price-wrap d-flex justify-content-between align-items-center">
                                    <?php if ($title_showhide == 'yes') : ?>
                                        <h3 class="item-title">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php echo wp_kses($product_title, 'alltext_allow'); ?>
                                            </a>
                                        </h3>
                                    <?php endif; ?>
                                    
                                    <?php if ($price_showhide == 'yes') : ?>
                                        <div class="item-price">
                                            <?php
                                                switch ($product->get_type()) {
                                                    case 'variable':
                                                        $min_price = $product->get_variation_price('min', true);
                                                        $max_price = $product->get_variation_price('max', true);
                                                        echo wp_kses($currency . number_format($min_price, 2) . ' - ' . $currency . number_format($max_price, 2), 'alltext_allow');
                                                        break;
                                                    case 'grouped':
                                                        $link = get_permalink($product->get_id());
                                                        echo '<a href="' . esc_url($link) . '">' . esc_html__('View Product', 'panpie-core') . '</a>';
                                                        break;
                                                    case 'external':
                                                        $link = !empty($ext_product_url) ? $ext_product_url : get_permalink($product->get_id());
                                                        $label = !empty($ext_button_text) ? $ext_button_text : esc_html__('Read More', 'panpie-core');
                                                        echo '<a href="' . esc_url($link) . '">' . wp_kses($label, 'alltext_allow') . '</a>';
                                                        break;
                                                    default:
                                                        //												echo wp_kses($product->get_price_html(), 'alltext_allow');
                                                        if ($product->is_on_sale() && !empty($sale)) {
                                                            echo ' <span class="sale-price">' . esc_html($currency . number_format($sale, 0)) . '</span>';
                                                            echo '<span class="original-price"><del>' . esc_html($currency . number_format($price, 0)) . '</del></span>';
                                                        } else {
                                                            // If not on sale, just show the regular price
                                                            echo '<span class="regular-price">' . esc_html($currency . number_format($price, 2)) . '</span>';
                                                        }
                                                        break;
                                                }
                                            ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                
                                <?php if ($rating_showhide == 'yes') : ?>
                                    <div class="product-rating">
    <!--                                    <i class="icon-star-circle"></i>-->
                                        <?php if (function_exists('woocommerce_template_loop_rating')) :
                                            woocommerce_template_loop_rating(); ?>
                                            <?php if ($rating_count) {
                                            echo '<span class="rating-count"> ('. number_format((float)$rating_count, 1, '.', '') .')</span>'; ?>
                                            <?php }
                                        endif; ?>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if ($excerpt_display == 'yes') : ?>
                                    <p class="excerpt"><?php echo wp_kses($excerpt, 'alltext_allow'); ?></p>
                                <?php endif; ?>
    
                                <div class="btn-wrap rt-button">
                                    <?php
                                        switch ($product->get_type()) {
                                            case 'variable':
                                                
                                                $link = get_permalink($product->get_id());
                                                $label = esc_html__('View options', 'panpie-core');
                                                echo '<a href="' . esc_url($link) . '" class="cart-btn btn button-2"><i class="icon-rt-cart"></i>' . esc_html($label) . '</a>';
                                                break;
                                            case 'grouped':
                                                $link = get_permalink($product->get_id());
                                                $label = esc_html__('Select Product', 'panpie-core');
                                                echo '<a href="' . esc_url($link) . '" class="cart-btn btn button-2"><i class="icon-rt-cart"></i>' . esc_html($label) . '</a>';
                                                break;
                                            case 'external':
                                                $link = !empty($ext_product_url) ? $ext_product_url : get_permalink($product->get_id());
                                                $label = !empty($ext_button_text) ? $ext_button_text : esc_html__('Read More', 'panpie-core');
                                                echo '<a href="' . esc_url($link) . '" class="cart-btn btn button-2"><i class="icon-rt-cart"></i>' . esc_html($label) . '</a>';
                                                break;
                                            default:
                                                $link = esc_url($product->add_to_cart_url());
                                                $label = esc_html__('Order Now', 'panpie-core');
                                                echo '<a href="' . $link . '" class="cart-btn btn button-2"><i class="icon-rt-cart"></i>' . esc_html($label) . '</a>';
                                                break;
                                        }
                                    ?>
                                </div>
                                
                            </div>
                        </div>
                    </div>
		            <?php $delay = $delay + 200; $duraton = $duration + 0;  ?>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
	    
	    <?php if ( $display_arrow == 'yes' ) { ?>
            <div class="swiper-navigation">
                <div class="swiper-button swiper-button-prev"><i class="icon-rt-round-chevron-left"></i></div>
                <div class="swiper-button swiper-button-next"><i class="icon-rt-round-chevron-right"></i></div>
            </div>
	    <?php } ?>
	    <?php if ( $display_pagination == 'yes' ) { ?>
            <div class="swiper-pagination"></div>
	    <?php } ?>
    </div>
</div>