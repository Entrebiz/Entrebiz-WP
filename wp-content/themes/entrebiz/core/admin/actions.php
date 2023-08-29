<?php


/**
 * Store registered sidebars so we can use them inside theme options
 * before wp_registered_sidebars globa is initialized
 *
 * @since  1.0
 */

add_action( 'admin_init', 'rodller_check_sidebars' );

if ( ! function_exists( 'rodller_check_sidebars' ) ):
	function rodller_check_sidebars() {
		global $wp_registered_sidebars;
		if ( ! empty( $wp_registered_sidebars ) ) {
			update_option( 'rodller_registered_sidebars', $wp_registered_sidebars );
		}
	}
endif;