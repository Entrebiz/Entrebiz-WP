<?php
$sidebar_options = rodller_get_template_sidebar_options();
$page = get_query_var('paged') ? get_query_var('paged') : 1;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($sidebar_options['layout-b_class'] . ' layout-b rodller-post-' . $page); ?>>
    <div  class="rodller-post-thumbnail rodller-image-zoom-hover">
        <?php if(rodller_get_option('category_layout_b')): ?>
            <?php echo rodller_get_post_categories() ?>
        <?php endif; ?>
        <a href="<?php the_permalink() ?>">
            <img src="<?php echo rodller_get_post_thumbnail('layout-b'); ?>" alt="<?php echo esc_attr(get_the_title())?>" class="obj-fit">
        </a>
        <?php echo rodller_get_post_format_icon('b') ?>
    </div>
    <?php echo rodller_get_post_metadata('layout_b', array('author', 'date')); ?>

	<?php the_title( sprintf( '<h2 class="rodller-entry-title h3"><a href="%s">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

    <?php echo rodller_get_excerpt(rodller_get_option('text_limit_layout_b')); ?>
    <div class="rodller-metadata"><?php echo rodller_get_post_metadata('layout_b', array('readtime', 'comments', 'addcomment')); ?></div>
</article><!-- #post-## -->