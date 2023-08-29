<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package rodller
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 *
 * @since 1.0
 */
if (!function_exists('rodller_pingback_header')) :
    function rodller_pingback_header()
    {
        if (is_singular() && pings_open()) {
            echo '<link rel="pingback" href="', esc_url(get_bloginfo('pingback_url')), '">';
        }
    }
endif;
add_action('wp_head', 'rodller_pingback_header');

/**
 * When child theme is activated update child theme mods
 *
 * @since 1.0
 */
if(!function_exists('rodller_update_child_theme_mods')):
	function rodller_update_child_theme_mods($new_name, \WP_Theme $new_theme){
		// get the previously active theme
		$previous = get_option( 'theme_switched', -1 );
		
		// get the parent of current theme, will be false if no parent
		$parent = $new_theme->parent() ? $new_theme->get_template() : false;
		
		// current stylesheet name
		$stylesheet = get_option( 'stylesheet' );
		
		// has the theme being activated ever been activated before?
		$lastActive = get_option( $stylesheet . '_last_active', false );
		
		// if previouly active theme is the parent of the the child theme being activated
		// and it has never been activated before..
		if ( ! $lastActive && $parent === $previous ) {
			
			// update "last_active" option so following code won't run again for this theme
			update_option( $stylesheet . '_last_active', current_time( 'timestamp', 1 ) );
			
			// get the theme mods of the parent
			$previousMods = get_option( 'theme_mods_' . $parent, array() );
			
			update_option( 'theme_mods_' . $stylesheet, $previousMods );
		}
		
	}
endif;
add_action( 'switch_theme', 'rodller_update_child_theme_mods', 10, 2 );