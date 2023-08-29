<?php
/**
 * Cover Display Panel
 */
Kirki::add_panel( THEME_PREFIX . 'cover', array(
	'title'    => __( 'Cover', 'rodller' ),
	'priority' => 60,
) );

/**
 * Cover Display options
 */
Kirki::add_section( THEME_PREFIX . 'cover_display', array(
	'title'    => __( 'Cover Display', 'rodller' ),
	'panel'    => THEME_PREFIX . 'cover',
	'priority' => 30,
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'slider',
	'settings'        => THEME_PREFIX . 'cover_height',
	'label'           => __( 'Cover Height', 'rodller' ),
	'description'     => __( 'Set the header height in pixels.', 'rodller' ),
	'section'         => THEME_PREFIX . 'cover_display',
	'priority'        => 10,
	'default'         => rodller_get_default_option( 'cover_height' ),
	'choices'         => array(
		'min'  => '300',
		'max'  => '1500',
		'step' => '10',
	),
	'output'          => array(
		array(
			'element'  => '#rodller-cover .rodller-cover-slider-item .rodller-cover-slider-item-img > a',
			'function' => 'css',
			'units'    => 'px',
			'property' => 'height',
		),
		array(
			'element'  => '#rodller-cover.rodller-cover-post',
			'function' => 'css',
			'units'    => 'px',
			'property' => 'height',
		),
	),
	'transport'       => 'postMessage',
	'js_vars'         => array(
		array(
			'element'  => '#rodller-cover .rodller-cover-slider-item .rodller-cover-slider-item-img > a',
			'function' => 'css',
			'units'    => 'px',
			'property' => 'height',
		),
		array(
			'element'  => '#rodller-cover.rodller-cover-post',
			'function' => 'css',
			'units'    => 'px',
			'property' => 'height',
		),
	),
	'partial_refresh' => array(
		THEME_PREFIX . 'cover_height' => array(
			'selector'        => '.rodller-cover-wrapper',
			'render_callback' => '__return_false',
		),
	),
) );


Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'switch',
	'settings'    => THEME_PREFIX . 'cover_autoplay',
	'label'       => __( 'Autoplay', 'rodller' ),
	'description' => __( 'Set to "ON" if you want slides to move automatically on certain period of time', 'rodller' ),
	'section'     => THEME_PREFIX . 'cover_display',
	'priority'    => 20,
	'default'     => rodller_get_default_option( 'cover_autoplay' ),
	'choices'     => array(
		0 => __( 'Off', 'rodller' ),
		1  => __( 'On', 'rodller' ),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'number',
	'settings'    => THEME_PREFIX . 'cover_autoplay_time',
	'label'       => __( 'Autoplay Time', 'rodller' ),
	'description' => __( 'Set on how many seconds will slides change automatically', 'rodller' ),
	'section'     => THEME_PREFIX . 'cover_display',
	'priority'    => 30,
	'default'     => rodller_get_default_option( 'cover_autoplay_time' ),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'cover_autoplay',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'color',
	'settings'    => THEME_PREFIX . 'cover_box',
	'label'       => __( 'Box below text color', 'rodller' ),
	'description' => __( "Set the color of the box below cover text. If you don't want to show box just set opacity to 0.", 'rodller' ),
	'section'     => THEME_PREFIX . 'cover_display',
	'choices'     => array(
		'alpha' => true,
	),
	'priority'    => 40,
	'default'     => rodller_get_default_option( 'cover_box' ),
	'output'      => array(
		array(
			'element'  => '#rodller-cover .rodller-cover-slider-item .rodller-cover-slider-item-content-wrapper .rodller-cover-slider-item-content',
			'function' => 'css',
			'property' => 'background-color',
		),
	),
	'transport'   => 'postMessage',
	'js_vars'     => array(
		array(
			'element'  => '#rodller-cover .rodller-cover-slider-item .rodller-cover-slider-item-content-wrapper .rodller-cover-slider-item-content',
			'function' => 'css',
			'property' => 'background-color',
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'color',
	'settings'    => THEME_PREFIX . 'cover_text_color',
	'label'       => __( 'Text color', 'rodller' ),
	'description' => __( 'Set text color of the cover area', 'rodller' ),
	'section'     => THEME_PREFIX . 'cover_display',
	'choices'     => array(
		'alpha' => true,
	),
	'priority'    => 50,
	'default'     => rodller_get_default_option( 'cover_text_color' ),
	'output'      => array(
		array(
			'element'  => '#rodller-cover .rodller-cover-slider-item .rodller-cover-slider-item-content-wrapper .rodller-cover-slider-item-content p',
			'function' => 'css',
			'property' => 'color',
		),
	),
	'transport'   => 'postMessage',
	'js_vars'     => array(
		array(
			'element'  => '#rodller-cover .rodller-cover-slider-item .rodller-cover-slider-item-content-wrapper .rodller-cover-slider-item-content p',
			'function' => 'css',
			'property' => 'color',
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'switch',
	'settings'    => THEME_PREFIX . 'cover_show_text',
	'label'       => __( 'Show text', 'rodller' ),
	'description' => __( 'Set to "ON" if you want to display post text in cover', 'rodller' ),
	'section'     => THEME_PREFIX . 'cover_display',
	'priority'    => 60,
	'default'     => rodller_get_default_option( 'cover_show_text' ),
	'choices'     => array(
		0 => __( 'Off', 'rodller' ),
		1  => __( 'On', 'rodller' ),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'switch',
	'settings'    => THEME_PREFIX . 'cover_show_button',
	'label'       => __( 'Show button', 'rodller' ),
	'description' => __( 'Set to "ON" if you want to display post button that will link to post', 'rodller' ),
	'section'     => THEME_PREFIX . 'cover_display',
	'priority'    => 70,
	'default'     => rodller_get_default_option( 'cover_show_button' ),
	'choices'     => array(
		0 => __( 'Off', 'rodller' ),
		1  => __( 'On', 'rodller' ),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'multicheck',
	'settings'    => THEME_PREFIX . 'cover_metadata',
	'label'       => __( 'Post metadata shown in cover', 'rodller' ),
	'description' => __( 'Check what data you want to show above the title in the cover', 'rodller' ),
	'section'     => THEME_PREFIX . 'cover_display',
	'priority'    => 80,
	'choices'     => rodller_get_supported_metadata(),
	'default'     => rodller_get_default_option( 'cover_metadata' ),
) );

/**
 * Default Page Cover Support
 */
Kirki::add_section( THEME_PREFIX . 'page_cover', array(
	'title'    => __( 'Default Page Cover', 'rodller' ),
	'panel'    => THEME_PREFIX . 'cover',
	'priority' => 90,
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'radio-image',
	'settings'        => THEME_PREFIX . 'page_cover_layout',
	'label'           => __( 'Layout', 'rodller' ),
	'description'     => __( 'Set what kind of layout you want for page cover', 'rodller' ),
	'section'         => THEME_PREFIX . 'page_cover',
	'priority'        => 10,
	'choices'         => rodller_get_cover_layouts(),
	'default'         => rodller_get_default_option( 'page_cover_layout' ),
	'partial_refresh' => array(
		THEME_PREFIX . 'page_cover_layout' => array(
			'selector'        => '.page .rodller-cover-wrapper',
			'render_callback' => '__return_false',
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'number',
	'settings'        => THEME_PREFIX . 'page_cover_per_page_number',
	'label'           => __( 'Number of posts', 'rodller' ),
	'section'         => THEME_PREFIX . 'page_cover',
	'priority'        => 20,
	'default'         => rodller_get_default_option( 'page_cover_per_page_number' ),
	'choices'         => array(
		'min'  => 0,
		'max'  => 30,
		'step' => 1,
	),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'page_cover_layout',
			'operator' => '!=',
			'value'    => 'none',
		),
		array(
			'setting'  => THEME_PREFIX . 'page_cover_layout',
			'operator' => '!=',
			'value'    => 'static',
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'radio',
	'settings'        => THEME_PREFIX . 'page_cover_order_by',
	'label'           => __( 'Order By', 'rodller' ),
	'section'         => THEME_PREFIX . 'page_cover',
	'priority'        => 30,
	'choices'         => rodller_get_order_options(),
	'default'         => rodller_get_default_option( 'page_cover_order_by' ),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'page_cover_layout',
			'operator' => '!=',
			'value'    => 'none',
		),
		array(
			'setting'  => THEME_PREFIX . 'page_cover_layout',
			'operator' => '!=',
			'value'    => 'static',
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'text',
	'settings'        => THEME_PREFIX . 'page_cover_manual_order',
	'label'           => __( 'Or choose manually', 'rodller' ),
	'description'     => __( 'Add post IDs separated by comma, for example "11,15"', 'rodller' ),
	'section'         => THEME_PREFIX . 'page_cover',
	'priority'        => 40,
	'default'         => rodller_get_default_option( 'page_cover_manual_order' ),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'page_cover_layout',
			'operator' => '!=',
			'value'    => 'none',
		),
		array(
			'setting'  => THEME_PREFIX . 'page_cover_layout',
			'operator' => '!=',
			'value'    => 'static',
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'radio',
	'settings'        => THEME_PREFIX . 'page_cover_order',
	'label'           => __( 'Sort', 'rodller' ),
	'section'         => THEME_PREFIX . 'page_cover',
	'priority'        => 50,
	'choices'         => rodller_get_sorting_options(),
	'default'         => rodller_get_default_option( 'page_cover_manual_order' ),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'page_cover_layout',
			'operator' => '!=',
			'value'    => 'none',
		),
		array(
			'setting'  => THEME_PREFIX . 'page_cover_layout',
			'operator' => '!=',
			'value'    => 'static',
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'multicheck',
	'settings'        => THEME_PREFIX . 'page_cover_category',
	'label'           => __( 'In category', 'rodller' ),
	'section'         => THEME_PREFIX . 'page_cover',
	'priority'        => 70,
	'choices'         => rodller_get_categories_ids_and_names(),
	'default'         => rodller_get_default_option( 'page_cover_category' ),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'page_cover_layout',
			'operator' => '!=',
			'value'    => 'none',
		),
		array(
			'setting'  => THEME_PREFIX . 'page_cover_layout',
			'operator' => '!=',
			'value'    => 'static',
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'text',
	'settings'        => THEME_PREFIX . 'page_cover_tag',
	'label'           => __( 'Tagged with', 'rodller' ),
	'description'     => __( 'Specify one or more tags separated by comma. i.e. life, cooking, funny moments. For example "new,sport,kids"', 'rodller' ),
	'section'         => THEME_PREFIX . 'page_cover',
	'priority'        => 80,
	'default'         => rodller_get_default_option( 'page_cover_tag' ),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'page_cover_layout',
			'operator' => '!=',
			'value'    => 'none',
		),
		array(
			'setting'  => THEME_PREFIX . 'page_cover_layout',
			'operator' => '!=',
			'value'    => 'static',
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'radio',
	'settings'        => THEME_PREFIX . 'page_format',
	'label'           => __( 'Format', 'rodller' ),
	'section'         => THEME_PREFIX . 'page_cover',
	'priority'        => 90,
	'choices'         => rodller_get_format_choices(),
	'default'         => rodller_get_default_option( 'page_format' ),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'page_cover_layout',
			'operator' => '!=',
			'value'    => 'none',
		),
		array(
			'setting'  => THEME_PREFIX . 'page_cover_layout',
			'operator' => '!=',
			'value'    => 'static',
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'radio',
	'settings'        => THEME_PREFIX . 'page_time_diff',
	'label'           => __( 'Not older then', 'rodller' ),
	'section'         => THEME_PREFIX . 'page_cover',
	'priority'        => 100,
	'choices'         => rodller_get_time_diff_opts(),
	'default'         => rodller_get_default_option( 'page_time_diff' ),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'page_cover_layout',
			'operator' => '!=',
			'value'    => 'none',
		),
		array(
			'setting'  => THEME_PREFIX . 'page_cover_layout',
			'operator' => '!=',
			'value'    => 'static',
		),
	),
) );


Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'radio-image',
	'settings'        => THEME_PREFIX . 'page_cover_layout',
	'label'           => __( 'Layout', 'rodller' ),
	'description'     => __( 'Set what kind of layout you want for page cover', 'rodller' ),
	'section'         => THEME_PREFIX . 'page_cover',
	'priority'        => 10,
	'choices'         => rodller_get_cover_layouts(),
	'default'         => rodller_get_default_option( 'page_cover_layout' ),
	'partial_refresh' => array(
		THEME_PREFIX . 'page_cover_layout' => array(
			'selector'        => '.page .rodller-cover-wrapper',
			'render_callback' => '__return_false',
		),
	),
) );


/**
 * Default Category Cover Support
 */
Kirki::add_section( THEME_PREFIX . 'category_cover', array(
	'title'    => __( 'Default Category Cover', 'rodller' ),
	'panel'    => THEME_PREFIX . 'cover',
	'priority' => 100,
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'radio-image',
	'settings'        => THEME_PREFIX . 'category_cover_layout',
	'label'           => __( 'Layout', 'rodller' ),
	'description'     => __( 'Set what kind of layout you want for page cover', 'rodller' ),
	'section'         => THEME_PREFIX . 'category_cover',
	'priority'        => 10,
	'choices'         => rodller_get_cover_layouts(),
	'default'         => rodller_get_default_option( 'category_cover_layout' ),
	'partial_refresh' => array(
		THEME_PREFIX . 'category_cover_layout' => array(
			'selector'        => '.category .rodller-cover-wrapper',
			'render_callback' => '__return_false',
		),
	),
) );



Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'number',
	'settings'        => THEME_PREFIX . 'category_cover_per_page_number',
	'label'           => __( 'Number of posts', 'rodller' ),
	'section'         => THEME_PREFIX . 'category_cover',
	'priority'        => 20,
	'default'         => rodller_get_default_option( 'category_cover_per_page_number' ),
	'choices'         => array(
		'min'  => 0,
		'max'  => 30,
		'step' => 1,
	),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'category_cover_layout',
			'operator' => '!=',
			'value'    => 'none',
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'radio',
	'settings'        => THEME_PREFIX . 'category_cover_order_by',
	'label'           => __( 'Order By', 'rodller' ),
	'section'         => THEME_PREFIX . 'category_cover',
	'priority'        => 30,
	'choices'         => rodller_get_order_options(),
	'default'         => rodller_get_default_option( 'category_cover_order_by' ),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'category_cover_layout',
			'operator' => '!=',
			'value'    => 'none',
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'radio',
	'settings'        => THEME_PREFIX . 'category_cover_order',
	'label'           => __( 'Sort', 'rodller' ),
	'section'         => THEME_PREFIX . 'category_cover',
	'priority'        => 50,
	'choices'         => rodller_get_sorting_options(),
	'default'         => rodller_get_default_option( 'category_cover_manual_order' ),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'category_cover_layout',
			'operator' => '!=',
			'value'    => 'none',
		),
	),
) );