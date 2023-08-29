<?php
$sidebar_options = rodller_get_template_sidebar_options();
$page = get_query_var('paged') ? get_query_var('paged') : 1;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($sidebar_options['layout-a_class'] . ' layout-a rodller-post-' . $page); ?>>
    <div  class="rodller-post-thumbnail rodller-image-zoom-hover">
        <?php if(rodller_get_option('category_layout_a')): ?>
            <?php echo rodller_get_post_categories() ?>
        <?php endif; ?>
        <a href="<?php the_permalink() ?>">
            <img src="<?php echo rodller_get_post_thumbnail('layout-a'); ?>" alt="<?php echo esc_attr(get_the_title())?>">
        </a>
	    <?php echo rodller_get_post_format_icon('a'); ?>
    </div>
    <?php echo rodller_get_post_metadata('layout_a', array('author', 'date')); ?>
    
	<?php the_title( sprintf( '<h2 class="rodller-entry-title h3"><a href="%s">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
    
    <?php echo rodller_get_excerpt(rodller_get_option('text_limit_layout_a')); ?>
    <div class="rodller-metadata"><?php echo rodller_get_post_metadata('layout_a', array('readtime', 'comments', 'addcomment')); ?></div>
</article><!-- #post-## -->