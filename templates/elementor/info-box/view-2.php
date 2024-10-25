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
 * @var $read_more_btn_text         string
 * @var $button_icon                string
 * @var $title_tag                  string
 * @var $show_box_shape             string
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

?>

<div class="rt-info-box rt-info-<?php echo esc_attr( $layout ) ?>" data-parallax='{"<?php echo esc_attr( $x_range );?>" : <?php echo esc_attr( $range_one );?>, "<?php echo esc_attr( $y_range );?>" : <?php echo esc_attr( $range_two );?>}'>
    <div class="info-box <?php echo esc_attr( $animation );?> <?php echo esc_attr( $animation_effect );?>" data-wow-delay="<?php echo esc_attr( $delay );?>ms" data-wow-duration="<?php echo esc_attr( $duration );?>ms">
		<?php if( $image_icon['id'] || $info_icon ) { ?>
            <div class="info-icon-holder icon-holder">
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
            </div>
		<?php } ?>

        <div class="info-content-holder">
			<?php if ( $title ) : ?>
            <<?php echo esc_attr( $title_tag ); ?> class="info-title"><a <?php echo $attr; ?>><?php foodymat_html( $title, 'allow_title' );?></a></<?php echo esc_attr( $title_tag ); ?>>
	        <?php endif; ?>
            <?php if ( $sub_title ) : ?>
                <div class="content-holder"><p><?php foodymat_html( $sub_title, 'allow_title' );?></p></div>
            <?php endif; ?>
            <?php if ( $show_read_more_btn ) : ?>
                <div class="rt-button <?php if( $show_btn_text ) { ?>button-hover-visibility<?php } ?>">
                    <a class="btn button-2" <?php echo $attr; ?>>
                        <span class="btn-text"><?php echo esc_html( $read_more_btn_text );?></span>
                        <?php if( $show_btn_icon ) { ?><?php \Elementor\Icons_Manager::render_icon( $button_icon, [ 'aria-hidden' => 'true' ] ) ; ?><?php } ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>