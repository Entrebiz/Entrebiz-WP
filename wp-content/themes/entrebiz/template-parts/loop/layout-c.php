<?php
$sidebar_options = rodller_get_template_sidebar_options();
$image_size = ($sidebar_options['sidebar_active']) ? 'layout-c-sidebar' : 'layout-c';
$page = get_query_var('paged') ? get_query_var('paged') : 1;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($sidebar_options['layout-c_class'] . ' layout-c rodller-post-' .  $page); ?>>
    <?php echo rodller_get_post_metadata('layout_c', array('author', 'date')); ?>

	<?php the_title( sprintf( '<h2 class="rodller-entry-title h3"><a href="%s">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
    
    <div  class="rodller-post-thumbnail rodller-image-zoom-hover">
        <?php if(rodller_get_option('category_layout_c')): ?>
            <?php echo rodller_get_post_categories() ?>
        <?php endif; ?>
        <a href="<?php the_permalink() ?>">
            <img src="<?php echo rodller_get_post_thumbnail($image_size); ?>" alt="<?php echo esc_attr(get_the_title())?>">
            <?php echo rodller_get_post_format_icon('c') ?>
        </a>
    </div>
    <?php echo rodller_get_excerpt(rodller_get_option('text_limit_layout_c')); ?>
    <div class="rodller-metadata"><?php echo rodller_get_post_metadata('layout_c', array('readtime', 'comments', 'addcomment')); ?></div>
</article><!-- #post-## -->