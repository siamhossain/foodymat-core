<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * @var $countdown_date     string
 * @var $show_days          string
 * @var $show_hours         string
 * @var $show_minutes       string
 * @var $duration           string
 * @var $show_seconds       string
 * @var $countdown_title       string
 * @var $countdown_subtitle       string
 * @var $countdown_offer_text       string
 * @var $show_seconds       string
 *
 */
	



?>
<div class="countdown-layout-1">
    <div class="title-area">
        <?php if ($countdown_title ) { ?>
            <h2 class="title"><?php echo esc_html($countdown_title); ?></h2>
        <?php }  if ($countdown_subtitle ) { ?>
            <p class="subtitle"><?php echo esc_html($countdown_subtitle); ?></p>
	    <?php } if ($countdown_offer_text ) { ?>
        <h3 class="offer-text"><?php echo esc_html($countdown_offer_text); ?></h3>
	    <?php } ?>
    </div>
    
    <div class="countdown-container">
        <ul>
            <li class="">
                <div class="number timer timer-days" style="display: <?php echo $show_days ? 'flex' : 'none'; ?>;">0</div>
                <div class="label">Days</div>
            </li>
            <li class="">
                <div class="number timer timer-hours" style="display: <?php echo $show_hours ? 'flex' : 'none'; ?>;">0</div>
                <div class="label">Hours</div>
            </li>
            <li class="">
                <div class="number timer timer-minutes" style="display: <?php echo $show_minutes ? 'flex' : 'none'; ?>;">0</div>
                <div class="label">Minutes</div>
            </li>
            <li class="">
                <div class="number timer timer-seconds" style="display: <?php echo $show_seconds ? 'flex' : 'none'; ?>;">0</div>
                <div class="label">Seconds</div>
            </li>
        </ul>
    </div>
    <input type="hidden" id="elementorCountdownDate" value="<?php echo esc_attr($countdown_date); ?>">
</div>
