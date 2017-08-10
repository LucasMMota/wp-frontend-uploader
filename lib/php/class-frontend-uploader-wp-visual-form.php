<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Visual Form to select fields and automatically build shortcode
 *
 * Author:  Lucas Fonseca
 * Version: 1.0
 */
class FU_WP_Visual_Form {

	const settings_slug = 'frontend_uploader_settings';

	public function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'fu_visual_form_add_scripts' ) );
		//add_action( 'media_buttons', array( $this, 'add_btn_fu_visual_form' ), 999 );
	}

	public function fu_visual_form_add_scripts() {
		if ( in_array( get_current_screen()->id, FU_WP_Visual_Form::fu_get_allowed_post_types() ) ) {
			wp_enqueue_style( 'bv-admin-css', FU_URL . 'lib/css/fu-visual-form.css' );
			//wp_enqueue_script( 'bv-admin-js', FU_URL . 'lib/js/visual-form/script-admin.js' );
		}
	}

	private static function fu_get_allowed_post_types() {
		$arrDefaultPostTypesAllowed = array( 'post' );

		$fuSettings = get_option( FU_WP_Visual_Form::settings_slug, FU_WP_Visual_Form::settings_defaults() );
		if ( isset( $fuSettings['enabled_post_types'] ) ) {
			$arrDefaultPostTypesAllowed = $fuSettings['enabled_post_types'];
		}

		/**
		 * Filter to customize button exhibition displaying on custom post types
		 */
		return apply_filters( 'fu_visual_form_button_allowed_post_types', $arrDefaultPostTypesAllowed );
	}

	/**
	 * Displays visual form button on post editor
	 */
	public static function add_btn_fu_visual_form() {
		$current = get_current_screen();

		if ( in_array( $current->id, FU_WP_Visual_Form::fu_get_allowed_post_types(), true ) ) {
			?>
            <a href="/?TB_inline&inlineId=fu-btn-visual-form&width=500&height=400"
               class="button add_media hide-if-no-js thickbox"><span
                        class="dashicons dashicons-welcome-widgets-menus"></span><?php echo apply_filters( 'fu_visual_form_button_name', 'Add FU Form' ) ?></a>

            <!--            <input type="hidden" id="abril-shortcode-btn-votar-finalista-id">-->
            <!--            <input type="hidden" id="abril-shortcode-btn-votar-premio-id">-->

            <div id="fu-btn-visual-form" style="display:none;">
                <div class="fu-btn-visual-form">
                    <div class="edit-shortcode-form">
                        <!--                        SCTDs-->
                        <!---->
                        <!--                        fu-upload-form abre-->
                        <!--                        fu-upload-response-->
                        <!---->
                        <!--                        input-->
                        <!--                        textarea-->
                        <!--                        select-->
                        <!--                        checkboxes-->
                        <!--                        radio-->
                        <!--                        recaptcha-->


                        <div id="tab-container" class="tab-container">
                            <ul class='etabs'>
                                <li class='tab'><a href="#tabs-form">Formulário</a></li>
                                <li class='tab'><a href="#tabs-grupos">Grupos</a></li>
                            </ul>
                            <div class='panel-container'>
                                <div id="tabs-form">
                                    <h2>HTML Markup for these tabs</h2>
                                    <!-- content -->
                                </div>
                                <div id="tabs-grupos" style="display: none;">
                                    <h2>JS for these tabs</h2>
                                    <!-- content -->
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
			<?php
		}
	}

	/**
	 * Ensure we're not producing any notices by supplying the defaults to get_option
	 *
	 * @return array $defaults
	 */
	private static function settings_defaults() {
		$defaults = array();
		$settings = Frontend_Uploader_Settings::get_settings_fields();
		foreach ( $settings[ FU_WP_Visual_Form::settings_slug ] as $setting ) {
			$defaults[ $setting['name'] ] = $setting['default'];
		}

		return $defaults;
	}
}

// Trigger
new FU_WP_Visual_Form();