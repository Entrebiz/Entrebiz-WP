<?php

/**
 * Site Identity
 *
 * Branding configurations for logo and site title, it extends WordPresses default Site Identity
 */
Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'Switch',
	'settings'        => THEME_PREFIX . 'display_title_tagline',
	'label'           => __( 'Display Title Tagline below logo', 'rodller' ),
	'description'     => __( 'Set to on if you want to display tag line below logo', 'rodller' ),
	'section'         => 'title_tagline',
	'priority'        => 20,
	'default'         => rodller_get_default_option( 'display_title_tagline' ),
	'choices'         => array(
		0 => 'Off',
		1 => 'On',
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'image',
	'settings'        => THEME_PREFIX . 'logo',
	'label'           => __( 'Logo', 'rodller' ),
	'description'     => __( 'Upload your logo image here, or leave empty to show the website title instead.', 'rodller' ),
	'section'         => 'title_tagline',
	'priority'        => 100,
	'default'         => rodller_get_default_option( 'logo' ),
	'choices'         => array(
		'save_as' => 'id',
	),
	'transport'       => 'postMessage',
	'partial_refresh' => array(
		THEME_PREFIX . 'logo' => array(
			'selector'        => '.rodller-header-logo',
			'render_callback' => '__return_false',
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'image',
	'settings'    => THEME_PREFIX . 'retina_logo',
	'label'       => __( 'Retina logo (2x)', 'rodller' ),
	'description' => __( 'Optionally upload another logo for devices with retina displays. It should be double the size of your standard logo.', 'rodller' ),
	'section'     => 'title_tagline',
	'default'     => rodller_get_default_option( 'retina_logo' ),
	'priority'    => 110,
	'choices'     => array(
		'save_as' => 'id',
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'image',
	'settings'    => THEME_PREFIX . 'small_logo',
	'label'       => __( 'Small logo', 'rodller' ),
	'description' => __( 'Optionally upload another logo for devices with small displays like mobiles and tablets. Perfect height is 42px', 'rodller' ),
	'section'     => 'title_tagline',
	'priority'    => 120,
	'default'     => rodller_get_default_option( 'small_logo' ),
	'choices'     => array(
		'save_as' => 'id',
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'image',
	'settings'    => THEME_PREFIX . 'small_retina_logo',
	'label'       => __( 'Small logo (2x)', 'rodller' ),
	'description' => __( 'Optionally upload double sized logo for devices with small retina.', 'rodller' ),
	'section'     => 'title_tagline',
	'priority'    => 130,
	'default'     => rodller_get_default_option( 'small_retina_logo' ),
	'choices'     => array(
		'save_as' => 'id',
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'image',
	'settings'    => THEME_PREFIX . 'default_featured_image',
	'label'       => __( 'Default featured image', 'rodller' ),
	'description' => __( 'Upload your default featured image/placeholder. It will be displayed for posts that do not have a featured image set.', 'rodller' ),
	'section'     => 'title_tagline',
	'priority'    => 140,
	'default'     => rodller_get_default_option( 'default_featured_image' ),
	'choices'     => array(
		'save_as' => 'id',
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'text',
	'settings'    => THEME_PREFIX . 'logo_external_url',
	'label'       => __( 'Logo external url', 'rodller' ),
	'description' => __( 'Add custom logo link, if you don\'t want header logo to lead to home page.', 'rodller' ),
	'section'     => 'title_tagline',
	'default'     => rodller_get_default_option( 'logo_external_url' ),
	'priority'    => 150,
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'color',
	'settings'    => THEME_PREFIX . 'background_color',
	'label'       => __( 'Background color', 'rodller' ),
	'description' => __( 'This color will be applied to the background of the whole website.', 'rodller' ),
	'section'     => 'title_tagline',
	'default'     => rodller_get_option( 'background_color' ),
	'priority'    => 160,
	'output'      => array(
		array(
			'element'  => 'body, #rodller-prefooter .null-instagram-feed .owl-next, #rodller-prefooter .null-instagram-feed .owl-prev, #rodller-primary.rodller-single-layout-4, select, #rodller-responsive-header',
			'function' => 'css',
			'property' => 'background-color',
		),
		array(
			'element'  => '.rodller-tags>a:hover, .widget .tagcloud a:hover, .rodller-pill:hover',
			'function' => 'css',
			'property' => 'color',
		),
		array(
			'element'  => '#rodller-pagination.rodller-numeric .next, #rodller-pagination.rodller-numeric .prev',
			'function' => 'css',
			'property' => 'color',
		),
		array(
			'element'  => '.comment-list .bypostauthor .comment-author:before, #wp-calendar #today a',
			'function' => 'css',
			'property' => 'color',
		),
		array(
			'element'  => '.woocommerce nav.woocommerce-pagination ul li .next, .woocommerce nav.woocommerce-pagination ul li .prev, .woocommerce nav.woocommerce-pagination ul li:hover .next, .woocommerce nav.woocommerce-pagination ul li:hover .prev',
			'function' => 'css',
			'property' => 'color',
		),
		array(
			'element'  => '.rodller-button, .rodller-load-more>a, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce ul.products li.product .onsale, button, input[type=button], input[type=reset], input[type=submit], .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce #respond input#submit.disabled, .woocommerce #respond input#submit:disabled, .woocommerce #respond input#submit:disabled[disabled], .woocommerce a.button.disabled, .woocommerce a.button:disabled, .woocommerce a.button:disabled[disabled], .woocommerce button.button.disabled, .woocommerce button.button:disabled, .woocommerce button.button:disabled[disabled], .woocommerce input.button.disabled, .woocommerce input.button:disabled, .woocommerce input.button:disabled[disabled]',
			'function' => 'css',
			'property' => 'color',
		),
	),
	'transport'   => 'postMessage',
	'js_vars'     => array(
		array(
			'element'  => 'body, #rodller-prefooter .null-instagram-feed .owl-next, #rodller-prefooter .null-instagram-feed .owl-prev, #rodller-primary.rodller-single-layout-4, select, #rodller-responsive-header',
			'function' => 'css',
			'property' => 'background-color',
		),
		array(
			'element'  => '.rodller-tags>a:hover, .widget .tagcloud a:hover, .rodller-pill:hover',
			'function' => 'css',
			'property' => 'color',
		),
		array(
			'element'  => '#rodller-pagination.rodller-numeric .next, #rodller-pagination.rodller-numeric .prev',
			'function' => 'css',
			'property' => 'color',
		),
		array(
			'element'  => '.comment-list .bypostauthor .comment-author:before, #wp-calendar #today a',
			'function' => 'css',
			'property' => 'color',
		),
		array(
			'element'  => '.woocommerce nav.woocommerce-pagination ul li .next, .woocommerce nav.woocommerce-pagination ul li .prev, .woocommerce nav.woocommerce-pagination ul li:hover .next, .woocommerce nav.woocommerce-pagination ul li:hover .prev',
			'function' => 'css',
			'property' => 'color',
		),
		array(
			'element'  => '.rodller-button, .rodller-load-more>a, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce ul.products li.product .onsale, button, input[type=button], input[type=reset], input[type=submit], .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce #respond input#submit.disabled, .woocommerce #respond input#submit:disabled, .woocommerce #respond input#submit:disabled[disabled], .woocommerce a.button.disabled, .woocommerce a.button:disabled, .woocommerce a.button:disabled[disabled], .woocommerce button.button.disabled, .woocommerce button.button:disabled, .woocommerce button.button:disabled[disabled], .woocommerce input.button.disabled, .woocommerce input.button:disabled, .woocommerce input.button:disabled[disabled]',
			'function' => 'css',
			'property' => 'color',
		),
	),
) );


Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'switch',
	'settings'        => THEME_PREFIX . 'rtl',
	'label'           => __( 'RTL mode', 'rodller' ),
	'description'     => __( 'Enable right to left text mode', 'rodller' ),
	'section'         => 'title_tagline',
	'priority'        => 170,
	'default'         => rodller_get_default_option( 'rtl' ),
	'choices'         => array(
		0 => 'Off',
		1 => 'On',
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'text',
	'settings'        => THEME_PREFIX . 'rtl_skip',
	'label'           => __( 'Skip RTL for specific language(s)', 'rodller' ),
	'description'     => __( 'i.e. If you are using Arabic and English versions on the same WordPress installation you should put "en_US" in this field and its version will not be displayed as RTL. Note: To exclude multiple languages, separate by comma: en_US, de_DE', 'rodller' ),
	'section'         => 'title_tagline',
	'priority'        => 170,
	'default'         => rodller_get_default_option( 'rtl_skip' ),
) );