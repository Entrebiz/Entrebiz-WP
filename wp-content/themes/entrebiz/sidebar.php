<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package rodller
 */

$sidebar_options = rodller_get_template_sidebar_options();
if(!empty($sidebar_options['sidebar_active'])): ?>
    <aside id="rodller-sidebar" class="<?php echo esc_attr($sidebar_options['aside_class']); ?> rodller-sidebar-<?php echo esc_attr($sidebar_options['sidebar_position'])?>">
    <?php if(is_active_sidebar($sidebar_options['sidebar_name'])): ?>
        <?php dynamic_sidebar($sidebar_options['sidebar_name']); ?>
    <?php endif; ?>
    <?php if(is_active_sidebar($sidebar_options['sticky_sidebar_name'])): ?>
        <div class="rodller-sticky-sidebar">
            <?php dynamic_sidebar($sidebar_options['sticky_sidebar_name']); ?>
        </div>
    <?php endif; ?>
    </aside>
<?php endif; ?>