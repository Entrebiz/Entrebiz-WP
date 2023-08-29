<?php

if(has_nav_menu('social-menu')){
	wp_nav_menu(array(
			'depth'          => 1,
			'theme_location' => 'social-menu',
			'menu_class'     => 'rodller-menu-social list-unstilted',
			'link_before' => '<span class="rodller-menu-social-text">',
			'link_after' => '</span>',
		)
	);
}

?>