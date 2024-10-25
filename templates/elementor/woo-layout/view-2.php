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
 * @var $itemnumber              string
 * @var $orderby              string
 * @var $post_ordering              string
 * @var $title_count              string
 * @var $excerpt_count              string
 * @var $cat_single_box              string
 * @var $product              string
 * @var $price_showhide              string
 * @var $title_showhide              string
 * @var $excerpt_display              string
 * @var $args              string
 */
	
	
	
	$args = [
		'post_type' => 'product',
	];
 
	$products = new WP_Query($args);

 


?>


	
<div class="layout-style-2">
    <div class="container">
        <div class="row">
            
            <?php
                if ( $products->have_posts() ) {
                    while ($products->have_posts() ) {
                        $products->the_post();
	                    $price = get_post_meta( get_the_ID(), '_regular_price', true);
	                    $sale = get_post_meta( get_the_ID(), '_sale_price', true);
                        
                        ?>
                        

                        
                        <div class="col-md-4">
                            <div class="product-item">
                                <div class="product-thumb">
                                    <a href="<?php the_permalink(); ?>">
	                                    <?php
                                            if ( has_post_thumbnail() ) {
                                                the_post_thumbnail('foodymat-size4');
                                            } else {
                                                echo 'Image not found';
                                            }
                                        ?>
                                    </a>
                                </div>
                                <div class="product-content">
                                    <h3 class="title">
                                        <a href="<?php the_permalink(); ?>"> <?php echo esc_html( get_the_title() ); ?> </a>
                                    </h3>
                                    <p class="text"><?php echo esc_html( get_the_excerpt() ); ?></p>
                                    <p class="price"> <?php echo esc_html($price) ?> </p>
                                    <p class="price"> <?php echo esc_html($sale) ?> </p>
                                </div>
                            </div>
                        </div>
            <?php
                    }
                }
            ?>
    
        </div>
    </div>
</div>


<?php
	echo '<pre>';
	print_r($products) ;
	echo '<pre>';
?>

