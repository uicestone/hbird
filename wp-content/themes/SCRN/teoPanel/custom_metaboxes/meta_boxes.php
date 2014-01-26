<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_sample_metaboxes( array $meta_boxes ) {

	$prefix = '_blog_';

	$meta_boxes[] = array(
		'id'         => 'blog_metabox',
		'title'      => 'Blog page template',
		'pages'      => array( 'page', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_on'    => array( 'key' => 'page-template', 'value' => 'page-template-blog.php'),
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array( // Text Input
			    'name' => 'Number of posts shown on homepage / individual page', // <label>
			    'desc'  => 'This is the number of blog posts shown on the blog page or homepage, before pagination(on the individual page)', // description
			    'id'    => $prefix . 'nrposts', // field id and name
			    'type'  => 'text', // type of field,
			    'std' => 6
			    ),
			array(
				'name'    => 'Full width?',
				'desc'    => 'Is the page full width? Or should it show a sidebar?',
				'id'      => $prefix . 'fullwidth',
				'type'    => 'radio',
				'options' => array(
					array( 'name' => 'Full width', 'value' => 1, ),
					array( 'name' => 'With sidebar', 'value' => 2, ),
				),
				'std' => 2
			),
			array( // Text Input
			    'name' => 'Categories included in the portfolio page', // <label>
			    'desc'  => 'You can select one or more categories.', // description
			    'id'    => $prefix . 'categories', // field id and name
			    'type'  => 'taxonomy_multicheck', // type of field,
			    'taxonomy'	=> 'category', // Taxonomy Slug
			    ),
		)
	);

	$prefix = '_portfolio_';

	$meta_boxes[] = array(
		'id'         => 'portf_metabox',
		'title'      => 'Portfolio item details',
		'pages'      => array( 'portfolio', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array( // Text Input
			    'name' => 'Thumbnail', // <label>
			    'desc'  => 'Add the the thumbnail that will show up initially', // description
			    'id'    => $prefix . 'thumb', // field id and name
			    'type'  => 'file', // type of field,
			    ),
			array( // Text Input
			    'name' => 'Slide 1 image', // <label>
			    'desc'  => 'The first image in the slider, is optional', // description
			    'id'    => $prefix . 'image1', // field id and name
			    'type'  => 'file', // type of field,
			    ),
			array( // Text Input
			    'name' => 'Slide 1 video', // <label>
			    'desc'  => 'If you want to use a video and not an image, put the video here(only from external sites like YouTube, Vimeo, ...)', // description
			    'id'    => $prefix . 'video1', // field id and name
			    'type'  => 'oembed', // type of field,
			    ),
			array( // Text Input
			    'name' => 'Slide 2 image', // <label>
			    'desc'  => 'The second image in the slider, is optional', // description
			    'id'    => $prefix . 'image2', // field id and name
			    'type'  => 'file', // type of field,
			    ),
			array( // Text Input
			    'name' => 'Slide 2 video', // <label>
			    'desc'  => 'If you want to use a video and not an image, put the video here(only from external sites like YouTube, Vimeo, ...)', // description
			    'id'    => $prefix . 'video2', // field id and name
			    'type'  => 'oembed', // type of field,
			    ),
			array( // Text Input
			    'name' => 'Slide 3 image', // <label>
			    'desc'  => 'The third image in the slider, is optional', // description
			    'id'    => $prefix . 'image3', // field id and name
			    'type'  => 'file', // type of field,
			    ),
			array( // Text Input
			    'name' => 'Slide 3 video', // <label>
			    'desc'  => 'If you want to use a video and not an image, put the video here(only from external sites like YouTube, Vimeo, ...)', // description
			    'id'    => $prefix . 'video3', // field id and name
			    'type'  => 'oembed', // type of field,
			    ),
			array( // Text Input
			    'name' => 'Slide 4 image', // <label>
			    'desc'  => 'The fourth image in the slider, is optional', // description
			    'id'    => $prefix . 'image4', // field id and name
			    'type'  => 'file', // type of field,
			    ),
			array( // Text Input
			    'name' => 'Slide 4 video', // <label>
			    'desc'  => 'If you want to use a video and not an image, put the video here(only from external sites like YouTube, Vimeo, ...)', // description
			    'id'    => $prefix . 'video4', // field id and name
			    'type'  => 'oembed', // type of field,
			    ),
			array( // Text Input
			    'name' => 'Slide 5 image', // <label>
			    'desc'  => 'The fifth image in the slider, is optional', // description
			    'id'    => $prefix . 'image5', // field id and name
			    'type'  => 'file', // type of field,
			    ),
			array( // Text Input
			    'name' => 'Slide 5 video', // <label>
			    'desc'  => 'If you want to use a video and not an image, put the video here(only from external sites like YouTube, Vimeo, ...)', // description
			    'id'    => $prefix . 'video5', // field id and name
			    'type'  => 'oembed', // type of field,
			    ),
			array( // Text Input
			    'name' => 'Slide 6 image', // <label>
			    'desc'  => 'The sixth image in the slider, is optional', // description
			    'id'    => $prefix . 'image6', // field id and name
			    'type'  => 'file', // type of field,
			    ),
			array( // Text Input
			    'name' => 'Slide 6 video', // <label>
			    'desc'  => 'If you want to use a video and not an image, put the video here(only from external sites like YouTube, Vimeo, ...)', // description
			    'id'    => $prefix . 'video6', // field id and name
			    'type'  => 'oembed', // type of field,
			    ),
			array( // Text Input
			    'name' => 'Type', // <label>
			    'desc'  => 'The type of your project. Leave empty if not applicable. ', // description
			    'id'    => $prefix . 'type', // field id and name
			    'type'  => 'text', // type of field,
			    ),
			array(
				'name'    => 'Layout type',
				'desc'    => 'The type of your project',
				'id'      => $prefix . 'size',
				'type'    => 'radio',
				'options' => array(
					array( 'name' => 'Big(1 item per line)', 'value' => 1, ),
					array( 'name' => 'Medium(2 images per line)', 'value' => 2, ),
					array( 'name' => 'Normal(3 images per line)', 'value' => 3, ),
					array( 'name' => 'Small(4 images per line)', 'value' => 4, ),
				),
				'std' => 3
			),
			array( // Text Input
			    'name' => 'Description', // <label>
			    'desc'  => 'Some description for your project. ', // description
			    'id'    => $prefix . 'description', // field id and name
			    'type'  => 'textarea_small', // type of field,
			    ),
			array( // Text Input
			    'name' => 'Video URL', // <label>
			    'desc'  => 'The video will open on the "zoom" icon. Only used if applicable. ', // description
			    'id'    => $prefix . 'video', // field id and name
			    'type'  => 'text', // type of field,
			    ),
			array( // Text Input
			    'name' => 'Button text', // <label>
			    'desc'  => 'The text on the call to action button, if applicable. ', // description
			    'id'    => $prefix . 'buttontext', // field id and name
			    'type'  => 'text', // type of field,
			    ),
			array( // Text Input
			    'name' => 'Button URL', // <label>
			    'desc'  => 'The url on the call to action button, if applicable. ', // description
			    'id'    => $prefix . 'buttonurl', // field id and name
			    'type'  => 'text', // type of field,
			    ),

		)
	);

	$prefix = '_page_';

	$meta_boxes[] = array(
		'id'         => 'page_metabox',
		'title'      => 'SCRN Options',
		'pages'      => array( 'page', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array( // Text Input
			    'name' => 'Slogan / separator text', // <label>
			    'desc'  => 'The text that shows up below the page on the homepage. ', // description
			    'id'    => $prefix . 'slogantext', // field id and name
			    'type'  => 'text', // type of field,
			    ),
			array( // Text Input
			    'name' => 'Background image of the separator image showing up AFTER this page', // <label>
			    'desc'  => 'The image that shows up below the page(as a separator) on the homepage. ', // description
			    'id'    => $prefix . 'sloganimg', // field id and name
			    'type'  => 'file', // type of field,
			    ),
			array( // Text Input
			    'name' => 'Background style', // <label>
			    'desc'  => 'You can choose between the two already-defined background styles or create your own.', // description
			    'id'    => $prefix . 'style', // field id and name
			    'type'    => 'radio',
				'options' => array(
					array( 'name' => 'White', 'value' => 1, ),
					array( 'name' => 'Dark', 'value' => 2, ),
					array( 'name' => 'Custom (defined below)', 'value' => 3, ),
				),
				'std' => 1
			    ),
			array(
				'name'    => 'Background image URL',
				'desc'    => 'The background image, if you set the above option to Custom.',
				'id'      => $prefix . 'bgimage',
				'type'    => 'file',
			),
			array( // Text Input
			    'name' => 'Background image color', // <label>
			    'desc'  => 'The background color, if you set the above option to Custom and you did not set a background image. ', // description
			    'id'    => $prefix . 'bgcolor', // field id and name
			    'type'  => 'colorpicker', // type of field,
			    ),

		)
	);

	// Add other metaboxes as needed

	return $meta_boxes;
}

add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'init.php';

}