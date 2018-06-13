<?php
/**
 * Customizer sanitization functions
 *
 * @package deppo
 */

/**
 * Sanitize selection.
 */
function deppo_sanitize_select( $selection ) {
	return $selection;
}

/**
 * Sanitize checkbox
 */
function deppo_sanitize_checkbox( $checkbox ) {
	if ( $checkbox ) {
		$checkbox = 1;
	} else {
		$checkbox = false;
	}
	return $checkbox;
}

// Sanitize text.
function deppo_sanitize_text( $text ) {
	if ( '' == $text ) {
		$text = '';
	}
	return $text;
}

/**
 * Sanitize post archive layout radio inputs
 */
function deppo_sanitize_blog_layout( $selection ) {
	if ( !in_array( $selection, array( 'magazine', 'newspaper' ) ) ) {
		$selection = 'magazine';
	} else {
		return $selection;
	}
}

/**
 * Sanitize portfolio archive layout radio inputs
 */
function deppo_sanitize_portfolio_layout( $selection ) {
	if ( !in_array( $selection, array( 'two-columns', 'three-columns', 'four-columns' ) ) ) {
		$selection = 'four-columns';
	} else {
		return $selection;
	}
}

/**
 * Sanitize sticky header radio inputs
 */
function deppo_sanitize_sticky_header( $selection ) {
	if ( !in_array( $selection, array( 'enable', 'disable' ) ) ) {
		$selection = 'enable';
	} else {
		return $selection;
	}
}

/**
 * Sanitize logo position radio inputs
 */
function deppo_sanitize_logo_position( $selection ) {
	if ( !in_array( $selection, array( 'default', 'center' ) ) ) {
		$selection = 'default';
	} else {
		return $selection;
	}
}

/**
 * Sanitize featured slider radio inputs
 */
function deppo_sanitize_featured_slider( $selection ) {
	if ( !in_array( $selection, array( 'film-strip', 'viewport') ) ) {
		$selection = 'viewport';
	} else {
		return $selection;
	}
}

/**
 * Sanitize colors
 */
function deppo_sanitize_color( $hex, $default = '' ) {
    if ( deppo_of_validate_hex( $hex ) ) {
        return $hex;
    }
    return $default;
}
function deppo_of_validate_hex( $hex ) {
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

/**
 * Sanitize blog layout radio inputs
 */
function deppo_sanitize_post_navigation( $selection ) {
	if ( !in_array( $selection, array( 2, 1, 0 ) ) ) {
		$selection = 2;
	} else {
		return $selection;
	}
}

/**
 * Sanitize blog layout radio inputs
 */
function deppo_sanitize_slider_text( $selection ) {
	if ( !in_array( $selection, array( 1, 0 ) ) ) {
		$selection = 1;
	} else {
		return $selection;
	}
}
