<header class="rodller-entry-header <?php echo rodller_get_single_container_class(); ?>">
    <div class="rodller-single-categories">
	    <?php if(rodller_get_option('single_post_categories')): ?>
		    <?php echo rodller_get_post_categories(); ?>
	    <?php endif; ?>
    </div>
    <?php the_title( '<h1 class="rodller-entry-title">', '</h1>' ); ?>
    <div class="entry-meta">
		<?php echo rodller_get_post_metadata( 'single_post' ); ?>
    </div><!-- .entry-meta -->
	<?php if ( rodller_get_option( 'single_post_expert' ) && !post_password_required() ): ?>
		<div class="md-single-post-excerpt">
			<?php echo rodller_get_excerpt(rodller_get_option('single_post_text_limit')); ?>
		</div>
	<?php endif; ?>
</header><!-- .entry-header -->
