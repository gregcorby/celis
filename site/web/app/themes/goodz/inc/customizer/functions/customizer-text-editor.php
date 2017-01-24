<?php
/**
 * Class to create a custom tags control
 */
class Text_Editor_Custom_Control extends WP_Customize_Control {
    /**
    * Render the content on the theme customizer page
    */
    public function render_content() {
        ?>
            <label>
              <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
              <?php
                $settings = array(
                    'textarea_name' => $this->id,
                    'media_buttons' => false,
                    'textarea_rows' => 10,
                    'teeny'         => true
                );
                add_filter( 'the_editor', array( $this, 'filter_editor_setting_link' ) );
                wp_editor( html_entity_decode( wp_kses_post( $this->value() ) ), $this->id, $settings );

                do_action( 'admin_footer' );
                do_action( 'admin_print_footer_scripts' );
              ?>
            </label>
        <?php
   }

    /**
     * @return string
     */
    public function filter_editor_setting_link( $output ) {
        return preg_replace( '/<textarea/', '<textarea ' . $this->get_link(), $output, 1 );
    }

}
