<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package rodller
 */

?>
<article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="rodller-entry-content <?php echo rodller_get_single_container_class(); ?>">
        <?php

        $cover_options = rodller_get_page_cover_options( get_the_ID() );
        
        if ( rodller_get_option( 'page_featured_image' ) && has_post_thumbnail() && !in_array($cover_options['layout'],['none', 'static']) ):
	        get_template_part( 'template-parts/single/featured-image' );
        endif;
        
        the_content();

        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'rodller'),
            'after'  => '</div>',
        ));
        ?>
    </div><!-- .entry-content -->
</article><!-- #page-<?php the_ID(); ?> -->