<?php
exit();
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package rodller
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

	<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;900&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css" integrity="sha512-6lLUdeQ5uheMFbWm3CP271l14RsX1xtx+J5x2yeIDkkiBpeVTNhTqijME7GgRKKi6hCqovwCoBTlRBEC20M8Mg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
    <?php
    // Getting main header layout
    $header_layout = rodller_get_option("header_layout");
    ?>
    <header id="rodller-main-header" class="rodller-site-header" role="banner">
        <?php
        // Getting top bar
        if (rodller_get_option("top_bar")) {
            get_template_part('template-parts/header/top-bar');
        }
        ?>
        <div id="rodller-header-layout" class="rodller-header-<?php echo esc_attr("layout-" . $header_layout) ?>">
            <?php get_template_part('template-parts/header/layout-' . $header_layout); ?>
        </div>

        <?php if ( rodller_get_option( 'sticky_header' )): ?>
            <?php get_template_part( 'template-parts/header/sticky' ); ?>
        <?php endif; ?>
        
    </header><!-- #rodller-main-header -->
    
	<?php get_template_part( 'template-parts/header/responsive' ); ?>
