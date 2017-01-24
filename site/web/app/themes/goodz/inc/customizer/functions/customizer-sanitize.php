<?php
/**
 * Sanitization functions for Customizer
 *
 * @package  Goodz
 */

/**
 * Sanitize selection.
 *
 * @param string $selection Option selection.
 * @return string Filtered selection.
 */
function goodz_sanitize_select( $selection ) {
    return $selection;
}

/**
 * Sanitize multiple checkboxes
 */
function goodz_sanitize_multiple_checkbox( $values ) {

    $multi_values = !is_array( $values ) ? explode( ',', $values ) : $values;

    return !empty( $multi_values ) ? array_map( 'sanitize_text_field', $multi_values ) : array();
}

/**
 * Sanitize colors
 */
function goodz_sanitize_color( $hex, $default = '' ) {
    if ( goodz_of_validate_hex( $hex ) ) {
        return $hex;
    }
    return $default;
}

function goodz_of_validate_hex( $hex ) {
    $hex = trim( $hex );
    /* Strip recognized prefixes. */
    if ( 0 === strpos( $hex, '#' ) ) {
        $hex = substr( $hex, 1 );
    }
    elseif ( 0 === strpos( $hex, '%23' ) ) {
        $hex = substr( $hex, 3 );
    }
    /* Regex match. */
    if ( 0 === preg_match( '/^[0-9a-fA-F]{6}$/', $hex ) ) {
        return false;
    }
    else {
        return true;
    }
}

// Sanitize text.
function goodz_sanitize_text( $text ) {
    if ( '' == $text ) {
        $text = '';
    }
    return $text;
}

/**
 * Sanitize the value of Logo image.
 *
 * @param string $logo_image.
 * @return string $logo_image.
 */
function goodz_sanitize_image( $logo_image ) {
    return $logo_image;
}

