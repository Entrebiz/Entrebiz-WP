<?php
/**
 * Theme Customizer
 *
 * @package rodller
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Including Kirki for easier manipulation with theme customizer
 *
 * Kirki is loaded from theme not from plugin because it's loaded only in admin area, there is no kirki when logged out users are visiting
 */
if (!class_exists('Kirki')) {
	require_once(get_template_directory() . "/vendor/kirki/kirki.php");
}

/**
 * Remove the additional CSS section, introduced in 4.7, from the Customizer.
 * @param $wp_customize WP_Customize_Manager
 */
add_action('customize_register', 'rodller_remove_cutomizer_sections', 15);
function rodller_remove_cutomizer_sections(WP_Customize_Manager $wp_customize) {
    $wp_customize->remove_panel('themes');

    $wp_customize->remove_section('custom_css');
    $wp_customize->remove_section('colors');
}

/**
 * The function's argument is an array of existing config values
 * The function returns the array with the addition of our own arguments
 * and then that result is used in the kirki/config filter
 *
 * @param $config the configuration array
 *
 * @return array
 */
add_filter('kirki/config', 'rodller_configuration_sample_styling');
function rodller_configuration_sample_styling($config) {
    return wp_parse_args(array(
        'logo_image'     => get_theme_file_uri('assets/admin/img/themelogo.jpg'),
        'description'    => sprintf(esc_attr__('Need help finding your way while working with Mummy Blog? Visit %s or contact Rodller %s.', 'rodller'), '<a href="https://rodller.com/documentation/rodller/" target="_blank">documentation</a>', '<a href="https://rodller.com/contact" target="_blank">supprot</a>' ),
        'disable_loader' => true,
        'disable_output' => false
    ), $config);
}

/**
 * Compiles the CSS to a file instead of adding inline.
 *
 * @return string Type
 * @since  1.0
 */
if(!function_exists('rodller_change_kirki_save_method')):
    function rodller_change_kirki_save_method(){
	    return 'file';
    }
endif;
add_filter( 'kirki/dynamic_css/method', 'rodller_change_kirki_save_method');

/**
 * Embed googlefonts in styles instead of loading separate link.
 *
 * @return string Type
 * @since  1.0
 */
if(!function_exists('rodller_change_kirki_googlefonts_load_method')):
    function rodller_change_kirki_googlefonts_load_method(){
	    return 'embed';
    }
endif;
add_filter( 'kirki/' . THEME_PREFIX . 'options' . '/googlefonts_load_method', 'rodller_change_kirki_googlefonts_load_method');

/**
 * Generate dynamic CSS.
 *
 * @return string Type
 * @since  1.0
 */
if(!function_exists('rodller_generate_dynamic_css')):
    function rodller_generate_dynamic_css($css){
	    update_option('rodller_dynamic_css', $css, true);
    }
endif;
add_filter( "kirki_" . THEME_PREFIX . 'options' . "_dynamic_css", 'rodller_generate_dynamic_css');

/**
 * For easier use of Theme Customizer API we are using Kirki Customizer
 *
 * @since  1.0
 */
Kirki::add_config(THEME_PREFIX . 'options', array(
	'capability'  => 'edit_theme_options',
	'option_type' => 'theme_mod',
));

/**
 * Simple hack to allow adding <script> tags in textarea in customeizer
 *
 * @return $code as it is added
 * @since  1.0
 */
if(!function_exists('rodller_allow_code_sanitize')):
	function rodller_allow_code_sanitize($code){
		return $code;
	}
endif;

/**
 * Sections in customizer are required in below
 */

/**
 * Site Identity
 *
 * Branding configurations for logo and site title, it extends WordPresses default Site Identity
 */
require_once get_theme_file_path('core/admin/sections/site-identity.php');

/**
 * Header & Footer
 *
 * Below are all configuration for header & footer options
 */
require_once get_theme_file_path('core/admin/sections/header-and-footer.php');

/**
 * Archive
 *
 * Options for archive displaying, including Category and Tag template options
 */
require_once get_theme_file_path('core/admin/sections/archive.php');

/**
 * Layouts
 *
 * Options for displaying post layouts in archives
 */
require_once get_theme_file_path('core/admin/sections/layouts.php');

/**
 * Cover
 *
 * Options for displaying cover area and default options for page & category archive
 */
require_once get_theme_file_path('core/admin/sections/cover.php');

/**
 * Cover
 *
 * Options for displaying cover area and default options for page & category archive
 */
require_once get_theme_file_path('core/admin/sections/single.php');

/**
 * Typography
 *
 * Below are all options for typography.
 * In this section you can configure:
 * Fonts Families pickers, Variants, Subsets, Font Sizes, Line Heights, Letter Spacing, Text Transforms and Colors.
 */
require_once get_theme_file_path('core/admin/sections/typography.php');

/**
 * Sidebars
 *
 * Option for new sidebar palaces registration
 */
require_once get_theme_file_path('core/admin/sections/sidebars.php');

/**
* Additional Code
*/
require_once get_theme_file_path('core/admin/sections/additional-code.php');