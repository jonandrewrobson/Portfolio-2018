<?php
/**
 * Customization of theme layout
 *
 * @package deppo
 */

// Slider autoplay
$wp_customize->add_setting( 'logo-size', array(
    'default'    => 100,
    'sanitize_callback' => 'deppo_sanitize_number_range',
) );

$wp_customize->add_control( new Customizer_Range_Value_Control( $wp_customize, 'logo-size', array(
    'type'     => 'range-value',
    'section'  => 'title_tagline',
    'settings' => 'logo-size',
    'priority' => 8,
    'label'    => __( 'Logo Size' ),
    'input_attrs' => array(
        'min'    => 50,
        'max'    => 150,
        'step'   => 10,
        'suffix' => '%', //optional suffix
      ),
) ) );
