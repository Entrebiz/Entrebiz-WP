<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	get_template_part( 'template-parts/single/entry-header' );
	?>
	<div class="rodller-entry-content <?php echo rodller_get_single_container_class(); ?>">
		<?php
  
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
