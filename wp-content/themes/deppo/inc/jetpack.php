<?php
/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.com/
 *
 * @package deppo
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 */
function deppo_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'container' => 'post-load',
		'wrapper'   => false,
		'render'    => 'deppo_infinite_scroll_render',
		'footer'    => 'page',
		'type'      => 'click'
	) );

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Add theme support for JetPack Portfolio.
	add_theme_support( 'jetpack-portfolio' );

	// Enable social menu support.
	add_theme_support( 'jetpack-social-menu' );

	// Add Featured Content Support
	add_theme_support( 'featured-content', array(
		'filter'     => 'deppo_get_featured_posts',
		'max_posts'  => 12,
		'post_types' => array( 'post', 'jetpack-portfolio' )
	) );

	// Add theme support for Content Options.
	add_theme_support( 'jetpack-content-options', array(
		'post-details' => array(
			'stylesheet' => 'deppo-style',
			'date'       => '.posted-on',
			'categories' => '.cat-links',
			'tags'       => '.tags-links',
		),
	) );
}
add_action( 'after_setup_theme', 'deppo_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function deppo_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) {
			get_template_part( 'template-parts/content', 'search' );

		} else if ( get_post_type() == 'jetpack-portfolio' )  {
			get_template_part( 'template-parts/content', 'portfolio' );

		} else {
			get_template_part( 'template-parts/content', get_post_format() );
		}
	}
}

/**
 * Social menu
 */
function deppo_social_menu() {

	if ( ! function_exists( 'jetpack_social_menu' ) ) {
		return;
	} else {
		jetpack_social_menu();
	}

}

/**
 * Featured posts filter function
 */
function deppo_get_featured_posts() {
	return apply_filters( 'deppo_get_featured_posts', array() );
}

 /**
 * A helper conditional function that returns a boolean value.
 */
function deppo_has_featured_posts() {
	return ( bool ) deppo_get_featured_posts();
}

/**
 * Change Jetpack's Infinite Scroll text on button that loads more posts.
 */
function deppo_filter_jetpack_infinite_scroll_js_settings( $settings ) {
	$settings['text'] = __( 'Load More', 'deppo' );

	return $settings;
}
add_filter( 'infinite_scroll_js_settings', 'deppo_filter_jetpack_infinite_scroll_js_settings' );

/** * Filter Jetpack’s Related Post thumbnail size.
 *
 * @param  $size (array) - Current width and height of thumbnail.
 * @return $size (array) - New width and height of thumbnail.
*/
function deppo_custom_jetpack_relatedposts_filter_thumbnail_size( $size ) {
	$size = array(
		'width'  => 320,
		'height' => ''
	);
	return $size;
}
add_filter( 'jetpack_relatedposts_filter_thumbnail_size', 'deppo_custom_jetpack_relatedposts_filter_thumbnail_size' );

/**
 * Remove jetpack related posts from its place
 * it is placed inside template-parts/content-single.php via d-_shortcode
 *
 * @link https://jetpack.com/support/related-posts/customize-related-posts/#delete
 */
function jetpackme_remove_rp() {
    if ( class_exists( 'Jetpack_RelatedPosts' ) ) {
        $jprp = Jetpack_RelatedPosts::init();
        $callback = array( $jprp, 'filter_add_target_to_dom' );
        remove_filter( 'the_content', $callback, 40 );
    }
}
add_filter( 'wp', 'jetpackme_remove_rp', 20 );


/**
 * Add filter to customize speed of the Slideshow
 */

function deppo_fast_slideshow( $args ) {
	$new_speed = array(
		'speed' => '2000'
	);
	return array_replace( $args, $new_speed );
}
add_filter( 'jetpack_js_slideshow_settings', 'deppo_fast_slideshow' );

/**
 * Change compression quality in Photon
 */

function deppo_custom_photon_compression( $args ) {
	$args['quality'] = 99;
	return $args;
}
add_filter('jetpack_photon_pre_args', 'deppo_custom_photon_compression' );
