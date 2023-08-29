<?php
$cover_posts = rodller_get_category_cover_query( $cover_options, $id );
if ( $cover_posts->have_posts() ): ?>
	<?php $slider_classes = $cover_posts->found_posts == 1 ? '' : 'rodller-cover-slider owl-carousel'; ?>
    <div id="rodller-cover" class="<?php echo esc_attr($slider_classes); ?> rodller-cover-layout-<?php echo esc_attr( $cover_options['layout'] ); ?>">
		<?php while ( $cover_posts->have_posts() ) : $cover_posts->the_post();
			get_template_part( 'template-parts/cover/slider/layout', $cover_options['layout'] );
		endwhile; // End of the loop. ?>
    </div>
<?php
endif;
wp_reset_postdata(); ?>
    