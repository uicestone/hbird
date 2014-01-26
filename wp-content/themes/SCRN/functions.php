<?php
$scrn = get_option('scrn');
add_action( 'after_setup_theme', 'vp_setup' );
if ( ! function_exists( 'vp_setup' ) ){
	function vp_setup(){
		global $scrn;
		require get_template_directory() . '/teoPanel/custom-functions.php';
		require get_template_directory() . '/includes/shortcodes.php';
		require get_template_directory() . '/includes/comments.php';
		require get_template_directory() . '/teoPanel/post_types.php';
		require get_template_directory() . '/teoPanel/custom_metaboxes/meta_boxes.php';
		require get_template_directory() . '/teoPanel/Page-Builder/aq-page-builder.php';
		load_theme_textdomain('SCRN', get_template_directory() . '/languages');
		$current_user = wp_get_current_user();
		if($scrn['superadmin'] == '' || $current_user->user_login == $scrn['superadmin'])
			require 'teoPanel/nhp-options.php';
	}
}
// Loading js files into the theme
add_action('wp_head', 'vp_scripts');
if ( !function_exists('vp_scripts') ) {
	function vp_scripts() {
		global $scrn;
		wp_enqueue_script( 'jquery-sticky', get_template_directory_uri() . '/js/jquery.sticky.js', array(), '1.0');
		wp_enqueue_script( 'smooth-scroll', get_template_directory_uri() . '/js/jquery.smooth-scroll.js', array(), '1.0');
		wp_enqueue_script( 'contact-form', get_template_directory_uri() . '/js/contact-form.js', array(), '1.0');
		wp_enqueue_script( 'jquery-easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array(), '1.0');
		wp_enqueue_script( 'prettyPhoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', array(), '1.0');
		wp_enqueue_script( 'inview', get_template_directory_uri() . '/js/jquery.inview.js', array(), '1.0');
		wp_enqueue_script( 'custom', get_template_directory_uri() . '/js/custom.js', array(), '1.0');
		wp_enqueue_script( 'isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array(), '1.0');
		wp_enqueue_script( 'mobilemenu', get_template_directory_uri() . '/js/jquery.mobilemenu.js', array(), '1.0');
		if ( is_singular() && get_option( 'thread_comments' ) )
    		wp_enqueue_script( 'comment-reply' );
	}

}

//Loading the CSS files into the theme
add_action('wp_enqueue_scripts', 'vp_load_css');
if( !function_exists('vp_load_css') ) {
	function vp_load_css() {
		global $scrn;
		wp_enqueue_style( 'base', get_template_directory_uri() . '/css/base.css', array(), '1.0');
		wp_enqueue_style( 'layout', get_template_directory_uri() . '/css/layout.css', array(), '1.0');
		wp_enqueue_style( 'skeleton', get_template_directory_uri() . '/css/skeleton.css', array(), '1.0');
		wp_enqueue_style( 'flexslider', get_template_directory_uri() . '/css/flexslider.css', array(), '1.0');
		wp_enqueue_style( 'prettyPhoto', get_template_directory_uri() . '/css/prettyPhoto.css', array(), '1.0');
		wp_enqueue_style( 'style-css', get_stylesheet_directory_uri() . '/style.css', array(), '1.0');
		wp_enqueue_style( 'source-sans', 'http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700,400italic,600italic,700italic', array());
		wp_enqueue_style( 'oswald', 'http://fonts.googleapis.com/css?family=Oswald:400,700,300', array());
		wp_enqueue_script('jquery');
		wp_enqueue_script( 'cycle', get_template_directory_uri() . '/js/jquery.cycle.all.min.js');
		wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/js/jquery.flexslider.js', array(), '1.0');
	}
}

add_action('wp_head', 'vp_custom_css', 11);
function vp_custom_css() {
	global $scrn;
	if(isset($scrn['custom_css']) && $scrn['custom_css'] != '')
			echo '<style type="text/css">' . $scrn['custom_css'] . '</style>';
}

add_action('init', 'vp_misc');
function vp_misc() {
	global $scrn;
	if(isset($scrn['wordpress_version']) && $scrn['wordpress_version'] == 0)
		remove_action('wp_head', 'wp_generator'); 
	add_filter('show_admin_bar', '__return_false');
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails');
	
}
if ( ! isset( $content_width ) ) $content_width = 960;

function encEmail ($orgStr) {
    $encStr = "";
    $nowStr = "";
    $rndNum = -1;

    $orgLen = strlen($orgStr);
    for ( $i = 0; $i < $orgLen; $i++) {
        $encMod = rand(1,2);
        switch ($encMod) {
        case 1: // Decimal
            $nowStr = "&#" . ord($orgStr[$i]) . ";";
            break;
        case 2: // Hexadecimal
            $nowStr = "&#x" . dechex(ord($orgStr[$i])) . ";";
            break;
        }
        $encStr .= $nowStr;
    }
    return $encStr;
} 

function register_menus() {
	register_nav_menus( array( 'top-menu' => 'Top primary menu')
						);
}
add_action('init', 'register_menus');

class description_walker extends Walker_Nav_Menu
{
      function start_el(&$output, $item, $depth=0, $args=array(), $id=0)
      {
           global $wp_query;
           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

           $class_names = $value = '';

           $classes = empty( $item->classes ) ? array() : (array) $item->classes;

           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
           $class_names = ' class="'. esc_attr( $class_names ) . '"';

           $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

           $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
           $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
           $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
           if($item->object == 'page')
           {
                $varpost = get_post($item->object_id);
                $attributes .= ' href="' . get_site_url() . '#' . $varpost->post_name . '"';
           }
           else
                $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
            $item_output = $args->before;
            $item_output .= '<a'. $attributes .'>';
            $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID );
            $item_output .= $args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args, $id );
            }
}

add_action('init', 'vp_sidebars');
function vp_sidebars() {
	$args = array(
				'name'          => 'Right sidebar',
				'before_widget' => '<div id="%1$s" class="padding-bottom %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<p class="sidebar-title">',
				'after_title'   => '</p>' );
	register_sidebar($args);
}
?>