<?php

/**
 * Archive
 *
 * Options for archive displaying, including Category and Tag template options
 */
Kirki::add_panel( THEME_PREFIX . 'archives', array(
	'title'    => __( 'Archives', 'rodller' ),
	'priority' => 50,
) );

/**
 * Main archive
 */
Kirki::add_section( THEME_PREFIX . 'archive', array(
	'title'    => __( 'Main', 'rodller' ),
	'panel'    => THEME_PREFIX . 'archives',
	'priority' => 10,
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'radio-image',
	'settings'    => THEME_PREFIX . 'archive_sidebar_position',
	'label'       => __( 'Sidebar Position', 'rodller' ),
	'description' => __( 'Pick the sidebar position for main archive pages', 'rodller' ),
	'section'     => THEME_PREFIX . 'archive',
	'priority'    => 10,
	'multiple'    => 1,
	'choices'     => rodller_get_sidebar_positions(),
	'default'     => rodller_get_default_option( 'archive_sidebar_position' ),
) );


Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'select',
	'settings'        => THEME_PREFIX . 'archive_sidebar',
	'label'           => __( 'Static sidebar', 'rodller' ),
	'description'     => __( 'Pick the static sidebar for main archive pages', 'rodller' ),
	'section'         => THEME_PREFIX . 'archive',
	'priority'        => 20,
	'multiple'        => 1,
	'choices'         => rodller_get_registered_sidebars( true ),
	'default'         => rodller_get_default_option( 'archive_sidebar' ),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'archive_sidebar_position',
			'operator' => '!=',
			'value'    => 'none',
		),
	),
) );


Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'select',
	'settings'        => THEME_PREFIX . 'archive_sticky_sidebar',
	'label'           => __( 'Sticky sidebar', 'rodller' ),
	'description'     => __( 'Pick the sidebar that will sticky to the top of the page when user scrolls', 'rodller' ),
	'section'         => THEME_PREFIX . 'archive',
	'priority'        => 30,
	'multiple'        => 1,
	'choices'         => rodller_get_registered_sidebars( true ),
	'default'         => rodller_get_default_option( 'archive_sticky_sidebar' ),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'archive_sidebar_position',
			'operator' => '!=',
			'value'    => 'none',
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'radio-image',
	'settings'        => THEME_PREFIX . 'archive_layout',
	'label'           => __( 'Layout', 'rodller' ),
	'description'     => __( 'Set the posts layouts for main archive page', 'rodller' ),
	'section'         => THEME_PREFIX . 'archive',
	'choices'         => rodller_get_post_layouts(),
	'priority'        => 40,
	'transport'       => 'postMessage',
	'default'         => rodller_get_default_option( 'archive_layout' ),
	'partial_refresh' => array(
		THEME_PREFIX . 'archive_layout' => array(
			'selector'        => '.blog #rodller-primary > .row',
			'render_callback' => '__return_false',
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'radio',
	'settings'    => THEME_PREFIX . 'archive_posts_per_page',
	'label'       => __( 'Posts per page', 'rodller' ),
	'description' => __( 'Set custom if you want to override how many post will be displayed on main archive pages', 'rodller' ),
	'section'     => THEME_PREFIX . 'archive',
	'priority'    => 50,
	'default'     => rodller_get_default_option( 'archive_posts_per_page' ),
	'choices'     => array(
		'inherit' => __( 'Inherit', 'rodller' ),
		'custom'  => __( 'Custom', 'rodller' ),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'number',
	'settings'        => THEME_PREFIX . 'archive_posts_per_page_number',
	'label'           => __( 'Posts per page number', 'rodller' ),
	'description'     => __( 'Pick custom number of posts displayed on main archive page', 'rodller' ),
	'section'         => THEME_PREFIX . 'archive',
	'priority'        => 60,
	'choices'         => array(
		'min'  => 0,
		'max'  => 30,
		'step' => 1,
	),
	'default'         => rodller_get_default_option( 'archive_posts_per_page_number' ),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'archive_posts_per_page',
			'operator' => '==',
			'value'    => 'custom',
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'radio-image',
	'settings'    => THEME_PREFIX . 'archive_pagination',
	'label'       => __( 'Pagination', 'rodller' ),
	'description' => __( 'Set what kid of pagination you want on your main archive page', 'rodller' ),
	'section'     => THEME_PREFIX . 'archive',
	'choices'     => rodller_get_pagination_options(),
	'priority'    => 70,
	'default'     => rodller_get_default_option( 'archive_pagination' ),
) );


/**
 * Category archive
 */
Kirki::add_section( THEME_PREFIX . 'category', array(
	'title'    => __( 'Category', 'rodller' ),
	'panel'    => THEME_PREFIX . 'archives',
	'priority' => 20,
) );


Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'radio-image',
	'settings'    => THEME_PREFIX . 'category_sidebar_position',
	'label'       => __( 'Sidebar Position', 'rodller' ),
	'description' => __( 'Pick the sidebar position for categories', 'rodller' ),
	'section'     => THEME_PREFIX . 'category',
	'priority'    => 10,
	'multiple'    => 1,
	'choices'     => rodller_get_sidebar_positions(),
	'default'     => rodller_get_default_option( 'category_sidebar_position' ),
) );


Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'select',
	'settings'        => THEME_PREFIX . 'category_sidebar',
	'label'           => __( 'Static sidebar', 'rodller' ),
	'description'     => __( 'Pick the static sidebar for categories. If is set to inherit Main archive static sidebar setting will be applied.', 'rodller' ),
	'section'         => THEME_PREFIX . 'category',
	'priority'        => 20,
	'multiple'        => 1,
	'choices'         => rodller_get_registered_sidebars(),
	'default'         => rodller_get_default_option( 'category_sidebar' ),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'category_sidebar_position',
			'operator' => '!=',
			'value'    => 'none',
		),
	),
) );


Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'select',
	'settings'        => THEME_PREFIX . 'category_sticky_sidebar',
	'label'           => __( 'Sticky Sidebar', 'rodller' ),
	'description'     => __( 'Pick the sidebar that will sticky to the top of the page when user scrolls. If is set to inherit Main archive sticky sidebar settings will be applied.', 'rodller' ),
	'section'         => THEME_PREFIX . 'category',
	'priority'        => 30,
	'multiple'        => 1,
	'choices'         => rodller_get_registered_sidebars(),
	'default'         => rodller_get_default_option( 'category_sticky_sidebar' ),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'category_sidebar_position',
			'operator' => '!=',
			'value'    => 'none',
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'radio-image',
	'settings'        => THEME_PREFIX . 'category_layout',
	'label'           => __( 'Layout', 'rodller' ),
	'description'     => __( 'Set the posts layouts for categories', 'rodller' ),
	'section'         => THEME_PREFIX . 'category',
	'choices'         => rodller_get_post_layouts(),
	'priority'        => 40,
	'transport'       => 'postMessage',
	'default'         => rodller_get_default_option( 'category_layout' ),
	'partial_refresh' => array(
		THEME_PREFIX . 'category_layout' => array(
			'selector'        => '.category #rodller-primary > .row',
			'render_callback' => '__return_false',
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'radio',
	'settings'    => THEME_PREFIX . 'category_posts_per_page',
	'label'       => __( 'Posts per page', 'rodller' ),
	'description' => __( 'Set custom if you want to override how many post will be displayed on category archives', 'rodller' ),
	'section'     => THEME_PREFIX . 'category',
	'priority'    => 50,
	'default'     => rodller_get_default_option( 'category_posts_per_page' ),
	'choices'     => array(
		'inherit' => __( 'Inherit', 'rodller' ),
		'custom'  => __( 'Custom', 'rodller' ),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'number',
	'settings'        => THEME_PREFIX . 'category_posts_per_page_number',
	'label'           => __( 'Posts per page number', 'rodller' ),
	'description'     => __( 'Pick custom number of posts displayed on category archives', 'rodller' ),
	'section'         => THEME_PREFIX . 'category',
	'priority'        => 60,
	'choices'         => array(
		'min'  => 0,
		'max'  => 30,
		'step' => 1,
	),
	'default'         => rodller_get_default_option( 'category_posts_per_page_number' ),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'category_posts_per_page',
			'operator' => '==',
			'value'    => 'custom',
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'radio-image',
	'settings'    => THEME_PREFIX . 'category_pagination',
	'label'       => __( 'Pagination', 'rodller' ),
	'description' => __( 'Set what kid of pagination you want on your categories', 'rodller' ),
	'section'     => THEME_PREFIX . 'category',
	'choices'     => rodller_get_pagination_options(),
	'priority'    => 70,
	'default'     => rodller_get_default_option( 'category_pagination' ),
) );

/**
 * Tag archive
 */
Kirki::add_section( THEME_PREFIX . 'tag', array(
	'title'    => __( 'Tag', 'rodller' ),
	'panel'    => THEME_PREFIX . 'archives',
	'priority' => 30,
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'radio-image',
	'settings'    => THEME_PREFIX . 'tag_sidebar_position',
	'label'       => __( 'Sidebar Position', 'rodller' ),
	'description' => __( 'Pick the sidebar position for tags', 'rodller' ),
	'section'     => THEME_PREFIX . 'tag',
	'priority'    => 10,
	'multiple'    => 1,
	'choices'     => rodller_get_sidebar_positions(),
	'default'     => rodller_get_default_option( 'tag_sidebar_position' ),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'select',
	'settings'        => THEME_PREFIX . 'tag_sidebar',
	'label'           => __( 'Static sidebar', 'rodller' ),
	'description'     => __( 'Pick the static sidebar for tags. If is set to inherit Main archive static sidebar setting will be applied.', 'rodller' ),
	'section'         => THEME_PREFIX . 'tag',
	'priority'        => 10,
	'multiple'        => 1,
	'choices'         => rodller_get_registered_sidebars(),
	'default'         => rodller_get_default_option( 'tag_sidebar' ),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'tag_sidebar_position',
			'operator' => '!=',
			'value'    => 'none',
		),
	),
) );


Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'select',
	'settings'        => THEME_PREFIX . 'tag_sticky_sidebar',
	'label'           => __( 'Sticky Sidebar', 'rodller' ),
	'description'     => __( 'Pick the sidebar that will sticky to the top of the page when user scrolls. If is set to inherit Main archive sticky sidebar settings will be applied.', 'rodller' ),
	'section'         => THEME_PREFIX . 'tag',
	'priority'        => 20,
	'multiple'        => 1,
	'choices'         => rodller_get_registered_sidebars(),
	'default'         => rodller_get_default_option( 'tag_sticky_sidebar' ),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'tag_sidebar_position',
			'operator' => '!=',
			'value'    => 'none',
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'radio-image',
	'settings'        => THEME_PREFIX . 'tag_layout',
	'label'           => __( 'Layout', 'rodller' ),
	'description'     => __( 'Set the posts layouts for tags', 'rodller' ),
	'section'         => THEME_PREFIX . 'tag',
	'choices'         => rodller_get_post_layouts(),
	'priority'        => 30,
	'transport'       => 'postMessage',
	'default'         => rodller_get_default_option( 'tag_layout' ),
	'partial_refresh' => array(
		THEME_PREFIX . 'tag_layout' => array(
			'selector'        => '.tag #rodller-primary > .row',
			'render_callback' => '__return_false',
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'radio',
	'settings'    => THEME_PREFIX . 'tag_posts_per_page',
	'label'       => __( 'Posts per page', 'rodller' ),
	'description' => __( 'Set custom if you want to override how many post will be displayed on tag archives', 'rodller' ),
	'section'     => THEME_PREFIX . 'tag',
	'priority'    => 40,
	'default'     => rodller_get_default_option( 'tag_posts_per_page' ),
	'choices'     => array(
		'inherit' => __( 'Inherit', 'rodller' ),
		'custom'  => __( 'Custom', 'rodller' ),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'number',
	'settings'        => THEME_PREFIX . 'tag_posts_per_page_number',
	'label'           => __( 'Posts per page number', 'rodller' ),
	'description'     => __( 'Pick custom number of posts displayed on tag archives', 'rodller' ),
	'section'         => THEME_PREFIX . 'tag',
	'priority'        => 50,
	'default'         => rodller_get_default_option( 'tag_posts_per_page_number' ),
	'choices'         => array(
		'min'  => 0,
		'max'  => 30,
		'step' => 1,
	),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'tag_posts_per_page',
			'operator' => '==',
			'value'    => 'custom',
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'radio-image',
	'settings'    => THEME_PREFIX . 'tag_pagination',
	'label'       => __( 'Pagination', 'rodller' ),
	'description' => __( 'Set what kid of pagination you want on your tags', 'rodller' ),
	'section'     => THEME_PREFIX . 'tag',
	'choices'     => rodller_get_pagination_options(),
	'priority'    => 60,
	'default'     => rodller_get_default_option( 'tag_pagination' ),
) );

/**
 * Author archive
 */
Kirki::add_section( THEME_PREFIX . 'author', array(
	'title'    => __( 'Author', 'rodller' ),
	'panel'    => THEME_PREFIX . 'archives',
	'priority' => 40,
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'radio-image',
	'settings'    => THEME_PREFIX . 'author_sidebar_position',
	'label'       => __( 'Sidebar Position', 'rodller' ),
	'description' => __( 'Pick the sidebar position for author archives', 'rodller' ),
	'section'     => THEME_PREFIX . 'author',
	'priority'    => 10,
	'multiple'    => 1,
	'choices'     => rodller_get_sidebar_positions(),
	'default'     => rodller_get_default_option( 'author_sidebar_position' ),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'select',
	'settings'        => THEME_PREFIX . 'author_sidebar',
	'label'           => __( 'Static sidebar', 'rodller' ),
	'description'     => __( 'Pick the static sidebar for author archives. If is set to inherit Main archive static sidebar setting will be applied.', 'rodller' ),
	'section'         => THEME_PREFIX . 'author',
	'priority'        => 10,
	'multiple'        => 1,
	'choices'         => rodller_get_registered_sidebars(),
	'default'         => rodller_get_default_option( 'author_sidebar' ),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'author_sidebar_position',
			'operator' => '!=',
			'value'    => 'none',
		),
	),
) );


Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'select',
	'settings'        => THEME_PREFIX . 'author_sticky_sidebar',
	'label'           => __( 'Sticky Sidebar', 'rodller' ),
	'description'     => __( 'Pick the sidebar that will sticky to the top of the page when user scrolls. If is set to inherit Main archive sticky sidebar settings will be applied.', 'rodller' ),
	'section'         => THEME_PREFIX . 'author',
	'priority'        => 20,
	'multiple'        => 1,
	'choices'         => rodller_get_registered_sidebars(),
	'default'         => rodller_get_default_option( 'author_sticky_sidebar' ),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'author_sidebar_position',
			'operator' => '!=',
			'value'    => 'none',
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'radio-image',
	'settings'        => THEME_PREFIX . 'author_layout',
	'label'           => __( 'Layout', 'rodller' ),
	'description'     => __( 'Set the posts layouts for authors', 'rodller' ),
	'section'         => THEME_PREFIX . 'author',
	'choices'         => rodller_get_post_layouts(),
	'priority'        => 30,
	'transport'       => 'postMessage',
	'default'         => rodller_get_default_option( 'author_layout' ),
	'partial_refresh' => array(
		THEME_PREFIX . 'author_layout' => array(
			'selector'        => '.author #rodller-primary > .row',
			'render_callback' => '__return_false',
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'radio',
	'settings'    => THEME_PREFIX . 'author_posts_per_page',
	'label'       => __( 'Posts per page', 'rodller' ),
	'description' => __( 'Set custom if you want to override how many post will be displayed on author archives', 'rodller' ),
	'section'     => THEME_PREFIX . 'author',
	'priority'    => 40,
	'default'     => rodller_get_default_option( 'author_posts_per_page' ),
	'choices'     => array(
		'inherit' => __( 'Inherit', 'rodller' ),
		'custom'  => __( 'Custom', 'rodller' ),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'number',
	'settings'        => THEME_PREFIX . 'author_posts_per_page_number',
	'label'           => __( 'Posts per page number', 'rodller' ),
	'description'     => __( 'Pick custom number of posts displayed on author archives', 'rodller' ),
	'section'         => THEME_PREFIX . 'author',
	'priority'        => 50,
	'default'         => rodller_get_default_option( 'author_posts_per_page_number' ),
	'choices'         => array(
		'min'  => 0,
		'max'  => 30,
		'step' => 1,
	),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'author_posts_per_page',
			'operator' => '==',
			'value'    => 'custom',
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'radio-image',
	'settings'    => THEME_PREFIX . 'author_pagination',
	'label'       => __( 'Pagination', 'rodller' ),
	'description' => __( 'Set what kid of pagination you want on your author archives', 'rodller' ),
	'section'     => THEME_PREFIX . 'author',
	'choices'     => rodller_get_pagination_options(),
	'priority'    => 60,
	'default'     => rodller_get_default_option( 'author_pagination' ),
) );

/**
 * Search archive
 */
Kirki::add_section( THEME_PREFIX . 'search', array(
	'title'    => __( 'Search', 'rodller' ),
	'panel'    => THEME_PREFIX . 'archives',
	'priority' => 40,
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'radio-image',
	'settings'    => THEME_PREFIX . 'search_sidebar_position',
	'label'       => __( 'Sidebar Position', 'rodller' ),
	'description' => __( 'Pick the sidebar position for search result page', 'rodller' ),
	'section'     => THEME_PREFIX . 'search',
	'priority'    => 10,
	'multiple'    => 1,
	'choices'     => rodller_get_sidebar_positions(),
	'default'     => rodller_get_default_option( 'search_sidebar_position' ),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'select',
	'settings'        => THEME_PREFIX . 'search_sidebar',
	'label'           => __( 'Static sidebar', 'rodller' ),
	'description'     => __( 'Pick the static sidebar for search result page. If is set to inherit Main archive static sidebar setting will be applied.', 'rodller' ),
	'section'         => THEME_PREFIX . 'search',
	'priority'        => 10,
	'multiple'        => 1,
	'choices'         => rodller_get_registered_sidebars(),
	'default'         => rodller_get_default_option( 'search_sidebar' ),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'search_sidebar_position',
			'operator' => '!=',
			'value'    => 'none',
		),
	),
) );


Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'select',
	'settings'        => THEME_PREFIX . 'search_sticky_sidebar',
	'label'           => __( 'Sticky Sidebar', 'rodller' ),
	'description'     => __( 'Pick the sidebar that will sticky to the top of the page when user scrolls. If is set to inherit Main archive sticky sidebar settings will be applied.', 'rodller' ),
	'section'         => THEME_PREFIX . 'search',
	'priority'        => 20,
	'multiple'        => 1,
	'choices'         => rodller_get_registered_sidebars(),
	'default'         => rodller_get_default_option( 'search_sticky_sidebar' ),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'search_sidebar_position',
			'operator' => '!=',
			'value'    => 'none',
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'radio-image',
	'settings'        => THEME_PREFIX . 'search_layout',
	'label'           => __( 'Layout', 'rodller' ),
	'description'     => __( 'Set the posts layouts for search results page', 'rodller' ),
	'section'         => THEME_PREFIX . 'search',
	'choices'         => rodller_get_post_layouts(),
	'priority'        => 30,
	'transport'       => 'postMessage',
	'default'         => rodller_get_default_option( 'search_layout' ),
	'partial_refresh' => array(
		THEME_PREFIX . 'search_layout' => array(
			'selector'        => '.search #rodller-primary > .row',
			'render_callback' => '__return_false',
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'radio',
	'settings'    => THEME_PREFIX . 'search_posts_per_page',
	'label'       => __( 'Posts per page', 'rodller' ),
	'description' => __( 'Set custom if you want to override how many post will be displayed on search results page', 'rodller' ),
	'section'     => THEME_PREFIX . 'search',
	'priority'    => 40,
	'default'     => rodller_get_default_option( 'search_posts_per_page' ),
	'choices'     => array(
		'inherit' => __( 'Inherit', 'rodller' ),
		'custom'  => __( 'Custom', 'rodller' ),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'number',
	'settings'        => THEME_PREFIX . 'search_posts_per_page_number',
	'label'           => __( 'Posts per page number', 'rodller' ),
	'description'     => __( 'Pick custom number of posts displayed on search results page', 'rodller' ),
	'section'         => THEME_PREFIX . 'search',
	'priority'        => 50,
	'default'         => rodller_get_default_option( 'search_posts_per_page_number' ),
	'choices'         => array(
		'min'  => 0,
		'max'  => 30,
		'step' => 1,
	),
	'active_callback' => array(
		array(
			'setting'  => THEME_PREFIX . 'search_posts_per_page',
			'operator' => '==',
			'value'    => 'custom',
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'        => 'radio-image',
	'settings'    => THEME_PREFIX . 'search_pagination',
	'label'       => __( 'Pagination', 'rodller' ),
	'description' => __( 'Set what kid of pagination you want on your search results pages', 'rodller' ),
	'section'     => THEME_PREFIX . 'search',
	'choices'     => rodller_get_pagination_options(),
	'priority'    => 60,
	'default'     => rodller_get_default_option( 'search_pagination' ),
) );

/**
 * Ads
 */
Kirki::add_section( THEME_PREFIX . 'ads', array(
	'title'    => __( 'Ads', 'rodller' ),
	'panel'    => THEME_PREFIX . 'archives',
	'priority' => 50,
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'editor',
	'settings'        => THEME_PREFIX . 'ad_below_header',
	'label'           => __( 'Ad below header', 'rodller' ),
	'description'     => __( 'This ad that will be displayed just below header on all pages. If you are adding code, we advise you to use text editor.', 'rodller' ),
	'section'         => THEME_PREFIX . 'ads',
	'priority'        => 10,
	'default'         => rodller_get_default_option( 'ad_below_header' ),
	'partial_refresh' => array(
		THEME_PREFIX . 'ad_below_header' => array(
			'selector'        => '#rodller-below-header-ad',
			'render_callback' => '__return_false',
		),
	),
) );

Kirki::add_field( THEME_PREFIX . 'options', array(
	'type'            => 'editor',
	'settings'        => THEME_PREFIX . 'ad_before_footer',
	'label'           => __( 'Ad above footer', 'rodller' ),
	'description'     => __( 'This ad that will be displayed just above footer an all pages. If you are adding code, we advise you to use text editor.', 'rodller' ),
	'section'         => THEME_PREFIX . 'ads',
	'priority'        => 10,
	'default'         => rodller_get_default_option( 'ad_before_footer' ),
	'partial_refresh' => array(
		THEME_PREFIX . 'ad_before_footer' => array(
			'selector'        => '#rodller-before-footer-ad',
			'render_callback' => '__return_false',
		),
	),
) );