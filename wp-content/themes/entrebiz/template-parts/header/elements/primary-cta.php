<?php $top_bar_button_text = rodller_get_option('primary_cta_text'); ?>
<?php $top_bar_button_link = rodller_get_option('primary_cta_link'); ?>
<?php if(!empty($top_bar_button_text) && !empty($top_bar_button_link)): ?>
	<a href="<?php echo esc_url($top_bar_button_link); ?>" class="rodller-button"><?php echo wp_kses_post($top_bar_button_text); ?></a>
<?php endif; ?>