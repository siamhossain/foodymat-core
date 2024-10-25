<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * @var $layout             string
 * @var $lists              string
 * @var $icon_type          string
 * @var $tab_icon           string
 * @var $animation          string
 * @var $animation_effect   string
 * @var $delay              string
 * @var $duration           string
 */


?>

<div class="rt-tab-block rt-tab-<?php echo esc_attr( $layout ); ?>">
    <div class="tab-block <?php echo esc_attr( $animation );?> <?php echo esc_attr( $animation_effect );?>" data-wow-delay="<?php echo esc_attr( $delay );?>ms" data-wow-duration="<?php echo esc_attr( $duration );?>ms">
        <ul class="tab-block-tabs">
            <?php foreach ( $lists as $i => $item ) {
                $active = $i == 0 ? 'is-active' : ''; ?>
                <li class="tab-block-tab <?php echo esc_attr( $active ) ?>"><?php if('icon' == $item['icon_type']) { ?><?php \Elementor\Icons_Manager::render_icon( $item['tab_icon'] ); } ?><?php echo foodymat_html( $item['title'], 'allow_title' ); ?></li>
            <?php } ?>
        </ul>
        <div class="tab-block-content">
            <?php foreach ( $lists as $i => $item ) { ?>
                <div class="tab-block-pane">
                    <?php echo foodymat_html( $item['content'], false ); ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>