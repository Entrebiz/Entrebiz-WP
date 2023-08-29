<?php
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @package rodller
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if (!function_exists('rodller_setup')) :
    /**
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function rodller_setup()
    {
	    /* Define content width */
	    $GLOBALS['content_width'] = 1140;
	    
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on personal_brand, use a find and replace
         * to change 'personal_brand' to the name of your theme in all the template files.
         */
        load_theme_textdomain('rodller', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');
	
        // TODO add all picked color in theme
//	    add_theme_support(
//		    'editor-color-palette', array(
//			    array(
//				    'name'  => esc_html__( 'Black', 'rodller' ),
//				    'slug' => 'black',
//				    'color' => '#2a2a2a',
//			    ),
//			    array(
//				    'name'  => esc_html__( 'Gray', 'rodller' ),
//				    'slug' => 'gray',
//				    'color' => '#727477',
//			    )
//		    )
//	    );
        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        /* Add post formats support */
        add_theme_support( 'post-formats', array( 'audio', 'gallery', 'video' ) );
	
	    // Add support for full and wide align images.
	    add_theme_support( 'align-wide' );
	    
	    // Adding support for core block visual styles.
	    add_theme_support( 'wp-block-styles' );
	    
        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'top-menu' => esc_html__('Top menu', 'rodller'),
            'social-top' => esc_html__('Social Top menu', 'rodller'),
            'main-menu' => esc_html__('Main menu', 'rodller'),
            'social-menu' => esc_html__('Social menu', 'rodller'),
        ));

        /* Add image sizes */
        $image_sizes = rodller_get_image_sizes();
        if ( !empty( $image_sizes ) ) {
            foreach ( $image_sizes as $id => $size ) {
                add_image_size( $id, $size['w'], $size['h'], $size['crop'] );
            }
        }
        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');
    }
endif;
add_action('after_setup_theme', 'rodller_setup');

/**
 * When theme is activated generate dynamic CSS
 *
 * @since 1.0
 */
add_action('after_switch_theme', 'rodller_after_switch_theme_setup');
if(!function_exists('rodller_after_switch_theme_setup')):
	function rodller_after_switch_theme_setup () {
		$dynamic_css = get_option('rodller_dynamic_css');
		if(!empty($dynamic_css)){
			return;
		}
		update_option('rodller_dynamic_css', Kirki_Modules_CSS::loop_controls( 'rodller_options' ));
	}
endif;
