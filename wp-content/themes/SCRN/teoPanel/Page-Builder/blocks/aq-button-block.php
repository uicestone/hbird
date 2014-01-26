<?php
/* Aqua Tabs Block */
if(!class_exists('AQ_Button_Block')) {
	class AQ_Button_Block extends AQ_Block {
	
		function __construct() {
			$block_options = array(
				'name' => 'Button',
				'size' => 'span3',
			);
			
			//create the widget
			parent::__construct('AQ_Button_Block', $block_options);
						
		}
		
		function form($instance) {
		
		$defaults = array(
			'url' => '',
			'newwindow' => 'no',
			'color' => '#FADBA1',
			'text' => ''
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		$options = array("no" => "no", "yes" => "yes");
		?>
		<p class="description">
			<label for="<?php echo $this->get_field_id('text') ?>">
				Button text:
				<?php echo aq_field_input('text', $block_id, $text, $size = 'full') ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('url') ?>">
				Button URL:
				<?php echo aq_field_input('url', $block_id, $url, $size = 'full') ?>
			</label>
		</p>

		<p class="description">
			<label for="<?php echo $this->get_field_id('color') ?>">
				Button color:
				<?php echo aq_field_color_picker('color', $block_id, $color, '#FADBA1') ?>
			</label>
		</p>

		<p class="description">
			<label for="<?php echo $this->get_field_id('newwindow') ?>">
				Should the link open in a new window?
				<?php echo aq_field_select('newwindow', $block_id, $options, $newwindow) ?>
			</label>
		</p>
		
		<?php
	}
	
	function block($instance) {
		extract($instance);
		$color = esc_attr($color);
		
		if($newwindow == 'yes')
			$target = ' target="_blank" ';
		else
			$target = '';
		if($text !== '')
		{
			if($color === '#FADBA1')
			{
				if($url === '')
					$output = '<div class="button1 buttonbuilder">' . $text . '</div>';
				else
					$output = '<a ' . $target . ' href="' . esc_url($url) . '"><div class="button1 buttonbuilder">' . $text . '</div></a>';
			}
			else
			{
				if($url === '')
					$output = '<div class="button2 buttonbuilder" style="background-color: ' . $color . '">' . $text . '</div>';
				else
					$output = '<a ' . $target . ' href="' . esc_url($url) . '"><div class="button2 buttonbuilder" style="background-color: ' . $color . '">' . $text . '</div></a>';
			}
			echo $output;
		}

	}
	function update($new_instance, $old_instance) {
		return $new_instance;
	}

	}
}