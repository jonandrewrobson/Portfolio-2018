<?php
/**
 * Customizer Custom Colors
 *
 * Here you can define your own CSS rules
 *
 * @package  deppo
 */


/**
 *
 * Settings
 *
 */

/* GENERAL COLORS */


// Body BG color
$wp_customize->add_setting( 'deppo_body_background_color', array(
    'default'           => '#fff',
    'sanitize_callback' => 'deppo_sanitize_color'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'deppo_body_background_color',
        array(
            'label'    => esc_html__( 'Background Color', 'deppo' ),
            'section'  => 'deppo_colors_section',
            'priority' => 0
        ) )
);

// Body text color
$wp_customize->add_setting( 'deppo_body_text_color', array(
    'default'           => '#000',
    'sanitize_callback' => 'deppo_sanitize_color'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'deppo_body_text_color',
        array(
            'label'    => esc_html__( 'Body Text Color', 'deppo' ),
            'section'  => 'deppo_colors_section',
            'priority' => 1
        ) )
);

// Divider
$wp_customize->add_setting( 'deppo_cta_divider_1', array(
    'sanitize_callback' => 'deppo_sanitize_text',
) );

// Divider
$wp_customize->add_control( new WP_Customize_Divider_Control(
    $wp_customize,
    'deppo_cta_divider_1',
        array(
            'section'  => 'deppo_colors_section',
            'priority' => 2
        )
) );

// Nav text color
$wp_customize->add_setting( 'deppo_nav_text_color', array(
    'default'           => '#000',
    'sanitize_callback' => 'deppo_sanitize_color'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'deppo_nav_text_color',
        array(
            'label'    => esc_html__( 'Navigation Text Color', 'deppo' ),
            'section'  => 'deppo_colors_section',
            'priority' => 4
        ) )
);

// Blend Mode control for navigation
$wp_customize->add_setting( 'nav-blend-settings', array(
    'default'           => 0,
    'sanitize_callback' => 'deppo_sanitize_slider_text',
) );

$wp_customize->add_control( 'nav-blend-settings', array(
    'label'    => esc_html__( 'Enable blend mode for Navigation', 'deppo' ),
    'description' => esc_html__( 'This will override color you set above for navigation and change color in response to backgound behind text.', 'deppo' ) . '<br/>' . esc_html__( '*Keep in mind that the Site Logo will also be affected by this.', 'deppo' ) . '<br/>' . esc_html__( '*IE and Edge don&#39;t support this feature.', 'deppo' ),
    'priority' => 5,
    'section'  => 'deppo_colors_section',
    'type'     => 'radio',
    'choices'  => array(
        1  => esc_html__( 'On', 'deppo' ),
        0  => esc_html__( 'Off', 'deppo' ),
    ),
) );

// Divider
$wp_customize->add_setting( 'deppo_cta_divider_2', array(
    'sanitize_callback' => 'deppo_sanitize_text',
) );

// Divider
$wp_customize->add_control( new WP_Customize_Divider_Control(
    $wp_customize,
    'deppo_cta_divider_2',
        array(
            'section'  => 'deppo_colors_section',
            'priority' => 10
        )
) );

// Body BG color
$wp_customize->add_setting( 'deppo_sidebar_background_color', array(
    'default'           => '#fff',
    'sanitize_callback' => 'deppo_sanitize_color'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'deppo_sidebar_background_color',
        array(
            'label'    => esc_html__( 'Sidebar Background Color', 'deppo' ),
            'section'  => 'deppo_colors_section',
            'priority' => 12
        ) )
);

// Body text color
$wp_customize->add_setting( 'deppo_sidebar_text_color', array(
    'default'           => '#000',
    'sanitize_callback' => 'deppo_sanitize_color'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'deppo_sidebar_text_color',
        array(
            'label'    => esc_html__( 'Sidebar Text Color', 'deppo' ),
            'section'  => 'deppo_colors_section',
            'priority' => 15
        ) )
);
