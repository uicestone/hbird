<?php
/* Aqua Tabs Block */
if(!class_exists('AQ_PricingTable_Block')) {
	class AQ_PricingTable_Block extends AQ_Block {
	
		function __construct() {
			$block_options = array(
				'name' => 'Pricing tables',
				'size' => 'span12',
			);
			
			//create the widget
			parent::__construct('AQ_PricingTable_Block', $block_options);
						
		//add ajax functions
			add_action('wp_ajax_aq_block_table_add_new', array($this, 'add_table'));
			
		}
		
		function form($instance) {
		
			$defaults = array(
				'tables' => array(
					1 => array(
						'name' => '',
						'price' => '',
						'pricetext' => '',
						'moretext' => 'Sign up',
						'morelink' => '',
						'columns' => 4,
						'features' => ''
					)
				)
			);
			
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			?>
			<div class="description cf">
				<ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
					<?php
					$tables = is_array($tables) ? $tables : $defaults['tables'];
					$count = 1;
					foreach($tables as $table) {	
						$this->table($table, $count);
						$count++;
					}
					?>
				</ul>
				<p></p>
				<a href="#" rel="table" class="aq-sortable-add-new button">Add New</a>
				<p></p>
			</div>
			<?php
		}
		
		function table($table = array(), $count = 0) {
				global $block_id;
			?>
			<li id="<?php echo $this->get_field_id('tables') ?>-sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
				
				<div class="sortable-head cf">
					<div class="sortable-title">
						<strong>Pricing table #<?php echo $count; ?></strong>
					</div>
					<div class="sortable-handle">
						<a href="#">Open / Close</a>
					</div>
				</div>
				
				<div class="sortable-body">
					<p class="table-name description">
						<label for="<?php echo $this->get_field_id('tables') ?>-<?php echo $count ?>-name">
							Name<br/>
							<input type="text" id="<?php echo $this->get_field_id('tables') ?>-<?php echo $count ?>-name" class="input-full" name="<?php echo $this->get_field_name('tables') ?>[<?php echo $count ?>][name]" value="<?php echo $table['name'] ?>" />
						</label>
					</p>
					<p class="table-price description half">
						<label for="<?php echo $this->get_field_id('tables') ?>-<?php echo $count ?>-price">
							Price<br/>
							<input type="text" id="<?php echo $this->get_field_id('tables') ?>-<?php echo $count ?>-price" class="input-full" name="<?php echo $this->get_field_name('tables') ?>[<?php echo $count ?>][price]" value="<?php echo $table['price'] ?>" />
						</label>
					</p>
					<p class="table-pricetext description half last">
						<label for="<?php echo $this->get_field_id('tables') ?>-<?php echo $count ?>-pricetext">
							Price text<br/>
							<input type="text" id="<?php echo $this->get_field_id('tables') ?>-<?php echo $count ?>-pricetext" class="input-full" name="<?php echo $this->get_field_name('tables') ?>[<?php echo $count ?>][pricetext]" value="<?php echo $table['pricetext'] ?>" />
							<em>You can use extra details like / month, / year, etc</em>
						</label>
					</p>
					<p class="table-moretext description half">
						<label for="<?php echo $this->get_field_id('tables') ?>-<?php echo $count ?>-moretext">
							Sign up button text<br/>
							<input type="text" id="<?php echo $this->get_field_id('tables') ?>-<?php echo $count ?>-moretext" class="input-full" name="<?php echo $this->get_field_name('tables') ?>[<?php echo $count ?>][moretext]" value="<?php echo $table['moretext'] ?>" />
							<em>Use this if you want to override the default Sign up text</em>
						</label>
					</p>
					<p class="table-morelink description half last">
						<label for="<?php echo $this->get_field_id('tables') ?>-<?php echo $count ?>-morelink">
							Sign up link(if used)<br/>
							<input type="text" id="<?php echo $this->get_field_id('tables') ?>-<?php echo $count ?>-morelink" class="input-full" name="<?php echo $this->get_field_name('tables') ?>[<?php echo $count ?>][morelink]" value="<?php echo $table['morelink'] ?>" />
							<em>Use this if you want to link the button somewhere</em>
						</label>
					</p>
					<p class="table-columns description half">
						<label for="<?php echo $this->get_field_id('tables') ?>-<?php echo $count ?>-columns">
							Number of tables per line<br/>
							<select id="<?php echo $this->get_field_id('tables') ?>-<?php echo $count ?>-columns" name="<?php echo $this->get_field_name('tables') ?>[<?php echo $count ?>][columns]">
								<option <?php if($table['columns'] == 1) echo 'selected="selected"';?> value="1">1 column</option>
								<option <?php if($table['columns'] == 2) echo 'selected="selected"';?> value="2">2 columns</option>
								<option <?php if($table['columns'] == 3) echo 'selected="selected"';?> value="3">3 columns</option>
								<option <?php if($table['columns'] == 4) echo 'selected="selected"';?> value="4">4 columns</option>
							</select>
						</label>
					</p>
					<p class="table-features description half last">
						<label for="<?php echo $this->get_field_id('tables') ?>-<?php echo $count ?>-features">
							Features(separated by commas ,)<br/>
							<input type="text" id="<?php echo $this->get_field_id('tables') ?>-<?php echo $count ?>-features" class="input-full" name="<?php echo $this->get_field_name('tables') ?>[<?php echo $count ?>][features]" value="<?php echo $table['features'] ?>" />
							<em>Add the pricing table features, separated by commas ,</em>
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

			foreach($tables as $table) {

				$name = $table['name'];
				$columns = $table['columns'];
				$price = $table['price'];
				$price_text = $table['pricetext'];
				$moretext = $table['moretext'];
				$morelink = $table['morelink'];
				$columns = $table['columns'];
				$features = $table['features'];

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
				if($features != '') {
					$output .= '<ul>';
					$features = explode(',', trim($features) );
					foreach($features as $feature) {
						$output .= '<li>' . $feature . '</li>';
					}
					$output .= '</ul>';
				}
				$output .= '<div class="signup"><div class="button2">';
				if($morelink !== '')
					$output .= '<a href="' . $morelink . '">' . $moretext . '</a>';
				else
					$output .= $moretext;
				$output .= '</div></div>
				</div>';
				echo $output;
			}
			
		}
		
		/* AJAX add slide */
		function add_table() {
			$nonce = $_POST['security'];
			if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
			
			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
			
			//default key/value for the tab
			$slidev = array(
				'name' => '',
				'price' => '',
				'pricetext' => '',
				'moretext' => 'Sign up',
				'morelink' => '',
				'columns' => 4,
				'features' => ''
			);
			
			if($count) {
				$this->table($slidev, $count);
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
