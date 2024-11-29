<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * @var $category_display                 string
 * @var $product_placeholder              string
 * @var $button_text                      string
 */

$category_dropdown = array();
if (taxonomy_exists('product_cat')) {
	$terms = get_terms( array( 'taxonomy' => 'product_cat', 'parent' => 0 ) );
	foreach ( $terms as $term) {
		$category_dropdown[$term->slug] = array(
			'name' => $term->name,
		);
	}
}

$search      = isset( $_GET['s'] ) ? $_GET['s'] : '';
$product_cat = isset( $_GET['product_cat'] ) ? $_GET['product_cat'] : '';

$all_label = $label = esc_html__( 'Select Category', 'foodymat-core' );
if ( isset( $_GET['product_cat'] ) ) {
	$pcat = $_GET['product_cat'];
	if ( isset( $category_dropdown[$pcat] ) ) {
		$label = $category_dropdown[$pcat]['name'];
	}
}
?>

<div class="rt-search-box-wrap flex-grow-1 product-search">
	<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<div class="category-search-dropdown-js">
			<ul class="rt-action-list d-flex align-items-center">
				<?php if( $category_display == 'yes' ) { ?>
				<li class="item rt-cat-drop cat-drop">
					<div class="dropdown">
						<input type="hidden" name="product_cat" value="<?php echo esc_attr( $product_cat );?>">
						<div class="cat-btn-wrap">
							<button class="rt-btn cat-toggle" type="button" id="dropdownMenuButtonAddon" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="icon"><i class="down-arrow icon-rt-filter"></i></span>
                                <span class="cat-label"><?php echo esc_html( $label );?></span>
                            </button>
							<ul class="dropdown-menu rt-drop-menu" aria-labelledby="dropdownMenuButtonAddon">
								<li data-slug=""><?php echo esc_html( $all_label );?></li>
								<?php
								foreach ( $category_dropdown as $slug => $cat ) {
									printf( '<li data-slug="%s"><span>%s</span></li>', $slug, $cat['name'] );
								}
								?>
							</ul>
						</div>
					</div>
				</li>
                <?php } ?>
				<li class="item rt-advanced-search flex-grow-1">
					<div class="rt-input-group">
						<input type="text" autocomplete="off" name="s" class="form-control product-search-form product-autocomplete-js" placeholder="<?php foodymat_html( $product_placeholder, 'allow_title' );?>" value="<?php echo esc_attr( $search );?>">
						<div class="input-group-append">
							<input type="hidden" name="post_type" value="product">
							<button class="search-btn">
                                <i class="icon-rt-search-1"></i>
                                <?php echo esc_html( $button_text );?>
                            </button>
						</div>
					</div>
				</li>
			</ul>
		</div>
	</form>
	<div class="result"></div>
</div>