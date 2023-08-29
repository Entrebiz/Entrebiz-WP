<?php

/**
 * Sidebars
 *
 * Option for new sidebar palaces registration
 */
Kirki::add_section( THEME_PREFIX . 'sidebars', array(
	'title'    => __( 'Sidebars', 'rodller' ),
	'priority' => 80,
) );

Kirki::add_field( THEME_PREFIX . 'sidebars', array(
	'type'            => 'repeater',
	'label'           => __( 'Sidebars', 'rodller' ),
	'description'     => __( 'Click on "Add new sidebar, fill up the name and you can use sidebar on pages, archives, categories, tags, etc."', 'rodller' ),
	'section'         => THEME_PREFIX . 'sidebars',
	'priority'        => 10,
	'row_label'       => array(
		'type'  => 'text',
		'value' => __( 'Sidebar', 'rodller' ),
	),
	'settings'        => THEME_PREFIX . 'sidebars',
	'fields'          => array(
		'name' => array(
			'type'        => 'text',
			'label'       => __( 'Name', 'rodller' ),
			'description' => __( 'This will be sidebar name', 'rodller' ),
			'default'     => '',
		),
	),
	'partial_refresh' => array(
		THEME_PREFIX . 'sidebars' => array(
			'selector'        => '#rodller-sidebar',
			'render_callback' => '__return_false',
		),
	),
) );


Kirki::add_field( THEME_PREFIX . 'options', array(
		'type'     => 'color',
		'settings' => THEME_PREFIX . 'odd_widget_background_color',
		'label'    => __( 'Odd widget background color', 'rodller' ),
		'section'  => THEME_PREFIX . 'sidebars',
		'default'  => rodller_get_default_option( 'odd_widget_background_color' ),
		'priority' => 20,
	) );

Kirki::add_field( THEME_PREFIX . 'options', array(
		'type'     => 'color',
		'settings' => THEME_PREFIX . 'even_widget_background_color',
		'label'    => __( 'Even widget background color', 'rodller' ),
		'section'  => THEME_PREFIX . 'sidebars',
		'default'  => rodller_get_default_option( 'even_widget_background_color' ),
		'priority' => 30,
	) );