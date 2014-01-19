<?php

register_nav_menu('main', '主导航');

add_action('wp_enqueue_scripts', function(){
	wp_register_style('bootstrap', 'http://cdn.staticfile.org/twitter-bootstrap/2.3.2/css/bootstrap.min.css');
	wp_register_style('bootstrap-responsive', 'http://cdn.staticfile.org/twitter-bootstrap/2.3.2/css/bootstrap-responsive.min.css', array('bootstrap'));
	wp_enqueue_style('bootstrap-responsive');
	wp_enqueue_style('style', get_stylesheet_uri());
});
