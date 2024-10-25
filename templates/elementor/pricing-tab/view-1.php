<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * @var $monthly_text               string
 * @var $yearly_text                string
 * @var $feature_lists              string
 * @var $note_display               string
 * @var $button_icon                string
 * @var $note_desc                  string
 * @var $title_tag                  string
 * @var $animation                  string
 * @var $animation_effect           string
 * @var $delay                      string
 * @var $duration                   string
 */

use Elementor\Icons_Manager;

?>

<div class="rt-pricing-tab">
    <div class="price-switch-box price-switch-box--active">
        <span class="pack-name"><?php echo esc_html($monthly_text) ?></span>
        <div class="pricing-switch-container">
            <div class="pricing-switch pricing-switch-active"></div>
            <div class="pricing-switch"></div>
            <div class="switch-button"></div>
        </div>
        <span class="pack-name"><?php echo esc_html($yearly_text) ?></span>
    </div>
    <div class="row g-4 justify-content-center">
        <?php $ade = $delay; $adu = $duration;
        foreach ( $feature_lists as $feature_list ) :
            $attr = '';
            if ( !empty( $feature_list['link']['url'] ) ) {
                $attr  = 'href="' . $feature_list['link']['url'] . '"';
                $attr .= !empty( $feature_list['link']['is_external'] ) ? ' target="_blank"' : '';
                $attr .= !empty( $feature_list['link']['nofollow'] ) ? ' rel="nofollow"' : '';
            }
            ?>
            <div class="col-xl-4 col-md-6 <?php echo esc_attr( $animation );?> <?php echo esc_attr( $animation_effect );?>" data-wow-delay="<?php echo esc_attr( $ade );?>ms" data-wow-duration="<?php echo esc_attr( $adu );?>ms">
                <div class="rt-price-tab-box">
	                <?php if($feature_list['is_featured'] == 'is-featured') { ?>
                        <div class="is-featured">
                            <span><?php echo esc_html( $feature_list['featured_text'] ); ?></span>
                        </div>
	                <?php } ?>
                    <div class="price-header">
                        <<?php echo esc_attr( $title_tag ) ?> class="rt-title"><?php echo esc_html( $feature_list['title'] ); ?></<?php echo esc_attr( $title_tag ) ?>>
	                    <?php if( $feature_list['is_subtitle'] == 'is-subtitle' && $feature_list['subtitle']) { ?>
                            <div class="sub-title">
			                    <?php echo esc_html($feature_list['subtitle']); ?>
                            </div>
	                    <?php } ?>
                        <div class="price-wrap">
                            <div class="price-box price-box-show">
                                <span class="price"><?php echo esc_html($feature_list['month_price']) ?></span>
                                <span class="seperator">/</span>
                                <span class="period"><?php echo esc_html($feature_list['month_unit']) ?></span>
                            </div>
                            <div class="price-box price-box-hide">
                                <span class="price"><?php echo esc_html($feature_list['year_price']) ?></span>
                                <span class="seperator">/</span>
                                <span class="period"><?php echo esc_html($feature_list['year_unit']) ?></span>
                            </div>
                        </div>

                    </div>

                    <div class="feature-lists"><?php echo wp_kses_post( $feature_list['text'] ); ?></div>

                    <div class="rt-button">
                        <a class="btn button-2" <?php echo $attr; ?>>
	                        <?php echo esc_html( $feature_list['btn_text'] );?><?php Icons_Manager::render_icon( $button_icon ); ?>
                        </a>
                    </div>
                </div>
            </div>
        <?php $ade = $ade + 200; $adu = $adu + 0; endforeach; ?>
    </div>
	<?php if( $note_display == 'yes' && $note_desc ) { ?><div class="price-note"><?php echo esc_html( $note_desc );?></div><?php } ?>
</div>