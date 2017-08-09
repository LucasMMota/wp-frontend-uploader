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
		$current             = get_current_screen();
		$arrPostTypesAllowed = array( 'post', 'page' );

		/**
		 * Filter to customize button exhibition displaying on custom post types
		 */
		$arrPostTypesAllowed = apply_filters( 'fu_visual_form_button_allowed_post_types', $arrPostTypesAllowed );
		if ( in_array( $current->id, $arrPostTypesAllowed, true ) ) {
			?>
            <a href="/?TB_inline&inlineId=fu-btn-visual-form&width=500&height=400"
               class="button add_media hide-if-no-js thickbox"><span class="dashicons dashicons-welcome-widgets-menus"></span> Add FU Form </a>

<!--            <input type="hidden" id="abril-shortcode-btn-votar-finalista-id">-->
<!--            <input type="hidden" id="abril-shortcode-btn-votar-premio-id">-->

            <div id="fu-btn-visual-form" style="display:none;">
                <div class="fu-btn-visual-form">
                    <div class="edit-shortcode-form">
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

}

// Trigger
new FU_WP_Visual_Form();