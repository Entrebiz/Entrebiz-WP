<?php

/**
 * Global metaboxes that will be shown on every page and post.
 */

add_action('load-post.php', 'rodller_meta_boxes_setup');
add_action('load-post-new.php', 'rodller_meta_boxes_setup');

/**
 * Initialize all metaboxes
 */
if (!function_exists('rodller_meta_boxes_setup')) :
	function rodller_meta_boxes_setup() {
		global $typenow;
		if ($typenow == 'page' || $typenow == 'post') {
			add_action('add_meta_boxes', 'rodller_load_metaboxes', 1, 2);
			add_action('save_post', 'rodller_save_metaboxes', 10, 2);
		}
	}
endif;

/**
 * Load page metaboxes
 *
 * Callback function for page metaboxes load
 */
if (!function_exists('rodller_load_metaboxes')) :
	function rodller_load_metaboxes() {
		
		/* Sidebar metabox */
		add_meta_box(
			'rodller_page_sidebar',
			esc_html__('Sidebar', 'rodller'),
			'rodller_page_sidebar_metabox',
			array('page', 'post'),
			'side',
			'default'
		);
		
		/* Layout metabox */
		add_meta_box(
			'rodller_single_post_layouts',
			esc_html__('Post Layout', 'rodller'),
			'rodller_single_post_layouts_metabox',
			'post',
			'side',
			'default'
		);
		
		/* Cover metabox */
		add_meta_box(
			'rodller_page_cover',
			esc_html__('Cover', 'rodller'),
			'rodller_page_cover_metabox',
			'page',
			'normal',
			'default'
		);
	}
endif;

/**
 * Save page meta
 *
 * Callback function to save page meta data
 */
if (!function_exists('rodller_save_metaboxes')):
	function rodller_save_metaboxes($post_id, $post) {
		
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return false;
		}
		
		if (!isset($_POST['rodller_metaboxes_nonce']) || !wp_verify_nonce($_POST['rodller_metaboxes_nonce'], 'rodller_metaboxes')) {
			return false;
		}
		
		$post_type = get_post_type_object($post->post_type);
		if (!current_user_can($post_type->cap->edit_post, $post_id)) {
			return $post_id;
		}
		
		$old_rodller_meta = rodller_get_metadata();
		$rodller_meta = array();
		
		if (!empty($_POST['rodller']['sidebar_position'])) {
			$rodller_meta['sidebar_position'] = $_POST['rodller']['sidebar_position'];
		}
		
		if (!empty($_POST['rodller']['sidebar'])) {
			$rodller_meta['sidebar'] = $_POST['rodller']['sidebar'];
		}
		
		if(!empty($_POST['rodller']['sticky_sidebar'])){
			$rodller_meta['sticky_sidebar'] = $_POST['rodller']['sticky_sidebar'];
		}
		
		if(!empty($_POST['rodller']['layout'])){
			$rodller_meta['layout'] = $_POST['rodller']['layout'];
		}

		if(!empty($_POST['rodller']['hide_title'])){
			$rodller_meta['hide_title'] = $_POST['rodller']['hide_title'];
		}
		
		if( isset( $_POST['rodller']['cover'] ) &&  !empty($_POST['rodller']['cover']) ){
		    foreach( $_POST['rodller']['cover'] as $key => $value ){
				$rodller_meta['cover'][$key] = !isset($value) ? $old_rodller_meta['cover'][$key] : $value;
			}
		}

		if (!empty($rodller_meta)) {
			update_post_meta($post_id, '_rodller_meta', $rodller_meta);
		} else {
			delete_post_meta($post_id, '_rodller_meta');
		}
	}
endif;

/**
 * Sidebar metabox
 *
 * Callback function to create sidebar metabox
 */
if (!function_exists('rodller_page_sidebar_metabox')) :
    function rodller_page_sidebar_metabox($object) {

        wp_nonce_field('rodller_metaboxes', 'rodller_metaboxes_nonce');

        $sidebar_meta = rodller_get_metadata($object->ID);
	    $sidebar_positions = rodller_get_sidebar_positions(true);
        $sidebars = rodller_get_registered_sidebars();
        ?>
        <p>
            <label><?php esc_html_e( 'Sidebar Position', 'rodller' ); ?></label>
            <br>
            <br>
            <span class="rodller-image-radio">
                <?php foreach ( $sidebar_positions as $sidebar_position_id => $sidebar_position ) : ?>
                    <label>
                        <input class="rodller-sidebar-position" type="radio" name="rodller[sidebar_position]" value="<?php echo esc_attr( $sidebar_position_id ) ?>" <?php checked( $sidebar_meta['sidebar_position'], $sidebar_position_id ); ?>>
                        <img src="<?php echo esc_url( $sidebar_position ) ?>">
                    </label>
                <?php endforeach; ?>
            </span>
        </p>
        <p class="rodller-watch-for-changes" data-watch="rodller-sidebar-position" data-hide-on-value="none,inherit,static">
            <label for="rodller-sidebar"><?php _e('Static', 'rodller') ?></label>
            <select id="rodller-sidebar" name="rodller[sidebar]">
                <?php foreach ($sidebars as $sidebar_id => $sidebar_name) : ?>
                    <option value="<?php echo esc_attr($sidebar_id) ?>" <?php selected($sidebar_id, $sidebar_meta['sidebar']); ?>><?php echo esc_attr($sidebar_name) ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <p class="rodller-watch-for-changes" data-watch="rodller-sidebar-position" data-hide-on-value="none,inherit,static">
            <label for="rodller-sticky-sidebar"><?php _e('Sticky', 'rodller') ?></label>
            <select id="rodller-sticky-sidebar" name="rodller[sticky_sidebar]">
                <?php foreach ($sidebars as $sidebar_id => $sidebar_name) : ?>
                    <option value="<?php echo esc_attr($sidebar_id) ?>" <?php selected($sidebar_id, $sidebar_meta['sticky_sidebar']); ?>><?php echo esc_attr($sidebar_name) ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <?php
    }
endif;

/**
 * Cover metabox
 *
 * Callback function to create cover metabox
 */
if (!function_exists('rodller_page_cover_metabox')):
    function rodller_page_cover_metabox($object) {

        $options = rodller_get_metadata($object->ID);
        $cover_options = $options['cover'];
        $cover_layouts = rodller_get_cover_layouts(true);
        $order_options = rodller_get_order_options();
        $sort_options = rodller_get_sorting_options();
        $categories = rodller_get_categories_ids_and_names();
        $formats = rodller_get_format_choices();
        $time_diffs = rodller_get_time_diff_opts();

        ?>
        <div class="half">
            <h3><?php _e('Layout', 'rodller') ?></h3>
            <div class="rodller-image-radio">
                <?php foreach ($cover_layouts as $cover_layout_id => $cover_layout) : ?>
                    <label>
                        <input class="rodller-cover-layout" type="radio" name="rodller[cover][layout]" value="<?php echo esc_attr($cover_layout_id) ?>" <?php checked($cover_options['layout'], $cover_layout_id); ?>>
                        <img src="<?php echo esc_attr($cover_layout) ?>">
                    </label>
                <?php endforeach; ?>
            </div>

            <div class="rodller-watch-for-changes" data-watch="rodller-cover-layout" data-hide-on-value="none,inherit,static">
                <h3><?php _e('Posts per page number', 'rodller') ?></h3>
                <label>
                    <input type="number" name="rodller[cover][posts_per_page]" value="<?php esc_attr_e($cover_options['posts_per_page'], 'rodller') ?>" min="1" max="15">
                </label>
    
                <h3><?php _e('Order By', 'rodller') ?></h3>
                <?php foreach ($order_options as $order_option_key => $order_option_name) :?>
                    <label>
                        <input type="radio" name="rodller[cover][order]" value="<?php echo esc_attr($order_option_key)?>" <?php checked($cover_options['order'], $order_option_key); ?>>
                        <?php echo esc_attr($order_option_name)?>
                    </label>
                    <br>
                <?php endforeach; ?>
    
                <h3><?php _e('Or choose manually', 'rodller') ?></h3>
                <label>
                    <input type="text" name="rodller[cover][manual]" value="<?php esc_attr_e($cover_options['manual'], 'rodller') ?>">
                    <small class="desc"><?php _e('Add post IDs separated by comma, for example "11,15"', 'rodller') ?></small>
                </label>
    
                <h3><?php _e('Sort', 'rodller') ?></h3>
                <?php foreach ($sort_options as $sort_option_key => $sort_option_name) :?>
                    <label>
                        <input type="radio" name="rodller[cover][sort]" value="<?php echo esc_attr($sort_option_key)?>" <?php checked($cover_options['sort'], $sort_option_key); ?>>
                        <?php echo esc_attr($sort_option_name)?>
                    </label>
                    <br>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="half">
            <div class="rodller-watch-for-changes" data-watch="rodller-cover-layout" data-hide-on-value="none,inherit,static">
                <h3><?php esc_html_e('In category', 'rodller') ?></h3>
                <?php if(!empty($categories)): ?>
	                <?php foreach ($categories as $category_id => $category_name) :?>
                        <?php $checked = in_array( $category_id, $cover_options['categories'] ) ? 'checked' : ''; ?>
                        <label>
                            <input type="checkbox" name="rodller[cover][categories][]" value="<?php echo esc_attr($category_id) ?>" <?php echo esc_attr($checked); ?>>
                            <?php echo esc_attr($category_name); ?>
                        </label>
                        <br>
                    <?php endforeach; ?>
                <?php else: ?>
                    <?php _e('There are no categories. Got to Posts -> Categories and add one, it will immediately be shown here.', 'rodller') ?>
                <?php endif; ?>
    
                <h3><?php esc_html_e('Tagged with', 'rodller') ?></h3>
                <label>
                    <input type="text" name="rodller[cover][tagged]" value="<?php esc_attr_e($cover_options['tagged'], 'rodller') ?>">
                    <small><?php esc_attr_e('Specify one or more tags separated by comma. i.e. life, cooking, funny moments. For example "company,sport"', 'rodller') ?></small>
                </label>
    
                <h3><?php esc_html_e('Format', 'rodller') ?></h3>
                <?php foreach ($formats as $formats_id => $formats_name) :?>
                    <label>
                        <input type="radio" name="rodller[cover][format]" value="<?php echo esc_attr($formats_id) ?>" <?php echo checked($cover_options['format'], $formats_id); ?>>
                        <?php echo esc_attr($formats_name); ?>
                    </label>
                    <br>
                <?php endforeach; ?>
    
                <h3><?php esc_html_e('Not older then', 'rodller') ?></h3>
                <?php foreach ($time_diffs as $time_diff_key => $time_diff_name) :?>
                    <label>
                        <input type="radio" name="rodller[cover][time_diff]" value="<?php echo esc_attr($time_diff_key) ?>" <?php echo checked($cover_options['time_diff'], $time_diff_key); ?>>
                        <?php echo esc_attr($time_diff_name); ?>
                    </label>
                    <br>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="clear"></div>
	    <input type="hidden" name="rodller[hide_title]" id="rodller-hide_title" value="<?php echo intval($options['hide_title']); ?>">
        <?php
    }
endif;


/**
 * Single post layout metabox
 *
 * Callback function to create single post layout metabox
 */
if (!function_exists('rodller_single_post_layouts_metabox')) :
	function rodller_single_post_layouts_metabox($object) {
		$meta = rodller_get_metadata($object->ID);
		$layouts = rodller_get_single_post_layout_options(true);
		?>
        <p>
            <span class="rodller-image-radio">
                <?php foreach ( $layouts as $layout_id => $layout_img ) : ?>
                    <label>
                        <input class="rodller-layout" type="radio" name="rodller[layout]" value="<?php echo esc_attr( $layout_id ) ?>" <?php checked( $meta['layout'], $layout_id ); ?>>
                        <img src="<?php echo esc_url( $layout_img ) ?>">
                    </label>
                <?php endforeach; ?>
            </span>
        </p>
		<?php
	}
endif;
