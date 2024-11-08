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
 */
	
	
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
	
	if ( $style === 'style1' ) {
		$col_xl = '12';
	}
	
	// Column classes
	$col_class = "col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-xs-{$col_xs}";
	
?>

<div class="default-woo-layout woo-layout-<?php echo esc_attr($style); ?>">
    <div class="row <?php //echo esc_attr($item_space); ?>">
		<?php if ($query->have_posts()) : ?>
			<?php $i = 1; ?>
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
                $odd_product = ($i % 2 === 0) ? '' : 'row-reverse reverse';
				$average = $product->get_average_rating();
				?>
                <div class="<?php echo esc_attr($col_class) ?>">
                    <div class="product-item product-item-<?php echo esc_attr($style); ?> <?php echo esc_attr($odd_product); ?>">
                        <div class="img-wrap">
                            <div class="item-img">
                                <a href="<?php the_permalink(); ?>">
									<?php
										if (has_post_thumbnail()) {
											the_post_thumbnail('foodymat-size3');
										} else {
											echo 'image not found';
										}
									?>
                                </a>
                            </div>
                        </div>
                        <div class="item-content">
                            <div class="product-categories">
		                        <?php
			                        $categories = wc_get_product_category_list($id, ' ');
			                        echo wp_kses($categories, 'alltext_allow');
		                        ?>
                            </div>
	                        <?php if ($rating_showhide == 'yes') : ?>
                                <div class="product-rating">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="7" cy="6.99988" r="7" fill="#E9A800"/>
                                        <path d="M7.00016 9.63488L9.07516 10.8899C9.45516 11.1199 9.92016 10.7799 9.82016 10.3499L9.27016 7.98988L11.1052 6.39988C11.4402 6.10988 11.2602 5.55988 10.8202 5.52488L8.40516 5.31988L7.46016 3.08988C7.29016 2.68488 6.71016 2.68488 6.54016 3.08988L5.59516 5.31488L3.18016 5.51988C2.74016 5.55488 2.56016 6.10488 2.89516 6.39488L4.73016 7.98488L4.18016 10.3449C4.08016 10.7749 4.54516 11.1149 4.92516 10.8849L7.00016 9.63488Z" fill="white"/>
                                    </svg>
    
                                    <?php if (function_exists('woocommerce_template_loop_rating')) : ?>
                                        <span>
                                        <?php echo esc_html(number_format((float)$average, 1, '.', '')); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
	                        <?php endif; ?>
                         
							<?php if ($title_showhide == 'yes') : ?>
                                <h3 class="item-title">
                                    <a href="<?php the_permalink(); ?>">
										<?php echo wp_kses($product_title, 'alltext_allow'); ?>
                                    </a>
                                </h3>
							<?php endif; ?>
							
							<?php if ($excerpt_display == 'yes') : ?>
                                <p class="excerpt"><?php echo wp_kses($excerpt, 'alltext_allow'); ?></p>
							<?php endif; ?>
	                        
                            <div class="price-order-btn-wrap">
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
    
                                <div class="btn-wrap rt-button">
                                    <?php
                                        switch ($product->get_type()) {
                                            case 'variable':
                                                
                                                $link = get_permalink($product->get_id());
                                                $label = esc_html__('View options', 'panpie-core');
                                                echo '<a href="' . esc_url($link) . '" class="cart-btn btn button-6"><i class="icon-rt-cart"></i>' . esc_html($label) . '</a>';
                                                break;
                                            case 'grouped':
                                                $link = get_permalink($product->get_id());
                                                $label = esc_html__('Select Product', 'panpie-core');
                                                echo '<a href="' . esc_url($link) . '" class="cart-btn btn button-6"><i class="icon-rt-cart"></i>' . esc_html($label) . '</a>';
                                                break;
                                            case 'external':
                                                $link = !empty($ext_product_url) ? $ext_product_url : get_permalink($product->get_id());
                                                $label = !empty($ext_button_text) ? $ext_button_text : esc_html__('Read More', 'panpie-core');
                                                echo '<a href="' . esc_url($link) . '" class="cart-btn btn button-6"><i class="icon-rt-cart"></i>' . esc_html($label) . '</a>';
                                                break;
                                            default:
                                                $link = esc_url($product->add_to_cart_url());
                                                $label = esc_html__('Order Now', 'panpie-core');
                                                echo '<a href="' . $link . '" class="cart-btn btn button-6"><i class="icon-rt-cart"></i>' . esc_html($label) . '</a>';
                                                break;
                                        }
                                    ?>
                                </div>
                            </div>
                            
                            <div class="discount-flag">
                                <span><?php echo esc_html($percentage_discount); ?> OFF UPTO <?php echo esc_html($min_subtotal); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $i++; ?>
			<?php endwhile; ?>
		<?php endif; ?>
    </div>
	<?php if ( $more_button == 'show' ) { ?>
		<?php if ( !empty( $see_button_text ) ) { ?>
            <div class="rt-button show-more-btn"><a class="btn button-6" href="<?php echo esc_url( $see_button_link );?>"><?php echo esc_html( $see_button_text );?></a></div>
		<?php } ?>
	<?php } else { ?>
		<?php Pagination::pagination($query);?>
	<?php } ?>
</div>
