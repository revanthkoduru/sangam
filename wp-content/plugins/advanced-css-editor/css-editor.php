<?php
/*
Plugin Name: Advanced CSS Editor
Plugin URI: http://www.hardeepasrani.com/
Description: A lightweight plugin that lets you write custom CSS code for each device (desktop, tablets, and mobile phones) right from the WordPress Customizer.
Author: Hardeep Asrani
Author URI: http://www.hardeepasrani.com/
Version: 1.0
*/

// Add plugin options to theme customizer.
function advanced_css_editor_customizer($wp_customize) {

	// Include layout picker control.
	include('layout-picker.php');
	include('syntax-highlighter.php');

	// Add Advanceed CSS editor section to Customizer.
	$wp_customize->add_section( 'advanded_css_editor', array(
		'title'		  => 'Advanced CSS Editor',
		'priority'	   => 5,
	) );

	// Add Layout Picker setting.
	$wp_customize->add_setting( 'advanced_css_layout_picker_setting', array(
		'default'		=> 'global',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'advanced_css_sanitize_choices',
		'transport' => 'postMessage',
	) );

	// Add Layout Picker control.
	$wp_customize->add_control( new Advanded_CSS_Layout_Picker_Custom_Control( $wp_customize, 'advanced_css_layout_picker_setting', array(
		'label'   => 'Select Screen Size:',
		'section' => 'advanded_css_editor',
		'settings'   => 'advanced_css_layout_picker_setting',
		'choices' => array(
			'global' => '<span class="dashicons dashicons-admin-site" title="Global"></span>',
			'desktop' => '<span class="dashicons dashicons-desktop" title="Desktop"></span>',
			'tablet' => '<span class="dashicons dashicons-tablet" title="Tablet"></span>',
			'phone' => '<span class="dashicons dashicons-smartphone" title="Phone"></span>',
		),
		'priority' => 1
	) ) );

	$wp_customize->add_setting('advanced_css_global_css', array(
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
	));

	$wp_customize->add_control( new CSS_Highlighter_Custom_Control( $wp_customize, 'advanced_css_global_css', array(
		'label' => __('Global CSS:', 'latte'),
		'section' => 'advanded_css_editor',
		'priority' => 5,
		'id' => 'global_css',
		'settings' => 'advanced_css_global_css'
	) ) );

	$wp_customize->add_setting('advanced_css_desktop_css', array(
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
	));

	$wp_customize->add_control( new CSS_Highlighter_Custom_Control( $wp_customize, 'advanced_css_desktop_css', array(
		'label' => __('Desktop CSS:', 'latte'),
		'section' => 'advanded_css_editor',
		'priority' => 10,
		'id' => 'desktop_css',
		'settings' => 'advanced_css_desktop_css'
	) ) );

	$wp_customize->add_setting('advanced_css_tablet_css', array(
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
	));

	$wp_customize->add_control( new CSS_Highlighter_Custom_Control( $wp_customize, 'advanced_css_tablet_css', array(
		'label' => __('Tablet CSS:', 'latte'),
		'section' => 'advanded_css_editor',
		'priority' => 15,
		'id' => 'tablet_css',
		'settings' => 'advanced_css_tablet_css'
	) ) );

	$wp_customize->add_setting('advanced_css_phone_css', array(
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
	));

	$wp_customize->add_control( new CSS_Highlighter_Custom_Control( $wp_customize, 'advanced_css_phone_css', array(
		'label' => __('Phone CSS:', 'latte'),
		'section' => 'advanded_css_editor',
		'priority' => 20,
		'id' => 'phone_css',
		'settings' => 'advanced_css_phone_css'
	) ) );

	// Sanitize output.
	function advanced_css_sanitize_choices( $input, $setting ) {
		global $wp_customize;

		$control = $wp_customize->get_control( $setting->id );
	
		if ( array_key_exists( $input, $control->choices ) ) {
			return $input;
		} else {
			return $setting->default;
		}
	}
}

add_action('customize_register', 'advanced_css_editor_customizer', 99);

// Reset theme mod so that Desktop is always default.
function advanced_css_remove_mod( $wp_customize ) {
	remove_theme_mod( 'advanced_css_layout_picker_setting' );
}	
add_action('customize_save_after', 'advanced_css_remove_mod', 100);

function advanced_css_editor_live() {
	wp_enqueue_script( 'advanced_css_editor_live_js', plugin_dir_url( __FILE__ ) . 'js/customizer-css.js', array( 'jquery'), '', true );
}
add_action( 'customize_preview_init', 'advanced_css_editor_live' );
// Add styles to Customizer screen.
function advanced_css_editor_styles() {
	wp_enqueue_style( 'advanced_css_editor_css', plugin_dir_url( __FILE__ ) . 'css/customizer.css' );
}
add_action( 'customize_controls_print_styles', 'advanced_css_editor_styles' );

function advanced_css_input() {
		$advanced_css_global_css = get_theme_mod('advanced_css_global_css');
		$advanced_css_desktop_css = get_theme_mod('advanced_css_desktop_css');
		$advanced_css_tablet_css = get_theme_mod('advanced_css_tablet_css');
		$advanced_css_phone_css = get_theme_mod('advanced_css_phone_css');
?>
<style type="text/css" id="csseditorglobal">
<?php echo $advanced_css_global_css; ?>
</style>
<style type="text/css" id="csseditordesktop">
@media only screen and (min-width: 1024px)  {
<?php echo $advanced_css_desktop_css; ?>
}
</style>
<style type="text/css" id="csseditortablet">
@media only screen and (min-width: 667px) and (max-width: 1024px)  {
<?php echo $advanced_css_tablet_css; ?>
}
</style>
<style type="text/css" id="csseditorphone">
@media only screen  and (min-width: 320px)  and (max-width: 667px) {
<?php echo $advanced_css_phone_css; ?>
}
</style>
<?php
}

add_action('wp_head', 'advanced_css_input');
?>
