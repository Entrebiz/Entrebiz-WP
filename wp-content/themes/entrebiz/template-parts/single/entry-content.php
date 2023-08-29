<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="rodller-entry-header <?php echo rodller_get_single_container_class(); ?>">
		<?php the_title( '<h1 class="rodller-entry-title">', '</h1>' ); ?>
    </header><!-- .entry-header -->

    <div class="rodller-entry-content <?php echo rodller_get_single_container_class(); ?>">
		<?php
	
		the_content();
		
		?>
	</div><!-- .rodller-entry-content -->
</article><!-- #post-## -->