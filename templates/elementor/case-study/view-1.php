<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * @var $layout                 string
 * @var $list_items             string
 * @var $animation              string
 * @var $animation_effect       string
 * @var $delay                  string
 * @var $duration               string
 * @var $title_tag              string
 * @var $count_display          string
 * @var $info_display           string
 * @var $read_more_display      string
 * @var $project_thumbnail_size string
 */

use Elementor\Icons_Manager;

$thumb_size = '';
if( $project_thumbnail_size ) {
	$thumb_size = $project_thumbnail_size;
} else {
	$thumb_size = 'foodymat-size4';
}
?>

<div class="rt-case-study case-study-<?php echo esc_attr( $layout );?>">
    <div class="case-item">
	    <?php $ade = $delay; $adu = $duration;
        foreach( $list_items as $item ) {
            $attr = '';
            if ( !empty( $item['url']['url'] ) ) {
                $attr  = 'href="' . $item['url']['url'] . '"';
                $attr .= !empty( $item['url']['is_external'] ) ? ' target="_blank"' : '';
                $attr .= !empty( $item['url']['nofollow'] ) ? ' rel="nofollow"' : '';
                $attr .= ' aria-label="info link"';
            }
            ?>
            <div class="list-item <?php echo esc_attr( $animation );?> <?php echo esc_attr( $animation_effect );?>" data-wow-delay="<?php echo esc_attr( $ade );?>ms" data-wow-duration="<?php echo esc_attr( $adu );?>ms">
                <div class="content-wrap">
	                <?php if( ( $count_display == 'yes') && $item['count_title'] ) { ?><div class="rt-number"><?php echo foodymat_html( $item['count_title'], 'allow_title' );?></div><?php } ?>
                    <div class="content-info">
                        <?php if( $item['title'] ) { ?><<?php echo esc_attr( $title_tag ); ?> class="rt-title"><a class="link" <?php echo $attr; ?>><?php echo foodymat_html( $item['title'], 'allow_title' );?></a></<?php echo esc_attr( $title_tag ); ?>><?php } ?>
                        <?php if( $item['content'] ) { ?><div class="rt-content"><?php echo foodymat_html( $item['content'], 'allow_title' );?></div><?php } ?>
	                    <?php if( $info_display == 'yes' ) { ?>
                        <ul class="case-info">
                            <?php if( $item['clients'] ) { ?><li><label><?php esc_html_e('Clients: ', 'foodymat-core') ?></label><?php echo foodymat_html( $item['clients'], 'allow_title' );?></li><?php } ?>
                            <?php if( $item['date'] ) { ?><li><label><?php esc_html_e('Date: ', 'foodymat-core') ?></label><?php echo foodymat_html( $item['date'], 'allow_title' );?></li><?php } ?>
                            <?php if( $item['category'] ) { ?><li><label><?php esc_html_e('Category: ', 'foodymat-core') ?></label><?php echo foodymat_html( $item['category'], 'allow_title' );?></li><?php } ?>
                            <?php if( $item['team'] ) { ?><li><label><?php esc_html_e('Team: ', 'foodymat-core') ?></label><?php echo foodymat_html( $item['team'], 'allow_title' );?></li><?php } ?>
                        </ul>
	                    <?php } ?>
                    </div>
                </div>
	            <?php if( $read_more_display == 'yes' ) { ?>
                    <div class="rt-button"><a class="btn button-2" <?php echo $attr; ?>><?php Icons_Manager::render_icon( $item['list_icon'] ); ?></a></div>
	            <?php } ?>
                <?php if( !empty( $item['image']['id'] ) ) { ?>
                <div class="service-img">
                    <?php echo wp_get_attachment_image( $item['image']['id'], $thumb_size ); ?>
                </div>
                <?php } ?>
            </div>
        <?php $ade = $ade + 200; $adu = $adu + 0; } ?>
    </div>
</div>