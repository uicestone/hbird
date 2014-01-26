<?php
/* Aqua Tabs Block */
if(!class_exists('AQ_Service_Block')) {
	class AQ_Service_Block extends AQ_Block {
	
		function __construct() {
			$block_options = array(
				'name' => 'Services',
				'size' => 'span12',
			);
			
			//create the widget
			parent::__construct('AQ_Service_Block', $block_options);
						
		//add ajax functions
			add_action('wp_ajax_aq_block_service_add_new', array($this, 'add_service'));
			
		}
		
		function form($instance) {
		
			$defaults = array(
				'services' => array(
					1 => array(
						"title" => '',
						"image" => '',
						"text" => '',
						"columns" => '3',
						"url" => ''
					)
				)
			);
			
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			?>
			<div class="description cf">
				<ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
					<?php
					$services = is_array($services) ? $services : $defaults['services'];
					$count = 1;
					foreach($services as $service) {	
						$this->service($service, $count);
						$count++;
					}
					?>
				</ul>
				<p></p>
				<a href="#" rel="service" class="aq-sortable-add-new button">Add New</a>
				<p></p>
			</div>
			<?php
		}
		
		function service($service = array(), $count = 0) {
				global $block_id;
			?>
			<li id="<?php echo $this->get_field_id('services') ?>-sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
				
				<div class="sortable-head cf">
					<div class="sortable-title">
						<strong>Service #<?php echo $count; ?></strong>
					</div>
					<div class="sortable-handle">
						<a href="#">Open / Close</a>
					</div>
				</div>
				
				<div class="sortable-body">
					<p class="service-title description half">
						<label for="<?php echo $this->get_field_id('services') ?>-<?php echo $count ?>-title">
							Service title<br/>
							<input type="text" id="<?php echo $this->get_field_id('services') ?>-<?php echo $count ?>-title" class="input-full" name="<?php echo $this->get_field_name('services') ?>[<?php echo $count ?>][title]" value="<?php echo $service['title'] ?>" />
						</label>
					</p>
					<p class="service-image description half last">
						<label for="<?php echo $this->get_field_id('services') ?>-<?php echo $count ?>-image">
							Service image<br/>
							<input type="text" id="<?php echo $this->get_field_id('services') ?>-<?php echo $count ?>-image" class="input-full input-upload" name="<?php echo $this->get_field_name('services') ?>[<?php echo $count ?>][image]" value="<?php echo $service['image'] ?>" />
							<a href="#" class="aq_upload_button button" rel="image">Upload</a>
						</label>
					</p>
					<br /><br /><br /><br />
					<p class="service-text description half">
						<label for="<?php echo $this->get_field_id('services') ?>-<?php echo $count ?>-text">
							Service text<br/>
							<textarea id="<?php echo $this->get_field_id('services') ?>-<?php echo $count ?>-text" class="textarea-full" name="<?php echo $this->get_field_name('services') ?>[<?php echo $count ?>][text]"><?php echo $service['text'] ?></textarea>
						</label>
					</p>
					<p class="service-url description half last">
						<label for="<?php echo $this->get_field_id('services') ?>-<?php echo $count ?>-url">
							Service url(if applicable)<br/>
							<input type="text" id="<?php echo $this->get_field_id('services') ?>-<?php echo $count ?>-url" class="input-full" name="<?php echo $this->get_field_name('services') ?>[<?php echo $count ?>][url]" value="<?php echo $service['url'] ?>" />
							<em>By default there's no link used, but you can override it if you want to link the service image anywhere</em>
						</label>
					</p>
					<br /><br /><br /><br /><br /><br />
					<p class="service-columns description">
						<label for="<?php echo $this->get_field_id('services') ?>-<?php echo $count ?>-columns">
							Number of team services per line<br/>
							<select id="<?php echo $this->get_field_id('services') ?>-<?php echo $count ?>-columns" name="<?php echo $this->get_field_name('services') ?>[<?php echo $count ?>][columns]">
								<option <?php if($service['columns'] == 1) echo 'selected="selected"';?> value="1">1 column</option>
								<option <?php if($service['columns'] == 2) echo 'selected="selected"';?> value="2">2 columns</option>
								<option <?php if($service['columns'] == 3) echo 'selected="selected"';?> value="3">3 columns</option>
								<option <?php if($service['columns'] == 4) echo 'selected="selected"';?> value="4">4 columns</option>
							</select>
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

			foreach($services as $service) {

				$title = $service['title'];
				$image = $service['image'];
				$text = $service['text'];
				$columns = $service['columns'];
				$url = $service['url'];

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
				echo $output;
			}
			
		}
		
		/* AJAX add slide */
		function add_service() {
			$nonce = $_POST['security'];
			if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
			
			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
			
			//default key/value for the tab
			$slidev = array(
				"title" => '',
				"image" => '',
				"text" => '',
				"columns" => '3',
				"url" => ''
			);
			
			if($count) {
				$this->service($slidev, $count);
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
