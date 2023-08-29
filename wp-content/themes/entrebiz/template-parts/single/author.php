<?php if( rodller_get_option('single_post_author') ) : ?>
    <div class="rodller-author">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12 rodller-author-avatar">
                <?php echo get_avatar( get_the_author_meta('ID'), 150); ?>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <?php echo '<h4 class="rodller-author-display-name">'.get_the_author_meta('display_name').'</h4>'; ?>
                <div class="rodller-author-desc">
                    <?php echo wpautop( get_the_author_meta('description') ); ?>
                </div>
                <div class="rodller-author-links">
                    <?php echo rodller_get_author_links( get_the_author_meta('ID') ); ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>