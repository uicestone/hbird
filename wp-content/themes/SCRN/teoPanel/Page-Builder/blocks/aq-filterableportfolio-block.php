<?php
/* Aqua Tabs Block */
if(!class_exists('AQ_FilterablePortfolio_Block')) {
	class AQ_FilterablePortfolio_Block extends AQ_Block {
	
		function __construct() {
			$block_options = array(
				'name' => 'Filterable Portfolio',
				'size' => 'span12',
			);
			
			//create the widget
			parent::__construct('AQ_FilterablePortfolio_Block', $block_options);
						
		}
		
		function form($instance) {
		
		$defaults = array(
			'categories' => '',
			'nrposts' => 15
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		$tempp = get_categories();
		$cats = array();
		foreach($tempp as $cat) {
			$cats[$cat->term_id] = $cat->name;
		}
		?>
		<p class="description">
			<label for="<?php echo $this->get_field_id('categories') ?>">
				Categories included:
				<?php echo aq_field_multiselect('categories', $block_id, $cats, $categories ) ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('nrposts') ?>">
				Number of posts:
				<?php echo aq_field_input('nrposts', $block_id, $nrposts, $size = 'full') ?>
			</label>
		</p>
		
		<?php
	}
	
	function block($instance) {
		extract($instance);

		$output = '<div class="filter-categories">
			<div class="filter">
				<ul>
					<li><a href="" data-filter="*" class="selected">All</a></li>';
		foreach($categories as $cat) {
			$cat_details = get_category($cat);
			$output .= '<li><a href="" data-filter=".' . $cat . '">' . $cat_details->name . '</a></li>';
		}
		$output .= '</ul>
				</div> <!-- end filter -->
			</div> <!-- end filter-categories -->
			<div class="clear"></div>';
		$output .= '<div class="portfolio_details"></div>
			<div class="filterable_portfolio">';
		$args = array();
		$args['post_type'] = 'portfolio';
		$args['posts_per_page'] = $nrposts;
		if(isset($categories) && count($categories) > 0) {
			$args['category__in'] = $categories;
		}
		$query = new WP_Query($args);
		while($query->have_posts() ) : $query->the_post(); global $post;
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
		endwhile; wp_reset_postdata();
	$output .= '</div>
	<div class="clear"></div>';
	echo $output;
	}
	function update($new_instance, $old_instance) {
		return $new_instance;
	}

	}
}