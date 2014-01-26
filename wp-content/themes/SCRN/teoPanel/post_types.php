<?php 
add_action('init', 'teo_post_types');
function teo_post_types() {
  $labels = array(
    'name' => _x('Portfolio items', 'post type general name', 'SCRN'),
    'singular_name' => _x('Portfolio item', 'post type singular name', 'SCRN'),
    'add_new' => _x('Add', 'portfolio_item', 'SCRN'),
    'add_new_item' => __('Add a new portfolio item', 'SCRN'),
    'edit_item' => __('Edit portfolio item', 'SCRN'),
    'new_item' => __('New portfolio item', 'SCRN'),
    'all_items' => __('All portfolio items', 'SCRN'),
    'view_item' => __('View portfolio item details', 'SCRN'),
    'search_items' => __('Search portfolio item', 'SCRN'),
    'not_found' =>  __('No portfolio item found', 'SCRN'),
    'not_found_in_trash' => __('No portfolio item in the trash.' , 'SCRN'), 
    'parent_item_colon' => '',
    'menu_name' => 'Portfolio'

  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array('title')
  ); 
  
  register_post_type('portfolio',$args);
  register_taxonomy_for_object_type( 'category', 'portfolio' ); 
}
?>