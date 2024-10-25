<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * @var $slider_items               string
 * @var $swiper_data                string
 * @var $arrow_hover_visibility     string
 * @var $display_arrow              string
 * @var $display_pagination         string
 * @var $slider_animation           string
 * @var $title_tag                  string
 */

$banners = array();
foreach ( $slider_items as $banner_list ) {
	$banners[] = array(
		'sub_title'         => $banner_list['sub_title'],
		'title'             => $banner_list['title'],
		'content'           => $banner_list['content'],
		'button_text'       => $banner_list['button_text'],
		'button_url'        => $banner_list['button_url']['url'],
		'img'               => $banner_list['banner_image']['url'] ? $banner_list['banner_image']['url'] : "",
	);
}
?>

<div class="rt-hero-slider">
    <div class="rt-swiper-hero-slider <?php echo esc_attr( $arrow_hover_visibility ) ?>" data-xld ="<?php echo esc_attr( $swiper_data );?>">
        <div class="swiper-wrapper <?php if( $slider_animation == 'yes' ) { ?>animation<?php } ?>">
            <?php $i = 1;
            foreach ($banners as $banner){ ?>
                <div class="swiper-slide single-slide slide-<?php echo esc_attr( $i ); ?>">
                    <div class="single-slider" data-bg-image="<?php echo esc_attr($banner['img']); ?>">
                        <div class="container">
                            <div class="content-wrap">
                                <div class="slider-content">
                                    <?php if( !empty( $banner['sub_title'] ) ) { ?>
                                        <div class="sub-title"><?php echo foodymat_html( $banner['sub_title'], 'allow_title' );?></div>
                                    <?php } if( !empty( $banner['title'] ) ) { ?>
                                        <<?php echo esc_attr( $title_tag ) ?> class="slider-title"><?php echo foodymat_html( $banner['title'], 'allow_title' );?></<?php echo esc_attr( $title_tag ) ?>>
                                    <?php } if( !empty( $banner['content'] ) ) { ?>
                                        <div class="slider-text"><?php echo foodymat_html( $banner['content'], 'allow_title' );?></div>
                                    <?php } ?>
                                    <?php if( !empty( $banner['button_text'] ) ) { ?>
                                        <div class="slider-btn-area rt-button">
                                            <a class="btn button-2" href="<?php echo esc_url( $banner['button_url'] ); ?>"><?php echo foodymat_html( $banner['button_text'], 'allow_title' );?><i class="icon-foodymat-right-arrow"></i></a>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php $i++; } ?>
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
</div>