<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * @var $layout                     string
 * @var $zindex                     string
 */

?>

<div class="rt-blur-shape rt-blur-shape-<?php echo esc_attr( $layout ) ?>">

    <?php if( $layout == 'layout-1' ) { ?>
    <ul class="rt-shape">
        <li class="shape shape1" style="z-index: <?php echo esc_attr( $zindex ); ?>"></li>
    </ul>
    <?php } ?>

    <?php if( $layout == 'layout-2' ) { ?>
        <ul class="rt-shape">
            <li class="shape shape1" style="z-index: <?php echo esc_attr( $zindex ); ?>"></li>
            <li class="shape shape2" style="z-index: <?php echo esc_attr( $zindex ); ?>"></li>
        </ul>
    <?php } ?>

	<?php if( $layout == 'layout-3' ) { ?>
        <ul class="rt-shape">
            <li class="shape shape1" style="z-index: <?php echo esc_attr( $zindex ); ?>"></li>
            <li class="shape shape2" style="z-index: <?php echo esc_attr( $zindex ); ?>"></li>
            <li class="shape shape3" style="z-index: <?php echo esc_attr( $zindex ); ?>"></li>
        </ul>
	<?php } ?>

</div>