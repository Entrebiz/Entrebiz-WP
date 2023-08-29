<?php

/**
 * Header
 *
 * Below are all configuration for header options
 */
Kirki::add_panel( THEME_PREFIX . 'header_and_footer', array(
	'title'    => __( 'Header & Footer', 'rodller' ),
	'priority' => 30,
) );

/**
 * Top bar setting
 */
Kirki::add_section( THEME_PREFIX . 'top_bar', array(
	'title'    => __( 'Top bar', 'rodller' ),
	'panel'    => THEME_PREFIX . 'header_and_footer',
	'priority' => 10,
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'switch',
	'settings'    => THEME_PREFIX . 'top_bar',
	'label'       => __( 'Enable top bar', 'rodller' ),
	'description' => __( 'Set to "ON" if you want to display top bar.', 'rodller' ),
	'section'     => THEME_PREFIX . 'top_bar',
	'priority'    => 10,
	'default'     => rodller_get_default_option( 'top_bar' ),
	'choices'     => array(
		0 => __( 'Disable', 'rodller' ),
		1 => __( 'Enable', 'rodller' ),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'color',
	'settings'        => THEME_PREFIX . 'top_bar_background_color',
	'label'           => __( 'Background color', 'rodller' ),
	'description'     => __( 'Set background color of the top bar.', 'rodller' ),
	'section'         => THEME_PREFIX . 'top_bar',
	'choices'         => array(
		'alpha' => true,
	),
	'priority'        => 20,
	'default'         => rodller_get_default_option( 'top_bar' ),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'top_bar',
			'operator' => '==',
			'value'    => 1,
		),
	),
	'output'          => array(
		array(
			'element'  => '#rodller-top-bar',
			'property' => 'background-color',
		),
		array(
			'element'  => '#rodller-main-header #rodller-top-bar .rodller-search-input-wrapper',
			'property' => 'background-color',
		),
		array(
			'element'  => '#rodller-main-header #rodller-top-bar .rodller-search-input-wrapper .rodller-submit',
			'property' => 'background-color',
		),
		array(
			'element'  => '#rodller-main-header #rodller-top-bar .rodller-button:not(.rodller-button-outline)',
			'property' => 'color',
		),

	),
	'transport'       => 'postMessage',
	'partial_refresh' => array(
		THEME_PREFIX . 'top_bar' => array(
			'selector'        => '#rodller-header-main-area',
			'render_callback' => '__return_false',
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'color',
	'settings'        => THEME_PREFIX . 'top_bar_color',
	'label'           => __( 'Text color', 'rodller' ),
	'description'     => __( 'Set text color of the top bar. Note that this will be applied only on classic text, links color can be changed under accent color option', 'rodller' ),
	'section'         => THEME_PREFIX . 'top_bar',
	'priority'        => 30,
	'default'         => rodller_get_default_option( 'top_bar_color' ),
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'top_bar',
			'operator' => '==',
			'value'    => 1,
		),
	),
	'output'          => array(
		array(
			'element'  => '#rodller-top-bar .container, #rodller-top-bar .container p',
			'property' => 'color',
		),
	),
) );


Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'color',
	'settings'        => THEME_PREFIX . 'top_bar_accent_color',
	'label'           => __( 'Accent color', 'rodller' ),
	'description'     => __( 'Set accent/link color of the top bar. Note that this will be applied only on links, text color can be changed under text color option', 'rodller' ),
	'section'         => THEME_PREFIX . 'top_bar',
	'priority'        => 40,
	'default'         => rodller_get_default_option( 'top_bar_accent_color' ),
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'top_bar',
			'operator' => '==',
			'value'    => 1,
		),
	),
	'output'          => array(
		array(
			'element'  => '#rodller-top-bar .container a:not(.rodller-button), #rodller-top-bar .container button:not(.rodller-button)',
			'property' => 'color',
		),
		array(
			'element'  => '#rodller-top-bar .rodller-button.rodller-button-outline',
			'property' => 'color',
		),
		array(
			'element'  => '#rodller-top-bar .rodller-button.rodller-button-outline',
			'property' => 'border-color',
		),
		array(
			'element'  => '#rodller-main-header #rodller-top-bar .rodller-button:not(.rodller-button-outline)',
			'property' => 'background-color',
		),
		array(
			'element'  => '#rodller-main-header #rodller-top-bar .rodller-button:not(.rodller-button-outline)',
			'property' => 'border-color',
		),
	),
) );


Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'color',
	'settings'        => THEME_PREFIX . 'top_bar_hover_accent_color',
	'label'           => __( 'Hover Accent color', 'rodller' ),
	'description'     => __( 'Set color of hovered link. If someone goes over the link in the top bar with mouse pointer this color will be applied to the link', 'rodller' ),
	'section'         => THEME_PREFIX . 'top_bar',
	'priority'        => 40,
	'default'         => rodller_get_default_option( 'top_bar_hover_accent_color' ),
	'choices'         => array(
		'alpha' => true,
	),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'top_bar',
			'operator' => '==',
			'value'    => 1,
		),
	),
	'output'          => array(
		array(
			'element'  => '#rodller-top-bar .container a:not(.rodller-button):hover, #rodller-top-bar .container button:not(.rodller-button):hover',
			'property' => 'color',
		),
		array(
			'element'  => '#rodller-top-bar .rodller-button.rodller-button-outline:hover',
			'property' => 'color',
		),
		array(
			'element'  => '#rodller-top-bar .rodller-button.rodller-button-outline:hover',
			'property' => 'border-color',
		),
		array(
			'element'  => '#rodller-main-header #rodller-top-bar .rodller-button:not(.rodller-button-outline):hover',
			'property' => 'background-color',
		),
		array(
			'element'  => '#rodller-main-header #rodller-top-bar .rodller-button:not(.rodller-button-outline):hover',
			'property' => 'border-color',
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'sortable',
	'settings'        => THEME_PREFIX . 'top_bar_left_slot',
	'label'           => __( 'Left slot actions', 'rodller' ),
	'description'     => __( 'Enable actions by clicking on eye icon, sort icons using drag and drop. These actions will be displayed in the left part of the top bar.', 'rodller' ),
	'section'         => THEME_PREFIX . 'top_bar',
	'choices'         => rodller_get_header_actions(),
	'priority'        => 50,
	'default'         => rodller_get_default_option( 'top_bar_left_slot' ),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'top_bar',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'sortable',
	'settings'        => THEME_PREFIX . 'top_bar_middle_slot',
	'label'           => __( 'Middle slot actions', 'rodller' ),
	'description'     => __( 'Enable actions by clicking on eye icon, sort icons using drag and drop. These actions will be displayed in the middle part of the top bar.', 'rodller' ),
	'section'         => THEME_PREFIX . 'top_bar',
	'choices'         => rodller_get_header_actions(),
	'priority'        => 60,
	'default'         => rodller_get_default_option( 'top_bar_middle_slot' ),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'top_bar',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'sortable',
	'settings'        => THEME_PREFIX . 'top_bar_right_slot',
	'label'           => __( 'Right slot actions', 'rodller' ),
	'description'     => __( 'Enable actions by clicking on eye icon, sort icons using drag and drop. These actions will be displayed in the right part of the top bar.', 'rodller' ),
	'section'         => THEME_PREFIX . 'top_bar',
	'choices'         => rodller_get_header_actions(),
	'priority'        => 70,
	'default'         => rodller_get_default_option( 'top_bar_right_slot' ),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'top_bar',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );


/**
 * Header display options
 */
Kirki::add_section( THEME_PREFIX . 'header_display', array(
	'title'    => __( 'Header Display Options', 'rodller' ),
	'panel'    => THEME_PREFIX . 'header_and_footer',
	'priority' => 10,
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'radio-image',
	'settings'        => THEME_PREFIX . 'header_layout',
	'label'           => __( 'Choose header layout', 'rodller' ),
	'description'     => __( 'Pick the header layout for the website.', 'rodller' ),
	'section'         => THEME_PREFIX . 'header_display',
	'priority'        => 10,
	'choices'         => rodller_get_header_layouts(),
	'transport'       => 'postMessage',
	'default'         => rodller_get_default_option( 'header_layout' ),
	'partial_refresh' => array(
		THEME_PREFIX . 'header_layout' => array(
			'selector'        => '#rodller-header-layout',
			'render_callback' => '__return_false',
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'number',
	'settings'    => THEME_PREFIX . 'main_area_height',
	'label'       => __( 'Height', 'rodller' ),
	'description' => __( 'Set the header height in pixels.', 'rodller' ),
	'section'     => THEME_PREFIX . 'header_display',
	'priority'    => 10,
	'default'     => rodller_get_default_option( 'main_area_height' ),
	'choices'     => array(
		'min' => 40,
	),
	'output'      => array(
		array(
			'element'  => '#rodller-header-main-area',
			'function' => 'css',
			'property' => 'height',
			'units'    => 'px',
		),
		array(
			'element'  => '.rodller-header-logo .site-title img',
			'function' => 'css',
			'property' => 'max-height',
			'units'    => 'px',
		),
		array(
			'element'  => '#rodller-header-layout.rodller-header-layout-4 .rodller-main-menu, #rodller-header-layout.rodller-header-layout-3 .rodller-main-menu, #rodller-header-layout.rodller-header-layout-4 .site-title',
			'function' => 'css',
			'property' => 'line-height',
			'units'    => 'px',
		),
	),
	'transport'   => 'postMessage',
	'js_vars'     => array(
		array(
			'element'  => '#rodller-header-main-area',
			'function' => 'css',
			'property' => 'height',
			'units'    => 'px',
		),
		array(
			'element'  => '.rodller-header-logo .site-title img',
			'function' => 'css',
			'property' => 'max-height',
			'units'    => 'px',
		),
		array(
			'element'  => '#rodller-header-layout.rodller-header-layout-4 .rodller-main-menu, #rodller-header-layout.rodller-header-layout-3 .rodller-main-menu, #rodller-header-layout.rodller-header-layout-4 .site-title',
			'function' => 'css',
			'property' => 'line-height',
			'units'    => 'px',
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'color',
	'settings'    => THEME_PREFIX . 'main_area_background_color',
	'label'       => __( 'Background Color', 'rodller' ),
	'description' => __( 'Set background color of the main header.', 'rodller' ),
	'section'     => THEME_PREFIX . 'header_display',
	'priority'    => 20,
	'default'     => rodller_get_default_option( 'main_area_background_color' ),
	'choices'     => array(
		'alpha' => true,
	),
	'output'      => array(
		array(
			'element'  => '#rodller-main-header',
			'function' => 'css',
			'property' => 'background-color',
		),
		array(
			'element'  => '#rodller-main-header .rodller-search-input-wrapper',
			'function' => 'css',
			'property' => 'background-color',
		),
		array(
			'element'  => '.rodller-main-menu li ul',
			'function' => 'css',
			'property' => 'background-color',
		),
		array(
			'element'  => '#rodller-sticky-header',
			'property' => 'background-color',
		),
		array(
			'element'  => '#rodller-main-header .rodller-search-input-wrapper .rodller-submit',
			'property' => 'color',
		),
		array(
			'element'  => '.rodller-cart-icon .rodller-cart-count',
			'property' => 'color',
		),
		array(
			'element'  => '#rodller-main-header .rodller-button:not(.rodller-button-outline)',
			'property' => 'color',
		),
	),
	'transport'   => 'postMessage',
	'js_vars'     => array(
		array(
			'element'  => '#rodller-main-header',
			'function' => 'css',
			'property' => 'background-color',
		),
		array(
			'element'  => '#rodller-main-header .rodller-search-input-wrapper',
			'function' => 'css',
			'property' => 'background-color',
		),
		array(
			'element'  => '.rodller-main-menu li ul',
			'function' => 'css',
			'property' => 'background-color',
		),
		array(
			'element'  => '#rodller-sticky-header',
			'function' => 'css',
			'property' => 'background-color',
		),
		array(
			'element'  => '#rodller-main-header .rodller-search-input-wrapper .rodller-submit',
			'function' => 'css',
			'property' => 'color',
		),
		array(
			'element'  => '.rodller-cart-icon .rodller-cart-count',
			'property' => 'color',
		),
		array(
			'element'  => '#rodller-main-header .rodller-button:not(.rodller-button-outline)',
			'property' => 'color',
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'image',
	'settings'    => THEME_PREFIX . 'main_area_background_image',
	'label'       => __( 'Background image', 'rodller' ),
	'description' => __( 'Set background image of the main header.', 'rodller' ),
	'section'     => THEME_PREFIX . 'header_display',
	'priority'    => 30,
	'default'     => rodller_get_default_option( 'main_area_background_image' ),
	'output'      => array(
		array(
			'element'  => '#rodller-main-header',
			'function' => 'css',
			'property' => 'background-image',
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'select',
	'settings'        => THEME_PREFIX . 'main_area_background_repeat',
	'label'           => __( 'Background repeat', 'rodller' ),
	'description'     => __( 'Pick the type of background repeat, if you add small image in order to create pattern here you can pick how will that pattern behave.', 'rodller' ),
	'section'         => THEME_PREFIX . 'header_display',
	'priority'        => 40,
	'default'         => rodller_get_default_option( 'main_area_background_repeat' ),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'main_area_background_image',
			'operator' => '!=',
			'value'    => '',
		),
	),
	'choices'         => array(
		'no-repeat' => __( 'No Repeat', 'rodller' ),
		'repeat'    => __( 'Repeat All', 'rodller' ),
		'repeat-x'  => __( 'Repeat Horizontally', 'rodller' ),
		'repeat-y'  => __( 'Repeat Vertically', 'rodller' ),
		'inherit'   => __( 'Inherit', 'rodller' ),
	),
	'output'          => array(
		array(
			'element'  => '#rodller-main-header',
			'function' => 'css',
			'property' => 'background-repeat',
		),
	),
	'transport'       => 'postMessage',
	'js_vars'         => array(
		array(
			'element'  => '#rodller-main-header',
			'function' => 'css',
			'property' => 'background-repeat',
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'select',
	'settings'        => THEME_PREFIX . 'main_area_background_size',
	'label'           => __( 'Background size', 'rodller' ),
	'description'     => __( 'Set the behavior of background image size.', 'rodller' ),
	'section'         => THEME_PREFIX . 'header_display',
	'default'         => '',
	'priority'        => 50,
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'main_area_background_image',
			'operator' => '!=',
			'value'    => '',
		),
	),
	'choices'         => array(
		'inherit' => __( 'Inherit', 'rodller' ),
		'cover'   => __( 'Cover', 'rodller' ),
		'contain' => __( 'Contain', 'rodller' ),
	),
	'output'          => array(
		array(
			'element'  => '#rodller-main-header',
			'function' => 'css',
			'property' => 'background-size',
		),
	),
	'transport'       => 'postMessage',
	'js_vars'         => array(
		array(
			'element'  => '#rodller-main-header',
			'function' => 'css',
			'property' => 'background-size',
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'select',
	'settings'        => THEME_PREFIX . 'main_area_background_attachment',
	'label'           => __( 'Background attachment', 'rodller' ),
	'description'     => __( 'You can set how will background image behave when user scroll.', 'rodller' ),
	'section'         => THEME_PREFIX . 'header_display',
	'priority'        => 60,
	'default'         => rodller_get_default_option( 'main_area_background_attachment' ),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'main_area_background_image',
			'operator' => '!=',
			'value'    => '',
		),
	),
	'choices'         => array(
		'inherit' => __( 'Inherit', 'rodller' ),
		'fixed'   => __( 'Fixed', 'rodller' ),
		'scroll'  => __( 'Scroll', 'rodller' ),
	),
	'output'          => array(
		array(
			'element'  => '#rodller-main-header',
			'function' => 'css',
			'property' => 'background-attachment',
		),
	),
	'transport'       => 'postMessage',
	'js_vars'         => array(
		array(
			'element'  => '#rodller-main-header',
			'function' => 'css',
			'property' => 'background-attachment',
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'select',
	'settings'        => THEME_PREFIX . 'main_area_background_position',
	'label'           => __( 'Background position', 'rodller' ),
	'description'     => __( 'Set the position of the background image.', 'rodller' ),
	'section'         => THEME_PREFIX . 'header_display',
	'priority'        => 70,
	'default'         => rodller_get_default_option( 'main_area_background_position' ),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'main_area_background_image',
			'operator' => '!=',
			'value'    => '',
		),
	),
	'choices'         => array(
		'left top'      => __( 'Left top', 'rodller' ),
		'left center'   => __( 'Left center', 'rodller' ),
		'left bottom'   => __( 'Left bottom', 'rodller' ),
		'right top'     => __( 'Right top', 'rodller' ),
		'right center'  => __( 'Right center', 'rodller' ),
		'right  bottom' => __( 'Right  bottom', 'rodller' ),
		'center top'    => __( 'Center top', 'rodller' ),
		'center center' => __( 'Center center', 'rodller' ),
		'center bottom' => __( 'Center bottom', 'rodller' ),
	),
	'output'          => array(
		array(
			'element'  => '#rodller-main-header',
			'function' => 'css',
			'property' => 'background-position',
		),
	),
	'transport'       => 'postMessage',
	'js_vars'         => array(
		array(
			'element'  => '#rodller-main-header',
			'function' => 'css',
			'property' => 'background-position',
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'color',
	'settings'    => THEME_PREFIX . 'main_area_color',
	'label'       => __( 'Text color', 'rodller' ),
	'description' => __( 'Set text color of the main header area. Note that this will be applied only on classic text, links color can be changed under accent color option', 'rodller' ),
	'section'     => THEME_PREFIX . 'header_display',
	'priority'    => 80,
	'default'     => rodller_get_default_option( 'main_area_color' ),
	'output'      => array(
		array(
			'element'  => '#rodller-main-header, #rodller-main-header p',
			'function' => 'css',
			'property' => 'color',
		),
	),
	'transport'   => 'postMessage',
	'js_vars'     => array(
		array(
			'element'  => '#rodller-main-header, #rodller-main-header p',
			'property' => 'color',
		),
	),
) );


Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'color',
	'settings'    => THEME_PREFIX . 'main_area_accent_color',
	'label'       => __( 'Accent color', 'rodller' ),
	'description' => __( 'Set accent/link color of the main header area. Note that this will be applied only on links, text color can be changed under text color option', 'rodller' ),
	'section'     => THEME_PREFIX . 'header_display',
	'priority'    => 90,
	'default'     => rodller_get_default_option( 'main_area_color' ),
	'output'      => array(
		array(
			'element'  => '#rodller-main-header a, #rodller-main-header button, #rodller-responsive-header a, #rodller-responsive-header button',
			'property' => 'color',
		),
		array(
			'element'  => '#rodller-main-header .rodller-search-input-wrapper .rodller-submit',
			'property' => 'background-color',
		),
		array(
			'element'  => '.rodller-hamburger, .rodller-hamburger:after, .rodller-hamburger:before',
			'property' => 'background-color',
		),
		array(
			'element'  => '#rodller-main-header .rodller-button:not(.rodller-button-outline)',
			'property' => 'background-color',
		),
		array(
			'element'  => '#rodller-main-header .rodller-button',
			'property' => 'border-color',
		),
	),
	'transport'   => 'postMessage',
	'js_vars'     => array(
		array(
			'element'  => '#rodller-main-header a, #rodller-main-header button, #rodller-responsive-header a, #rodller-responsive-header button',
			'function' => 'css',
			'property' => 'color',
		),
		array(
			'element'  => '#rodller-main-header .rodller-search-input-wrapper .rodller-submit',
			'function' => 'css',
			'property' => 'background-color',
		),
		array(
			'element'  => '.rodller-hamburger, .rodller-hamburger:after, .rodller-hamburger:before',
			'property' => 'background-color',
		),
		array(
			'element'  => '#rodller-main-header .rodller-button:not(.rodller-button-outline)',
			'property' => 'background-color',
		),
		array(
			'element'  => '#rodller-main-header .rodller-button',
			'property' => 'border-color',
		),
	),
) );


Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'color',
	'settings'    => THEME_PREFIX . 'main_area_hover_accent_color',
	'label'       => __( 'Hover accent color', 'rodller' ),
	'description' => __( 'Set color of hovered link. If someone goes over the link in the main header area with mouse pointer this color will be applied to the link', 'rodller' ),
	'section'     => THEME_PREFIX . 'header_display',
	'priority'    => 90,
	'default'     => rodller_get_default_option( 'main_area_hover_accent_color' ),
	'output'      => array(
		array(
			'element'  => '#rodller-main-header .rodller-main-menu li:hover > a, .rodller-main-menu li:hover > button, #rodller-main-header a:hover, #rodller-main-header .rodller-main-menu .current_page_item > a, #rodller-main-header .rodller-main-menu .current-menu-ancestor > a',
			'property' => 'color',
		),
		array(
			'element'  => '#rodller-search-input-wrapper .rodller-submit:hover',
			'property' => 'background-color',
		),
		array(
			'element'  => '.rodller-main-menu li.current-menu-item > a, .rodller-main-menu li.current-menu-ancestor > a',
			'property' => 'color',
		),
		array(
			'element'  => '#rodller-main-header #rodller-social a:hover',
			'property' => 'color',
		),
		array(
			'element'  => '#rodller-main-header #rodller-header-layout .rodller-searchform .rodller-searchform-opener:hover',
			'property' => 'color',
		),
		array(
			'element'  => '.rodller-cart-icon .rodller-cart-count',
			'function' => 'css',
			'property' => 'background-color',
		),
		array(
			'element'  => '#rodller-main-header .rodller-button:not(.rodller-button-outline):hover',
			'property' => 'background-color',
		),
		array(
			'element'  => '#rodller-main-header .rodller-button:hover',
			'property' => 'border-color',
		),
	),
	'transport'   => 'postMessage',
	'js_vars'     => array(
		array(
			'element'  => '#rodller-main-header .rodller-main-menu li:hover > a, .rodller-main-menu li:hover > button, #rodller-main-header a:hover, #rodller-main-header .rodller-main-menu .current_page_item > a, #rodller-main-header .rodller-main-menu .current-menu-ancestor > a',
			'function' => 'css',
			'property' => 'color',
		),
		array(
			'element'  => '#rodller-search-input-wrapper > .rodller-submit:hover',
			'function' => 'css',
			'property' => 'background-color',
		),
		array(
			'element'  => '.rodller-main-menu li.current-menu-item',
			'function' => 'css',
			'property' => 'color',
		),
		array(
			'element'  => '#rodller-main-header #rodller-social a:hover',
			'property' => 'color',
		),
		array(
			'element'  => '#rodller-main-header #rodller-header-layout .rodller-searchform .rodller-searchform-opener:hover',
			'property' => 'color',
		),
		array(
			'element'  => '.rodller-cart-icon .rodller-cart-count',
			'function' => 'css',
			'property' => 'background-color',
		),
		array(
			'element'  => '#rodller-main-header .rodller-button:not(.rodller-button-outline):hover',
			'property' => 'background-color',
		),
		array(
			'element'  => '#rodller-main-header .rodller-button:hover',
			'property' => 'border-color',
		),
	),
) );


Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'sortable',
	'settings'    => THEME_PREFIX . 'main_area_slot',
	'label'       => __( 'Main area slot actions', 'rodller' ),
	'description' => __( 'Enable actions by clicking on eye icon, sort icons using drag and drop. These actions will be displayed in the part of the main header area.', 'rodller' ),
	'section'     => THEME_PREFIX . 'header_display',
	'choices'     => rodller_get_header_actions( array( 'social-menu', 'search', 'primary-cta', 'secondary-cta' ) ),
	'priority'    => 95,
	'default'     => rodller_get_default_option( 'main_area_slot' ),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'header_layout',
			'operator' => 'in',
			'value'    => array('2', '5'),
		),
	),
) );


Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'sortable',
	'settings'    => THEME_PREFIX . 'main_area_right_slot',
	'label'       => __( 'Right slot actions', 'rodller' ),
	'description' => __( 'Enable actions by clicking on eye icon, sort icons using drag and drop. These actions will be displayed in the right part of the main area.', 'rodller' ),
	'section'     => THEME_PREFIX . 'header_display',
	'choices'     => rodller_get_header_actions( array( 'social-menu', 'search', 'primary-cta', 'secondary-cta' ) ),
	'priority'    => 100,
	'default'     => rodller_get_default_option( 'main_area_right_slot' ),
) );


Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'sortable',
	'settings'    => THEME_PREFIX . 'main_area_left_slot',
	'label'       => __( 'Left slot actions', 'rodller' ),
	'description' => __( 'Enable actions by clicking on eye icon, sort icons using drag and drop. These actions will be displayed in the left part of the main area.', 'rodller' ),
	'section'     => THEME_PREFIX . 'header_display',
	'choices'     => rodller_get_header_actions( array( 'social-menu', 'search', 'primary-cta', 'secondary-cta' ) ),
	'priority'    => 110,
	'default'     => rodller_get_default_option( 'main_area_left_slot' ),
) );


Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'editor',
	'settings'        => THEME_PREFIX . 'main_area_ad',
	'label'           => __( 'Header Ad', 'rodller' ),
	'description'     => __( 'Add ad that will be displayed in header main area. If you are adding code, we advise you to use text editor. Note that only header layout 2 is supporting ads.', 'rodller' ),
	'section'         => THEME_PREFIX . 'header_display',
	'priority'        => 120,
	'default'         => rodller_get_default_option( 'main_area_ad' ),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'header_layout',
			'operator' => '==',
			'value'    => 2,
		),
	),
) );

/**
 * Sticky header setting
 */
Kirki::add_section( THEME_PREFIX . 'sticky_header', array(
	'title'    => __( 'Sticky header', 'rodller' ),
	'panel'    => THEME_PREFIX . 'header_and_footer',
	'priority' => 10,
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'switch',
	'settings'    => THEME_PREFIX . 'sticky_header',
	'label'       => __( 'Sticky Header', 'rodller' ),
	'description' => __( 'Set to "ON" if you want to display sticky header.', 'rodller' ),
	'section'     => THEME_PREFIX . 'sticky_header',
	'priority'    => 10,
	'default'     => rodller_get_default_option( 'sticky_header' ),
	'choices'     => array(
		1 => __( 'On', 'rodller' ),
		0 => __( 'Off', 'rodller' ),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'sortable',
	'settings'        => THEME_PREFIX . 'sticky_right_slot',
	'label'           => __( 'Right slot actions', 'rodller' ),
	'description'     => __( 'Enable actions by clicking on eye icon, sort icons using drag and drop. These actions will be displayed in the right part of sticky header.', 'rodller' ),
	'section'         => THEME_PREFIX . 'sticky_header',
	'choices'         => rodller_get_header_actions( array( 'social-menu', 'search' ) ),
	'priority'        => 20,
	'default'         => rodller_get_default_option( 'sticky_right_slot' ),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'sticky_header',
			'operator' => '==',
			'value'    => 1,
		),
	),
	'partial_refresh' => array(
		THEME_PREFIX . 'sticky_header' => array(
			'selector'        => '#rodller-sticky-header',
			'render_callback' => '__return_false',
		),
	),
) );

/**
 * Prefooter options
 */
Kirki::add_section( THEME_PREFIX . 'prefooter', array(
	'title'    => __( 'Prefooter', 'rodller' ),
	'panel'    => THEME_PREFIX . 'header_and_footer',
	'priority' => 40,
) );


Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'text',
	'settings'        => THEME_PREFIX . 'prefooter_instagram_username',
	'label'           => __( 'Instagram username or hashtag', 'rodller' ),
	'description'     => __( 'Example 1: @natgeo Example 2: #flowers', 'rodller' ),
	'section'         => THEME_PREFIX . 'footer',
	'priority'        => 10,
	'default'         => rodller_get_default_option( 'prefooter_instagram_username' ),
	'transport'       => 'postMessage',
) );



/**
 * Footer options
 */
Kirki::add_section( THEME_PREFIX . 'footer', array(
	'title'    => __( 'Footer', 'rodller' ),
	'panel'    => THEME_PREFIX . 'header_and_footer',
	'priority' => 50,
) );


Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'radio-image',
	'settings'        => THEME_PREFIX . 'footer_columns',
	'label'           => __( 'Footer columns', 'rodller' ),
	'description'     => __( 'Pick how many columns you want to display in footer', 'rodller' ),
	'section'         => THEME_PREFIX . 'footer',
	'choices'         => rodller_get_footer_options(),
	'priority'        => 10,
	'default'         => rodller_get_default_option( 'footer_columns' ),
	'partial_refresh' => array(
		THEME_PREFIX . 'footer_columns' => array(
			'selector'        => '#rodller-main-footer',
			'render_callback' => '__return_false',
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'color',
	'settings'    => THEME_PREFIX . 'footer_background_color',
	'label'       => __( 'Background color', 'rodller' ),
	'description' => __( 'Set background color of the footer.', 'rodller' ),
	'section'     => THEME_PREFIX . 'footer',
	'priority'    => 20,
	'default'     => rodller_get_default_option( 'footer_background_color' ),
	'output'      => array(
		array(
			'element'  => '#rodller-main-footer',
			'function' => 'css',
			'property' => 'background-color',
		),
		array(
			'element'  => '#rodller-main-footer .widget .tagcloud a:hover',
			'function' => 'css',
			'property' => 'color',
		),
		array(
			'element'  => '#rodller-main-footer .widget select',
			'function' => 'css',
			'property' => 'background-color',
		),
		array(
			'element'  => '#rodller-main-footer .widget .calendar_wrap>table tbody #today',
			'function' => 'css',
			'property' => 'color',
		),
	),
	'transport'   => 'postMessage',
	'js_vars'     => array(
		array(
			'element'  => '#rodller-main-footer',
			'function' => 'css',
			'property' => 'background-color',
		),
		array(
			'element'  => '#rodller-main-footer .widget .tagcloud a:hover',
			'function' => 'css',
			'property' => 'color',
		),
		array(
			'element'  => '#rodller-main-footer .widget select',
			'function' => 'css',
			'property' => 'background-color',
		),
		array(
			'element'  => '#rodller-main-footer .widget .calendar_wrap>table tbody #today',
			'function' => 'css',
			'property' => 'color',
		),
	),
) );


Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'color',
	'settings'    => THEME_PREFIX . 'footer_color',
	'label'       => __( 'Text color', 'rodller' ),
	'description' => __( 'Set text color of the footer. Note that this will be applied only on classic text, links color can be changed under accent color option', 'rodller' ),
	'section'     => THEME_PREFIX . 'footer',
	'priority'    => 20,
	'default'     => rodller_get_default_option( 'footer_color' ),
	'output'      => array(
		array(
			'element'  => '#rodller-main-footer, #rodller-main-footer p, #rodller-main-footer h1, #rodller-main-footer h2, #rodller-main-footer h3, #rodller-main-footer h4, #rodller-main-footer h5, #rodller-main-footer h6, #rodller-main-footer .widget .rodller-searchform .rodller-search-input-wrapper input[type=text]',
			'function' => 'css',
			'property' => 'color',
		),
		array(
			'element'  => '#rodller-main-footer .widget .rodller-searchform .rodller-search-input-wrapper input[type=text]',
			'function' => 'css',
			'property' => 'border-color',
		),
		array(
			'element'  => '#rodller-main-footer .rodller-posts-widget article .rodller-widget-header .rodller-metadata .rodller-metadata-item',
			'function' => 'css',
			'property' => 'color',
		),
		array(
			'element'  => '#rodller-main-footer .rodller-posts-widget article',
			'function' => 'css',
			'property' => 'border-bottom-color',
		),
		array(
			'element'  => '#rodller-main-footer .widget .rodller-searchform .rodller-searchsubmit',
			'function' => 'css',
			'property' => 'color',
		),
		array(
			'element'  => '#rodller-main-footer .widget .tagcloud a:hover',
			'function' => 'css',
			'property' => 'background-color',
		),
		array(
			'element'  => '#rodller-main-footer .widget .tagcloud a:hover',
			'function' => 'css',
			'property' => 'border-color',
		),
		array(
			'element'  => '#rodller-main-footer .widget select',
			'function' => 'css',
			'property' => 'border-color',
		),
		array(
			'element'  => '#rodller-main-footer .widget .calendar_wrap > table caption, #rodller-main-footer .widget .calendar_wrap>table thead tr th:last-child',
			'function' => 'css',
			'property' => 'color',
		),
		array(
			'element'  => '#rodller-main-footer .widget .calendar_wrap>table tbody tr td:last-child',
			'function' => 'css',
			'property' => 'color',
		),
		array(
			'element'  => '#rodller-main-footer .widget .calendar_wrap>table tbody #today',
			'function' => 'css',
			'property' => 'background-color',
		),
	),
	'transport'   => 'postMessage',
	'js_vars'     => array(
		array(
			'element'  => '#rodller-main-footer, #rodller-main-footer p, #rodller-main-footer h1, #rodller-main-footer h2, #rodller-main-footer h3, #rodller-main-footer h4, #rodller-main-footer h5, #rodller-main-footer h6, #rodller-main-footer .widget .rodller-searchform .rodller-search-input-wrapper input[type=text]',
			'property' => 'color',
		),
		array(
			'element'  => '#rodller-main-footer .widget .rodller-searchform .rodller-search-input-wrapper input[type=text]',
			'function' => 'css',
			'property' => 'border-color',
		),
		array(
			'element'  => '#rodller-main-footer .rodller-posts-widget article .rodller-widget-header .rodller-metadata .rodller-metadata-item',
			'function' => 'css',
			'property' => 'color',
		),
		array(
			'element'  => '#rodller-main-footer .rodller-posts-widget article',
			'function' => 'css',
			'property' => 'border-bottom-color',
		),
		array(
			'element'  => '#rodller-main-footer .widget .rodller-searchform .rodller-searchsubmit',
			'function' => 'css',
			'property' => 'color',
		),
		array(
			'element'  => '#rodller-main-footer .widget .tagcloud a:hover',
			'function' => 'css',
			'property' => 'background-color',
		),
		array(
			'element'  => '#rodller-main-footer .widget .tagcloud a:hover',
			'function' => 'css',
			'property' => 'border-color',
		),
		array(
			'element'  => '#rodller-main-footer .widget select',
			'function' => 'css',
			'property' => 'border-color',
		),
		array(
			'element'  => '#rodller-main-footer .widget .calendar_wrap > table caption, #rodller-main-footer .widget .calendar_wrap>table thead tr th:last-child',
			'function' => 'css',
			'property' => 'color',
		),
		array(
			'element'  => '#rodller-main-footer .widget .calendar_wrap>table tbody tr td:last-child',
			'function' => 'css',
			'property' => 'color',
		),
		array(
			'element'  => '#rodller-main-footer .widget .calendar_wrap>table tbody #today',
			'function' => 'css',
			'property' => 'background-color',
		),
	),
) );


Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'color',
	'settings'    => THEME_PREFIX . 'footer_accent_color',
	'label'       => __( 'Accent color', 'rodller' ),
	'description' => __( 'Set accent/link color of the footer. Note that this will be applied only on links, text color can be changed under text color option', 'rodller' ),
	'section'     => THEME_PREFIX . 'footer',
	'priority'    => 30,
	'default'     => rodller_get_default_option( 'footer_accent_color' ),
	'output'      => array(
		array(
			'element'  => '#rodller-main-footer a, #rodller-main-footer button',
			'function' => 'css',
			'property' => 'color',
		),
	),
	'transport'   => 'postMessage',
	'js_vars'     => array(
		array(
			'element'  => '#rodller-main-footer a, #rodller-main-footer button',
			'function' => 'css',
			'property' => 'color',
		),
	),
) );


Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'color',
	'settings'    => THEME_PREFIX . 'footer_hover_accent_color',
	'label'       => __( 'Hover accent color', 'rodller' ),
	'description' => __( 'Set color of hovered link. If someone goes over the link in the footer with mouse pointer this color will be applied to the link', 'rodller' ),
	'section'     => THEME_PREFIX . 'footer',
	'priority'    => 40,
	'default'     => rodller_get_default_option( 'footer_hover_accent_color' ),
	'output'      => array(
		array(
			'element'  => '#rodller-main-footer a:hover, #rodller-header-main-footer button:hover',
			'property' => 'color',
		),
		array(
			'element'  => '#rodller-main-footer .widget .rodller-searchform .rodller-searchsubmit:hover',
			'function' => 'css',
			'property' => 'color',
		),
	),
	'transport'   => 'postMessage',
	'js_vars'     => array(
		array(
			'element'  => '#rodller-main-footer a:hover, #rodller-header-main-footer button:hover',
			'function' => 'css',
			'property' => 'color',
		),
		array(
			'element'  => '#rodller-main-footer .widget .rodller-searchform .rodller-searchsubmit:hover',
			'function' => 'css',
			'property' => 'color',
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'switch',
	'settings'    => THEME_PREFIX . 'footer_copyright_bar',
	'label'       => __( 'Copyright Bar', 'rodller' ),
	'description' => __( 'Set to "ON" if you want to display copyright bar.', 'rodller' ),
	'section'     => THEME_PREFIX . 'footer',
	'priority'    => 50,
	'default'     => rodller_get_default_option( 'footer_copyright_bar' ),
//	'partial_refresh' => array(
//		THEME_PREFIX . 'footer_columns' => array(
//			'selector'        => '#rodller-main-footer',
//			'render_callback' => '__return_false',
//		),
//	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'color',
	'settings'    => THEME_PREFIX . 'footer_copyright_bar_background_color',
	'label'       => __( 'Copyright background color', 'rodller' ),
	'description' => __( 'Set background color of the copyright bar.', 'rodller' ),
	'section'     => THEME_PREFIX . 'footer',
	'priority'    => 60,
	'default'     => rodller_get_default_option( 'footer_copyright_bar_background_color' ),
	'output'      => array(
		array(
			'element'  => '#rodller-copyright',
			'function' => 'css',
			'property' => 'background-color',
		),
	),
	'transport'   => 'postMessage',
	'js_vars'     => array(
		array(
			'element'  => '#rodller-copyright',
			'function' => 'css',
			'property' => 'background-color',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'footer_copyright_bar',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'color',
	'settings'    => THEME_PREFIX . 'footer_copyright_bar_color',
	'label'       => __( 'Copyright text color', 'rodller' ),
	'description' => __( 'Set text color of the copyright bar', 'rodller' ),
	'section'     => THEME_PREFIX . 'footer',
	'priority'    => 70,
	'default'     => rodller_get_default_option( 'footer_copyright_bar_color' ),
	'output'      => array(
		array(
			'element'  => '#rodller-copyright, #rodller-copyright p',
			'function' => 'css',
			'property' => 'color',
		),
		array(
			'element'  => '#rodller-copyright',
			'function' => 'css',
			'property' => 'border-top-color',
		),
	),
	'transport'   => 'postMessage',
	'js_vars'     => array(
		array(
			'element'  => '#rodller-copyright, #rodller-copyright p',
			'function' => 'css',
			'property' => 'color',
		),
		array(
			'element'  => '#rodller-copyright',
			'function' => 'css',
			'property' => 'border-top-color',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'footer_copyright_bar',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'editor',
	'settings'    => THEME_PREFIX . 'footer_copyright_content',
	'label'       => __( 'Copyright Content', 'rodller' ),
	'section'     => THEME_PREFIX . 'footer',
	'priority'    => 80,
	'default'     => rodller_get_default_option( 'footer_copyright_content' ),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'footer_copyright_bar',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );


/**
 * Buttons options
 */
Kirki::add_section( THEME_PREFIX . 'header_buttons', array(
	'title'    => __( 'Buttons', 'rodller' ),
	'panel'    => THEME_PREFIX . 'header_and_footer',
	'priority' => 60,
) );


Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'text',
	'settings'        => THEME_PREFIX . 'primary_cta_text',
	'label'           => __( 'Primary CTA Text', 'rodller' ),
	'section'         => THEME_PREFIX . 'header_buttons',
	'priority'        => 80,
	'default'         => rodller_get_default_option( 'top_bar_primary_cta_text' ),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'link',
	'settings'        => THEME_PREFIX . 'primary_cta_link',
	'label'           => __( 'Primary CTA Link', 'rodller' ),
	'section'         => THEME_PREFIX . 'header_buttons',
	'priority'        => 90,
	'default'         => rodller_get_default_option( 'top_bar_primary_cta_link' ),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'text',
	'settings'        => THEME_PREFIX . 'secondary_cta_text',
	'label'           => __( 'Secondary CTA Text', 'rodller' ),
	'section'         => THEME_PREFIX . 'header_buttons',
	'priority'        => 100,
	'default'         => rodller_get_default_option( 'top_bar_secondary_cta_text' ),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'link',
	'settings'        => THEME_PREFIX . 'secondary_cta_link',
	'label'           => __( 'Secondary CTA Link', 'rodller' ),
	'section'         => THEME_PREFIX . 'header_buttons',
	'priority'        => 120,
	'default'         => rodller_get_default_option( 'top_bar_secondary_cta_link' ),
) );
