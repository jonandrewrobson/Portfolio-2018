<?php
/**
 * Customizer Footer
 *
 * Here you can define layout settings
 *
 * @package  deppo
 */

/* --- Section --- */

// Layout Section
$wp_customize->add_section( 'footer_section', array(
	'title'    => esc_html__( 'Footer Settings', 'deppo' ),
	'priority' => 120,
	'panel'    => 'deppo_options_panel'
) );

/* --- Settings --- */

// Footer Copyright text
$wp_customize->add_setting( 'deppo_footer_copyright', array(
	'default'           => '',
	'sanitize_callback' => 'deppo_sanitize_text',
) );

$wp_customize->add_control( 'deppo_footer_copyright', array(
	'label'       => esc_html__( 'Footer Copyright Text', 'deppo' ),
	'description' => esc_html__( 'Add text to footer copyright area. HTML elements can be used for formating.', 'deppo' ),
	'section'     => 'footer_section',
	'priority'    => 0,
	'settings'    => 'deppo_footer_copyright',
	'type'        => 'textarea'
) );
