<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="rodller-entry-content <?php echo rodller_get_single_container_class(); ?>">
		<?php
		
		if ( rodller_get_option( 'single_post_featured_image' ) && has_post_thumbnail() ):
			get_template_part( 'template-parts/single/featured-image' );
		endif;
		
		get_template_part( 'template-parts/single/entry-header' );
		
		the_content();
		
		wp_link_pages( array(
			'before' => '<div id="rodller-pagination" class="rodller-numeric-single">',
			'after'  => '</div>',
		) );
		
		get_template_part( 'template-parts/single/tags' );
		?>
        <hr class="rodller-single-separator">
		<?php
  
		
		get_template_part( 'template-parts/single/author' );
		
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;
		
		get_template_part( 'template-parts/single/prevnext' );
		
		?>
	</div><!-- .rodller-entry-content -->
</article><!-- #post-## -->

<?php
get_template_part( 'template-parts/single/related' );
?>
