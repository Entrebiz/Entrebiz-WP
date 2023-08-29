<?php if ( rodller_get_option( 'single_post_prevnext' ) ):
	
    $prev = get_adjacent_post( true, '', false, 'category' );
	$next = get_adjacent_post( true, '', true, 'category' );
	
	if ( ! empty( $prev ) || ! empty( $next ) ) : ?>
        <nav id="rodller-prevnext" class="row <?php echo empty($prev) ? 'rodller-prevnext-link-next-only' : '';?> <?php echo empty($next) ? 'rodller-prevnext-link-prev-only' : '';?>">
			<?php if ( $prev ): ?>
                <a href="<?php echo esc_url( get_permalink( $prev ) ); ?>" class="rodller-prevnext-link rodller-prevnext-link-prev col-6">
                    <span class="rodller-entry-image rodller-image-zoom-hover">
                    <img src="<?php echo rodller_get_post_thumbnail( 'thumbnail', $prev->ID ); ?>" alt="<?php echo esc_attr( $prev->post_title ); ?>">
                    </span>
                    <div class="rodller-prevnext-link-text rodller-image-zoom-hover">
                        <p><?php _e( 'Previous Post', 'rodller' ); ?></p>
                        <h6><?php echo get_the_title( $prev ); ?></h6>
                    </div>
                </a>
			<?php endif; ?>
			<?php if ( $next ): ?>
                <a href="<?php echo esc_url( get_permalink( $next ) ); ?>" class="rodller-prevnext-link rodller-prevnext-link-next col-6">
                    <div class="rodller-prevnext-link-text">
                        <p><?php _e( 'Next Post', 'rodller' ); ?></p>
                        <h6><?php echo get_the_title( $next ); ?></h6>
                    </div>
                    <span class="rodller-entry-image rodller-image-zoom-hover">
                    <img src="<?php echo rodller_get_post_thumbnail( 'thumbnail', $next->ID ); ?>" alt="<?php echo esc_attr( $next->post_title ); ?>">
                    </span>
                </a>
			<?php endif; ?>
        </nav>
	<?php endif; ?>
<?php endif; ?>