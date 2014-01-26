<?php
/* Aqua Tabs Block */
if(!class_exists('AQ_Skills_Block')) {
	class AQ_Skills_Block extends AQ_Block {
	
		function __construct() {
			$block_options = array(
				'name' => 'Skills',
				'size' => 'span12',
			);
			
			//create the widget
			parent::__construct('AQ_Skills_Block', $block_options);
			
			//add ajax functions
			add_action('wp_ajax_aq_block_skill_add_new', array($this, 'add_skill'));
			
		}
		
		function form($instance) {
		
			$defaults = array(
				'skills' => array(
					1 => array(
						'title' => 'My new skill name',
						'value' => '50',
						'bg' => '#D1D1D1'
					)
				)
			);
			
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			?>
			<div class="description cf">
				<ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
					<?php
					$skills = is_array($skills) ? $skills : $defaults['skills'];
					$count = 1;
					foreach($skills as $skill) {	
						$this->skill($skill, $count);
						$count++;
					}
					?>
				</ul>
				<p></p>
				<a href="#" rel="skill" class="aq-sortable-add-new button">Add New</a>
				<p></p>
			</div>
			<?php
		}
		
		function skill($skill = array(), $count = 0) {
				global $block_id;
				echo '
				<script type="text/javascript">
					jQuery(document).ready(function($) {
						$("ul.blocks").trigger("customEvent");
					});
				</script>';
			?>
			<li id="<?php echo $this->get_field_id('skills') ?>-sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
				
				<div class="sortable-head cf">
					<div class="sortable-title">
						<strong><?php echo $skill['title'] ?></strong>
					</div>
					<div class="sortable-handle">
						<a href="#">Open / Close</a>
					</div>
				</div>
				
				<div class="sortable-body">
					<p class="skill-title description half">
						<label for="<?php echo $this->get_field_id('skills') ?>-<?php echo $count ?>-title">
							Skill Name<br/>
							<input type="text" id="<?php echo $this->get_field_id('skills') ?>-<?php echo $count ?>-title" class="input-full" name="<?php echo $this->get_field_name('skills') ?>[<?php echo $count ?>][title]" value="<?php echo $skill['title'] ?>" />
						</label>
					</p>
					<p class="skill-value description half last">
						<label for="<?php echo $this->get_field_id('skills') ?>-<?php echo $count ?>-value">
							Skill value(0-100)<br/>
							<input type="text" id="<?php echo $this->get_field_id('skills') ?>-<?php echo $count ?>-value" class="input-full" name="<?php echo $this->get_field_name('skills') ?>[<?php echo $count ?>][value]" value="<?php echo $skill['value'] ?>" />
						</label>
					</p>

					<p class="skill-color description">
						<label for="<?php echo $this->get_field_id('skills') ?>-<?php echo $count ?>-bg">
							Background-color of the skill block: <br/>
							<div class="aqpb-color-picker">
								<input type="text" id="<?php echo $this->get_field_id('skills') ?>-<?php echo $count ?>-bg" class="input-color-picker" name="<?php echo $this->get_field_name('skills') ?>[<?php echo $count ?>][bg]" data-default-color="<?php echo $skill['bg'] ?>" value="<?php echo $skill['bg'] ?>" />
							</div>
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
						
			$output .= '<div class="skills">';
			$output .= '<ul class="aq-nav cf">';
					
			foreach( $skills as $skill ){
				$rand = rand(1,5);
				$output .= '<p>' . sanitize_title( $skill['title'] ) . '</p>';
				$value = (int)$skill['value'];
				if($value < 0 || $value > 100)
					$value = 50;
				$output .= '<div class="skill-bg"><div style="width: ' . $value . '%;';
				if($skill['bg'] !== '') 
					$output .= 'background-color: ' . esc_attr($skill['bg']);
				$output .= '" class="skill' . $rand . '"></div></div>';	
			}
					
			$output .= '</div>';
				
			echo $output;
			
		}
		
		/* AJAX add skill */
		function add_skill() {
			$nonce = $_POST['security'];
			if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
			
			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
			
			//default key/value for the tab
			$skill = array(
				'title' => 'New Skill',
				'value' => '50',
				'bg' => '#D1D1D1'
			);
			
			if($count) {
				$this->skill($skill, $count);
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
