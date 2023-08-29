<?php
/**
 * Enqueue scripts and styles.
 *
 * @package rodller
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Load css and js files
 *
 * @return void
 * @since  1.0.0
 */
if ( ! function_exists( 'rodller_enqueue_styles_and_scripts' ) ) :
	function rodller_enqueue_styles_and_scripts() {
		rodller_enqueue_styles();
		rodller_enqueue_scripts();
	}
endif;
add_action( 'wp_enqueue_scripts', 'rodller_enqueue_styles_and_scripts', 10, 1 );

/**
 * Load frontend CSS files
 *
 * @return void
 * @since  1.0.0
 */
if ( ! function_exists( 'rodller_enqueue_styles' ) ):
	function rodller_enqueue_styles() {
		
		//Load fonts
		if ( $fonts_link = rodller_generate_fonts_link() ) {
			wp_enqueue_style( 'rodller-fonts', $fonts_link, false, THEME_VERSION, 'all' );
		}
		
		wp_enqueue_style( 'rodller_style', get_parent_theme_file_uri( 'assets/public/css/min.css' ), false, THEME_VERSION, 'all' );
		
		if ( rodller_is_rtl() ) {
			wp_enqueue_style( 'rodller_style-rtl', get_parent_theme_file_uri( '/rtl.css' ), array( 'rodller_style' ), THEME_VERSION );
		}
	}
endif;

/**
 * Load frontend JS files
 *
 * @return void
 * @since  1.0.0
 */
if ( ! function_exists( 'rodller_enqueue_scripts' ) ):
	function rodller_enqueue_scripts() {
		
		wp_register_script( 'rodller_script', get_parent_theme_file_uri( 'assets/public/js/min.js' ), array(
			'jquery',
			'jquery-masonry',
		), THEME_VERSION, true );
		
		wp_localize_script( 'rodller_script', 'rodller_options', rodller_get_js_options() );
		
		wp_enqueue_script( 'rodller_script' );
		
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
endif;

/**
 * Add dynamic css to head tag
 *
 * @return void
 * @since  1.0.0
 */
if ( ! function_exists( 'rodller_add_dynamics_css' ) ) :
	function rodller_add_dynamics_css() {
		$dynamic_css = get_option( 'rodller_dynamic_css' );
		$dynamic_css .= get_theme_mod( THEME_PREFIX . 'additional_css', '' );
		$dynamic_css .= rodller_append_css_options();
		
		?>
        <style type="text/css">
            <?php echo rodller_compress_css_code($dynamic_css); ?>
        </style>
		<?php
	}
endif;
add_action( 'wp_head', 'rodller_add_dynamics_css' );

/**
 * Add additional JavaScript code to end of the body tag
 *
 * @return void
 * @since  1.0.0
 */
if ( ! function_exists( 'rodller_add_additional_script' ) ) {
	function rodller_add_additional_script() {
		$dynamic_js = get_theme_mod( THEME_PREFIX . 'additional_js', '' );
		if ( ! empty( $dynamic_js ) ) :
			?>
            <script id="rodller-additional-js" type="text/javascript">
				<?php echo $dynamic_js; ?>
            </script>
		<?php
		endif;
	}
}
add_action( 'wp_footer', 'rodller_add_additional_script' );


/**
 * Add Google Analytics code to head
 *
 * @return void
 * @since  1.0.0
 */
if ( ! function_exists( 'rodller_add_google_analytics_code' ) ) {
	function rodller_add_google_analytics_code() {
		$google_analytics_js                        = get_theme_mod( THEME_PREFIX . 'google_analytics_js', '' );
		$google_analytics_only_for_logged_out_users = rodller_get_option( 'google_analytics_only_for_logged_out_users' );
		
		if ( empty( $google_analytics_js ) ) {
			return;
		}
		
		if ( $google_analytics_only_for_logged_out_users ) {
			if ( ! is_user_logged_in() ) {
				echo $google_analytics_js;
			}
		} else {
			echo $google_analytics_js;
		}
	}
}
add_action( 'wp_head', 'rodller_add_google_analytics_code' );

/**
 * Prepares options needed in JS
 *
 * @return array $js_options
 * @since  1.0.0
 */
if ( ! function_exists( 'rodller_get_js_options' ) ):
	function rodller_get_js_options() {
		$js_options = array(
			'cover_autoplay'      => rodller_get_option( 'cover_autoplay' ),
			'cover_autoplay_time' => intval( rodller_get_option( 'cover_autoplay_time' ) ) * 1000,
			'rtl'                 => rodller_is_rtl(),
		);
		
		$js_options = apply_filters( 'rodller_filter_js_options', $js_options );
		
		return $js_options;
	}
endif;