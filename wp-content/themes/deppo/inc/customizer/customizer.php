<?php
/**
 * deppo Theme Customizer
 *
 * @package deppo
 */

// Load Customizer specific functions
require get_template_directory() . '/inc/customizer/functions/customizer-sanitization.php';
require get_template_directory() . '/inc/customizer/functions/customizer-functions.php';

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function deppo_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Remove default Colors section
	$wp_customize->remove_section( 'colors' );

	// Remove default Header options except Display header text option

	$wp_customize->remove_control( 'header_textcolor' );

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'deppo_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'deppo_customize_partial_blogdescription',
		) );
	}

	/**
	 * PANELS
	 */
	// Home Slider
	$wp_customize->add_panel( 'deppo_slider_panel', array(
		'priority'    => 280,
		'capability'  => 'edit_theme_options',
	    'title'       => esc_html__( 'Home Slider Options', 'deppo' ),
	    'description' => esc_html__( 'For customizing Home Slider Page', 'deppo' ),
	) );

	$wp_customize->add_panel( 'deppo_options_panel', array(
		'priority'    => 300,
		'capability'  => 'edit_theme_options',
		'title'       => esc_html__( 'Theme Options', 'deppo' ),
		'description' => esc_html__( 'deppo Theme Options', 'deppo' )
	) );

	// Colors Section
	$wp_customize->add_section( 'deppo_colors_section', array(
	    'title'       => esc_html__( 'Color Settings', 'deppo' ),
	    'description' => esc_html__( 'For customizing theme colors', 'deppo' ),
	    'priority'    => 80,
	    'panel'    => 'deppo_options_panel'
	) );

	// move featured content and header media and change name and order

	$wp_customize->get_section('header_image')->panel = 'deppo_slider_panel';
	$wp_customize->get_section('header_image')->priority = 6;
	$wp_customize->get_section('header_image')->title = esc_html__( 'Video - Header Media', 'deppo' );

	if ( class_exists( 'Jetpack' )) {
		$wp_customize->get_section('featured_content')->panel = 'deppo_slider_panel';
		$wp_customize->get_section('featured_content')->priority = 4;
		$wp_customize->get_section('featured_content')->title = esc_html__( 'Slider - Featured Content', 'deppo' );
	} else {
		$wp_customize->add_section( 'enable_jetpack_settings', array(
		    'title'    => esc_html__( 'Slider', 'deppo' ),
		    'priority' => 4,
		    'panel'    => 'deppo_slider_panel',
		    'description' => esc_html__( 'Install Jetpack plugin to enable Slider', 'deppo' ),
		) );

		// Divider
		$wp_customize->add_setting( 'deppo_jetpack_divider', array(
		    'sanitize_callback' => 'deppo_sanitize_text',
		) );

		// Divider
		$wp_customize->add_control( new WP_Customize_Divider_Control(
		    $wp_customize,
		    'deppo_jetpack_divider',
		        array(
		            'section'  => 'enable_jetpack_settings',
		            'priority' => 1
		        )
		) );
	}


	/**
	 * SECTIONS AND SETTINGS
	 */

	// Layout settings
	require get_template_directory() . '/inc/customizer/settings/customizer-layout.php';

	// Footer Settings
	require get_template_directory() . '/inc/customizer/settings/customizer-footer.php';

	// Colors
	require get_template_directory() . '/inc/customizer/settings/customizer-colors.php';

	// Google fonts
	require get_template_directory() . '/inc/customizer/settings/customizer-google-fonts.php';

}
add_action( 'customize_register', 'deppo_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function deppo_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function deppo_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function deppo_customize_preview_js() {
	wp_enqueue_script( 'deppo-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'deppo_customize_preview_js' );
