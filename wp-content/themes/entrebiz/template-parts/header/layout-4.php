<div class="container">
    <div id="rodller-header-main-area">
        <div class="rodller-logo-wrapper">
            <?php get_template_part('template-parts/header/elements/logo'); ?>
        </div>
        <div class="rodller-header-logo-wrapper">
            <div class="rodller-main-navigation-wrapper">
                <?php get_template_part('template-parts/header/elements/main-nav'); ?>
                <?php get_template_part('template-parts/header/elements/left-slot'); ?>
            </div>
        </div>
        <?php get_template_part('template-parts/header/elements/right-slot'); ?>
    </div>
</div>
