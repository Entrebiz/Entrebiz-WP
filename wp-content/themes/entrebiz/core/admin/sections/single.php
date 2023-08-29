<?php
/**
 * Single
 *
 * Options for displaying single post in all formats (standard, video, audio, gallery) and page
 */
Kirki::add_panel( THEME_PREFIX . 'single', array(
	'title'    => __( 'Single', 'rodller' ),
	'priority' => 60,
) );

/**
 * Page
 */
Kirki::add_section( THEME_PREFIX . 'page', array(
	'title'    => __( 'Page', 'rodller' ),
	'panel'    => THEME_PREFIX . 'single',
	'priority' => 10,
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'radio-image',
	'settings'        => THEME_PREFIX . 'page_sidebar_position',
	'label'           => __( 'Sidebar Position', 'rodller' ),
	'description'     => __( 'Pick the sidebar position for pages', 'rodller' ),
	'section'         => THEME_PREFIX . 'page',
	'priority'        => 10,
	'multiple'        => 1,
	'choices'         => rodller_get_sidebar_positions(),
	'default'         => rodller_get_default_option( 'page_sidebar_position' ),
	'partial_refresh' => array(
		THEME_PREFIX . 'page_sidebar_position' => array(
			'selector'        => '.page #rodller-main .rodller-entry-content',
			'render_callback' => '__return_false',
		),
	),
) );


Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'select',
	'settings'        => THEME_PREFIX . 'page_sidebar',
	'label'           => __( 'Static sidebar', 'rodller' ),
	'description'     => __( 'Pick the static sidebar for pages', 'rodller' ),
	'section'         => THEME_PREFIX . 'page',
	'priority'        => 20,
	'multiple'        => 1,
	'choices'         => rodller_get_registered_sidebars( true ),
	'default'         => rodller_get_default_option( 'page_sidebar' ),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'page_sidebar_position',
			'operator' => '!=',
			'value'    => 'none',
		),
	),
) );


Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'select',
	'settings'        => THEME_PREFIX . 'page_sticky_sidebar',
	'label'           => __( 'Sticky Sidebar', 'rodller' ),
	'description'     => __( 'Pick the sidebar that will sticky to the top of the page when user scrolls and it will be displayed on pages', 'rodller' ),
	'section'         => THEME_PREFIX . 'page',
	'priority'        => 30,
	'multiple'        => 1,
	'choices'         => rodller_get_registered_sidebars( true ),
	'default'         => rodller_get_default_option( 'page_sticky_sidebar' ),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'page_sidebar_position',
			'operator' => '!=',
			'value'    => 'none',
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'     => 'switch',
	'settings' => THEME_PREFIX . 'page_featured_image',
	'label'    => __( 'Display featured image', 'rodller' ),
	'section'  => THEME_PREFIX . 'page',
	'priority' => 40,
	'default'  => rodller_get_default_option( 'page_featured_image' ),
	'choices'  => array(
		0 => __( 'Off', 'rodller' ),
		1 => __( 'On', 'rodller' ),
	),
) );


Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'switch',
	'settings'        => THEME_PREFIX . 'page_featured_image_caption',
	'label'           => __( 'Display featured image caption', 'rodller' ),
	'section'         => THEME_PREFIX . 'page',
	'priority'        => 60,
	'default'         => rodller_get_default_option( 'page_featured_image_caption' ),
	'choices'         => array(
		0 => __( 'Off', 'rodller' ),
		1 => __( 'On', 'rodller' ),
	),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'page_featured_image',
			'operator' => '=',
			'value'    => 1,
		),
	),
) );


/**
 * Post
 */
Kirki::add_section( THEME_PREFIX . 'post', array(
	'title'    => __( 'Post', 'rodller' ),
	'panel'    => THEME_PREFIX . 'single',
	'priority' => 20,
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'radio-image',
	'settings'        => THEME_PREFIX . 'single_post_layout',
	'label'           => __( 'Layout', 'rodller' ),
	'description'     => __( 'Pick the default layout of the single post', 'rodller' ),
	'section'         => THEME_PREFIX . 'post',
	'priority'        => 1,
	'multiple'        => 1,
	'choices'         => rodller_get_single_post_layout_options(),
	'default'         => rodller_get_default_option( 'single_post_layout' ),
	'partial_refresh' => array(
		THEME_PREFIX . 'post_sidebar_position' => array(
			'selector'        => '.rodller-single .rodller-entry-header',
			'render_callback' => '__return_false',
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'radio-image',
	'settings'        => THEME_PREFIX . 'post_sidebar_position',
	'label'           => __( 'Sidebar Position', 'rodller' ),
	'description'     => __( 'Pick the static sidebar for posts. If is set to inherit Page static sidebar setting will be applied.', 'rodller' ),
	'section'         => THEME_PREFIX . 'post',
	'priority'        => 10,
	'multiple'        => 1,
	'choices'         => rodller_get_sidebar_positions(),
	'default'         => rodller_get_default_option( 'post_sidebar_position' ),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'select',
	'settings'        => THEME_PREFIX . 'post_sidebar',
	'label'           => __( 'Static sidebar', 'rodller' ),
	'description'     => __( 'If is set to inherit Page sidebar settings will be applied.', 'rodller' ),
	'section'         => THEME_PREFIX . 'post',
	'priority'        => 20,
	'multiple'        => 1,
	'choices'         => rodller_get_registered_sidebars(),
	'default'         => rodller_get_default_option( 'post_sidebar' ),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'post_sidebar_position',
			'operator' => '!=',
			'value'    => 'none',
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'select',
	'settings'        => THEME_PREFIX . 'post_sticky_sidebar',
	'label'           => __( 'Sticky Sidebar', 'rodller' ),
	'description'     => __( 'If is set to inherit Page sticky sidebar settings will be applied.', 'rodller' ),
	'section'         => THEME_PREFIX . 'post',
	'priority'        => 30,
	'multiple'        => 1,
	'choices'         => rodller_get_registered_sidebars(),
	'default'         => rodller_get_default_option( 'post_sticky_sidebar' ),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'post_sidebar_position',
			'operator' => '!=',
			'value'    => 'none',
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'multicheck',
	'settings'    => THEME_PREFIX . 'single_post_metadata',
	'label'       => __( 'Post metadata', 'rodller' ),
	'description' => __( 'Check what data you want to show on single post', 'rodller' ),
	'section'     => THEME_PREFIX . 'post',
	'priority'    => 40,
	'choices'     => rodller_get_supported_metadata(),
	'default'     => rodller_get_default_option( 'single_post_metadata' ),
) );


Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'     => 'switch',
	'settings' => THEME_PREFIX . 'single_post_categories',
	'label'    => __( 'Display categories', 'rodller' ),
	'section'  => THEME_PREFIX . 'post',
	'priority' => 60,
	'default'  => rodller_get_default_option( 'single_post_categories' ),
	'choices'  => array(
		0 => __( 'Off', 'rodller' ),
		1 => __( 'On', 'rodller' ),
	),
) );


Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'     => 'switch',
	'settings' => THEME_PREFIX . 'single_post_featured_image',
	'label'    => __( 'Display featured image', 'rodller' ),
	'section'  => THEME_PREFIX . 'post',
	'priority' => 60,
	'default'  => rodller_get_default_option( 'single_post_featured_image' ),
	'choices'  => array(
		0 => __( 'Off', 'rodller' ),
		1 => __( 'On', 'rodller' ),
	),
) );


Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'switch',
	'settings'        => THEME_PREFIX . 'single_post_featured_image_caption',
	'label'           => __( 'Display featured image caption', 'rodller' ),
	'section'         => THEME_PREFIX . 'post',
	'priority'        => 70,
	'default'         => rodller_get_default_option( 'single_post_featured_image_caption' ),
	'choices'         => array(
		0 => __( 'Off', 'rodller' ),
		1 => __( 'On', 'rodller' ),
	),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'single_post_featured_image',
			'operator' => '=',
			'value'    => 1,
		),
	),
) );


Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'     => 'switch',
	'settings' => THEME_PREFIX . 'single_post_expert',
	'label'    => __( 'Display headline (excerpt)', 'rodller' ),
	'section'  => THEME_PREFIX . 'post',
	'priority' => 80,
	'default'  => rodller_get_default_option( 'single_post_expert' ),
	'choices'  => array(
		0 => __( 'Off', 'rodller' ),
		1 => __( 'On', 'rodller' ),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'number',
	'settings'        => THEME_PREFIX . 'single_post_text_limit',
	'label'           => __( 'Excerpt limit', 'rodller' ),
	'description'     => __( 'If there is no excerpt, set the limit of text characters that will be displayed below title and above featured image', 'rodller' ),
	'section'         => THEME_PREFIX . 'post',
	'priority'        => 90,
	'default'         => rodller_get_default_option( 'single_post_text_limit' ),
	'choices'         => array(
		'min'  => 100,
		'max'  => 400,
		'step' => 10,
	),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'single_post_expert',
			'operator' => '==',
			'value'    => 1,
		),
	),
	'partial_refresh' => array(
		THEME_PREFIX . 'single_post_text_limit' => array(
			'selector'        => '#md-single-post-excerpt',
			'render_callback' => '__return_false',
		),
	),
) );


Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'     => 'switch',
	'settings' => THEME_PREFIX . 'single_post_tags',
	'label'    => __( 'Display tags', 'rodller' ),
	'section'  => THEME_PREFIX . 'post',
	'priority' => 100,
	'default'  => rodller_get_default_option( 'single_post_tags' ),
	'choices'  => array(
		0 => __( 'Off', 'rodller' ),
		1 => __( 'On', 'rodller' ),
	),
) );


Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'     => 'switch',
	'settings' => THEME_PREFIX . 'single_post_tags',
	'label'    => __( 'Display tags', 'rodller' ),
	'section'  => THEME_PREFIX . 'post',
	'priority' => 110,
	'default'  => rodller_get_default_option( 'single_post_tags' ),
	'choices'  => array(
		0 => __( 'Off', 'rodller' ),
		1 => __( 'On', 'rodller' ),
	),
) );


Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'     => 'switch',
	'settings' => THEME_PREFIX . 'single_post_author',
	'label'    => __( 'Display author area', 'rodller' ),
	'section'  => THEME_PREFIX . 'post',
	'priority' => 120,
	'default'  => rodller_get_default_option( 'single_post_author' ),
	'choices'  => array(
		0 => __( 'Off', 'rodller' ),
		1 => __( 'On', 'rodller' ),
	),
) );


Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'     => 'switch',
	'settings' => THEME_PREFIX . 'single_post_prevnext',
	'label'    => __( 'Display prev/next posts', 'rodller' ),
	'section'  => THEME_PREFIX . 'post',
	'priority' => 120,
	'default'  => rodller_get_default_option( 'single_post_prevnext' ),
	'choices'  => array(
		0 => __( 'Off', 'rodller' ),
		1 => __( 'On', 'rodller' ),
	),
) );


/**
 * Related posts
 */
Kirki::add_section( THEME_PREFIX . 'related_posts', array(
	'title'    => __( 'Post - Related posts', 'rodller' ),
	'panel'    => THEME_PREFIX . 'single',
	'priority' => 30,
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'radio',
	'settings'        => THEME_PREFIX . 'related_type',
	'label'           => __( 'Related Posts Type', 'rodller' ),
	'description'     => __( 'Check how do you want to generate related posts', 'rodller' ),
	'section'         => THEME_PREFIX . 'related_posts',
	'priority'        => 10,
	'choices'         => rodller_get_related_posts_types(),
	'default'         => rodller_get_default_option( 'related_type' ),
	'partial_refresh' => array(
		THEME_PREFIX . 'related_type' => array(
			'selector'        => '.single-post #rodller-related-posts > .container',
			'render_callback' => '__return_false',
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'number',
	'settings'        => THEME_PREFIX . 'related_limit',
	'label'           => __( 'Number of posts', 'rodller' ),
	'section'         => THEME_PREFIX . 'related_posts',
	'priority'        => 20,
	'default'         => rodller_get_default_option( 'related_limit' ),
	'choices'         => array(
		'min'  => 0,
		'max'  => 30,
		'step' => 1,
	),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'related_type',
			'operator' => '=',
			'value'    => 'default',
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'radio',
	'settings'        => THEME_PREFIX . 'related_logic',
	'label'           => __( 'Get post by', 'rodller' ),
	'description'     => __( 'Pick condition that will be used for getting related posts', 'rodller' ),
	'section'         => THEME_PREFIX . 'related_posts',
	'priority'        => 30,
	'choices'         => rodller_get_related_logic_types(),
	'default'         => rodller_get_default_option( 'related_logic' ),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'related_type',
			'operator' => '=',
			'value'    => 'default',
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'radio',
	'settings'        => THEME_PREFIX . 'related_order',
	'label'           => __( 'Order by', 'rodller' ),
	'section'         => THEME_PREFIX . 'related_posts',
	'priority'        => 40,
	'choices'         => rodller_get_order_options(),
	'default'         => rodller_get_default_option( 'related_order' ),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'related_type',
			'operator' => '=',
			'value'    => 'default',
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'radio',
	'settings'        => THEME_PREFIX . 'related_old',
	'label'           => __( 'Not older then', 'rodller' ),
	'section'         => THEME_PREFIX . 'related_posts',
	'priority'        => 40,
	'choices'         => rodller_get_time_diff_opts(),
	'default'         => rodller_get_default_option( 'related_old' ),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'related_type',
			'operator' => '=',
			'value'    => 'default',
		),
	),
) );
