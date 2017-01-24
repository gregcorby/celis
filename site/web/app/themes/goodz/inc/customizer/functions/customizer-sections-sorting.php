<?php
/**
 * Sections Sorting Customizer Control
 *
 * @since  1.0.0
 * @access public
 *
 * @package Goodz
 */
class Customize_Sections_Sorting extends WP_Customize_Control {

    /**
     * The type of customize control being rendered.
     *
     * @since  1.0.0
     * @access public
     * @var    string
     */
    public $type = 'section-sorting';

    /**
     * Enqueue scripts/styles.
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
    public function enqueue() {
        /* js */
        wp_enqueue_script( 'jquery-ui-core' );
        wp_enqueue_script( 'jquery-ui-sortable' );

        wp_enqueue_script( 'customize-controls', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/js/customize-controls.js', array( 'jquery', 'jquery-ui-sortable' ) );
    }

    /**
     * Displays the control content.
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
    public function render_content() {

        if ( empty( $this->choices ) )
            return; ?>

        <?php if ( !empty( $this->label ) ) : ?>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <?php endif; ?>

        <?php if ( !empty( $this->description ) ) : ?>
            <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
        <?php endif; ?>

        <?php

            $values = $this->value();

            $multi_values = array();

            if ( 'default' == $this->value() ) {
                $values = 'call-to-action;0,product-categories;1,products-section;1,page-content;0,blog-instagram;1,brands-section;0';
            }

            if ( ! is_array( $values ) ) {
                $values = explode( ',', $values );
                foreach ( $values as $value ) {
                    $value = explode( ';', $value );
                    $multi_values[$value[0]] = $value[1];
                }
            }

            /* make it an array */
            $sections = $values;

            /* var */
            $output = array();

            /* get individual fruit */
            foreach( $sections as $section ) {

                /* get value of each */
                $section = explode( ';', $section );
                $output[] = $section[0];
            }

            $sorted_sections = array_merge( array_flip( $output ), $this->choices );

        ?>

        <ul id="my-checklist">

            <?php foreach ( $sorted_sections as $key => $value ) : ?>

                <li>
                    <label>
                        <input name="<?php echo esc_attr( $key ); ?>" class="hello-check" type="checkbox" value="<?php echo esc_attr( $multi_values[$key] ); ?>" <?php checked( $multi_values[$key] ); ?> />
                        <?php echo esc_html( $value ); ?>
                    </label>
                    <i class="dashicons dashicons-menu my-handle"></i>
                </li>

            <?php endforeach; ?>

        </ul>

        <input type="hidden" class="fillme" <?php $this->link(); ?> value="<?php echo esc_attr( $this->value() ); ?>" />

    <?php

    }
}

