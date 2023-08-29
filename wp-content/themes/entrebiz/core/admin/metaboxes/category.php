<?php

/**
 * Save category meta
 *
 * Callback function to save category meta data
 *
 * @since  1.0
 */
add_action( 'edited_category', 'rodller_save_category_meta_fields', 10, 2 );
add_action( 'create_category', 'rodller_save_category_meta_fields', 10, 2 );
if ( !function_exists( 'rodller_save_category_meta_fields' ) ):
	function rodller_save_category_meta_fields( $term_id ) {
		
		if ( isset( $_POST['rodller'] ) ) {
			
			$rodller_meta = array();
			
			if ( !empty( $_POST['rodller']['cover'] ) ) {
				foreach ( $_POST['rodller']['cover'] as $key => $value ) {
					$rodller_meta['cover'][ $key ] = $value;
				}
			}
			
			if ( isset( $_POST['rodller']['image'] ) ) {
				$rodller_meta['image'] = $_POST['rodller']['image'];
			}
			
			if(isset($_POST['rodller']['display_settings']) && $_POST['rodller']['display_settings'] == 'custom'){
				
			    $rodller_meta['display_settings'] = 'custom';
			    
			    if(isset($_POST['rodller']['sidebar_position']) && !empty($_POST['rodller']['sidebar_position']) && $_POST['rodller']['sidebar_position'] != 'none'){
				    $rodller_meta['sidebar_position'] = sanitize_text_field($_POST['rodller']['sidebar_position']);
				
				    if(isset($_POST['rodller']['sidebar'])){
					    $rodller_meta['sidebar'] = sanitize_text_field($_POST['rodller']['sidebar']);
				    }
				
				    if(isset($_POST['rodller']['sticky_sidebar'])){
					    $rodller_meta['sticky_sidebar'] = sanitize_text_field($_POST['rodller']['sticky_sidebar']);
				    }
                }else{
				    $rodller_meta['sidebar_position'] = 'none';
                }
				
				if(isset($_POST['rodller']['layout'])){
					$rodller_meta['layout'] = sanitize_text_field($_POST['rodller']['layout']);
				}
				
				if(isset($_POST['rodller']['ppp'])){
				    $ppp = absint($_POST['rodller']['ppp']);
					$ppp = $ppp < 50 ? $ppp : 50;
					$ppp = $ppp < 1 ? 1 : $ppp;
					$rodller_meta['ppp'] = $ppp;
				}
				
				if(isset($_POST['rodller']['pagination'])){
					$rodller_meta['pagination'] = sanitize_text_field($_POST['rodller']['pagination']);
				}
				
			}
			
			if ( !empty( $rodller_meta ) ) {
				update_term_meta( $term_id, '_rodller_meta', $rodller_meta );
			} else {
				delete_term_meta( $term_id, '_rodller_meta' );
			}
			
		}
	}
endif;


/**
 * Add category meta
 *
 * Callback function to load category meta fields on "new category" screen
 *
 * @since  1.0
 */

add_action( 'category_add_form_fields', 'rodller_category_add_meta_fields', 10, 2 );

if ( !function_exists( 'rodller_category_add_meta_fields' ) ) :
	function rodller_category_add_meta_fields() {
		
		$meta_data = rodller_get_category_metadata();
		$cover_options = $meta_data['cover'];
		$cover_layouts = rodller_get_cover_layouts( true );
		$order_options = rodller_get_order_options();
		$sort_options = rodller_get_sorting_options();
		$sidebar_positions = rodller_get_sidebar_positions();
		$sidebars = rodller_get_registered_sidebars();
		$post_layouts = rodller_get_post_layouts();
		$pagination_types = rodller_get_pagination_options();
		?>
        <div class="form-field">
            <h4><?php esc_html_e( 'Cover settings', 'rodller' ); ?></h4>
            <label><?php _e( 'Layout', 'rodller' ) ?></label>
            <div class="rodller-image-radio">
				<?php foreach ( $cover_layouts as $cover_layout_id => $cover_layout ) : ?>
                    <label>
                        <input class="rodller-cover-layout" type="radio" name="rodller[cover][layout]" value="<?php echo esc_attr( $cover_layout_id ) ?>" <?php checked( $cover_options['layout'], $cover_layout_id ); ?>>
                        <img src="<?php echo esc_attr( $cover_layout ) ?>">
                    </label>
				<?php endforeach; ?>
            </div>
        </div>

        <div class="form-field rodller-watch-for-changes" data-watch="rodller-cover-layout" data-hide-on-value="none,inherit">
            <label><?php _e( 'Posts per page number', 'rodller' ) ?></label>
            <label>
                <input type="number" name="rodller[cover][posts_per_page]" value="<?php esc_attr_e( $cover_options['posts_per_page'], 'rodller' ) ?>" min="1" max="30">
            </label>
        </div>

        <div class="form-field rodller-watch-for-changes" data-watch="rodller-cover-layout" data-hide-on-value="none,inherit">
            <label><?php _e( 'Order by', 'rodller' ) ?></label>
			<?php foreach ( $order_options as $order_option_key => $order_option_name ) : ?>
                <label>
                    <input type="radio" name="rodller[cover][order]" value="<?php echo esc_attr( $order_option_key ) ?>" <?php checked( $cover_options['order'], $order_option_key ); ?>>
					<?php echo esc_attr( $order_option_name ) ?>
                </label>
			<?php endforeach; ?>
        </div>

        <div class="form-field rodller-watch-for-changes" data-watch="rodller-cover-layout" data-hide-on-value="none,inherit">
            <label><?php _e( 'Sort', 'rodller' ) ?></label>
			<?php foreach ( $sort_options as $sort_option_key => $sort_option_name ) : ?>
                <label>
                    <input type="radio" name="rodller[cover][sort]" value="<?php echo esc_attr( $sort_option_key ) ?>" <?php checked( $cover_options['sort'], $sort_option_key ); ?>>
					<?php echo esc_attr( $sort_option_name ) ?>
                </label>
			<?php endforeach; ?>
        </div>

        <div class="form-field">
            <h4><?php esc_html_e( 'Design settings', 'rodller' ); ?></h4>
            <label><?php esc_html_e( 'Image', 'rodller' ); ?></label>
			<?php
			$display = !empty($meta_data['image']) ? 'initial' : 'none';
			$image_obj = wp_get_attachment_image_src($meta_data['image'], 'medium');
			$image_src = !empty($image_obj[0]) ? $image_obj[0] : '';
			?>
            <p>
                <img id="rodller-image-preview" src="<?php echo esc_url( $image_src ); ?>" style="width: 300px;  border: 2px solid #ebebeb; display:<?php echo esc_attr( $display ); ?>;">
            </p>
            <p>
                <input type="hidden" name="rodller[image]" id="rodller-image-url" value="<?php echo esc_attr( $meta_data['image'] ); ?>"/>
                <input type="button" id="rodller-image-upload" class="button-secondary" value="<?php _e( 'Upload', 'rodller' ); ?>"/>
                <input type="button" id="rodller-image-clear" class="button-secondary" value="<?php _e( 'Clear', 'rodller' ); ?>" style="display:<?php echo esc_attr( $display ); ?>"/>
            </p>
            <p class="description"><?php _e( 'Upload an image for this category', 'rodller' ); ?></p>
        </div>

        <div class="form-field">
            <label><?php esc_html_e( 'Display settings', 'rodller' ); ?></label>
            <label>
                <input class="rodller-display-settings" type="radio" name="rodller[display_settings]" value="inherit" <?php checked( $meta_data['display_settings'], 'inherit' ); ?>>
				<?php esc_html_e( 'Inherit from theme options', 'rodller' ); ?>
            </label>
            <label>
                <input class="rodller-display-settings" type="radio" name="rodller[display_settings]" value="custom" <?php checked( $meta_data['display_settings'], 'custom' ); ?>>
				<?php esc_html_e( 'Customize', 'rodller' ); ?>
            </label>
        </div>


        <div class="form-field rodller-watch-for-changes" data-watch="rodller-display-settings" data-hide-on-value="inherit">
            <label><?php esc_html_e( 'Sidebar Position', 'rodller' ); ?></label>
            <div class="rodller-image-radio">
                <?php foreach ( $sidebar_positions as $sidebar_position_id => $sidebar_position ) : ?>
                    <label>
                        <input class="rodller-sidebar-position" type="radio" name="rodller[sidebar_position]" value="<?php echo esc_attr( $sidebar_position_id ) ?>" <?php checked( $meta_data['sidebar_position'], $sidebar_position_id ); ?>>
                        <img src="<?php echo esc_url( $sidebar_position ) ?>">
                    </label>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="form-field rodller-watch-for-changes" data-watch="rodller-display-settings" data-hide-on-value="inherit">
            <div class="rodller-watch-for-changes" data-watch="rodller-sidebar-position" data-hide-on-value="none">
                <label><?php esc_html_e( 'Static sidebar', 'rodller' ); ?></label>
                <label>
                    <select name="rodller[sidebar]">
                        <?php foreach ($sidebars as $sidebar_id => $sidebar_name) :?>
                            <option value="<?php echo esc_attr($sidebar_id) ?>" <?php selected($meta_data['sidebar'], $sidebar_id); ?>><?php echo esc_attr($sidebar_name); ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
            </div>
        </div>


        <div class="form-field rodller-watch-for-changes" data-watch="rodller-display-settings" data-hide-on-value="inherit">
            <div class="rodller-watch-for-changes" data-watch="rodller-sidebar-position" data-hide-on-value="none">
                <label for="rodller-sticky-sidebar"><?php esc_html_e( 'Sticky sidebar', 'rodller' ); ?></label>
                <select id="rodller-sticky-sidebar" name="rodller[sticky_sidebar]">
                    <?php foreach ($sidebars as $sticky_sidebar_id => $sticky_sidebar_name) :?>
                        <option value="<?php echo esc_attr($sticky_sidebar_id) ?>" <?php selected($meta_data['sticky_sidebar'], $sticky_sidebar_id); ?>><?php echo esc_attr($sticky_sidebar_name); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="form-field rodller-watch-for-changes" data-watch="rodller-display-settings" data-hide-on-value="inherit">
            <label><?php esc_html_e( 'Post Layout', 'rodller' ); ?></label>
            <div class="rodller-image-radio">
                <?php foreach ( $post_layouts as $post_layout_id => $post_layout_img ) : ?>
                    <label>
                        <input type="radio" name="rodller[layout]" value="<?php echo esc_attr( $post_layout_id ) ?>" <?php checked( $meta_data['layout'], $post_layout_id ); ?>>
                        <img src="<?php echo esc_url( $post_layout_img ) ?>">
                    </label>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="form-field rodller-watch-for-changes" data-watch="rodller-display-settings" data-hide-on-value="inherit">
            <label><?php esc_html_e( 'Posts per page', 'rodller' ); ?></label>
            <label>
                <input type="number" name="rodller[ppp]" min="1" max="50" value="<?php echo absint($meta_data['ppp']); ?>">
            </label>
        </div>

        <div class="form-field rodller-watch-for-changes" data-watch="rodller-display-settings" data-hide-on-value="inherit">
            <label><?php esc_html_e( 'Pagination', 'rodller' ); ?></label>
            <div class="rodller-image-radio">
                <?php foreach ( $pagination_types as $pagination_type_id => $pagination_type_img ) : ?>
                    <label>
                        <input type="radio" name="rodller[pagination]" value="<?php echo esc_attr( $pagination_type_id ) ?>" <?php checked( $meta_data['pagination'], $pagination_type_id ); ?>>
                        <img src="<?php echo esc_url( $pagination_type_img ) ?>">
                    </label>
                <?php endforeach; ?>
            </div>
        </div>
		<?php
	}
endif;

/**
 * Delete category meta
 *
 * Delete our custom category meta from database on category deletion
 *
 * @return  void
 * @since  1.0
 */

add_action( 'category_edit_form_fields', 'rodller_category_edit_meta_fields', 10, 2 );

if ( !function_exists( 'rodller_category_edit_meta_fields' ) ):
	function rodller_category_edit_meta_fields( $term ) {
		
		$meta_data = rodller_get_category_metadata( $term->term_id );
		$cover_options = $meta_data['cover'];
		$cover_layouts = rodller_get_cover_layouts( true );
		$order_options = rodller_get_order_options();
		$sort_options = rodller_get_sorting_options();
		$sidebar_positions = rodller_get_sidebar_positions();
		$sidebars = rodller_get_registered_sidebars();
		$post_layouts = rodller_get_post_layouts();
		$pagination_types = rodller_get_pagination_options();
		?>
        <tr class="form-field">
            <th scope="row" valign="top">
                <h2><label><?php _e( 'Cover settings', 'rodller' ) ?></label></h2>
            </th>
        </tr>
        <tr class="form-field">
            <th scope="row" valign="top">
                <label><?php _e( 'Layout', 'rodller' ) ?></label>
            </th>
            <td>
                <div class="rodller-image-radio">
					<?php foreach ( $cover_layouts as $cover_layout_id => $cover_layout ) : ?>
                        <label>
                            <input class="rodller-cover-layout" type="radio" name="rodller[cover][layout]" value="<?php echo esc_attr( $cover_layout_id ) ?>" <?php checked( $cover_options['layout'], $cover_layout_id ); ?>>
                            <img src="<?php echo esc_url( $cover_layout ) ?>">
                        </label>
					<?php endforeach; ?>
                </div>
            </td>
        </tr>

        <tr class="form-field rodller-watch-for-changes" data-watch="rodller-cover-layout" data-hide-on-value="none,inherit">
            <th scope="row" valign="top">
                <label><?php _e( 'Posts per page number', 'rodller' ) ?></label>
            </th>
            <td>
                <label>
                    <input type="number" name="rodller[cover][posts_per_page]" value="<?php esc_attr_e( $cover_options['posts_per_page'], 'rodller' ) ?>" min="1" max="15">
                </label>
            </td>
        </tr>

        <tr class="form-field rodller-watch-for-changes" data-watch="rodller-cover-layout" data-hide-on-value="none,inherit">
            <th scope="row" valign="top">
                <label><?php _e( 'Order by', 'rodller' ) ?></label>
            </th>
            <td>
				<?php foreach ( $order_options as $order_option_key => $order_option_name ) : ?>
                    <label>
                        <input type="radio" name="rodller[cover][order]" value="<?php echo esc_attr( $order_option_key ) ?>" <?php checked( $cover_options['order'], $order_option_key ); ?>>
						<?php echo esc_attr( $order_option_name ) ?>
                    </label><br>
				<?php endforeach; ?>
            </td>
        </tr>

        <tr class="form-field rodller-watch-for-changes" data-watch="rodller-cover-layout" data-hide-on-value="none,inherit">
            <th scope="row" valign="top">
                <label><?php _e( 'Sort', 'rodller' ) ?></label>
            </th>
            <td>
				<?php foreach ( $sort_options as $sort_option_key => $sort_option_name ) : ?>
                    <label>
                        <input type="radio" name="rodller[cover][sort]" value="<?php echo esc_attr( $sort_option_key ) ?>" <?php checked( $cover_options['sort'], $sort_option_key ); ?>>
						<?php echo esc_attr( $sort_option_name ) ?>
                    </label><br>
				<?php endforeach; ?>
            </td>
        </tr>

        <tr class="form-field">
            <th scope="row" valign="top">
                <h2><label><?php _e( 'Design settings', 'rodller' ) ?></label></h2>
            </th>
        </tr>

        <tr class="form-field">
            <th scope="row" valign="top">
                <label><?php _e( 'Image', 'rodller' ); ?></label>
            </th>
            <td>
				<?php
				$display = !empty($meta_data['image']) ? 'initial' : 'none';
				$image_obj = wp_get_attachment_image_src($meta_data['image'], 'medium');
				$image_src = !empty($image_obj[0]) ? $image_obj[0] : '';
                ?>
                <p>
                    <img id="rodller-image-preview" src="<?php echo esc_url( $image_src ); ?>" style="width: 300px;  border: 2px solid #ebebeb; display:<?php echo esc_attr( $display ); ?>;">
                </p>

                <p>
                    <input type="hidden" name="rodller[image]" id="rodller-image-url" value="<?php echo esc_attr( $meta_data['image'] ); ?>"/>
                    <input type="button" id="rodller-image-upload" class="button-secondary" value="<?php _e( 'Upload', 'rodller' ); ?>"/>
                    <input type="button" id="rodller-image-clear" class="button-secondary" value="<?php _e( 'Clear', 'rodller' ); ?>" style="display:<?php echo esc_attr( $display ); ?>"/>
                </p>

                <p class="description"><?php _e( 'Upload an image for this category', 'rodller' ); ?></p>
            </td>
        </tr>

        <tr>
            <th scope="row" valign="top">
                <h2><label><?php _e( 'Display settings', 'rodller' ) ?></label></h2>
            </th>
        </tr>

        <tr>
            <th scope="row" valign="top">
                <label><?php esc_html_e( 'Type', 'rodller' ); ?></label>
            </th>
            <td>
                <label>
                    <input type="radio" class="rodller-display-settings" name="rodller[display_settings]" value="inherit" <?php checked( $meta_data['display_settings'], 'inherit' ); ?>>
                    <?php esc_html_e( 'Inherit from theme options', 'rodller' ); ?>
                </label>
                <br>
                <label>
                    <input type="radio" class="rodller-display-settings" name="rodller[display_settings]" value="custom" <?php checked( $meta_data['display_settings'], 'custom' ); ?>>
                    <?php esc_html_e( 'Customize', 'rodller' ); ?>
                </label>
            </td>
        </tr>

        <tr class="form-field rodller-watch-for-changes" data-watch="rodller-display-settings" data-hide-on-value="inherit">
            <th scope="row" valign="top">
                <label><?php esc_html_e( 'Sidebar Position', 'rodller' ); ?></label>
            </th>
            <td>
                <div class="rodller-image-radio">
		            <?php foreach ( $sidebar_positions as $sidebar_position_id => $sidebar_position ) : ?>
                        <label>
                            <input class="rodller-sidebar-position" type="radio" name="rodller[sidebar_position]" value="<?php echo esc_attr( $sidebar_position_id ) ?>" <?php checked( $meta_data['sidebar_position'], $sidebar_position_id ); ?>>
                            <img src="<?php echo esc_url( $sidebar_position ) ?>">
                        </label>
		            <?php endforeach; ?>
                </div>
            </td>
        </tr>

        <tr class="form-field rodller-watch-for-changes" data-watch="rodller-display-settings" data-hide-on-value="inherit">
            <th scope="row" valign="top" class="rodller-watch-for-changes" data-watch="rodller-sidebar-position" data-hide-on-value="none,inherit">
                <label><?php esc_html_e( 'Static sidebar', 'rodller' ); ?></label>
            </th>
            <td class="rodller-watch-for-changes" data-watch="rodller-sidebar-position" data-hide-on-value="none,inherit">
                <label>
                    <select name="rodller[sidebar]">
                        <?php foreach ($sidebars as $sidebar_id => $sidebar_name) :?>
                            <option value="<?php echo esc_attr($sidebar_id) ?>" <?php selected($meta_data['sidebar'], $sidebar_id); ?>><?php echo esc_attr($sidebar_name); ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
            </td>
        </tr>


        <tr class="form-field rodller-watch-for-changes" data-watch="rodller-display-settings" data-hide-on-value="inherit">
            <th scope="row" valign="top" class="rodller-watch-for-changes" data-watch="rodller-sidebar-position" data-hide-on-value="none,inherit">
                <label><?php esc_html_e( 'Sticky sidebar', 'rodller' ); ?></label>
            </th>
            <td class="rodller-watch-for-changes" data-watch="rodller-sidebar-position" data-hide-on-value="none,inherit">
                <label>
                    <select name="rodller[sticky_sidebar]">
                        <?php foreach ($sidebars as $sticky_sidebar_id => $sticky_sidebar_name) :?>
                            <option value="<?php echo esc_attr($sticky_sidebar_id) ?>" <?php selected($meta_data['sticky_sidebar'], $sticky_sidebar_id); ?>><?php echo esc_attr($sticky_sidebar_name); ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
            </td>
        </tr>

        <tr class="form-field rodller-watch-for-changes" data-watch="rodller-display-settings" data-hide-on-value="inherit">
            <th scope="row" valign="top">
                <label><?php esc_html_e( 'Post Layout', 'rodller' ); ?></label>
            </th>
            <td>
                <div class="rodller-image-radio">
					<?php foreach ( $post_layouts as $post_layout_id => $post_layout_img ) : ?>
                        <label>
                            <input type="radio" name="rodller[layout]" value="<?php echo esc_attr( $post_layout_id ) ?>" <?php checked( $meta_data['layout'], $post_layout_id ); ?>>
                            <img src="<?php echo esc_url( $post_layout_img ) ?>">
                        </label>
					<?php endforeach; ?>
                </div>
            </td>
        </tr>

        <tr class="form-field rodller-watch-for-changes" data-watch="rodller-display-settings" data-hide-on-value="inherit">
            <th scope="row" valign="top">
                <label><?php esc_html_e( 'Posts per page', 'rodller' ); ?></label>
            </th>
            <td>
                <label>
                    <input type="number" name="rodller[ppp]" min="1" max="50" value="<?php echo absint($meta_data['ppp']); ?>">
                </label>
            </td>
        </tr>

        <tr class="form-field rodller-watch-for-changes" data-watch="rodller-display-settings" data-hide-on-value="inherit">
            <th scope="row" valign="top">
                <label><?php esc_html_e( 'Pagination', 'rodller' ); ?></label>
            </th>
            <td>
                <div class="rodller-image-radio">
					<?php foreach ( $pagination_types as $pagination_type_id => $pagination_type_img ) : ?>
                        <label>
                            <input type="radio" name="rodller[pagination]" value="<?php echo esc_attr( $pagination_type_id ) ?>" <?php checked( $meta_data['pagination'], $pagination_type_id ); ?>>
                            <img src="<?php echo esc_url( $pagination_type_img ) ?>">
                        </label>
					<?php endforeach; ?>
                </div>
            </td>
        </tr>
		<?php
	}
endif;