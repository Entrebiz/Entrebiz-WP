<div id="rodller-sticky-header">
    <div class="container">
        <div class="rodller-logo-wrapper">
            <?php get_template_part('template-parts/header/elements/logo'); ?>
        </div>
        <div class="rodller-main-navigation-wrapper">
            <?php get_template_part('template-parts/header/elements/main-nav'); ?>
        </div>
        <div class="rodller-r-slot">
            <?php rodller_get_template_parts_from_array('template-parts/header/elements/', "sticky_right_slot"); ?>
        </div>
    </div>
</div>