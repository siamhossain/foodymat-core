<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * @var $heading_tag                string
 * @var $marquee_direction          string
 * @var $icon_type                  string
 * @var $bgicon                     string
 * @var $image                      string
 * @var $items                      string
 * @var $gradient_display           string
 * @var $animation                  string
 * @var $animation_effect           string
 * @var $delay                      string
 * @var $duration                   string
 */
use Elementor\Icons_Manager;

?>
<div class="rt-marquee-slider">
    <div class="rt-marquee <?php echo esc_attr( $marquee_direction );?>">
        <div class="rt-marquee-item">
	        <?php $ade = $delay; $adu = $duration; foreach ( $items as $item ) :
			$attr = '';
			if ( !empty( $item['url']['url'] ) ) {
				$attr  = 'href="' . $item['url']['url'] . '"';
				$attr .= !empty( $item['url']['is_external'] ) ? ' target="_blank"' : '';
				$attr .= !empty( $item['url']['nofollow'] ) ? ' rel="nofollow"' : '';
				$title = '<a ' . $attr . '>' . $item['title'] . '</a>';
			} else {
				$title = $item['title'];
			}
			?>
            <<?php echo esc_attr( $heading_tag ); ?> class="entry-title <?php if( $gradient_display == 'yes' ) { ?>title-gradient<?php } ?> <?php echo esc_attr( $animation );?> <?php echo esc_attr( $animation_effect );?>" data-per="<?php foodymat_html( $item['title'], 'allow_title' );?>" data-wow-delay="<?php echo esc_attr( $ade );?>ms" data-wow-duration="<?php echo esc_attr( $adu );?>ms">
	        <?php foodymat_html( $title, 'allow_title' ); ?>
            <?php  if('icon' == $icon_type || 'image' == $icon_type) : ?>
                <span class="icon-holder">
			        <?php
			        if('icon' == $icon_type) {
				        Icons_Manager::render_icon( $bgicon );
			        } elseif ('image' == $icon_type) {
				        echo wp_get_attachment_image( $image['id'], 'full' );
			        }
			        ?>
                </span>
	        <?php endif; ?>
            </<?php echo esc_attr( $heading_tag ); ?>>
		    <?php $ade = $ade + 200; $adu = $adu + 0; endforeach; ?>
        </div>
        <div class="rt-marquee-item">
            <?php $ade = $delay; $adu = $duration; foreach ( $items as $item ) :
            $attr = '';
            if ( !empty( $item['url']['url'] ) ) {
                $attr  = 'href="' . $item['url']['url'] . '"';
                $attr .= !empty( $item['url']['is_external'] ) ? ' target="_blank"' : '';
                $attr .= !empty( $item['url']['nofollow'] ) ? ' rel="nofollow"' : '';
                $title = '<a ' . $attr . '>' . $item['title'] . '</a>';
            } else {
                $title = $item['title'];
            }
            ?>
            <<?php echo esc_attr( $heading_tag ); ?> class="entry-title <?php if( $gradient_display == 'yes' ) { ?>title-gradient<?php } ?> <?php echo esc_attr( $animation );?> <?php echo esc_attr( $animation_effect );?>" data-per="<?php foodymat_html( $item['title'], 'allow_title' );?>" data-wow-delay="<?php echo esc_attr( $ade );?>ms" data-wow-duration="<?php echo esc_attr( $adu );?>ms">
	        <?php foodymat_html( $title, 'allow_title' );?>
            <?php  if('icon' == $icon_type || 'image' == $icon_type) : ?>
                <span class="icon-holder">
                    <?php
                    if('icon' == $icon_type) {
                        Icons_Manager::render_icon( $bgicon );
                    } elseif ('image' == $icon_type) {
                        echo wp_get_attachment_image( $image['id'], 'full' );
                    }
                    ?>
                </span>
            <?php endif; ?>
            </<?php echo esc_attr( $heading_tag ); ?>>
            <?php $ade = $ade + 200; $adu = $adu + 0; endforeach; ?>
        </div>
    </div>
</div>