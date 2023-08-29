<?php

$instagram_key = rodller_get_option('prefooter_instagram_username');

if(!empty($instagram_key) && class_exists('null_instagram_widget')){
	the_widget( 'null_instagram_widget', array(
		'title'    => '',
		'username' => $instagram_key,
		'number'   => 12,
		'size'     => 'small',
		'target'   => '_blank',
		'link'     => (substr($instagram_key, 0, 1) === '#') ? __('See more', 'rodller') : __('Follow Me', 'rodller'),
	), array(
			'before_widget' => '<div id="%1$s" class="widget null-instagram-feed">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title h6">',
			'after_title'   => '</h4>',
		)
	);
}
