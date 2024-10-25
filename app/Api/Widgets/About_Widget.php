<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\FoodymatCore\Api\Widgets;

use \WP_Widget;
use \RT_Widget_Fields;

class About_Widget extends WP_Widget {

	public function __construct() {
		$id    = FOODYMAT_CORE_PREFIX . '_about';
		$title = __( 'Foodymat: About', 'foodymat-core' );
		$args  = [
			'description' => __( 'Displays About Info', 'foodymat-core' ),
		];
		parent::__construct( $id, $title, $args );
	}

	public function widget( $args, $instance ){
		echo wp_kses_post( $args['before_widget'] );
		if ( !empty( $instance['title'] ) ) {
			$html = apply_filters( 'widget_title', $instance['title'] );
			echo $html = $args['before_title'] . $html .$args['after_title'];
		}
		else {
			$html = '';
		}

		?>

		<div class="about-widget">
            <?php if ( ! empty( $instance['logo'] ) ) { ?>
                <div class="footer-widget-logo">
                    <?php echo wp_get_attachment_image( $instance['logo'], 'full' ); ?>
                </div>
            <?php } ?>

			<?php if ( ! empty( $instance['description'] ) ) {
				echo "<p>";
				echo foodymat_html( $instance['description'] );
				echo "</p>";
			}

			foodymat_about_social( $instance ); ?>

            <?php if ( ! empty( $instance['shortcode'] ) ) {
				echo "<div class='footer-shortcode'>";
	            echo do_shortcode( $instance['shortcode'] );
				echo "</div>";
			}

            ?>

		</div>

		<?php echo wp_kses_post( $args['after_widget'] );
	}

	public function update( $new_instance, $old_instance ) {
		$instance                = [];
		$instance['title']       = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['logo']        = ( ! empty( $new_instance['logo'] ) ) ? sanitize_text_field( $new_instance['logo'] ) : '';
		$instance['description'] = ( ! empty( $new_instance['description'] ) ) ? wp_kses_post( $new_instance['description'] ) : '';
		$instance['facebook']    = ( ! empty( $new_instance['facebook'] ) ) ? sanitize_text_field( $new_instance['facebook'] ) : '';
		$instance['twitter']     = ( ! empty( $new_instance['twitter'] ) ) ? sanitize_text_field( $new_instance['twitter'] ) : '';
		$instance['linkedin']    = ( ! empty( $new_instance['linkedin'] ) ) ? sanitize_text_field( $new_instance['linkedin'] ) : '';
		$instance['pinterest']   = ( ! empty( $new_instance['pinterest'] ) ) ? sanitize_text_field( $new_instance['pinterest'] ) : '';
		$instance['instagram']   = ( ! empty( $new_instance['instagram'] ) ) ? sanitize_text_field( $new_instance['instagram'] ) : '';
		$instance['youtube']     = ( ! empty( $new_instance['youtube'] ) ) ? sanitize_text_field( $new_instance['youtube'] ) : '';
		$instance['rss']         = ( ! empty( $new_instance['rss'] ) ) ? sanitize_text_field( $new_instance['rss'] ) : '';
		$instance['tiktok']         = ( ! empty( $new_instance['tiktok'] ) ) ? sanitize_text_field( $new_instance['tiktok'] ) : '';
		$instance['shortcode']    = ( ! empty( $new_instance['shortcode'] ) ) ? sanitize_text_field( $new_instance['shortcode'] ) : '';

		return $instance;
	}

	public function form( $instance ) {
		$defaults = [
			'title'       => '',
			'logo'        => '',
			'description' => '',
			'facebook'    => '',
			'twitter'     => '',
			'linkedin'    => '',
			'pinterest'   => '',
			'instagram'   => '',
			'youtube'     => '',
			'rss'         => '',
			'tiktok'      => '',
			'shortcode'   => '',
		];
		$instance = wp_parse_args( (array) $instance, $defaults );

		$fields = [
			'title'       => [
				'label' => esc_html__( 'Title', 'foodymat-core' ),
				'type'  => 'text',
			],
			'logo'        => [
				'label' => esc_html__( 'Logo', 'foodymat-core' ),
				'type'  => 'image',
				'desc'  => esc_html__( 'Conditionally display the light or dark logo based on the chosen footer style; refrain from preselecting any logo. ', 'foodymat-core' ),
			],
			'description' => [
				'label' => esc_html__( 'Description', 'foodymat-core' ),
				'type'  => 'textarea',
			],
			'facebook'    => [
				'label' => esc_html__( 'Facebook URL', 'foodymat-core' ),
				'type'  => 'url',
			],
			'twitter'     => [
				'label' => esc_html__( 'Twitter URL', 'foodymat-core' ),
				'type'  => 'url',
			],
			'linkedin'    => [
				'label' => esc_html__( 'Linkedin URL', 'foodymat-core' ),
				'type'  => 'url',
			],
			'pinterest'   => [
				'label' => esc_html__( 'Pinterest URL', 'foodymat-core' ),
				'type'  => 'url',
			],
			'instagram'   => [
				'label' => esc_html__( 'Instagram URL', 'foodymat-core' ),
				'type'  => 'url',
			],
			'youtube'     => [
				'label' => esc_html__( 'YouTube URL', 'foodymat-core' ),
				'type'  => 'url',
			],
			'rss'         => [
				'label' => esc_html__( 'Rss Feed URL', 'foodymat-core' ),
				'type'  => 'url',
			],
			'tiktok'        => [
				'label' => esc_html__( 'TikTok URL', 'foodymat-core' ),
				'type'  => 'url',
			],
			'shortcode'    => [
				'label' => esc_html__( 'Input Shortcode', 'foodymat-core' ),
				'type'  => 'textarea',
			],
		];

		RT_Widget_Fields::display( $fields, $instance, $this );
	}

}