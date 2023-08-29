<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package rodller
 */
get_header();
$sidebar_options = rodller_get_template_sidebar_options(); ?><?php
$layout = rodller_get_single_post_layout( get_queried_object_id() );
if ( $layout == 3 ) {
	if ( rodller_get_option( 'single_post_featured_image' ) && has_post_thumbnail() ):
		get_template_part( 'template-parts/cover/post' );
	endif;
}
?>
    <div id="rodller-primary" class="rodller-single-layout-<?php echo esc_attr( $layout ); ?> <?php echo (esc_attr($sidebar_options['sidebar_position']) != 'none') ? 'container' : ''; ?>">

        <div class="<?php echo (esc_attr($sidebar_options['sidebar_position']) != 'none') ? 'row' : ''; ?>">
			
            <div class="col-12">
                <?php get_template_part( 'template-parts/ads/below-header' ); ?>
            </div>
            
			<?php if ( $sidebar_options['sidebar_position'] == 'left' ) {
				get_sidebar();
			} ?>

            <main id="rodller-main" class="rodller-single <?php echo esc_attr( $sidebar_options['main_class'] ); ?>" role="main">
	            <?php
                
				while ( have_posts() ) : the_post();
					if ( get_post_type() == 'post' ) {
						include locate_template( 'template-parts/single/post/layout-' . $layout . '.php' );
					} else {
						include locate_template( 'template-parts/single/entry-content.php' );
					}
				endwhile; // End of the loop.
				?>
	
	            <?php get_template_part( 'template-parts/ads/after-content' ) ?>
            </main><!-- #rodller-main -->
			
			<?php if ( $sidebar_options['sidebar_position'] == 'right' ) {
				get_sidebar();
			} ?>

        </div>
    </div><!-- #rodller-primary -->

<?php
get_sidebar();
get_footer();
