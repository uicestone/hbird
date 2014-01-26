<?php
/* Aqua Tabs Block */
if(!class_exists('AQ_Portfolio_Block')) {
	class AQ_Portfolio_Block extends AQ_Block {
	
		function __construct() {
			$block_options = array(
				'name' => 'Simple Portfolio',
				'size' => 'span12',
			);
			
			//create the widget
			parent::__construct('AQ_Portfolio_Block', $block_options);
						
		//add ajax functions
			add_action('wp_ajax_aq_block_portfolio_add_new', array($this, 'add_slide'));
			
		}
		
		function form($instance) {
		
			$defaults = array(
				'portfolios' => array(
					1 => array(
						'image' => '',
						'thumbnail' => '',
						'title' => '',
						'text' => '',
						'columns' => 3,
						'centered' => 'no',
						'url' => '',
						'alt' => '',
					)
				)
			);
			
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			?>
			<div class="description cf">
				<ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
					<?php
					$portfolios = is_array($portfolios) ? $portfolios : $defaults['portfolios'];
					$count = 1;
					foreach($portfolios as $portfolio) {	
						$this->portfolio($portfolio, $count);
						$count++;
					}
					?>
				</ul>
				<p></p>
				<a href="#" rel="portfolio" class="aq-sortable-add-new button">Add New</a>
				<p></p>
			</div>
			<?php
		}
		
		function portfolio($portfolio = array(), $count = 0) {
				global $block_id;
			?>
			<li id="<?php echo $this->get_field_id('portfolios') ?>-sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
				
				<div class="sortable-head cf">
					<div class="sortable-title">
						<strong>Portfolio #<?php echo $count; ?></strong>
					</div>
					<div class="sortable-handle">
						<a href="#">Open / Close</a>
					</div>
				</div>
				
				<div class="sortable-body">
					<p class="portfolio-image description half">
						<label for="<?php echo $this->get_field_id('portfolios') ?>-<?php echo $count ?>-image">
							Portfolio image<br/>
							<input type="text" id="<?php echo $this->get_field_id('portfolios') ?>-<?php echo $count ?>-image" class="input-full input-upload" name="<?php echo $this->get_field_name('portfolios') ?>[<?php echo $count ?>][image]" value="<?php echo $portfolio['image'] ?>" />
							<a href="#" class="aq_upload_button button" rel="image">Upload</a><p></p>
						</label>
					</p>
					<p class="portfolio-thumbnail description half last">
						<label for="<?php echo $this->get_field_id('portfolios') ?>-<?php echo $count ?>-thumbnail">
							Portfolio thumbnail<br/>
							<input type="text" id="<?php echo $this->get_field_id('portfolios') ?>-<?php echo $count ?>-thumbnail" class="input-full input-upload" name="<?php echo $this->get_field_name('portfolios') ?>[<?php echo $count ?>][thumbnail]" value="<?php echo $portfolio['thumbnail'] ?>" />
							<a href="#" class="aq_upload_button button" rel="image">Upload</a><p></p>
						</label>
					</p>
					<p class="portfolio-title description half">
						<label for="<?php echo $this->get_field_id('portfolios') ?>-<?php echo $count ?>-title">
							Portfolio title<br/>
							<input type="text" id="<?php echo $this->get_field_id('portfolios') ?>-<?php echo $count ?>-title" class="input-full" name="<?php echo $this->get_field_name('portfolios') ?>[<?php echo $count ?>][title]" value="<?php echo $portfolio['title'] ?>" />
						</label>
					</p>
					<p class="portfolio-description description half last">
						<label for="<?php echo $this->get_field_id('portfolios') ?>-<?php echo $count ?>-text">
							Portfolio description<br/>
							<textarea id="<?php echo $this->get_field_id('portfolios') ?>-<?php echo $count ?>-text" class="textarea-full" name="<?php echo $this->get_field_name('portfolios') ?>[<?php echo $count ?>][text]"><?php echo $portfolio['text'] ?></textarea>
						</label>
					</p>
					<p class="portfolio-columns description half">
						<label for="<?php echo $this->get_field_id('portfolios') ?>-<?php echo $count ?>-columns">
							Portfolio columns<br/>
							<select id="<?php echo $this->get_field_id('portfolios') ?>-<?php echo $count ?>-columns" name="<?php echo $this->get_field_name('portfolios') ?>[<?php echo $count ?>][columns]">
								<option <?php if($portfolio['columns'] == 1) echo 'selected="selected"';?> value="1">1 column</option>
								<option <?php if($portfolio['columns'] == 2) echo 'selected="selected"';?> value="2">2 columns</option>
								<option <?php if($portfolio['columns'] == 3) echo 'selected="selected"';?> value="3">3 columns</option>
								<option <?php if($portfolio['columns'] == 4) echo 'selected="selected"';?> value="4">4 columns</option>
							</select>
						</label>
					</p>

					<p class="portfolio-centered description half last">
						<label for="<?php echo $this->get_field_id('portfolios') ?>-<?php echo $count ?>-centered">
							Is the portfolio item centered?<br/>
							<select id="<?php echo $this->get_field_id('portfolios') ?>-<?php echo $count ?>-centered" name="<?php echo $this->get_field_name('portfolios') ?>[<?php echo $count ?>][centered]">
								<option <?php if($portfolio['centered'] == 'no') echo 'selected="selected"';?> value="no">No</option>
								<option <?php if($portfolio['centered'] == 'yes') echo 'selected="selected"';?> value="yes">Yes</option>
							</select>
						</label>
					</p>
					<p class="portfolio-description description">
						<label for="<?php echo $this->get_field_id('portfolios') ?>-<?php echo $count ?>-alt">
							Portfolio image alt description<br/>
							<input type="text" id="<?php echo $this->get_field_id('portfolios') ?>-<?php echo $count ?>-alt" class="input-full" name="<?php echo $this->get_field_name('portfolios') ?>[<?php echo $count ?>][alt]" value="<?php echo $portfolio['alt'] ?>" />
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

			foreach($portfolios as $portfolio) { 
				$columns = $portfolio['columns'];
				$thumbnail = $portfolio['thumbnail'];
				$image = $portfolio['image'];
				$centered = $portfolio['centered'];
				$title = $portfolio['title'];
				$text = $portfolio['text'];
				$alt = $portfolio['alt'];

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
					echo $output;
				}
				else
					echo '';
			}
			
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
				'thumbnail' => '',
				'title' => '',
				'text' => '',
				'columns' => 3,
				'centered' => 'no',
				'url' => '',
				'alt' => '',
			);
			
			if($count) {
				$this->portfolio($slidev, $count);
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
