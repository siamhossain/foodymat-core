<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\FoodymatCore\Elementor\Controls;

use Elementor\Base_Data_Control;

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

class Select2AjaxControl extends Base_Data_Control {

	/**
	 * Set control name.
	 *
	 * @var string
	 */
	public static $controlName = 'rt-select2';

	public function get_type() {
		return self::$controlName;
	}

	public function enqueue() {
		wp_enqueue_script( 'foodymat-editor-script' );
		wp_localize_script(
			'foodymat-editor-script',
			'rtSelect2Obj',
			[
				'ajaxurl'     => esc_url( admin_url( 'admin-ajax.php' ) ),
				'search_text' => esc_html__( 'Please Select', 'foodymat-core' ),
			]
		);
		?>
        <style>
            .rt-select2-main-wrapper ul.select2-selection__rendered li:last-child {
                pointer-events: none;
            }

            .rt-select2-main-wrapper ul.select2-selection__rendered li:last-child::before {
                background: var(--e-a-btn-bg);
                content: '+';
                padding: 1px 5px;
                position: relative;
                top: 1px;
                margin-right: 5px;
                color: #fff;
            }

            .rt-select2-main-wrapper ul.select2-selection__rendered li[title=search] {
                display: none;
            }
        </style>
		<?php
	}

	protected function get_default_settings() {
		return [
			'multiple'                 => false,
			'label_block'              => true,
			'source_name'              => 'post_type',
			'source_type'              => 'post',
			'minimum_input_length'     => 3,
			'maximum_selection_length' => - 1,
		];
	}

	public function content_template() {
		$control_uid = $this->get_control_uid();
		?>

        <# var controlUID = '<?php echo esc_html( $control_uid ); ?>'; #>
        <# var currentID = elementor.panel.currentView.currentPageView.model.attributes.settings.attributes[data.name]; #>
        <# var maxSelection = (data.maximum_selection_length > 0) ? 'max-select'+data.maximum_selection_length : 'unlimited-select' #>
        <div class="elementor-control-field rt-select2-main-wrapper {{maxSelection}}">
            <# if ( data.label ) { #>
            <label for="<?php echo esc_attr( $control_uid ); ?>" class="elementor-control-title">{{{data.label }}}</label>
            <# } #>
            <div class="elementor-control-input-wrapper elementor-control-unit-5">
                <# var multiple = ( data.multiple ) ? 'multiple' : ''; #>
                <select id="<?php echo esc_attr( $control_uid ); ?>" {{ multiple }} class="rt-select2" data-setting="{{ data.name }}"></select>
            </div>
            <# if ( data.description ) { #>
            <div class="elementor-control-field-description rtsb-description">{{{ data.description }}}</div>
            <# } #>
        </div>
        <#
        ( function( $ ) {
        $( document.body ).trigger( 'rt_select2_event',{currentID:data.controlValue,data:data,controlUID:controlUID,multiple:data.multiple} );
        }( jQuery ) );
        #>
		<?php
	}
}
