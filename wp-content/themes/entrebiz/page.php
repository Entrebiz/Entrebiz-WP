<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package rodller
 */

get_header(); ?>

<?php get_template_part( 'template-parts/cover/page' ) ?>

<?php $sidebar_options = rodller_get_template_sidebar_options(); ?>

    <div id="rodller-primary" class="<?php echo (esc_attr($sidebar_options['sidebar_position']) != 'none') ? 'container' : ''; ?>">
        
        <div class="<?php echo (esc_attr($sidebar_options['sidebar_position']) != 'none') ? 'row' : ''; ?>">
	        <?php if(rodller_get_metadata(get_queried_object_id(),'hide_title') !== "1"): ?>
		        <div class="col-12">
			        <?php get_template_part( 'template-parts/ads/below-header' ) ?>

			        <div class="centered <?php echo rodller_get_single_container_class(); ?>">
				        <?php the_title( '<h1 id="rodller-primary-title">', '</h1>' ); ?>
			        </div>
		        </div>
	        <?php endif; ?>

            <?php if ( $sidebar_options['sidebar_position'] == 'left' ) {
				get_sidebar();
			} ?>

            <main id="rodller-main" class="rodller-single <?php echo esc_attr( $sidebar_options['main_class'] ); ?>" role="main">
				
				<?php get_template_part( 'template-parts/ads/before-content' ) ?>
				
				<?php
				while ( have_posts() ) : the_post();
					
					get_template_part( 'template-parts/single/page' );
					
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						?>
                        <div class="container">
							<?php comments_template(); ?>
                        </div>
					<?php
					endif;
				
				endwhile; // End of the loop.
				?>
				
				<?php get_template_part( 'template-parts/ads/after-content' ) ?>

            </main><!-- #main -->
			
			<?php if ( $sidebar_options['sidebar_position'] == 'right' ) {
				get_sidebar();
			} ?>

        </div>
    </div><!-- #primary -->

<?php
get_footer();
