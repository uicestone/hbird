<?php 
add_filter('wp_title', 'vp_filter_wp_title', 9, 3);
function vp_filter_wp_title( $old_title, $sep, $sep_location ) {
	$ssep = ' ' . $sep . ' ';
	if (is_home() ) {
		return get_bloginfo('name');
	}
	elseif(is_single() || is_page() )
	{
		return get_the_title();
	}
	elseif( is_category() ) $output = $ssep . 'Category';
	elseif( is_tag() ) $output = $ssep . 'Tag';
	elseif( is_author() ) $output = $ssep . 'Author';
	elseif( is_year() || is_month() || is_day() ) $output = $ssep . 'Archives';
	else $output = NULL;
	 
	// get the page number we're on (index)
	if( get_query_var( 'paged' ) )
	$num = $ssep . 'page ' . get_query_var( 'paged' );
	 
	// get the page number we're on (multipage post)
	elseif( get_query_var( 'page' ) )
	$num = $ssep . 'page ' . get_query_var( 'page' );
		 
	// else
	else $num = NULL;
		 
	// concoct and return new title
	return get_bloginfo( 'name' ) . $output . $old_title . $num;
}

//This function shows the top menu if the user didn't create the menu in Appearance -> Menus.
if( !function_exists( 'show_top_menu') )
{
	function show_top_menu() {
		global $scrn;
		echo '<ul>';
		if(isset($scrn['pages_topmenu']) && $scrn['pages_topmenu'] != '' )
			$pages = get_pages( array('include' => $scrn['pages_topmenu'], 'sort_column' => 'menu_order', 'sort_order' => 'ASC') );
		else
			$pages = get_pages('number=4&sort_column=menu_order&sort_order=ASC');
		$count = count($pages);
		if($scrn['menu_homelink'] == '1') 
			echo '<li><a href="' . get_home_url() . '/#intro">Home</a>';
		for($i = 0; $i < $count; $i++)
		{
			echo '<li><a href="' . get_home_url() . '/#' . $pages[$i]->post_name . '">' . $pages[$i]->post_title . '</a></li>' . PHP_EOL;
		}
		if(isset($scrn['blog_page']) && $scrn['blog_page'] != '')
			echo '<li><a href="' . get_permalink($scrn['blog_page'][0]) . '">Blog</a></li>';
		echo '<li><a href="' . get_home_url() . '/#contact">Contact</a></li>';
		echo '</ul>';
	}
}

add_action('wp_head', 'vp_customization');
//This function handles the Colorization tab of the theme options
if(! function_exists('vp_customization'))
{
	function vp_customization() {
		//favicon
		global $scrn;

		//Loading the google web fonts on the page.
		$loaded[] = 'Oswald';
		$loaded[] = 'Source+Sans+Pro';
		if(!in_array($scrn['body_font'], $loaded))
		{
//			echo '<link id="' . $scrn['body_font'] . '" href="http://fonts.googleapis.com/css?family=' . $scrn['body_font'] . '" rel="stylesheet" type="text/css" />' . PHP_EOL;
			$loaded[] = $scrn['body_font'];
		}

		if(isset($scrn['top_headertext_font']) && !in_array($scrn['top_headertext_font'], $loaded))
		{
//			echo '<link id="' . $scrn['top_headertext_font'] . '" href="http://fonts.googleapis.com/css?family=' . $scrn['top_headertext_font'] . '" rel="stylesheet" type="text/css" />' . PHP_EOL;
			$loaded[] = $scrn['top_headertext_font'];
		}

		if(isset($scrn['top_smalltext_font']) && !in_array($scrn['top_smalltext_font'], $loaded))
		{
//			echo '<link id="' . $scrn['top_smalltext_font'] . '" href="http://fonts.googleapis.com/css?family=' . $scrn['top_smalltext_font'] . '" rel="stylesheet" type="text/css" />' . PHP_EOL;
			$loaded[] = $scrn['top_smalltext_font'];
		}

		if(isset($scrn['top_smallertext_font']) && !in_array($scrn['top_smallertext_font'], $loaded))
		{
//			echo '<link id="' . $scrn['top_smallertext_font'] . '" href="http://fonts.googleapis.com/css?family=' . $scrn['top_smallertext_font'] . '" rel="stylesheet" type="text/css" />' . PHP_EOL;
			$loaded[] = $scrn['top_smallertext_font'];
		}

		if(isset($scrn['nav_font']) && !in_array($scrn['nav_font'], $loaded))
		{
//			echo '<link id="' . $scrn['nav_font'] . '" href="http://fonts.googleapis.com/css?family=' . $scrn['nav_font'] . '" rel="stylesheet" type="text/css" />' . PHP_EOL;	
			$loaded[] = $scrn['nav_font'];
		}

		if(isset($scrn['pagetitle_font']) && !in_array($scrn['pagetitle_font'], $loaded))
		{
//			echo '<link id="' . $scrn['pagetitle_font'] . '" href="http://fonts.googleapis.com/css?family=' . $scrn['pagetitle_font'] . '" rel="stylesheet" type="text/css" />' . PHP_EOL;
			$loaded[] = $scrn['pagetitle_font'];
		}	
		if(isset($scrn['subheader_font']) && !in_array($scrn['subheader_font'], $loaded))
		{
//			echo '<link id="' . $scrn['subheader_font'] . '" href="http://fonts.googleapis.com/css?family=' . $scrn['subheader_font'] . '" rel="stylesheet" type="text/css" />' . PHP_EOL;
			$loaded[] = $scrn['subheader_font'];
		}	
		if(isset($scrn['h3_font']) && !in_array($scrn['h3_font'], $loaded))
		{
//			echo '<link id="' . $scrn['h3_font'] . '" href="http://fonts.googleapis.com/css?family=' . $scrn['h3_font'] . '" rel="stylesheet" type="text/css" />' . PHP_EOL;
			$loaded[] = $scrn['h3_font'];
		}
		if(isset($scrn['h4_font']) && !in_array($scrn['h4_font'], $loaded))
		{
//			echo '<link id="' . $scrn['h4_font'] . '" href="http://fonts.googleapis.com/css?family=' . $scrn['h4_font'] . '" rel="stylesheet" type="text/css" />' . PHP_EOL;
			$loaded[] = $scrn['h4_font'];
		}
		if(isset($scrn['separator_font']) && !in_array($scrn['separator_font'], $loaded))
		{
//			echo '<link id="' . $scrn['separator_font'] . '" href="http://fonts.googleapis.com/css?family=' . $scrn['separator_font'] . '" rel="stylesheet" type="text/css" />' . PHP_EOL;
			$loaded[] = $scrn['separator_font'];
		}
		if(isset($scrn['footer_font']) && !in_array($scrn['footer_font'], $loaded))
		{
//			echo '<link id="' . $scrn['footer_font'] . '" href="http://fonts.googleapis.com/css?family=' . $scrn['footer_font'] . '" rel="stylesheet" type="text/css" />' . PHP_EOL;
			$loaded[] = $scrn['footer_font'];
		}

		if(isset($scrn['favicon']) && $scrn['favicon'] != '')
			echo '<link rel="shortcut icon" href="' . $scrn['favicon'] . '" />';
		echo "\n<style type='text/css'> \n";

		if(isset($scrn['bg_image']) && $scrn['bg_image'] != '')
		{ 
			echo "#intro .bg1 { background-image: url('" . $scrn['bg_image'] . "'); } \n";
		}
		if(isset($scrn['bg_color']) && $scrn['bg_color'] != '') 
		{
			echo "#intro .bg1 { background-image: none; background-color: " . $scrn['bg_color'] . "; } \n";
		}

		//add custom CSS as per the theme options only if custom colorization was enabled.
		if(isset($scrn['enable_colorization']) && $scrn['enable_colorization'] == 1)
		{
			$loaded = array();
			echo '
			p, body { font-size: ' . $scrn['body_size'] . 'px; color: ' . $scrn['body_color_white'] . '; font-family: \'' . str_replace('+', ' ', $scrn['body_font']) . '\',sans-serif; }
			.dark-bg p, .dark-bg { color: ' . $scrn['body_color_dark'] . '; }
			h1 { font-size: ' . $scrn['top_headertext_size'] . 'px;}
			#intro h1 { color: ' . $scrn['top_headertext_color'] . '; font-family: \'' . str_replace('+', ' ', $scrn['top_headertext_font']) . '\',sans-serif; }
			#intro h1.small { font-size: ' . $scrn['top_smalltext_size'] . 'px; color: ' . $scrn['top_smalltext_color'] . '; font-family: \'' . str_replace('+', ' ', $scrn['top_smalltext_font']) . '\',sans-serif; }
			.title p { font-size: ' . $scrn['top_smallertext_size'] . 'px; color: ' . $scrn['top_smallertext_color'] . '; font-family: \'' . str_replace('+', ' ', $scrn['top_smallertext_font']) . '\',sans-serif; }
			nav a { font-size: ' . $scrn['nav_size'] . 'px; color: ' . $scrn['nav_color'] . ' !important; font-family: \'' . str_replace('+', ' ', $scrn['nav_font']) . '\',sans-serif; }
			nav a:hover { color: ' . $scrn['nav_hovercolor'] . ' !important; }
			h2 { font-size: ' . $scrn['pagetitle_size'] . 'px; color: ' . $scrn['pagetitle_color'] . '; font-family: \'' . str_replace('+', ' ', $scrn['pagetitle_font']) . '\',sans-serif; }
			.action p { font-size: ' . $scrn['subheader_size'] . 'px; color: ' . $scrn['subheader_color'] . '; font-family: \'' . str_replace('+', ' ', $scrn['subheader_font']) . '\',sans-serif; }
			h3 { color: ' . $scrn['h3_color'] . '; font-size: ' . $scrn['h3_size'] . 'px; font-family: \'' . str_replace('+', ' ', $scrn['h3_font']) . '\',sans-serif; }
			h4 { color: ' . $scrn['h4_color'] . '; font-size: ' . $scrn['h4_size'] . 'px; font-family: \'' . str_replace('+', ' ', $scrn['h4_font']) . '\',sans-serif; }
			p.separator { font-size: ' . $scrn['separator_size'] . 'px !important; color: ' . $scrn['separator_color'] . ' !important; font-family: \'' . str_replace('+', ' ', $scrn['separator_font']) . '\',sans-serif !important; }
			.copyright  p, .copyright  a { font-size: ' . $scrn['footer_size'] . 'px; color: ' . $scrn['footer_color'] . '; font-family: \'' . str_replace('+', ' ', $scrn['footer_font']) . '\',sans-serif; }
			';
		}
		echo '</style>';
	}
}

/**
* Title		: Aqua Resizer
* Description	: Resizes WordPress images on the fly
* Version	: 1.1.6
* Author	: Syamil MJ
* Author URI	: http://aquagraphite.com
* License	: WTFPL - http://sam.zoy.org/wtfpl/
* Documentation	: https://github.com/sy4mil/Aqua-Resizer/
*
* @param	string $url - (required) must be uploaded using wp media uploader
* @param	int $width - (required)
* @param	int $height - (optional)
* @param	bool $crop - (optional) default to soft crop
* @param	bool $single - (optional) returns an array if false
* @uses		wp_upload_dir()
* @uses		image_resize_dimensions() | image_resize()
* @uses		wp_get_image_editor()
*
* @return str|array
*/

function aq_resize( $url, $width, $height = null, $crop = null, $single = true ) {
	
	//validate inputs
	if(!$url OR !$width ) return false;
	
	//define upload path & dir
	$upload_info = wp_upload_dir();
	$upload_dir = $upload_info['basedir'];
	$upload_url = $upload_info['baseurl'];
	
	//check if $img_url is local
	if(strpos( $url, $upload_url ) === false) return false;
	
	//define path of image
	$rel_path = str_replace( $upload_url, '', $url);
	$img_path = $upload_dir . $rel_path;
	
	//check if img path exists, and is an image indeed
	if( !file_exists($img_path) OR !getimagesize($img_path) ) return false;
	
	//get image info
	$info = pathinfo($img_path);
	$ext = $info['extension'];
	list($orig_w,$orig_h) = getimagesize($img_path);
	
	//get image size after cropping
	$dims = image_resize_dimensions($orig_w, $orig_h, $width, $height, $crop);
	$dst_w = $dims[4];
	$dst_h = $dims[5];
	
	//use this to check if cropped image already exists, so we can return that instead
	$suffix = "{$dst_w}x{$dst_h}";
	$dst_rel_path = str_replace( '.'.$ext, '', $rel_path);
	$destfilename = "{$upload_dir}{$dst_rel_path}-{$suffix}.{$ext}";
	
	if(!$dst_h) {
		//can't resize, so return original url
		$img_url = $url;
		$dst_w = $orig_w;
		$dst_h = $orig_h;
	}
	//else check if cache exists
	elseif(file_exists($destfilename) && getimagesize($destfilename)) {
		$img_url = "{$upload_url}{$dst_rel_path}-{$suffix}.{$ext}";
	} 
	//else, we resize the image and return the new resized image url
	else {
		
		// Note: This pre-3.5 fallback check will edited out in subsequent version
		if(function_exists('wp_get_image_editor')) {
		
			$editor = wp_get_image_editor($img_path);
			
			if ( is_wp_error( $editor ) || is_wp_error( $editor->resize( $width, $height, $crop ) ) )
				return false;
			
			$resized_file = $editor->save();
			
			if(!is_wp_error($resized_file)) {
				$resized_rel_path = str_replace( $upload_dir, '', $resized_file['path']);
				$img_url = $upload_url . $resized_rel_path;
			} else {
				return false;
			}
			
		} else {
		
			$resized_img_path = image_resize( $img_path, $width, $height, $crop ); // Fallback foo
			if(!is_wp_error($resized_img_path)) {
				$resized_rel_path = str_replace( $upload_dir, '', $resized_img_path);
				$img_url = $upload_url . $resized_rel_path;
			} else {
				return false;
			}
		
		}
		
	}
	
	//return the output
	if($single) {
		//str return
		$image = $img_url;
	} else {
		//array return
		$image = array (
			0 => $img_url,
			1 => $dst_w,
			2 => $dst_h
		);
	}
	
	return $image;
}
?>