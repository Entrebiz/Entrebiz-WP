<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package rodller
 */

get_header(); ?>

<?php if(is_category()): ?>
	<?php get_template_part('template-parts/cover/category') ?>
<?php endif; ?>

    <div id="rodller-primary" class="container">
        
        <?php get_template_part('template-parts/ads/below-header') ?>
	
	    <?php $sidebar_options = rodller_get_template_sidebar_options(); ?>

        <div class="<?php echo (esc_attr($sidebar_options['sidebar_position']) != 'none') ? 'row' : ''; ?>">

            <h1 id="rodller-primary-title" class="<?php echo ( esc_attr($sidebar_options['sidebar_position']) != 'none' ) ? 'col-12' : ''; ?>">
		        <?php echo rodller_get_archive_title(); ?>
            </h1>

            <?php if($sidebar_options['sidebar_position'] == 'left'): ?>
	            <?php get_sidebar(); ?>
            <?php endif; ?>

            <main id="rodller-main" class="<?php echo esc_attr($sidebar_options['main_class']); ?>" role="main">

                <?php
                if (have_posts()) :
                    ?>
                    <section class="rodller-posts row">
                        <?php

                        /* Start the Loop */
                        while (have_posts()) : the_post();

                            get_template_part('template-parts/loop/layout', rodller_get_archive_layout());

                        endwhile;
                        ?>
                    </section>
                    <?php
                    get_template_part('template-parts/pagination/' . rodller_get_pagination_type());
                else :
                    get_template_part('template-parts/content', 'none');
                endif; ?>
            </main><!-- #main -->
            
	        <?php if($sidebar_options['sidebar_position'] == 'right'): ?>
		        <?php get_sidebar(); ?>
	        <?php endif; ?>
        
        </div>
    </div><!-- #primary -->

<?php
get_footer();
