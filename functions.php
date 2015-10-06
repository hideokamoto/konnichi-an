<?php
/**
 * Konnichi An functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package Konnichi An
 */

if ( ! function_exists( 'konnichi_an_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function konnichi_an_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Konnichi An, use a find and replace
	 * to change 'konnichi-an' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'konnichi-an', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'konnichi-an' ),
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

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'konnichi_an_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	if ( ! isset( $content_width ) ) $content_width = 900;
}
endif; // konnichi_an_setup
add_action( 'after_setup_theme', 'konnichi_an_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function konnichi_an_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'konnichi_an_content_width', 640 );
}
add_action( 'after_setup_theme', 'konnichi_an_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function konnichi_an_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'konnichi-an' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'konnichi_an_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function konnichi_an_scripts() {
	wp_enqueue_style( 'konnichi_an-mdl-style', get_template_directory_uri().'/inc/mdl/material.min.css' );
	wp_enqueue_style( 'konnichi_an-mdl-icons', '//fonts.googleapis.com/icon?family=Material+Icons');
	wp_enqueue_style( 'konnichi_an-style', get_stylesheet_uri() );

	wp_enqueue_script( 'konnichi_an-mdl-scripts', get_template_directory_uri() . '/inc/mdl/material.min.js', array(), '20120206', true );
	wp_enqueue_script( 'konnichi_an-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'konnichi_an-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'konnichi_an_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

function konnichi_an_empty_menu(){
	echo "<li class='mdl-navigation__link'>". esc_html(__('No Menu', 'konnichi-an')). "</li>";
}

class konnichi_an_menu extends Walker
{
    public function walk( $elements, $max_depth )
    {
        $list = null;

        foreach ( $elements as $item ){
						$url = esc_url($item->url);
						$class = null;
						array_walk_recursive($item->classes, function($classes) use (&$class){
							$class .= $classes. " ";
						});
						$class .= "mdl-navigation__link";
            $list .= "<a href='{$url}' class='{$class}'>". esc_html($item->title). "</a>";
				}
        return $list;
    }
}
