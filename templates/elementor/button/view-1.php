<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * @var $button_style       string
 * @var $button_icon        string
 * @var $animation          string
 * @var $animation_effect   string
 * @var $delay              string
 * @var $duration           string
 * @var $icon_position      string
 *
 */

$attr = '';
if ( !empty( $link['url'] ) ) {
	$attr  = 'href="' . $link['url'] . '"';
	$attr .= !empty( $link['is_external'] ) ? ' target="_blank"' : '';
	$attr .= !empty( $link['nofollow'] ) ? ' rel="nofollow"' : '';
}

?>

<div class="rt-button <?php echo esc_attr( $animation );?> <?php echo esc_attr( $animation_effect );?>" data-wow-delay="<?php echo esc_attr( $delay );?>ms" data-wow-duration="<?php echo esc_attr( $duration );?>ms">
	<?php if( !empty( $button_text ) ) { ?>
        <a class="btn button-<?php echo esc_attr( $button_style ); ?> <?php if( !empty( $icon_position ) ) { ?><?php echo esc_attr( $icon_position ); ?><?php } ?>" <?php echo $attr; ?> aria-label="button link">
			<?php echo esc_html( $button_text );?><?php if( $button_icon ) { ?><?php \Elementor\Icons_Manager::render_icon( $button_icon ); ?><?php } ?>
        </a>
	<?php } ?>
</div>