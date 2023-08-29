<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Debug (log) function
 *
 * Outputs any content into log file in theme root directory
 *
 * @param mixed $mixed Content to output
 *
 * @since  1.0
 */
if ( ! function_exists( 'rodller_log' ) ):
	function rodller_log( $mixed ) {

		WP_Filesystem();

		global $wp_filesystem;

		if ( is_array( $mixed ) ) {
			$mixed = print_r( $mixed, 1 );
		} elseif ( is_object( $mixed ) ) {
			ob_start();
			var_dump( $mixed );
			$mixed = ob_get_clean();
		}

		$old = $wp_filesystem->get_contents( get_parent_theme_file_path( '/log' ) );
		$wp_filesystem->put_contents( get_parent_theme_file_path( '/log' ), $old . $mixed . PHP_EOL, FS_CHMOD_FILE );
	}
endif;

/**
 * Parse args ( merge arrays )
 *
 * Similar to wp_parse_args() but extended to also merge multidimensional arrays
 *
 * @param array $a - set of values to merge
 * @param array $b - set of default values
 *
 * @return array Merged set of elements
 * @since 1.0
 */
if ( ! function_exists( 'rodller_parse_args' ) ):
	function rodller_parse_args( &$a, $b ) {
		$a = (array) $a;
		$b = (array) $b;
		$r = $b;
		foreach ( $a as $k => &$v ) {
			if ( is_array( $v ) && isset( $r[ $k ] ) ) {
				$r[ $k ] = rodller_parse_args( $v, $r[ $k ] );
			} else {
				$r[ $k ] = $v;
			}
		}

		return $r;
	}
endif;

/**
 * Getting single option from theme_mods.
 * On first use of this function global $theme_mods is created, so we don't need to ask database for getting each
 * option.
 *
 * @filter rodller_modify_{setting name}
 * @since  1.0
 */
if ( ! function_exists( 'rodller_get_option' ) ) :
	function rodller_get_option( $setting ) {

		$setting_id = 'rodller_' . $setting;
		$default    = rodller_get_default_option( $setting );

		// Get theme mod for customizer because of live preview
		if ( is_customize_preview() ) {
			return get_theme_mod( $setting_id, $default );
		}

		// Because of optimization, every setting will be stored here and accessible everywhere in the theme
		global $theme_mods;

		// Setting up global $theme_mods
		if ( ( ! isset( $theme_mods ) && empty( $theme_mods ) ) ) {
			$theme_mods = get_theme_mods();
		}

		$value = $default;
		if ( isset( $theme_mods[ $setting_id ] ) ) {
			$value = $theme_mods[ $setting_id ];
		}

		return apply_filters( 'rodller_modify_' . $setting_id, $value );
	}
endif;

/**
 * Getting template parts from array, path is used to define template slug, keys in array are actual file names.
 *
 * @link  https://developer.wordpress.org/reference/functions/get_template_part/
 * @since 1.0
 */
if ( ! function_exists( 'rodller_get_template_parts_from_array' ) ) :
	function rodller_get_template_parts_from_array( $path, $option, $default = false, $force_data = false ) {
		$options_array = ( $force_data ) ? $force_data : rodller_get_option( $option, $default );
		if ( $options_array ) {
			foreach ( $options_array as $options_item ) {
				get_template_part( $path . $options_item );
			}
		}
	}
endif;

/**
 * Get all registered sidebars including inherit and none option
 *
 * @filter rodller_modify_sidebar_options
 * @since  1.0
 */
if ( ! function_exists( 'rodller_get_registered_sidebars' ) ) :
	function rodller_get_registered_sidebars( $ignore_inherit = false ) {

		if ( ! $ignore_inherit ) {
			$sidebars = array( 'inherit' => __( 'Inherit', 'rodller' ) );
		}

		$sidebars['none'] = esc_html__( 'None', 'rodller' );

		global $wp_registered_sidebars;

		if ( ! empty( $wp_registered_sidebars ) ) {

			foreach ( $wp_registered_sidebars as $sidebar ) {
				$sidebars[ $sidebar['id'] ] = $sidebar['name'];
			}

		}

		//Get sidebars from wp_options if global var is not loaded yet
		$fallback_sidebars = get_option( 'rodller_registered_sidebars' );
		if ( ! empty( $fallback_sidebars ) ) {
			foreach ( $fallback_sidebars as $sidebar ) {
				if ( ! array_key_exists( $sidebar['id'], $sidebars ) ) {
					$sidebars[ $sidebar['id'] ] = $sidebar['name'];
				}
			}
		}

		//Check for theme additional sidebars
		$custom_sidebars = rodller_get_option( 'sidebars' );
		if ( $custom_sidebars ) {
			foreach ( $custom_sidebars as $custom_sidebar ) {
				if ( empty( $custom_sidebar['name'] ) ) {
					continue;
				}
				$sidebars[ sanitize_title( $custom_sidebar['name'] ) ] = $custom_sidebar['name'];
			}
		}

		//Do not display footer sidebars for selection
		$footer_columns = rodller_get_option( 'footer_columns' );
		for ( $i = 1; $i <= intval( $footer_columns ); $i++ ) {
			unset( $sidebars[ 'rodller-footer-column-sidebar-' . $i ] );
		}

		$sidebars = apply_filters( 'rodller_modify_sidebar_options', $sidebars );

		return $sidebars;
	}
endif;

/**
 * Detect WordPress template. It checks which template is currently active
 *
 * @return string Template name
 * @since 1.0
 */
if ( ! function_exists( 'rodller_detect_template' ) ):
	function rodller_detect_template() {

		if ( is_single() ) {
			$template = 'post';
		} elseif ( is_home() ) {
			$template = 'archive';
		} elseif ( is_page() ) {
			$template = 'page';
		} elseif ( is_category() ) {
			$template = 'category';
		} elseif ( is_tag() ) {
			$template = 'tag';
		} elseif ( is_search() ) {
			$template = 'search';
		} elseif ( is_author() ) {
			$template = 'author';
		} elseif ( is_archive() ) {
			$template = 'archive';
		} else {
			$template = 'archive'; //default
		}

		return $template;
	}
endif;

/**
 * It gets how many posts will be shown on page for all kinds of templates
 *
 * @param $template
 *
 * @return int|null
 * @since 1.0
 */
if ( ! function_exists( 'rodller_get_template_post_per_page' ) ):
	function rodller_get_template_post_per_page( $template ) {

		if ( rodller_get_option( $template . '_posts_per_page' ) === 'custom' ) {
			$per_page_num = rodller_get_option( $template . '_posts_per_page_number' );
			if ( ! empty( $per_page_num ) ) {
				return intval( $per_page_num );
			}
		}

		return intval( get_option( 'posts_per_page' ) );
	}
endif;

/**
 * Get single post/page metadata
 *
 * @filter rodller_modify_metadata
 * @since  1.0
 */
if ( ! function_exists( 'rodller_get_metadata' ) ):
	function rodller_get_metadata( $post_id = false, $field = false ) {

		global $rodller_single_metadata;

		if ( empty( $post_id ) ) {
			$post_id = get_the_ID();
		}

		if ( ! empty( $rodller_single_metadata[ $post_id ] ) ) {
			if ( $field && ! empty( $rodller_single_metadata[ $post_id ][ $field ] ) ) {
				return $rodller_single_metadata[ $post_id ][ $field ];
			}

			return $rodller_single_metadata[ $post_id ];
		}

		$defaults = array(
			'sidebar_position' => 'inherit',
			'sidebar'          => 'inherit',
			'sticky_sidebar'   => 'inherit',
			'layout'           => 'inherit',
			'cover'            => array(
				'layout'         => 'inherit',
				'posts_per_page' => 3,
				'order'          => 'date',
				'sort'           => 'desc',
				'manual'         => '',
				'categories'     => array(),
				'tagged'         => '',
				'format'         => 'all',
				'time_diff'      => '0',
			),
			'hide_title'       => 0,
		);

		$meta = get_post_meta( $post_id, '_rodller_meta', true );
		$meta = rodller_parse_args( $meta, $defaults );

		if ( $field ) {
			if ( isset( $meta[ $field ] ) ) {
				return $meta[ $field ];
			} else {
				return false;
			}
		}

		$rodller_single_metadata[ $post_id ] = $meta;

		return apply_filters( 'rodller_modify_metadata', $meta );
	}
endif;

/**
 * Get category metadata
 *
 * @filter rodller_modify_category_metadata
 * @since  1.0
 */
if ( ! function_exists( 'rodller_get_category_metadata' ) ):
	function rodller_get_category_metadata( $cat_id = false, $field = false ) {

		$defaults = array(
			'cover'            => array(
				'layout'         => 'inherit',
				'posts_per_page' => 3,
				'order'          => 'date',
				'sort'           => 'desc',
				'manual'         => '',
			),
			'display_settings' => 'inherit',
			'image'            => '',
			'sidebar_position' => rodller_get_option( 'category_sidebar_position' ),
			'sidebar'          => rodller_get_option( 'category_sidebar' ),
			'sticky_sidebar'   => rodller_get_option( 'category_sticky_sidebar' ),
			'layout'           => rodller_get_option( 'category_layout' ),
			'ppp'              => rodller_get_template_post_per_page( 'category' ),
			'pagination'       => rodller_get_option( 'category_pagination' ),
		);

		if ( $cat_id ) {
			$meta = get_term_meta( $cat_id, '_rodller_meta', true );
			$meta = rodller_parse_args( $meta, $defaults );
		} else {
			$meta = $defaults;
		}

		if ( $field ) {
			if ( isset( $meta[ $field ] ) ) {
				return $meta[ $field ];
			} else {
				return false;
			}
		}

		$meta = apply_filters( 'rodller_modify_category_metadata', $meta );

		return $meta;
	}
endif;

/**
 * Get all image sizes, basically used for optimization only
 *
 * @filter rodller_modify_image_sizes
 * @since  1.0
 */
if ( ! function_exists( 'rodller_get_image_sizes' ) ) :
	function rodller_get_image_sizes() {
		$sizes                     = array();
		$sizes['layout-a']         = array(
			'title' => __( 'Layout A', 'rodller' ),
			'w'     => 360,
			'h'     => 9999,
			'crop'  => false,
		);
		$sizes['layout-b']         = array(
			'title' => __( 'Layout B', 'rodller' ),
			'w'     => 360,
			'h'     => 300,
			'crop'  => true,
		);
		$sizes['layout-c']         = array(
			'title' => __( 'Layout C', 'rodller' ),
			'w'     => 1170,
			'h'     => 635,
			'crop'  => true,
		);
		$sizes['layout-c-sidebar'] = array(
			'title' => __( 'Layout C Sidebar', 'rodller' ),
			'w'     => 750,
			'h'     => 435,
			'crop'  => true,
		);
		$sizes['layout-d']         = array(
			'title' => __( 'Layout D', 'rodller' ),
			'w'     => 300,
			'h'     => 250,
			'crop'  => true,
		);
		$sizes['cover']            = array(
			'title' => __( 'Cover', 'rodller' ),
			'w'     => 1920,
			'h'     => 1000,
			'crop'  => true,
		);
		$sizes['single']           = array(
			'title' => __( 'Single', 'rodller' ),
			'w'     => 750,
			'h'     => 99999,
			'crop'  => false,
		);

		return apply_filters( 'rodller_modify_image_sizes', $sizes );
	}
endif;

/**
 * Compress CSS Code
 *
 * @param string $code Uncompressed css code
 *
 * @return string Compressed css code
 * @since  1.0
 */

if ( ! function_exists( 'rodller_compress_css_code' ) ) :
	function rodller_compress_css_code( $code ) {

		// Remove Comments
		$code = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $code );

		// Remove tabs, spaces, newlines, etc.
		$code = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $code );

		return $code;
	}
endif;


/**
 * Generate fonts link
 *
 * Function creates font link from fonts selected in theme options
 *
 * @return string
 * @since  1.0
 */

if ( ! function_exists( 'rodller_generate_fonts_link' ) ):
	function rodller_generate_fonts_link() {

		$fonts    = array();
		$fonts[]  = rodller_get_option( 'navigation_font' );
		$fonts[]  = rodller_get_option( 'body_font' );
		$fonts[]  = rodller_get_option( 'headings_fonts' );
		$unique   = array(); //do not add same font links
		$native   = rodller_get_native_fonts();
		$protocol = is_ssl() ? 'https://' : 'http://';
		$link     = array();

		foreach ( $fonts as $font ) {
			if ( empty( $font ) ) {
				continue;
			}

			if ( ! in_array( $font['font-family'], $native ) ) {
				$temp = array();
				if ( isset( $font['font-style'] ) ) {
					$temp['font-style'] = $font['font-style'];
				}
				if ( isset( $font['subsets'] ) ) {
					$temp['subsets'] = $font['subsets'];
				}
				if ( isset( $font['font-weight'] ) ) {
					$temp['font-weight'] = $font['font-weight'];
				}
				$unique[ $font['font-family'] ][] = $temp;
			}
		}

		$subsets = array( 'latin' ); //latin as default

		foreach ( $unique as $family => $items ) {

			$link[ $family ] = $family;

			$weight = array( '400', '800' );

			foreach ( $items as $item ) {

				//Check weight and style
				if ( isset( $item['font-weight'] ) && ! empty( $item['font-weight'] ) ) {
					$temp = $item['font-weight'];
					if ( isset( $item['font-style'] ) && empty( $item['font-style'] ) ) {
						$temp .= $item['font-style'];
					}

					if ( ! in_array( $temp, $weight ) ) {
						$weight[] = $temp;
					}
				}

				//Check subsets
				if ( isset( $item['subsets'] ) && ! empty( $item['subsets'] ) ) {
					if ( ! in_array( $item['subsets'], $subsets ) ) {
						$subsets = array_unique( array_merge( $subsets, $item['subsets'] ) );
					}
				}
			}

			$link[ $family ] .= ':' . implode( ",", $weight );
		}

		if ( ! empty( $link ) ) {

			$query_args = array(
				'family' => implode( '|', $link ),
				'subset' => implode( ',', $subsets ),
			);


			$fonts_url = add_query_arg( $query_args, $protocol . 'fonts.googleapis.com/css' );

			return esc_url( $fonts_url );
		}

		return '';

	}
endif;


/**
 * Get native fonts
 *
 *
 * @return array List of native fonts
 * @since  1.0
 */
if ( ! function_exists( 'rodller_get_native_fonts' ) ):
	function rodller_get_native_fonts() {

		$fonts = array(
			"Arial, Helvetica, sans-serif",
			"'Arial Black', Gadget, sans-serif",
			"'Bookman Old Style', serif",
			"'Comic Sans MS', cursive",
			"Courier, monospace",
			"Garamond, serif",
			"Georgia, serif",
			"Impact, Charcoal, sans-serif",
			"'Lucida Console', Monaco, monospace",
			"'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
			"'MS Sans Serif', Geneva, sans-serif",
			"'MS Serif', 'New York', sans-serif",
			"'Palatino Linotype', 'Book Antiqua', Palatino, serif",
			"Tahoma,Geneva, sans-serif",
			"'Times New Roman', Times,serif",
			"'Trebuchet MS', Helvetica, sans-serif",
			"Verdana, Geneva, sans-serif",
		);

		return $fonts;
	}
endif;

/**
 * Additional css styling
 *
 *
 * @return string compressed css and ready to add inline
 * @since  1.0
 */
if ( ! function_exists( 'rodller_append_css_options' ) ):
	function rodller_append_css_options() {
		$css          = '';
		$placeholders = array( '::placeholder', ':-ms-input-placeholder', '::-ms-input-placeholder' );

		$heading_font = rodller_get_option( 'headings_fonts' );
		if ( ! empty( $heading_font['color'] ) ) {
			$css .= '.wp-block-quote:not(.is-large):before{background-color: ' . esc_attr( $heading_font['color'] ) . '}';
			$css .= '.rodller-entry-content blockquote{border-color: ' . esc_attr( $heading_font['color'] ) . '}';
			$css .= '.rodller-entry-content .wp-block-quote cite{color:  ' . $heading_font['color'] . ';}';
			$css .= '.wp-block-pullquote{border-top: 1px solid ' . $heading_font['color'] . '; border-bottom: 1px solid ' . $heading_font['color'] . ';}';
			$css .= '.wp-block-button__link:not(.has-background){background-color:  ' . $heading_font['color'] . ';}';
			$css .= '.comments-area{border-top-color:  ' . $heading_font['color'] . ';}';

			$css .= '.rodller-format-icon{color:  ' . $heading_font['color'] . ';}';
			$css .= '.comment-list .bypostauthor .comment-author:before{background-color:  ' . $heading_font['color'] . ';}';

			$css .= '.wp-block-button__link:not(.has-background):active, .wp-block-button__link:not(.has-background):focus, .wp-block-button__link:not(.has-background):hover{ background-color:  ' . rodller_hex_to_rgba( $heading_font['color'], 0.8 ) . '; }';

			$css .= '.woocommerce div.product .woocommerce-tabs ul.tabs li.active{color:  ' . $heading_font['color'] . '; border-bottom: 1px solid ' . $heading_font['color'] . ';}';

			$css .= '.woocommerce-info{border-top-color:  ' . $heading_font['color'] . ';}';
			$css .= '.woocommerce-info::before{color:  ' . $heading_font['color'] . ';}';
		}

		$body_font = rodller_get_option( 'body_font' );
		if ( ! empty( $body_font['color'] ) ) {
			$css .= '.widget .rodller-searchform .rodller-search-input-wrapper input[type=text] {border-color: ' . $body_font['color'] . '}';
			$css .= '.widget .rodller-searchform .rodller-search-input-wrapper input[type=text]::placeholder {border-color: ' . $body_font['color'] . '}';
			$css .= '.widget .rodller-searchform .rodller-searchsubmit {color: ' . $body_font['color'] . '}';
			$css .= '.widget .rodller-searchform .rodller-searchsubmit {color: ' . $body_font['color'] . '}';
			$css .= '.rodller-posts-widget article .rodller-widget-header .rodller-metadata .rodller-metadata-item {color: ' . $body_font['color'] . '}';

			foreach ( $placeholders as $placeholder ) {
				$css .= 'input' . $placeholder . '{color: ' . $body_font['color'] . '}';
				$css .= 'textarea' . $placeholder . '{color: ' . $body_font['color'] . '}';
			}

			$box_shadow_prefixes = array( '-webkit', '-khtml', '-moz', '-ms', '-o' );
			$css                 .= 'button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover, .rodller-button:hover, .rodller-load-more > a:hover, html .woocommerce #respond input#submit:hover, html .woocommerce a.button:hover, html .woocommerce button.button:hover, html .woocommerce input.button:hover{';
			foreach ( $box_shadow_prefixes as $box_shadow_prefix ) {
				$css .= '' . $box_shadow_prefix . '-box-shadow: 0 0 7px ' . rodller_hex_to_rgba( $body_font['color'], 0.3 ) . ';';
			}
			$css .= '}';

			$css .= '.price del .amount{color: ' . $body_font['color'] . '}';

		}

		if ( ! empty( $heading_font['font-family'] ) && ! empty( $heading_font['color'] ) ) {
			$css .= '.has-drop-cap:first-letter{font-family: ' . $heading_font['font-family'] . '; color: ' . $heading_font['color'] . '; }';
		}

		$footer_text_color = rodller_get_option( 'footer_color' );
		if ( ! empty( $footer_text_color ) ) {
			foreach ( $placeholders as $placeholder ) {
				$css .= '#rodller-main-footer input' . $placeholder . '{color: ' . $footer_text_color . '}';
				$css .= '#rodller-main-footer textarea' . $placeholder . '{color: ' . $footer_text_color . '}';
			}
		}

		$accent_font_color = rodller_get_option( 'accent_font_color' );
		if ( ! empty( $accent_font_color ) ) {
			$css .= '.comment-list .reply:before{color: ' . $accent_font_color . '}';
			$css .= '.woocommerce-message{border-top-color: ' . $accent_font_color . '}';
			$css .= '.woocommerce-message::before{color: ' . $accent_font_color . '}';
		}

		$main__header_area_hover_accent_color = rodller_get_option( 'main_area_hover_accent_color' );
		if ( ! empty( $main__header_area_hover_accent_color ) ) {
			$css .= '.rodller-cart-icon .rodller-cart-count{ -webkit-box-shadow: 0 0 0 0 #f0f0f0, 0 0 0 0 ' . $main__header_area_hover_accent_color . '; box-shadow: 0 0 0 0 #f0f0f0, 0 0 0 0 ' . $main__header_area_hover_accent_color . ';}';
		}

		$odd_widget_background_color = rodller_get_option( 'odd_widget_background_color' );
		if ( ! empty( $odd_widget_background_color ) ) {
			$css .= '#rodller-sidebar .widget.rodller-widget-odd{ background-color: ' . $odd_widget_background_color . ';}';
		}

		$even_widget_background_color = rodller_get_option( 'even_widget_background_color' );
		if ( ! empty( $even_widget_background_color ) ) {
			$css .= '#rodller-sidebar .widget.rodller-widget-even{ background-color: ' . $even_widget_background_color . ';}';
		}


		return rodller_compress_css_code( $css );
	}
endif;

/**
 * Hex to rgba
 *
 * Convert hexadecimal color to rgba
 *
 * @param string $color   Hexadecimal color value
 * @param float  $opacity Opacity value
 *
 * @return string RGBA color value
 * @since  1.0
 */

if ( ! function_exists( 'rodller_hex_to_rgba' ) ):
	function rodller_hex_to_rgba( $color, $opacity = false, $raw = false, $array = false ) {
		$default = 'rgb(0,0,0)';

		//Return default if no color provided
		if ( empty( $color ) ) {
			return $default;
		}

		//Sanitize $color if "#" is provided
		if ( $color[0] == '#' ) {
			$color = substr( $color, 1 );
		}

		//Check if color has 6 or 3 characters and get values
		if ( strlen( $color ) == 6 ) {
			$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
		} elseif ( strlen( $color ) == 3 ) {
			$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
		} else {
			return $default;
		}

		//Convert hexadec to rgb
		$rgb = array_map( 'hexdec', $hex );

		if ( $array ) {
			return $rgb;
		}

		if ( $raw ) {
			return $rgb;
		}

		//Check if opacity is set(rgba or rgb)
		if ( $opacity !== false ) {
			if ( abs( $opacity ) > 1 ) {
				$opacity = 1.0;
			}
			$output = 'rgba(' . implode( ",", $rgb ) . ',' . $opacity . ')';
		} else {
			$output = 'rgb(' . implode( ",", $rgb ) . ')';
		}

		//Return rgb(a) color string
		return $output;
	}
endif;


/**
 * Generate related posts query
 *
 * Depending on post ID generate related posts using theme options
 *
 * @param int $post_id
 *
 * @return object WP_Query
 * @since  1.0
 */
if ( ! function_exists( 'rodller_generate_default_related_query' ) ):
	function rodller_generate_default_related_query( $post_id ) {

		if ( empty( $post_id ) ) {
			$post_id = get_the_ID();
		}

		$args['post_type'] = 'post';

		//Exclude current post from query
		$args['post__not_in'] = array( $post_id );

		//If previuos next posts active exclude them too
		if ( rodller_get_option( 'single_post_prevnext' ) ) {

			$prev = get_adjacent_post( true, '', false, 'category' );
			$next = get_adjacent_post( true, '', true, 'category' );

			if ( ! empty( $prev ) ) {
				$args['post__not_in'][] = $prev->ID;
			}

			if ( ! empty( $next ) ) {
				$args['post__not_in'][] = $next->ID;
			}
		}

		$num_posts = absint( rodller_get_option( 'related_limit' ) );

		if ( $num_posts > 100 ) {
			$num_posts = 100;
		}

		$args['posts_per_page'] = $num_posts;


		$args['orderby'] = rodller_get_option( 'related_order' );

		if ( $args['orderby'] == 'title' ) {
			$args['order'] = 'ASC';
		}

		if ( $time_diff = rodller_get_option( 'related_time' ) ) {
			$args['date_query'] = array( 'after' => date( 'Y-m-d', rodller_calculate_time_diff( $time_diff ) ) );
		}

		if ( $type = rodller_get_option( 'related_type' ) ) {

			switch ( $type ) {

				case 'cat':
					$cats     = get_the_category( $post_id );
					$cat_args = array();
					if ( ! empty( $cats ) ) {
						foreach ( $cats as $k => $cat ) {
							$cat_args[] = $cat->term_id;
						}
					}
					$args['category__in'] = $cat_args;
					break;

				case 'tag':
					$tags     = get_the_tags( $post_id );
					$tag_args = array();
					if ( ! empty( $tags ) ) {
						foreach ( $tags as $tag ) {
							$tag_args[] = $tag->term_id;
						}
					}
					$args['tag__in'] = $tag_args;
					break;

				case 'cat_and_tag':
					$cats     = get_the_category( $post_id );
					$cat_args = array();
					if ( ! empty( $cats ) ) {
						foreach ( $cats as $k => $cat ) {
							$cat_args[] = $cat->term_id;
						}
					}
					$tags     = get_the_tags( $post_id );
					$tag_args = array();
					if ( ! empty( $tags ) ) {
						foreach ( $tags as $tag ) {
							$tag_args[] = $tag->term_id;
						}
					}
					$args['tax_query'] = array(
						'relation' => 'AND',
						array(
							'taxonomy' => 'category',
							'field'    => 'id',
							'terms'    => $cat_args,
						),
						array(
							'taxonomy' => 'post_tag',
							'field'    => 'id',
							'terms'    => $tag_args,
						),
					);
					break;

				case 'cat_or_tag':
					$cats     = get_the_category( $post_id );
					$cat_args = array();
					if ( ! empty( $cats ) ) {
						foreach ( $cats as $k => $cat ) {
							$cat_args[] = $cat->term_id;
						}
					}
					$tags     = get_the_tags( $post_id );
					$tag_args = array();
					if ( ! empty( $tags ) ) {
						foreach ( $tags as $tag ) {
							$tag_args[] = $tag->term_id;
						}
					}
					$args['tax_query'] = array(
						'relation' => 'OR',
						array(
							'taxonomy' => 'category',
							'field'    => 'id',
							'terms'    => $cat_args,
						),
						array(
							'taxonomy' => 'post_tag',
							'field'    => 'id',
							'terms'    => $tag_args,
						),
					);
					break;

				case 'author':
					global $post;
					$author_id      = isset( $post->post_author ) ? $post->post_author : 0;
					$args['author'] = $author_id;
					break;

				case 'default':
					break;
			}
		}


		$related_query = new WP_Query( $args );

		return $related_query;
	}
endif;


/**
 * Get term slugs by term names for specific taxonomy
 *
 * @param string $names List of tag names separated by comma
 * @param string $tax   Taxonomy name
 *
 * @return array List of slugs
 * @since  1.0
 */

if ( ! function_exists( 'rodller_get_tax_term_slug_by_name' ) ):
	function rodller_get_tax_term_slug_by_name( $names, $tax = 'post_tag' ) {

		if ( empty( $names ) ) {
			return '';
		}

		$slugs = array();
		$names = explode( ",", $names );

		foreach ( $names as $name ) {
			$tag = get_term_by( 'name', trim( $name ), $tax );

			if ( ! empty( $tag ) && isset( $tag->slug ) ) {
				$slugs[] = $tag->slug;
			}
		}

		return $slugs;

	}
endif;

/**
 * Get term names by term slugs for specific taxonomy
 *
 * @param array  $slugs List of tag slugs
 * @param string $tax   Taxonomy name
 *
 * @return string List of names separrated by comma
 * @since  1.0
 */

if ( ! function_exists( 'rodller_get_tax_term_name_by_slug' ) ):
	function rodller_get_tax_term_name_by_slug( $slugs, $tax = 'post_tag' ) {

		if ( empty( $slugs ) ) {
			return '';
		}

		$names = array();

		foreach ( $slugs as $slug ) {
			$tag = get_term_by( 'slug', trim( $slug ), $tax );
			if ( ! empty( $tag ) && isset( $tag->name ) ) {
				$names[] = $tag->name;
			}
		}

		if ( ! empty( $names ) ) {
			$names = implode( ",", $names );
		} else {
			$names = '';
		}

		return $names;

	}
endif;
/**
 * Check if WooCommerce is active
 *
 * @return bool
 * @since  1.0
 */
if ( ! function_exists( 'rodller_is_woocommerce_active' ) ):
	function rodller_is_woocommerce_active() {
		if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			return true;
		}

		return false;
	}
endif;

/**
 * Check if Contextual Related Posts is active
 *
 * @return bool
 * @since  1.0
 */
if ( ! function_exists( 'rodller_is_crp_active' ) ):
	function rodller_is_crp_active() {
		if ( in_array( 'contextual-related-posts/contextual-related.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			return true;
		}

		return false;
	}
endif;

/**
 * Check if WordPress Related Posts is active
 *
 * @return bool
 * @since  1.0
 */
if ( ! function_exists( 'rodller_is_wrpr_active' ) ):
	function rodller_is_wrpr_active() {
		if ( in_array( 'wordpress-23-related-posts-plugin/wp_related_posts.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			return true;
		}

		return false;
	}
endif;

/**
 * Check if Jetpack is active
 *
 * @return bool
 * @since  1.0
 */
if ( ! function_exists( 'rodller_is_jetpack_active' ) ):
	function rodller_is_jetpack_active() {
		if ( in_array( 'jetpack/jetpack.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			return true;
		}

		return false;
	}
endif;


/**
 * Check if RTL mode is enabled
 *
 * @return bool
 * @since  1.0
 */

if ( ! function_exists( 'rodller_is_rtl' ) ):
	function rodller_is_rtl() {

		if ( rodller_get_option( 'rtl' ) ) {
			$rtl = true;
			//Check if current language is excluded from RTL
			$rtl_lang_skip = explode( ",", rodller_get_option( 'rtl_skip' ) );
			if ( ! empty( $rtl_lang_skip ) ) {
				$locale = get_locale();
				if ( in_array( $locale, $rtl_lang_skip ) ) {
					$rtl = false;
				}
			}
		} else {
			$rtl = false;
		}

		return $rtl;
	}
endif;

/**
 * Get footer columns
 *
 * @return bool
 * @since  1.0
 */

if(!function_exists('rodller_get_footer_columns')):
	function rodller_get_footer_columns(){
		$footer_columns = rodller_get_option('footer_columns');

		return explode('-', $footer_columns);
	}
endif;