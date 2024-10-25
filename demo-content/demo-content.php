<?php
/**
 * OCDI Demo importer configuration.
 *
 * @package RT\FoodymatCore
 */

use FluentForm\App\Models\Form;
use FluentForm\App\Models\FormMeta;
use FluentForm\Framework\Support\Arr;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * OCDI Demo importer configuration.
 */
class RTDemoimport {
	/**
	 * CLass constructor.
	 */
	public function __construct() {
		// Action Hooks.
		add_action( 'admin_enqueue_scripts', [ $this, 'custom_admin_css' ] );
		add_action( 'ocdi/after_import', [ $this, 'after_import_actions' ] );

		// Filter Hooks.
		add_filter( 'ocdi/import_files', [ $this, 'import_files' ] );
		add_filter( 'ocdi/plugin_page_setup', [ $this, 'import_page_setup' ] );
		add_filter( 'ocdi/plugin_intro_text', [ $this, 'intro_text' ] );
	}

	/**
	 * Demo contains file loading methods
	 *
	 * @return array
	 */
	public function import_files() {

		$demos_array = array(
			'demo1' => array(
				'title'             => __( 'Finance Consultancy', 'foodymat-core' ),
				'page'              => __( 'Home 01', 'foodymat-core' ),
				'categories'        => [ 'Finance' ],
				'screenshot'        => RDTHEME_CORE_BASE_URL . 'screenshots/1.png',
				'preview_link'      => 'https://radiustheme.com/demo/wordpress/themes/foodymat/',
			),
			'demo2' => array(
				'title'             => __( 'Finance Software', 'foodymat-core' ),
				'page'              => __( 'Home 02', 'foodymat-core' ),
				'categories'        => [ 'Business' ],
				'screenshot'        => RDTHEME_CORE_BASE_URL . 'screenshots/2.png',
				'preview_link'      => 'https://radiustheme.com/demo/wordpress/themes/foodymat/home-02/',
			),
			'demo3' => array(
				'title'             => __( 'Online Banking', 'foodymat-core' ),
				'page'              => __( 'Home 03', 'foodymat-core' ),
				'categories'        => [ 'Business' ],
				'screenshot'        => RDTHEME_CORE_BASE_URL . 'screenshots/3.png',
				'preview_link'      => 'https://radiustheme.com/demo/wordpress/themes/foodymat/home-03/',
			),
			'demo4' => array(
				'title'             => __( 'Tax Advisory', 'foodymat-core' ),
				'page'              => __( 'Home 04', 'foodymat-core' ),
				'categories'        => [ 'Finance' ],
				'screenshot'        => RDTHEME_CORE_BASE_URL . 'screenshots/4.png',
				'preview_link'      => 'https://radiustheme.com/demo/wordpress/themes/foodymat/home-04/',
			),
			'demo5' => array(
				'title'             => __( 'Finance Insurance', 'foodymat-core' ),
				'page'              => __( 'Home 05', 'foodymat-core' ),
				'categories'        => [ 'Finance' ],
				'screenshot'        => RDTHEME_CORE_BASE_URL . 'screenshots/5.png',
				'preview_link'      => 'https://radiustheme.com/demo/wordpress/themes/foodymat/home-05/',
			),
			'demo6' => array(
				'title'             => __( 'Finance Loan', 'foodymat-core' ),
				'page'              => __( 'Home 06', 'foodymat-core' ),
				'categories'        => [ 'Finance' ],
				'screenshot'        => RDTHEME_CORE_BASE_URL . 'screenshots/6.png',
				'preview_link'      => 'https://radiustheme.com/demo/wordpress/themes/foodymat/home-06/',
			),
			'demo7' => array(
				'title'             => __( 'Finance Audit', 'foodymat-core' ),
				'page'              => __( 'Home 07', 'foodymat-core' ),
				'categories'        => [ 'Finance' ],
				'screenshot'        => RDTHEME_CORE_BASE_URL . 'screenshots/7.png',
				'preview_link'      => 'https://radiustheme.com/demo/wordpress/themes/foodymat/home-07/',
			),
			'demo8' => array(
				'title'             => __( 'Finance Cash Back', 'foodymat-core' ),
				'page'              => __( 'Home 08', 'foodymat-core' ),
				'categories'        => [ 'Finance' ],
				'screenshot'        => RDTHEME_CORE_BASE_URL . 'screenshots/8.png',
				'preview_link'      => 'https://radiustheme.com/demo/wordpress/themes/foodymat/home-08/',
			),
			'demo9' => array(
				'title'             => __( 'Investment', 'foodymat-core' ),
				'page'              => __( 'Home 09', 'foodymat-core' ),
				'categories'        => [ 'Business' ],
				'screenshot'        => RDTHEME_CORE_BASE_URL . 'screenshots/9.png',
				'preview_link'      => 'https://radiustheme.com/demo/wordpress/themes/foodymat/home-09/',
			),
			'demo10' => array(
				'title'             => __( 'Finance Accountant', 'foodymat-core' ),
				'page'              => __( 'Home 10', 'foodymat-core' ),
				'categories'        => [ 'Finance' ],
				'screenshot'        => RDTHEME_CORE_BASE_URL . 'screenshots/10.png',
				'preview_link'      => 'https://radiustheme.com/demo/wordpress/themes/foodymat/home-10/',
			),
		);

		$config = array();
		$import_path  = trailingslashit( RDTHEME_CORE_DEMO_CONTENT ) . 'demo/';

		foreach ( $demos_array as $key => $demo ) {
			$config[] = array(
				'import_file_id'                => $key,
				'import_file_name'              => $demo['title'],
				'import_page_name'              => $demo['page'],
				'categories'                    => $demo['categories'],
				'local_import_file'             => $import_path . 'content.xml',
				'local_import_widget_file'      => $import_path . 'widgets.wie',
				'local_import_customizer_file'  => $import_path . 'export.dat',
				'import_preview_image_url'      => $demo['screenshot'],
				'preview_url'                   => $demo['preview_link'],
			);
		}

		return $config;
	}

	/**
	 * Enqueues a custom CSS file specifically for the "Install Demos" admin page.
	 *
	 * @param string $hook_suffix The current admin page hook suffix.
	 *
	 * @return void
	 */
	public function custom_admin_css( $hook_suffix ) {
		if ( 'appearance_page_install_demos' === $hook_suffix ) {
			wp_enqueue_style( 'custom-admin-css', FOODYMAT_CORE_BASE_URL . '/demo-content/css/main.css', [], '1.0.0' );
		}
	}

	/**
	 * After import actions.
	 *
	 * @param array $selected_import Import array.
	 *
	 * @return void
	 */
	public function after_import_actions( $selected_import ) {
		$this
			->set_menus($selected_import['import_file_id'])
			->set_front_page($selected_import)
			->set_elementor_active_kit()
			->set_elementor_settings()
			->set_draft_post()
			->import_fluent_forms( $selected_import );

		flush_rewrite_rules();
	}

	/**
	 * Assign menus to their locations.
	 *
	 * @return RTDemoimport
	 */
	private function set_menus($selected_import) {
		$main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
		set_theme_mod(
			'nav_menu_locations',
			[
				'primary' => $main_menu->term_id,
			]
		);

		return $this;
	}

	/**
	 * Assign front page and posts page (blog page).
	 *
	 * @return RTDemoimport
	 */
	private function set_front_page($selected_import) {
		$front_page_id = $this->get_page_by_title( $selected_import['import_page_name'], 'page' );

		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id->ID );

		$blog_page_id = $this->get_page_by_title( 'Blog' );
		update_option( 'page_for_posts', $blog_page_id->ID );
		return $this;
	}

	/**
	 * Sets the active Elementor kit.
	 *
	 * @return RTDemoimport
	 */
	private function set_elementor_active_kit() {
		global $wpdb;

		// phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching
		$pageIds = $wpdb->get_results(
			$wpdb->prepare(
				"SELECT ID FROM $wpdb->posts WHERE (post_name = %s OR post_title = %s) AND post_type = 'elementor_library' AND post_status = 'publish'",
				'default-kit',
				'Default Kit'
			)
		);

		if ( ! is_null( $pageIds ) ) {
			$pageId    = 0;
			$deleteIds = [];

			// Retrieve page with greater id and delete others.
			if ( count( $pageIds ) > 1 ) {
				foreach ( $pageIds as $page ) {
					if ( $page->ID > $pageId ) {
						if ( $pageId ) {
							$deleteIds[] = $pageId;
						}

						$pageId = $page->ID;
					} else {
						$deleteIds[] = $page->ID;
					}
				}
			} else {
				$pageId = $pageIds[0]->ID;
			}

			// Update `elementor_active_kit` page.
			if ( $pageId > 0 ) {
				wp_update_post(
					[
						'ID'        => $pageId,
						'post_name' => sanitize_title( 'Default Kit' ),
					]
				);
				update_option( 'elementor_active_kit', $pageId );
			}
		}

		return $this;
	}

	/**
	 * Sets the Elementor default settings.
	 *
	 * @return RTDemoimport
	 */
	private function set_elementor_settings() {
		update_option( 'elementor_disable_color_schemes', 'yes' );
		update_option( 'elementor_disable_typography_schemes', 'yes' );
		update_option( 'elementor_unfiltered_files_upload', '1' );
		update_option( 'elementor_experiment-e_font_icon_svg', 'inactive' );

		return $this;
	}

	/**
	 * Updates the 'Hello World!' blog post by making it a draft
	 *
	 * @return RTDemoimport
	 */
	private function set_draft_post() {
		$helloWorld = $this->get_page_by_title( 'Hello World!', 'post' );

		if ( $helloWorld ) {
			$helloWorldArgs = [
				'ID'          => $helloWorld->ID,
				'post_status' => 'draft',
			];

			wp_update_post( $helloWorldArgs );
		}

		return $this;
	}

	/**
	 * Import fluent forms.
	 *
	 * @param array $selected_import Import array.
	 *
	 * @return void
	 */
	private function import_fluent_forms( $selected_import ) {
		if ( empty( $selected_import['local_import_file'] ) || ! is_plugin_active( 'fluentform/fluentform.php' ) ) {
			return;
		}

		$import_file = $selected_import['local_import_file'];
		$formFile    = trailingslashit( dirname( $import_file ) ) . 'fluentform.json';
		$fileExists  = file_exists( $formFile );

		if ( $fileExists ) {
			// phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
			$data          = file_get_contents( $formFile );
			$forms         = json_decode( $data, true );
			$insertedForms = [];

			if ( $forms && is_array( $forms ) ) {
				foreach ( $forms as $formItem ) {
					$formFields = wp_json_encode( [] );

					// phpcs:ignore Generic.CodeAnalysis.AssignmentInCondition.Found, Squiz.PHP.DisallowMultipleAssignments.FoundInControlStructure
					if ( $fields = Arr::get( $formItem, 'form', '' ) ) {
						$formFields = wp_json_encode( $fields );
						// phpcs:ignore Generic.CodeAnalysis.AssignmentInCondition.Found, Squiz.PHP.DisallowMultipleAssignments.FoundInControlStructure
					} elseif ( $fields = Arr::get( $formItem, 'form_fields', '' ) ) {
						$formFields = wp_json_encode( $fields );
					}

					$form = [
						'title'       => Arr::get( $formItem, 'title' ),
						'form_fields' => $formFields,
						'status'      => Arr::get( $formItem, 'status', 'published' ),
						'has_payment' => Arr::get( $formItem, 'has_payment', 0 ),
						'type'        => Arr::get( $formItem, 'type', 'form' ),
						'created_by'  => get_current_user_id(),
					];

					if ( Arr::get( $formItem, 'conditions' ) ) {
						$form['conditions'] = Arr::get( $formItem, 'conditions' );
					}

					if ( isset( $formItem['appearance_settings'] ) ) {
						$form['appearance_settings'] = Arr::get( $formItem, 'appearance_settings' );
					}

					$formId                   = Form::insertGetId( $form );
					$insertedForms[ $formId ] = [
						'title'    => $form['title'],
						'edit_url' => admin_url( 'admin.php?page=fluent_forms&route=editor&form_id=' . $formId ),
					];

					if ( isset( $formItem['metas'] ) ) {
						foreach ( $formItem['metas'] as $metaData ) {
							$settings = [
								'form_id'  => $formId,
								'meta_key' => Arr::get( $metaData, 'meta_key' ),
								'value'    => Arr::get( $metaData, 'value' ),
							];

							FormMeta::insert( $settings );
						}
					} else {
						$oldKeys = [
							'formSettings',
							'notifications',
							'mailchimp_feeds',
							'slack',
						];

						foreach ( $oldKeys as $key ) {
							if ( isset( $formItem[ $key ] ) ) {
								FormMeta::persist( $formId, $key, wp_json_encode( Arr::get( $formItem, $key ) ) );
							}
						}
					}
				}
			}
		}
	}

	/**
	 * Install Demos Menu - Menu Edited
	 *
	 * @param array $default_settings Default settings.
	 * @return array
	 */
	public function import_page_setup( $default_settings ) {
		$default_settings['parent_slug'] = 'themes.php';
		$default_settings['page_title']  = esc_html__( 'Import Demo Data', 'foodymat-core' );
		$default_settings['menu_title']  = esc_html__( 'Import Demo Data', 'foodymat-core' );
		$default_settings['capability']  = 'import';
		$default_settings['menu_slug']   = 'install_demos';

		return $default_settings;
	}

	/**
	 * Generates and returns the introduction text for the RT Install Demos page.
	 *
	 * @param string $default_text The existing default text to append to.
	 *
	 * @return string
	 */
	public function intro_text( $default_text ) {
		$auto_install   = admin_url( 'themes.php?page=install_demos' );
		$manual_install = admin_url( 'themes.php?page=install_demos&import-mode=manual' );

		ob_start();
		?>
        <h1>RT Install Demos</h1>
        <div class="foodymat-core_intro-text vtdemo-one-click">
            <div id="poststuff">
                <div class="postbox important-notes">
                    <h3><span>Important notes:</span></h3>
                    <div class="inside">
                        <ol>
                            <li>Please note, this import process will take time. So, please be patient.</li>
                            <li>Please make sure you've installed recommended plugins before you import this content.</li>
                            <li>All images are for demo purposes only. So, images may repeat in your site content.</li>
                        </ol>
                    </div>
                </div>

                <div class="postbox vt-support-box vt-error-box">
                    <h3><span>Don't Edit Parent Theme Files:</span></h3>
                    <div class="inside">
                        <p>Don't edit any files from the parent theme! Use only <strong>Child Theme</strong> files for your customizations!</p>
                        <p>If you receive future updates from our theme, you'll lose any edited customizations from your parent theme.</p>
                    </div>
                </div>

                <div class="postbox vt-support-box">
                    <h3><span>Need Support?</span> <a href="https://themeforest.net/user/rt" target="_blank" class="cs-section-video"><i class="fal fa-hand-point-right"></i> <span>How to?</span></a></h3>
                    <div class="inside">
                        <p>Have any doubts regarding this installation or any other issues? Please feel free to send us an email at rt@gmail.com.</p>
                        <a href="https://themeforest.net/user/rt" class="button-primary" target="_blank">Docs</a>
                        <a href="https://themeforest.net/user/rt/" class="button-primary" target="_blank">Support</a>
                        <a href="https://themeforest.net/item/foodymat/123456?ref=rt" class="button-primary" target="_blank">Item Page</a>
                    </div>
                </div>
                <div class="nav-tab-wrapper vt-nav-tab">
					<?php
					// phpcs:ignore WordPress.Security.NonceVerification.Recommended
					$is_manual_mode      = isset( $_GET['import-mode'] ) && 'manual' === $_GET['import-mode'];
					$auto_active_class   = $is_manual_mode ? '' : ' nav-tab-active';
					$manual_active_class = $is_manual_mode ? ' nav-tab-active' : '';
					?>
                    <a href="<?php echo esc_url( $auto_install ); ?>" class="nav-tab vt-mode-switch vt-auto-mode<?php echo esc_attr( $auto_active_class ); ?>">Auto Import</a>
                    <a href="<?php echo esc_url( $manual_install ); ?>" class="nav-tab vt-mode-switch vt-manual-mode<?php echo esc_attr( $manual_active_class ); ?>">Manual Import</a>
                </div>
            </div>
        </div>
		<?php
		$default_text .= ob_get_clean();

		return $default_text;
	}


	/**
	 * Get page by title.
	 *
	 * @param string $title Page name.
	 * @param string $post_type Post type.
	 *
	 * @return WP_Post
	 */
	private function get_page_by_title( $title, $post_type = 'page' ) {
		$query = new WP_Query(
			[
				'post_type'              => esc_html( $post_type ),
				'title'                  => esc_html( $title ),
				'post_status'            => 'all',
				'posts_per_page'         => 1,
				'no_found_rows'          => true,
				'ignore_sticky_posts'    => true,
				'update_post_term_cache' => false,
				'update_post_meta_cache' => false,
				'orderby'                => 'post_date ID',
				'order'                  => 'ASC',
			]
		);

		return ! empty( $query->post ) ? $query->post : null;
	}
}

add_action( 'plugins_loaded', 'foodymat_demo_importer_init' );
/**
 * Initializes the Quixa demo importer.
 *
 * @return RTDemoimport
 */
function foodymat_demo_importer_init() {
	return new RTDemoimport();
}
