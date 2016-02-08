<?php
/**
 * BCom Theme Customizer
 *
 * @package BCom
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function bcom_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	// Optionally disable individual customizer options.
	// 
	// $wp_customize->remove_control('blogdescription');

	// Optionally disable customizer sections.
	// 
	$wp_customize->remove_section('background_image');
	$wp_customize->remove_section('colors');
}
add_action( 'customize_register', 'bcom_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function bcom_customize_preview_js() {
	wp_enqueue_script( 'bcom_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'bcom_customize_preview_js' );
