<?php
/* Aqua Tabs Block */
if(!class_exists('AQ_QuoteSlider_Block')) {
	class AQ_QuoteSlider_Block extends AQ_Block {
	
		function __construct() {
			$block_options = array(
				'name' => 'Quote Slider',
				'size' => 'span12',
			);
			
			//create the widget
			parent::__construct('AQ_QuoteSlider_Block', $block_options);
			
			//add ajax functions
			add_action('wp_ajax_aq_block_quote_add_new', array($this, 'add_quote'));
			
		}
		
		function form($instance) {
		
			$defaults = array(
				'quotes' => array(
					1 => array(
						'content' => 'Quote text here',
						'author' => 'Quote author',
					)
				)
			);
			
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			?>
			<div class="description cf">
				<ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
					<?php
					$quotes = is_array($quotes) ? $quotes : $defaults['quotes'];
					$count = 1;
					foreach($quotes as $quote) {	
						$this->quote($quote, $count);
						$count++;
					}
					?>
				</ul>
				<p></p>
				<a href="#" rel="quote" class="aq-sortable-add-new button">Add New</a>
				<p></p>
			</div>
			<?php
		}
		
		function quote($quote = array(), $count = 0) {
				global $block_id;
			?>
			<li id="<?php echo $this->get_field_id('quotes') ?>-sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
				
				<div class="sortable-head cf">
					<div class="sortable-title">
						<strong><?php echo $quote['author'] ?></strong>
					</div>
					<div class="sortable-handle">
						<a href="#">Open / Close</a>
					</div>
				</div>
				
				<div class="sortable-body">
					<p class="skill-author description half">
						<label for="<?php echo $this->get_field_id('quotes') ?>-<?php echo $count ?>-author">
							Quote author<br/>
							<input type="text" id="<?php echo $this->get_field_id('quotes') ?>-<?php echo $count ?>-author" class="input-full" name="<?php echo $this->get_field_name('quotes') ?>[<?php echo $count ?>][author]" value="<?php echo $quote['author'] ?>" />
						</label>
					</p>
					<p class="skill-content description half last">
						<label for="<?php echo $this->get_field_id('quotes') ?>-<?php echo $count ?>-content">
							Quote content<br/>
							<textarea id="<?php echo $this->get_field_id('quotes') ?>-<?php echo $count ?>-content" class="textarea-full" name="<?php echo $this->get_field_name('quotes') ?>[<?php echo $count ?>][content]"><?php echo $quote['content'] ?></textarea>
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

			$output = '<div class="quote-container">
				<div class="quote-nav-left" id="quote-nav-left-' . $id . '">
					<a href="#" onclick="return false">&laquo; left</a>
				</div>
				<div class="quote-nav-right" id="quote-nav-right-' . $id . '">
					<a href="#" onclick="return false">right &raquo;</a>
				</div>
			          <div class="quote-slider" id="quote-slider-' . $id . '">' . PHP_EOL;
					
			foreach( $quotes as $quote ){
				$output .= '<div class="panel">
		            <p>&ldquo;' . $quote['content'] . '&rdquo;</p>
		            <p class="quoter">' . $quote['author'] . '</p>
		    	</div>' . PHP_EOL;

			}
					
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
				
			echo $output;
			
		}
		
		/* AJAX add quote */
		function add_quote() {
			$nonce = $_POST['security'];
			if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
			
			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
			
			//default key/value for the tab
			$quotev = array(
				'content' => 'Quote text here',
				'author' => 'Quote author',
			);
			
			if($count) {
				$this->quote($quotev, $count);
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
