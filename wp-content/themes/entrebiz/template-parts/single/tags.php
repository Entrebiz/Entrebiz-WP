<?php if( rodller_get_option('single_post_tags') && has_tag() ) : ?>
	<div class="rodller-tags">
		<?php the_tags( false, ' ', false ); ?>
	</div>
<?php endif; ?>