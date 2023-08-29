<?php
/**
 * Helpers and utility functions for admin functions
 */

/**
 * Header layout images
 * For each layout there need to be file with key number in template-parts/header. For example layout-1.php, layout-2.php, etc.
 *
 * @filter rodller_modify_header_layouts
 * @return array header options
 * @since 1.0
 */
if ( ! function_exists( 'rodller_get_header_layouts' ) ) :
	function rodller_get_header_layouts() {
		return apply_filters( 'rodller_modify_header_layouts', array(
			'1' => get_theme_file_uri( 'assets/admin/img/header-1.jpg' ),
			'2' => get_theme_file_uri( 'assets/admin/img/header-2.jpg' ),
			'3' => get_theme_file_uri( 'assets/admin/img/header-3.jpg' ),
			'4' => get_theme_file_uri( 'assets/admin/img/header-4.jpg' ),
			'5' => get_theme_file_uri( 'assets/admin/img/header-5.jpg' ),
			'6' => get_theme_file_uri( 'assets/admin/img/header-6.jpg' ),
		) );
	}
endif;

/**
 * Cover layout
 * For each layout there need to be file with key number in template-parts/cover. For example layout-1.php, layout-2.php, etc.
 *
 * @filter rodller_modify_cover_layouts
 * @return array cover options
 * @since 1.0
 */
if ( ! function_exists( 'rodller_get_cover_layouts' ) ) :
	function rodller_get_cover_layouts( $include_inherit = false ) {
		$layout_options = array();
		
		$layout_options['none'] = get_theme_file_uri( 'assets/admin/img/none.jpg' );
		
		if ( $include_inherit ) {
			$layout_options['inherit'] = get_theme_file_uri( 'assets/admin/img/inherit.jpg' );
		}
		
		$layout_options['static'] = get_theme_file_uri( 'assets/admin/img/static.jpg' );
		$layout_options['1']      = get_theme_file_uri( 'assets/admin/img/cover-1.jpg' );
		$layout_options['2']      = get_theme_file_uri( 'assets/admin/img/cover-2.jpg' );
		
		return apply_filters( 'rodller_modify_cover_layouts', $layout_options );
	}
endif;

/**
 * These actions are available to enable and disable in header slots
 *
 * @filter rodller_modify_header_layouts
 * @return array header actions
 * @since 1.0
 */
if ( ! function_exists( 'rodller_get_header_actions' ) ) :
	function rodller_get_header_actions( array $force_options = array() ) {
		$actions = array(
			'social-menu' => esc_attr__( 'Social Menu', 'rodller' ),
			'search'      => esc_attr__( 'Search', 'rodller' ),
			'top-menu'    => esc_attr__( 'Top Menu', 'rodller' ),
			'primary-cta'    => esc_attr__( 'Primary CTA', 'rodller' ),
			'secondary-cta'    => esc_attr__( 'Secondary CTA', 'rodller' ),
		);
		
		if ( ! empty( $force_options ) ) {
			$actions = array_flip( array_intersect( array_flip( $actions ), $force_options ) );
		}
		
		// Check if WooCommerce plugin is active, if it is add shopping card to header actions
		if ( class_exists( 'WooCommerce' ) ) {
			$actions['shop-cart'] = esc_attr__( 'Shop Cart', 'rodller' );
		}
		
		return apply_filters( 'rodller_modify_header_layouts', $actions );
	}
endif;

/**
 * Get footer column layouts, there will be 4 options, column one (full width), two columns...
 *
 * @filter rodller_modify_footer_columns
 * @return array footer columns
 * @since 1.0
 */
if ( ! function_exists( 'rodller_get_footer_options' ) ) :
	function rodller_get_footer_options() {
		return apply_filters( 'rodller_modify_footer_columns', array(
			'12'        => get_theme_file_uri( 'assets/admin/img/one.jpg' ),
			'6-6'       => get_theme_file_uri( 'assets/admin/img/two.jpg' ),
			'4-4-4'     => get_theme_file_uri( 'assets/admin/img/three.jpg' ),
			'3-3-3-3'   => get_theme_file_uri( 'assets/admin/img/four.jpg' ),
			'4-2-2-2-2' => get_theme_file_uri( 'assets/admin/img/five.jpg' ),
		) );
	}
endif;

/**
 * These are post layouts that are going to be selectable in all archive templates
 *
 * @filter rodller_modify_post_layouts
 * @return array post layouts
 * @since 1.0
 */
if ( ! function_exists( 'rodller_get_post_layouts' ) ) :
	function rodller_get_post_layouts($with_block_details = false) {
		if( $with_block_details ){
			return apply_filters( 'rodller_modify_post_layouts_with_order', array(
				'a' => array(
					'label' => __('Layout A', 'rodller'),
					'value' => 'a',
					'order' => array('image', 'meta', 'title', 'excerpt'),
					'columns' => array('6', '6'),
					'image_size' => 'layout-a'
				),
				'b' => array(
					'label' => __('Layout B', 'rodller'),
					'value' => 'b',
					'order' => array('image', 'meta', 'title', 'excerpt'),
					'columns' => array('6', '6'),
					'image_size' => 'layout-b'
				),
				'c' => array(
					'label' => __('Layout C', 'rodller'),
					'value' => 'c',
					'order' => array('meta', 'title', 'image', 'excerpt'),
					'columns' => array('12'),
					'image_size' => 'layout-c'
				),
				'd' => array(
					'label' => __('Layout D', 'rodller'),
					'value' => 'd',
					'order' => array('image', 'meta', 'title', 'excerpt'),
					'columns' => array('12'),
					'image_size' => 'layout-d'
				),
			) );
		}
		return apply_filters( 'rodller_modify_post_layouts', array(
			'a' => get_theme_file_uri( 'assets/admin/img/layout-a.jpg' ),
			'b' => get_theme_file_uri( 'assets/admin/img/layout-b.jpg' ),
			'c' => get_theme_file_uri( 'assets/admin/img/layout-c.jpg' ),
			'd' => get_theme_file_uri( 'assets/admin/img/layout-d.jpg' ),
		) );
	}
endif;

/**
 * Returns pagination options, here you can add new pagination layout
 *
 * @filter rodller_modify_pagination_options
 * @return array pagination options
 * @since 1.0
 */
if ( ! function_exists( 'rodller_get_pagination_options' ) ) :
	function rodller_get_pagination_options() {
		return apply_filters( 'rodller_modify_pagination_options', array(
			'numeric'         => get_theme_file_uri( 'assets/admin/img/numeric.jpg' ),
			'prev-next'       => get_theme_file_uri( 'assets/admin/img/prevnext.jpg' ),
			'load-more'       => get_theme_file_uri( 'assets/admin/img/loadmore.jpg' ),
			'infinite-scroll' => get_theme_file_uri( 'assets/admin/img/infinite.jpg' ),
		) );
	}
endif;

/**
 * Get categories ids and names
 *
 * @filter rodller_modify_categories_ids_and_names
 * @return array Categories in format ID => Name
 * @since 1.0
 */
if ( ! function_exists( 'rodller_get_categories_ids_and_names' ) ):
	function rodller_get_categories_ids_and_names() {
		
		$categories_ids_and_name = array();
		
		$categories = get_categories();
		if ( ! empty( $categories ) ) {
			foreach ( $categories as $category ) {
				$categories_ids_and_name[ $category->term_id ] = $category->name;
			}
		}
		
		return apply_filters( 'rodller_modify_categories_ids_and_names', $categories_ids_and_name );
	}
endif;

/**
 * Returns order options
 *
 * @filter rodller_modify_order_options
 * @return array ordering options
 * @since 1.0
 */
if ( ! function_exists( 'rodller_get_order_options' ) ):
	function rodller_get_order_options() {
		
		$order_options = array(
			'date'     => esc_attr__( 'Date', 'rodller' ),
			'comments' => esc_attr__( 'Number of comments', 'rodller' ),
			'title'    => esc_attr__( 'Title (alphabetically)', 'rodller' ),
			'random'   => esc_attr__( 'Random', 'rodller' ),
		);
		
		return apply_filters( 'rodller_modify_order_options', $order_options );
	}
endif;

/**
 * Returns sorting options
 *
 * @filter rodller_modify_sorting_options
 * @return array sorting options
 * @since 1.0
 */
if ( ! function_exists( 'rodller_get_sorting_options' ) ):
	function rodller_get_sorting_options() {
		return apply_filters( 'rodller_modify_sorting_options', array(
			'desc' => esc_attr__( 'Descending', 'rodller' ),
			'asc'  => esc_attr__( 'Ascending', 'rodller' ),
		) );
	}
endif;

/**
 * Get available post formats with all and standard if you need it, you can exclude it by passing to falses
 *
 * @filter rodller_modify_format_choices
 * @return array post formats options
 * @since 1.0
 */
if ( ! function_exists( 'rodller_get_format_choices' ) ):
	function rodller_get_format_choices( $include_all = true, $include_standard = true ) {
		$format_options = array();
		
		if ( $include_all ) {
			$format_options['all'] = __( 'All', 'rodller' );
		}
		
		if ( $include_standard ) {
			$format_options['standard'] = __( 'Standard', 'rodller' );
		}
		
		$format_options['audio']   = __( 'Audio', 'rodller' );
		$format_options['gallery'] = __( 'Gallery', 'rodller' );
		$format_options['video']   = __( 'Video', 'rodller' );
		
		
		return apply_filters( 'rodller_modify_format_choices', $format_options );
	}
endif;

/**
 * Get the list of time limit options
 *
 * @filrer rodller_modify_time_diff_opts
 * @return array List of available options
 * @since 1.0
 */
if ( ! function_exists( 'rodller_get_time_diff_opts' ) ) :
	function rodller_get_time_diff_opts() {
		
		return apply_filters( 'rodller_modify_time_diff_opts', array(
			'0'         => __( 'All time', 'rodller' ),
			'-1 day'    => __( '1 Day', 'rodller' ),
			'-3 days'   => __( '3 Days', 'rodller' ),
			'-1 week'   => __( '1 Week', 'rodller' ),
			'-1 month'  => __( '1 Month', 'rodller' ),
			'-3 months' => __( '3 Months', 'rodller' ),
			'-6 months' => __( '6 Months', 'rodller' ),
			'-1 year'   => __( '1 Year', 'rodller' ),
		) );
		
	}
endif;


/**
 * Calculate time difference
 *
 * @param string $timestring String to calculate difference from
 *
 * @return  int Time difference in miliseconds
 * @since  1.0
 */
if ( ! function_exists( 'rodller_calculate_time_diff' ) ) :
	function rodller_calculate_time_diff( $timestring ) {
		
		$now = current_time( 'timestamp' );
		
		switch ( $timestring ) {
			case '-1 day' :
				$time = $now - DAY_IN_SECONDS;
				break;
			case '-3 days' :
				$time = $now - ( 3 * DAY_IN_SECONDS );
				break;
			case '-1 week' :
				$time = $now - WEEK_IN_SECONDS;
				break;
			case '-1 month' :
				$time = $now - ( YEAR_IN_SECONDS / 12 );
				break;
			case '-3 months' :
				$time = $now - ( 3 * YEAR_IN_SECONDS / 12 );
				break;
			case '-6 months' :
				$time = $now - ( 6 * YEAR_IN_SECONDS / 12 );
				break;
			case '-1 year' :
				$time = $now - ( YEAR_IN_SECONDS );
				break;
			default :
				$time = $now;
		}
		
		return $time;
	}
endif;

/**
 * Get available metadata, go to rodller_get_post_metadata function in core/template-functions.php in order to render the view of new metadata.
 *
 * @filter rodller_modify_supported_metadata
 * @return array metadata options
 * @since 1.0
 */
if ( ! function_exists( 'rodller_get_single_post_layout_options' ) ):
	function rodller_get_single_post_layout_options( $inherit = false ) {
		$layouts = array();
		
		if ( $inherit ) {
			$layouts['inherit'] = get_theme_file_uri( 'assets/admin/img/inherit.jpg' );
		}
		
		$layouts[1] = get_theme_file_uri( 'assets/admin/img/single-1.jpg' );
		$layouts[2] = get_theme_file_uri( 'assets/admin/img/single-2.jpg' );
		$layouts[3] = get_theme_file_uri( 'assets/admin/img/single-3.jpg' );
		
		return apply_filters( 'rodller_modify_single_post_layout_options', $layouts );
	}
endif;


/**
 * Get available metadata, go to rodller_get_post_metadata function in core/template-functions.php in order to render the view of new metadata.
 *
 * @filter rodller_modify_supported_metadata
 * @return array metadata options
 * @since 1.0
 */
if ( ! function_exists( 'rodller_get_supported_metadata' ) ):
	function rodller_get_supported_metadata() {
		$metadata = array(
			'date'       => __( 'Date', 'rodller' ),
			'author'     => __( 'Author', 'rodller' ),
			'comments'   => __( 'Comments count', 'rodller' ),
			'addcomment' => __( 'Add comment link', 'rodller' ),
			'readtime'   => __( 'Reading time', 'rodller' ),
		);
		
		return apply_filters( 'rodller_modify_supported_metadata', $metadata );
	}
endif;


/**
 * Sidebar position options images
 *
 * @filter rodller_modify_sidebar_positions
 * @return array sidebar options
 * @since 1.0
 */
if ( ! function_exists( 'rodller_get_sidebar_positions' ) ) :
	function rodller_get_sidebar_positions( $include_inherit = false ) {
		
		$sidebar_positions = array();
		if ( $include_inherit ) {
			$sidebar_positions['inherit'] = get_theme_file_uri( 'assets/admin/img/inherit.jpg' );
		}
		
		$sidebar_positions['none']  = get_theme_file_uri( 'assets/admin/img/none.jpg' );
		$sidebar_positions['left']  = get_theme_file_uri( 'assets/admin/img/sidebar-left.jpg' );
		$sidebar_positions['right'] = get_theme_file_uri( 'assets/admin/img/sidebar-right.jpg' );
		
		$sidebar_positions = apply_filters( 'rodller_modify_sidebar_positions', $sidebar_positions );
		
		return $sidebar_positions;
	}
endif;

/**
 * Related posts logics
 *
 * @return bool
 * @since  1.0
 */
if ( ! function_exists( 'rodller_get_related_logic_types' ) ):
	function rodller_get_related_logic_types() {
		$logic_types = array(
			'cat'         => __( 'Post in same category', 'rodller' ),
			'tag'         => __( 'Tagged with at least one same tag', 'rodller' ),
			'cat_or_tag'  => __( 'In the same category OR tagged with a same tag', 'rodller' ),
			'cat_and_tag' => __( 'In the same category AND tagged with a same tag', 'rodller' ),
			'author'      => __( 'By the same author', 'rodller' ),
			'all'         => __( 'All posts', 'rodller' ),
		);
		
		$logic_types = apply_filters( 'rodller_modify_related_logic_types', $logic_types );
		
		return $logic_types;
	}
endif;

/**
 * Get related plugins
 *
 * Check if Contextual Related Posts or WordPress Related Posts or Jetpack by WordPress.com is active
 *
 * @return bool
 * @since  1.0
 */
if ( ! function_exists( 'rodller_get_related_posts_types' ) ):
	function rodller_get_related_posts_types() {
		$related_plugins['none']    = __( 'None', 'rodller' );
		$related_plugins['default'] = __( 'Built-in related posts', 'rodller' );
		
		$crp = array(
			__( 'Contextual Related Posts', 'rodller' ),
		);
		
		if ( ! rodller_is_crp_active() ) {
			$crp[] = __( 'In order to use this option please install Contextual Related Posts plugin', 'rodller' );
		}
		
		$related_plugins['crp'] = $crp;
		
		$wrpr = array(
			__( 'WordPress Related Posts', 'rodller' ),
		);
		
		if ( ! rodller_is_wrpr_active() ) {
			$wrpr[] = __( 'In order to use this option please install WordPress Related Posts plugin', 'rodller' );
		}
		
		$related_plugins['wrpr'] = $wrpr;
		
		$jetpack = array(
			__( 'Jetpack by WordPress.com', 'rodller' ),
		);
		
		if ( ! rodller_is_jetpack_active() ) {
			$jetpack[] = __( 'In order to use this option please install Jetpack by WordPress.com plugin', 'rodller' );
		}
		
		$related_plugins['jetpack'] = $jetpack;
		
		return $related_plugins;
	}
endif;