<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package rodller
 */

get_header(); ?>

	<div id="rodller-primary" class="container">
        <div class="row">
            <main id="rodller-main" class="rodller-single rodller-404 col-md-12" role="main">
                <article class="rodller-404-content">
                    <h1 class="rodller-entry-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'rodller' ); ?></h1>

                    <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'rodller' ); ?></p>
                    <div class="widget widget_search">
	                    <?php get_search_form(); ?>
                    </div>
                    <a class="rodller-button" href="<?php echo esc_url(home_url('/'));?>"><?php _e('Back to home', 'rodller'); ?></a>
                </article>
            </main><!-- #main -->
        </div>
	</div><!-- #primary -->

<?php
get_footer();
