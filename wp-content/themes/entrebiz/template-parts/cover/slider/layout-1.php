<div class="rodller-cover-slider-item">
    <div class="rodller-cover-slider-item-img">
        <a href="<?php the_permalink(); ?>">
            <img src="<?php echo rodller_get_post_thumbnail('cover'); ?>" alt="<?php echo esc_attr(get_the_title()) ?>">
        </a>
    </div>
    <div class="rodller-cover-slider-item-content-wrapper">
        <div class="container centered">
            <div class="rodller-cover-slider-item-content">
	            <?php echo rodller_get_post_metadata('cover'); ?>
	            <?php the_title( sprintf( '<a href="%s"><h2 class="h1 rodller-cover-slider-item-content-title">', esc_url( get_permalink() ) ), '</h2></a>' ); ?>
                <?php if (rodller_get_option('cover_show_text')): ?>
                    <?php echo rodller_get_excerpt(); ?>
                <?php endif; ?>
	            <?php if (rodller_get_option('cover_show_button')): ?>
                    <a href="<?php the_permalink(); ?>" class="rodller-button"><?php _e('Read more', 'rodller') ?></a>
	            <?php endif; ?>
            </div>
        </div>
    </div>
</div>