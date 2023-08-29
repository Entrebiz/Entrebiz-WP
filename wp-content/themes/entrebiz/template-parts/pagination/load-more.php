<?php $next_link = get_next_posts_link(__('Load More', 'rodller')); ?>
<?php if(!empty($next_link)): ?>
    <nav id="rodller-pagination" class="rodller-load-more clearfix">
        <?php echo wp_kses_post($next_link); ?>
        <div class="spinner">
            <div class="dot1"></div>
            <div class="dot2"></div>
        </div>
    </nav>
<?php endif; ?>