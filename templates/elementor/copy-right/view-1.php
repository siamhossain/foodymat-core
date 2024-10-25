<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * @var $layout                 string
 * @var $copyright_text         string
 */

?>

<?php if( $layout  == 'default' ) { ?>
	<div class="copyright-text">
		<?php foodymat_html( str_replace( '[y]', date( 'Y' ), foodymat_option( 'rt_footer_copyright' ) ) ); ?>
	</div>
	<?php } if( $layout  == 'custom' ) { ?>
    <div class="copyright-text">
		<?php foodymat_html( $copyright_text, 'allow_title' ); ?>
    </div>
    <?php } ?>
<?php