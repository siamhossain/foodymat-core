<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\FoodymatCore\Modules;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use RT\Foodymat\Helpers\Fns;
use RT\FoodymatCore\Traits\SingletonTraits;

class WidgetOverwrite {
	use SingletonTraits;

	/**
	 * register default hooks and actions for WordPress
	 *
	 * @return
	 */
	public function __construct() {
		//Add input fields(priority 5, 3 parameters)
		add_action( 'in_widget_form', [ $this, 'foodymat_in_widget_form' ], 5,
			3 );
		//Callback function for options update (priorität 5, 3 parameters)
		add_filter( 'widget_update_callback',
			[ $this, 'foodymat_in_widget_form_update' ], 5, 3 );
		//add class names (default priority, one parameter)
		add_filter( 'dynamic_sidebar_params',
			[ $this, 'foodymat_dynamic_sidebar_params' ] );
	}

	function foodymat_in_widget_form( $t, $return, $instance ) {
		$instance = wp_parse_args( (array) $instance,
			[ 'widget_lg_cols' => '', 'widget_xl_cols' => '' ] );
		if ( ! isset( $instance['widget_xl_cols'] ) ) {
			$instance['widget_xl_cols'] = null;
		}
		if ( ! isset( $instance['widget_lg_cols'] ) ) {
			$instance['widget_lg_cols'] = null;
		}
		?>
        <div class="rt-widget-custom-cols">
            <label for="<?php echo $t->get_field_id( 'widget_xl_cols' ); ?>"><?php echo esc_html__( 'Column:',
					'foodymat' ) ?></label>
            <div class="widget-cols"
                 style="display:flex;gap:15px;margin-bottom:5px;">
                <select id="<?php echo $t->get_field_id( 'widget_xl_cols' ); ?>"
                        name="<?php echo $t->get_field_name( 'widget_xl_cols' ); ?>">
                    <option value=""><?php echo esc_html__( '-- Extra Large Columns --',
							'foodymat' ); ?></option>
                    <option <?php selected( $instance['widget_xl_cols'],
						'col-xl-2' ); ?>
                            value="col-xl-2"><?php echo esc_html__( 'col-xl-2',
							'foodymat' ); ?></option>
                    <option <?php selected( $instance['widget_xl_cols'],
						'col-xl-3' ); ?>
                            value="col-xl-3"><?php echo esc_html__( 'col-xl-3',
							'foodymat' ); ?></option>
                    <option <?php selected( $instance['widget_xl_cols'],
						'col-xl-4' ); ?>
                            value="col-xl-4"><?php echo esc_html__( 'col-xl-4',
							'foodymat' ); ?></option>
                    <option <?php selected( $instance['widget_xl_cols'],
						'col-xl-5' ); ?>
                            value="col-xl-5"><?php echo esc_html__( 'col-xl-5',
							'foodymat' ); ?></option>
                    <option <?php selected( $instance['widget_xl_cols'],
						'col-xl-6' ); ?>
                            value="col-xl-6"><?php echo esc_html__( 'col-xl-6',
							'foodymat' ); ?></option>
                    <option <?php selected( $instance['widget_xl_cols'],
						'col-xl-7' ); ?>
                            value="col-xl-7"><?php echo esc_html__( 'col-xl-7',
							'foodymat' ); ?></option>
                    <option <?php selected( $instance['widget_xl_cols'],
						'col-xl-8' ); ?>
                            value="col-xl-8"><?php echo esc_html__( 'col-xl-8',
							'foodymat' ); ?></option>
                </select>

                <select id="<?php echo $t->get_field_id( 'widget_lg_cols' ); ?>"
                        name="<?php echo $t->get_field_name( 'widget_lg_cols' ); ?>">
                    <option value=""><?php echo esc_html__( '-- Large Columns --',
							'foodymat' ); ?></option>
                    <option <?php selected( $instance['widget_lg_cols'],
						'col-lg-2' ); ?>
                            value="col-lg-2"><?php echo esc_html__( 'col-lg-2',
							'foodymat' ); ?></option>
                    <option <?php selected( $instance['widget_lg_cols'],
						'col-lg-3' ); ?>
                            value="col-lg-3"><?php echo esc_html__( 'col-lg-3',
							'foodymat' ); ?></option>
                    <option <?php selected( $instance['widget_lg_cols'],
						'col-lg-4' ); ?>
                            value="col-lg-4"><?php echo esc_html__( 'col-lg-4',
							'foodymat' ); ?></option>
                    <option <?php selected( $instance['widget_lg_cols'],
						'col-lg-5' ); ?>
                            value="col-lg-5"><?php echo esc_html__( 'col-lg-5',
							'foodymat' ); ?></option>
                    <option <?php selected( $instance['widget_lg_cols'],
						'col-lg-6' ); ?>
                            value="col-lg-6"><?php echo esc_html__( 'col-lg-6',
							'foodymat' ); ?></option>
                    <option <?php selected( $instance['widget_lg_cols'],
						'col-lg-7' ); ?>
                            value="col-lg-7"><?php echo esc_html__( 'col-lg-7',
							'foodymat' ); ?></option>
                    <option <?php selected( $instance['widget_lg_cols'],
						'col-lg-8' ); ?>
                            value="col-lg-8"><?php echo esc_html__( 'col-lg-8',
							'foodymat' ); ?></option>
                </select>
            </div>
            <small><?php echo esc_html__( 'Column option works only for the footer widgets.',
					'foodymat' ); ?></small>
        </div>
        <style>
            .rt-widget-custom-cols {
                display: none;
            }

            [data-widget-area-id="<?php echo esc_attr(Fns::default_sidebar('footer')) ?>"] .rt-widget-custom-cols {
                display: block !important;
            }
        </style>
		<?php
		$retrun = null;

		return [ $t, $return, $instance ];
	}

	function foodymat_in_widget_form_update(
		$instance, $new_instance, $old_instance
	) {
		$instance['widget_xl_cols'] = $new_instance['widget_xl_cols'] ?? '';
		$instance['widget_lg_cols'] = $new_instance['widget_lg_cols'] ?? '';

		return $instance;
	}

	function foodymat_dynamic_sidebar_params( $params ) {
		global $wp_registered_widgets;
		$widget_id           = $params[0]['widget_id'];
		$widget_obj          = $wp_registered_widgets[ $widget_id ];
		$widget_opt
		                     = get_option( $widget_obj['callback'][0]->option_name );
		$widget_num          = $widget_obj['params'][0]['number'];
		$widget_before       = $params[0]['before_widget'];
		$widgets_custom_cols = '';

		if ( isset( $widget_opt[ $widget_num ]['widget_xl_cols'] )
		     || isset( $widget_opt[ $widget_num ]['widget_lg_cols'] )
		) {
			if ( ! empty( $widget_opt[ $widget_num ]['widget_xl_cols'] ) ) {
				$widgets_custom_cols .= $widget_opt[ $widget_num ]['widget_xl_cols'];
			} else {
				$widgets_custom_cols .= '';
			}

			if ( ! empty( $widget_opt[ $widget_num ]['widget_lg_cols'] ) ) {
				$widget_before       = str_replace( 'col-lg-', 'collg',
					$widget_before );
				$widgets_custom_cols .= ' '
				                        . $widget_opt[ $widget_num ]['widget_lg_cols'];
			} else {
				$widgets_custom_cols .= '';
			}
			$params[0]['before_widget'] = preg_replace( '/class="/',
				'class="' . $widgets_custom_cols . ' ', $widget_before, 1 );
		}

		return $params;
	}
}
