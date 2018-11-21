<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package deppo
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function deppo_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Add a class if main sidebar is active
	if ( is_active_sidebar('sidebar-1') ) {
		$classes[] = 'has-sidebar';
	}

	if ( has_custom_header() && is_page_template( 'templates/home-slider.php' ) ) {
		$classes[] = 'has-video-header';
	}

	if (is_singular('post')) {
		$display_post_nav = get_theme_mod( 'display-navigation-settings', 2 );

		switch ( $display_post_nav ) {
			case 0:
				$classes[] = 'post-nav-hide';
				break;
			case 1:
				$classes[] = 'post-nav-under';
				break;
			default:
				$classes[] = 'post-nav-side';
		}
	}

	// slider header text settings
	$display_post_nav = get_theme_mod( 'display-slider-settings', 1 );

	switch ( $display_post_nav ) {
		case 0:
			$classes[] = 'slider-text-side';
			break;
		default:
			$classes[] = 'slider-text-center';
	}

	// slider header text settings
	$portfolio_layout = get_theme_mod( 'portfolio-archive-settings', 2 );

	switch ( $portfolio_layout ) {
		case 1:
			$classes[] = 'portfolio-boxed';
			break;
		case 0:
			$classes[] = 'portfolio-grid';
			break;
		default:
			$classes[] = 'portfolio-shuffle';
	}

	// slider header text settings
	$portfolio_hover_title = get_theme_mod( 'portfolio-hover-title-settings', 0 );

	switch ( $portfolio_hover_title ) {
		case 1:
			$classes[] = 'portfolio-hover-title';
			break;
		default:
	}

	// home slider numeration settings
	if ( is_page_template( 'templates/home-slider.php' ) ) {
		$home_slider_numeration = get_theme_mod( 'slider-numeration-settings', 1 );

		switch ( $home_slider_numeration ) {
			case 0:
				$classes[] = 'hide-home-slider-dots';
				break;
			default:
		}
	}

	// Portfolio single numeration settings

	if (is_singular('jetpack-portfolio')) {
		$port_single_numeration = get_theme_mod( 'port-single-numeration-settings', 1 );

		switch ( $port_single_numeration ) {
			case 0:
				$classes[] = 'hide-portfolio-single-dots';
				break;
			default:
		}
	}

	if ( has_nav_menu( 'jetpack-social-menu' ) ) {
		$classes[] = 'social-menu';
	} else {
		$classes[] = 'no-social-menu';
	}

	return $classes;
}
add_filter( 'body_class', 'deppo_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function deppo_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'deppo_pingback_header' );


/**
 * Get Thumbnail Image Size Class
 *
 * @since deppo 1.0
 */
function deppo_get_featured_image_class() {

	$thumb_class            = '';
	$url                    = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );

	if ( $url != false ) {

		list( $width, $height ) = getimagesize( $url );

		if ( $width > $height || $width == $height ) {
			$thumb_class = 'horizontal-img';
		} else {
			$thumb_class = 'vertical-img';
		}
	}

	return $thumb_class;
}

/**
 * Change tag cloud font size
 *
 * @since  deppo 1.0
 */
function deppo_widget_tag_cloud_args( $args ) {
	$args['largest']  = 16;
	$args['smallest'] = 16;
	$args['unit']     = 'px';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'deppo_widget_tag_cloud_args' );

/**
 * Remove parenthesses from excerpt
 *
 * @since deppo 1.0
 */
function deppo_excerpt_more( $more ) {
	return '';
}
add_filter( 'excerpt_more', 'deppo_excerpt_more' );

/**
 * Parenthesses remove
 *
 * Removes parenthesses from category and archives widget
 *
 * @since deppo 1.0
 */
function deppo_categories_postcount_filter( $variable ) {
	$variable = str_replace( '(', '<span class="post_count">', $variable );
	$variable = str_replace( ')', '</span>', $variable );
	return $variable;
}
add_filter( 'wp_list_categories','deppo_categories_postcount_filter' );

function deppo_archives_postcount_filter( $variable ) {
	$variable = str_replace( '(', '<span class="post_count">', $variable );
	$variable = str_replace( ')', '</span>', $variable );
	return $variable;
}
add_filter( 'get_archives_link','deppo_archives_postcount_filter' );

/* Convert hexdec color string to rgb(a) string */

function deppo_hex2rgba( $color, $opacity = false ) {

	$default = 'rgb(0,0,0)';

	//Return default if no color provided
	if ( empty( $color ) ) {
		return $default;
	}

	//Sanitize $color if "#" is provided
	if ( $color[0] == '#' ) {
		$color = substr( $color, 1 );
	}

	//Check if color has 6 or 3 characters and get values
	if ( strlen( $color ) == 6) {
		$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
	} elseif ( strlen( $color ) == 3 ) {
		$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
	} else {
		return $default;
	}

	//Convert hexadec to rgb
	$rgb =  array_map( 'hexdec', $hex );

	//Check if opacity is set(rgba or rgb)
	if ( $opacity ) {
		if ( abs( $opacity ) > 1 ) {
			$opacity = 1.0;
		}
		$output = 'rgba(' . implode( ",", $rgb ) . ',' . $opacity . ')';
	} else {
		$output = 'rgb(' . implode( ",",$rgb ) . ')';
	}

	// Return rgb(a) color string
	return $output;
}

/**
 * Do shortcode function instead calling do_shortcode
 *
 */
function deppo_do_shortcode_function( $tag, array $atts = array(), $content = null ) {

	 global $shortcode_tags;

	 if ( ! isset( $shortcode_tags[ $tag ] ) )
			 return false;

	 return call_user_func( $shortcode_tags[ $tag ], $atts, $content, $tag );
}

//change text to leave a reply on comment form
function deppo_comment_reform ($arg) {
$arg['title_reply'] = __('Reply', 'deppo');
return $arg;
}
add_filter('comment_form_defaults','deppo_comment_reform');
