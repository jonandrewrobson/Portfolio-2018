<?php
/**
 * deppo functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package deppo
 */

if ( ! function_exists( 'deppo_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function deppo_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on deppo, use a find and replace
	 * to change 'deppo' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'deppo', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );


	// custom video header
	add_theme_support( 'custom-header', array(
		'wp-head-callback' => 'deppo_header_style',
		'video-active-callback' => 'deppo_video_active_callback',
		'video' => true,
		'flex-width'    => true,
		'width'         => 1920,
		'flex-height'   => true,
		'height'        => 1080,
	) );

	function custom_video_active_callback() {
	  if( is_page_template( 'templates/home-slider.php' ) ) {
	    return true;
	  }
	  return false;
	}

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'deppo-single-post', 700 );
	add_image_size( 'deppo-archive-post', 680 );
	add_image_size( 'deppo-search-post', 280 );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'deppo' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );


	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 150,
		'height'      => 100,
		'flex-width'  => true,
		'flex-height'  => true,
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'deppo_setup' );

// add css for hideing header text
function deppo_header_style() {
	/*
	 * If header text is set to display, let's bail.
	 */
	if ( display_header_text() ) {
		return;
	} else {
	// If we get this far, we have custom styles. Let's do this.


		$add_data = '.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}';

		wp_add_inline_style( 'deppo-style', $add_data );
	}
}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function deppo_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'deppo_content_width', 640 );
}
add_action( 'after_setup_theme', 'deppo_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function deppo_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'deppo' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'deppo' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'deppo_widgets_init' );


/**
 * Registers an editor stylesheet for the theme.
 */
function deppo_add_editor_styles() {
	// Google Fonts
	add_editor_style( '/assets/fonts/hk-grotesk/stylesheet.css' );

	add_editor_style( 'editor-style.css' );
}
add_action( 'admin_init', 'deppo_add_editor_styles' );

/**
 * Enqueue scripts and styles.
 */
function deppo_scripts() {

	// Google Fonts
	wp_enqueue_style( 'deppo-font-enqueue', deppo_font_url(), array(), null );

	// Style
	wp_enqueue_style( 'deppo-style', get_stylesheet_uri() );

	wp_enqueue_style( 'deppo-style-fullpage', get_template_directory_uri() . '/js/jquery.fullpage.css' );

	deppo_header_style();

	// Change Fonts Style
	$change_fonts_style = wp_strip_all_tags( deppo_change_fonts() );
	wp_add_inline_style( 'deppo-style', $change_fonts_style );

	// Change Colors Style
	$change_colors_style = wp_strip_all_tags( deppo_change_colors() );
	wp_add_inline_style( 'deppo-style', $change_colors_style );

	deppo_header_style();

	wp_enqueue_script( 'deppo-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'deppo-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'deppo-fullpage', get_template_directory_uri() . '/js/jquery.fullpage.js', array(), '20151215', true );

	wp_enqueue_script( 'deppo-mcustom-scrollbar', get_template_directory_uri() . '/js/jquery.mCustomScrollbar.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	// Main JS file
	wp_enqueue_script( 'deppo-call-scripts', get_template_directory_uri() . '/js/common.js', array( 'jquery', 'masonry', 'thickbox' ), false, true );

	// Change google fonts

	// Get all customizer font settings
	$headings_font_family   = get_theme_mod( 'headings_font_family', 'default' );
	$paragraphs_font_family  = get_theme_mod( 'paragraphs_font_family', 'default' );
	$navigation_font_family = get_theme_mod( 'navigation_font_family', 'default' );

	if ( 'default' != $headings_font_family ) {
		wp_enqueue_style( 'deppo-headings-font', deppo_generate_headings_google_font_url(), array(), '1.0.0' );
	}
	if ( 'default' != $paragraphs_font_family ) {
		wp_enqueue_style( 'deppo-paragraph-font', deppo_generate_paragraphs_google_font_url(), array(), '1.0.0' );
	}
	if ( 'default' != $navigation_font_family ) {
		wp_enqueue_style( 'deppo-navigation-font', deppo_generate_navigation_google_font_url(), array(), '1.0.0' );
	}
}
add_action( 'wp_enqueue_scripts', 'deppo_scripts' );

/**
 * Adds theme default Google Fonts
 */
function deppo_font_url() {
    $fonts_url = '';

    /* Translators: If there are characters in your language that are not
    * supported by HK Grotesk, translate this to 'off'. Do not translate
    * into your own language.
    */
    $hk_grotesk    = esc_html_x( 'on', 'HK Grotesk font: on or off', 'deppo' );

    if ( 'off' === $hk_grotesk ) {

		return;

	} else {

        return get_stylesheet_directory_uri() . '/assets/fonts/hk-grotesk/stylesheet.css';

    }
}

/**
 * Enqueue admin scripts
 */
function deppo_add_admin_scripts() {
	// Admin styles
	wp_enqueue_style( 'deppo-admin-css', get_template_directory_uri() . '/inc/admin/admin.css' );
	wp_enqueue_style( 'wp-color-picker' );

	// Admin scripts
	wp_enqueue_media();
	wp_enqueue_script( 'my-upload' );
	wp_enqueue_script( 'jquery-ui' );
	wp_enqueue_script( 'wp-color-picker' );
	wp_enqueue_script( 'deppo-admin-js', get_template_directory_uri() . '/inc/admin/admin.js' );

	// Customizer settings
	wp_enqueue_script( 'deppo-admin-scripts', get_template_directory_uri() . '/inc/customizer/js/customizer-settings.js', array(), false, false );

	$js_vars = array(
		'url'                     => get_template_directory_uri(),
		'admin_url'               => esc_url( admin_url( 'admin-ajax.php' ) ),
		'nonce'                   => wp_create_nonce( 'ajax-nonce' ),
		'default_text'            => esc_html__( 'Theme default', 'deppo' ),
		'headings_font_variant'   => get_theme_mod( 'headings_font_weight', 'normal' ),
		'paragraphs_font_variant' => get_theme_mod( 'paragraphs_font_weight', 'normal' ),
		'navigation_font_variant' => get_theme_mod( 'navigation_font_weight', 'normal' )
	);
	wp_localize_script( 'deppo-admin-scripts', 'js_vars', $js_vars );
}
add_action( 'admin_enqueue_scripts', 'deppo_add_admin_scripts' );


/**
 * Generate headings google font url
 */
function deppo_generate_headings_google_font_url() {
	$headings_font_family = get_theme_mod( 'headings_font_family', 'default' );
	$fonts_url = '';
	$headings_font_weight = get_theme_mod( 'headings_font_weight', 'normal' );

	if ( 'regular' == $headings_font_weight ) {
		$headings_font_weight = '';
	}

	$fonts_url = esc_url('https://fonts.googleapis.com/css?family='.str_replace( ' ', '+', $headings_font_family ).':'. $headings_font_weight.'');
	return $fonts_url;
}

/**
 * Generate paragraph google font url
 */
function deppo_generate_paragraphs_google_font_url() {
	$paragraphs_font_family = get_theme_mod( 'paragraphs_font_family', 'default' );
	$fonts_url = '';
	$paragraphs_font_weight = get_theme_mod( 'paragraphs_font_weight', 'normal' );

	if ( 'regular' == $paragraphs_font_weight ) {
		$paragraphs_font_weight = '';
	}

	$fonts_url = esc_url('https://fonts.googleapis.com/css?family='.str_replace( ' ', '+', $paragraphs_font_family ).':'. $paragraphs_font_weight.'');
	return $fonts_url;
}

/**
 * Generate navigation google font url
 */
function deppo_generate_navigation_google_font_url() {
	$navigation_font_family = get_theme_mod( 'navigation_font_family', 'default' );
	$fonts_url = '';
	$navigation_font_weight = get_theme_mod( 'navigation_font_weight', 'normal' );

	if ( 'regular' == $navigation_font_weight ) {
		$navigation_font_weight = '';
	}

	$fonts_url = esc_url('https://fonts.googleapis.com/css?family='.str_replace( ' ', '+', $navigation_font_family ).':'. $navigation_font_weight.'');
	return $fonts_url;
}


/**
 * Show Admin Bar
 */

function myplugin_remove_admin_bar() {
	if ( ! current_user_can( 'publish_posts' ) ) {
		show_admin_bar( true );
	}
}
add_action( 'plugins_loaded', 'myplugin_remove_admin_bar' );


/**
 * One click demo import settings
 */
function deppo_import_files() {
  return array(
    array(
      'import_file_name'           => 'Deppo Demo 1',
      'import_file_url'            => get_template_directory_uri().'/import/demo1/content.xml',
      'import_widget_file_url'     => get_template_directory_uri().'/import/demo1/widgets.json',
      'import_customizer_file_url' => get_template_directory_uri().'/import/demo1/customizer.dat',
      'import_preview_image_url'   => get_template_directory_uri().'/import/demo1/screenshot.png',
      'import_notice'              => esc_html__( 'You can speed up development of your site by importing our sample site content like posts and images. The imported images are copyrighted and are for demo use only. Please replace them with your own images after importing.', 'deppo' ),
    ),
    /*
    array(
      'import_file_name'           => 'Deppo Demo 2',
      'import_file_url'            => get_template_directory_uri().'/import/demo2/content.xml',
      'import_widget_file_url'     => get_template_directory_uri().'/import/demo2/widgets.json',
      'import_customizer_file_url' => get_template_directory_uri().'/import/demo2/customizer.dat',
      'import_preview_image_url'   => get_template_directory_uri().'/import/demo2/screenshot.png',
      'import_notice'              => esc_html__( 'You can speed up development of your site by importing our sample site content like posts and images. The imported images are copyrighted and are for demo use only. Please replace them with your own images after importing.', 'deppo' ),
    ),
    */
    array(
      'import_file_name'           => 'Deppo Demo 3',
      'import_file_url'            => get_template_directory_uri().'/import/demo3/content.xml',
      'import_widget_file_url'     => get_template_directory_uri().'/import/demo3/widgets.json',
      'import_customizer_file_url' => get_template_directory_uri().'/import/demo3/customizer.dat',
      'import_preview_image_url'   => get_template_directory_uri().'/import/demo3/screenshot.png',
      'import_notice'              => esc_html__( 'You can speed up development of your site by importing our sample site content like posts and images. The imported images are copyrighted and are for demo use only. Please replace them with your own images after importing.', 'deppo' ),
    ),
  );
}
add_filter( 'pt-ocdi/import_files', 'deppo_import_files' );

/**
 * Customize colors.
 */
require get_template_directory() . '/inc/change-colors.php';

/**
 * Add custom meta boxes
 */
require_once get_template_directory() . '/inc/metaboxes/meta-boxes.php';

/**
 * Load Custom post type metta settings
 */
require get_template_directory() . '/inc/metaboxes/custom-post-meta-settings.php';

/**
 * Load Custom post meta array
 */
require get_template_directory() . '/inc/metaboxes/custom-post-meta.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load plugin activation script file.
 */
require get_template_directory() . '/inc/plugin-activation.php';


