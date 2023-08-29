<?php
/**
 * Register widget areas.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 * @package rodller
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Generate sidebar sections
 *
 * @since 1.0
 */
add_action( 'widgets_init', 'rodller_setup_widgets_init' );
if ( ! function_exists( "rodller_setup_widgets_init" ) ):
	function rodller_setup_widgets_init() {
		register_sidebar( array(
			'name'          => esc_html__( 'Default Sidebar', 'rodller' ),
			'id'            => 'rodller-default-sidebar',
			'description'   => esc_html__( 'Add widgets here.', 'rodller' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
		
		register_sidebar( array(
			'name'          => esc_html__( 'Default Sticky Sidebar', 'rodller' ),
			'id'            => 'rodller-default-sticky-sidebar',
			'description'   => esc_html__( 'Add widgets here.', 'rodller' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );

		$footer_columns = rodller_get_footer_columns();
		if ( ! empty( $footer_columns ) ) {
			foreach ($footer_columns as $footer_column_key => $footer_column){
				$footer_column_counter = $footer_column_key + 1;
				register_sidebar( array(
					'name'          => esc_html__( 'Footer column', 'rodller' ) . ' ' . $footer_column_counter,
					'id'            => 'rodller-footer-column-sidebar-' . $footer_column_counter,
					'description'   => esc_html__( 'Add widgets here.', 'rodller' ),
					'before_widget' => '<section id="%1$s" class="widget %2$s">',
					'after_widget'  => '</section>',
					'before_title'  => '<h2 class="widget-title">',
					'after_title'   => '</h2>',
				) );
			}
		}
		
		$theme_sidebars = rodller_get_option( 'sidebars' );
		if ( ! empty( $theme_sidebars ) ) {
			foreach ( $theme_sidebars as $theme_sidebar ) {
				if ( empty( $theme_sidebar['name'] ) ) {
					continue;
				}
				
				register_sidebar( array(
					'name'          => $theme_sidebar['name'],
					'id'            => sanitize_title( $theme_sidebar['name'] ),
					'description'   => esc_html__( 'Add widgets here.', 'rodller' ),
					'before_widget' => '<section id="%1$s" class="widget %2$s">',
					'after_widget'  => '</section>',
					'before_title'  => '<h2 class="widget-title">',
					'after_title'   => '</h2>',
				) );
			}
		}
	}
endif;

/**
 * Set global variable for keeping count of displayed sidebars on the page
 *
 * @since 1.0
 */
add_action( 'init', 'rodller_register_displayed_sidebars_global' );
if ( ! function_exists( 'rodller_register_displayed_sidebars_global' ) ):
	function rodller_register_displayed_sidebars_global() {
		global $rodller_displayed_sidebars;
		$rodller_displayed_sidebars = array();
	}
endif;

/**
 * Set global variable for keeping count of displayed sidebars on the page
 * Note: This will work only in customizer
 *
 * @since 1.0
 */
add_filter( 'dynamic_sidebar_params', 'rodller_add_displayed_sidebars_to_global' );
if ( ! function_exists( 'rodller_add_displayed_sidebars_to_global' ) ):
	function rodller_add_displayed_sidebars_to_global( $sidebar ) {
  
		if ( ! is_customize_preview() ) {
			return $sidebar;
		}
		
		if ( empty( $sidebar[0]['id'] ) ) {
			return $sidebar;
		}
		
		global $rodller_displayed_sidebars;
		$sidebar_id = $sidebar[0]['id'];
		
		if ( ! in_array( $sidebar_id, $rodller_displayed_sidebars ) ) {
			$rodller_displayed_sidebars[] = $sidebar_id;
		}
		
		return $sidebar;
	}
endif;

/**
 * Display sidebars below footer so user can edit them in customizer
 * Note: This will work only in customizer
 *
 * @since 1.0
 */
add_action( 'wp_footer', 'rodller_support_for_all_widgets_customizer' );
if ( ! function_exists( 'rodller_support_for_all_widgets_customizer' ) ):
	function rodller_support_for_all_widgets_customizer() {
		
		if ( ! is_customize_preview() ) {
			return false;
		}
		
		global $wp_registered_sidebars, $rodller_displayed_sidebars;
		
		$registered_sidebars_keys  = array_keys( $wp_registered_sidebars );
		$rodller_not_displayed_sidebars = array_diff( $registered_sidebars_keys, $rodller_displayed_sidebars );
		
		if ( empty( $rodller_not_displayed_sidebars ) ) {
		    return false;
		}
		
        foreach ( $rodller_not_displayed_sidebars as $sidebar_id ) {
            if ( empty( $sidebar_id ) ) {
                continue;
            }
            
            ?>
            <div style="display: none">
                <?php dynamic_sidebar( $sidebar_id ); ?>
            </div>
            <?php
        }
	}
endif;
