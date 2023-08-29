<?php

/**
 * This filter alters WordPress default behavior for getting posts with options picked in theme options
 *
 * @since 1.0
 */
add_filter( 'pre_get_posts', 'rodller_pre_get_posts_filter', 1, 99 );
if ( ! function_exists( 'rodller_pre_get_posts_filter' ) ):
	function rodller_pre_get_posts_filter( WP_Query $query ) {
		
		if ( is_admin() || ! $query->is_main_query() ) {
			return $query;
		}
		
		$current_template = rodller_detect_template();
		
		// Custom post per page options
		if ( in_array( $current_template, array( 'author', 'archive', 'tag', 'category', 'search' ) ) ) {
			$per_page_num = rodller_get_template_post_per_page( $current_template );
			if ( $current_template == 'category' ) {
				$cat_meta = rodller_get_category_metadata( get_queried_object_id() );
				if ( ! empty( $cat_meta['ppp'] ) ) {
					$per_page_num = $cat_meta['ppp'];
				}
			}
			if ( ! empty( $per_page_num ) ) {
				$query->set( 'posts_per_page', $per_page_num );
			}
		}
		
		return $query;
	}
endif;

/**
 * Remove Contextual Related Posts or WordPress Related Posts filter at the end of content
 *
 * @since 1.0
 */
add_action( 'init', 'rodller_remove_related_plugins_actions', 999 );
if ( ! function_exists( 'rodller_remove_related_plugins_actions' ) ):
	function rodller_remove_related_plugins_actions() {
		
		if ( rodller_get_option( 'single_related_using' ) == 'crp' ) {
			remove_action( 'template_redirect', 'crp_content_prepare_filter' );
		}
		
		if ( rodller_get_option( 'single_related_using' ) == 'wrpr' ) {
			if ( ! is_user_logged_in() ) {
				remove_filter( 'the_content', 'wp_rp_add_related_posts_hook', 10 );
			}
		}
		
		if ( rodller_get_option( 'single_related_using' ) == 'jetpack' ) {
			add_filter( 'jetpack_relatedposts_filter_enabled_for_request', '__return_false' );
		}
	}
endif;

/**
 * Add class to instagram button wrapper
 *
 * @since 1.0
 */
add_filter('wpiw_link_class', 'rodller_add_prefooter_instagram_link_wrapper_class');
if(!function_exists('rodller_add_prefooter_instagram_link_wrapper_class')):
    function rodller_add_prefooter_instagram_link_wrapper_class(){
		return 'rodller-prefooter-instagram-button-wrap';
    }
endif;

/**
 * Add class to instagram button wrapper
 *
 * @since 1.0
 */
add_filter('wpiw_linka_class', 'rodller_add_prefooter_instagram_link_class');
if(!function_exists('rodller_add_prefooter_instagram_link_class')):
    function rodller_add_prefooter_instagram_link_class(){
		return 'rodller-button rodller-button-same-as-body';
    }
endif;


/**
 * Add odd and even widgets classes because :nth-child(odd) it's a bit buggy
 *
 * @since 1.0
 */
add_filter( 'dynamic_sidebar_params', 'rodller_set_sidebar_widgets_classes' );
if ( ! function_exists( 'rodller_set_sidebar_widgets_classes' ) ):
	function rodller_set_sidebar_widgets_classes( $params ) {
		
		global $rodller_sidebar_widget_counter; //Our widget counter variable
		
		if ( ! isset( $params[0]['id'] ) ) {
			return $params;
		}
		
		if ( ! in_array( $params[0]['id'], array( 'rodller-default-sidebar', 'rodller-default-sticky-sidebar' ) ) ) {
			return $params;
		}
		
		$rodller_sidebar_widget_counter ++;
		
		if ( $rodller_sidebar_widget_counter % 2 == 0 ) {
			$class = 'class="rodller-widget-even ';
		} else {
			$class = 'class="rodller-widget-odd ';
		}
		
		$params[0]['before_widget'] = str_replace( 'class="', $class, $params[0]['before_widget'] );
		
		
		return $params;
	}
endif;


/**
 * Add class rodller-rtl if site is in rtl mode
 *
 * @return $classes
 * @since  1.0
 */
add_filter('body_class', 'rodller_add_rtl_body_class');
if(!function_exists('rodller_add_rtl_body_class')):
	function rodller_add_rtl_body_class($classes){
		if(rodller_is_rtl()){
		    $classes[] = 'rodller-rtl';
		}
	
		return $classes;
	}
endif;

/**
 * Add sidebar class to body
 *
 * @return $classes
 * @since  1.0
 */
add_filter('body_class', 'rodller_add_sidebar_body_class');
if(!function_exists('rodller_add_sidebar_body_class')):
	function rodller_add_sidebar_body_class($classes){
		$sidebar_options = rodller_get_template_sidebar_options();
		if($sidebar_options['sidebar_active']){
			$classes[] = 'rodller-sidebar-active';
		}else{
			$classes[] = 'rodller-sidebar-inactive';
		}
	
		return $classes;
	}
endif;

/**
 * Woocommerce Ajaxify Cart
 *
 * @return bool
 * @since  1.0
 */

if ( !function_exists( 'rodller_woocommerce_ajax_fragments' ) ):
	
	if ( rodller_is_woocommerce_active() && version_compare( WC_VERSION, '3.2.6', '<') ) {
		add_filter( 'add_to_cart_fragments', 'rodller_woocommerce_ajax_fragments' );
	} else {
		add_filter( 'woocommerce_add_to_cart_fragments', 'rodller_woocommerce_ajax_fragments' );
	}
	
	function rodller_woocommerce_ajax_fragments( $fragments ) {
		ob_start();
		
		get_template_part('template-parts/header/elements/shop-cart');
		
		$fragments['.rodller-cart-icon'] = ob_get_clean();
		
		return $fragments;
	}
endif;

/**
 * Apply Social Menu args to all social menu locations
 *
 * @return bool
 * @since  1.0
 */
add_filter('wp_nav_menu_args', 'rodller_apply_social_menu_args_to_social_menu_location');
if(!function_exists('rodller_apply_social_menu_args_to_social_menu_location')):
	function rodller_apply_social_menu_args_to_social_menu_location( $args ){

		$menu_locations = get_nav_menu_locations();

		if (!empty($args['menu']) && !empty($menu_locations['social-menu']) && $args['menu']->term_id === $menu_locations['social-menu']){
			$args['depth'] = 1;
			$args['menu_class'] = 'rodller-menu-social list-unstilted';
			$args['link_before'] = '<span class="rodller-menu-social-text">';
			$args['link_after'] = '</span>';
		}

		return $args;
	}
endif;


/**
 * Allow SVG upload
 *
 * @return bool
 * @since  1.1
 */
if(!function_exists('rodller_mime_types')):
	function rodller_mime_types($mimes){
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}
endif;
add_filter('upload_mimes',  'rodller_mime_types');