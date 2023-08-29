<?php if ( post_password_required() ) {
	return;
} ?>

<?php if ( comments_open() || get_comments_number() ) : ?>

    <div class="container container-small p0">
		<?php
		comment_form( array(
			'title_reply_before' => '<h4 id="reply-title" class="section-title "><span>',
			'title_reply'        => __('Leave a reply', 'rodller'),
			'title_reply_after'  => '</span></h4>',
		) );
		?>
		
		<?php if ( have_comments() ) : ?>
            <h4 id="comments" class="section-title">
                <span><?php comments_number( 'No comments', 'One comment', '% comments' ); ?></span>
            </h4>

            <ul class="comment-list">
				<?php $args = array(
					'avatar_size' => 100,
					'reply_text'  => '<i class="icon ion-ios-undo"></i>' . __('Reply', 'rodller'),
					'format'      => 'html5',
				); ?><?php wp_list_comments( $args ); ?>
            </ul>
			
			<?php paginate_comments_links( array(
				'prev_text' => '<i class="o-angle-left-1"></i>',
				'next_text' => '<i class="o-angle-right-1"></i>',
				'type'      => 'list',
			) ); ?><?php endif; ?>
    </div>
<?php endif; ?>