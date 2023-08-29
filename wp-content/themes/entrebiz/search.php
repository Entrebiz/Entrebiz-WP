<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package rodller
 */

get_header(); ?>
    <div id="rodller-primary" class="container">
		<?php get_template_part( 'template-parts/ads/below-header' ) ?>
		
		<?php $sidebar_options = rodller_get_template_sidebar_options(); ?>

        <div class="<?php echo ( esc_attr($sidebar_options['sidebar_position'] != 'none') ) ? 'row' : ''; ?>">

            <h1 id="rodller-primary-title" class="<?php echo ( esc_attr($sidebar_options['sidebar_position']) != 'none' ) ? 'col-12' : ''; ?>">
				<?php printf( esc_html__( 'Search Results for: %s', 'rodller' ), '<span>' . get_search_query() . '</span>' ); ?>
            </h1>
			
			<?php if ( $sidebar_options['sidebar_position'] == 'left' ): ?>
                <?php get_sidebar(); ?>
            <?php endif; ?>

            <main id="rodller-main" class="<?php echo esc_attr( $sidebar_options['main_class'] ); ?>" role="main">
				
				<?php
				if ( have_posts() ) :
					?>
                    <section class="rodller-posts row">
						<?php
						
						/* Start the Loop */
						while ( have_posts() ) : the_post();
							
							get_template_part( 'template-parts/loop/layout', rodller_get_option( rodller_detect_template() . '_layout' ) );
						
						endwhile;
						?>
                    </section>
					<?php
					get_template_part( 'template-parts/pagination/' . rodller_get_pagination_type() );
				else :
					get_template_part( 'template-parts/content', 'none' );
				endif; ?>
            </main><!-- #main -->
			
			<?php if ( $sidebar_options['sidebar_position'] == 'right' ): ?>
                <?php get_sidebar(); ?>
            <?php endif; ?>

        </div>
    </div><!-- #primary -->
<?php
get_footer();
