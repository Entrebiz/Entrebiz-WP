<div id="rodller-responsive-header">
	<?php get_template_part( 'template-parts/header/elements/logo' ); ?>
    <div id="rodller-responsive-navigation" role="navigation">
		<?php
        
        wp_nav_menu( array(
			'theme_location'  => 'main-menu',
			'menu_class'      => 'list-unstilted',
			'container_class' => 'responsive-main-menu-container',
			'container'       => 'ul',
			'walker'          => new Responsive_Menu_Walker(),
		) );
		
		if ( in_array( 'social-menu', rodller_get_option( 'main_area_right_slot' ) ) || in_array( 'social-menu', rodller_get_option( 'main_area_left_slot' ) ) ) {
			wp_nav_menu( array(
				'menu_id'        => 'rodller-social',
				'depth'          => 1,
				'theme_location' => 'social-menu',
				'menu_class'     => 'rodller-menu-social list-unstilted',
				'link_before'    => '<span class="rodller-menu-social-text">',
				'link_after'     => '</span>',
			) );
		}
		?>
    </div>

    <a id="rodller-responsive-navigation-opener" href="javascript:void(0);">
        <span class="rodller-hamburger"></span>
    </a>

    <div id="rodller-responsive-overlayer"></div>
</div>