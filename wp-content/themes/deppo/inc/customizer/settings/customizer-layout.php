<?php
/**
 * Customization of theme layout
 *
 * @package deppo
 */


/**
 * Section
 */

$wp_customize->add_section( 'slider_settings', array(
    'title'    => esc_html__( 'Options', 'deppo' ),
    'priority' => 2,
    'panel'    => 'deppo_slider_panel',
    'description' => esc_html__( 'To setup slider visit "Slider - Featured Content" section and for video go to "Video - Header Media".', 'deppo' ) . '<br/>' . esc_html__( '*If you turn on video, it will hide slider.', 'deppo' ),
) );

/**
 * Settings
 */

// Slider text position
$wp_customize->add_setting( 'display-slider-settings', array(
    'default'           => 1,
    'sanitize_callback' => 'deppo_sanitize_slider_text',
) );

$wp_customize->add_control( 'display-slider-settings', array(
    'label'    => esc_html__( 'Position of Titles', 'deppo' ),
    'description' => esc_html__( 'Do you want it big, bold and centered or discreetly in lower corner', 'deppo' ),
    'priority' => 1,
    'section'  => 'slider_settings',
    'type'     => 'radio',
    'choices'  => array(
        1  => esc_html__( 'Centered', 'deppo' ),
        0  => esc_html__( 'In corner', 'deppo' ),
    ),
) );

// Add color of text to header image/video section
$wp_customize->add_setting( 'header_section_color', array(
    'default'           => '#000',
    'sanitize_callback' => 'deppo_sanitize_color'
) );

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'header_section_color',
        array(
            'label'    => esc_html__( 'Title Text Color', 'deppo' ),
            'section'  => 'slider_settings',
            'priority' => 2
        ) )
);

// Slider Title blend mode
$wp_customize->add_setting( 'slider-title-blend-settings', array(
    'default'           => 0,
    'sanitize_callback' => 'deppo_sanitize_slider_text',
) );

$wp_customize->add_control( 'slider-title-blend-settings', array(
    'label'    => esc_html__( 'Enable blend mode for Slider Titles', 'deppo' ),
    'description' => esc_html__( 'This will override color you set above and change color in response to backgound behind text. *IE and Edge don&#39;t support this feature.', 'deppo' ),
    'priority' => 3,
    'section'  => 'slider_settings',
    'type'     => 'radio',
    'choices'  => array(
        1  => esc_html__( 'On', 'deppo' ),
        0  => esc_html__( 'Off', 'deppo' ),
    ),
) );

// Slider autoplay
$wp_customize->add_setting( 'autoplay-slider-settings', array(
    'default'    => 0,
    'sanitize_callback' => 'deppo_sanitize_checkbox',
) );

// Add control and output for select field
$wp_customize->add_control( 'autoplay-slider-settings', array(
    'label'      => esc_html__( 'Autoplay slider', 'deppo' ),
    'section'    => 'featured_content',
    'priority'   => 100,
    'type'       => 'checkbox',
    'std'        => 0
) );

// Slider autoplay
$wp_customize->add_setting( 'slider-numeration-settings', array(
    'default'    => 1,
    'sanitize_callback' => 'deppo_sanitize_checkbox',
) );

// Add control and output for select field
$wp_customize->add_control( 'slider-numeration-settings', array(
    'label'      => esc_html__( 'Show slide numeration', 'deppo' ),
    'section'    => 'featured_content',
    'priority'   => 101,
    'type'       => 'checkbox',
    'std'        => 1
) );

/**
 * Section
 */
$wp_customize->add_section( 'portfolio_settings', array(
    'title'    => esc_html__( 'Portfolio Archive Options', 'deppo' ),
    'priority' => 10,
    'panel'    => 'deppo_options_panel'
) );

/**
 * Settings
 */

// Portfolio archive display
$wp_customize->add_setting( 'portfolio-archive-settings', array(
    'default'           => 2,
    'sanitize_callback' => 'deppo_sanitize_post_navigation',
) );

$wp_customize->add_control( 'portfolio-archive-settings', array(
    'label'    => esc_html__( 'Portfolio Layout', 'deppo' ),
    'description' => esc_html__( 'Shuffle will scatter articles around, boxed will tuck them inside fixed boxes and grid will neatly place them in grid', 'deppo' ),
    'priority' => 1,
    'section'  => 'portfolio_settings',
    'type'     => 'radio',
    'choices'  => array(
        2  => esc_html__( 'Shuffle', 'deppo' ),
        1  => esc_html__( 'Boxed', 'deppo' ),
        0  => esc_html__( 'Grid', 'deppo' ),
    ),
) );

// Slider autoplay
$wp_customize->add_setting( 'portfolio-hover-title-settings', array(
    'default'    => 0,
    'sanitize_callback' => 'deppo_sanitize_checkbox',
) );

// Add control and output for select field
$wp_customize->add_control( 'portfolio-hover-title-settings', array(
    'label'      => esc_html__( 'On hover display title instead
of cursor', 'deppo' ),
    'section'    => 'portfolio_settings',
    'priority'   => 2,
    'type'       => 'checkbox',
    'std'        => 1
) );

/**
 * Section
 */
$wp_customize->add_section( 'portfolio_single_settings', array(
    'title'    => esc_html__( 'Portfolio Single Options', 'deppo' ),
    'priority' => 11,
    'panel'    => 'deppo_options_panel'
) );

// Port Single hide slide numeration
$wp_customize->add_setting( 'port-single-numeration-settings', array(
    'default'    => 1,
    'sanitize_callback' => 'deppo_sanitize_checkbox',
) );

// Add control and output for select field
$wp_customize->add_control( 'port-single-numeration-settings', array(
    'label'      => esc_html__( 'Show slide numeration', 'deppo' ),
    'section'    => 'portfolio_single_settings',
    'priority'   => 1,
    'type'       => 'checkbox',
    'std'        => 1
) );

/**
 * Section
 */
$wp_customize->add_section( 'post_settings', array(
    'title'    => esc_html__( 'Post Single Options', 'deppo' ),
    'priority' => 12,
    'panel'    => 'deppo_options_panel'
) );

/**
 * Settings
 */

// Blog layout
$wp_customize->add_setting( 'display-navigation-settings', array(
    'default'           => 2,
    'sanitize_callback' => 'deppo_sanitize_post_navigation',
) );

$wp_customize->add_control( 'display-navigation-settings', array(
    'label'    => esc_html__( 'Post Navigation Position', 'deppo' ),
    'description' => esc_html__( 'On mobile devices fixed to sides navigation will be placed under content', 'deppo' ),
    'priority' => 1,
    'section'  => 'post_settings',
    'type'     => 'radio',
    'choices'  => array(
        2 => esc_html__( 'Fixed on sides', 'deppo' ),
        1  => esc_html__( 'Under content', 'deppo' ),
        0  => esc_html__( 'Hidden', 'deppo' ),
    ),
) );
