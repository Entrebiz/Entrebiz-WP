<?php


/**
 * TODO
 */
add_filter( 'rodller_blocks_modify_editor_js_settings', 'rodller_add_post_layouts_to_rodller_posts_block' );
if ( ! function_exists( 'rodller_add_post_layouts_to_rodller_posts_block' ) ):
	function rodller_add_post_layouts_to_rodller_posts_block( $settings ) {

		$settings['layouts'] = rodller_get_post_layouts( true );
		
		return $settings;
	}
endif;



remove_action( 'rodller_posts_block_render_html', 'rodller_blocks_posts_block_render_html', 10 );
add_action( 'rodller_posts_block_render_html', 'rodller_rodller_posts_block_render_html', 10, 4 );
if ( ! function_exists( 'rodller_rodller_posts_block_render_html' ) ):
	function rodller_rodller_posts_block_render_html( $attributes, $posts_query, $page, $options  ) {
		
		if( $posts_query->have_posts() ) :
			?>
			<section class="rodller-posts row">
			<?php
			while ( $posts_query->have_posts() ) :
				$posts_query->the_post();
				
				include locate_template('template-parts/loop/layout-' . $attributes['layout'] . '.php');
			endwhile;
			
			if ( $posts_query->found_posts > intval( $attributes['postsToShow'] ) &&  $attributes['displayLoadMore'] ) :
					echo '<li class="rodller-blocks-load-more-button-wrapper"><a href="javascript:void(0)" data-attributes="' . esc_attr( json_encode( $attributes ) ) . '" data-paged="1" data-found="' . intval($posts_query->found_posts) . '" class="rodller-blocks-load-more-button rodller-button">' . __( 'Load More', 'rodller-blocks' ) . '</a></li>';
			endif;
			?>
			</section>
			<?php
			
			wp_reset_postdata();
		endif;
	}
endif;
