<nav class="rodller-main-navigation" role="navigation">
<?php
	if ( has_nav_menu( 'main-menu' ) ) {
		wp_nav_menu( array(
			'theme_location'  => 'main-menu',
			'menu_class'      => 'rodller-main-menu list-unstilted',
			'container_class' => 'main-menu-container',
			'container'       => 'ul',
		) );
	}
?>
</nav><!-- .rodller-main-navigation -->