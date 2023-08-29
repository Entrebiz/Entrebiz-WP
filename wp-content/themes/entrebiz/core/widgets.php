<?php


/**
 * Register widgets
 *
 * Callback function which includes widget classes and initialize theme specific widgets
 *
 * @since  1.0
 */

add_action( 'widgets_init', 'rodller_register_widgets' );

if ( !function_exists( 'rodller_register_widgets' ) ) :
	function rodller_register_widgets() {
		
		include_once get_template_directory() .'/core/widgets/posts.php';
		
		register_widget( 'rodller_Posts_Widget' );
		
	}
endif;
