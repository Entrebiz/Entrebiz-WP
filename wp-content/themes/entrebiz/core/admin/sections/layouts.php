<?php

/**
 * Layouts
 *
 * Options for displaying single post in all formats (standard, video, audio, gallery) and page
 */
Kirki::add_panel( THEME_PREFIX . 'layouts', array(
	'title'    => __( 'Layouts', 'rodller' ),
	'priority' => 60,
) );

/**
 * Layout A
 */
Kirki::add_section( THEME_PREFIX . 'layout_a', array(
	'title'    => __( 'Layout A', 'rodller' ),
	'panel'    => THEME_PREFIX . 'layouts',
	'priority' => 10,
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'     => 'switch',
	'settings' => THEME_PREFIX . 'category_layout_a',
	'label'    => esc_html__( 'Show category', 'rodller' ),
	'section'  => THEME_PREFIX . 'layout_a',
	'priority' => 10,
	'default'  => rodller_get_default_option( 'category_layout_a' ),
	'choices'  => array(
		0 => __( 'Off', 'rodller' ),
		1 => __( 'On', 'rodller' ),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'switch',
	'settings'    => THEME_PREFIX . 'format_icon_layout_a',
	'label'       => __( 'Show format icon', 'rodller' ),
	'description' => __( 'Set to "ON" if you want to display format icon in right bottom corner of the image', 'rodller' ),
	'section'     => THEME_PREFIX . 'layout_a',
	'priority'    => 20,
	'default'     => rodller_get_default_option( 'format_icon_layout_a' ),
	'choices'     => array(
		0 => __( 'Off', 'rodller' ),
		1 => __( 'On', 'rodller' ),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'number',
	'settings'        => THEME_PREFIX . 'text_limit_layout_a',
	'label'           => __( 'Text limit', 'rodller' ),
	'description'     => __( 'Set how many characters will be displayed', 'rodller' ),
	'section'         => THEME_PREFIX . 'layout_a',
	'priority'        => 30,
	'default'         => rodller_get_default_option( 'text_limit_layout_a' ),
	'choices'         => array(
		'min'  => 100,
		'max'  => 400,
		'step' => 10,
	),
	'partial_refresh' => array(
		THEME_PREFIX . 'text_limit_layout_a' => array(
			'selector'        => '.rodller-posts .layout-a:first-child',
			'render_callback' => '__return_false',
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'multicheck',
	'settings'    => THEME_PREFIX . 'layout_a_metadata',
	'label'       => __( 'Post metadata', 'rodller' ),
	'description' => __( 'Check what data you want to show', 'rodller' ),
	'section'     => THEME_PREFIX . 'layout_a',
	'priority'    => 40,
	'choices'     => rodller_get_supported_metadata(),
	'default'     => rodller_get_default_option( 'text_limit_layout_a' ),
) );

/**
 * Layout B
 */
Kirki::add_section( THEME_PREFIX . 'layout_b', array(
	'title'    => __( 'Layout B', 'rodller' ),
	'panel'    => THEME_PREFIX . 'layouts',
	'priority' => 20,
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'     => 'switch',
	'settings' => THEME_PREFIX . 'category_layout_b',
	'label'    => __( 'Show category', 'rodller' ),
	'section'  => THEME_PREFIX . 'layout_b',
	'priority' => 10,
	'default'  => rodller_get_default_option( 'category_layout_b' ),
	'choices'  => array(
		0 => __( 'Off', 'rodller' ),
		1 => __( 'On', 'rodller' ),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'switch',
	'settings'    => THEME_PREFIX . 'format_icon_layout_b',
	'label'       => __( 'Show format icon', 'rodller' ),
	'description' => __( 'Set to "ON" if you want to display format icon in right bottom corner of the image', 'rodller' ),
	'section'     => THEME_PREFIX . 'layout_b',
	'priority'    => 20,
	'default'     => rodller_get_default_option( 'format_icon_layout_b' ),
	'choices'     => array(
		0 => __( 'Off', 'rodller' ),
		1 => __( 'On', 'rodller' ),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'number',
	'settings'        => THEME_PREFIX . 'text_limit_layout_b',
	'label'           => __( 'Text limit', 'rodller' ),
	'description'     => __( 'Set how many characters will be displayed', 'rodller' ),
	'section'         => THEME_PREFIX . 'layout_b',
	'priority'        => 30,
	'default'         => rodller_get_default_option( 'text_limit_layout_b' ),
	'choices'         => array(
		'min'  => 100,
		'max'  => 400,
		'step' => 10,
	),
	'partial_refresh' => array(
		THEME_PREFIX . 'text_limit_layout_b' => array(
			'selector'        => '.rodller-posts .layout-b:first-child',
			'render_callback' => '__return_false',
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'multicheck',
	'settings'    => THEME_PREFIX . 'layout_b_metadata',
	'label'       => __( 'Post metadata', 'rodller' ),
	'description' => __( 'Check what data you want to show', 'rodller' ),
	'section'     => THEME_PREFIX . 'layout_b',
	'priority'    => 40,
	'choices'     => rodller_get_supported_metadata(),
	'default'     => rodller_get_default_option( 'layout_b_metadata' ),
) );

/**
 * Layout C
 */
Kirki::add_section( THEME_PREFIX . 'layout_c', array(
	'title'    => __( 'Layout C', 'rodller' ),
	'panel'    => THEME_PREFIX . 'layouts',
	'priority' => 30,
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'     => 'switch',
	'settings' => THEME_PREFIX . 'category_layout_c',
	'label'    => __( 'Show category', 'rodller' ),
	'section'  => THEME_PREFIX . 'layout_c',
	'priority' => 10,
	'default'  => rodller_get_default_option( 'category_layout_c' ),
	'choices'  => array(
		0 => __( 'Off', 'rodller' ),
		1 => __( 'On', 'rodller' ),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'switch',
	'settings'    => THEME_PREFIX . 'format_icon_layout_c',
	'label'       => __( 'Show format icon', 'rodller' ),
	'description' => __( 'Set to "ON" if you want to display format icon in right bottom corner of the image', 'rodller' ),
	'section'     => THEME_PREFIX . 'layout_c',
	'default'     => rodller_get_default_option( 'format_icon_layout_c' ),
	'priority'    => 20,
	'choices'     => array(
		0 => __( 'Off', 'rodller' ),
		1 => __( 'On', 'rodller' ),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'number',
	'settings'        => THEME_PREFIX . 'text_limit_layout_c',
	'label'           => __( 'Text limit', 'rodller' ),
	'description'     => __( 'Set how many characters will be displayed', 'rodller' ),
	'section'         => THEME_PREFIX . 'layout_c',
	'priority'        => 30,
	'default'         => rodller_get_default_option( 'text_limit_layout_c' ),
	'choices'         => array(
		'min'  => 100,
		'max'  => 400,
		'step' => 10,
	),
	'partial_refresh' => array(
		THEME_PREFIX . 'text_limit_layout_c' => array(
			'selector'        => '.rodller-posts .layout-c:first-child',
			'render_callback' => '__return_false',
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'multicheck',
	'settings'    => THEME_PREFIX . 'layout_c_metadata',
	'label'       => __( 'Post metadata', 'rodller' ),
	'description' => __( 'Check what data you want to show', 'rodller' ),
	'section'     => THEME_PREFIX . 'layout_c',
	'priority'    => 40,
	'choices'     => rodller_get_supported_metadata(),
	'default'     => rodller_get_default_option( 'layout_c_metadata' ),
) );

/**
 * Layout D
 */
Kirki::add_section( THEME_PREFIX . 'layout_d', array(
	'title'    => __( 'Layout D', 'rodller' ),
	'panel'    => THEME_PREFIX . 'layouts',
	'priority' => 30,
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'     => 'switch',
	'settings' => THEME_PREFIX . 'category_layout_d',
	'label'    => __( 'Show category', 'rodller' ),
	'section'  => THEME_PREFIX . 'layout_d',
	'priority' => 10,
	'default'  => rodller_get_default_option( 'category_layout_d' ),
	'choices'  => array(
		0 => __( 'Off', 'rodller' ),
		1 => __( 'On', 'rodller' ),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'switch',
	'settings'    => THEME_PREFIX . 'format_icon_layout_d',
	'label'       => __( 'Show format icon', 'rodller' ),
	'description' => __( 'Set to "ON" if you want to display format icon in right bottom corner of the image', 'rodller' ),
	'section'     => THEME_PREFIX . 'layout_d',
	'priority'    => 20,
	'default'     => rodller_get_default_option( 'format_icon_layout_d' ),
	'choices'     => array(
		0 => __( 'Off', 'rodller' ),
		1 => __( 'On', 'rodller' ),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'number',
	'settings'        => THEME_PREFIX . 'text_limit_layout_d',
	'label'           => __( 'Text limit', 'rodller' ),
	'description'     => __( 'Set how many characters will be displayed', 'rodller' ),
	'section'         => THEME_PREFIX . 'layout_d',
	'priority'        => 30,
	'default'         => rodller_get_default_option( 'text_limit_layout_d' ),
	'choices'         => array(
		'min'  => 100,
		'max'  => 500,
		'step' => 10,
	),
	'partial_refresh' => array(
		THEME_PREFIX . 'text_limit_layout_d' => array(
			'selector'        => '.rodller-posts .layout-d:first-child',
			'render_callback' => '__return_false',
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'multicheck',
	'settings'    => THEME_PREFIX . 'layout_d_metadata',
	'label'       => __( 'Post metadata', 'rodller' ),
	'description' => __( 'Check what data you want to show', 'rodller' ),
	'section'     => THEME_PREFIX . 'layout_d',
	'priority'    => 40,
	'choices'     => rodller_get_supported_metadata(),
	'default'     => rodller_get_default_option( 'layout_d_metadata' ),
) );