<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Get post thumbnail image if exits, if not get default thumbnail image
 *
 * @filter rodller_modify_default_image_path
 * @since 1.0
 */
if ( ! function_exists( 'rodller_get_post_thumbnail' ) ) :
	function rodller_get_post_thumbnail( $size = '', $post_id = null ) {
		if ( empty( $post_id ) ) {
			$post_id = get_the_ID();
		}
		
		$thumbnail = get_the_post_thumbnail_url( $post_id, $size );
		if ( ! empty( $thumbnail ) ) {
			return $thumbnail;
		}
		
		$default_id = rodller_get_option( 'default_featured_image' );
		if ( ! empty( $default_id ) ) {
			$url = wp_get_attachment_image_src( $default_id, $size );
			if ( ! empty( $url[0] ) ) {
				return $url[0];
			}
		}
		
		$defalut_size = ! empty( $size ) ? '-' . $size : '';
		
		return apply_filters( 'rodller_modify_default_image_path', get_theme_file_uri( 'assets/public/img/default' . $defalut_size . '.jpg' ) );
	}
endif;


/**
 * Get category thumbnail image if exits, if not get default thumbnail image
 *
 * @filter rodller_modify_default_image_path
 * @since 1.0
 */
if ( ! function_exists( 'rodller_get_thumbnail_by_id' ) ) :
	function rodller_get_thumbnail_by_id( $image_id, $size = '' ) {
		
		$thumbnail = wp_get_attachment_image_src( $image_id, $size );
		if ( ! empty( $thumbnail[0] ) ) {
			return $thumbnail[0];
		}
		
		$default_id = rodller_get_option( 'default_featured_image' );
		if ( ! empty( $default_id ) ) {
			$url = wp_get_attachment_image_src( $default_id, $size );
			if ( ! empty( $url[0] ) ) {
				return $url[0];
			}
		}
		
		$defalut_size = ! empty( $size ) ? '-' . $size : '';
		
		return apply_filters( 'rodller_modifiy_thumbnail_by_id', get_theme_file_uri( 'assets/public/img/default' . $defalut_size . '.jpg' ) );
	}
endif;


/**
 * Get branding
 *
 * Returns HTML of logo or website title based on theme options
 *
 * @param string $element ID of an element to check
 *
 * @return string HTML
 * @since  1.0
 */

if ( ! function_exists( 'rodller_get_logo' ) ):
	function rodller_get_logo() {
		
		global $rodller_logo_used;
		
		//Get all logos
		$logo_ids = array(
			'logo'              => rodller_get_option( 'logo' ),
			'logo_retina'       => rodller_get_option( 'retina_logo' ),
			'small_logo'        => rodller_get_option( 'small_logo' ),
			'small_retina_logo' => rodller_get_option( 'small_retina_logo' ),
		);
		
		$empty_logo_class = '';
		$logos            = array();
		
		
		$logo_ids['small_logo'] = empty( $logo_ids['small_logo'] ) ? $logo_ids['logo'] : $logo_ids['small_logo'];
		
		foreach ( $logo_ids as $logo_size => $logo_id ) {
			$logos[ $logo_size ] = wp_get_attachment_image_src( $logo_id, 'full' );
		}
		
		if ( empty( $logos['logo'][0] ) ) {
			
			$logo_html        = get_bloginfo( 'name' );
			$empty_logo_class = 'logo-img-none';
			
		} else {
			
			$logo_html = '<picture class="rodller-logo">';
			$logo_html .= '<source media="(min-width: 992px)" srcset="' . esc_attr( $logos['logo'][0] );
			
			if ( ! empty( $logos['retina_logo'][0] ) ) {
				$logo_html .= ', ' . esc_attr( $logos['retina_logo'][0] ) . ' 2x';
			}
			
			$logo_html .= '">';
			if ( ! empty( $logos['small_logo'][0] ) ) {
				$logo_html .= '<source srcset="' . esc_attr( $logos['small_logo'][0] );
			}
			
			if ( ! empty( $logos['small_retina_logo'][0] ) ) {
				$logo_html .= ', ' . esc_attr( $logos['small_retina_logo'][0] ) . ' 2x';
			}
			
			$logo_html .= '">';
			$logo_html .= '<img src="' . esc_attr( $logos['logo'][0] ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '">';
			$logo_html .= '</picture>';
		}
		
		$element   = is_front_page() && empty( $rodller_logo_used ) ? 'h1' : 'span';
		$url       = rodller_get_option( 'logo_custom_url' ) ? rodller_get_option( 'logo_custom_url' ) : home_url( '/' );
		$site_desc = empty( $rodller_logo_used ) && rodller_get_option( 'display_title_tagline' ) ? '<span class="site-description">' . get_bloginfo( 'description' ) . '</span>' : '';
		
		$output = '<div class="rodller-header-logo"><' . esc_attr( $element ) . ' class="site-title h1 ' . esc_attr( $empty_logo_class ) . '"><a href="' . esc_url( $url ) . '" rel="home">' . $logo_html . '</a></' . esc_attr( $element ) . '>' . $site_desc . '</div>';
		
		$rodller_logo_used = true;
		
		
		return apply_filters( 'rodller_modify_logo', $output );
		
	}
endif;

if ( ! function_exists( 'rodller_get_archive_layout' ) ):
	function rodller_get_archive_layout() {
		$template = rodller_detect_template();
		if ( $template === 'category' ) {
			$category_settings = rodller_get_category_metadata( get_queried_object_id() );
			
			if ( $category_settings['display_settings'] == 'custom' ) {
				return $category_settings['layout'];
			}
		}
		
		$layout = rodller_get_option( $template . '_layout' );
		
		return apply_filters( 'rodller_modify_archive_layout', $layout );
	}
endif;

/**
 * Get type of pagination, it can be numeric, prev-next, load-more and infinite-scroll
 *
 * @filter rodller_modify_pagination_type
 * @since 1.0
 */
if ( ! function_exists( 'rodller_get_pagination_type' ) ):
	function rodller_get_pagination_type() {
		$template = rodller_detect_template();
		
		$pagination_type = rodller_get_option( $template . '_pagination' );
		
		if ( $template == 'category' ) {
			$meta = rodller_get_category_metadata( get_queried_object_id() );
			if ( ! empty( $meta['pagination'] ) ) {
				return $meta['pagination'];
			}
		}
		
		$pagination_type = apply_filters( 'rodller_modify_pagination_type', $pagination_type );
		
		return $pagination_type;
	}
endif;

/**
 * Render pagination links
 *
 * @filter rodller_modify_pagination_links
 * @since 1.0
 */
if ( ! function_exists( 'rodller_pagination_links' ) ):
	function rodller_pagination_links() {
		$pagination_args = apply_filters( 'rodller_modify_pagination_links', array(
			'prev_text' => '<i class="ion-ios-arrow-back"></i>',
			'next_text' => '<i class="ion-ios-arrow-forward"></i>',
		) );
		
		return paginate_links( $pagination_args );
	}
endif;

/**
 * Get Sidebar by options.
 *
 * Note the inherit option it's used as a fallback,
 * for example if post has inherit side bar it will be taken form
 *
 * @filter rodller_modify_metabox_sidebar_options Gets options from metadata
 * @filter rodller_modify_no_sidebar_options If there is no sidebar options
 * @filter rodller_modify_sidebar_options Gets options form theme settings
 * @since 1.0
 */
if ( ! function_exists( 'rodller_get_template_sidebar_options' ) ):
	function rodller_get_template_sidebar_options() {
		
		global $rodller_sidebar_settings;
		
		if ( ! empty( $rodller_sidebar_settings ) ) {
			return $rodller_sidebar_settings;
		}
		
		$defaults = array(
			'main_class'     => 'col-lg-8 col-md-12',
			'aside_class'    => 'col-lg-4 col-md-12',
			'sidebar_active' => true,
			'layout-a_class' => 'col-md-6',
			'layout-b_class' => 'col-md-6',
			'layout-c_class' => 'col-md-12',
			'layout-d_class' => 'col-md-12',
		);
		
		$sidebar_settings = array(
			'sidebar_position'    => 'none',
			'sidebar_name'        => 'inherit',
			'sticky_sidebar_name' => 'inherit',
		);
		
		$id       = get_queried_object_id();
		$template = rodller_detect_template();
		
		if ( in_array( $template, array( 'post', 'page' ) ) ) {
			$sidebar_settings = rodller_get_single_sidebar( $sidebar_settings, $id );
		}
		
		if ( in_array( $template, array( 'author', 'archive', 'category', 'tag', 'search' ) ) ) {
			$sidebar_settings = rodller_get_archive_sidebar_settings_fallback( $template, $id );
		}
		
		
		if ( ( $sidebar_settings['sidebar_position'] === 'none' ) || ( empty( $sidebar_settings['sidebar_name'] ) && empty( $sidebar_settings['sticky_sidebar_name'] ) ) || ( ( $sidebar_settings['sidebar_name'] === 'none' || empty( $sidebar_settings['sidebar_name'] ) ) && ( $sidebar_settings['sticky_sidebar_name'] === 'none' || empty( $sidebar_settings['sticky_sidebar_name'] ) ) ) ) {
			$sidebar_settings = apply_filters( 'rodller_modify_no_sidebar_options', array(
				'sidebar_position' => 'none',
				'main_class'       => '',
				'sidebar_active'   => false,
				'aside_class'      => null,
				'layout-a_class'   => 'col-lg-4 col-md-6 col-sm-12',
				'layout-b_class'   => 'col-lg-4 col-md-6 col-sm-12',
				'layout-c_class'   => 'col-12',
				'layout-d_class'   => 'col-12',
			) );
			
			$rodller_sidebar_settings = $sidebar_settings;
			
			return $sidebar_settings;
		}
		
		$sidebar_settings = apply_filters( 'rodller_modify_sidebar_options', rodller_parse_args( $defaults, array(
			'sidebar_position'    => $sidebar_settings['sidebar_position'],
			'sidebar_name'        => $sidebar_settings['sidebar_name'],
			'sticky_sidebar_name' => $sidebar_settings['sticky_sidebar_name'],
		) ) );
		
		$rodller_sidebar_settings = $sidebar_settings;
		
		return $sidebar_settings;
	}
endif;

/**
 * Get single post/page sidebar options
 *
 * @filter rodller_modify_single_sidebar_fallback
 * @since 1.0
 */
if ( ! function_exists( 'rodller_get_single_sidebar' ) ):
	function rodller_get_single_sidebar( $sidebar_settings, $id ) {
		
		if ( ! empty( $id ) ) {
			$metadata                                = rodller_get_metadata( $id );
			$sidebar_settings['sidebar_position']    = $metadata['sidebar_position'];
			$sidebar_settings['sidebar_name']        = $metadata['sidebar'];
			$sidebar_settings['sticky_sidebar_name'] = $metadata['sticky_sidebar'];
		}
		
		$post_type        = get_post_type( $id );
		$sidebar_position = $sidebar_settings['sidebar_position'];
		$sidebar          = $sidebar_settings['sidebar_name'];
		$sticky_sidebar   = $sidebar_settings['sticky_sidebar_name'];
		
		// Sidebar position fallback
		if ( $post_type !== 'page' && $sidebar_position === 'inherit' ) {
			$sidebar_position = rodller_get_option( $post_type . '_sidebar_position' );
		}
		
		if ( $sidebar_position === 'inherit' ) {
			$sidebar_position = rodller_get_option( 'page_sidebar_position' );
		}
		
		// Sidebar fallback
		if ( $post_type !== 'page' && $sidebar === 'inherit' ) {
			$sidebar = rodller_get_option( $post_type . '_sidebar' );
		}
		
		if ( $sidebar === 'inherit' ) {
			$sidebar = rodller_get_option( 'page_sidebar' );
		}
		
		// Sticky sidebar fallbacks
		if ( $post_type !== 'page' && $sticky_sidebar === 'inherit' ) {
			$sticky_sidebar = rodller_get_option( $post_type . '_sticky_sidebar' );
		}
		
		if ( $sticky_sidebar === 'inherit' ) {
			$sticky_sidebar = rodller_get_option( 'page_sticky_sidebar' );
		}
		
		$sidebar_options = apply_filters( 'rodller_modify_single_sidebar_fallback', array(
			'sidebar_position'    => $sidebar_position,
			'sidebar_name'        => $sidebar,
			'sticky_sidebar_name' => $sticky_sidebar,
		) );
		
		return $sidebar_options;
		
	}
endif;

/**
 * Get category sidebar options
 *
 * @filter rodller_modify_category_sidebar_fallback
 * @since 1.0
 */
if ( ! function_exists( 'rodller_get_category_sidebar_fallback' ) ):
	function rodller_get_category_sidebar_fallback( $sidebar_position, $sidebar, $sticky_sidebar, $id ) {
		
		$metadata = rodller_get_category_metadata( $id );
		
		
		$sidebar_options = apply_filters( 'rodller_modify_category_sidebar_fallback', array(
			'sidebar_position'    => $sidebar_position,
			'sidebar_name'        => $sidebar,
			'sticky_sidebar_name' => $sticky_sidebar,
		) );
		
		return $sidebar_options;
		
	}
endif;


/**
 * Get archives (post page, category and tag) sidebar options
 *
 * @filter rodller_modify_archive_sidebar_fallback
 * @since 1.0
 */
if ( ! function_exists( 'rodller_get_archive_sidebar_settings' ) ):
	function rodller_get_archive_sidebar_settings_fallback( $template, $id ) {
		$defaults = array(
			'sidebar_position'    => 'none',
			'sidebar_name'        => 'none',
			'sticky_sidebar_name' => 'none',
		);
		
		$sidebar_position = rodller_get_option( $template . '_sidebar_position' );
		
		if ( ! empty( $id ) && $template === 'category' ) {
			$category_meta = rodller_get_category_metadata( $id );
			if ( $category_meta['display_settings'] == 'custom' ) {
				$sidebar        = $category_meta['sidebar'];
				$sticky_sidebar = $category_meta['sticky_sidebar'];
				
				if ( $sidebar_position == 'none' && $sidebar === 'inherit' && $sticky_sidebar === 'inherit' ) {
					return $defaults;
				}
				
				$sidebar_position = $category_meta['sidebar_position'];
				
				if ( $sidebar === 'inherit' ) {
					$sidebar = rodller_get_option( 'category_sidebar' );
				}
				if ( $sticky_sidebar === 'inherit' ) {
					$sticky_sidebar = rodller_get_option( 'category_sticky_sidebar' );
				}
			} else {
				$sidebar        = rodller_get_option( $template . '_sidebar' );
				$sticky_sidebar = rodller_get_option( $template . '_sticky_sidebar' );
			}
			
		} else {
			$sidebar        = rodller_get_option( $template . '_sidebar' );
			$sticky_sidebar = rodller_get_option( $template . '_sticky_sidebar' );
		}
		
		if ( rodller_get_option( 'archive_sidebar_position' ) == 'none' && $sidebar === 'inherit' && $sticky_sidebar === 'inherit' ) {
			return $defaults;
		}
		
		if ( $sidebar === 'inherit' ) {
			$sidebar = rodller_get_option( 'archive_sidebar' );
		}
		
		if ( $sticky_sidebar === 'inherit' ) {
			$sticky_sidebar = rodller_get_option( 'archive_sticky_sidebar' );
		}
		
		$sidebar_settings = apply_filters( 'rodller_modify_archive_sidebar_fallback', array(
			'sidebar_position'    => $sidebar_position,
			'sidebar_name'        => $sidebar,
			'sticky_sidebar_name' => $sticky_sidebar,
		) );
		
		$sidebar_settings = rodller_parse_args( $sidebar_settings, $defaults );
		
		return $sidebar_settings;
	}
endif;

/**
 * Get single post layout
 *
 * @return string container class
 * @since 1.0
 */
if ( ! function_exists( 'rodller_get_single_post_layout' ) ):
	function rodller_get_single_post_layout( $post_id = null ) {
		if ( empty( $post_id ) ) {
			$post_id = get_queried_object_id();
		}
		
		$meta = rodller_get_metadata( $post_id );
		if ( $meta['layout'] != 'inherit' ) {
			return $meta['layout'];
		}
		
		$layout = rodller_get_option( 'single_post_layout' );
		
		
		return apply_filters( 'rodller_modify_single_post_layout', $layout );
	}
endif;

/**
 * Get singular container class
 *
 * @return string container class
 * @since 1.0
 */
if ( ! function_exists( 'rodller_get_single_container_class' ) ):
	function rodller_get_single_container_class() {
		$sidebar_options = rodller_get_template_sidebar_options();

		if ( $sidebar_options['sidebar_position'] == 'none' ) {
			if (is_single()){
				return 'container-small';
			}

			return 'container';
		}

		return '';
	}
endif;

/**
 * Generate title by current template
 *
 * @return string Title in archive
 * @since 1.0
 */
if ( ! function_exists( 'rodller_get_archive_title' ) ):
	function rodller_get_archive_title() {
		$template = rodller_detect_template();
		
		if ( $template === 'category' ) {
			$id = get_queried_object_id();
			
			return get_cat_name( $id );
		}
		
		if ( $template === 'tag' ) {
			return __( 'Tag - ', 'rodller' ) . single_tag_title( '', false );
		}
		
		if ( $template === 'author' ) {
			return __( 'Author - ', 'rodller' ) . get_the_author_meta( 'display_name' );
		}
		
		return __( 'Latest Posts', 'rodller' );
	}
endif;

/**
 * Get page default cover options
 * This will work only if page cover layout is set to inherit
 *
 * @return array Cover options
 * @since 1.0
 */
if ( ! function_exists( 'rodller_get_page_cover_options' ) ):
	function rodller_get_page_cover_options( $id ) {
		
		if ( rodller_is_woocommerce_active() && is_woocommerce() ) {
			return array(
				'layout' => 'none',
			);
		}
		
		$options      = array();
		$page_options = rodller_get_metadata( $id );
		
		if ( $page_options['cover']['layout'] === 'inherit' ) {
			$options['cover'] = array(
				'layout'         => rodller_get_option( 'page_cover_layout' ),
				'posts_per_page' => rodller_get_option( 'page_cover_per_page_number' ),
				'order'          => rodller_get_option( 'page_cover_order_by' ),
				'sort'           => rodller_get_option( 'page_cover_order' ),
				'manual'         => rodller_get_option( 'page_cover_manual_order' ),
				'categories'     => rodller_get_option( 'page_cover_category' ),
				'tagged'         => rodller_get_option( 'page_cover_tag' ),
				'format'         => rodller_get_option( 'page_cover_format' ),
				'time_diff'      => rodller_get_option( 'page_cover_time_diff' ),
			);
		}
		$cover_options = rodller_parse_args( $options, $page_options );
		
		return $cover_options['cover'];
	}
endif;

/**
 * Get cover query by cover options
 *
 * @filter rodller_modify_page_cover_query_args
 * @return WP_Query Cover Posts
 * @since 1.0
 */
if ( ! function_exists( 'rodller_get_post_cover_query' ) ):
	function rodller_get_page_cover_query( $cover_options ) {
		$args = array(
			'ignore_sticky_posts' => 1,
		);

		if ( ! empty( $cover_options['manual'][0] ) ) {
			
			$args['orderby']   = 'post__in';
			$args['post__in']  = explode( ',', $cover_options['manual'] );
			$args['post_type'] = array_keys( get_post_types( array( 'public' => true ) ) ); //support all existing public post types
			
		} else {
			
			$args['post_type'] = 'post';
			
			$args['orderby'] = $cover_options['order'];
			$args['order']   = $cover_options['sort'];
			
			$args['posts_per_page'] = absint( $cover_options['posts_per_page'] );
			
			if ( $args['orderby'] == 'title' ) {
				$args['order'] = 'ASC';
			}
			
			if ( ! empty( $cover_options['time'] ) ) {
				$args['date_query'] = array( 'after' => date( 'Y-m-d', rodller_calculate_time_diff( $cover_options['time'] ) ) );
			}
			
			if ( ! empty( $cover_options['categories'] ) ) {
				$args['category__in'] = $cover_options['categories'];
			}
			
			if ( ! empty( $cover_options['tagged'] ) ) {
				$args['tag_slug__in'] = $cover_options['tagged'];
			}
			
			if ( ! empty( $cover_options['format'] ) && $cover_options['format'] !== 'all' ) {
				
				if ( $cover_options['format'] == 'standard' ) {
					
					$terms   = array();
					$formats = get_theme_support( 'post-formats' );
					if ( ! empty( $formats ) && is_array( $formats[0] ) ) {
						foreach ( $formats[0] as $format ) {
							$terms[] = 'post-format-' . $format;
						}
					}
					$operator = 'NOT IN';
					
				} else {
					$terms    = array( 'post-format-' . $cover_options['format'] );
					$operator = 'IN';
				}
				
				$args['tax_query'] = array(
					array(
						'taxonomy' => 'post_format',
						'field'    => 'slug',
						'terms'    => $terms,
						'operator' => $operator,
					),
				);
			}
		}
		
		$args = apply_filters( 'rodller_modify_page_cover_query_args', $args );
		
		return new WP_Query( $args );
	}
endif;

/**
 * Get category default cover options
 * This will work only if category cover layout is set to inherit
 *
 * @return array Category Cover options
 * @since 1.0
 */
if ( ! function_exists( 'rodller_get_category_cover_options' ) ):
	function rodller_get_category_cover_options( $id ) {
		$options          = array();
		$category_options = rodller_get_category_metadata( $id );
		if ( $category_options['cover']['layout'] === 'inherit' ) {
			$options['cover'] = array(
				'layout'         => rodller_get_option( 'category_cover_layout' ),
				'posts_per_page' => rodller_get_option( 'category_cover_per_page_number' ),
				'order'          => rodller_get_option( 'category_cover_order_by' ),
				'sort'           => rodller_get_option( 'category_cover_order' ),
			);
		}
		$cover_options = rodller_parse_args( $options, $category_options );
		
		$cover_options = apply_filters( 'rodller_modify_category_cover_options', $cover_options );
		
		return $cover_options['cover'];
	}
endif;

/**
 * Get cover query by cover options
 *
 * @filter rodller_modify_category_cover_query_args
 * @return WP_Query category cover query
 * @since 1.0
 */
if ( ! function_exists( 'rodller_get_category_cover_query' ) ):
	function rodller_get_category_cover_query( $cover_options, $id ) {
		
		$args = array(
			'ignore_sticky_posts' => 1,
			'category__in'        => $id,
			'post_type'           => 'post',
		);
		
		$args['orderby']        = $cover_options['order'];
		$args['order']          = $cover_options['sort'];
		$args['posts_per_page'] = absint( $cover_options['posts_per_page'] );
		
		if ( $args['orderby'] == 'title' ) {
			$args['order'] = 'ASC';
		}
		
		$args = apply_filters( 'rodller_modify_category_cover_query_args', $args );
		
		return new WP_Query( $args );
	}
endif;

/**
 * Get post excerpt
 *
 * Function outputs post excerpt for specific layout
 *
 * @param limit   Number of characters to limit excerpt
 *
 * @return string HTML output of category links
 * @since  1.0
 */
if ( ! function_exists( 'rodller_get_excerpt' ) ):
	function rodller_get_excerpt( $limit = 150 ) {
		
		$manual_excerpt = false;
		
		global $post;
		
		if ( has_excerpt() ) {
			$content        = get_the_excerpt();
			$manual_excerpt = true;
		} else {
			$text    = get_the_content();
			$text    = strip_shortcodes( $text );
			$text    = apply_filters( 'the_content', $text );
			$content = str_replace( ']]>', ']]&gt;', $text );
		}
		
		if ( ! empty( $content ) ) {
			if ( ! empty( $limit ) || ! $manual_excerpt ) {
				$more    = '...';
				$content = wp_strip_all_tags( $content );
				$content = preg_replace( '/\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i', '', $content );
				$content = rodller_trim_chars( $content, $limit, $more );
			}
			
			return wp_kses_post( wpautop( $content ) );
		}
		
		return '';
		
	}
endif;


/**
 * Trim chars of a string
 *
 * @param string $string Content to trim
 * @param int $limit Number of characters to limit
 * @param string $more Chars to append after trimed string
 *
 * @return string Trimmed part of the string
 * @since  1.0
 */
if ( ! function_exists( 'rodller_trim_chars' ) ):
	function rodller_trim_chars( $string, $limit, $more = '...' ) {
		
		if ( ! empty( $limit ) ) {
			
			$text = trim( preg_replace( "/[\n\r\t ]+/", ' ', $string ), ' ' );
			preg_match_all( '/./u', $text, $chars );
			$chars = $chars[0];
			$count = count( $chars );
			
			if ( $count > $limit ) {
				
				$chars = array_slice( $chars, 0, $limit );
				
				for ( $i = ( $limit - 1 ); $i >= 0; $i -- ) {
					if ( in_array( $chars[ $i ], array( '.', ' ', '-', '?', '!' ) ) ) {
						break;
					}
				}
				
				$chars  = array_slice( $chars, 0, $i );
				$string = implode( '', $chars );
				$string = rtrim( $string, ".,-?!" );
				$string .= $more;
			}
			
		}
		
		return $string;
	}
endif;

/**
 * Get post metadata formatted with html for frontend
 *
 * @filter rodller_modify_post_metadata
 * @return string metadata html
 * @since 1.0
 */
if ( ! function_exists( 'rodller_get_post_metadata' ) ):
	function rodller_get_post_metadata( $layout, $force_metadata = array(), $hard_force = false ) {
		$meta_data = array();
		
		if ( $layout !== false ) {
			$meta_data = rodller_get_option( $layout . '_metadata' );
			
			if ( empty( $meta_data ) || ! is_array( $meta_data ) ) {
				return '';
			}
			
		}
		
		if ( ! empty( $force_metadata ) ) {
			if ( $hard_force ) {
				$meta_data = $force_metadata;
			} else {
				$meta_data = array_intersect( $force_metadata, $meta_data );
			}
		}
		
		$meta_data = apply_filters( 'rodller_modify_post_metadata', $meta_data );
		
		$output = '<div class="rodller-metadata">';
		
		foreach ( $meta_data as $mkey ) {
			
			$meta = '';
			
			switch ( $mkey ) {
				
				case 'date':
					$meta = '<span class="updated"><i class="ion-ios-calendar-outline"></i>' . get_the_date() . '</span>';
					break;
				
				case 'author':
					
					$author_id = get_post_field( 'post_author', get_the_ID() );
					$meta      = '<span class="vcard author"><span class="fn"><i class="ion-ios-person-outline"></i><a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID', $author_id ) ) ) . '">' . get_the_author_meta( 'display_name', $author_id ) . '</a></span></span>';
					
					break;
				
				case 'comments':
					if ( comments_open() || get_comments_number() ) {
						$meta = '<i class="ion-ios-chatboxes-outline"></i>' . get_comments_number();
					} else {
						$meta = '';
					}
					break;
				
				case 'addcomment':
					if ( comments_open() || get_comments_number() ) {
						$meta = '<i class="ion-ios-chatbubble-outline"></i><a href="' . get_the_permalink() . '#comment">' . __( 'Add Comment', 'rodller' ) . '</a>';
					} else {
						$meta = '';
					}
					break;
				
				case 'readtime':
					$meta = '<i class="ion-ios-clock-outline"></i>' . rodller_get_reading_time( get_post_field( 'post_content' ) );
					break;
				
				default:
					break;
			}
			
			if ( ! empty( $meta ) ) {
				$output .= '<div class="rodller-metadata-item rodller-metadata-' . $mkey . '">' . $meta . '</div>';
			}
		}
		
		$output .= '</div>';
		
		return wp_kses_post( $output );
	}
endif;

/**
 * Calculate average reading time of post
 *
 * @return string html reading time calculated
 * @since 1.0
 */
if ( ! function_exists( 'rodller_get_reading_time' ) ):
	function rodller_get_reading_time( $content ) {
		$word_count   = str_word_count( strip_tags( $content ) );
		$reading_time = ceil( $word_count / 200 );
		
		return $reading_time . ' ' . __( 'min', 'rodller' );
	}
endif;

/**
 * Get all rendered categories of one post
 *
 * @return string categories html
 * @since 1.0
 */
if ( ! function_exists( 'rodller_get_post_categories' ) ):
	function rodller_get_post_categories( $id = null ) {
		if ( empty( $id ) ) {
			$id = get_the_ID();
		}
		
		$output     = '<div class="rodller-categories">';
		$categories = get_the_terms( $id, 'category' );
		
		if ( empty( $categories ) ) {
			return '';
		}
		
		foreach ( $categories as $category ) {
			$output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" class="rodller-category rodller-pill rodller-cat-' . esc_attr( $category->term_id ) . '">' . $category->name . '</a>';
		}
		
		$output .= '</div>';
		
		return wp_kses_post( $output );
	}
endif;

/**
 * Get single post format icon
 *
 * @return string Format icon html
 * @since 1.0
 */
if ( ! function_exists( 'rodller_get_post_format_icon' ) ):
	function rodller_get_post_format_icon( $layout, $id = null ) {
		if ( empty( $id ) ) {
			$id = get_the_ID();
		}
		
		if ( is_sticky( $id ) ) {
			return wp_kses_post( '<span class="rodller-format-icon rodller-sticky-post"><i class="ion-ios-star"></i></span>' );
		}
		
		if ( rodller_get_option( 'format_icon_layout_' . $layout ) ) {
			
			$format = get_post_format( $id );
			
			if ( empty( $format ) ) {
				
				$format = 'standard';
			}
			
			$icons = array(
				'video'    => 'ion-play',
				'audio'    => 'ion-volume-high',
				'gallery'  => 'ion-images',
				'standard' => 'ion-ios-paper',
			);
			
			//Allow plugins or child themes to modify icons
			$icons = apply_filters( 'rodller_modify_post_format_icon', $icons );
			
			if ( $format && array_key_exists( $format, $icons ) ) {
				return wp_kses_post( '<span class="rodller-format-icon"><i class="' . esc_attr( $icons[ $format ] ) . '"></i></span>' );
			}
		}
		
		return '';
	}
endif;


/**
 * Get author social links
 *
 * @param int $author_id ID of an author/user
 *
 * @return string HTML output of social links
 * @since  1.0
 */

if ( ! function_exists( 'rodller_get_author_links' ) ):
	function rodller_get_author_links( $author_id ) {
		
		$output = '';
		
		if ( is_singular() ) {
			$output .= '<a href="' . esc_url( get_author_posts_url( $author_id, get_the_author_meta( 'user_nicename', $author_id ) ) ) . '" class="rodller-button">' . __( 'View all', 'rodller' ) . '</a>';
		}
		
		$url = get_the_author_meta( 'url', $author_id );
		if ( ! empty( $url ) ) {
			$output .= '<a href="' . esc_url( $url ) . '" target="_blank" class="rodller-button"><i class="ion-earth"></i></a>';
		}
		
		return wp_kses_post( $output );
	}
endif;

/**
 * Get related posts for particular post
 *
 * @param int $post_id
 *
 * @return object WP_Query
 * @since  1.0
 */
if ( ! function_exists( 'rodller_get_related_posts' ) ):
	function rodller_get_related_posts( $post_id = false ) {
		
		if ( empty( $post_id ) ) {
			$post_id = get_the_ID();
		}
		switch ( rodller_get_option( 'single_related_using' ) ) {
			case 'crp':
				if ( ! rodller_is_crp_active() ) {
					return false;
					break;
				}
				
				$post_ids = wp_list_pluck( get_crp_posts_id(), 'ID' );
				break;
			case 'wrpr':
				if ( ! rodller_is_wrpr_active() ) {
					return false;
					break;
				}
				
				$posts          = wp_rp_fetch_posts_and_title();
				$selected_posts = wp_rp_get_selected_posts();
				
				$post_ids = wp_list_pluck( $posts['posts'], 'ID' );
				
				if ( ! empty( $selected_posts ) ) {
					$wrpr_options = wp_rp_get_options();
					$limit        = absint( $wrpr_options['max_related_posts'] );
					
					$selected_posts    = wp_list_pluck( $selected_posts, 'ID' );
					$selected_post_ids = array();
					
					foreach ( $selected_posts as $id ) {
						if ( ! empty( $id ) ) {
							$selected_post_ids[] = preg_replace( '/in_/', '', $id );
						}
					}
					$merge_ids = array_merge( $selected_post_ids, $post_ids );
					$post_ids  = array_slice( $merge_ids, 0, $limit );
				}
				
				break;
			case 'jetpack':
				if ( ! rodller_is_jetpack_active() || ! class_exists( 'Jetpack_RelatedPosts' ) ) {
					return false;
					break;
				}
				
				$jetpack  = Jetpack_RelatedPosts::init();
				$post_ids = wp_list_pluck( $jetpack->get_for_post_id( $post_id, array() ), 'id' );
				break;
			case 'default':
			default:
				return rodller_generate_default_related_query( $post_id );
				break;
		}
		
		if ( empty( $post_ids ) ) {
			return false;
		}
		
		return new WP_Query( array( 'post__in' => $post_ids ) );
	}
endif;

/**
 * Woocommerce  Cart Elements
 *
 * @return bool
 * @since  1.6
 */
if ( ! function_exists( 'rodller_woocommerce_cart_elements' ) ):
	function rodller_woocommerce_cart_elements() {
		if ( ! rodller_is_woocommerce_active() ) {
			return;
		}
		$elements                   = array();
		$elements['cart_url']       = wc_get_cart_url();
		$elements['products_count'] = WC()->cart->get_cart_contents_count();
		
		return $elements;
	}
endif;