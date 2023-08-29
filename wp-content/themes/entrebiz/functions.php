<?php
/**
 * rodller functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package rodller
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Defining global constants for theme
 */
define("THEME_PREFIX", "rodller_");
define("THEME_VERSION", "1.0.0");

/**
 * Helpers and utility functions
 */
require_once get_theme_file_path('core/helpers.php');

/**
 * All default values are in this file
 */
require_once get_theme_file_path('core/admin/defaults.php');

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
require_once get_theme_file_path('core/setup.php');

/**
 * Register widget areas.
 */
require_once get_theme_file_path('core/sidebars.php');

/**
 * Enqueue scripts and styles.
 */
require_once get_theme_file_path('core/enqueue.php');

/**
 * Custom functions that act independently of the theme templates.
 */
require_once get_theme_file_path('core/extras.php');

/**
 * Helper functions used in templates.
 */
require_once get_theme_file_path('core/template-fuctions.php');

/**
 * All filters used in theme will be here
 */
require_once get_theme_file_path('core/filters.php');

/**
 * Support for Rodller Blocks plugin
 */
require_once get_theme_file_path('core/rodller-blocks.php');

/**
 * Special mummy blog widgets
 */
require_once get_theme_file_path('core/widgets.php');

/**
 * All filters used in theme will be here
 */
require_once get_theme_file_path('core/public/Responsive_Menu_Walker.php');

/**
 * All admin features are here because of performance, we don't want to load everything on the front end
 */
if(is_admin() || is_customize_preview()){
	
	/**
	 * Helpers and utility functions for admin functions
	 */
	require_once get_theme_file_path('core/admin/helpers.php');
	
	/**
	 * Admin Styles and Scripts
	 */
	require_once get_theme_file_path('core/admin/enqueue.php');
	
    /**
     * Customizer additions.
     */
    require_once get_theme_file_path('core/admin/actions.php');
    
    /**
     * Customizer additions.
     */
    require_once get_theme_file_path('core/admin/customizer.php');
	
	/**
	 * Load Metaboxes
	 */
	require_once get_theme_file_path('core/admin/metaboxes/load.php');


}