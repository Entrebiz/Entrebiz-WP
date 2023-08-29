<?php if ( rodller_is_woocommerce_active() ): ?>
	<?php $elements = rodller_woocommerce_cart_elements(); ?>
	<div class="rodller-cart-icon">
		<a class="rodller-custom-cart" href="<?php echo esc_url($elements['cart_url']); ?>">
			<span class="ion-ios-cart"></span>
			<?php if( $elements['products_count'] > 0 ) : ?>
				<span class="rodller-cart-count pulse"><?php echo absint($elements['products_count']); ?></span>
			<?php endif; ?>
		</a>
	</div>
<?php endif; ?>
