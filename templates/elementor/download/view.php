<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * @var $title              string
 * @var $items              string
 * @var $animation          string
 * @var $animation_effect   string
 * @var $delay              string
 * @var $duration           string
 */

?>

<div class="download-list">
	<?php $ade = $delay; $adu = $duration;
    foreach ( $items as $item ):
		$attr = '';
		if ( !empty( $item['link']['url'] ) ) {
			$attr  = 'href="' . $item['link']['url'] . '"';
			$attr .= !empty( $item['link']['is_external'] ) ? ' target="_blank"' : '';
			$attr .= !empty( $item['link']['nofollow'] ) ? ' rel="nofollow"' : '';
		}
		?>
		<?php if ( empty( $item['title'] ) ) continue; ?>

        <div class="item-list <?php echo esc_attr( $animation );?> <?php echo esc_attr( $animation_effect );?>" data-wow-delay="<?php echo esc_attr( $ade );?>ms" data-wow-duration="<?php echo esc_attr( $adu );?>ms">
            <a class="download-link" download <?php echo $attr; ?>>
                <span class="text"><?php \Elementor\Icons_Manager::render_icon( $item['list_icon'] ) ; ?><?php foodymat_html( $item['title'], 'allow_title' );?></span>
                <span class="icon"><i class="icon-rt-download"></i></span>
            </a>
        </div>
	<?php $ade = $ade + 200; $adu = $adu + 0; endforeach; ?>
</div>