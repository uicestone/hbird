<?php
function filter_shortcode($content) {
	return do_shortcode(strip_tags($content, "<h1><h2><h3><h4><h5><h6><a><img><div><ul><li><ol><table><td><th><span><p><br><strong><em><b><i><iframe><embed>"));
}
add_shortcode('feedburner','vp_feedburner');
function vp_feedburner($atts, $content = null){
	extract(shortcode_atts(array(
		"name" => ''
	), $atts));
	if($name !== '')
	{
		$output = '<div style="margin: 5px; display: inline">';
		$output .= "<a href='" . esc_url( "http://feeds.feedburner.com/{$name}" ) . "'>
			<img src='" . esc_url( "http://feeds.feedburner.com/~fc/{$name}?bg=99CCFF&amp;fg=444444&amp;anim=0" ) . "' height='26' width='88' style='border:0' alt='' />
		</a>";
		$output .= '</div>';
	}
	else $output = '';
	return $output;
}
add_shortcode('twitter','vp_twitter');
function vp_twitter($atts, $content = null){
	extract(shortcode_atts(array(
		"variation" => 1,
		"username" => ''
	), $atts));
	if($username !== '')
	{
		$output = '<div style="margin: 5px; display: inline">';
		switch($variation) {
			case 1:
				$output .= '<a href="http://twitter.com/' . esc_html($username) . '"><img alt="twitter" src="http://button.twittercounter.com/animated/' . esc_html($username) . '/ffffff/00ACED" /></a>';
				break;
			case 2:
				$output .= '<a href="http://twitter.com/' . esc_html($username) . '"><img alt="twitter" src="http://button.twittercounter.com/avatar/?u=' . esc_html($username) . '" /></a>';
				break;
			case 3:		
				$output .= '<a href="http://twitter.com/' . esc_html($username) . '"><img alt="twitter" src="http://button.twittercounter.com/bird/?u=' . esc_html($username) . '" /></a>';
				break;
		}
		$output .= '</div>';		
	}
	else $output = '';
	return $output;
}
add_shortcode('digg','vp_digg');
function vp_digg($atts, $content = null){
	extract(shortcode_atts(array(
		"variation" => 1
	), $atts));
	$output = '<script type="text/javascript">
	(function() {
	var s = document.createElement("SCRIPT"), s1 = document.getElementsByTagName("SCRIPT")[0];
	s.type = "text/javascript";
	s.async = true;
	s.src = "http://widgets.digg.com/buttons.js";
	s1.parentNode.insertBefore(s, s1);
	})();
	</script>';
	$output .= '<div style="margin: 5px; display: inline">';
	switch($variation) {
		case 1:
			$output .= '<a class="DiggThisButton DiggWide"></a>';
			break;
		case 2:
			$output .= '<a class="DiggThisButton DiggMedium"></a>';
			break;
		case 3:		
			$output .= '<a class="DiggThisButton DiggCompact"></a>';
			break;
		case 4:
			$output .= '<a class="DiggThisButton DiggIcon"></a>';
			break;
	}		
	$output .= '</div>';
	return $output;
}

add_shortcode('facebook','vp_facebook');
function vp_facebook($atts, $content = null) {
	$output = '<div style="margin: 5px; display: inline">';
	$output .= '<a name="fb_share"></a> 
	<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" 
	        type="text/javascript">
	</script>';
	$output .= '</div>';
	return $output;
}

add_shortcode('stumble','vp_stumble');
function vp_stumble($atts, $content = null) {
	extract(shortcode_atts(array(
		"variation" => 5
	), $atts));
	$output = '<div style="margin: 5px; display: inline">';
	$output .= '<su:badge layout="' . (int)$variation . '"></su:badge>

<script type="text/javascript">
  (function() {
    var li = document.createElement("script"); li.type = "text/javascript"; li.async = true;
    li.src = "https://platform.stumbleupon.com/1/widgets.js";
    var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(li, s);
  })();
</script>';
	$output .= '</div>';
	return $output;
}

add_shortcode('retweet','vp_retweet');
function vp_retweet($atts, $content = null) {
	$output = '<div style="margin: 5px; display: inline">';
	$output .= "<a href='http://twitter.com/share' class='twitter-share-button' data-count='vertical'>Tweet</a><script type='text/javascript' src='http://platform.twitter.com/widgets.js'></script>";
	$output .= '</div>';
	return $output;
}

add_shortcode('pinterest','vp_pinterest');
function vp_pinterest($atts, $content = null){
	extract(shortcode_atts(array(
		"variation" => 1,
		"username" => ''
	), $atts));
	if($username !== '')
	{
		$output = '<div style="margin: 5px; display: inline">';
		switch($variation) {
			case 1:
				$output .= '<a href="http://pinterest.com/' . esc_html($username) . '/"><img src="http://passets-ec.pinterest.com/images/about/buttons/follow-me-on-pinterest-button.png" width="169" height="28" alt="Follow Me on Pinterest" /></a>';
				break;
			case 2:
				$output .= '<a href="http://pinterest.com/' . esc_html($username) . '/"><img src="http://passets-ec.pinterest.com/images/about/buttons/pinterest-button.png" width="80" height="28" alt="Follow Me on Pinterest" /></a>';
				break;
			case 3:		
				$output .= '<a href="http://pinterest.com/' . esc_html($username) . '/"><img src="http://passets-ec.pinterest.com/images/about/buttons/big-p-button.png" width="60" height="60" alt="Follow Me on Pinterest" /></a>';
				break;
			case 4:
				$output .= '<a href="http://pinterest.com/' . esc_html($username) . '/"><img src="http://passets-ec.pinterest.com/images/about/buttons/small-p-button.png" width="16" height="16" alt="Follow Me on Pinterest" /></a>';
				break;
		}
		$output .= '</div>';		
	}
	else $output = '';
	return $output;
}

add_shortcode('addthis','vp_addthis');
function vp_addthis($atts, $content = null){
	extract(shortcode_atts(array(
		"variation" => 1,
	), $atts));
	
	$output = '<div style="margin: 5px; display: inline">';
	switch($variation) {
		case 1:
			$output .= '<div class="addthis_toolbox addthis_default_style ">
				<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
				<a class="addthis_button_tweet"></a>
				<a class="addthis_button_pinterest_pinit"></a>
				<a class="addthis_counter addthis_pill_style"></a>
				</div>';
			break;
		case 2:
			$output .= '<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
				<a class="addthis_button_preferred_1"></a>
				<a class="addthis_button_preferred_2"></a>
				<a class="addthis_button_preferred_3"></a>
				<a class="addthis_button_preferred_4"></a>
				<a class="addthis_button_compact"></a>
				<a class="addthis_counter addthis_bubble_style"></a>
				</div>';
			break;
		case 3:		
			$output .= '<div class="addthis_toolbox addthis_default_style ">
				<a class="addthis_button_preferred_1"></a>
				<a class="addthis_button_preferred_2"></a>
				<a class="addthis_button_preferred_3"></a>
				<a class="addthis_button_preferred_4"></a>
				<a class="addthis_button_compact"></a>
				<a class="addthis_counter addthis_bubble_style"></a>
				</div>';
			break;
		case 4:
			$output .= '<div class="addthis_toolbox addthis_floating_style addthis_counter_style" style="left:50px;top:50px;">
				<a class="addthis_button_facebook_like" fb:like:layout="box_count"></a>
				<a class="addthis_button_tweet" tw:count="vertical"></a>
				<a class="addthis_button_google_plusone" g:plusone:size="tall"></a>
				<a class="addthis_counter"></a>
				</div>';
			break;
	}
	$output .= '<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4ff05056494689b5"></script>';
	$output .= '</div>';		
	return $output;
}
add_shortcode('one_third','vp_one_third');
function vp_one_third($atts, $content = null){
	extract(shortcode_atts(array(
		'noleft' => '',
		'noright' => ''
	), $atts));
	$content = filter_shortcode($content);
	$class = '';
	if($noleft !== '')
		$class .= 'alpha ';
	if($noright !== '')
		$class .= 'omega';
	$output = '<div class="one-third column ' . $class . '">' . $content . '</div>';
	return $output;
}
add_shortcode('one_half','vp_one_half');
function vp_one_half($atts, $content = null){
	extract(shortcode_atts(array(
		'noleft' => '',
		'noright' => ''
	), $atts));
	$content = filter_shortcode($content);
	$class = '';
	if($noleft !== '')
		$class .= 'alpha ';
	if($noright !== '')
		$class .= 'omega';
	$output = '<div class="eight columns ' . $class . '">' . $content . '</div>';
	return $output;
}

add_shortcode('two_thirds','vp_two_thirds');
function vp_two_thirds($atts, $content = null){
	extract(shortcode_atts(array(
		'noleft' => '',
		'noright' => ''
	), $atts));
	$content = filter_shortcode($content);
	$class = '';
	if($noleft !== '')
		$class .= 'alpha ';
	if($noright !== '')
		$class .= 'omega';
	$output = '<div class="two-thirds column ' . $class . '">' . $content . '</div>';
	return $output;
}

add_shortcode('one_fourth','vp_one_fourth');
function vp_one_fourth($atts, $content = null){
	extract(shortcode_atts(array(
		'icon' => '',
		'noleft' => '',
		'noright' => ''
	), $atts));
	$content = filter_shortcode($content);
	$class = '';
	if($noleft !== '')
		$class .= 'alpha ';
	if($noright !== '')
		$class .= 'omega';
	$output = '<div class="four columns ' . $class . '">';
	if($icon !== '')
		$output .= '<img alt="" src="' . esc_attr($icon) . '">';
	$output .= $content;
	$output .= '</div>';
	return $output;
}
add_shortcode('one_column','vp_one_column');
function vp_one_column($atts, $content = null){
	extract(shortcode_atts(array(
		'noleft' => '',
		'noright' => ''
	), $atts));
	$content = filter_shortcode($content);
	$class = '';
	if($noleft !== '')
		$class .= 'alpha ';
	if($noright !== '')
		$class .= 'omega';
	$output = '<div class="one column ' . $class . '">' . $content . '</div>';
	return $output;
}
add_shortcode('two_columns','vp_two_columns');
function vp_two_columns($atts, $content = null){
	extract(shortcode_atts(array(
		'noleft' => '',
		'noright' => ''
	), $atts));
	$content = filter_shortcode($content);
	$class = '';
	if($noleft !== '')
		$class .= 'alpha ';
	if($noright !== '')
		$class .= 'omega';
	$output = '<div class="two columns ' . $class . '">' . $content . '</div>';
	return $output;
}
add_shortcode('three_columns','vp_three_columns');
function vp_three_columns($atts, $content = null){
	extract(shortcode_atts(array(
		'noleft' => '',
		'noright' => ''
	), $atts));
	$content = filter_shortcode($content);
	$class = '';
	if($noleft !== '')
		$class .= 'alpha ';
	if($noright !== '')
		$class .= 'omega';
	$output = '<div class="three columns ' . $class . '">' . $content . '</div>';
	return $output;
}
add_shortcode('five_columns','vp_five_columns');
function vp_five_columns($atts, $content = null){
	extract(shortcode_atts(array(
		'noleft' => '',
		'noright' => ''
	), $atts));
	$content = filter_shortcode($content);
	$class = '';
	if($noleft !== '')
		$class .= 'alpha ';
	if($noright !== '')
		$class .= 'omega';
	$output = '<div class="five columns ' . $class . '">' . $content . '</div>';
	return $output;
}
add_shortcode('six_columns','vp_six_columns');
function vp_six_columns($atts, $content = null){
	extract(shortcode_atts(array(
		'noleft' => '',
		'noright' => ''
	), $atts));
	$content = filter_shortcode($content);
	$class = '';
	if($noleft !== '')
		$class .= 'alpha ';
	if($noright !== '')
		$class .= 'omega';
	$output = '<div class="six columns ' . $class . '">' . $content . '</div>';
	return $output;
}
add_shortcode('seven_columns','vp_seven_columns');
function vp_seven_columns($atts, $content = null){
	extract(shortcode_atts(array(
		'noleft' => '',
		'noright' => ''
	), $atts));
	$content = filter_shortcode($content);
	$class = '';
	if($noleft !== '')
		$class .= 'alpha ';
	if($noright !== '')
		$class .= 'omega';
	$output = '<div class="seven columns ' . $class . '">' . $content . '</div>';
	return $output;
}
add_shortcode('nine_columns','vp_nine_columns');
function vp_nine_columns($atts, $content = null){
	extract(shortcode_atts(array(
		'noleft' => '',
		'noright' => ''
	), $atts));
	$content = filter_shortcode($content);
	$class = '';
	if($noleft !== '')
		$class .= 'alpha ';
	if($noright !== '')
		$class .= 'omega';
	$output = '<div class="nine columns ' . $class . '">' . $content . '</div>';
	return $output;
}
add_shortcode('ten_columns','vp_ten_columns');
function vp_ten_columns($atts, $content = null){
	extract(shortcode_atts(array(
		'noleft' => '',
		'noright' => ''
	), $atts));
	$content = filter_shortcode($content);
	$output = '<div class="ten columns ' . $class . '">' . $content . '</div>';
	return $output;
}
add_shortcode('eleven_columns','vp_eleven_columns');
function vp_eleven_columns($atts, $content = null){
	extract(shortcode_atts(array(
		'noleft' => '',
		'noright' => ''
	), $atts));
	$content = filter_shortcode($content);
	$class = '';
	if($noleft !== '')
		$class .= 'alpha ';
	if($noright !== '')
		$class .= 'omega';
	$output = '<div class="eleven columns ' . $class . '">' . $content . '</div>';
	return $output;
}
add_shortcode('twelve_columns','vp_twelve_columns');
function vp_twelve_columns($atts, $content = null){
	extract(shortcode_atts(array(
		'noleft' => '',
		'noright' => ''
	), $atts));
	$content = filter_shortcode($content);
	$class = '';
	if($noleft !== '')
		$class .= 'alpha ';
	if($noright !== '')
		$class .= 'omega';
	$output = '<div class="twelve columns ' . $class . '">' . $content . '</div>';
	return $output;
}
add_shortcode('thirteen_columns','vp_thirteen_columns');
function vp_thirteen_columns($atts, $content = null){
	extract(shortcode_atts(array(
		'noleft' => '',
		'noright' => ''
	), $atts));
	$content = filter_shortcode($content);
	$class = '';
	if($noleft !== '')
		$class .= 'alpha ';
	if($noright !== '')
		$class .= 'omega';
	$output = '<div class="thirteen columns ' . $class . '">' . $content . '</div>';
	return $output;
}
add_shortcode('fourteen_columns','vp_fourteen_columns');
function vp_fourteen_columns($atts, $content = null){
	extract(shortcode_atts(array(
		'noleft' => '',
		'noright' => ''
	), $atts));
	$content = filter_shortcode($content);
	$class = '';
	if($noleft !== '')
		$class .= 'alpha ';
	if($noright !== '')
		$class .= 'omega';
	$output = '<div class="fourteen columns ' . $class . '">' . $content . '</div>';
	return $output;
}
add_shortcode('fifteen_columns','vp_fifteen_columns');
function vp_fifteen_columns($atts, $content = null){
	extract(shortcode_atts(array(
		'noleft' => '',
		'noright' => ''
	), $atts));
	$content = filter_shortcode($content);
	$class = '';
	if($noleft !== '')
		$class .= 'alpha ';
	if($noright !== '')
		$class .= 'omega';
	$output = '<div class="fifteen columns ' . $class . '">' . $content . '</div>';
	return $output;
}
add_shortcode('full','vp_full');
function vp_full($atts, $content = null){
	$content = filter_shortcode($content);
	$output = '<div class="sixteen columns">' . $content . '</div>';
	return $output;
}
add_shortcode('subtext','vp_subtext');
function vp_subtext($atts, $content = null){
	$content = filter_shortcode($content);
	$output = '<p class="line2nd">' . $content . '</p>';
	return $output;
}
add_shortcode('skills','vp_skills');
function vp_skills($atts, $content = null){
	$content = filter_shortcode($content);
	return '<div class="skills"><div class="sixteen columns">' . $content . '</div></div>';
}
add_shortcode('skill','vp_skill');
function vp_skill($atts, $content = null){
	extract(shortcode_atts(array(
		'value' => '50',
		'bg' => ''
	), $atts));
	$content = filter_shortcode($content);
	$value = (int)$value;
	$rand = rand(1,5); //uses some random backgrounds, just to make them different in case the use doesn't set any
	$output = '<p> ' . $content . '</p>';
	$output .= '<div class="skill-bg"><div style="width: ' . $value . '%;';
	if($bg !== '') $output .= 'background-color: #' . esc_attr($bg);
	$output .= '" class="skill' . $rand . '"></div></div>';	
	return $output;
}
add_shortcode('lightbox', 'vp_lightbox');
function vp_lightbox($atts, $content = null) {
	extract(shortcode_atts(array(
		'alt' => 0,
		'title' => 0,
		'thumbnail' => 0,
		'width' => 250,
		'height' => 125,
		'float' => 'none'
	), $atts));

	$content = filter_shortcode($content);

	$output = '<div class="pic" style="width: ' . $width . 'px; float: ' . $float;
	if($float == 'left') 
		$output .= '; margin-right: 10px';
	elseif($float == 'right')
		$output .= '; margin-left: 10px';
	$output .= '">';
	$output .= '<div class="proj-img">' . PHP_EOL;
	if($content != '')
	{
		if($title !== 0)
			$title = ' title="' . $title . '"';
		else
			$title = '';
		if($alt !== 0)
			$alt = ' alt="' . $alt . '"';
		else
			$alt = '';
		//the shortcode should return something only if the user sends an image
		$output .= '<a href="' . $content . '" class="prettyPhoto"' . $title . $alt . '></a>' . PHP_EOL;
		if($thumbnail === 0)
		{
			$thumbnail = $content;
		}
		//if the user sends out a thumbnail img, we use that one. If not, we use the full width img to create a thumb.
		$output .= '<img ' . $alt . ' src="' . $thumbnail . '" style="width: ' . $width . 'px; height: ' . $height . 'px" />' . PHP_EOL;
		$output .= '<i>hover background</i>' . PHP_EOL;
		$output .= '</div>
		</div>' . PHP_EOL;
	}
	else
		$output = '';
		return $output;
}

add_shortcode('quote_slider', 'vp_quote_slider');
function vp_quote_slider($atts, $content=null) {
	$content = filter_shortcode($content);
	$id = rand(1, 25000);
	$output = '<div class="quote-container">
	<div class="quote-nav-left" id="quote-nav-left-' . $id . '">
		<a href="#" onclick="return false">&laquo; left</a>
	</div>
	<div class="quote-nav-right" id="quote-nav-right-' . $id . '">
		<a href="#" onclick="return false">right &raquo;</a>
	</div>
          <div class="quote-slider" id="quote-slider-' . $id . '">' . PHP_EOL;
    $output .= $content;
    $output .= '</div>
    </div>' . PHP_EOL;
    $output .= "<script type='text/javascript'>
    jQuery().ready(function() {
    jQuery('#quote-slider-$id').cycle({
    		fx: 'scrollHorz',
    		easing: 'easeInOutExpo',
    		prev: '#quote-nav-left-$id a',
    		next: '#quote-nav-right-$id a',
    		timeout: 8000
    	});
	});
    </script>" . PHP_EOL;
    return $output;
}
add_shortcode('quote', 'vp_quote');
function vp_quote($atts, $content=null) {
	extract(shortcode_atts(array(
		'author' => ''
	), $atts));

	$content = filter_shortcode($content);
	$output = '<div class="panel">
            <p>&ldquo;' . $content . '&rdquo;</p>
            <p class="quoter">' . $author . '</p>
    </div>' . PHP_EOL;
    return $output;
}

add_shortcode('slider', 'vp_slider');
function vp_slider($atts, $content=null) {
	$id = rand(0, 25000);
	$content = filter_shortcode($content);
	$output = '<div class="flexslider flex-' . $id . '">';
	$output .= '<ul class="slides">';
	$output .= $content;
	$output .= '</ul></div>';
	$output .= '
	<script type="text/javascript">
		jQuery(".flex-' . $id . '").flexslider({
				animation: "slide",
				slideshow: true,
				slideshowSpeed: 3500,
				animationSpeed: 1000
			});
	</script>';
	return $output;
}

add_shortcode('slider_img', 'vp_slider_img');
function vp_slider_img($atts, $content=null) {
	extract(shortcode_atts(array(
		'alt' => '',
		'url' => ''
	), $atts));
	$content = filter_shortcode($content);
	if($content != '')
	{
		if($url !== '')
			$output = ' <li><a target="_blank" href="' . esc_url($url) . '"><img alt="' . $alt . '" src="' . $content . '" /></a></li>' . PHP_EOL;
		else
			$output = ' <li><img alt="' . $alt . '" src="' . $content . '"></li>' . PHP_EOL;
		return $output;
	}
	else return '';
}

add_shortcode('portfolio', 'vp_portfolio');
function vp_portfolio($atts, $content=null) {
	$content = filter_shortcode($content);
	$output = '<div class="portfolio">' . PHP_EOL;
	$output .= $content;
	$output .= '</div>
	<div class="clear"></div>';
	return $output;
}

add_shortcode('filterable_portfolio', 'vp_filterable_portfolio');
function vp_filterable_portfolio($atts, $content=null) {
	extract(shortcode_atts(array(
		'categories' => '',
		'number' => 15
	), $atts));
	$id = rand(1, 50000);
	$output = '<div class="filterable-' . $id . '">';
	global $post;
	$categories = esc_attr($categories);
	$categories = str_replace(' ', '', $categories);
	$output .= '<div class="filter-categories sixteen columns">
				<div class="filter">
					<ul>
						<li><a href="" data-filter="*" class="selected">All</a></li>';
	if($categories == '')
	{
		$cats = get_categories();
		foreach($cats as $cat) {
			$output .= '<li><a href="" data-filter=".' . $cat->term_id . '">' . $cat->name . '</a></li>';
		}
	}
	else
	{
		$cats = explode(",", $categories);
		foreach($cats as $cat) {
			$cat_details = get_category($cat);
			$output .= '<li><a href="" data-filter=".' . $cat . '">' . $cat_details->name . '</a></li>';
		}
	}

	$output .= '</ul>
				</div> <!-- end filter -->
			</div> <!-- end sixteen columns -->
	<div class="clear"></div>';
	$output .= '<div class="portfolio_details"></div>';
	$categories = trim($categories);
	$number = (int)$number;
	$output .= '
	<div class="filterable_portfolio">';
	$query = new WP_Query('post_type=portfolio&posts_per_page=' . $number . '&cat=' . $categories);
	while($query->have_posts() ) : $query->the_post();
		$title = get_the_title();
		$image1 = get_post_meta($post->ID, '_portfolio_image1', true);
		$image2 = get_post_meta($post->ID, '_portfolio_image2', true);
		$image3 = get_post_meta($post->ID, '_portfolio_image3', true);
		$image4 = get_post_meta($post->ID, '_portfolio_image4', true);
		$image5 = get_post_meta($post->ID, '_portfolio_image5', true);
		$image6 = get_post_meta($post->ID, '_portfolio_image6', true);
		$video1 = get_post_meta($post->ID, '_portfolio_video1', true);
		$type = get_post_meta($post->ID, '_portfolio_type', true);
		$size = get_post_meta($post->ID, '_portfolio_size', true);
		$description = get_post_meta($post->ID, '_portfolio_description', true);
		$buttontext = get_post_meta($post->ID, '_portfolio_buttontext', true);
		$buttonurl = get_post_meta($post->ID, '_portfolio_buttonurl', true);
		$thumbnail = get_post_meta($post->ID, '_portfolio_thumb', true);
		$video = get_post_meta($post->ID, '_portfolio_video', true);
		if($image1 != '' || $video1 != '')
		{ 
			if($thumbnail == '') {
				if($image1 != '')
					$thumbnail = $image1;
				elseif($image2 != '')
					$thumbnail = $image2;
				elseif($image3 != '')
					$thumbnail = $image2;
				elseif($image4 != '')
					$thumbnail = $image4;
				elseif($image5 != '')
					$thumbnail = $image5;
				elseif($image6 != '')
					$thumbnail = $image6;
			}
			$class = '';
			switch($size)
			{
				case 1:
					$class = 'class="item sixteen columns ';
					break;
				case 2:
					$class = 'class="item eight columns ';
					break;
				case 3:
					$class = 'class="item one-third column ';
					break;
				case 4: 
					$class = 'class="item four columns ';
					break;
				default:
					$class = 'class="item one-third column ';
			}
			$cats = get_the_category();
			foreach($cats as $cat)
				$class .= $cat->term_id . ' ';
			$class .= '"';
			$output .= '<div style="text-align: center" ' . $class . '>';
			if($video != '') //if the video field is not empty, we will show the video upon clicking on the zoom icon
				$zoomlink = $video;
			else
				if($image1 != '')
					$zoomlink = $image1;
				elseif($image2 != '')
					$zoomlink = $image2;
				elseif($image3 != '')
					$zoomlink = $image3;
				elseif($image4 != '')
					$zoomlink = $image4;
				elseif($image5 != '')
					$zoomlink = $image5;
				elseif($image6 != '')
					$zoomlink = $image6;
			$output .= '<div class="image">
			<a class="portf-load" rel="nofollow" href="' . get_permalink() . '"><img src="' . $thumbnail . '" class="scale-with-grid" alt="" /></a> 
			<div class="hoverimage">
				<div class="overlay-img"></div>
				<a href="' . $zoomlink . '" class="prettyPhoto">
					<img class="icn1" src="' . get_template_directory_uri() . '/images/overlay-icn1.png" alt="" />
				</a>
				<a class="portf-load" rel="nofollow" href="' . get_permalink() . '">
					<img class="icn2" src="' . get_template_directory_uri() . '/images/overlay-icn2.png" alt="" />
				</a>
			</div>
			</div>
			<p class="proj-title">' . $title . '</p>
			<p class="proj-desc">' . substr($description, 0, 130) . '...</p>';
			$output .= '</div>';
		}
		endwhile;
	$output .= '</div>
	</div>';
	$output .= '
	<script type="text/javascript">
		jQuery(window).load(function() {
			jQuery(".filterable-' . $id . ' .filterable_portfolio").isotope({
			 	 // options
			  	itemSelector : ".item",
			});

			jQuery(".filterable-' . $id . ' .filterable_portfolio").isotope({ filter: "*" });

			//filtering
			jQuery(".filterable-' . $id . ' .filter-categories a").click(function(){
				jQuery(".filterable-' . $id . ' .filter-categories a").removeClass("selected");
			  	var selector = jQuery(this).attr("data-filter");
			  	jQuery(this).addClass("selected");
			 	jQuery(".filterable-' . $id . ' .filterable_portfolio").isotope({ filter: selector });
			 	return false;
			});

			jQuery(".filterable-' . $id . ' a.portf-load").on("click", function(e) {
				e.preventDefault();
				var url = jQuery(this).attr("href");
				jQuery.get(url, function(data) {
					jQuery(".filterable-' . $id . ' .portfolio_details").show(600).html(data);
					var scrollTarget = jQuery(".filterable-' . $id . ' .portfolio_details").offset().top;
			        jQuery("html,body").animate({scrollTop:scrollTarget-80}, 1000, "swing");
				});
			});
		});
	</script>';
	$output .= '<div class="clear"></div>';
	return $output;
}

add_shortcode('portfolio_item', 'vp_portfolio_item');
function vp_portfolio_item($atts, $content=null) {
	extract(shortcode_atts(array(
		'thumbnail' => '',
		'image' => '',
		'title' => '',
		'text' => '',
		'columns' => 3,
		'centered' => 'no',
		'alt' => '',
	), $atts));
	switch($columns)
	{
		case 1:
			$class = 'class="sixteen columns"';
			break;
		case 2:
			$class = 'class="eight columns"';
			break;
		case 3:
			$class = 'class="one-third column"';
			break;
		case 4: 
			$class = 'class="four columns"';
			break;
	}
	if($thumbnail === '')
		$thumbnail = $image;
	if($image !== '')
	{
		if($centered == 'yes')
			$var = ' style="text-align: center" ';
		else
			$var = '';
		$output = '<div ' . $var . $class . '>';
		$output .= '<a class="prettyPhoto" href="' . esc_attr($image) . '"><img alt="' . esc_attr($alt) . '" class="scale-with-grid" src="' . esc_attr($thumbnail) . '" /></a>';
		$output .= '<p class="proj-title">' . esc_attr($title) . '</p>';
		$output .= '<p class="proj-desc">' . esc_attr($text) . '</p>';
		$output .= '</div>';
		return $output;
	}
	else return '';
}
add_shortcode('button', 'vp_button');
function vp_button($atts, $content=null) {
	extract(shortcode_atts(array(
		'url' => '',
		'newwindow' => 'no',
		'color' => 'FADBA1'
	), $atts));
	$content = filter_shortcode($content);
	$color = esc_attr($color);
	if($newwindow == 'yes')
		$target = ' target="_blank" ';
	else
		$target = '';
	if($content !== '')
	{
		if($color === 'FADBA1')
		{
			if($url === '')
				$output = '<div class="button1">' . $content . '</div>';
			else
				$output = '<a ' . $target . ' href="' . esc_url($url) . '"><div class="button1">' . $content . '</div></a>';
		}
		else
		{
			if($url === '')
				$output = '<div class="button2" style="background-color: #' . $color . '">' . $content . '</div>';
			else
				$output = '<a ' . $target . ' href="' . esc_url($url) . '"><div class="button2" style="background-color: #' . $color . '">' . $content . '</div></a>';
		}
		return $output;
	}
	else return '';
}

add_shortcode('testimonial', 'vp_testimonial');
function vp_testimonial($atts, $content=null) {
	$content = filter_shortcode($content);
	return '<div class="testimonials">
	<p>&ldquo;' . $content . '&rdquo;</p>
	</div>';
}


add_shortcode('clear', 'vp_clear');
function vp_clear($atts, $content=null) {
	return '<div class="clear"></div>';
}
add_shortcode('center', 'vp_centered');
function vp_centered($atts, $content=null) {
	$content = filter_shortcode($content);
	return '<div style="text-align: center">' . $content . '</div>';
}
add_shortcode('list', 'vp_list');
function vp_list($atts, $content=null) {
	extract(shortcode_atts(array(
		'type' => 'bullet'
	), $atts));
	$content = filter_shortcode($content);
	if($type == 'bullet')
		$output = '<ul class="list bullet">';
	elseif($type == 'check')
		$output = '<ul class="list check">';
	elseif($type == 'float')
		$output = '<ul class="list float">';
	else return '';
	$output .= $content;
	$output .= '</ul>';
	return $output;
}

add_shortcode('twitter_updates', 'vp_twitter_updates');
function vp_twitter_updates($atts, $content=null) {
	$output = '<div class="last_tweets">
					<div id="twitter_update_list"></div>
				</div> <!-- end last_tweets -->';
	return $output;
}

add_shortcode('pricing_table','til_pricing_table');
function til_pricing_table($atts, $content = null){
	extract(shortcode_atts(array(
		'name' => '',
		'price' => '',
		'price_text' => '',
		'moretext' => 'Sign up',
		'morelink' => '',
		'columns' => '4'
	), $atts));
	switch($columns)
	{
		case 1:
			$class = 'class="sixteen columns pricing"';
			break;
		case 2:
			$class = 'class="eight columns pricing"';
			break;
		case 3:
			$class = 'class="one-third column pricing"';
			break;
		case 4: 
			$class = 'class="four columns pricing"';
			break;
		default:
			$class = 'class="one-third column pricing"';
			break;
	}
	$content = filter_shortcode($content);
	$name = esc_attr($name);
	$price = esc_attr($price);
	$price_text = esc_attr($price_text);
	$moretext = esc_attr($moretext);
	$morelink = esc_url($morelink);
	$output = '';
	$output .= '<div ' . $class .'>';
	if($name !== '')
		$output .= '<p class="p-name">' . $name . '</p>';
	if($price !== '')
	{
		$output .= '<p class="p-price">' . $price;
		if ($price_text !== '') {
			$output .= '<span class="p-small">' . $price_text . '</span>';
		}
		$output .= '</p>';
	}
	$output .= '<ul>' . $content . '</ul>';
	$output .= '<div class="signup"><div class="button2">';
	if($morelink !== '')
		$output .= '<a href="' . $morelink . '">' . $moretext . '</a>';
	else
		$output .= $moretext;
	$output .= '</div></div>
	</div>';
	return $output;
}
add_shortcode('feature','vp_feature');
function vp_feature($atts, $content = null){
	$content = filter_shortcode($content);
	if($content != '')
		return '<li>' . $content . '</li>';	
}

add_shortcode('facebook_small','vp_facebook_small');
function vp_facebook_small($atts, $content = null) {
	extract(shortcode_atts(array(
		"username" => '',
	), $atts));
	if($username !== '')
		$output = '<div class="facebook_small">
			<a href="http://facebook.com/' . esc_html($username) . '/" title="facebook">Visit our facebook Account</a>
		</div>';
	else 
		$output = '';
	return $output;
}

add_shortcode('twitter_small','vp_twitter_small');
function vp_twitter_small($atts, $content = null) {
	extract(shortcode_atts(array(
		"username" => '',
	), $atts));
	if($username !== '')
		$output = '<div class="twitter2_small">
			<a href="http://twitter.com/#!/' . esc_html($username) . '/" title="twitter">Visit our twitter Account</a>
		</div>';
	else 
		$output = '';
	return $output;
}

add_shortcode('twitter_big','vp_twitter_big');
function vp_twitter_big($atts, $content = null) {
	extract(shortcode_atts(array(
		"username" => '',
	), $atts));
	if($username !== '')
		$output = '<div class="twitter_small">
			<a href="http://twitter.com/#!/' . esc_html($username) . '/" title="twitter">Visit our twitter Account</a>
		</div>';
	else 
		$output = '';
	return $output;
}

add_shortcode('dribble_small','vp_dribble_small');
function vp_dribble_small($atts, $content = null) {
	extract(shortcode_atts(array(
		"username" => '',
	), $atts));
	if($username !== '')
		$output = '<div class="dribble_small">
			<a href="http://dribbble.com/' . esc_html($username) . '/" title="dribble">Visit our dribble Account</a>
		</div>';
	else 
		$output = '';
	return $output;
}

add_shortcode('vimeo_small','vp_vimeo_small');
function vp_vimeo_small($atts, $content = null) {
	extract(shortcode_atts(array(
		"username" => '',
	), $atts));
	if($username !== '')
		$output = '<div class="vimeo_small">
			<a href="http://vimeo.com/' . esc_html($username) . '/" title="vimeo">Visit our vimeo Account</a>
		</div>';
	else 
		$output = '';
	return $output;
}

add_shortcode('flickr_small','vp_flickr_small');
function vp_flickr_small($atts, $content = null) {
	extract(shortcode_atts(array(
		"username" => '',
	), $atts));
	if($username !== '')
		$output = '<div class="flickr_small">
			<a href="http://www.flickr.com/people/' . esc_html($username) . '/" title="flickr">Visit our flickr Account</a>
		</div>';
	else 
		$output = '';
	return $output;
}
add_shortcode('header','vp_header');
function vp_header($atts, $content = null) {
	$content = filter_shortcode($content);
	$output = '<h3 style="text-align: center; margin-top: 25px"><span class="lines">' . $content . '</span></h3>';
	return $output;
}
add_shortcode('subheader','vp_subheader');
function vp_subheader($atts, $content = null) {
	$content = filter_shortcode($content);
	$output = '<div class="action"><p>' . $content . '</p></div>';
	return $output;
}
add_shortcode('team','vp_team');
function vp_team($atts, $content = null) {
	extract(shortcode_atts(array(
		"image" => '',
		"name" => '',
		"position" => '',
		"description" => '',
		"twitter" => '',
		"facebook" => '',
		"dribble" => '',
		"skype" => '',
		"gplus" => '',
		"linkedin" => '',
		"pinterest" => '',
		"columns" => 3
	), $atts));
	switch($columns)
	{
		case 1:
			$class = 'class="sixteen columns team"';
			break;
		case 2:
			$class = 'class="eight columns team"';
			break;
		case 3:
			$class = 'class="one-third column team"';
			break;
		case 4: 
			$class = 'class="four columns team"';
			break;
		default:
			$class = 'class="one-third column team';
			break;
	}
	$output = '<div ' . $class . '>';
	if($image !== '')
		$output .= '<img alt="' . esc_attr($name) . '" class="scale-with-grid" src="' . esc_attr($image) . '" />';
	if($name !== '')
		$output .= '<p class="t-name">' . esc_attr($name) . '</p>';
	if($position !== '')
		$output .= '<p class="t-type">' . esc_attr($position) . '</p>';
	if($description !== '')
		$output .= '<p>' . esc_attr($description) . '</p>';
	$output .= '<ul>';
	if($twitter !== '')
		$output .= '<li><a target="_blank" href="' . esc_url($twitter) . '"><img alt="Twitter icon" src="' . get_stylesheet_directory_uri() . '/images/icn-twitter.png" /></a></li>';
	if($facebook !== '')
		$output .= '<li><a target="_blank" href="' . esc_url($facebook) . '"><img alt="Facebook icon" src="' . get_stylesheet_directory_uri() . '/images/icn-facebook.png" /></a></li>';
	if($dribble !== '')
		$output .= '<li><a target="_blank" href="' . esc_url($dribble) . '"><img alt="Dribbble icon" src="' . get_stylesheet_directory_uri() . '/images/icn-dribbble.png" /></a></li>';
	if($skype !== '')
		$output .= '<li><a target="_blank" href="' . esc_attr($skype) . '"><img alt="Skype icon" src="' . get_stylesheet_directory_uri() . '/images/icn-skype.png" /></a></li>';
	if($gplus !== '')
		$output .= '<li><a target="_blank" href="' . esc_url($gplus) . '"><img alt="Google+ icon" src="' . get_stylesheet_directory_uri() . '/images/icn-gplus.png" /></a></li>';
	if($linkedin !== '')
		$output .= '<li><a target="_blank" href="' . esc_url($linkedin) . '"><img alt="LinkedIn icon" src="' . get_stylesheet_directory_uri() . '/images/icn-linkedin.png" /></a></li>';
	if($pinterest !== '')
		$output .= '<li><a target="_blank" href="' . esc_url($pinterest) . '"><img alt="Pinterest icon" src="' . get_stylesheet_directory_uri() . '/images/icn-pinterest.png" /></a></li>';
	$output .= '</ul>
	</div>';
	return $output;
}
add_shortcode('service','vp_service');
function vp_service($atts, $content = null) {
	extract(shortcode_atts(array(
		"title" => '',
		"image" => '',
		"text" => '',
		"columns" => '3',
		"url" => ''
	), $atts));
	switch($columns)
	{
		case 1:
			$class = 'class="sixteen columns serv-list"';
			break;
		case 2:
			$class = 'class="eight columns serv-list"';
			break;
		case 3:
			$class = 'class="one-third column serv-list"';
			break;
		case 4: 
			$class = 'class="four columns serv-list"';
			break;
		default:
			$class = 'class="one-third column serv-list"';
			break;
	}
	$text = esc_attr($text);
	$image = esc_attr($image);
	$title = esc_attr($title);
	$output = '<div ' . $class . '>';
	if($title != '')
		$output .= '<h4>' . $title . '</h4>';
	if($image != '')  {
		if($url != '') {
			$output .= '<a href="' . esc_url($url) . '"><img alt="" src="' . $image . '" /></a>';
		}
		else {
			$output .= '<img alt="" src="' . $image . '" />';
		}
	}
	if($text != '')
		$output .= '<p>' . $text . '</p>';
	$output .= '</div>';
	return $output;
}
?>