<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * @var $list                   string
 * @var $animation              string
 * @var $animation_effect       string
 * @var $delay                  string
 * @var $duration               string
 */


?>

<div class="rt-opening-hour">
    <ul class="opening-items">
		<?php $ade = $delay; $adu = $duration;
		foreach($list as $item) { ?>
        <li class="opening-list elementor-repeater-item-<?php echo esc_attr($item['_id']) ?> <?php echo esc_attr( $animation );?> <?php echo esc_attr( $animation_effect );?>" data-wow-delay="<?php echo esc_attr( $ade );?>ms" data-wow-duration="<?php echo esc_attr( $adu );?>ms">
            <?php if( $item['day'] ) { ?><span class="opening-day"><?php echo foodymat_html( $item['day'], 'allow_title' );?></span><?php } ?>
            <?php if( $item['hour'] ) { ?><span class="opening-hour"><?php echo foodymat_html( $item['hour'], 'allow_title' );?></span><?php } ?>
        </li>
        <?php $ade = $ade + 200; $adu = $adu + 0; } ?>
    </ul>
</div>