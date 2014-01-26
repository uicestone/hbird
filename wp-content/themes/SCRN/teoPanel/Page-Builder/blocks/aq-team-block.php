<?php
/* Aqua Tabs Block */
if(!class_exists('AQ_Team_Block')) {
	class AQ_Team_Block extends AQ_Block {
	
		function __construct() {
			$block_options = array(
				'name' => 'Team members',
				'size' => 'span12',
			);
			
			//create the widget
			parent::__construct('AQ_Team_Block', $block_options);
						
		//add ajax functions
			add_action('wp_ajax_aq_block_member_add_new', array($this, 'add_member'));
			
		}
		
		function form($instance) {
		
			$defaults = array(
				'members' => array(
					1 => array(
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
					)
				)
			);
			
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			?>
			<div class="description cf">
				<ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
					<?php
					$members = is_array($members) ? $members : $defaults['members'];
					$count = 1;
					foreach($members as $member) {	
						$this->member($member, $count);
						$count++;
					}
					?>
				</ul>
				<p></p>
				<a href="#" rel="member" class="aq-sortable-add-new button">Add New</a>
				<p></p>
			</div>
			<?php
		}
		
		function member($member = array(), $count = 0) {
				global $block_id;
			?>
			<li id="<?php echo $this->get_field_id('members') ?>-sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
				
				<div class="sortable-head cf">
					<div class="sortable-title">
						<strong>Team member #<?php echo $count; ?></strong>
					</div>
					<div class="sortable-handle">
						<a href="#">Open / Close</a>
					</div>
				</div>
				
				<div class="sortable-body">
					<p class="member-image description half">
						<label for="<?php echo $this->get_field_id('members') ?>-<?php echo $count ?>-image">
							Member image<br/>
							<input type="text" id="<?php echo $this->get_field_id('members') ?>-<?php echo $count ?>-image" class="input-full input-upload" name="<?php echo $this->get_field_name('members') ?>[<?php echo $count ?>][image]" value="<?php echo $member['image'] ?>" />
							<a href="#" class="aq_upload_button button" rel="image">Upload</a>
						</label>
					</p>
					<p class="member-name description half last">
						<label for="<?php echo $this->get_field_id('members') ?>-<?php echo $count ?>-name">
							Member name<br/>
							<input type="text" id="<?php echo $this->get_field_id('members') ?>-<?php echo $count ?>-name" class="input-full" name="<?php echo $this->get_field_name('members') ?>[<?php echo $count ?>][name]" value="<?php echo $member['name'] ?>" />
						</label>
					</p>
					<br /><br /><br /><br />
					<p class="member-position description half">
						<label for="<?php echo $this->get_field_id('members') ?>-<?php echo $count ?>-position">
							Member position<br/>
							<input type="text" id="<?php echo $this->get_field_id('members') ?>-<?php echo $count ?>-position" class="input-full" name="<?php echo $this->get_field_name('members') ?>[<?php echo $count ?>][position]" value="<?php echo $member['position'] ?>" />
						</label>
					</p>
					<p class="member-description description half last">
						<label for="<?php echo $this->get_field_id('members') ?>-<?php echo $count ?>-description">
							Member description<br/>
							<textarea id="<?php echo $this->get_field_id('members') ?>-<?php echo $count ?>-description" class="textarea-full" name="<?php echo $this->get_field_name('members') ?>[<?php echo $count ?>][description]"><?php echo $member['description'] ?></textarea>
						</label>
					</p>
					<p class="member-twitter description half">
						<label for="<?php echo $this->get_field_id('members') ?>-<?php echo $count ?>-twitter">
							Twitter profile URL<br/>
							<input type="text" id="<?php echo $this->get_field_id('members') ?>-<?php echo $count ?>-twitter" class="input-full" name="<?php echo $this->get_field_name('members') ?>[<?php echo $count ?>][twitter]" value="<?php echo $member['twitter'] ?>" />
						</label>
					</p>
					<p class="member-facebook description half last">
						<label for="<?php echo $this->get_field_id('members') ?>-<?php echo $count ?>-facebook">
							Facebook profile URL<br/>
							<input type="text" id="<?php echo $this->get_field_id('members') ?>-<?php echo $count ?>-facebook" class="input-full" name="<?php echo $this->get_field_name('members') ?>[<?php echo $count ?>][facebook]" value="<?php echo $member['facebook'] ?>" />
						</label>
					</p>
					<p class="member-dribble description half">
						<label for="<?php echo $this->get_field_id('members') ?>-<?php echo $count ?>-dribble">
							Dribbble profile URL<br/>
							<input type="text" id="<?php echo $this->get_field_id('members') ?>-<?php echo $count ?>-dribble" class="input-full" name="<?php echo $this->get_field_name('members') ?>[<?php echo $count ?>][dribble]" value="<?php echo $member['dribble'] ?>" />
						</label>
					</p>
					<p class="member-skype description half last">
						<label for="<?php echo $this->get_field_id('members') ?>-<?php echo $count ?>-skype">
							Skype profile<br/>
							<input type="text" id="<?php echo $this->get_field_id('members') ?>-<?php echo $count ?>-skype" class="input-full" name="<?php echo $this->get_field_name('members') ?>[<?php echo $count ?>][skype]" value="<?php echo $member['skype'] ?>" />
						</label>
					</p>
					<p class="member-gplus description half">
						<label for="<?php echo $this->get_field_id('members') ?>-<?php echo $count ?>-gplus">
							Google Plus profile URL<br/>
							<input type="text" id="<?php echo $this->get_field_id('members') ?>-<?php echo $count ?>-gplus" class="input-full" name="<?php echo $this->get_field_name('members') ?>[<?php echo $count ?>][gplus]" value="<?php echo $member['gplus'] ?>" />
						</label>
					</p>
					<p class="member-skype description half last">
						<label for="<?php echo $this->get_field_id('members') ?>-<?php echo $count ?>-linkedin">
							LinkedIn profile<br/>
							<input type="text" id="<?php echo $this->get_field_id('members') ?>-<?php echo $count ?>-linkedin" class="input-full" name="<?php echo $this->get_field_name('members') ?>[<?php echo $count ?>][linkedin]" value="<?php echo $member['linkedin'] ?>" />
						</label>
					</p>
					<p class="member-pinterest description half">
						<label for="<?php echo $this->get_field_id('members') ?>-<?php echo $count ?>-pinterest">
							Pinterest profile URL<br/>
							<input type="text" id="<?php echo $this->get_field_id('members') ?>-<?php echo $count ?>-pinterest" class="input-full" name="<?php echo $this->get_field_name('members') ?>[<?php echo $count ?>][pinterest]" value="<?php echo $member['pinterest'] ?>" />
						</label>
					</p>
					<p class="member-columns description half last">
						<label for="<?php echo $this->get_field_id('members') ?>-<?php echo $count ?>-columns">
							Number of team members per line<br/>
							<select id="<?php echo $this->get_field_id('members') ?>-<?php echo $count ?>-columns" name="<?php echo $this->get_field_name('members') ?>[<?php echo $count ?>][columns]">
								<option <?php if($member['columns'] == 1) echo 'selected="selected"';?> value="1">1 column</option>
								<option <?php if($member['columns'] == 2) echo 'selected="selected"';?> value="2">2 columns</option>
								<option <?php if($member['columns'] == 3) echo 'selected="selected"';?> value="3">3 columns</option>
								<option <?php if($member['columns'] == 4) echo 'selected="selected"';?> value="4">4 columns</option>
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

			foreach($members as $member) {

				$image = $member['image'];
				$name = $member['name'];
				$position = $member['position'];
				$description = $member['description'];
				$twitter = $member['twitter'];
				$facebook = $member['facebook'];
				$dribble = $member['dribble'];
				$skype = $member['skype'];
				$gplus = $member['gplus'];
				$linkedin = $member['linkedin'];
				$pinterest = $member['pinterest'];
				$columns = $member['columns'];

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
				echo $output;
			}
			
		}
		
		/* AJAX add slide */
		function add_member() {
			$nonce = $_POST['security'];
			if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
			
			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
			
			//default key/value for the tab
			$slidev = array(
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
			);
			
			if($count) {
				$this->member($slidev, $count);
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
