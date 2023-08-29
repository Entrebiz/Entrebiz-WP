<?php if ( $ad = rodller_get_option( 'main_area_ad' ) ): ?>
<div id="rodller-header-ad" class="rodller-ad">
	<?php echo do_shortcode( $ad ); ?>
</div>
<?php endif; ?>