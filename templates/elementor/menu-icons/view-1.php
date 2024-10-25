<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * @var $hamburger              string
 * @var $search                 string
 * @var $login                  string
 * @var $button                 string
 * @var $has_separator          string
 * @var $button_text            string
 * @var $button_icon            string
 * @var $login_icon             string
 * @var $log_button_text        string
 * @var $phone_layout           string
 * @var $phone                  string
 * @var $phone_icon             string
 * @var $phone_label            string
 * @var $phone_number           string
 */

$attr = '';
if ( !empty( $link['url'] ) ) {
	$attr  = 'href="' . $link['url'] . '"';
	$attr .= !empty( $link['is_external'] ) ? ' target="_blank"' : '';
	$attr .= !empty( $link['nofollow'] ) ? ' rel="nofollow"' : '';
}

$menu_classes = '';
if ( $has_separator ) {
	$menu_classes .= 'has-separator ';
}
if ( $button ) {
	$menu_classes .= 'has-button ';
}

?>
<div class="menu-icon-wrapper">
	<ul class="menu-icon-action <?php echo esc_attr( $menu_classes ) ?>">
		<?php if ( $search == 'yes' ) { ?>
			<li class="rt-search-popup">
				<a class="menu-search-bar rt-search-trigger" href="#header-search" aria-label="search popup"><i class="icon-rt-search"></i></a>
			</li>
		<?php } ?>
		<?php if ( $login == 'yes' ) { ?>
			<li class="rt-user-login rt-button">
				<a class="btn button-4" href="<?php echo esc_url( wp_login_url() ) ?>" aria-label="user login">
					<?php if( $login_icon ) { ?><?php \Elementor\Icons_Manager::render_icon( $login_icon ); ?><?php } ?><?php if ( $log_button_text ) { ?><?php echo esc_html( $log_button_text );?><?php } ?>
				</a>
			</li>
		<?php } ?>
		<?php if ( $phone == 'yes' ) { ?>
            <li class="rt-phone rt-<?php echo esc_attr( $phone_layout );?>">
                    <?php if( $phone_icon ) { ?><span class="phone-icon"><?php \Elementor\Icons_Manager::render_icon( $phone_icon ); ?></span><?php } ?>
	                <?php if ( $phone_label || $phone_number ) { ?>
                    <div class="content">
                        <?php if ( $phone_label ) { ?><span class="phone-label"><?php echo esc_html( $phone_label );?></span><?php } ?>
                        <?php if ( $phone_number ) { ?>
                        <a class="phone-number" href="tel:<?php echo esc_html( $phone_number );?>" aria-label="phone number"><?php echo esc_html( $phone_number );?></a><?php } ?>
                    </div>
	                <?php } ?>
            </li>
		<?php } ?>
		<?php if ( $button == 'yes' ) { ?>
			<li class="rt-action-button rt-button">
				<a class="btn button-2" <?php echo $attr; ?> aria-label="button link">
					<?php if ( $button_text ) { ?><?php echo esc_html( $button_text );?><?php } ?><?php if( $button_icon ) { ?><?php \Elementor\Icons_Manager::render_icon( $button_icon ); ?><?php } ?>
				</a>
			</li>
		<?php } ?>
		<?php if ( $hamburger == 'yes' ) { ?>
			<?php foodymat_hanburger( 'desktop-hamburg' ); ?>
		<?php } ?>

		<?php foodymat_hanburger( 'mobile-hamburg' ); ?>
	</ul>
</div>