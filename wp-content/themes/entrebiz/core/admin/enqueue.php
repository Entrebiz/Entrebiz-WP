<?php


/* Load admin scripts and styles */
add_action( 'admin_enqueue_scripts', 'rodller_load_admin_scripts' );


/**
 * Load scripts and styles in admin
 *
 * It just wrapps two other separate functions for loading css and js files in admin
 *
 * @since  1.0
 */
if ( ! function_exists( 'rodller_load_admin_scripts' ) ) :
	function rodller_load_admin_scripts() {
		rodller_load_admin_css();
		rodller_load_admin_js();
	}
endif;


/**
 * Load admin css files
 *
 * @since  1.0
 */
if ( ! function_exists( 'rodller_load_admin_css' ) ) :
	function rodller_load_admin_css() {
		
		global $pagenow;
		
		//Load color picker for categories
		if ( in_array( $pagenow, array(
				'edit-tags.php',
				'term.php',
			) ) && isset( $_GET['taxonomy'] ) && $_GET['taxonomy'] == 'category' ) {
			wp_enqueue_style( 'wp-color-picker' );
		}
		
		// Load small admin style tweaks
		wp_enqueue_style( 'rodller-global', get_parent_theme_file_uri( '/assets/admin/css/global.css' ), false, THEME_VERSION, 'all' );
		
		//Load fonts
		if( ($pagenow == 'post.php' || $pagenow == 'post-new.php') && $fonts_link = rodller_generate_fonts_link()){
			wp_enqueue_style( 'rodller-admin-fonts', $fonts_link, false, THEME_VERSION, 'all' );
		}
	}
endif;

/**
 * Load admin js files
 *
 * @since  1.0
 */
if ( ! function_exists( 'rodller_load_admin_js' ) ) :
	function rodller_load_admin_js() {
		
		global $pagenow;
		
		//Load global js
		wp_enqueue_script( 'rodller-global', get_parent_theme_file_uri( '/assets/admin/js/global.js' ), array( 'jquery' ), THEME_VERSION );
		
		//Load category scripts
		if ( in_array( $pagenow, array(
				'edit-tags.php',
				'term.php',
			) ) && isset( $_GET['taxonomy'] ) && $_GET['taxonomy'] == 'category' ) {
			wp_enqueue_media();
			wp_enqueue_script( 'rodller-category', get_parent_theme_file_uri( '/assets/admin/js/category.js' ), array(
				'jquery',
			), THEME_VERSION );
		}
	}
endif;

/**
 * Load editor styles
 *
 * @since  1.0
 */
add_action( 'admin_init', 'rodller_load_editor_styles' );
if ( ! function_exists( 'rodller_load_editor_styles' ) ) :
	function rodller_load_editor_styles() {
		add_editor_style( array(
				get_parent_theme_file_uri( '/assets/admin/css/editor-style.css' ),
				rodller_generate_fonts_link(),
				add_query_arg( 'action', 'rodller_dynamic_editor_styles', admin_url( 'admin-ajax.php' ) ),
			) );
	}
endif;

/**
 * Dynamic css for classic editor
 *
 * @since  1.0
 */
add_action( 'wp_ajax_rodller_dynamic_editor_styles', 'rodller_dynamic_editor_styles' );
if ( ! function_exists( 'rodller_dynamic_editor_styles' ) ) :
	function rodller_dynamic_editor_styles() {
		header( "Content-type: text/css" );
		rodller_add_dynamics_css();
		wp_die();
	}
endif;

/**
 * Add customizer controls styles
 *
 * @since  1.0
 */
add_action( 'customize_controls_enqueue_scripts', 'rodller_customizer_controls_scripts_and_styles', 99 );
if ( ! function_exists( 'rodller_customizer_controls_scripts_and_styles' ) ) :
	function rodller_customizer_controls_scripts_and_styles() {
		wp_register_script( 'rodller-customizer-controls-scripts', get_template_directory_uri() . '/assets/admin/js/customizer-controls.js', array( 'customize-controls' ), rand() );

		$translation_array = array(
			'sidebar_change_notice' => __( 'In order to edit widgets in new sidebars hit publish and reload the window (F5)', 'rodller' ),
		);
		wp_localize_script( 'rodller-customizer-controls-scripts', 'rodller_translation', $translation_array );

		wp_enqueue_script( 'rodller-customizer-controls-scripts' );
	}
endif;

/**
 * Add customizer preview styles
 *
 * @since  1.0
 */
add_action( 'customize_preview_init', 'rodller_customizer_preview_scripts_and_styles' );
if ( ! function_exists( 'rodller_customizer_preview_scripts_and_styles' ) ) :
	function rodller_customizer_preview_scripts_and_styles() {
		wp_enqueue_style( 'rodller-customizer-preview-styles', get_template_directory_uri() . '/assets/admin/css/customizer-preview.css', '', THEME_VERSION );
		wp_enqueue_script( 'rodller-customizer-preview-scripts', get_template_directory_uri() . '/assets/admin/js/customizer-preview.js', array('jquery'), THEME_VERSION );
	}
endif;

/**
 * Add customizer preview styles
 *
 * @since  1.0
 */
add_action( 'admin_head', 'rodller_gutenberg_editor_styles' );
if(!function_exists('rodller_gutenberg_editor_styles')):
	function rodller_gutenberg_editor_styles() {
		global $pagenow;

		if($pagenow == 'post.php' || $pagenow == 'post-new.php'){
			ob_start();
			require_once get_theme_file_path('core/admin/gutenberg-styles.php');
			$gutenberg_css = ob_get_clean();
			echo '<style type="text/css">' . $gutenberg_css  . '</style>';
		}
	}
endif;