<?php
/**
 * Enqueue scripts and styles.
 *
 * @package    Daily
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

/**
 * Loads the theme styles & scripts.
 *
 * @since 1.0.0
 * @link  http://codex.wordpress.org/Function_Reference/wp_enqueue_script
 * @link  http://codex.wordpress.org/Function_Reference/wp_enqueue_style
 */
function daily_enqueue() {

	// if WP_DEBUG and/or SCRIPT_DEBUG turned on, load the unminified styles & script.
	if ( ! is_child_theme() && WP_DEBUG || SCRIPT_DEBUG ) {

		// Load main stylesheet
		wp_enqueue_style( 'daily-style', get_stylesheet_uri() );

		// Load custom js plugins.
		wp_enqueue_script( 'daily-plugins', trailingslashit( get_template_directory_uri() ) . 'assets/js/plugins.min.js', array( 'jquery' ), null, true );

		// Load custom js methods.
		wp_enqueue_script( 'daily-main', trailingslashit( get_template_directory_uri() ) . 'assets/js/main.js', array( 'jquery' ), null, true );

	} else {

		// Load main stylesheet
		wp_enqueue_style( 'daily-style', trailingslashit( get_template_directory_uri() ) . 'style.min.css' );

		// Load custom js plugins.
		wp_enqueue_script( 'daily-scripts', trailingslashit( get_template_directory_uri() ) . 'assets/js/daily.min.js', array( 'jquery' ), null, true );

	}

	// Load responsive stylesheet
	wp_enqueue_style( 'daily-responsive', trailingslashit( get_template_directory_uri() ) . 'assets/css/responsive.css' );

	// Load skin stylesheet
	wp_enqueue_style( 'daily-colors', trailingslashit( get_template_directory_uri() ) . 'assets/css/colors/default.css' );

	// If child theme is active, load the stylesheet.
	if ( is_child_theme() ) {
		wp_enqueue_style( 'daily-child-style', get_stylesheet_uri() );
	}

	// Load comment-reply script.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Loads HTML5 Shiv
	wp_enqueue_script( 'daily-html5', trailingslashit( get_template_directory_uri() ) . 'assets/js/html5shiv.js', array( 'jquery' ), null, false );
	wp_script_add_data( 'daily-html5', 'conditional', 'lte IE 9' );

}
add_action( 'wp_enqueue_scripts', 'daily_enqueue' );

/**
 * Mobile navigation scripts.
 *
 * @since  1.0.0
 */
function daily_mobile_nav_script() {
	?>
	<script type="text/javascript">

		$(document).ready(function(){
			$('#primary-menu').slicknav({
				prependTo:'#primary-bar',
				label: "PAGES"
			});
			$('#secondary-menu').slicknav({
				prependTo:'#secondary-bar',
				label: "CATEGORIES"
			});
		});

	</script>
	<?php
}
add_action( 'wp_footer', 'daily_mobile_nav_script', 20 );