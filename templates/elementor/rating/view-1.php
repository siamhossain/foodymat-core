<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * @var $number         string
 * @var $label          string
 * @var $rating         string
 *
 */

?>

<div class="rt-rating-layout">
	<div class="rt-rating-box">
        <div class="rating-number"><?php echo esc_html( $number ); ?></div>
        <div class="rating-wrap">
            <ul class="item-rating">
                <?php for ( $i=0; $i <=4 ; $i++ ) {
                    if ( $i < $rating ) {
                        $full = 'active';
                    } else {
                        $full = 'deactive';
                    }
                    echo '<li class="has-rating"><i class="icon-rt-star '.$full.'"></i></li>';
                } ?>
            </ul>
            <span class="rating-label"><?php echo esc_html( $label ); ?></span>
        </div>
    </div>
</div>