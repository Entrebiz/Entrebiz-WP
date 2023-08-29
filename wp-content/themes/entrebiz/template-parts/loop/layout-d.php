<?php
$sidebar_options = rodller_get_template_sidebar_options();
$page = get_query_var('paged') ? get_query_var('paged') : 1;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($sidebar_options['layout-d_class'] . ' layout-d rodller-post-' .  $page); ?>>
    <div  class="rodller-post-thumbnail rodller-image-zoom-hover">
        <?php if(rodller_get_option('category_layout_d')): ?>
            <?php echo rodller_get_post_categories() ?>
        <?php endif; ?>
        <a href="<?php the_permalink() ?>">
            <img src="<?php echo rodller_get_post_thumbnail('layout-d'); ?>" alt="<?php echo esc_attr(get_the_title())?>">
            <?php echo rodller_get_post_format_icon('d'); ?>
        </a>
    </div>
    <div class="rodller-post-content">
        <?php echo rodller_get_post_metadata('layout_d', array('author', 'date')); ?>
        
	    <?php the_title( sprintf( '<h2 class="rodller-entry-title h3"><a href="%s">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
        
        <?php echo rodller_get_excerpt(rodller_get_option('text_limit_layout_d')); ?>
        <div class="rodller-metadata"><?php echo rodller_get_post_metadata('layout_d', array('readtime', 'comments', 'addcomment')); ?></div>
    </div>
</article><!-- #post-## -->