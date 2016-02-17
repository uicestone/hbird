<?php

class Baidu_Maps_Settings {
	/**
	 * Holds the values to be used in the fields callbacks
	 */
	private $options;

	/**
	 * Start up
	 */
	public function __construct( $plugin_url ) {
		add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'page_init' ) );
		$this->plugin_url = $plugin_url;
	}

	/**
	 * Add options page
	 */
	public function add_plugin_page() {
		// This page will be under "Settings"
		add_submenu_page(
			'edit.php?post_type=bmap',
			__( 'Baidu Maps Settings', 'baidu-maps' ),
			__( 'Baidu Maps Settings', 'baidu-maps' ),
			'manage_options',
			'baidu-maps-admin',
			array( $this, 'create_admin_page' )
		);
	}

	/**
	 * Options page callback
	 */
	public function create_admin_page() {
		// Set class property
		$this->options = get_option( 'baidu_maps_settings' );
		?>
		<div class="wrap">
			<?php screen_icon(); ?>
			<h2><?php _e( "Baidu Maps", 'baidu-maps' ); ?></h2>

			<form method="post" action="options.php">
				<?php
				// This prints out all hidden setting fields
				settings_fields( 'baidu_maps' );
				do_settings_sections( 'baidu-maps-settings' );
				submit_button();
				?>
			</form>

			<hr>
			<br>
			<h3>How do I get a Baidu Developers API Key ?</h3>
			<p>
				To Sign up for a Baidu Developers API Key, please follow the instructions below :
			</p>

			<ol>
				<li>Signup for a Baidu Developers Account (First time users only)</li>
				<li>Register as a Developer (First time users only)</li>
				<li>Create an APP in the console</li>
				<li>Generate a new API Key to use for Custom Baidu Maps</li>
				<li>Enter the API Key above</li>
			</ol>

			<br>

			<h4>Step 1 : Signup for a Baidu Developers Account</h4>
			<p>Sign in to Baidu developers if you are an existing user, or register to create a new account.</p>
			<img style="width: 800px; max-width: 100%;" src="<?php echo $this->plugin_url; ?>assets/img/tutorial/step1.1.png" alt="Step 1.1">
			<br>
			<br>
			<p>Fill in your details and proceed to the next step.</p>
			<img style="width: 800px; max-width: 100%;" src="<?php echo $this->plugin_url; ?>assets/img/tutorial/step1.2.png" alt="Step 1.2">
			<br>
			<br>
			<p>
				You should see a confirmation that the account has been created and requires email verification, <br>
				Please verify your email with Baidu.
			</p>
			<img style="width: 800px; max-width: 100%;" src="<?php echo $this->plugin_url; ?>assets/img/tutorial/step1.3.png" alt="Step 1.3">
			<br><br>
			<h4>Step 2 : SMS &amp; Developer verification</h4>
			<p>
				This step requires you to verify your mobile number, kindly enter the following information <br>
				to retrive the security code on your mobile.
			</p>
			<img style="width: 800px; max-width: 100%;" src="<?php echo $this->plugin_url; ?>assets/img/tutorial/step2.1.png" alt="Step 2.1">
			<br><br>
			<p>
				Here, you will need to register as a Developer, and would need to fill in the following fields.
			</p>
			<img style="width: 800px; max-width: 100%;" src="<?php echo $this->plugin_url; ?>assets/img/tutorial/step2.2.png" alt="Step 2.2">
			<p>
				This step confirms that you have been succesfully registered as a Developer, and you may proceed to the next step.
			</p>
			<img style="width: 800px; max-width: 100%;" src="<?php echo $this->plugin_url; ?>assets/img/tutorial/step2.3.png" alt="Step 2.3">
			<p>
				Accept the Terms &amp; Conditions here,  and proceed to the third step.
			</p>
			<img style="width: 800px; max-width: 100%;" src="<?php echo $this->plugin_url; ?>assets/img/tutorial/step2.4.png" alt="Step 2.4">

			<br><br>
			<h4>Step 3 : Create the API Key</h4>
			<p>
				Click the following link to create a new API Key <a href="http://lbsyun.baidu.com/apiconsole/key">http://lbsyun.baidu.com/apiconsole/key</a>
			</p>
			<img style="width: 800px; max-width: 100%;" src="<?php echo $this->plugin_url; ?>assets/img/tutorial/step3.1.png" alt="Step 3.1">

			<p>
				Enter the following information and proceed to the final step.
			</p>
			<img style="width: 800px; max-width: 100%;" src="<?php echo $this->plugin_url; ?>assets/img/tutorial/step3.2.png" alt="Step 3.2">

			<p>
				Finally, you have created the Baidu Developers API Key, use this key in the settings field at the top of this page.
			</p>
			<img style="width: 800px; max-width: 100%;" src="<?php echo $this->plugin_url; ?>assets/img/tutorial/step3.3.png" alt="Step 3.3">
		</div>
	<?php
	}

	/**
	 * Register and add settings
	 */
	public function page_init() {
		register_setting(
			'baidu_maps',
			'baidu_maps_settings',
			array( $this, 'sanitize' )
		);

		add_settings_section(
			'baidu_maps_setting_general',
			__( 'Baidu Maps General Settings', 'baidu-maps' ),
			array( $this, 'print_section_info' ),
			'baidu-maps-settings'
		);

		add_settings_field(
			'api_key',
			__( 'Baidu Developers API Key', 'baidu-maps' ),
			array( $this, 'api_key_callback' ),
			'baidu-maps-settings',
			'baidu_maps_setting_general'
		);
	}

	/**
	 * Sanitize each setting field as needed
	 *
	 * @param array $input Contains all settings fields as array keys
	 */
	public function sanitize( $input ) {
		if ( ! empty( $input['api_key'] ) )
			$input['api_key'] = sanitize_text_field( $input['api_key'] );

		return $input;
	}

	/**
	 * Print the Section text
	 */
	public function print_section_info() {
		echo _e( 'Enter your settings below:', 'baidu-maps' );
	}

	/**
	 * Get the settings option array and print one of its values
	 */
	public function api_key_callback() {
		printf(
			'<input type="text" id="api_key" name="baidu_maps_settings[api_key]" value="%s" style="width: 300px;"/>',
			esc_attr( $this->options['api_key'] )
		);
	}
}
