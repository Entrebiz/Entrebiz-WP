<?php
/**
 * Defaults
 *
 * All default values are in this file
 */

/**
 * Get default option by passing option id or don't pass anything to function and get all options
 *
 * @param null $option
 *
 * @return array|mixed|null
 *
 * @since   1.0
 */
if ( ! function_exists( 'rodller_get_default_option' ) ):
	function rodller_get_default_option( $option = null ) {
		$defaults = array(
			/**
			 * Site Identity
			 */
			'display_title_tagline'                      => 1,
			'logo'                                       => '',
			'retina_logo'                                => '',
			'small_logo'                                 => '',
			'small_retina_logo'                          => '',
			'default_featured_image'                     => '',
			'logo_external_url'                          => '',
			'background_color'                           => '#ffffff',
			'rtl'                                        => 0,
			'rtl_skip'                                   => '',
			
			/**
			 * Header
			 */
			'top_bar'                                    => 0,
			'top_bar_background_color'                   => "#e869b0",
			'top_bar_color'                              => "#ffffff",
			'top_bar_accent_color'                       => "#ffffff",
			'top_bar_hover_accent_color'                 => "rgba(255, 255, 255, 0.61)",
			'top_bar_left_slot'                          => array(),
			'top_bar_middle_slot'                        => array(),
			'top_bar_right_slot'                         => array(),
			'header_layout'                              => 1,
			'main_area_height'                           => 80,
			'main_area_background_color'                 => "#ffffff",
			'main_area_background_image'                 => "",
			'main_area_background_repeat'                => "",
			'main_area_background_attachment'            => "",
			'main_area_background_position'              => "",
			'main_area_color'                            => "#E869B0",
			'main_area_accent_color'                     => "#80C5E5",
			'main_area_hover_accent_color'               => "#57bce1",
			'main_area_slot'                       => array(),
			'main_area_right_slot'                       => array(),
			'main_area_left_slot'                        => array(),
			'main_area_ad'                               => "",
			'sticky_header'                              => 1,
			'sticky_right_slot'                          => array(),
			'prefooter_instagram_username'               => '#baby',
			'footer_columns'                             => '3-3-3-3',
			'footer_background_color'                    => "#80c5e5",
			'footer_color'                               => "#ffffff",
			'footer_accent_color'                        => "#ffffff",
			'footer_hover_accent_color'                  => "#e6e6fd",
			'footer_copyright_bar'                       => 1,
			'footer_copyright_bar_background_color'      => "#7dc9e7",
			'footer_copyright_bar_color'                 => "#FFFFFF",
			'footer_copyright_content'                   => "",
			'primary_cta_text'                           => '',
			'primary_cta_link'                           => '',
			'secondary_cta_text'                         => '',
			'secondary_cta_link'                         => '',
			
			/**
			 * Archive
			 */
			'archive_sidebar_position'                   => 'right',
			'archive_sidebar'                            => 'none',
			'archive_sticky_sidebar'                     => 'none',
			'archive_layout'                             => 'a',
			'archive_posts_per_page'                     => 'inherit',
			'archive_posts_per_page_number'              => 10,
			'archive_pagination'                         => 'numeric',
			'category_sidebar_position'                  => 'right',
			'category_sidebar'                           => 'inherit',
			'category_sticky_sidebar'                    => 'inherit',
			'category_layout'                            => 'a',
			'category_posts_per_page'                    => 'inherit',
			'category_posts_per_page_number'             => 10,
			'category_pagination'                        => 'numeric',
			'tag_sidebar_position'                       => 'right',
			'tag_sidebar'                                => 'inherit',
			'tag_sticky_sidebar'                         => 'inherit',
			'tag_layout'                                 => 'a',
			'tag_posts_per_page'                         => 'inherit',
			'tag_posts_per_page_number'                  => 10,
			'tag_pagination'                             => 'numeric',
			'author_sidebar_position'                    => 'right',
			'author_sidebar'                             => 'inherit',
			'author_sticky_sidebar'                      => 'inherit',
			'author_layout'                              => 'a',
			'author_posts_per_page'                      => 'inherit',
			'author_posts_per_page_number'               => 10,
			'author_pagination'                          => 'numeric',
			'search_sidebar_position'                    => 'right',
			'search_sidebar'                             => 'inherit',
			'search_sticky_sidebar'                      => 'inherit',
			'search_layout'                              => 'a',
			'search_posts_per_page'                      => 'inherit',
			'search_posts_per_page_number'               => 10,
			'search_pagination'                          => 'numeric',
			'ad_below_header'                            => '',
			'ad_before_footer'                           => '',
			
			/**
			 * Layouts
			 */
			// Layout A
			'category_layout_a'                          => 1,
			'format_icon_layout_a'                       => 1,
			'text_limit_layout_a'                        => 120,
			'layout_a_metadata'                          => array(
				'author',
				'date',
				'comments',
				'addcomment',
				'readtime',
			),
			// Layout B
			'category_layout_b'                          => 1,
			'format_icon_layout_b'                       => 1,
			'text_limit_layout_b'                        => 120,
			'layout_b_metadata'                          => array(
				'author',
				'date',
				'comments',
				'addcomment',
				'readtime',
			),
			// Layout C
			'category_layout_c'                          => 1,
			'format_icon_layout_c'                       => 1,
			'text_limit_layout_c'                        => 250,
			'layout_c_metadata'                          => array(
				'author',
				'date',
				'comments',
				'addcomment',
				'readtime',
			),
			// Layout D
			'category_layout_d'                          => 1,
			'format_icon_layout_d'                       => 1,
			'text_limit_layout_d'                        => 130,
			'layout_d_metadata'                          => array(
				'author',
				'date',
				'comments',
				'addcomment',
				'readtime',
			),
			
			/**
			 * Cover
			 */
			'cover_height'                               => 700,
			'cover_autoplay'                             => 1,
			'cover_autoplay_time'                        => 5,
			'cover_box'                                  => "rgba(255,255,255, 0.5)",
			'cover_text_color'                           => "#808081",
			'cover_show_text'                            => 1,
			'cover_show_button'                          => 1,
			'cover_metadata'                             => array( 'author', 'date' ),
			'page_cover_layout'                          => '1',
			'page_cover_per_page_number'                 => 3,
			'page_cover_cover_order_by'                  => 'date',
			'page_cover_manual_order'                    => array(),
			'page_cover_unique'                          => 'on',
			'page_cover_category'                        => array(),
			'page_cover_tag'                             => array(),
			'page_cover_format'                          => 'all',
			'page_cover_time_diff'                       => 0,
			'category_cover_layout'                      => '1',
			'category_cover_per_page_number'             => 3,
			'category_cover_cover_order_by'              => 'date',
			
			/**
			 * Single
			 */
			// Page
			'page_sidebar_position'                      => 'right',
			'page_sidebar'                               => 'none',
			'page_sticky_sidebar'                        => 'none',
			'page_featured_image'                        => 1,
			'page_featured_image_caption'                => 0,
			// Post
			'post_sidebar_position'                      => 'right',
			'post_sidebar'                               => 'inherit',
			'post_sticky_sidebar'                        => 'inherit',
			'single_post_layout'                         => 1,
			'single_post_text_limit'                     => 260,
			'single_post_metadata'                       => array( 'author', 'date' ),
			'single_post_categories'                     => 1,
			'single_post_featured_image'                 => 1,
			'single_post_featured_image_caption'         => 1,
			'single_post_expert'                         => 1,
			'single_post_tags'                           => 1,
			'single_post_author'                         => 1,
			'single_post_prevnext'                       => 1,
			// Related posts
			'related_type'                               => 'default',
			'related_limit'                              => 3,
			'related_logic'                              => 'cat',
			'related_order'                              => 'date',
			'related_old'                                => '0',
			
			/**
			 * Typography
			 */
			'navigation_font'                            => array(
				'font-family'    => 'Poppins',
				'variant'        => 'regular',
				'font-size'      => '15px',
				'line-height'    => '1.5',
				'letter-spacing' => '0',
				'subsets'        => array(),
				'text-transform' => 'none',
			),
			'body_font'                                  => array(
				'font-family'    => 'Poppins',
				'variant'        => 'regular',
				'font-size'      => '15px',
				'line-height'    => '1.5',
				'letter-spacing' => '0',
				'subsets'        => array(),
				'color'          => '#808081',
				'text-transform' => 'none',
			),
			'accent_font_color'                          => '#E869B0',
			'headings_fonts'                             => array(
				'font-family'    => 'Cabin Sketch',
				'variant'        => 'regular',
				'letter-spacing' => '0',
				'subsets'        => array(),
				'color'          => '#80C5E5',
				'text-transform' => 'none',
			),
			'buttons_border_radius'                      => '20',

			/**
			 * Sidebars
			 */
			'sidebars'                                   => array(),
			'odd_widget_background_color'                => '#FFF1FF',
			'even_widget_background_color'               => '#DEF6FF',
			
			/**
			 * Updater
			 */
			'theme_update_username'                      => '',
			'theme_update_apikey'                        => '',
			
			/**
			 * Additional Code
			 */
			'google_analytics_only_for_logged_out_users' => 1,
		);
		
		$defaults = apply_filters( 'rodller_modify_default_options', $defaults );
		
		if ( isset( $defaults[ $option ] ) ) {
			return $defaults[ $option ];
		}
		
		return false;
		
	}
endif;