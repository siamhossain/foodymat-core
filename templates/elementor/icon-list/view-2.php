<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * @var $title                  string
 * @var $list                   string
 * @var $icon_display           string
 * @var $arrow_icon_display     string
 * @var $animation              string
 * @var $animation_effect       string
 * @var $delay                  string
 * @var $duration               string
 * @var $icon_list_style        string
 */

use Elementor\Icons_Manager;

if( ! empty($arrow_icon_display == 'yes') ) {
	$icon_right = 'right-arrow-icon';
} else {
	$icon_right = 'no-icon';
}

?>

<div class="rt-icon-list rt-icon-list-<?php echo esc_attr($icon_list_style); ?>">
    <ol class="list-items <?php echo esc_attr( $icon_right ); ?>">
		<?php $ade = $delay; $adu = $duration;
		foreach($list as $item) {
			$attr = '';
			if ( !empty( $item['url']['url'] ) ) {
				$attr  = 'href="' . $item['url']['url'] . '"';
				$attr .= !empty( $item['url']['is_external'] ) ? ' target="_blank"' : '';
				$attr .= !empty( $item['url']['nofollow'] ) ? ' rel="nofollow"' : '';
			}

			?>
            <li class="icon-list elementor-repeater-item-<?php echo esc_attr($item['_id']) ?> <?php echo esc_attr( $animation );?> <?php echo esc_attr( $animation_effect );?>" data-wow-delay="<?php echo esc_attr( $ade );?>ms" data-wow-duration="<?php echo esc_attr( $adu );?>ms">
                <a class="title-link" <?php echo $attr; ?>>
					<?php if( $icon_display == 'yes' ) { ?><?php Icons_Manager::render_icon( $item['list_icon'] ); ?><?php } ?>
                    <span><?php echo foodymat_html( $item['title'], 'allow_title' );?></span>
                </a>
            </li>
			<?php $ade = $ade + 200; $adu = $adu + 0; } ?>
    </ol>
</div>