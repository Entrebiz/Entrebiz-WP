<div id="rodller-related-posts">
	<?php if ( rodller_get_option( 'related_type' ) != 'none' ): ?>
        <div class="container container-small p0">
			<?php $related = rodller_get_related_posts(); ?>
			
			<?php if ( $related->have_posts() ): ?>

                <h4 class="h1"><?php _e( 'You may also like', 'rodller' ) ?></h4>
                <div class="rodller-posts row">
					<?php
					
					/* Start the Loop */
					while ( $related->have_posts() ) : $related->the_post();
						
						get_template_part( 'template-parts/loop/layout', 'd' );
					
					endwhile;
					?>
                </div>
			
			<?php endif; ?>
        </div>
	<?php endif; ?>
</div>
