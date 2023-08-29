<?php $ad = rodller_get_option( 'ad_below_header' ) ?>
<?php if ( !empty( $ad ) ): ?>
    <div id="rodller-below-header-ad" class="rodller-ad tac">
		<?php echo do_shortcode( $ad ); ?>
    </div>
<?php endif; ?>