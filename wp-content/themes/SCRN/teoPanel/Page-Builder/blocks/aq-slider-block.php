<?php
/* Aqua Tabs Block */
if(!class_exists('AQ_Slider_Block')) {
	class AQ_Slider_Block extends AQ_Block {
	
		function __construct() {
			$block_options = array(
				'name' => 'Image Slider',
				'size' => 'span12',
			);
			
			//create the widget
			parent::__construct('AQ_Slider_Block', $block_options);
			
			//add ajax functions
			add_action('wp_ajax_aq_block_slide_add_new', array($this, 'add_slide'));
			
		}
		
		function form($instance) {
		
			$defaults = array(
				'slides' => array(
					1 => array(
						'image' => '',
						'alt' => 'Image alt description',
						'url' => '',
					)
				)
			);
			
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			?>
			<div class="description cf">
				<ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
					<?php
					$slides = is_array($slides) ? $slides : $defaults['slides'];
					$count = 1;
					foreach($slides as $slide) {	
						$this->slide($slide, $count);
						$count++;
					}
					?>
				</ul>
				<p></p>
				<a href="#" rel="slide" class="aq-sortable-add-new button">Add New</a>
				<p></p>
			</div>
			<?php
		}
		
		function slide($slide = array(), $count = 0) {
				global $block_id;
			?>
			<li id="<?php echo $this->get_field_id('slides') ?>-sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
				
				<div class="sortable-head cf">
					<div class="sortable-title">
						<strong>Slide <?php echo $count; ?></strong>
					</div>
					<div class="sortable-handle">
						<a href="#">Open / Close</a>
					</div>
				</div>
				
				<div class="sortable-body">
					<p class="skill-image description half">
						<label for="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-image">
							Slide image<br/>
							<input type="text" id="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-image" class="input-full input-upload" name="<?php echo $this->get_field_name('slides') ?>[<?php echo $count ?>][image]" value="<?php echo $slide['image'] ?>" />
							<a href="#" class="aq_upload_button button" rel="image">Upload</a><p></p>
						</label>
					</p>
					<p class="skill-alt description half last">
						<label for="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-alt">
							Image alt description<br/>
							<input type="text" id="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-alt" class="input-full" name="<?php echo $this->get_field_name('slides') ?>[<?php echo $count ?>][alt]" value="<?php echo $slide['alt'] ?>" />
						</label>
					</p>
					<p class="skill-url description half last">
						<label for="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-url">
							Image url(if you want to link it somewhere)<br/>
							<input type="text" id="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-url" class="input-full" name="<?php echo $this->get_field_name('slides') ?>[<?php echo $count ?>][url]" value="<?php echo $slide['url'] ?>" />
						</label>
					</p>

					<p class="skill-desc description"><a href="#" class="sortable-delete">Delete</a></p>
				</div>
				
			</li>
			<?php
		}
		
		function block($instance) {
			extract($instance);
			
			$output = '';

			$id = rand(1, 25000);

			$output = '<div class="flexslider flex-' . $id . '">';
			$output .= '<ul class="slides">';
					
			foreach( $slides as $slide ){
				if($slide['url'] !== '')
					$output .= ' <li><a target="_blank" href="' . esc_url($slide['url']) . '"><img alt="' . $slide['alt'] . '" src="' . $slide['image'] . '" /></a></li>' . PHP_EOL;
				else
					$output .= ' <li><img alt="' . $slide['alt'] . '" src="' . $slide['image'] . '"></li>' . PHP_EOL;

			}
					
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
				
			echo $output;
			
		}
		
		/* AJAX add slide */
		function add_slide() {
			$nonce = $_POST['security'];
			if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
			
			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
			
			//default key/value for the tab
			$slidev = array(
				'image' => '',
				'alt' => 'Image alt description',
				'url' => '',
			);
			
			if($count) {
				$this->slide($slidev, $count);
			} else {
				die(-1);
			}
			
			die();
		}
		
		function update($new_instance, $old_instance) {
			$new_instance = aq_recursive_sanitize($new_instance);
			return $new_instance;
		}
	}
}
