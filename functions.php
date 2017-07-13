<?php
/**
 * ASUFSE_SpokenWord functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ASUFSE_SpokenWord
 */

if ( ! function_exists( 'asufse_spokenword_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function asufse_spokenword_setup() {
	load_theme_textdomain( 'asufse_spokenword', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'asufse_spokenword' ),
	) );

	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'asufse_spokenword_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

}
endif;
add_action( 'after_setup_theme', 'asufse_spokenword_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 * Priority 0 to make it available to lower priority callbacks.
 * @global int $content_width
 */
function asufse_spokenword_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'asufse_spokenword_content_width', 640 );
}
add_action( 'after_setup_theme', 'asufse_spokenword_content_width', 0 );

/**
 * Register widget area.
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function asufse_spokenword_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'asufse_spokenword' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'asufse_spokenword' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'asufse_spokenword_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function asufse_spokenword_scripts() {
	wp_enqueue_style( 'asufse_spokenword-style', get_stylesheet_uri() );
	wp_enqueue_script( 'asufse_spokenword-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'asufse_spokenword-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'asufse_spokenword_scripts' );

/* Custom template tags for this theme.  */
require get_template_directory() . '/inc/template-tags.php';

/* Functions which enhance the theme by hooking into WordPress. */
require get_template_directory() . '/inc/template-functions.php';


/* Customizations for Spoken Word Project:
 =============================== */

	// First, load the CPT file & the theme options panel.
	require get_template_directory() . '/spokennews_cpt.php';
	// Phase 2 Requirement: require get_template_directory() . '/spokennews_options.php';


	// Hide 'posts' from the menu, for clarity. Has the effect of removing it from the DB
	add_action('admin_menu','remove_default_post_type');

	function remove_default_post_type() {
		remove_menu_page('edit.php');
	}
