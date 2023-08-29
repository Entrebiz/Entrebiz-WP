<?php $category_meta = rodller_get_category_metadata(get_queried_object_id()); ?>
<?php if(!empty($category_meta['image'])): ?>
    <div class="rodller-cover-wrapper">
        <div id="rodller-cover" class="rodller-cover-post">
            <img src="<?php echo rodller_get_thumbnail_by_id( $category_meta['image'], 'cover' ); ?>" alt="<?php echo esc_attr( get_the_title() ) ?>">
        </div>
    </div>
<?php endif; ?>