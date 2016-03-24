<?php 
/**
 * Author:      Themeone
 * Author URI:  https://theme-one.com
 */

if (is_admin()) {
	
#-----------------------------------------------------------------#
# Element Size blog
#-----------------------------------------------------------------# 

$prefix = 'themeone';

$tomb_boxes[] = array(
	'id'    => $prefix . '-element-size',
	'title' => __('Mobius Grid item size setting', 'mobius'),
	'icon' => '<i class="dashicons-before dashicons-screenoptions"></i>',
	'color' => '#f1f1f1',
	'background' => '#34495e',
	'context' => 'normal',
	'pages' => array('post'),
	'fields' => array(
		array(
			'id'   => $prefix . '-element-class',
			'name' => __('Select an item size for the current post', 'mobius'),
			'desc' => __('An grid item allows to display featured image, title, and excerpt of the current post', 'mobius').'<br><strong>'.__('If there is not featured image, the excert will fill the entire element', 'mobius').'</strong>',
			'sub_desc' => __('* All item sizes can also be set in', 'mobius').' <a href="'.admin_url( 'admin.php?page=reorder-Grid').'">'.__('Reorder Grid page settings', 'mobius').'</a>',
			'type' => 'image_select',
			'std' => 'tall',
			'options' => array (
				array (
					'label' => 'Tall',
					'value' => 'tall',
					'image'   => get_template_directory_uri() . '/includes/metaboxes/img/tall.png'
				),
				array (
					'label' => 'Wide',
					'value' => 'wide',
					'image'   => get_template_directory_uri() . '/includes/metaboxes/img/wide.png'
				),
				array (
					'label' => 'Square top',
					'value' => 'square top',
					'image'   => get_template_directory_uri() . '/includes/metaboxes/img/squaretop.png'
				),
				array (
					'label' => 'Square left',
					'value' => 'square left',
					'image'   => get_template_directory_uri() . '/includes/metaboxes/img/squareleft.png'
				),
				array (
					'label' => 'Normal center',
					'value' => 'normal center',
					'image' => get_template_directory_uri() . '/includes/metaboxes/img/normalcenter.png'
				),
				array (
					'label' => 'Tall center',
					'value' => 'tall center',
					'image' => get_template_directory_uri() . '/includes/metaboxes/img/tallcenter.png'
				),
				array (
					'label' => 'Wide center',
					'value' => 'wide center',
					'image' => get_template_directory_uri() . '/includes/metaboxes/img/widecenter.png'
				),
				array (
					'label' => 'Square center',
					'value' => 'square center',
					'image' => get_template_directory_uri() . '/includes/metaboxes/img/squarecenter.png'
				),
			),
		),	
	),
);

#-----------------------------------------------------------------#
# Element Size portfolio
#-----------------------------------------------------------------# 

$tomb_boxes[] = array(
	'id'    => $prefix . '-element-size2',
	'title' => __('Mobius Grid item size setting', 'mobius'),
	'icon' => '<i class="dashicons-before dashicons-screenoptions"></i>',
	'color' => '#f1f1f1',
	'background' => '#34495e',
	'context' => 'normal',
	'pages' => array('portfolio'),
	'fields' => array(
		array(
			'id'   => $prefix . '-element-class',
			'name' => __('Select an item size for the current portfolio', 'mobius'),
			'desc' => __('An grid item allows to display featured image, title, and excerpt of the current portfolio', 'mobius'),
			'sub_desc' => __('* All item sizes can also be set in', 'mobius').' <a href="'.admin_url( 'admin.php?page=reorder-Grid').'">'.__('Reorder Grid page settings', 'mobius').'</a>',
			'type' => 'image_select',
			'std' => 'normal',
			'options' => array (
				array (
					'label' => 'Normal',
					'value' => 'normal',
					'image' => get_template_directory_uri() . '/includes/metaboxes/img/normalport.png'
				),
				array (
					'label' => 'Tall',
					'value' => 'tall',
					'image' => get_template_directory_uri() . '/includes/metaboxes/img/tallport.png',
				),
				array (
					'label' => 'Wide',
					'value' => 'wide',
					'image' => get_template_directory_uri() . '/includes/metaboxes/img/wideport.png'
				),
				array (
					'label' => 'Square',
					'value' => 'square',
					'image' => get_template_directory_uri() . '/includes/metaboxes/img/squareport.png'
				)
			),
		),	
	),
);

#-----------------------------------------------------------------#
# Post/Portfolio Formats
#-----------------------------------------------------------------# 

/*** Quote ***/
$quote[] = array(
	'id' => $prefix . '-post-quote-author',
	'name' =>  __('Quote Author', 'mobius'),
	'desc' => __('Please enter the quote author.', 'mobius'),
	'type' => 'text',
	'std' => '',
	'tab' => 'Quote',
);
$quote[] = array(
	'type' => 'break',
	'tab' => 'Quote'
);
$quote[] = array(
	'id' => $prefix . '-post-quote',
	'name' =>  __('Quote Content', 'mobius'),
	'desc' => __('Please type the text for your quote here.', 'mobius'),
	'type' => 'textarea',
	'disabled' => false,
	'cols' => 80,
	'rows' => 6,
	'placeholder' => '',
	'std' => '',
	'tab' => 'Quote',
	'tab_icon' => '<i class="tomb-icon dashicons dashicons-format-quote"></i>'
);
		
/*** Link ***/
$link[] = array(
	'name' =>  __('Link From', 'mobius'),
	'desc' => __('Please type the link from (website title, author name,...)', 'mobius'),
	'id' => $prefix . '-post-link-from',
	'type' => 'text',
	'std' => '',
	'tab' => 'Link',
);
$link[] = array(
	'name' =>  __('Link URL', 'mobius'),
	'desc' => __('Please type the url link', 'mobius'),
	'id' => $prefix . '-post-link-url',
	'type' => 'text',
	'std' => '',
	'tab' => 'Link',
);
$link[] = array(
	'type' => 'break',
	'tab' => 'Link'
);
$link[] = array(
	'name' =>  __('Link Text', 'mobius'),
	'desc' => __('Please enter the Link text.', 'mobius'),
	'id' => $prefix . '-post-link',
	'type' => 'textarea',
	'disabled' => false,
	'cols' => 80,
	'rows' => 6,
	'placeholder' => '',
	'std' => '',
	'tab' => 'Link',
	'tab_icon' => '<i class="tomb-icon dashicons dashicons-admin-links"></i>'
);

/*** Video ***/
$video[] = array( 
	'name' => __('Poster Image', 'mobius'),
	'desc' => __('This image is displayed when the video has not been played yet. Please click on "Upload" button to upload your image', 'mobius'),
	'id' => $prefix . '-video-poster',
	'type' => 'image',
	'button_upload' => __( 'Add a poster', 'mobius'),
	'button_remove' => __( 'Remove', 'mobius'),
	'frame_title'   => __( 'Select an image', 'mobius'),
	'frame_button'  => __( 'Insert image', 'mobius'),
	'button_upload' => __( 'Upload', 'mobius'),
	'button_remove' => __( 'Remove', 'mobius'),
	'std' => '',
	'tab' => 'Video'
);
$video[] = array(
	'type' => 'break',
	'tab' => 'Video'
);
$video[] = array( 
	'name' => __('M4V/MP4 File URL', 'mobius'),
	'desc' => __('Please enter an URL or upload your .m4v/.mp4 video file', 'mobius'),
	'id' => $prefix . '-video-m4v',
	'type' => 'upload',
	'button_upload' => __( 'Add a video', 'mobius'),
	'button_remove' => __( 'Remove', 'mobius'),
	'std' => '',
	'tab' => 'Video'
);
$video[] = array( 
	'name' => __('OGV/OGG File URL', 'mobius'),
	'desc' => __('Please enter an URL or upload your .ogv/.ogg video file', 'mobius'),
	'id' => $prefix . '-video-ogv',
	'type' => 'upload',
	'button_upload' => __( 'Add a video', 'mobius'),
	'button_remove' => __( 'Remove', 'mobius'),
	'std' => '',
	'tab' => 'Video'
);
$video[] = array(
	'type' => 'break',
	'tab' => 'Video'
);
$video[] = array(
	'name' => __('Embedded Video Code', 'mobius'),
	'desc' => __('Embedded video allows you to play video from Youtube or Vimeo with an embed code.', 'mobius'),
	'id' => $prefix . '-video-embed',
	'type' => 'textarea',
	'disabled' => false,
	'cols' => 80,
	'rows' => 6,
	'placeholder' => '',
	'std' => '',
	'tab' => 'Video',
	'tab_icon' => '<i class="tomb-icon dashicons dashicons-format-video"></i>'
);

/*** Audio ***/
$audio[] = array(
	'name' =>  __('Artist name', 'mobius'),
	'desc' => __('Please enter the artist name here.', 'mobius'),
	'id' => $prefix . '-artiste-name',
	'type' => 'text',
	'std' => '',
	'tab' => 'Audio',
);
$audio[] = array(
	'name' =>  __('Song name', 'mobius'),
	'desc' => __('Please enter the song name here.', 'mobius'),
	'id' => $prefix . '-song-name',
	'type' => 'text',
	'std' => '',
	'tab' => 'Audio',
);
$audio[] = array( 
	'name' => __('Album Image', 'mobius'),
	'desc' => __('Please enter an URL or upload the album image (80px*80px at minimum).', 'mobius'),
	'id' => $prefix . '-album-image',
	'type' => 'image',
	'button_upload' => __( 'Add image', 'mobius'),
	'button_remove' => __( 'Remove', 'mobius'),
	'frame_title'   => __( 'Select an image', 'mobius'),
	'frame_button'  => __( 'Insert image', 'mobius'),
	'button_upload' => __( 'Upload', 'mobius'),
	'button_remove' => __( 'Remove', 'mobius'),
	'std' => '',
	'tab' => 'Audio',	
);
$audio[] = array(
	'type' => 'break',
	'tab' => 'Video',
	'tab' => 'Audio',
);
$audio[] = array( 
	'name' => __('MP3 File URL', 'mobius'),
	'desc' => __('Please enter an URL or upload your .mp3 audio file', 'mobius'),
	'id' => $prefix . '-audio-mp3',
	'type' => 'upload',
	'button_upload' => __( 'Add .mp3', 'mobius'),
	'button_remove' => __( 'Remove', 'mobius'),
	'std' => '',
	'tab' => 'Audio',
);
$audio[] = array( 
	'name' => __('OGA/OGG File URL', 'mobius'),
	'desc' => __('Please enter an URL or upload your .oga/.ogg audio file', 'mobius'),
	'id' => $prefix . '-audio-ogg',
	'type' => 'upload',
	'button_upload' => __( 'Add .oga', 'mobius'),
	'button_remove' => __( 'Remove', 'mobius'),
	'std' => '',
	'tab' => 'Audio',
	'tab_icon' => '<i class="tomb-icon dashicons dashicons-format-audio"></i>'
);

$gallery[] = array( 
	'title' => __('How to add a gallery', 'mobius'),
	'desc' => __('To add a gallery, you need at first to select post format gallery.', 'mobius').'<br>'.__('Then you need to add a gallery in the content using the standard gallery feature provided by', 'mobius').' <a href="http://codex.wordpress.org/The_WordPress_Gallery" target="_blank">Wordpress</a>'.'<img width="200" style="position: relative;display:block;margin: 20px 0 0 0;" src="'.get_template_directory_uri() . '/includes/metaboxes/img/gallery-add-media-button.png' .'"/>',
	'type' => 'info_box',
	'tab' => 'Gallery',
	'tab_icon' => '<i class="tomb-icon dashicons dashicons-format-gallery"></i>'
);

	
$tomb_boxes[] = array(
	'id'    => $prefix . '-post-formats',
	'title' => __('Post Format Settings', 'mobius'),
	'icon' => '<i class="dashicons dashicons-admin-appearance"></i>',
	'color' => '#f1f1f1',
	'background' => '#34495e',
	'context' => 'normal',
	'priority' => 'high',
	'pages' => array('post'),
	'fields' => array()
);

/*** set post formats options ***/
$last = count($tomb_boxes) - 1;
array_splice($tomb_boxes[$last]['fields'], 0, 0, $quote);
array_splice($tomb_boxes[$last]['fields'], 1, 0, $link);
array_splice($tomb_boxes[$last]['fields'], 2, 0, $video);
array_splice($tomb_boxes[$last]['fields'], 3, 0, $audio);
array_splice($tomb_boxes[$last]['fields'], 4, 0, $gallery);

$tomb_boxes[] = array(
	'id'    => $prefix . '-port-formats',
	'title' => __('Post Format Settings', 'mobius'),
	'icon' => '<i class="dashicons dashicons-admin-appearance"></i>',
	'color' => '#f1f1f1',
	'background' => '#34495e',
	'context' => 'normal',
	'priority' => 'high',
	'pages' => array('portfolio'),
	'fields' => array()
);

/*** set portfolio formats options ***/
$last = count($tomb_boxes) - 1;
array_splice($tomb_boxes[$last]['fields'], 1, 0, $video);
array_splice($tomb_boxes[$last]['fields'], 2, 0, $audio);
array_splice($tomb_boxes[$last]['fields'], 3, 0, $gallery);



#-----------------------------------------------------------------#
# Page Heading Page
#-----------------------------------------------------------------# 

$title1[] = array(
	'name' =>  __('Title', 'mobius'),
	'desc' => __('Please enter the page header title.', 'mobius'),
	'id' => $prefix . '-header-title',
	'type' => 'text',
	'std' => '',
	'tab' => 'General',
	'placeholder' => '',
	'disabled' => false,
);
$title1[] = array(
	'type' => 'break',
	'tab' => 'General',
);
$subtitle[] = array(
	'name' =>  __('SubTitle', 'mobius'),
	'desc' => __('Please enter the page header subtitle.', 'mobius'),
	'id' => $prefix . '-header-subtitle',
	'type' => 'textarea',
	'std' => '',
	'disabled' => false,
	'cols' => 80,
	'rows' => 3,
	'placeholder' => '',
	'tab' => 'General',
);
$align[] = array(
	'name' => __('Content Alignment', 'mobius'),
	'desc' => __('Select the alignment of the page header content.', 'mobius'),
	'id' => $prefix . '-header-txt-align',
	'type' => 'radio',
	'std' => 'left',
	'options' => array (
			'left' => 'Left',
			'center' => 'Center',
			'right' => 'Right',
	),
	'tab' => 'General'
);
$height[] = array(
	'name' =>  __('Header Height', 'mobius'),
	'desc' => __('Please enter the header height.', 'mobius'),
	'id' => $prefix . '-header-height',
	'type' => 'slider',
	'label' => '',
	'sign'  => 'px',
	'min' => 80,
	'max' => 1000,
	'std' => 80,
	'tab' => 'General',
);
$height[] = array(
	'type' => 'break',
	'tab' => 'General'
);
$breadcrumb[] = array( 
	'name' => __('BreadCrumb Menu', 'mobius'),
	'desc' => __('If you want to display the current breakcrumb menu, please check this option.', 'mobius'),
	'id' => $prefix . '-header-menu',
	'type' => 'checkbox',
	'checkbox_title' => '',
	'std' => '',
	'tab' => 'General',
);
$transparent[] = array(
	'name' => __('Transparent header', 'mobius'),
	'desc' => __('Enable or not a transparent header over the page header/slider.', 'mobius'),
	'id' => $prefix . '-header-transparent',
	'type' => 'checkbox',
	'checkbox_title' => '',
	'std' => '',
	'tab' => 'General',
);
$particles[] = array( 
	'name' => __('Moving Particles Header', 'mobius'),
	'desc' => __('Enable parallax moving particles interaction under the page header', 'mobius'),
	'id' => $prefix . '-header-particle',
	'type' => 'checkbox',
	'checkbox_title' => '',
	'std' => '',
	'tab' => 'General',
	'tab_icon' => '<i class="tomb-icon dashicons dashicons-admin-generic"></i>'
);
$color[] = array(
	'name' => __('Text Color', 'mobius'),
	'desc' => __('Select the color of the content inside the page header.<br>Dark add black text color and light white text color.', 'mobius'),
	'id' => $prefix . '-header-color',
	'type' => 'radio',
	'std' => 'dark',
	'options' => array (
			'dark' => 'Dark',
			'light' => 'Light'
	),
	'tab' => 'Color'
);
$color[] = array( 
	'name' => __('Background Color', 'mobius'),
	'desc' => __('Please choose a background color.', 'mobius').'<br>'.__('If an image is set, then the background color will not be applied', 'mobius'),
	'id' => $prefix . '-header-bgcolor',
	'type' => 'color',
	'std' => '',
	'tab' => 'Color',
	'tab_icon' => '<i class="tomb-icon dashicons dashicons-art"></i>'
);
$image[] = array( 
	'name' => __('Background', 'mobius'),
	'desc' => __('Please enter an URL or upload the page header image.', 'mobius' ).'<br>'.  __('The image should be between 1600px and about 2000px', 'mobius' ).'<br>'.  __('Image height must be at minimum 450px', 'mobius'),
	'id' => $prefix . '-header-image',
	'type' => 'image',
	'button_upload' => __( 'Add image', 'mobius' ),
	'button_remove' => __( 'Remove', 'mobius' ),
	'frame_title'   => __( 'Select an image', 'mobius'),
	'frame_button'  => __( 'Insert image', 'mobius'),
	'button_upload' => __( 'Upload', 'mobius'),
	'button_remove' => __( 'Remove', 'mobius'),
	'std' => '',
	'tab' => 'Image',
);
$image[] = array(
	'type' => 'break',
	'tab' => 'Image',
);
$image[] = array(
	'name' => __('Background Alignment', 'mobius'),
	'desc' => __('Select the vertical alignment of the page header image', 'mobius'),
	'id' => $prefix . '-header-image-alignment',
	'type' => 'radio',
	'std' => 'center',
	'options' => array (
			'top' => 'Top',
			'center' => 'Center',
			'bottom' => 'Bottom',
	),
	'tab' => 'Image'
);
$image[] = array( 
	'name' => __('Background Pattern', 'mobius'),
	'desc' => __('If your uploaded image is a repeating pattern, please check this option.', 'mobius'),
	'id' => $prefix . '-header-repeat',
	'type' => 'checkbox',
	'checkbox_title' => '',
	'std' => '',
	'tab' => 'Image',
);
$image[] = array( 
	'name' => __('Background Parallax', 'mobius'),
	'desc' => __('If you would like to add a parallax effect on the header image, please check this option.', 'mobius'),
	'id' => $prefix . '-header-parallax',
	'type' => 'checkbox',
	'checkbox_title' => '',
	'std' => '',
	'tab' => 'Image',
	'tab_icon' => '<i class="tomb-icon dashicons dashicons-format-image"></i>'
);

$tomb_boxes[] = array(
	'id'    => $prefix . '-page-header',
	'title' => __('Page Header Settings', 'mobius'),
	'icon' => '<i class="dashicons dashicons-media-default"></i>',
	'color' => '#f1f1f1',
	'background' => '#34495e',
	'context' => 'normal',
	'priority' => 'high',
	'pages' => array('page'),
	'fields' => array()
);

/*** set page header post/portfolio***/
$last = count($tomb_boxes) - 1;
array_splice($tomb_boxes[$last]['fields'], 0, 0, $title1);
array_splice($tomb_boxes[$last]['fields'], 2, 0, $subtitle);
array_splice($tomb_boxes[$last]['fields'], 3, 0, $align);
array_splice($tomb_boxes[$last]['fields'], 4, 0, $height);
array_splice($tomb_boxes[$last]['fields'], 6, 0, $breadcrumb);
array_splice($tomb_boxes[$last]['fields'], 7, 0, $transparent);
array_splice($tomb_boxes[$last]['fields'], 8, 0, $particles);
array_splice($tomb_boxes[$last]['fields'], 9, 0, $image);
array_splice($tomb_boxes[$last]['fields'], 10, 0, $color);

$tomb_boxes[] = array(
	'id'    => $prefix . '-page-header',
	'title' => __('Page Header Settings', 'mobius'),
	'icon' => '<i class="dashicons dashicons-media-default"></i>',
	'color' => '#f1f1f1',
	'background' => '#34495e',
	'context' => 'normal',
	'priority' => 'high',
	'pages' => array('post', 'portfolio'),
	'fields' => array()
);

$hide[] = array( 
	'name' => __('Hide Default Header', 'mobius'),
	'desc' => __('If you would like to hide the default header generated for post type, please check this option.', 'mobius'),
	'id' => $prefix . '-header-hide',
	'type' => 'checkbox',
	'std' => '',
	'tab' => 'General',
);
$hide[] = array(
	'type' => 'break',
	'tab' => 'General'
);

/*** set page header post/portfolio***/
$last = count($tomb_boxes) - 1;
array_splice($tomb_boxes[$last]['fields'], 0, 0, $hide);
array_splice($tomb_boxes[$last]['fields'], 2, 0, $subtitle);
array_splice($tomb_boxes[$last]['fields'], 3, 0, $height);
array_splice($tomb_boxes[$last]['fields'], 5, 0, $transparent);
array_splice($tomb_boxes[$last]['fields'], 6, 0, $particles);
array_splice($tomb_boxes[$last]['fields'], 7, 0, $image);
array_splice($tomb_boxes[$last]['fields'], 8, 0, $color);



$tomb_boxes[] = array(
	'id'    => $prefix . '-page-header',
	'title' => __('Page Header Settings', 'mobius'),
	'icon' => '<i class="dashicons dashicons-media-default"></i>',
	'color' => '#f1f1f1',
	'background' => '#34495e',
	'context' => 'normal',
	'priority' => 'high',
	'pages' => array('product'),
	'fields' => array()
);

/*** set page header product***/
$last = count($tomb_boxes) - 1;
array_splice($tomb_boxes[$last]['fields'], 0, 0, $title1);
array_splice($tomb_boxes[$last]['fields'], 2, 0, $subtitle);
array_splice($tomb_boxes[$last]['fields'], 3, 0, $align);
array_splice($tomb_boxes[$last]['fields'], 4, 0, $height);
array_splice($tomb_boxes[$last]['fields'], 6, 0, $transparent);
array_splice($tomb_boxes[$last]['fields'], 7, 0, $particles);
array_splice($tomb_boxes[$last]['fields'], 8, 0, $image);
array_splice($tomb_boxes[$last]['fields'], 9, 0, $color);


#-----------------------------------------------------------------#
# Page FOOTER
#-----------------------------------------------------------------# 


$tomb_boxes[] = array(
	'id' => $prefix . '-page-footer',
	'title' => __('Page Footer Settings', 'mobius'),
	'icon' => '<i class="dashicons dashicons-media-default"></i>',
	'color' => '#f1f1f1',
	'background' => '#34495e',
	'context' => 'normal',
	'priority' => 'high',
	'pages' => array('post','page','portfolio','product'),
	'fields' => array(
		array( 
			'name' => __('Hide Footer Top', 'mobius'),
			'desc' => __('Check this option if you want to hide the footer top (widget area).', 'mobius'),
			'id' => $prefix . '-top-footer',
			'type' => 'checkbox',
			'std' => '',
			'tab' => 'General'
		),
		array(
			'type' => 'break',
			'tab' => 'General'
		),
		array( 
			'name' => __('Hide Footer Bottom', 'mobius'),
			'desc' => __('Check this option if you want to hide the footer bottom (e.g: copyright).', 'mobius'),
			'id' => $prefix . '-bot-footer',
			'type' => 'checkbox',
			'std' => '',
			'tab' => 'General',
			'tab_icon' => '<i class="tomb-icon dashicons dashicons-admin-generic"></i>'
		),
		array( 
			'name' => __('Footer Background', 'mobius'),
			'desc' => __('Check this option if you want a background in the footer.', 'mobius'),
			'id' => $prefix . '-footerBg',
			'type' => 'checkbox',
			'std' => '',
			'tab' => 'Image'
		),
		array(
			'type' => 'break',
			'tab' => 'Image'
		),
		array( 
			'name' => __('Footer Background Image', 'mobius'),
			'desc' => __('This image will be display under the top & bottom footer.', 'mobius').'<br>'.__('An opacity under 1 must be set in order to see this backround image.', 'mobius'),
			'id' => $prefix . '-footerBg-image',
			'type' => 'image',
			'button_upload' => __( 'Add image', 'mobius' ),
			'button_remove' => __( 'Remove', 'mobius' ),
			'frame_title'   => __( 'Select an image', 'mobius'),
			'frame_button'  => __( 'Insert image', 'mobius'),
			'button_upload' => __( 'Upload', 'mobius'),
			'button_remove' => __( 'Remove', 'mobius'),
			'std' => '',
			'tab' => 'Image',
			'tab_icon' => '<i class="tomb-icon dashicons dashicons-format-image"></i>',
			'required' => array(
				array($prefix . '-footerBg', '==', 'true')
			)
		),	
		array( 
			'name' => __('Footer Bottom text Color', 'mobius'),
			'desc' => __('Please select a color.', 'mobius'),
			'id' => $prefix . '-footerBg-top-txt',
			'type' => 'color',
			'std' => '',
			'tab' => 'Color'
		),
		array(
            'name' => __('Footer Top Text Color', 'mobius'),
			'desc' => __('Select the color of the content inside of the top footer.<br>Dark add black text color and light white text color.', 'mobius'),
            'id' => $prefix . '-footerBg-bot-txt',
            'type' => 'radio',
			'std' => 'dark',
			'options' => array (
					'dark' => 'Dark',
					'light' => 'Light',
			),
			'tab' => 'Color',
		),
		array(
			'type' => 'break',
			'tab' => 'Color'
		),
		array( 
			'name' => __('Footer Top Background Color', 'mobius'),
			'desc' => __('Please select a color.', 'mobius'),
			'id' => $prefix . '-footerBg-top-color',
			'type' => 'color',
			'std' => '',
			'tab' => 'Color'
		),
		array( 
			'name' => __('Footer Bottom Background Color', 'mobius'),
			'desc' => __('Please select a color.', 'mobius'),
			'id' => $prefix . '-footerBg-bot-color',
			'type' => 'color',
			'std' => '',
			'tab' => 'Color'
		),
		array(
			'type' => 'break',
			'tab' => 'Color'
		),
		array(
			'name' =>  __('Footer Top Background Opacity', 'mobius'),
			'desc' => __('Set the bottom footer opacity. (between 0-1)', 'mobius'),
			'id' => $prefix . '-footerBg-top-opacity',
			'type' => 'slider',
			'label' => '',
			'sign'  => '',
			'min' => 0,
			'max' => 1.01,
			'step' => 0.01,
			'std' => 0,
			'tab' => 'Color'
		),
		array(
			'name' =>  __('Footer Bottom Background Opacity', 'mobius'),
			'desc' => __('Set the bottom footer opacity. (between 0-1)', 'mobius'),
			'id' => $prefix . '-footerBg-bot-opacity',
			'type' => 'slider',
			'label' => '',
			'sign'  => '',
			'min' => 0,
			'max' => 1.01,
			'step' => 0.01,
			'std' => 0,
			'tab' => 'Color',
			'tab_icon' => '<i class="tomb-icon dashicons dashicons-art"></i>'
		),
	)
);

#-----------------------------------------------------------------#
# Portfolio SideBar
#-----------------------------------------------------------------# 

$tomb_boxes[] = array(
	'id' => $prefix . '-sidebar',
	'title' => __('Portfolio project sidebar Content', 'mobius'),
	'icon' => '<i class="dashicons dashicons-admin-post"></i>',
	'color' => '#f1f1f1',
	'background' => '#34495e',
	'context' => 'normal',
	'priority' => 'high',
	'pages' => array('portfolio'),
	'fields' => array(
		array(
			'name' =>  '',
			'desc' => __('The sidebar is displayed on the right of the portfolio and allows to add resume information and description of the porfolio.', 'mobius').'<br>'.__('if there isn\'t any content inside the sidebar, the sidebar will be removed.', 'mobius'),
			'id' => $prefix . '-portfolio-sidebar',
			'type' => 'editor',
		)
	)
);

#-----------------------------------------------------------------#
# Portfolio Extended
#-----------------------------------------------------------------# 

$tomb_boxes[] = array(
	'id' => $prefix . '-extended',
	'title' => __('Extended Page', 'mobius'),
	'icon' => '<i class="dashicons dashicons-admin-page"></i>',
	'color' => '#f1f1f1',
	'background' => '#34495e',
	'context' => 'side',
	'priority' => 'default',
	'pages' => array('post', 'portfolio'),
	'fields' => array(
		array( 
			'name' => __('Enable extended page', 'mobius'),
			'desc' => __('This option allows you to have an extended page (fully customizable).', 'mobius').'<br>'.__('By checking this option, you will don\'t have any content displayed automatically.', 'mobius'),
			'id' => $prefix . '-extended-page',
			'type' => 'checkbox',
			'std' => ''
		)
	)
);

#-----------------------------------------------------------------#
# Page Background Color
#-----------------------------------------------------------------# 

$tomb_boxes[] = array(
	'id' => $prefix . '-page',
	'title' =>  __('Background Color Setting', 'mobius'),
	'icon' => '<i class="dashicons dashicons-art"></i>',
	'color' => '#f1f1f1',
	'background' => '#34495e',
	'context' => 'side',
	'priority' => 'default',
	'pages' => array('page'),
	'fields' => array(
		array(
			'name' =>  'Page Color',
			'desc' => __('This option allows to you to set a background color to the whole page by overriding the standard color set in Mobius Options.','mobius'),
			'id' => $prefix . '-page-bgcolor',
			'type' => 'color',
		)
	)
);

#-----------------------------------------------------------------#
# Select Sliders
#-----------------------------------------------------------------#

global $wpdb;
global $post;

$args = array(
	'post_type' => 'to_slider',
	'posts_per_page' => -1
);
$orig_post = $post;
global $post;
$slider_query = new WP_Query($args);
$select = array();
$select[''] = '';
if ($slider_query->have_posts()) {
	while ($slider_query->have_posts()) : $slider_query->the_post();
		$option = get_the_ID();
		$select[$option] = get_the_title(get_the_ID());
	endwhile;
}
$post = $orig_post;
wp_reset_query(); 

/*** revSlider***/
if (class_exists('RevSlider')) {
	$slider = new RevSlider();
	$arrSliders = $slider->getArrSlidersShort();
	foreach($arrSliders as $revSlider) {
		$select[$revSlider] = $revSlider;
	}
}

$tomb_boxes[] = array(
	'id' => $prefix . '-get-slider',
	'title' => __('Slider Setting', 'mobius'),
	'icon' => '<i class="dashicons dashicons-slides"></i>',
	'color' => '#f1f1f1',
	'background' => '#34495e',
	'context' => 'side',
	'priority' => 'default',
	'pages' => array('post', 'portfolio', 'page'),
	'fields' => array(
		array( 
			'name' => __('Available slider(s)', 'mobius'),
			'id' => $prefix . '-get-slider',
			'desc' => __('This slider will be added at the top of the page', 'mobius'),
			'sub_desc' => '* '.__('Themeone Slider can be set','mobius').' <a target="_blank" href="'.admin_url( 'edit.php?post_type=to_slide').'">'.__('here', 'mobius').'</a>',
			'type' => 'select',
			'clear' => true,
			'width' => 220,
			'placeholder' => __('Select a slider', 'mobius'),
			'options' => $select,
			'std' => ''
		),
	)
);

#-----------------------------------------------------------------#
# Select SideBars
#-----------------------------------------------------------------# 

global $mobius;
$sidebars = array();
$sidebars[''] = '';
if (isset($mobius['unlimited_sidebar']) && !empty($mobius['unlimited_sidebar'])) {
	foreach($mobius['unlimited_sidebar'] as $sidebar) {
		$sidebars[$sidebar] = $sidebar;
	}
}

$tomb_boxes[] = array(
	'id' => $prefix . '-sidebars',
	'title' =>  __('SideBar Settings', 'mobius'),
	'icon' => '<i class="dashicons dashicons-align-right"></i>',
	'color' => '#f1f1f1',
	'background' => '#34495e',
	'context' => 'side',
	'priority' => 'default',
	'pages' => array('post','product','page'),
	'fields' => array(
		array(
			'name' =>  __('Sidebar', 'mobius'),
			'id' => $prefix . '-sidebar',
			'desc' => __('Sidebar can be created in','mobius').' <a target="_blank" href="'.admin_url( 'admin.php?page=_options&tab=8').'">'.__('Mobius Options', 'mobius').'</a>',
			'type' => 'select',
			'clear' => true,
			'width' => 220,
			'placeholder' => __('Select a sidebar','mobius'),
			'options' => $sidebars,
			'std' => ''
		),
		array(
            'name' => __('Position', 'mobius'),
            'id' => $prefix . '-sidebar-position',
			'desc' => __('Choose the sidebar position:','mobius'),
            'type' => 'radio',
			'options' => array (
				'left' => 'Left',
				'right' => 'Right',
			),
			'std' => ''
		),
		array( 
			'name' => __('Margin top', 'mobius'),
			'id' => $prefix . '-sidebar-margintop',
			'desc' => __('Set the sidebar margin top if necessary:','mobius'),
			'type' => 'slider',
			'label' => '',
			'sign'  => 'px',
			'min' => 0,
			'max' => 500,
			'step' => 1,
			'std' => 0,
		),
	)
);

#-----------------------------------------------------------------#
# Slide
#-----------------------------------------------------------------# 

$tomb_boxes[] = array(
	'id' => $prefix . '-slide',
	'title' => __('Slide Settings', 'mobius'),
	'icon' => '<i class="dashicons dashicons-slides"></i>',
	'color' => '#f1f1f1',
	'background' => '#34495e',
	'menu' => true,
	'context' => 'normal',
	'priority' => 'high',
	'pages' => array('to_slide'),
	'fields' => array(
		array(
			'name' => __( 'Content', 'mobius' ),
			'desc' => __( 'Here you will find the main options to add content in the current slide.', 'mobius'),
			'type' => 'section_start',
			'color' => '#ffffff',
			'background' => '#34495e',
			'tab' => 'General'
		),
		array(
			'id' => $prefix . '-slide-title',
			'name' =>  __('Slide Title', 'mobius'),
			'desc' => __('Please enter the caption of the slide.', 'mobius'),
			'type' => 'text',
			'std' => '',
			'tab' => 'General'
		),
		array(
			'type' => 'break',
			'tab' => 'General'
		),
		array(
			'id' => $prefix . '-slide-desc',
			'name' =>  __('Slide Description', 'mobius'),
			'desc' => __('Please enter the description of the slide.<br><strong>Themeone shortcode can be used to build an advanced slider caption/description (Try to not add section and columns. It\'s on experimental stage)</strong>', 'mobius'),
			'type' => 'editor',
			'std' => '',
			'tab' => 'General'
		),
		array(
			'id' => $prefix . '-slide-desc-bg',
            'name' => __('Slide Description Background', 'mobius'),
			'desc' => __('If you want to add a semi transparent background to your caption, please check this option.', 'mobius'),
            'type' => 'checkbox',
			'std' => '',
			'tab' => 'General'
		),
		array(
			'type' => 'section_end',
			'tab' => 'General'
		),
		array(
			'name' => __( 'Button', 'mobius' ),
			'desc' => __( 'In this section you can easly add button at the bottom of the content slider.', 'mobius').'<br>'.__( 'You could also use the description content to add more buttons.', 'mobius'),
			'type' => 'section_start',
			'color' => '#ffffff',
			'background' => '#34495e',
			'tab' => 'General'
		),
		array(
			'id' => $prefix . '-slide-button-text',
			'name' =>  __('Slide Button Text', 'mobius'),
			'desc' => __('If you would like a button to appear below your caption, please enter the button text here.', 'mobius'),
			'type' => 'text',
			'std' => '',
			'tab' => 'General'
		),
		array(
			'type' => 'break',
			'tab' => 'General'
		),
		array(
			'id' => $prefix . '-slide-button-link',
			'name' =>  __('Slide Button Link', 'mobius'),
			'desc' => __('Please enter the button URL.', 'mobius'),
			'type' => 'text',
			'std' => '',
			'tab' => 'General'
		),
		array(
			'type' => 'section_end',
			'tab' => 'General',
			'tab_icon' => '<i class="tomb-icon dashicons dashicons-admin-generic"></i>'
		),
		array(
			'name' => __( 'Alignment', 'mobius' ),
			'desc' => '',
			'type' => 'section_start',
			'color' => '#ffffff',
			'background' => '#34495e',
			'tab' => 'Design'
		),
		array(
			'id' => $prefix . '-slide-alignment',
            'name' => __('Content Alignment', 'mobius'),
			'desc' => __('Select the alignment of the slide title, caption and button.', 'mobius'),
			'sub_desc' => '<br>'.__('* None option is very useful when you want to create your own layout thanks to description editor.', 'mobius'),
            'type' => 'radio',
			'std' => 'center',
			'options' => array (
				'left' => 'Left',
				'center' => 'Center',
				'right' => 'Right',
				'none' => 'None'
			),
			'tab' => 'Design'
		),
		array(
			'type' => 'section_end',
			'tab' => 'Design'
		),
		array(
			'name' => __( 'Color Scheme', 'mobius' ),
			'desc' => '',
			'type' => 'section_start',
			'color' => '#ffffff',
			'background' => '#34495e',
			'tab' => 'Design'
		),
		array(
			'id' => $prefix . '-slide-color',
            'name' => __('Text Color', 'mobius'),
			'desc' => __('Select the color of the text.<br>Dark add black text color and light white text color.', 'mobius'),
			'sub_desc' => '<br>'.__('* by applying a color scheme, the slider automatically inherits to this color scheme.', 'mobius').'<br>'.__('It will only works if on the slider page you allow transparent slider option.', 'mobius'),
            'type' => 'radio',
			'std' => 'dark',
			'options' => array (
				'dark' => 'Dark',
				'light' => 'Light',
			),
			'tab' => 'Design'
		),
		array(
			'type' => 'section_end',
			'tab' => 'Design'
		),
		array(
			'name' => __( 'Feature', 'mobius' ),
			'desc' => '',
			'type' => 'section_start',
			'color' => '#ffffff',
			'background' => '#34495e',
			'tab' => 'Design'
		),
		array(
			'id' => $prefix . '-slide-rotate-txt',
			'name' => __('Slide rotate content', 'mobius'),
			'desc' => __('Allows to 3D rotate content on move over slide', 'mobius'),
			'sub_desc' => '<br>'.__('* Only works on modern browser with html5/css3. No effect will be applied for old browser.', 'mobius'),
			'type' => 'checkbox',
			'std' => '',
			'tab' => 'Design'
		),
		array(
			'type' => 'section_end',
			'tab' => 'Design',
			'tab_icon' => '<i class="tomb-icon dashicons dashicons-art"></i>'
		),
		array(
			'name' => __( 'Background Settings', 'mobius' ),
			'desc' => '',
			'type' => 'section_start',
			'color' => '#ffffff',
			'background' => '#34495e',
			'tab' => 'Image'
		),
		array( 
			'name' => __('Image', 'mobius'),
			'id' => $prefix . '-slide-image',
			'desc' => __('Please enter an URL or upload the slide image.<br> The image should be between 1600px and about 2000px.<br><strong>An image must be added even if you choose to display a video slide (only for mp4 and ogv). this image will be displayed if the video can\'t be played by the client browser</strong>', 'mobius'),
			'type' => 'image',
			'button_upload' => __( 'Add image', 'mobius' ),
			'button_remove' => __( 'Remove', 'mobius' ),
			'frame_title'   => __( 'Select an image', 'mobius'),
			'frame_button'  => __( 'Insert image', 'mobius'),
			'button_upload' => __( 'Upload', 'mobius'),
			'button_remove' => __( 'Remove', 'mobius'),
			'std' => '',
			'tab' => 'Image'
		),
		array(
			'type' => 'break',
			'tab' => 'Image'
		),
		array(
			'id' => $prefix . '-slide-image-alignment',
            'name' => __('Image Alignment', 'mobius'),
			'desc' => __('Select the vertical alignment of the slide image', 'mobius'),
            'type' => 'radio',
			'std' => 'center',
			'options' => array (
					'top' => 'Top',
					'center' => 'Center',
					'bottom' => 'Bottom',
			),
			'tab' => 'Image'
		),
		array(
			'type' => 'section_end',
			'tab' => 'Image'
		),
		array(
			'name' => __( 'Overlay Settings', 'mobius' ),
			'desc' => __('An overlay can be apply above the background image of the current slide. It allows to add visibility for text slide and also to add more style.', 'mobius'),
			'type' => 'section_start',
			'color' => '#ffffff',
			'background' => '#34495e',
			'tab' => 'Image'
		),
		array( 
			'id' => $prefix . '-slide-pattern',
			'name' => __('Overlay Pattern', 'mobius'),
			'desc' => __('Please enter an URL or upload a pattern overlay that will be apply over the slide image.', 'mobius'),
			'type' => 'image',
			'button_upload' => __( 'Add image', 'mobius' ),
			'button_remove' => __( 'Remove', 'mobius' ),
			'frame_title'   => __( 'Select an image', 'mobius'),
			'frame_button'  => __( 'Insert image', 'mobius'),
			'button_upload' => __( 'Upload', 'mobius'),
			'button_remove' => __( 'Remove', 'mobius'),
			'std' => '',
			'tab' => 'Image'
		),
		array(
			'type' => 'break',
			'tab' => 'Image'
		),
		array(
			'id' => $prefix . '-slide-overlay-bg',
			'name' => __('Overlay Background Color', 'mobius'),
			'desc' => __('Please choose an overlay background color taht will be applied over the image slide and under the pattern.', 'mobius'),
			'type' => 'color',
			'std' => '',
			'tab' => 'Image'
		),
		array(
			'type' => 'break',
			'tab' => 'Image'
		),
		array(
			'id' => $prefix . '-slide-overlay-opacity',
			'name' => __('Overlay Background Opacity', 'mobius'),
			'desc' => __('Please enter an opacity value for the background color overlay.', 'mobius').'<strong>'.__('Between 0 and 0.99 with a dot separator please.', 'mobius').'</strong>',
			'type' => 'slider',
			'sign'  => '',
			'min' => 0,
			'max' => 1.01,
			'step' => 0.01,
			'std' => 0,
			'tab' => 'Image'
		),
		array(
			'type' => 'section_end',
			'tab' => 'Image',
			'tab_icon' => '<i class="tomb-icon dashicons dashicons-format-image"></i>'
		),
		array(
			'name' => __( 'Hosted Video', 'mobius' ),
			'desc' => __('Hosted video is the best choice in order to obtained best performance. A CND is recommanded for loading speed.', 'mobius'),
			'type' => 'section_start',
			'color' => '#ffffff',
			'background' => '#34495e',
			'tab' => 'Video'
		),
		array( 
			'id' => $prefix . '-slide-m4v',
			'name' => __('M4V/MP4 File URL', 'mobius'),
			'desc' => __('Please enter an URL or upload your .m4v/.mp4 video file', 'mobius'),
			'type' => 'upload',
			'button_upload' => __( 'Add .mp4', 'mobius' ),
			'button_remove' => __( 'Remove', 'mobius' ),
			'std' => '',
			'tab' => 'Video'
		),
		array(
			'type' => 'break',
			'tab' => 'Video'
		),
		array( 
			'id' => $prefix . '-slide-webm',
			'name' => __('WEBM File URL', 'mobius'),
			'desc' => __('Please enter an URL or upload your .webm video file', 'mobius'),
			'type' => 'upload',
			'button_upload' => __( 'Add .webm', 'mobius' ),
			'button_remove' => __( 'Remove', 'mobius' ),
			'std' => '',
			'tab' => 'Video'
		),
		array(
			'type' => 'break',
			'tab' => 'Video'
		),
		array( 
			'id' => $prefix . '-slide-ogv',
			'name' => __('OGV/OGG File URL', 'mobius'),
			'desc' => __('Please enter an URL or upload your .ogv/.ogg video file', 'mobius'),
			'type' => 'upload',
			'button_upload' => __( 'Add .ogv', 'mobius' ),
			'button_remove' => __( 'Remove', 'mobius' ),
			'std' => '',
			'tab' => 'Video'
		),
		array(
			'type' => 'section_end',
			'tab' => 'Video'
		),
		array(
			'name' => __( 'Embedded Player', 'mobius' ),
			'desc' => __('We recommand to use Vimeo service for best performance.', 'mobius'),
			'type' => 'section_start',
			'color' => '#ffffff',
			'background' => '#34495e',
			'tab' => 'Video'
		),
		array(
			'type' => 'break',
			'tab' => 'Video'
		),
		array(
			'id' => $prefix . '-slide-youtube',
			'name' => __('Youtube Embed URL', 'mobius'),
			'desc' => __('Please enter a Youtube link. <br><strong>(Do not paste the embedded code, just the embedded link please)</strong>.', 'mobius'),
			'type' => 'text',
			'std' => '',
			'tab' => 'Video'
		),
		array(
			'type' => 'break',
			'tab' => 'Video'
		),
		array(
			'id' => $prefix . '-slide-vimeo',
			'name' => __('Vimeo Embed URL', 'mobius'),
			'desc' => __('Please enter a Vimeo link. <br><strong>(Do not paste the embedded code, just the embedded link please)</strong>.', 'mobius'),
			'type' => 'text',
			'std' => '',
			'tab' => 'Video'
		),
		array(
			'type' => 'break',
			'tab' => 'Video'
		),
		array(
			'id' => $prefix . '-slide-video-volume',
			'name' => __('Video Volume', 'mobius'),
			'desc' => __('Please choose the video volume between 0 and 1', 'mobius'),
			'type' => 'slider',
			'sign'  => '',
			'min' => 0,
			'max' => 1.01,
			'step' => 0.01,
			'std' => 0,
			'tab' => 'Video'
		),
		array(
			'type' => 'section_end',
			'tab' => 'Video',
			'tab_icon' => '<i class="tomb-icon dashicons dashicons-video-alt3"></i>'
		),
	)
);

#-----------------------------------------------------------------#
# Slider
#-----------------------------------------------------------------# 

$display = null;
$slides  = '<ul class="connected-slides">';
if (isset($_GET['post'])) {
	$ID = $_GET['post'];
	$slides_id = get_post_meta($ID, 'themeone-slider-slides', true);
		
	if ($slides_id != null) {
		$ids     = explode(",",$slides_id);
		$display = 'style="display:none;"';
		foreach($ids as $id) {
			$thumbnail = themeone_video_thumbnail($id);
			$slides .= '<li class="to-slide-metabox" id="'. $id .'" style="background-image: url('. $thumbnail .');">';
			$slides .= '<div class="to-slide-item-buttons">';
			$slides .= '<div class="to-slide-item-remove"><div class="dashicons dashicons-no-alt"></div></div>';
			$slides .= '<div class="to-slide-item-edit"><a target="_blank" href="'.admin_url( 'post.php?post='.$id.'&action=edit').'"><div class="dashicons dashicons-edit"></div></a></div>';
			$slides .= '</div>';
			$slides .= '<div class="to-slide-title">'. get_the_title($id) .'</div>';
			$slides .= '</li>';
		}
	} else {
		$display = 'style="display:table-cell;"';
	}
	
}
$slides .= '<div '.$display.' class="to-slide-empty">'.__('Drag & drop some slides here to build your slider', 'mobius').'</div>';
$slides .= '</ul>';

$available_slides = '<ul class="connected-slides">';
global $wpdb;
$args = array(
	'post_type' => 'to_slide',
	'posts_per_page' => -1
);
$orig_post = $post;
global $post;
$slide_query = new WP_Query($args);
if ($slide_query->have_posts()) {
	while ($slide_query->have_posts()) : $slide_query->the_post();
		$post_id = get_the_ID();
		$thumbnail = themeone_video_thumbnail($post_id);
		$available_slides .= '<li class="to-slide-metabox" id="'. $post_id .'" style="background-image: url('. $thumbnail .');">';
		$available_slides .= '<div class="to-slide-item-buttons">';
		$available_slides .= '<div class="to-slide-item-remove"><div class="dashicons dashicons-no-alt"></div></div>';
		$available_slides .= '<div class="to-slide-item-edit"><a target="_blank" href="'.admin_url( 'post.php?post='.$post_id.'&action=edit').'"><div class="dashicons dashicons-edit"></div></a></div>';
		$available_slides .= '</div>';
		$available_slides .= '<div class="to-slide-title">'. get_the_title($post_id) .'</div>';
		$available_slides .= '</li>';
	endwhile;
} else {
	$available_slides .= '<div class="to-slide-empty"><a href="'. admin_url( "post-new.php?post_type=to_slide", "http" ) .'">No slide available. Please add slides</a></div>';
}
$available_slides .= '</ul>';
$post = $orig_post;
wp_reset_query();

$tomb_boxes[] = array(
	'id' => $prefix . '-slider-settings',
	'title' =>  __('Slider Settings', 'mobius'),
	'icon' => '<i class="dashicons dashicons-slides"></i>',
	'color' => '#f1f1f1',
	'background' => '#34495e',
	'menu' => true,
	'context' => 'normal',
	'priority' => 'high',
	'pages' => array('to_slider'),
	'fields' => array(
		array(
			'name' => __( 'Slider Builder', 'mobius'),
			'desc' => __('Cronstruct your slider by dragging available slides here.', 'mobius'),
			'type' => 'section_start',
			'color' => '#ffffff',
			'background' => '#34495e',
			'tab' => 'General',
		),
		array( 
			'name' => __('Current Slider', 'mobius'),
			'desc' => __('Drop the slides here to build your custom slider', 'mobius'),
			'id' => $prefix . '-slider-slides',
			'type' => 'hidden',
			'options' => $slides,
			'tab' => 'General'
		),
		array(
			'type' => 'section_end',
			'tab' => 'General',
		),
		array(
			'name' => __( 'Available Slides', 'mobius' ),
			'desc' => '',
			'type' => 'section_start',
			'color' => '#ffffff',
			'background' => '#34495e',
			'tab' => 'General',
		),
		array( 
			'name' => __('Available slides', 'mobius'),
			'desc' => __('Drag and drop slides', 'mobius'),
			'id' => $prefix . '-slides-drag',
			'type' => 'hidden',
			'options' => $available_slides,
			'tab' => 'General',
		),
		array(
			'type' => 'section_end',
			'tab' => 'General',
			'tab_icon' => '<i class="tomb-icon dashicons dashicons-admin-generic"></i>'
		),
		array(
			'name' => __( 'Height', 'mobius' ),
			'desc' => '',
			'type' => 'section_start',
			'color' => '#ffffff',
			'background' => '#34495e',
			'tab' => 'Design',
		),
		array( 
			'id' => $prefix . '-slider-full-height',
			'name' => __('Slider Full Height', 'mobius'),
			'desc' => __('This option allow to have the slider in full screen height. <br><strong>(if this option is checked, then the height in px will not be applied)</strong>', 'mobius'),
			'type' => 'checkbox',
			'std' => '',
			'tab' => 'Design',
		),
		array( 
			'id' => $prefix . '-slider-height',
			'name' => __('Slider Height', 'mobius'),
			'desc' => __('Please enter the slider height. <br><strong>(Please do not add \'px\')</strong>', 'mobius'),
			'type' => 'slider',
			'sign'  => 'px',
			'min' => 0,
			'max' => 2000,
			'step' => 1,
			'std' => 550,
			'required' => array(
				array($prefix . '-slider-full-height', '!=', 'true')
			),
			'tab' => 'Design',
		),
		array(
			'type' => 'section_end',
			'tab' => 'Design',
		),
		array(
			'name' => __( 'Design/Effects', 'mobius' ),
			'desc' => '',
			'type' => 'section_start',
			'color' => '#ffffff',
			'background' => '#34495e',
			'tab' => 'Design',
		),
		array(
			'id' => $prefix . '-slider-parallax',
			'name' => __('Slider Parallax', 'mobius'),
			'desc' => __('Enable or not a parallax effect on the slider', 'mobius'),
			'type' => 'checkbox',
			'std' => '',
			'tab' => 'Design',
		),
		array(
			'type' => 'break',
			'tab' => 'Design',
		),
		array(
			'id' => $prefix . '-slider-transparent',
			'name' => __('Slider Transparent header', 'mobius'),
			'desc' => __('Enable or not a transparent header. <br><strong>(Only works if there isn\'t page header on the page)</strong>', 'mobius'),
			'type' => 'checkbox',
			'std' => '',
			'tab' => 'Design',
		),
		array(
			'type' => 'break',
			'tab' => 'Design',
		),
		array(
			'id' => $prefix . '-slider-scrollto',
			'name' => __('Slider Scroll to bottom button', 'mobius'),
			'desc' => __('Add an arrow to the bottom of the slider to scroll after the slider content at the beginning of the page on click', 'mobius'),
			'type' => 'checkbox',
			'std' => '',
			'tab' => 'Design',
		),
		array(
			'type' => 'section_end',
			'tab' => 'Design',
			'tab_icon' => '<i class="tomb-icon dashicons dashicons-art"></i>'
		),
		array(
			'name' => __( 'Timer', 'mobius' ),
			'desc' => '',
			'type' => 'section_start',
			'color' => '#ffffff',
			'background' => '#34495e',
			'tab' => 'Timer',
		),
		array(
			'id' => $prefix . '-slider-timer',
			'name' => __('Slider Autoplay', 'mobius'),
			'desc' => __('This option enable auto play slider', 'mobius'),
			'type' => 'checkbox',
			'std' => '',
			'tab' => 'Timer',
		),
		array(
			'type' => 'break',
			'tab' => 'Timer',
		),
		array(
			'id' => $prefix . '-slider-time',
			'name' => __('Slider Delay', 'mobius'),
			'desc' => __('If you checked autoplay, then you can set the time between each slide transition in millisecond.', 'mobius'),
			'type' => 'slider',
			'sign'  => 'ms',
			'min' => 0,
			'max' => 60000,
			'step' => 1,
			'std' => 15000,
			'required' => array(
				array($prefix . '-slider-timer', '==', 'true')
			),
			'tab' => 'Timer',
		),
		array(
			'type' => 'break',
			'tab' => 'Timer',
		),
		array(
			'id' => $prefix . '-slider-time-bar',
			'name' => __('Slider Autoplay Time Bar', 'mobius'),
			'desc' => __('If autoplay is checked, then you can display or not the timer bar during autoplay.', 'mobius'),
			'type' => 'checkbox',
			'std' => '',
			'required' => array(
				array($prefix . '-slider-timer', '==', 'true')
			),
			'tab' => 'Timer',
		),
		array(
			'type' => 'section_end',
			'tab' => 'Timer',
			'tab_icon' => '<i class="tomb-icon dashicons dashicons-clock"></i>'
		),
	)
);

$tomb_taxos[] = array(
	'id'    => $prefix . '-category-color-settings',
	'title' => 'Mobius Grid Category Color',
	'icon' => '<i class="dashicons-before dashicons-screenoptions"></i>',
	'color' => '',
	'background' => '',
	'taxonomy' => 'category',
	'fields' => array(
		array(
			'id'   => 'catBG',
			'name' => __('Mobius Grid - Category Background Color', 'mobius').'<br><br>',
			'desc' => '',
			'sub_desc' => __('Choose a color for the background category', 'mobius'),
			'type' => 'color',
			'std' => '#000000'
		)
	),
);

foreach ($tomb_boxes as $tomb_boxe) {
	$my_box = new themeone_meta_box($tomb_boxe);
}

foreach ($tomb_taxos as $tomb_taxo) {
	$my_box = new themeone_Taxonomy_Metabox($tomb_taxo);
}

}

?>