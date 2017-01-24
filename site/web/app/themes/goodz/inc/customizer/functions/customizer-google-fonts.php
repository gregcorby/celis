<?php

function goodz_add_customizer_custom_controls( $wp_customize ) {

	//  Add Custom Subtitle
	//  =============================================================================

	class goodz_sub_title extends WP_Customize_Control {
		public $type = 'sub-title';
		public function render_content() {
		?>
			<h4 class="gwfc-custom-sub-title"><?php echo esc_html( $this->label ); ?></h4>
		<?php
		}
	}

	//  Add Custom Description
	//  =============================================================================

	class goodz_description extends WP_Customize_Control {
		public $type = 'description';
		public function render_content() {
		?>
			<p class="gwfc-custom-description"><?php echo esc_html( $this->label ); ?></p>
		<?php
		}
	}

}
add_action( 'customize_register', 'goodz_add_customizer_custom_controls' );