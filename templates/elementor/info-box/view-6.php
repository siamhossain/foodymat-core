<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * @var $layout                     string
 * @var $link                       string
 * @var $bg_animation               string
 * @var $icon_animation             string
 * @var $image_invert               string
 * @var $icon_type                  string
 * @var $image_icon                 string
 * @var $info_icon                  string
 * @var $title                      string
 * @var $sub_title                  string
 * @var $show_read_more_btn         string
 * @var $btn_icon_position          string
 * @var $read_more_btn_text         string
 * @var $button_icon                string
 * @var $title_tag                  string
 * @var $show_btn_icon              string
 * @var $show_btn_text              string
 * @var $animation                  string
 * @var $animation_effect           string
 * @var $delay                      string
 * @var $duration                   string
 * @var $scroll_animation           string
 * @var $range_one                  string
 * @var $range_two                  string
 * @var $x_range                    string
 * @var $y_range                    string
 * @var $shape_display              string
 */

$attr = '';
if ( !empty( $link['url'] ) ) {
	$attr  = 'href="' . $link['url'] . '"';
	$attr .= !empty( $link['is_external'] ) ? ' target="_blank"' : '';
	$attr .= !empty( $link['nofollow'] ) ? ' rel="nofollow"' : '';
	$attr .= ' aria-label="info link"';
}
$range_one = ( $scroll_animation == 'yes' ) ? $range_one : '';
$range_two = ( $scroll_animation == 'yes' ) ? $range_two : '';

$icon_class = ( $icon_type == 'icon') ? 'icon-class' : 'image-class';

?>

<div class="rt-info-box rt-info-<?php echo esc_attr( $layout ) ?>" data-parallax='{"<?php echo esc_attr( $x_range );?>" : <?php echo esc_attr( $range_one );?>, "<?php echo esc_attr( $y_range );?>" : <?php echo esc_attr( $range_two );?>}'>
    <div class="info-box <?php echo esc_attr( $animation );?> <?php echo esc_attr( $animation_effect );?>" data-wow-delay="<?php echo esc_attr( $delay );?>ms" data-wow-duration="<?php echo esc_attr( $duration );?>ms">
		<?php if( $image_icon['id'] ||  $info_icon ) { ?>
            <div class="info-icon-holder icon-holder <?php echo esc_attr( $icon_class ); ?>">
                <div class="info-icon">
		            <?php
		            echo $link['url'] ? '<a ' . $attr . '>' : null;
		            if ( 'image' == $icon_type ) {
			            echo wp_get_attachment_image( $image_icon['id'], 'full' );
		            } else {
			            \Elementor\Icons_Manager::render_icon( $info_icon, [ 'aria-hidden' => 'true' ] );
		            }
		            echo $link['url'] ? '</a>' : null;
		            ?>
                </div>
	            <?php if( $shape_display == 'yes' ) { ?>
                <svg class="info-shape" width="192" height="169" viewBox="0 0 192 169" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M192 -9C192 89.3067 112.307 169 14 169C-84.3067 169 -164 89.3067 -164 -9C-164 -107.307 -84.3067 -187 14 -187C112.307 -187 192 -107.307 192 -9ZM-114.311 -9C-114.311 61.864 -56.864 119.311 14 119.311C84.864 119.311 142.311 61.864 142.311 -9C142.311 -79.864 84.864 -137.311 14 -137.311C-56.864 -137.311 -114.311 -79.864 -114.311 -9Z" fill="currentColor"/>
                    <path d="M114 -18.5C114 44.7366 62.7366 96 -0.5 96C-63.7366 96 -115 44.7366 -115 -18.5C-115 -81.7366 -63.7366 -133 -0.5 -133C62.7366 -133 114 -81.7366 114 -18.5ZM-70.2429 -18.5C-70.2429 20.0179 -39.0179 51.2429 -0.5 51.2429C38.0179 51.2429 69.2429 20.0179 69.2429 -18.5C69.2429 -57.0179 38.0179 -88.2429 -0.5 -88.2429C-39.0179 -88.2429 -70.2429 -57.0179 -70.2429 -18.5Z" fill="currentColor"/>
                </svg>
                <?php } ?>
            </div>
		<?php } ?>

        <div class="info-content-holder">
			<?php if ( $title ) { ?>
                <<?php echo esc_attr( $title_tag ); ?> class="info-title"><a <?php echo $attr; ?>><?php foodymat_html( $title, 'allow_title' );?></a></<?php echo esc_attr( $title_tag ); ?>>
	        <?php } ?>

            <?php if ( $sub_title ) { ?>
                <div class="content-holder"><p><?php foodymat_html( $sub_title, 'allow_title' );?></p></div>
            <?php } ?>

            <?php if ( $show_read_more_btn ) { ?>
                <div class="rt-button <?php if( $show_btn_text ) { ?>button-hover-visibility<?php } ?>">
                    <a class="btn button-2" <?php echo $attr; ?>>
                        <span class="btn-text"><?php echo esc_html( $read_more_btn_text );?></span>
                        <?php if( $show_btn_icon ) { ?><?php \Elementor\Icons_Manager::render_icon( $button_icon, [ 'aria-hidden' => 'true' ] ) ; ?><?php } ?>
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
</div>