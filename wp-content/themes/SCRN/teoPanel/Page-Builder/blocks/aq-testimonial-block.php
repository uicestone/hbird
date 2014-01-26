<?php
/* Aqua Tabs Block */
if(!class_exists('AQ_Testimonial_Block')) {
	class AQ_Testimonial_Block extends AQ_Block {
	
		function __construct() {
			$block_options = array(
				'name' => 'Testimonial',
				'size' => 'span3',
			);
			
			//create the widget
			parent::__construct('AQ_Testimonial_Block', $block_options);
						
		}
		
		function form($instance) {
		
		$defaults = array(
			'text' => ''
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		?>
		<p class="description">
			<label for="<?php echo $this->get_field_id('text') ?>">
				Testimonial text:
				<?php echo aq_field_input('text', $block_id, $text, $size = 'full') ?>
			</label>
		</p>
				
		<?php
	}
	
	function block($instance) {
		extract($instance);
		
		echo '<div class="testimonials">
		<p>&ldquo;' . $text . '&rdquo;</p>
		</div>';

	}
	function update($new_instance, $old_instance) {
		return $new_instance;
	}

	}
}