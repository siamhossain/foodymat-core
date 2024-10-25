<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * @var $gallery                        string
 * @var $thumbnail_size                 string
 * @var $gallery_link                   string
 * @var $open_lightbox                  string
 * @var $item_space                     string
 * @var $gallery_masonry                string
 * @var $gallery_display_caption        string
 * @var $icon_display                   string
 * @var $button_icon                    string
 * @var $col_xl                         string
 * @var $col_lg                         string
 * @var $col_md                         string
 * @var $col_sm                         string
 * @var $col_xs                         string
 * @var $animation          string
 * @var $animation_effect   string
 * @var $delay              string
 * @var $duration           string
 *
 */

use Elementor\Icons_Manager;

$col_class = "col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-xs-{$col_xs}";

?>
<div class="rt-image-gallery">
    <div class="row <?php echo esc_attr( $gallery_masonry );?> <?php echo esc_attr( $item_space );?>">
        <?php $ade = $delay; $adu = $duration;
        foreach ( $gallery as $image ) { ?>
        <div class="<?php echo esc_attr( $col_class );?> rt-grid-item">
            <div class="rt-gallery-item <?php echo esc_attr( $animation );?> <?php echo esc_attr( $animation_effect );?>" data-wow-delay="<?php echo esc_attr( $ade );?>ms" data-wow-duration="<?php echo esc_attr( $adu );?>ms">
                <?php if( $gallery_link == 'file' ) { ?>
                <a style="line-height: 0; display: block" class="image-link" href="<?php echo wp_get_attachment_url( $image['id'] ); ?>"
                    <?php if( $open_lightbox == 'yes' ) { ?>
                   data-elementor-open-lightbox="yes"
                   data-elementor-lightbox-slideshow="1"
                   data-elementor-lightbox-title="<?php echo get_the_title($image['id'] ); ?>" <?php } ?> >
                <?php } ?>

                <?php echo wp_get_attachment_image( $image['id'], $thumbnail_size ); ?>

                <?php if( $icon_display == 'yes' ) { ?><?php Icons_Manager::render_icon( $button_icon ); ?><?php } ?>

                <?php if( $gallery_link == 'file' ) { ?>
                </a>
                <?php } ?>
	            <?php if( $gallery_display_caption == '' ) { ?>
                <div class="rt-caption-text rt-gallery-caption"><?php echo wp_get_attachment_caption($image['id']); ?></div>
	            <?php } ?>
            </div>
        </div>
        <?php $ade = $ade + 200; $adu = $adu + 0; } ?>
    </div>
</div>