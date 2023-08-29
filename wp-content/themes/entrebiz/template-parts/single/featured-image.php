<div class="rodller-entry-image">
    <img src="<?php echo esc_url( rodller_get_post_thumbnail( 'single' ) ); ?>" alt="<?php esc_attr( get_the_title() ); ?>">
    <?php $type = is_page() ? 'page' : 'single_post'; ?>
	<?php if ( rodller_get_option( $type . '_featured_image_caption' ) ) : ?>
        <?php $attachment_post = get_post( get_post_thumbnail_id() ); ?>
        <?php if(!empty($attachment_post) && $caption = $attachment_post->post_excerpt): ?>
            <figure class="wp-caption-text"><?php echo wp_kses_post( $caption ); ?></figure>
        <?php endif; ?>
	<?php endif; ?>
</div>
