<?php
/**
 * Theme functions file
 *
 * Contains all of the Theme's setup functions, custom functions,
 * custom hooks and Theme settings.
 * 
 * @package    Daily
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 676; /* pixels */
}

if ( ! function_exists( 'daily_content_width' ) ) :
/**
 * Set new content width if user uses 1 column layout.
 *
 * @since  1.0.0
 */
function daily_content_width() {
	global $content_width;

	if ( in_array( get_theme_mod( 'theme_layout' ), array( '1c' ) ) ) {
		$content_width = 960;
	}
}
endif;
add_action( 'template_redirect', 'daily_content_width' );

if ( ! function_exists( 'daily_theme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @since  1.0.0
 */
function daily_theme_setup() {

	// Make the theme available for translation.
	load_theme_textdomain( 'daily', trailingslashit( get_template_directory() ) . 'languages' );

	// Add custom stylesheet file to the TinyMCE visual editor.
	add_editor_style( array( 'assets/css/editor-style.css' ) );

	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails.
	add_theme_support( 'post-thumbnails' );

	// Declare image sizes.
	add_image_size( 'daily-big-thumb', 300, 300, true );
	add_image_size( 'daily-grid-thumb', 100, 100, true );
	add_image_size( 'daily-classic-thumb', 150, 150, true );
	add_image_size( 'daily-blog-thumb', 823, 450, true );
	add_image_size( 'daily-widget-thumb', 60, 60, true );
	add_image_size( 'daily-widget-thumb-big', 300, 180, true );

	// Register custom navigation menu.
	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'daily' ),
			'secondary' => __( 'Secondary Menu', 'daily' ),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-list', 'search-form', 'comment-form', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See: http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'image', 'video'
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'daily_custom_background_args', array(
		'default-color' => 'efefef',
		'default-image' => '',
	) ) );

	// Enable theme-layouts extensions.
	add_theme_support( 'theme-layouts', 
		array(
			'1c'   => __( '1 Column Wide (Full Width)', 'daily' ),
			'2c-l' => __( '2 Columns: Content / Sidebar 1', 'daily' ),
			'2c-r' => __( '2 Columns: Sidebar 1 / Content', 'daily' ),
			'3c-l' => __( '3 Columns: Content / Sidebar 2 / Sidebar 1', 'daily' ),
			'3c-r' => __( '3 Columns: Sidebar 1 / Sidebar 2 / Content', 'daily' ),
			'3c-1' => __( '3 Columns: Sidebar 1 / Content / Sidebar 2', 'daily' ),
			'3c-2' => __( '3 Columns: Sidebar 2 / Content / Sidebar 1', 'daily' )
		),
		array( 'customize' => true, 'default' => '3c-l' ) 
	);

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );

}
endif; // daily_theme_setup
add_action( 'after_setup_theme', 'daily_theme_setup' );

/**
 * Registers custom widgets.
 *
 * @since 1.0.0
 * @link  http://codex.wordpress.org/Function_Reference/register_widget
 */
function daily_widgets_init() {

	// Register ad 125 widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-ads125.php';
	register_widget( 'Daily_Ads125_Widget' );

	// Register ad widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-ads.php';
	register_widget( 'Daily_Ads_Widget' );

	// Register feedburner widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-feedburner.php';
	register_widget( 'Daily_Feedburner_Widget' );

	// Register recent posts thumbnail widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-recent.php';
	register_widget( 'Daily_Recent_Widget' );

	// Register popular posts thumbnail widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-popular.php';
	register_widget( 'Daily_Popular_Widget' );

	// Register random posts thumbnail widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-random.php';
	register_widget( 'Daily_Random_Widget' );

	// Register most views posts thumbnail widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-views.php';
	register_widget( 'Daily_Views_Widget' );

	// Register tabs widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-tabs.php';
	register_widget( 'Daily_Tabs_Widget' );

	// Register twitter widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-twitter.php';
	register_widget( 'Daily_Twitter_Widget' );

	// Register video widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-video.php';
	register_widget( 'Daily_Video_Widget' );
	
}
add_action( 'widgets_init', 'daily_widgets_init' );

/**
 * Registers widget areas and custom widgets.
 *
 * @since 1.0.0
 * @link  http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function daily_sidebars_init() {

	register_sidebar(
		array(
			'name'          => __( 'Primary Sidebar', 'daily' ),
			'id'            => 'primary',
			'description'   => __( 'Main sidebar that appears on the right.', 'daily' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Secondary Sidebar', 'daily' ),
			'id'            => 'secondary',
			'description'   => __( 'Mini sidebar, ussualy in the middle.', 'daily' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title"><strong>',
			'after_title'   => '</strong></h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 1', 'supernews' ),
			'id'            => 'footer-1',
			'description'   => __( 'The footer sidebar 1st column.', 'supernews' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 2', 'supernews' ),
			'id'            => 'footer-2',
			'description'   => __( 'The footer sidebar 2nd column.', 'supernews' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 3', 'supernews' ),
			'id'            => 'footer-3',
			'description'   => __( 'The footer sidebar 3rd column.', 'supernews' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 4', 'supernews' ),
			'id'            => 'footer-4',
			'description'   => __( 'The footer sidebar 4th column.', 'supernews' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
	
}
add_action( 'widgets_init', 'daily_sidebars_init' );

/**
 * Custom archive page layout classes.
 *
 * @since  1.0.0
 */
function daily_archive_page_classes() {

	// Get the default layout.
	if ( is_category() ) {
		$category = get_category( get_query_var( 'cat' ), false );
		$layout = get_tax_meta( $category->term_id, 'daily_cat_layout', true );
		if ( empty( $layout ) ) {
			$layout = 'classic';
		}
	} elseif ( is_home() ) {
		$layout = of_get_option( 'daily_home_layout', 'classic' );
	} elseif ( is_tag() ) {
		$layout = of_get_option( 'daily_tag_layout', 'classic' );
	} elseif ( is_author() ) {
		$layout = of_get_option( 'daily_author_layout', 'classic' );
	} elseif ( is_search() ) {
		$layout = of_get_option( 'daily_search_layout', 'classic' );
	} else {
		$layout = of_get_option( 'daily_archive_layout', 'classic' );
	}

	// Set up empty variable.
	$class = '';

	if ( 'standard' === $layout ) {
		$class = 'blog-list';
	} elseif ( 'classic' === $layout ) {
		$class = 'list';
	} elseif ( 'grid' === $layout ) {
		$class = 'grid';
	}

	// Allow dev to filter the class.
	return apply_filters( 'daily_archive_page_classes', $class );

}

/**
 * Home columns.
 *
 * @since  1.0.0
 */
add_filter( 'theme_mod_theme_layout', 'daily_home_columns', 99 );

function daily_home_columns( $layout ) {

	if ( is_home() )
		$layout = of_get_option('daily_home_columns');

	return $layout;
}

/**
 * Custom template tags for this theme.
 */
require trailingslashit( get_template_directory() ) . 'inc/template-tags.php';

/**
 * Enqueue scripts and styles.
 */
require trailingslashit( get_template_directory() ) . 'inc/scripts.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require trailingslashit( get_template_directory() ) . 'inc/extras.php';

/**
 * Customizer additions.
 */
require trailingslashit( get_template_directory() ) . 'inc/customizer.php';

/**
 * Require and recommended plugins list.
 */
require trailingslashit( get_template_directory() ) . 'inc/plugins.php';

/**
 * Load Options Framework core.
 */
define( 'OPTIONS_FRAMEWORK_DIRECTORY', trailingslashit( get_template_directory_uri() ) . 'admin/' );
require trailingslashit( get_template_directory() ) . 'admin/options-framework.php';
require trailingslashit( get_template_directory() ) . 'admin/options.php';
require trailingslashit( get_template_directory() ) . 'admin/options-functions.php';

/**
 * We use some part of Hybrid Core to extends our themes.
 *
 * @link  http://themehybrid.com/hybrid-core Hybrid Core site.
 */
require trailingslashit( get_template_directory() ) . 'inc/hybrid/attr.php';
require trailingslashit( get_template_directory() ) . 'inc/hybrid/breadcrumb-trail.php';
require trailingslashit( get_template_directory() ) . 'inc/hybrid/loop-pagination.php';
require trailingslashit( get_template_directory() ) . 'inc/hybrid/theme-layouts.php';
require trailingslashit( get_template_directory() ) . 'inc/hybrid/entry-views.php';
require trailingslashit( get_template_directory() ) . 'inc/hybrid/hybrid-media-grabber.php';

/**
 * Mega menus walker.
 */
require trailingslashit( get_template_directory() ) . 'inc/megamenus/init.php';
require trailingslashit( get_template_directory() ) . 'inc/megamenus/class-primary-nav-walker.php';

/**
 * Load taxonomy framework.
 */
require trailingslashit( get_template_directory() ) . 'admin/taxonomy/Tax-meta-class.php';
require trailingslashit( get_template_directory() ) . 'admin/taxonomy/tax-meta.php';