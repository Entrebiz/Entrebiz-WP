<?php

/**
 * Typography
 *
 * Below are all options for typography.
 * In this section you can configure:
 * Fonts Families pickers, Variants, Subsets, Font Sizes, Line Heights, Letter Spacing, Text Transforms and Colors.
 */
Kirki::add_panel( THEME_PREFIX . 'typography', array(
	'title'    => __( 'Typography', 'rodller' ),
	'priority' => 70,
) );

/**
 * Navigation font
 */
Kirki::add_section( THEME_PREFIX . 'navigation_font_section', array(
	'title'    => __( 'Navigation font', 'rodller' ),
	'panel'    => THEME_PREFIX . 'typography',
	'priority' => 10,
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'typography',
	'settings'        => THEME_PREFIX . 'navigation_font',
	'label'           => __( 'Navigation font', 'rodller' ),
	'description'     => __( 'Set navigation font for main header menu', 'rodller' ),
	'section'         => THEME_PREFIX . 'navigation_font_section',
	'default'         => rodller_get_default_option( 'navigation_font' ),
	'priority'        => 10,
	'output'          => array(
		array(
			'element' => 'nav',
		),
		array(
			'element' => '.rodller-main-menu ul li',
		),
	),
	'transport'       => 'postMessage',
	'js_vars'         => array(
		array(
			'element' => 'nav',
		),
		array(
			'element' => '.rodller-main-menu ul li',
		),
	),
	'partial_refresh' => array(
		THEME_PREFIX . 'navigation_font' => array(
			'selector'        => '.rodller-main-navigation',
			'render_callback' => '__return_false',
		),
	),
) );

/**
 * Main font
 */
Kirki::add_section( THEME_PREFIX . 'body_font_section', array(
	'title'    => __( 'Body font', 'rodller' ),
	'panel'    => THEME_PREFIX . 'typography',
	'priority' => 20,
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'typography',
	'settings'        => THEME_PREFIX . 'body_font',
	'label'           => __( 'Text font', 'rodller' ),
	'description'     => __( 'Set font for body text, this everything besides headings and navigation.', 'rodller' ),
	'section'         => THEME_PREFIX . 'body_font_section',
	'default'         => rodller_get_default_option( 'body_font' ),
	'priority'        => 10,
	'output'          => array(
		array(
			'element' => 'body, p, .widget li a, .widget .tagcloud a, .wp-block-quote cite',
		),
	),
	'transport'       => 'postMessage',
	'js_vars'         => array(
		array(
			'element' => 'body, p, .widget li a, .widget .tagcloud a, .wp-block-quote cite',
		),
	),
	'partial_refresh' => array(
		THEME_PREFIX . 'body_font' => array(
			'selector'        => '.rodller-entry-content',
			'render_callback' => '__return_false',
		),
	),
) );

// Accent color
Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'color',
	'settings'    => THEME_PREFIX . 'accent_font_color',
	'label'       => __( 'Accent color', 'rodller' ),
	'description' => __( 'Set color for links in the body text.', 'rodller' ),
	'section'     => THEME_PREFIX . 'body_font_section',
	'default'     => rodller_get_option( 'accent_font_color' ),
	'priority'    => 20,
	'output'      => array(
		array(
			'element'  => 'a',
			'function' => 'css',
			'property' => 'color',
		),
		array(
			'element'  => '.rodller-button, .rodller-button:focus, #rodller-pagination.rodller-load-more > a, #rodller-pagination.rodller-numeric .next, #rodller-pagination.rodller-numeric .prev, .spinner .dot1, .spinner .dot2, .woocommerce ul.products li.product .onsale, .woocommerce #respond input#submit',
			'function' => 'css',
			'property' => 'background-color',
		),
		array(
			'element'  => '.woocommerce nav.woocommerce-pagination ul li .next, .woocommerce nav.woocommerce-pagination ul li .prev, .woocommerce nav.woocommerce-pagination ul li:hover .next, .woocommerce nav.woocommerce-pagination ul li:hover .prev',
			'function' => 'css',
			'property' => 'background-color',
		),
		array(
			'element'  => '.woocommerce button.button, .woocommerce input.button, html .woocommerce #respond input#submit:hover, html .woocommerce a.button:hover, html .woocommerce button.button:hover, html .woocommerce input.button:hover, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce span.onsale, .woocommerce ul.products li.product .button, .woocommerce a.button',
			'function' => 'css',
			'property' => 'background-color',
		),
		array(
			'element'  => '.rodller-metadata .rodller-metadata-item, .rodller-metadata .rodller-metadata-item a, .sticky .rodller-format-icon',
			'function' => 'css',
			'property' => 'color',
		),
		array(
			'element'  => '.widget .calendar_wrap > table caption',
			'function' => 'css',
			'property' => 'color',
		),
		array(
			'element'  => '.widget .calendar_wrap>table thead tr th:last-child, .widget .calendar_wrap>table tbody tr td:last-child',
			'function' => 'css',
			'property' => 'color',
		),
		array(
			'element'  => '.widget .recentcomments a',
			'function' => 'css',
			'property' => 'color',
		),
		array(
			'element'  => '.widget.widget_rss a',
			'function' => 'css',
			'property' => 'color',
		),
		array(
			'element'  => '.widget .rodller-searchform .rodller-search-input-wrapper input[type=submit]',
			'function' => 'css',
			'property' => 'background-color',
		),
		array(
			'element'  => '.rodller-tags>a, .rodller-button.rodller-button-outline',
			'function' => 'css',
			'property' => 'border-color',
		),
		array(
			'element'  => '.rodller-tags>a:hover, .widget .tagcloud a:hover, .rodller-pill:hover',
			'function' => 'css',
			'property' => 'background-color',
		),
		array(
			'element'  => 'button, input[type="submit"]',
			'function' => 'css',
			'property' => 'background-color',
		),
		array(
			'element'  => '.price .amount',
			'function' => 'css',
			'property' => 'color',
		),
		array(
			'element'  => '.rodller-button.rodller-button-outline',
			'function' => 'css',
			'property' => 'color',
		),
	),
	'transport'   => 'postMessage',
	'js_vars'     => array(
		array(
			'element'  => 'a',
			'function' => 'css',
			'property' => 'color',
		),
		array(
			'element'  => '.rodller-button, .rodller-button:focus, #rodller-pagination.rodller-load-more > a, #rodller-pagination.rodller-numeric .next, #rodller-pagination.rodller-numeric .prev, .spinner .dot1, .spinner .dot2, .woocommerce ul.products li.product .onsale, .woocommerce #respond input#submit',
			'function' => 'css',
			'property' => 'background-color',
		),
		array(
			'element'  => '.woocommerce nav.woocommerce-pagination ul li .next, .woocommerce nav.woocommerce-pagination ul li .prev, .woocommerce nav.woocommerce-pagination ul li:hover .next, .woocommerce nav.woocommerce-pagination ul li:hover .prev',
			'function' => 'css',
			'property' => 'background-color',
		),
		array(
			'element'  => '.woocommerce button.button, .woocommerce input.button, html .woocommerce #respond input#submit:hover, html .woocommerce a.button:hover, html .woocommerce button.button:hover, html .woocommerce input.button:hover, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce span.onsale, .woocommerce ul.products li.product .button, .woocommerce a.button',
			'function' => 'css',
			'property' => 'background-color',
		),
		array(
			'element'  => '.rodller-metadata .rodller-metadata-item, .rodller-metadata .rodller-metadata-item a, .sticky .rodller-format-icon',
			'function' => 'css',
			'property' => 'color',
		),
		array(
			'element'  => '.widget .calendar_wrap > table caption',
			'function' => 'css',
			'property' => 'color',
		),
		array(
			'element'  => '.widget .calendar_wrap>table thead tr th:last-child, .widget .calendar_wrap>table tbody tr td:last-child',
			'function' => 'css',
			'property' => 'color',
		),
		array(
			'element'  => '.widget .recentcomments a',
			'function' => 'css',
			'property' => 'color',
		),
		array(
			'element'  => '.widget.widget_rss a',
			'function' => 'css',
			'property' => 'color',
		),
		array(
			'element'  => '.widget .rodller-searchform .rodller-search-input-wrapper input[type=submit]',
			'function' => 'css',
			'property' => 'background-color',
		),
		array(
			'element'  => '.rodller-tags>a, .rodller-button.rodller-button-outline',
			'function' => 'css',
			'property' => 'border-color',
		),
		array(
			'element'  => '.rodller-tags>a:hover, .widget .tagcloud a:hover, .rodller-pill:hover',
			'function' => 'css',
			'property' => 'background-color',
		),
		array(
			'element'  => 'button, input[type="submit"]',
			'function' => 'css',
			'property' => 'background-color',
		),
		array(
			'element'  => '.price .amount',
			'function' => 'css',
			'property' => 'color',
		),
		array(
			'element'  => '.rodller-button.rodller-button-outline',
			'function' => 'css',
			'property' => 'color',
		),
	),
) );

/**
 * Headings font
 */
Kirki::add_section( THEME_PREFIX . 'headings_fonts_section', array(
	'title'    => __( 'Headings font', 'rodller' ),
	'panel'    => THEME_PREFIX . 'typography',
	'priority' => 30,
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'typography',
	'settings'        => THEME_PREFIX . 'headings_fonts',
	'label'           => __( 'Headings font', 'rodller' ),
	'description'     => __( 'Set font for all the headings this includes H1, H2, H3, H4, H5 and H6 tags.', 'rodller' ),
	'section'         => THEME_PREFIX . 'headings_fonts_section',
	'default'         => rodller_get_default_option( 'headings_fonts' ),
	'priority'        => 10,
	'output'          => array(
		array(
			'element' => 'h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6, .rodller-entry-title > a, #rodller-cover .owl-nav .owl-next, #rodller-cover .owl-nav .owl-prev, .rodller-single .entry-content>.wp-block-cover-image .wp-block-cover-image-text',
		),
	),
	'transport'       => 'postMessage',
	'js_vars'         => array(
		array(
			'element' => 'h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6, .rodller-entry-title > a, #rodller-cover .owl-nav .owl-next, #rodller-cover .owl-nav .owl-prev, .rodller-single .entry-content>.wp-block-cover-image .wp-block-cover-image-text',
		),
	),
	'partial_refresh' => array(
		THEME_PREFIX . 'headings_fonts' => array(
			'selector'        => '#rodller-primary > .row > #rodller-primary-title, #rodller-single > article > .rodller-entry-title',
			'render_callback' => '__return_false',
		),
	),
) );


/**
 * Footer options
 */
Kirki::add_section( THEME_PREFIX . 'buttons', array(
	'title'    => __( 'Buttons', 'rodller' ),
	'panel'    => THEME_PREFIX . 'typography',
	'priority' => 40,
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'slider',
	'settings'        => THEME_PREFIX . 'buttons_border_radius',
	'label'           => __( 'Primary CTA Text', 'rodller' ),
	'section'         => THEME_PREFIX . 'buttons',
	'priority'        => 10,
	'default'         => rodller_get_default_option( 'buttons_border_radius' ),
	'choices'     => [
		'min'  => 0,
		'max'  => 30,
		'step' => 1,
	],
	'output'          => array(
		array(
			'element'  => 'button, input[type="button"], input[type="reset"], input[type="submit"], .rodller-button, .rodller-load-more > a, .woocommerce ul.products li.product .onsale, .woocommerce span.onsale, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit.disabled, .woocommerce #respond input#submit:disabled, .woocommerce #respond input#submit:disabled[disabled], .woocommerce a.button.disabled, .woocommerce a.button:disabled, .woocommerce a.button:disabled[disabled], .woocommerce button.button.disabled, .woocommerce button.button:disabled, .woocommerce button.button:disabled[disabled], .woocommerce input.button.disabled, .woocommerce input.button:disabled, .woocommerce input.button:disabled[disabled]',
			'function' => 'css',
			'units'    => 'px',
			'property' => 'border-radius',
		),
	),
	'js_vars'         => array(
		array(
			'element'  => 'button, input[type="button"], input[type="reset"], input[type="submit"], .rodller-button, .rodller-load-more > a, .woocommerce ul.products li.product .onsale, .woocommerce span.onsale, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit.disabled, .woocommerce #respond input#submit:disabled, .woocommerce #respond input#submit:disabled[disabled], .woocommerce a.button.disabled, .woocommerce a.button:disabled, .woocommerce a.button:disabled[disabled], .woocommerce button.button.disabled, .woocommerce button.button:disabled, .woocommerce button.button:disabled[disabled], .woocommerce input.button.disabled, .woocommerce input.button:disabled, .woocommerce input.button:disabled[disabled]',
			'function' => 'css',
			'units'    => 'px',
			'property' => 'border-radius',
		),
	),
) );