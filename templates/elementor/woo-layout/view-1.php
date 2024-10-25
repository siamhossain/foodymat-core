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
 * @var $product                    string
 * @var $price_showhide             string
 * @var $title_showhide             string
 * @var $excerpt_display            string
 * @var $args                       string
 * @var $post_sorting               string
 */
	
	
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
	
	$query = new WP_Query($args);
	
	// Column classes
	$col_class = "col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-xs-{$col_xs}";
	
	
?>

<div class="default-woo-category-box woo-category-box-<?php echo esc_attr($category_style); ?>">
    <div class="row <?php echo esc_attr($item_space); ?>">
		<?php if ($query->have_posts()) : ?>
			<?php while ($query->have_posts()) : $query->the_post(); ?>
				<?php
				$id = get_the_ID();
				$excerpt = wp_trim_words(get_the_excerpt(), $excerpt_count, '');
				$product_title = wp_trim_words(get_the_title(), $title_count, '');
				global $product;
				$currency = get_woocommerce_currency_symbol();
				$price = get_post_meta($id, '_regular_price', true);
				$sale = get_post_meta($id, '_sale_price', true);
				$ext_button_text = get_post_meta($id, '_button_text', true);
				$ext_product_url = get_post_meta($id, '_product_url', true);
				
				$percentage_discount = get_post_meta($id, '_percentage_discount', true);
				$min_subtotal = get_post_meta($id, '_min_subtotal', true);
    
				?>
                <div class="<?php echo esc_attr($col_class) ?>">
                    <div class="food-box-3">
                        <div class="img-wrap">
                            <div class="item-img">
                                <a href="<?php the_permalink(); ?>">
									<?php
										if (has_post_thumbnail()) {
											the_post_thumbnail('foodymat-size4');
										} else {
											echo 'image not found';
										}
									?>
                                </a>
                            </div>
                            <div class="discount-flag">
                                <span><?php echo esc_html($percentage_discount); ?> OFF UPTO $100 <?php echo esc_html($min_subtotal); ?></span>
                            </div>
                        </div>
                        <h1><?php echo $min_subtotal ?> dd</h1>
                        <div class="item-content">
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
												echo wp_kses($product->get_price_html(), 'alltext_allow');
												break;
										}
									?>
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
                                <p><?php echo wp_kses($excerpt, 'alltext_allow'); ?></p>
							<?php endif; ?>

                            <div class="btn-wrap">
								<?php
									switch ($product->get_type()) {
										case 'variable':
											$link = get_permalink($product->get_id());
											$label = esc_html__('View options', 'panpie-core');
											echo '<a href="' . esc_url($link) . '" class="cart-btn"><i class="fas fa-shopping-cart"></i>' . esc_html($label) . '</a>';
											break;
										case 'grouped':
											$link = get_permalink($product->get_id());
											$label = esc_html__('Select Product', 'panpie-core');
											echo '<a href="' . esc_url($link) . '" class="cart-btn"><i class="fas fa-shopping-cart"></i>' . esc_html($label) . '</a>';
											break;
										case 'external':
											$link = !empty($ext_product_url) ? $ext_product_url : get_permalink($product->get_id());
											$label = !empty($ext_button_text) ? $ext_button_text : esc_html__('Read More', 'panpie-core');
											echo '<a href="' . esc_url($link) . '" class="cart-btn"><i class="fas fa-shopping-cart"></i>' . esc_html($label) . '</a>';
											break;
										default:
											$link = esc_url($product->add_to_cart_url());
											$label = esc_html__('Add to cart', 'panpie-core');
											echo '<a href="' . $link . '" class="cart-btn"><i class="fas fa-shopping-cart"></i>' . esc_html($label) . '</a>';
											break;
									}
								?>
                            </div>
                        </div>
                    </div>
                </div>
			<?php endwhile; ?>
		<?php endif; ?>
        <h1>Woo Layout</h1>
    </div>
</div>
