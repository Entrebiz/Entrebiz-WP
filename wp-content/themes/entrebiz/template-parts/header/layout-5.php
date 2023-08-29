<div class="container df jcsp aic">
    <div id="rodller-header-main-area">
        <div class="rodller-header-logo-wrapper">
            <?php get_template_part('template-parts/header/elements/logo'); ?>
	        <div class="rodller-r-slot">
		        <?php rodller_get_template_parts_from_array('template-parts/header/elements/', "main_area_slot"); ?>
	        </div>
        </div>
    </div>
	<?php get_template_part('template-parts/ads/header'); ?>
</div>

<div id="rodller-bottom-area">
    <div class="container">
	    <div class="df">
		    <?php get_template_part('template-parts/header/elements/main-nav'); ?>
		    <?php get_template_part('template-parts/header/elements/left-slot'); ?>
	    </div>
        <?php get_template_part('template-parts/header/elements/right-slot'); ?>
    </div>
</div>
