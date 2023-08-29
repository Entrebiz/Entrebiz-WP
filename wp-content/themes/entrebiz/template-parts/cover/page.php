<?php
$id = get_queried_object_id();
$cover_options = rodller_get_page_cover_options( $id );
?>
<div class="rodller-cover-wrapper">
<?php
if ( !empty( $cover_options ) && $cover_options['layout'] != 'none' ): ?>
    <?php if(in_array($cover_options['layout'], array(1, 2))): ?>
        <?php include locate_template('template-parts/cover/page-slider.php'); ?>
    <?php else: ?>
		<?php include locate_template('template-parts/cover/page-static.php'); ?>
	<?php endif; ?>
<?php endif; ?>
</div>