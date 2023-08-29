<?php

/**
 * Additional Code
 */

Kirki::add_section( THEME_PREFIX . 'additional_code_section', array(
	'title'    => __( 'Additional code', 'rodller' ),
	'priority' => 999,
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'     => 'code',
	'settings' => THEME_PREFIX . 'additional_css',
	'label'    => __( 'Additional CSS', 'rodller' ),
	'section'  => THEME_PREFIX . 'additional_code_section',
	'default'  => '',
	'priority' => 10,
	'choices'  => array(
		'language' => 'css',
		'theme'    => 'monokai',
		'height'   => 250,
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'textarea',
	'settings'    => THEME_PREFIX . 'additional_js',
	'label'       => __( 'Additional JavaScript', 'rodller' ),
	'description' => __( 'Just type in the JavaScript code, you don\'t need the script tag wrapper.', 'rodller' ),
	'section'     => THEME_PREFIX . 'additional_code_section',
	'default'     => '',
	'priority'    => 20,
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'              => 'textarea',
	'settings'          => THEME_PREFIX . 'google_analytics_js',
	'label'             => __( 'Google Analytics JavaScript', 'rodller' ),
	'description'       => __( 'Copy the google analytics code and paste it here', 'rodller' ),
	'section'           => THEME_PREFIX . 'additional_code_section',
	'default'           => '',
	'priority'          => 30,
	'sanitize_callback' => 'rodller_allow_code_sanitize',
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'switch',
	'settings'    => THEME_PREFIX . 'google_analytics_only_for_logged_out_users',
	'label'       => __( 'Run Google Analytics only for logged out user', 'rodller' ),
	'description' => __( 'Set to "ON" if you to analyze only logged out user, if you are logged in google analytics won\'t be run', 'rodller' ),
	'section'     => THEME_PREFIX . 'additional_code_section',
	'priority'    => 40,
	'default'     => rodller_get_default_option( 'google_analytics_only_for_logged_out_users' ),
	'choices'     => array(
		1 => __( 'On', 'rodller' ),
		0 => __( 'Off', 'rodller' ),
	),
) );