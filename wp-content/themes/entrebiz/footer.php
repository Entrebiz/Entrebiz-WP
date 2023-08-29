<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package rodller
 */
?>

<?php get_template_part('template-parts/ads/before-footer'); ?>

<div id="rodller-prefooter">
	<?php get_template_part('template-parts/footer/pre'); ?>
</div>

<?php $footer_columns = rodller_get_footer_columns(); ?>
<?php if(!empty($footer_columns) && (
		is_active_sidebar('rodller-footer-column-sidebar-1') || is_active_sidebar('rodller-footer-column-sidebar-2') ||
		is_active_sidebar('rodller-footer-column-sidebar-3') || is_active_sidebar('rodller-footer-column-sidebar-4') || is_active_sidebar('rodller-footer-column-sidebar-5'))): ?>
	<footer id="rodller-main-footer">
		<div class="container">
			<div class="row">
				<?php foreach($footer_columns as $column_key => $column_width) :?>
					<?php $column_counter = $column_key + 1; ?>
					<div class="col-md-<?php echo esc_attr($column_width); ?> col-sm-12">
						<?php if(is_active_sidebar('rodller-footer-column-sidebar-' . $column_counter )): ?>
							<?php dynamic_sidebar( 'rodller-footer-column-sidebar-' . $column_counter );?>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</footer><!-- #colophon -->
<?php endif; ?>
<?php $copyright_bar = rodller_get_option('footer_copyright_bar')  ?>
<?php $copyright_bar_content = rodller_get_option('footer_copyright_content')  ?>
<?php if($copyright_bar && !empty($copyright_bar_content)): ?>
    <div id="rodller-copyright">
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-sm-12">
					<?php wp_nav_menu( array( 'theme_location' => 'social-menu' ) ); ?>
				</div>
				<div class="col-md-8 col-sm-12">
					<?php $copyright_bar = rodller_get_option('footer_copyright_bar')  ?>
					<?php $copyright_bar_content = rodller_get_option('footer_copyright_content')  ?>
					<?php if($copyright_bar && !empty($copyright_bar_content)): ?>
						<div>
							<?php echo wp_kses_post(wpautop(do_shortcode($copyright_bar_content))); ?>
						</div>
					<?php endif; ?>					
				</div>
			</div>
		</div>
    </div>
<?php endif; ?>
</div><!-- #page -->

<?php wp_footer(); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
	//jQuery(".color-boxes").css("max-width", parseInt(jQuery(window).width() -15));
	jQuery( document ).ready(function() {
		var windowwidth = jQuery(window).width();
		if(windowwidth < 600){
			jQuery(".color-box").css("max-width", parseInt(jQuery(window).width() -30));			
			jQuery(".color-box").css("width", "100%");			
		}
	});
	jQuery( window ).resize(function() {
		var windowwidth = jQuery(window).width();
		if(windowwidth < 600){
			jQuery(".color-box").css("max-width", parseInt(jQuery(window).width() -30));			
			jQuery(".color-box").css("width", "100%");			
		}
	});
	jQuery('.color-boxes').slick({
	  infinite: true,
	  slidesToShow: 3,
	  slidesToScroll: 1,
		dots: false,
		prevArrow: ".prevb",
		nextArrow: ".nextb",
		arrows: true,
		speed: 800,
		autoplay: true,
		autoplaySpeed: 1800,
		pauseOnHover: true,
		variableWidth: true,
		  responsive: [
			{
			  breakpoint: 1024,
			  settings: {
				slidesToShow: 2,
				slidesToScroll: 1,
				dots: false
			  }
			},
			{
			  breakpoint: 600,
			  settings: {
				slidesToShow: 1,
				slidesToScroll: 1,
				  autoplay: false,
				  infinite: true
			  }
			},
			{
			  breakpoint: 480,
			  settings: {
				slidesToShow: 1,
				slidesToScroll: 1,
				  autoplay: false,
				  infinite: true
			  }
			}
			// You can unslick at a given breakpoint now by adding:
			// settings: "unslick"
			// instead of a settings object
		  ]
		
	});

</script>



</body>
</html>
