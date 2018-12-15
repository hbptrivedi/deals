<?php
/**
 * Daily Theme Customizer.
 *
 * @package    Daily
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

/**
 * Load textarea control for the customizer.
 *
 * @since  1.0.0
 */
function daily_textarea_customize_control() {
	require trailingslashit( get_template_directory() ) . 'inc/classes/customize-control-textarea.php';
}
add_action( 'customize_register', 'daily_textarea_customize_control', 1 );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @since  1.0.0
 * @param  WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function daily_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
	
	// Get the theme settings value.
	$options = optionsframework_options();

	// ==== Logo Setting ==== //
	$wp_customize->add_section(
		'daily_logo_section',
		array(
			'title'       => esc_html__( 'Logo', 'daily' ),
			'description' => __( 'If you use logo, the title and tagline will be replaced with the logo you uploaded.', 'daily' ),
			'priority'    => 25,
		)
	);

		$wp_customize->add_setting(
			'daily[daily_logo]',
			array(
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'esc_url_raw'
			)
		);

			$wp_customize->add_control(
				new WP_Customize_Image_Control( $wp_customize, 'daily_logo_control',
				array(
					'label'    => $options['daily_logo']['name'],
					'section'  => 'daily_logo_section',
					'settings' => 'daily[daily_logo]'
				)
			) );

}
add_action( 'customize_register', 'daily_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since 1.0.0
 */
function daily_customize_preview_js() {
	wp_enqueue_script( 'daily_customizer', trailingslashit( get_template_directory_uri() ) . 'assets/js/customizer.js', array( 'customize-preview' ), null, true );
}
add_action( 'customize_preview_init', 'daily_customize_preview_js' );