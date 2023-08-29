<?php if ( $ad = rodller_get_option( 'ad_before_footer' ) ): ?>
    <div id="rodller-before-footer-ad" class="rodller-ad tac">
		<?php echo do_shortcode( $ad ); ?>
    </div>
<?php endif; ?>