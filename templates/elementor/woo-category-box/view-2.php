<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * @var $data                       array
 * @var $woo_categories             array
 * @var $category_style             string
 * @var $icontype                   string
 * @var $img_scale                  string
 * @var $icon_size                  string
 * @var $getimg                     string
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
 * @var $item_space                 string
 * @var $arrow_hover_visibility     string
 * @var $swiper_data                string
 * @var $display_arrow              string
 * @var $display_pagination         string
 * @var $icon_class                 string
 * @var $uncategorized              string
 */
	

use Elementor\Icons_Manager;
	
//fetch all Categories
$product_categories = get_terms(array(
    'taxonomy' => 'product_cat',
    'orderby' => 'count',
    'hide_empty' => false,

));

$col_class = "col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-xs-{$col_xs}";

?>


<div class="default-woo-category-box woo-category-box-<?php echo esc_attr( $category_style ); ?>">

    <div class="rt-swiper-slider <?php echo esc_attr( $arrow_hover_visibility ) ?>" data-xld ="<?php echo esc_attr( $swiper_data );?>">
        <div class="swiper-wrapper">
	        <?php
		        foreach ( $product_categories as $category ) {
			        
			        if(!$uncategorized) {
				        if ( 'uncategorized' === $category->slug ) {
					        continue; // Skip this iteration
				        }
			        }
           
			        $thumbnail_id  = get_term_meta( $category->term_id, 'thumbnail_id', true );
			        $image         = wp_get_attachment_url( $thumbnail_id );
			        $category_link = get_term_link($category);
	        ?>
            <div class="swiper-slide <?php echo esc_attr( $animation );?> <?php echo esc_attr( $animation_effect );?>" data-wow-delay="<?php echo esc_attr( $delay );?>ms" data-wow-duration="<?php echo esc_attr( $duration );?>ms">
                <div class="woo-category-item text-center">
		            <?php if ( !empty( $icontype== 'image' ) ) { ?>
                        <div class="woo-category-thumb">
				            <?php
					            if ($image) {
						            echo '<img src="' . esc_url( $image ) . '" alt="' . esc_attr( $category->name ) . '" />';
					            }
				            ?>
                        </div>
		            <?php } else { ?>
                        <div class="icon-wrap">
				            <?php $icon_class ? Icons_Manager::render_icon($icon_class): null; ?>
                        </div>
		            <?php } ?>

                    <h3 class="category-title">
                        <a href="<?php echo esc_url( $term_link ); ?>"><?php echo esc_html( $category->name ); ?></a>
			            <?php if ( $cat_num_display == 'yes' ) { ?><span class="category-count">(<?php echo esc_html( $category->count ); ?>)</span><?php } ?>
                    </h3>
                </div>
            </div>
            <?php } ?>
        </div>
	    <?php if ( $display_arrow == 'yes' ) { ?>
            <div class="swiper-navigation">
                <div class="swiper-button swiper-button-prev"><i class="icon-rt-left-arrow"></i></div>
                <div class="swiper-button swiper-button-next"><i class="icon-rt-right-arrow"></i></div>
            </div>
	    <?php } ?>
	    <?php if ( $display_pagination == 'yes' ) { ?>
            <div class="swiper-pagination"></div>
	    <?php } ?>
    </div>
    
