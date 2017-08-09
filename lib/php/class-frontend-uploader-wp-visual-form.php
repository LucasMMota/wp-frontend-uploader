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
		if ( get_current_screen()->id === 'premios-inscricoes' ) {
			wp_enqueue_style( 'bv-admin-css', FU_URL . 'lib/css/visual-form/style-admin.css' );
			wp_enqueue_script( 'bv-admin-js', FU_URL . 'lib/js/visual-form/script-admin.js' );
		}
	}

	/**
	 * Displays visual form button on post editor
	 */
	public static function add_btn_fu_visual_form() {
		$current = get_current_screen();
		$arrDefaultPostTypesAllowed = array( 'post' );

		$fuSettings                 = get_option( FU_WP_Visual_Form::settings_slug, FU_WP_Visual_Form::settings_defaults() );
		if ( isset( $fuSettings['enabled_post_types'] ) ) {
			$arrDefaultPostTypesAllowed = $fuSettings['enabled_post_types'];
		}

		/**
		 * Filter to customize button exhibition displaying on custom post types
		 */
		$arrPostTypesAllowed = apply_filters( 'fu_visual_form_button_allowed_post_types', $arrDefaultPostTypesAllowed );
		if ( in_array( $current->id, $arrPostTypesAllowed, true ) ) {
			?>
            <a href="/?TB_inline&inlineId=fu-btn-visual-form&width=500&height=400"
               class="button add_media hide-if-no-js thickbox"><span class="dashicons dashicons-welcome-widgets-menus"></span> Add FU Form </a>

            <!--            <input type="hidden" id="abril-shortcode-btn-votar-finalista-id">-->
            <!--            <input type="hidden" id="abril-shortcode-btn-votar-premio-id">-->

            <div id="fu-btn-visual-form" style="display:none;">
                <div class="fu-btn-visual-form">
                    <div class="edit-shortcode-form">
                        SCTDs

                        fu-upload-form abre
                        fu-upload-response

                        input
                        textarea
                        select
                        checkboxes
                        radio
                        recaptcha
                        <!--                        <p>Preencha o texto que deseja exibir.</p>-->
                        <!--                        <label>Texto do botão</label>-->
                        <!--                        <input id="abril-shortcode-btn-votar-texto" class="abril-shortcode-btn-votar-texto" value="Gostou desta finalista?">-->
                        <!---->
                        <!--                        <div class="abril-bv-btn-insert-container">-->
                        <!--                            <button class="button button-primary button-large" id="abril-bv-inserir">Inserir Botão</button>-->
                        <!--                        </div>-->
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