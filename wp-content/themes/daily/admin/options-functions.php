<?php
/**
 * Custom functions for the theme options.
 *
 * @package    Daily
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

/**
 * Theme options header.
 *
 * @since  1.0.0
 */
function daily_of_header() {
	$theme = wp_get_theme();
	$name  = $theme->get( 'TextDomain' );
?>
	<div class="header-options">
		<ul class="theme-info">
			<li><span class="dashicons dashicons-info"></span><a href="http://docs.theme-junkie.com/<?php echo esc_attr( $name ); ?>" target="_blank"><?php _e( 'Documentation', 'daily' ); ?></a></li>
			<li><span class="dashicons dashicons-lightbulb"></span><a href="http://www.theme-junkie.com/forum/" target="_blank"><?php _e( 'Support Forum', 'daily' ); ?></a></li>
			<li><span class="dashicons dashicons-twitter"></span><a href="https://twitter.com/theme_junkie" target="_blank">Follow Us</a></li>
			<li><span class="dashicons dashicons-facebook"></span><a href="https://www.facebook.com/themejunkies" target="_blank">Like Us</a></li>
		</ul>
	</div>
<?php
}
add_action( 'optionsframework_header_options', 'daily_of_header' );

/**
 * Favicon output.
 *
 * @since 1.0.0
 */
function daily_favicon_output() {
	$favicon = of_get_option( 'daily_favicon' );

	if ( !empty( $favicon ) ) {
		echo '<link href="' . esc_url( $favicon ) . '" rel="icon">' . "\n";
	}

}
add_action( 'wp_head', 'daily_favicon_output', 5 );

/**
 * Mobile Icon output.
 *
 * @since 1.0.0
 */
function daily_mobile_icon_output() {
	$icon = of_get_option( 'daily_mobile_icon' );

	if ( !empty( $icon ) ) {
		echo '<link rel="apple-touch-icon-precomposed" href="' . esc_url( $icon ) . '">' . "\n";
	}

}
add_action( 'wp_head', 'daily_mobile_icon_output', 6 );

/**
 * Custom RSS feed url.
 *
 * @since  1.0.0
 * @return string
 */
function daily_feed_url( $output, $feed ) {

	// Get the custom rss feed url.
	$url = of_get_option( 'daily_feedburner_url' );

	// Do not redirect comments feed
	if ( strpos( $output, 'comments' ) ) {
		return $output;
	}

	// Check the settings.
	if ( !empty( $url ) ) {
		$output = esc_url( $url );
	}

	return $output;
}
add_filter( 'feed_link', 'daily_feed_url', 10, 2 );

/**
 * Single post advertisement.
 * Before content.
 *
 * @since  1.0.0
 */
function daily_single_ad_before( $content ) {
	$ad = of_get_option( 'daily_ad_single_before' );

	if ( is_single() ) {
		$content = stripslashes( $ad ) . $content;
	} else {
		$content;
	}

	return $content;

}
add_filter( 'the_content', 'daily_single_ad_before', 20 );

/**
 * Single post advertisement.
 * After content.
 *
 * @since  1.0.0
 */
function daily_single_ad_after( $content ) {
	$ad = of_get_option( 'daily_ad_single_after' );

	if ( is_single() ) {
		$content = $content . stripslashes( $ad );
	} else {
		$content;
	}

	return $content;

}
add_filter( 'the_content', 'daily_single_ad_after', 20 );

/**
 * Tracking Code
 *
 * @since  1.0.0
 */
function daily_tracking_code() {
	$tracking_code = of_get_option( 'daily_tracking_code' );

	if ( !empty( $tracking_code ) ) {
		echo stripslashes( $tracking_code ) . "\n";
	}

}
add_action( 'wp_footer', 'daily_tracking_code', 15 );

/**
 * Header Code
 *
 * @since  1.0.0
 */
function daily_header_code() {
	$header_code = of_get_option( 'daily_script_head' );

	if ( !empty( $header_code ) ) {
		echo stripslashes( $header_code ) . "\n";
	}

}
add_action( 'wp_head', 'daily_header_code', 20 );

/**
 * Footer Code
 *
 * @since  1.0.0
 */
function daily_footer_code() {
	$footer_code = of_get_option( 'daily_script_footer' );

	if ( !empty( $footer_code ) ) {
		echo stripslashes( $footer_code ) . "\n";
	}

}
add_action( 'wp_footer', 'daily_footer_code', 20 );