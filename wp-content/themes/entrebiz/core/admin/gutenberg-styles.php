<?php

$background_color = rodller_get_option( 'background_color' );
$heading_font = rodller_get_option( 'headings_fonts' );
$body_font = rodller_get_option( 'body_font' );
$accent_font_color = rodller_get_option( 'accent_font_color' );
?>
html,
body {
font-size: 62.5%;
}

body{
font-size: 13px;
}

.gutenberg__editor .editor-writing-flow p,
.gutenberg__editor .editor-writing-flow ol,
.gutenberg__editor .editor-writing-flow ul,
.gutenberg__editor .editor-writing-flow blockquote,
.gutenberg__editor .editor-writing-flow cite{
font-family: <?php echo esc_attr($body_font['font-family']); ?>;
font-size: <?php echo esc_attr($body_font['font-size']); ?>;
line-height: <?php echo esc_attr($body_font['line-height']); ?>;
letter-spacing: <?php echo esc_attr($body_font['letter-spacing']); ?>;
color: <?php echo esc_attr($body_font['color']); ?>;
text-transform: <?php echo esc_attr($body_font['text-transform']); ?>;
}

.gutenberg__editor .editor-writing-flow .wp-block-button__link{
font-family: <?php echo esc_attr($body_font['font-family']); ?>;
font-size: <?php echo esc_attr($body_font['font-size']); ?>;
line-height: <?php echo esc_attr($body_font['line-height']); ?>;
letter-spacing: <?php echo esc_attr($body_font['letter-spacing']); ?>;
}

.gutenberg__editor .editor-writing-flow .editor-post-title__input,
.gutenberg__editor .editor-writing-flow h1, .gutenberg__editor .editor-writing-flow .h1, .gutenberg__editor .editor-writing-flow h1 *, .gutenberg__editor .editor-writing-flow .h1 *,
.gutenberg__editor .editor-writing-flow h2, .gutenberg__editor .editor-writing-flow .h2, .gutenberg__editor .editor-writing-flow h2 *, .gutenberg__editor .editor-writing-flow .h2 *,
.gutenberg__editor .editor-writing-flow h3, .gutenberg__editor .editor-writing-flow .h3, .gutenberg__editor .editor-writing-flow h3 *, .gutenberg__editor .editor-writing-flow .h3 *,
.gutenberg__editor .editor-writing-flow h4, .gutenberg__editor .editor-writing-flow .h4, .gutenberg__editor .editor-writing-flow h4 *, .gutenberg__editor .editor-writing-flow .h4 *,
.gutenberg__editor .editor-writing-flow h5, .gutenberg__editor .editor-writing-flow .h5, .gutenberg__editor .editor-writing-flow h5 *, .gutenberg__editor .editor-writing-flow .h5 *,
.gutenberg__editor .editor-writing-flow h6, .gutenberg__editor .editor-writing-flow .h6, .gutenberg__editor .editor-writing-flow h6 *, .gutenberg__editor .editor-writing-flow .h6 *
{
font-family: <?php echo esc_attr($heading_font['font-family']); ?>;
letter-spacing: <?php echo esc_attr($heading_font['letter-spacing']); ?>;
color: <?php echo esc_attr($heading_font['color']); ?>;
text-transform: <?php echo esc_attr($heading_font['text-transform']); ?>;
}

.gutenberg__editor .editor-writing-flow h1,
.gutenberg__editor .editor-writing-flow h2,
.gutenberg__editor .editor-writing-flow h3,
.gutenberg__editor .editor-writing-flow h4,
.gutenberg__editor .editor-writing-flow h5,
.gutenberg__editor .editor-writing-flow h6,
.gutenberg__editor .editor-writing-flow .h1,
.gutenberg__editor .editor-writing-flow .h2,
.gutenberg__editor .editor-writing-flow .h3,
.gutenberg__editor .editor-writing-flow .h4,
.gutenberg__editor .editor-writing-flow .h5,
.gutenberg__editor .editor-writing-flow .h6 {
margin-top: 0;
margin-bottom: 25px;
}

.gutenberg__editor .editor-writing-flow .editor-post-title__input,
.gutenberg__editor .editor-writing-flow h1,
.gutenberg__editor .editor-writing-flow .h1,
.gutenberg__editor .editor-writing-flow h1 *,
.gutenberg__editor .editor-writing-flow .h1 *{
font-size: 4rem;
line-height: 1.23;
}

.gutenberg__editor .editor-writing-flow h2,
.gutenberg__editor .editor-writing-flow .h2,
.gutenberg__editor .editor-writing-flow h2 *,
.gutenberg__editor .editor-writing-flow .h2 *,
.gutenberg__editor .editor-writing-flow .rodller-single .entry-content > .wp-block-cover-image .wp-block-cover-image-text {
font-size: 3.8rem;
line-height: 1;
}

.gutenberg__editor .editor-writing-flow h3,
.gutenberg__editor .editor-writing-flow .h3,
.gutenberg__editor .editor-writing-flow h3 *,
.gutenberg__editor .editor-writing-flow .h3 * {
font-size: 2.6rem;
line-height: 1.3;
}

.gutenberg__editor .editor-writing-flow h4,
.gutenberg__editor .editor-writing-flow .h4 {
font-size: 2.4rem;
line-height: 1.25;
}

.gutenberg__editor .editor-writing-flow h5,
.gutenberg__editor .editor-writing-flow .h5 {
font-size: 2.0rem;
line-height: 1.3;
}

.gutenberg__editor .editor-writing-flow h6,
.gutenberg__editor .editor-writing-flow .h6 {
font-size: 1.6rem;
line-height: 1.3;
}

.has-drop-cap:first-letter{
font-family: <?php echo esc_attr($heading_font['font-family']); ?>;
color: <?php echo esc_attr($heading_font['color']); ?>;
font-size: 4rem;
}
.gutenberg__editor .editor-writing-flow .wp-block-quote:not(.is-large):not(.is-style-large){
border-color: <?php echo esc_attr($heading_font['color']); ?>;
}
.gutenberg__editor .editor-writing-flow .wp-block-cover-image-text{
font-size: 2em;
line-height: 1.25;
color: <?php echo esc_attr($background_color); ?>;
}

.gutenberg__editor .editor-writing-flow .wp-block-pullquote{
border-top: 1px solid { <?php echo esc_attr($heading_font['color']); ?>;
border-bottom: 1px solid {<?php echo esc_attr($heading_font['color']); ?>;
}

.gutenberg__editor .editor-writing-flow a{
color: <?php echo esc_attr($accent_font_color); ?>;
text-decoration: none;
}
.wp-block-pullquote cite, .wp-block-pullquote footer{
font-size: 13px;
text-transform: uppercase;
}