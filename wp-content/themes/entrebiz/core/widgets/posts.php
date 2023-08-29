<?php

class rodller_Posts_Widget extends WP_Widget {
	
	var $defaults;
	
	function __construct() {
		$widget_ops  = array(
			'classname'   => 'rodller_posts_widget',
			'description' => esc_html__( 'Display your posts with this widget', 'rodller' ),
		);
		$control_ops = array( 'id_base' => 'rodller_posts_widget' );
		parent::__construct( 'rodller_posts_widget', esc_html__( 'Mummy Blog Posts', 'rodller' ), $widget_ops, $control_ops );
		
		$this->defaults = array(
			'title'       => esc_html__( 'Posts', 'rodller' ),
			'numposts'    => 5,
			'category'    => array(),
			'auto_detect' => 0,
			'orderby'     => 0,
			'time'        => 0,
			'meta'        => array( 'date' ),
			'format'      => 0,
			'manual'      => array(),
			'tag'         => array(),
		);
	}
	
	
	function widget( $args, $instance ) {
		extract( $args );
		$instance = wp_parse_args( (array) $instance, $this->defaults );
		
		echo $before_widget;
		
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		if ( ! empty( $title ) ) {
			$title = $before_title . $title . $after_title;
			
			echo wp_kses_post($title);
		}
		
		$rodller_posts = new WP_Query( $this->get_wp_query_args( $instance ) );
		
		if ( $rodller_posts->have_posts() ): ?>

            <div class="rodller-posts-widget">
				
				<?php $i = 1;
				while ( $rodller_posts->have_posts() ) : $rodller_posts->the_post(); ?>

                    <article <?php post_class( '' ); ?>>
						
                        <div class="rodller-entry-image rodller-image-zoom-hover">
                            <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
                                <img src="<?php echo esc_url(rodller_get_post_thumbnail( 'thumbnail' )); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
                            </a>
                        </div>

                        <div class="rodller-widget-header">
							<?php the_title( sprintf( '<h6><a href="%s">', esc_url( get_permalink() ) ), '</a></h6>' ); ?>
							<?php if ( ! empty( $instance['meta'] ) && $meta = rodller_get_post_metadata( false, $instance['meta'], true ) ) : ?>
                                <?php echo wp_kses_post($meta); ?>
							<?php endif; ?>
                        </div>

                    </article>
					
					<?php $i ++; endwhile; ?>

            </div>
		
		<?php endif; ?>
		
		<?php wp_reset_postdata(); ?>
		
		<?php
		echo $after_widget;
	}
	
	private function get_wp_query_args( $instance ) {
		
		$exclude_id = is_single() ? get_the_ID() : 0;
		
		$q_args = array(
			'post_type'           => 'post',
			'post__not_in'        => array( $exclude_id ),
			'posts_per_page'      => $instance['numposts'],
			'ignore_sticky_posts' => 1,
			'orderby'             => $instance['orderby'],
		);
		
		
		if ( ! empty( $instance['manual'] ) && ! empty( $instance['manual'][0] ) ) {
			$q_args['posts_per_page'] = absint( count( $instance['manual'] ) );
			$q_args['orderby']        = 'post__in';
			$q_args['post__in']       = $instance['manual'];
			$q_args['post_type']      = array_keys( get_post_types( array( 'public' => true ) ) );
			
		} else {
			
			if ( ! empty( $instance['category'] ) ) {
				$q_args['category__in'] = $instance['category'];
			}
			
			if ( ! empty( $instance['tag'] ) ) {
				$q_args['tag_slug__in'] = $instance['tag'];
			}
			
			if ( ! empty( $instance['format'] ) ) {
				
				if ( $instance['format'] == 'all' ) {
					
					$terms   = array();
					$formats = get_theme_support( 'post-formats' );
					if ( ! empty( $formats ) && is_array( $formats[0] ) ) {
						foreach ( $formats[0] as $format ) {
							$terms[] = 'post-format-' . $format;
						}
					}
					$operator = 'NOT IN';
					
				} else {
					$terms    = array( 'post-format-' . $instance['format'] );
					$operator = 'IN';
				}
				
				$q_args['tax_query'] = array(
					array(
						'taxonomy' => 'post_format',
						'field'    => 'slug',
						'terms'    => $terms,
						'operator' => $operator,
					),
				);
			}
			
			if ( $q_args['orderby'] == 'title' ) {
				$q_args['order'] = 'ASC';
			}
			
			
			if ( ! empty( $instance['time'] ) ) {
				$q_args['date_query'] = array(
					'after' => date( 'Y-m-d', rodller_calculate_time_diff( $instance['time'] ) ),
				);
			}
		}
		
		return apply_filters( 'rodller_posts_widget_query_args', $q_args );
	}
	
	
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		
		$instance['title']    = strip_tags( $new_instance['title'] );
		$instance['orderby']  = $new_instance['orderby'];
		$instance['category'] = $new_instance['category'];
		$instance['numposts'] = absint( $new_instance['numposts'] );
		$instance['time']     = $new_instance['time'];
		$instance['meta']     = ! empty( $new_instance['meta'] ) ? $new_instance['meta'] : array();
		$instance['manual']   = ! empty( $new_instance['manual'] ) ? explode( ",", $new_instance['manual'] ) : array();
		$instance['format']   = $new_instance['format'];
		$instance['tag']      = rodller_get_tax_term_slug_by_name( $new_instance['tag'] );
		
		return $instance;
	}
	
	function form( $instance ) {
		
		$instance = wp_parse_args( (array) $instance, $this->defaults ); ?>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'rodller' ); ?>
                :</label>
            <input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" type="text" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat"/>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'numposts' ) ); ?>"><?php esc_html_e( 'Number of posts to show', 'rodller' ); ?>
                :</label>
            <input id="<?php echo esc_attr( $this->get_field_id( 'numposts' ) ); ?>" type="text" name="<?php echo esc_attr( $this->get_field_name( 'numposts' ) ); ?>" value="<?php echo absint( $instance['numposts'] ); ?>" class="small-text"/>
        </p>

        <p>
			<?php $this->widget_meta( $this, $instance['meta'] ); ?>
        </p>

        <p>
			<?php $this->widget_orderby( $this, $instance['orderby'] ); ?>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'manual' ) ); ?>"><?php esc_html_e( 'Or choose manually', 'rodller' ); ?>
                :</label>
            <input id="<?php echo esc_attr( $this->get_field_id( 'manual' ) ); ?>" type="text" name="<?php echo esc_attr( $this->get_field_name( 'manual' ) ); ?>" value="<?php echo esc_attr( implode( ",", $instance['manual'] ) ); ?>" class="widefat"/>
            <small class="howto"><?php esc_html_e( 'Add post IDs separated by comma, for example "11,15"', 'rodller' ); ?></small>
        </p>

        <p>
			<?php $this->widget_tax( $this, 'category', $instance['category'] ); ?>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'tag' ) ); ?>"><?php esc_html_e( 'Tagged with', 'rodller' ); ?>
                :</label>
            <input id="<?php echo esc_attr( $this->get_field_id( 'tag' ) ); ?>" type="text" name="<?php echo esc_attr( $this->get_field_name( 'tag' ) ); ?>" value="<?php echo esc_attr( rodller_get_tax_term_name_by_slug( $instance['tag'] ) ); ?>" class="widefat"/>
            <small class="howto"><?php esc_html_e( 'Specify one or more tags separated by comma. i.e. life, cooking, funny moments', 'rodller' ); ?></small>
        </p>

        <p>
			<?php $this->widget_format( $this, $instance['format'] ); ?>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'time' ) ); ?>"><?php esc_html_e( 'Not older then', 'rodller' ); ?>
                :</label>
            <select id="<?php echo esc_attr( $this->get_field_id( 'time' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'time' ) ); ?>" class="widefat">
				<?php $time = rodller_get_time_diff_opts(); ?>
				<?php foreach ( $time as $key => $value ): ?>
                    <option value="<?php echo esc_attr( $key ); ?>" <?php selected( $instance['time'], $key, true ); ?>><?php echo esc_html( $value ); ?></option>
				<?php endforeach; ?>
            </select>
        </p>
		
		<?php
	}
	
	
	function widget_orderby( $widget_instance = false, $orderby = false ) {
		
		$orders = rodller_get_order_options();
		
		if ( ! empty( $widget_instance ) ) { ?>
            <label for="<?php echo esc_attr( $widget_instance->get_field_id( 'orderby' ) ); ?>"><?php esc_html_e( 'Order by:', 'rodller' ); ?></label>
            <select id="<?php echo esc_attr( $widget_instance->get_field_id( 'orderby' ) ); ?>" name="<?php echo esc_attr( $widget_instance->get_field_name( 'orderby' ) ); ?>" class="widefat">
				<?php foreach ( $orders as $key => $order ) { ?>
                    <option value="<?php echo esc_attr( $key ); ?>" <?php selected( $orderby, $key ); ?>><?php echo esc_html( $order ); ?></option>
				<?php } ?>
            </select>
		<?php }
	}
	
	function widget_format( $widget_instance = false, $format = false ) {
		
		$formats = rodller_get_format_choices();
		
		if ( ! empty( $widget_instance ) ) { ?>
            <label for="<?php echo esc_attr( $widget_instance->get_field_id( 'format' ) ); ?>"><?php esc_html_e( 'Format:', 'rodller' ); ?></label>
            <select id="<?php echo esc_attr( $widget_instance->get_field_id( 'format' ) ); ?>" name="<?php echo esc_attr( $widget_instance->get_field_name( 'format' ) ); ?>" class="widefat">
				<?php foreach ( $formats as $key => $name ) { ?>
                    <option value="<?php echo esc_attr( $key ); ?>" <?php selected( $format, $key ); ?>><?php echo esc_html( $name ); ?></option>
				<?php } ?>
            </select>
		<?php }
	}
	
	function widget_tax( $widget_instance, $taxonomy, $selected_taxonomy = false ) {
		if ( ! empty( $widget_instance ) && ! empty( $taxonomy ) ) {
			$categories = get_terms( $taxonomy, 'orderby=name&hide_empty=0' );
			?>
            <label for="<?php echo esc_attr( $widget_instance->get_field_id( 'category' ) ); ?>"><?php esc_html_e( 'Choose from:', 'rodller' ); ?></label>
            <br/>
			<?php foreach ( $categories as $category ) { ?>
                <input type="checkbox" name="<?php echo esc_attr( $widget_instance->get_field_name( 'category' ) ); ?>[]" value="<?php echo esc_attr( $category->term_id ); ?>" <?php echo in_array( $category->term_id, (array) $selected_taxonomy ) ? 'checked' : '' ?> /> <?php echo esc_html( $category->name ); ?>
                <br/>
			<?php } ?><?php }
	}
	
	function widget_style( $widget_instance = false, $current = false ) {
		
		$styles = array(
			'h' => esc_html__( 'Small (list)', 'rodller' ),
			'g' => esc_html__( 'Large', 'rodller' ),
		);
		
		if ( ! empty( $widget_instance ) ) { ?>
            <label for="<?php echo esc_attr( $widget_instance->get_field_id( 'layout' ) ); ?>"><?php esc_html_e( 'Posts style:', 'rodller' ); ?></label>
            <select id="<?php echo esc_attr( $widget_instance->get_field_id( 'layout' ) ); ?>" name="<?php echo esc_attr( $widget_instance->get_field_name( 'layout' ) ); ?>" class="widefat">
				<?php foreach ( $styles as $id => $title ) { ?>
                    <option value="<?php echo esc_attr( $id ); ?>" <?php selected( $current, $id ); ?>><?php echo wp_kses_post($title); ?></option>
				<?php } ?>
            </select>
		<?php }
	}
	
	function widget_meta( $widget_instance = false, $current = false ) {
		
		$meta = rodller_get_supported_metadata();
		
		if ( ! empty( $widget_instance ) ) : ?>
            <label for="<?php echo esc_attr( $widget_instance->get_field_id( 'meta' ) ); ?>"><?php esc_html_e( 'Display meta data:', 'rodller' ); ?></label>
            <br/>
			<?php foreach ( $meta as $id => $title ) : ?><?php $checked = in_array( $id, $current ) ? 'checked="checked"' : ''; ?>
                <input type="checkbox" id="<?php echo esc_attr( $widget_instance->get_field_id( 'meta' ) ); ?>" name="<?php echo esc_attr( $widget_instance->get_field_name( 'meta' ) ); ?>[]" value="<?php echo esc_attr( $id ); ?>" <?php echo esc_attr($checked); ?>> <?php echo esc_html( $title ); ?>
                <br/>
			<?php endforeach; ?><?php endif; ?><?php }
}

?>
