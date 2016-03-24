<?php
    /**
     * ReduxFramework Config File
     */

    if ( ! class_exists( 'Themeone_config' ) ) {

        class Themeone_config {

            public $args = array();
            public $sections = array();
            public $theme;
            public $ReduxFramework;

            public function __construct() {
				require_once ABSPATH . WPINC . '/plugin.php';
                if (!class_exists('ReduxFramework')) {
                    return;
                }
				if (true == Redux_Helpers::isTheme(__FILE__)) {
                    $this->initSettings();
                } else {
                    add_action('plugins_loaded', array( $this, 'initSettings'), 10);
                }
				add_action('init', array( $this, 'redux_mobius_remove_demo'));
            }

            public function initSettings() {
                $this->theme = wp_get_theme();
                $this->setArguments();
                $this->setHelpTabs();
                $this->setSections();
                if (!isset( $this->args['opt_name'])) {
                    return;
                }
                $this->ReduxFramework = new ReduxFramework( $this->sections, $this->args );
            }
			
			public function redux_mobius_remove_demo() {
				if ( class_exists('ReduxFrameworkPlugin') ) {
					remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
				}
				if ( class_exists('ReduxFrameworkPlugin') ) {
					remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );    
				}
			}


            public function setSections() {
                $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
                $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
                $sample_patterns      = array();

                if ( is_dir( $sample_patterns_path ) ) :
                    if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) :
                        $sample_patterns = array();
                        while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {
                            if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                                $name              = explode( '.', $sample_patterns_file );
                                $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                                $sample_patterns[] = array(
                                    'alt' => $name,
                                    'img' => $sample_patterns_url . $sample_patterns_file
                                );
                            }
                        }
                    endif;
                endif;

                ob_start();

                $ct          = wp_get_theme();
                $this->theme = $ct;
                $item_name   = $this->theme->get( 'Name' );
                $tags        = $this->theme->Tags;
                $screenshot  = $this->theme->get_screenshot();
                $class       = $screenshot ? 'has-screenshot' : '';

                $customize_title = sprintf( __( 'Customize &#8220;%s&#8221;', 'redux-framework-demo' ), $this->theme->display( 'Name' ) );

                $item_info = ob_get_contents();

                ob_end_clean();

                $sampleHTML = '';
                if ( file_exists( dirname( __FILE__ ) . '/info-html.html' ) ) {
                    Redux_Functions::initWpFilesystem();
                    global $wp_filesystem;
                    $sampleHTML = $wp_filesystem->get_contents( dirname( __FILE__ ) . '/info-html.html' );
                }
				
				// google analytics url
				$googleurl = 'http://www.google.com/analytics/';
				
                // ACTUAL DECLARATION OF SECTIONS
                $this->sections[] = array(
                'icon' => 'dashicons dashicons-admin-generic',
                'title' => __('General', 'mobius'),
				'heading' => __('General Settings', 'mobius'),
                'fields' => array(
					array(
						'id'     => 'section-logo-start',
						'type'   => 'section',
						'title' => __('Favicon Logo', 'mobius'),
						'indent' => true,
					),
					array(
                        'id' => 'favicon',
                        'type' => 'media',
						'url' => true,
                        'title' => __('Favicon', 'mobius'),
                        'desc' => __('Upload a 16x16px jpge, png or gif image.', 'mobius'),
                        'subtitle' => __('Add a favicon logo to your website. <br> The favicon is displayed on the browser tab of your website.', 'mobius'),
                        'default' => array('url'=>get_template_directory_uri() . '/images/favicon.png'),
                    ),
					array(
                        'id' => 'apple-touch-icon',
                        'type' => 'media',
						'url' => true,
                        'title' => __('Apple Touch Icon', 'mobius'),
                        'desc' => __('Upload an image from 60x60px to 152x152px .png file.', 'mobius'),
                        'subtitle' => __('You may want users to be able to add your web application or webpage link to the Home screen. This image correspond to the icon webpage on iOS.', 'mobius'),
                        'default' => '',
                    ),
					array(
						'id'     => 'section-logo-end',
						'type'   => 'section',
						'indent' => false,
					),
					array(
						'id'     => 'section-preloader-start',
						'type'   => 'section',
						'title' => __('Preloader Settings', 'mobius'),
						'indent' => true,
					),
					array(
                        'id' => 'preloader',
                        'type' => 'switch',
                        'title' => __('Preloader', 'mobius'),
                        'subtitle' => __('Enable a preloader screen on first page load. It displays a loading circle animation and your logo until the browser fetched the whole webcontent and will fade out the moment the page has been completely chached.', 'mobius'),
                        'default' => '1'
                    ),
					array(
						'id'     => 'section-preloader-end',
						'type'   => 'section',
						'indent' => false,
					),
					array(
						'id'     => 'section-scrolling-start',
						'type'   => 'section',
						'title' => __('Scrolling Settings', 'mobius'),
						'indent' => true,
					),
					array(
                        'id' => 'smooth-scroll',
                        'type' => 'switch',
                        'title' => __('Smooth Scrolling', 'mobius'),
                        'subtitle' => __('Allow to have a smooth scrolling on modern browser.', 'mobius'),
                        'default' => '1'
                    ),
					array(
                        'id' => 'scroll-to-top',
                        'type' => 'switch',
                        'title' => __('Back To Top Button', 'mobius'),
                        'subtitle' => __('Add or not a back to top scrolling button at the button of all pages.', 'mobius'),
                        'default' => '1'
                    ),
					array(
						'id'     => 'section-scrolling-end',
						'type'   => 'section',
						'indent' => false,
					),
					array(
						'id'     => 'section-buttons-start',
						'type'   => 'section',
						'title' => __('Top Menu Button Settings', 'mobius'),
						'indent' => true,
					),
					array(
                        'id' => 'right-sidebar',
                        'type' => 'switch',
                        'title' => __('Right Sidebar Button', 'mobius'),
                        'subtitle' => __('Add or not the cross button of the right sidebar on the top nav menu.', 'mobius'),
                        'default' => '1'
                    ),
					array(
                        'id' => 'search-button',
                        'type' => 'switch',
                        'title' => __('Search Button', 'mobius'),
                        'subtitle' => __('Add or not the search button on the top nav menu.', 'mobius'),
                        'default' => '1'
                    ),
					array(
						'id'     => 'section-buttons-end',
						'type'   => 'section',
						'indent' => false,
					),
					array(
						'id'     => 'section-ajax-start',

						'type'   => 'section',
						'title' => __('Ajax Settings', 'mobius'),
       					'subtitle' => __('If you want to have a full ajax website, please enable all ajax options.', 'mobius'),
						'indent' => true,
					),
					array(
                        'id' => 'ajax-nav',
                        'type' => 'switch',
                        'title' => __('Ajax Navigation', 'mobius'),
                        'subtitle' => __('Allow to load all page content without reloading the page.', 'mobius'),
                        'default' => '1'
                    ),
					array(
                        'id' => 'ajax-search',
                        'type' => 'switch',
                        'title' => __('Ajax Search', 'mobius'),
                        'subtitle' => __('Allow to have a live search autocomplete form that appears while typing in search bar.', 'mobius'),
                        'default' => '1'
                    ),
					array(
                        'id' => 'ajax-comment',
                        'type' => 'switch',
                        'title' => __('Ajax Comment', 'mobius'),
                        'subtitle' => __('Allow to post a comment without reloading the page.', 'mobius'),
                        'default' => '1'
                    ),
					array(
						'id'     => 'section-ajax-end',
						'type'   => 'section',
						'indent' => false,
					),
					array(
						'id'     => 'section-gallery-start',

						'type'   => 'section',
						'title' => __('Gallery Setting', 'mobius'),
       					'subtitle' => '',
						'indent' => true,
					),
					array(
                        'id' => 'grid-gallery',
                        'type' => 'switch',
                        'title' => __('Post Grid Gallery', 'mobius'),
                        'subtitle' => __('Allow to display Wordpress gallery as a responsive grid with Lightbox in post.', 'mobius'),
                        'default' => ''
                    ),
					array(
						'id'     => 'section-gallery-end',
						'type'   => 'section',
						'indent' => false,
					),
					array(
						'id'     => 'section-analytics-start',
						'type'   => 'section',
						'title' => __('Google Analytics', 'mobius'),
       					'subtitle' => __('Google Analytics is a service offered by Google that generates detailed statistics about a website\'s traffic and traffic sources and measures conversions and sales.<br>More informations about Google Analytics can be found out there:', 'mobius'). '<a href="'. $googleurl .'">http://www.google.com/analytics/</a>',
						'indent' => true,
					),
					array(
                        'id' => 'google-analytics',
                        'type' => 'textarea',
                        'title' => __('Google Analytics Script', 'mobius'),
                        'subtitle' => __('Please enter your google analytics code here.<br><strong>You must enter the full script from google (not just the tracking ID)</strong>.', 'mobius'),
                        'mode' => 'html',
                        'default' => ''
                    ),
					array(
						'id'     => 'section-analytics-end',
						'type'   => 'section',
						'indent' => false,
					),
					array(
						'id'     => 'section-codefield-start',
						'type'   => 'section',
						'title' => __('Custom Code Fields', 'mobius'),
						'indent' => true,
					),
                    array(
                        'id' => 'custom-css',
                        'type' => 'ace_editor',
                        'title' => __('CSS Code', 'mobius'),
                        'subtitle' => __('Paste your custom CSS code here.<br> Very helpful if you add a custom class in a shortcode in order to customize a specific element.', 'mobius'),
                        'mode' => 'css',
                        'theme' => 'chrome',
                        'desc' => '',
                        'default'  => ''
                    ),
                    array(
                        'id' => 'custom-js',
                        'type' => 'ace_editor',
                        'title' => __('JS Code', 'mobius'),
                        'subtitle' => __('Paste your custom JS code here.', 'mobius'),
                        'mode' => 'javascript',
                        'theme' => 'monokai',
                        'desc' => '',
                        'default' => ''
                    ),
					array(
						'id'     => 'section-codefield-end',
						'type'   => 'section',
						'indent' => false,
					),
                )
            );
			
			$this->sections[] = array(
                'icon' => 'dashicons dashicons-editor-paragraph',
                'title' => __('Typography', 'mobius'),
				'heading' => __('Typography Settings', 'mobius'),
                'fields' => array(
					array(
						'id'     => 'section-main-start',
						'type'   => 'section',
						'title' => __('Main font', 'mobius'),
						'indent' => true,
					),				
					array(
						'id'          => 'body-font',
						'type'        => 'typography', 
						'title'       => __('Body', 'mobius'),
						'google'      => true, 
						'text-align'  => false,
						'line-height' => false,
						'subsets'     => true,
						'color'       => false,
						'output'      => array('body,p,#left-nav li a,#top-nav ul ul li a,.widget.widget_nav_menu li a'),
						'units'       =>'px',
						'font-backup' => true,
						'preview'     => array(
							'always_display' => true,
							'font-size'      => '14px',
						),
						'default'     => array(
							'font-family' => 'Open Sans',
							'font-size'   => '14px',
							'font-style'  => '400',
							'google'      => true,
						),
					),
					array(
						'id'          => 'menu-font',
						'type'        => 'typography', 
						'title'       => __('Menu', 'mobius'),
						'google'      => true, 
						'text-align'  => false,
						'line-height' => false,
						'subsets'     => true,
						'color'       => false,
						'output'      => array('#top-nav > ul > li > a'),
						'units'       =>'px',
						'font-backup' => true,
						'preview'     => array(
							'always_display' => true,
							'font-size'      => '12px',
						),
						'default'     => array(
							'font-family' => 'Open Sans',
							'font-size'   => '12px',
							'font-style'  => '700',
							'google'      => true,
						),
					),
					array(
						'id'     => 'section-main-end',
						'type'   => 'section',
						'indent' => false,
					),
					array(
						'id'     => 'section-heading-start',
						'type'   => 'section',
						'title' => __('Heading font', 'mobius'),
						'indent' => true,
					),
					array(
						'id'          => 'h1-font',
						'type'        => 'typography', 
						'title'       => __('Heading 1 (heading header, post blog header and h1 font)', 'mobius'),
						'google'      => true, 
						'text-align'  => false,
						'subsets'     => true,
						'color'       => false,
						'output'      => array('h1, .to-page-heading .title, .single-title'),
						'units'       =>'px',
						'font-backup' => true,
						'preview'     => array(
							'always_display' => true,
							'font-size'      => '45px',
						),
						'default'     => array(
							'font-family' => 'Source Sans Pro',
							'font-size'   => '45px',
							'line-height' => '45px',
							'font-style'  => '400',
							'google'      => true,
						),
					),
					array(
						'id'          => 'h2-font',
						'type'        => 'typography', 
						'title'       => __('Heading 2', 'mobius'),
						'google'      => true, 
						'text-align'  => false,
						'subsets'     => true,
						'color'       => false,
						'output'      => array('h2, .woocommerce div.product div.summary h1'),
						'units'       =>'px',
						'font-backup' => true,
						'preview'     => array(
							'always_display' => true,
							'font-size'      => '40px',
						),
						'default'     => array(
							'font-family' => 'Raleway',
							'font-size'   => '40px',
							'line-height' => '46px',
							'font-style'  => '400',
							'google'      => true,
						),
					),
					array(
						'id'          => 'h3-font',
						'type'        => 'typography', 
						'title'       => __('Heading 3', 'mobius'),
						'google'      => true, 
						'text-align'  => false,
						'subsets'     => true,
						'color'       => false,
						'output'      => array('h3, .woocommerce-tabs h2, .cart-collaterals h2'),
						'units'       =>'px',
						'font-backup' => true,
						'preview'     => array(
							'always_display' => true,
							'font-size'      => '20px',
						),
						'default'     => array(
							'font-family' => 'Raleway',
							'font-size'   => '20px',
							'line-height' => '28px',
							'font-style'  => '500',
							'google'      => true,
						),
					),
					array(
						'id'          => 'h4-font',
						'type'        => 'typography', 
						'title'       => __('Heading 4', 'mobius'),
						'google'      => true, 
						'text-align'  => false,
						'subsets'     => true,
						'color'       => false,
						'output'      => array('h4'),
						'units'       =>'px',
						'font-backup' => true,
						'preview'     => array(
							'always_display' => true,
							'font-size'      => '18px',
						),
						'default'     => array(
							'font-family' => 'Raleway',
							'font-size'   => '18px',
							'line-height' => '26px',
							'font-style'  => '400',
							'google'      => true,
						),
					),
					array(
						'id'          => 'h5-font',
						'type'        => 'typography', 
						'title'       => __('Heading 5', 'mobius'),
						'google'      => true, 
						'text-align'  => false,
						'subsets'     => true,
						'color'       => false,
						'output'      => array('h5'),
						'units'       =>'px',
						'font-backup' => true,
						'preview'     => array(
							'always_display' => true,
							'font-size'      => '16px',
						),
						'default'     => array(
							'font-family' => 'Raleway',
							'font-size'   => '16px',
							'line-height' => '22px',
							'font-style'  => '500',
							'google'      => true,
						),
					),
					array(
						'id'          => 'h6-font',
						'type'        => 'typography', 
						'title'       => __('Heading 6', 'mobius'),
						'google'      => true, 
						'text-align'  => false,
						'subsets'     => true,
						'color'       => false,
						'output'      => array('h6'),
						'units'       =>'px',
						'font-backup' => true,
						'preview'     => array(
							'always_display' => true,
							'font-size'      => '14px',
						),
						'default'     => array(
							'font-family' => 'Raleway',
							'font-size'   => '14px',
							'line-height' => '20px',
							'font-style'  => '600',
							'google'      => true,
						),
					),
					array(
						'id'     => 'section-heading-end',
						'type'   => 'section',
						'indent' => false,
					),
					array(
						'id'     => 'section-slider-font-start',
						'type'   => 'section',
						'title' => __('slider font', 'mobius'),
						'indent' => true,
					),
					array(
						'id'          => 'heading-font',
						'type'        => 'typography', 
						'title'       => __('Heading in header and slider', 'mobius'),
						'google'      => true, 
						'text-align'  => false,
						'subsets'     => true,
						'color'       => false,
						'output'      => array('.to-slide .to-slide-content-inner h1'),
						'units'       =>'px',
						'font-backup' => true,
						'preview'     => array(
							'always_display' => true,
							'font-size'      => '60px',
						),
						'default'     => array(
							'font-family' => 'Source Sans Pro',
							'font-size'   => '60px',
							'line-height' => '60px',
							'font-style'  => '700',
							'google'      => true,
						),
					),
					array(
						'id'     => 'section-slider-font-end',
						'type'   => 'section',
						'indent' => false,
					),
					array(
						'id'     => 'section-grid-font-heading-start',
						'type'   => 'section',
						'title' => __('Grid Blog header font', 'mobius'),
						'indent' => true,
					),
					array(
						'id'          => 'heading-grid-font',
						'type'        => 'typography', 
						'title'       => __('Heading in grid', 'mobius'),
						'google'      => true, 
						'font-size'   => false,
						'line-height' => false,
						'text-align'  => false,
						'subsets'     => true,
						'color'       => false,
						'output'      => array('.to-item h2, .post-title'),
						'units'       =>'px',
						'font-backup' => true,
						'preview'     => array(
							'always_display' => true,
							'font-size'      => '14px',
						),
						'default'     => array(
							'font-family' => 'Raleway',
							'font-style'  => '600',
							'google'      => true,
						),
					),
					array(
						'id'     => 'section-grid-font-heading-end',
						'type'   => 'section',
						'indent' => false,
					),
					array(
						'id'     => 'section-numbers-font-start',
						'type'   => 'section',
						'title' => __('Numbers font', 'mobius'),
						'indent' => true,
					),
					array(
						'id'          => 'number-font',
						'type'        => 'typography', 
						'title'       => __('Numbers Font', 'mobius'),
						'google'      => true, 
						'text-align'  => false,
						'font-size'   => false,
						'line-height' => false,
						'subsets'     => true,
						'color'       => false,
						'output'      => array('.to-page-nav li a, .woocommerce-pagination a, .woocommerce-pagination span, .dark .post-info .post-date .date, .to-counter-number,.to-step-number,.to-step-back,.to-pie-chart span,.to-progress-bar strong,.to-ptable .to-ptable-cost, .to-process .to-step-nb'),
						'units'       =>'px',
						'font-backup' => true,
						'preview'     => array(
							'always_display' => true,
							'font-size'      => '14px',
						),
						'default'     => array(
							'font-family' => 'Source Sans Pro',
							'font-style'  => '400',
							'google'      => true,
						),
					),
					array(
						'id'     => 'section-numbers-font-end',
						'type'   => 'section',
						'indent' => false,
					),
                )
            );
			
			$this->sections[] = array(
                'icon' => 'dashicons dashicons-art',
                'title' => __('Colors', 'mobius'),
				'heading' => __('Colors Settings', 'mobius'),
                'fields' => array(
					array(
						'id'     => 'section-color-start',
						'type'   => 'section',
						'title' => __('Accent Color', 'mobius'),
						'indent' => true,
					),
					array(
						'id'          => 'accent-color1',
						'type'        => 'color',
						'title'       => __('Default Accent Color', 'mobius'), 
						'subtitle'    => __('Pick a color for the default accent color theme.', 'mobius'),
						'default'     => '#ff6863',
						'transparent' => false,
						'validate'    => 'color',
					),
					array(
						'id'          => 'accent-color1-txt',
						'type'        => 'color',
						'title'       => __('Default Accent Text Color', 'mobius'), 
						'subtitle'    => __('Pick a color for the default accent text color theme. This color is associated to the previous color. It will be applied as a text color for accent background color. So you shouldn\'t get the same color as above.', 'mobius'),
						'default'     => '#ffffff',
						'transparent' => false,
						'validate'    => 'color',
					),
					array(
						'id'    => 'info_accent_color-1',
						'type'  => 'info',
						'title' => __('The following accent color2 and accent color3 will be only used in themeone shortcode generator in order to set different color scheme.<br>It will facilitate your way to manage your main accent color by just setting colors in this section and not to change color everytime in the shortcodes.', 'mobius'),
						'icon'  => 'el-icon-info-sign',
					),
					array(

						'id'     => 'section-color2-start',
						'type'   => 'section',
						'indent' => true,
					),
					array(
						'id'          => 'accent-color2',
						'type'        => 'color',
						'title'       => __('Accent Color2', 'mobius'), 
						'subtitle'    => __('Pick a color for the accent color 2.', 'mobius'),
						'default'     => '#8976eb',
						'transparent' => false,
						'validate'    => 'color',
					),
					array(
						'id'          => 'accent-color3',
						'type'        => 'color',
						'title'       => __('Accent Color3', 'mobius'), 
						'subtitle'    => __('Pick a color for the accent color 3.', 'mobius'),
						'default'     => '#36D7B7',
						'transparent' => false,
						'validate'    => 'color',
					),
					array(
						'id'     => 'section-end',
						'type'   => 'section',
						'indent' => false,
					),
					array(
						'id'     => 'section-text-start',
						'type'   => 'section',
						'title' => __('Text Color Scheme Settings', 'mobius'),
						'indent' => true,
					),
					array(
						'id'          => 'body-text-light',
						'type'        => 'color',
						'title'       => __('Body Light Text Color', 'mobius'), 
						'subtitle'    => __('Pick a color for the light body text color.', 'mobius'),
						'default'     => '#e8e8e8',
						'transparent' => false,
						'validate'    => 'color',
					),
					array(
						'id'          => 'heading-text-light',
						'type'        => 'color',
						'title'       => __('Heading Light Text Color', 'mobius'), 
						'subtitle'    => __('Pick a color for the light heading text color.', 'mobius'),
						'default'     => '#ffffff',
						'transparent' => false,
						'validate'    => 'color',
					),
					array(
						'id'          => 'body-text-dark',
						'type'        => 'color',
						'title'       => __('Body Dark Text Color', 'mobius'), 
						'subtitle'    => __('Pick a color for the dark body text color.', 'mobius'),
						'default'     => '#999999',
						'transparent' => false,
						'validate'    => 'color',
					),
					array(
						'id'          => 'heading-text-dark',
						'type'        => 'color',
						'title'       => __('Heading Dark Text Color', 'mobius'), 
						'subtitle'    => __('Pick a color for the dark heading text color.', 'mobius'),
						'default'     => '#59585b',
						'transparent' => false,
						'validate'    => 'color',
					),
					array(
						'id'     => 'section-text-end',
						'type'   => 'section',
						'indent' => false,
					),
					array(
						'id'     => 'section-link-start',
						'type'   => 'section',
						'title' => __('Links Color Setting (only for single post)', 'mobius'),
						'indent' => true,
					),
					array(
						'id'          => 'link-color',
						'type'        => 'color',
						'title'       => __('Links Color', 'mobius'), 
						'subtitle'    => __('Pick a color for the links color.', 'mobius'),
						'default'     => '#ff6863',
						'transparent' => false,
						'validate'    => 'color',
					),
					array(
						'id'     => 'section-link-end',
						'type'   => 'section',
						'indent' => false,
					),
					array(
						'id'     => 'section-body-start',
						'type'   => 'section',
						'title' => __('Main Color Settings', 'mobius'),
						'indent' => true,
					),
					array(
						'id'          => 'body-bgcolor',
						'type'        => 'color',
						'title'       => __('Main Background Color', 'mobius'), 
						'subtitle'    => __('Pick a color for the main background color.', 'mobius'),
						'default'     => '#ffffff',
						'transparent' => false,
						'validate'    => 'color',
					),
					array(
						'id'          => 'body-color',
						'type'        => 'button_set',
						'title'       => __('Main Color Scheme', 'mobius'), 
						'subtitle'    => __('Select the main text color scheme.', 'mobius'),
						'options' => array('light' => 'Light Text', 'dark' => 'Dark Text'),
                        'default' => 'dark'
					),
					array(
						'id'     => 'section-body-end',
						'type'   => 'section',
						'indent' => false,
					),
					
					array(
						'id'     => 'section-second-start',
						'type'   => 'section',
						'title' => __('Second Background Color Setting', 'mobius'),
						'indent' => true,
					),
					array(
						'id'          => 'second-bgcolor',
						'type'        => 'color',
						'title'       => __('Second Background Color', 'mobius'), 
						'subtitle'    => __('Pick a color for the second background color.', 'mobius'),
						'default'     => '#F5F6FA',
						'transparent' => false,
						'validate'    => 'color',
					),
					array(
						'id'     => 'section-second-end',
						'type'   => 'section',
						'indent' => false,
					),
					
					array(
						'id'     => 'section-header-start',
						'type'   => 'section',
						'title' => __('Header/Menu Colors', 'mobius'),
						'indent' => true,
					),
					array(
						'id'          => 'header-bgcolor',
						'type'        => 'color',
						'title'       => __('Header Background Color', 'mobius'), 
						'subtitle'    => __('Pick a color for the header background color.', 'mobius'),
						'default'     => '#ffffff',
						'transparent' => false,
						'validate'    => 'color',
					),
					array(
						'id'          => 'header-color',
						'type'        => 'color',
						'title'       => __('Header Text Color', 'mobius'), 
						'subtitle'    => __('Pick a color for the header text color.', 'mobius'),
						'default'     => '#646464',
						'transparent' => false,
						'validate'    => 'color',
					),
					
					array(
						'id'          => 'header-menu-bgcolor',
						'type'        => 'color',
						'title'       => __('Header Menu Background Color', 'mobius'), 
						'subtitle'    => __('Pick a color for the header Menu background color.', 'mobius'),
						'default'     => '#ffffff',
						'transparent' => false,
						'validate'    => 'color',
					),
					array(
						'id'          => 'header-menu-color',
						'type'        => 'color',
						'title'       => __('Header Menu Text Color', 'mobius'), 
						'subtitle'    => __('Pick a color for the header menu text color.', 'mobius'),
						'default'     => '#999999',
						'transparent' => false,
						'validate'    => 'color',
					),
					array(
						'id'          => 'header-menu-color-hover',
						'type'        => 'color',
						'title'       => __('Header Menu Text Color Hover', 'mobius'), 
						'subtitle'    => __('Pick a color for the header menu text color on mouse hover.', 'mobius'),
						'default'     => '#59585b',
						'transparent' => false,
						'validate'    => 'color',
					),
					array(
						'id'     => 'section-header-end',
						'type'   => 'section',
						'indent' => false,
					),
					array(
						'id'     => 'section-footer-start',
						'type'   => 'section',
						'title' => __('Footer Colors', 'mobius'),
						'indent' => true,
					),
					array(
						'id'          => 'footer-bgcolor',
						'type'        => 'color',
						'title'       => __('Footer Background Color', 'mobius'), 
						'subtitle'    => __('Pick a color for the footer background color.', 'mobius'),
						'default'     => '#565656',
						'transparent' => false,
						'validate'    => 'color',
					),
					array(
						'id'          => 'footer-color',
						'type'        => 'button_set',
						'title'       => __('Footer Text Color Scheme', 'mobius'), 
						'subtitle'    => __('Select the footer text color scheme.', 'mobius'),
						'options' => array('light' => 'Light Text', 'dark' => 'Dark Text'),
                        'default' => 'light'
					),
					array(
						'id'     => 'section-footer-end',
						'type'   => 'section',
						'indent' => false,
					),
					array(
						'id'     => 'section-footerBot-start',
						'type'   => 'section',
						'title' => __('Footer Bottom Copyright/Social Icons Colors', 'mobius'),
						'indent' => true,
					),
					array(
						'id'          => 'footer-bottom-bgcolor',
						'type'        => 'color',
						'title'       => __('Footer Bottom Background Color', 'mobius'), 
						'subtitle'    => __('Pick a color for the footer bottom background color.', 'mobius'),
						'default'     => '#3D3D3D',
						'transparent' => false,
						'validate'    => 'color',
					),
					array(
						'id'          => 'footer-bottom-color',
						'type'        => 'color',
						'title'       => __('Footer Bottom Background Color', 'mobius'), 
						'subtitle'    => __('Pick a color for the footer bottom background color.', 'mobius'),
						'default'     => '#EBEBEB',
						'transparent' => false,
						'validate'    => 'color',
					),
					array(
						'id'     => 'section-footerbot-end',
						'type'   => 'section',
						'indent' => false,
					),
					array(
						'id'     => 'section-sidebar-start',
						'type'   => 'section',
						'title' => __('Right Sliding Sidebar', 'mobius'),
						'indent' => true,
					),
					array(
						'id'          => 'sidebar-bgcolor',
						'type'        => 'color',
						'title'       => __('Sidebar Background Color', 'mobius'), 
						'subtitle'    => __('Pick a color for the footer bottom background color.', 'mobius'),
						'default'     => '#ffffff',
						'transparent' => false,
						'validate'    => 'color',
					),
					array(
						'id'          => 'sidebar-color',
						'type'        => 'button_set',
						'title'       => __('Sidebar Text Color Scheme', 'mobius'), 
						'subtitle'    => __('Select the sidebar text color scheme.', 'mobius'),
						'options' => array('light' => 'Light Text', 'dark' => 'Dark Text'),
                        'default' => 'dark'
					),
					array(
						'id'     => 'section-sidebar-end',
						'type'   => 'section',
						'indent' => false,
					),
					array(
						'id'     => 'section-menu-start',
						'type'   => 'section',
						'title' => __('Left Sliding Sidebar (Left Menu)', 'mobius'),
						'indent' => true,
					),
					array(
						'id'          => 'menu-bgcolor-over',
						'type'        => 'color',
						'title'       => __('Left Sidebar Background overlay', 'mobius'), 
						'subtitle'    => __('Pick a color for the left sidebar background overlay. If you use a background image you should add opacity.', 'mobius'),
						'default'     => '',
						'transparent' => false,
						'validate'    => 'color',
					),
					array(
                        'id'          => 'menu-bgcolor-over-opacity',
                        'type'        => 'slider',
                        'title'       => __('Left Sidebar Background overlay opacity', 'mobius'),
                        'subtitle'    => __('Set an opacity to the background overlay.', 'mobius'),
                        "default"     => 0,
						"min"         => 0,
						"step"        => .01,
						"max"         => 1,
						'resolution'  => 0.01,
						"display_value" => 'text'
                    ),
					array(
						'id'          => 'menu-bgcolor',
						'type'        => 'color',
						'title'       => __('Left Sidebar Background Color', 'mobius'), 
						'subtitle'    => __('Pick a color for the left sidebar background color.', 'mobius'),
						'default'     => '#ffffff',
						'transparent' => false,
						'validate'    => 'color',
					),
					array(
						'id'          => 'nav-menu-bgcolor',
						'type'        => 'color',
						'title'       => __('Left Menu Background Color (under menu)', 'mobius'), 
						'subtitle'    => __('Pick a color for the left menu background color.', 'mobius'),
						'default'     => '#F5F6FA',
						'transparent' => false,
						'validate'    => 'color',
					),
					array(
						'id'          => 'menu-color',
						'type'        => 'button_set',
						'title'       => __('Left Sidebar Text Color Scheme', 'mobius'), 
						'subtitle'    => __('Select the left menu color scheme.', 'mobius'),
						'options' => array('light' => 'Light Text', 'dark' => 'Dark Text'),
                        'default' => 'dark'
					),
					array(
						'id'     => 'section-menu-end',
						'type'   => 'section',
						'indent' => false,
					),
				)
            );

 			$this->sections[] = array(
                'icon' => 'dashicons dashicons-align-center',
                'title' => __('Header', 'mobius'),
				'heading' => __('Header Options', 'mobius'),
                'fields' => array(
					array(
						'id'     => 'section-logo-start',
						'type'   => 'section',
						'title' => __('Top Nav Logo', 'mobius'),
						'indent' => true,
					),
                    array(
                        'id' => 'header-logo',
                        'type' => 'media',
                        'title' => __('Header Logo', 'mobius'),
                        'compiler' => 'true',
                        'desc' => __('Upload your header logo.', 'mobius'),
                        'subtitle' => __('This logo is used in the top header navigation.<br> If in themeone slider or in page header settings, transparent header option is activated, this logo will be used as the dark logo.', 'mobius'),
						'default'  => array('url'=>get_template_directory_uri() . '/images/logo-dark.png'),
                    ),
					array(
                        'id' => 'header-logo-light',
                        'type' => 'media',
                        'title' => __('Header Logo Light', 'mobius'),
                        'compiler' => 'true',
                        'desc' => __('Upload your light header logo.', 'mobius'),
                        'subtitle' => __('This alternative logo will be used only if in themeone slider or in page header settings, transparent header option is activated.', 'mobius'),
                        'default'  => array('url'=>get_template_directory_uri() . '/images/logo-light.png'),
                    ),
					array(
                        'id' => 'header-logo-height',
                        'type' => 'slider',
                        'title' => __('Header Logo height', 'mobius'),
                        'subtitle' => __('Set the logo height of the top header in percent (%).', 'mobius'),
                        "default"   => 35,
						"min"       => 0,
						"step"      => 1,
						"max"       => 100,
						"display_value" => 'text'
                    ),
					array(
						'id'     => 'section-logo-end',
						'type'   => 'section',
						'indent' => false,
					),
					array(
						'id'     => 'section-nav-logo-start',
						'type'   => 'section',
						'title' => __('Left Nav Logo', 'mobius'),
						'indent' => true,
					),
					array(
                        'id' => 'left-nav-logo',
                        'type' => 'media',
                        'title' => __('Left Nav Logo', 'mobius'),
                        'compiler' => 'true',
                        'desc' => __('Upload your logo.', 'mobius'),
                        'subtitle' => __('This logo is used in the left menu sidebar.', 'mobius'),
						'default'  => array('url'=>get_template_directory_uri() . '/images/logo-dark.png'),
                    ),
					array(
                        'id' => 'left-nav-image',
                        'type' => 'media',
                        'title' => __('Left Nav Background Image', 'mobius'),
                        'compiler' => 'true',
                        'desc' => __('Upload your image.', 'mobius'),
                        'subtitle' => __('This image will be used as the background of the left menu.', 'mobius'),
						'default'  => '',
                    ),
					array(
						'id'     => 'section-nav-logo-end',
						'type'   => 'section',
						'indent' => false,
					),
					array(
						'id'     => 'section-header-styles-start',
						'type'   => 'section',
						'title' => __('Header Styles', 'mobius'),
						'indent' => true,
					),
					array(
                        'id' => 'header-style',
                        'type' => 'select',
                        'title' => __('Header/Menu styles', 'mobius'),
                        'subtitle' => __('You can choose between an header with a top navigation menu or a header with a button menu to access to a vertical menu on left or a fixed left menu.', 'mobius'),
                        'desc' => __('Please select your header style.', 'mobius'),
                        'options' => array(
										'header-menu' => __('Standard Top header menu', 'mobius'),
										'header-mobile' => __('Top header centered logo with sliding menu', 'mobius'),
										'header-left' => __('Fixed left menu', 'mobius')
                        			),
                        'default' => 'header-menu'
                    ),
					array(
						'id'     => 'section-header-styles-end',
						'type'   => 'section',
						'indent' => false,
					),
					array(
						'id'     => 'section-header-features-start',
						'type'   => 'section',
						'title' => __('Header Features', 'mobius'),
						'indent' => true,
					),
					array(
                        'id' => 'header-fixed',
                        'type' => 'switch',
                        'title' => __('Header Fixed Position', 'mobius'),
                        'subtitle' => __('Check this option if you want to have a sticky header which remains visible at the top of the browser on scroll.', 'mobius'),
                        'default' => '1'
                    ),
					array(
                        'id' => 'header-resize',
                        'type' => 'switch',
                        'title' => __('Header Resize On Scroll', 'mobius'),
                        'subtitle' => __('Check this option if you want to enable header height to be resized on scroll.', 'mobius'),
                        'default' => '1'
                    ),
					array(
                        'id' => 'header-link',
                        'type' => 'switch',
                        'title' => __('Header Top Menu Link', 'mobius'),
                        'subtitle' => __('Check this option if you want to enable menu links in top menu (first level) header.', 'mobius'),
                        'default' => '0'
                    ),
					array(
						'id'     => 'section-header-features-end',
						'type'   => 'section',
						'indent' => false,
					),
					array(
						'id'     => 'section-section-start',
						'type'   => 'section',
						'title' => __('Header Appearance', 'mobius'),
						'indent' => true,
					),
					array(
                        'id' => 'header-height',
                        'type' => 'slider',
                        'title' => __('Header Height', 'mobius'),
                        'subtitle' => __('Set the header height.', 'mobius'),
                        "default"   => 70,
						"min"       => 50,
						"step"      => 1,
						"max"       => 200,
						"display_value" => 'text'
                    ),
					array(
                        'id' => 'header-max-height',
                        'type' => 'slider',
                        'title' => __('Header Max height', 'mobius'),
                        'subtitle' => __('Set the header min height.<br>(only needed if header resize on scroll option is enable)', 'mobius'),
						'required' => array('header-resize', 'equals', array('1')),
                        "default"   => 100,
						"min"       => 55,
						"step"      => 1,
						"max"       => 250,
						"display_value" => 'text'
                    ),
					array(
                        'id' => 'header-opacity',
                        'type' => 'slider',
                        'title' => __('Header Opacity', 'mobius'),
                        'subtitle' => __('Set the header opacity.', 'mobius'),
                        "default" => .90,
						"min" => 0,
						"step" => .01,
						"max" => 1,
						'resolution' => 0.01,
						'display_value' =>  'text'
                    ),
					array(
                        'id' => 'header-slider-opacity',
                        'type' => 'slider',
                        'title' => __('Header Opacity Over Slider', 'mobius'),
                        'subtitle' => __('Set the header opacity when the header is over the themeone slider and if in themeone slider options, slider transparent header option is activated.', 'mobius'),
                        "default" => .1,
						"min" => 0,
						"step" => .01,
						"max" => 1,
						'resolution' => 0.01,
						'display_value' =>  'text'
                    ),
					array(
						'id'     => 'section-section-section-end',
						'type'   => 'section',
						'indent' => false,
					),
				)
            );
			
			$this->sections[] = array(
                'icon' => 'dashicons dashicons-align-center',
                'title' => __('Footer', 'mobius'),
				'heading' => __('Footer Options', 'mobius'),
                'fields' => array(
					array(
						'id'     => 'section-footer-background-start',
						'type'   => 'section',
						'title' => __('Footer Background', 'mobius'),
						'indent' => true,
					),
					array(
                        'id' => 'footer-background',
                        'type' => 'switch',
                        'title' => __('Footer Background', 'mobius'),
                        'subtitle' => __('Check this option if you want a background in the footer', 'mobius'),
                        'default' => '0'
                    ),
					array(
                        'id' => 'footer-img',
                        'type' => 'media',
                        'title' => __('Footer Background Image', 'mobius'),
                        'compiler' => 'true',
                        'desc' => __('Upload your footer background image.', 'mobius'),
                        'subtitle' => __('This image will be display under the top & bottom footer. An opacity under 1 must be set in order to see this backround image.', 'mobius'),
						'required' => array('footer-background', 'equals', array('1')),
						'default'  => '',
                    ),
					array(
						'id'          => 'footerBg-top-txt',
						'type'        => 'button_set',
						'title'       => __('Footer Top Text Color Scheme', 'mobius'), 
						'subtitle'    => __('Select the footer text color scheme.', 'mobius'),
						'required' => array('footer-background', 'equals', array('1')),
						'options' => array('light' => 'Light Text', 'dark' => 'Dark Text'),
                        'default' => 'light'
					),
					array(
						'id'          => 'footerBg-bot-txt',
						'type'        => 'color',
						'title'       => __('Footer Bottom Text Color', 'mobius'), 
						'subtitle'    => __('Please select a color.', 'mobius'),
						'required' => array('footer-background', 'equals', array('1')),
						'default'     => '#EBEBEB',
						'transparent' => false,
						'validate'    => 'color',
					),
					array(
						'id'          => 'footerBg-top-color',
						'type'        => 'color',
						'title'       => __('Footer Top Background Color', 'mobius'), 
						'subtitle'    => __('Please select a color.', 'mobius'),
						'required' => array('footer-background', 'equals', array('1')),
						'default'     => '#000000',
						'transparent' => false,
						'validate'    => 'color',
					),
					array(
						'id'          => 'footerBg-bot-color',
						'type'        => 'color',
						'title'       => __('Footer Bottom Background Color', 'mobius'), 
						'subtitle'    => __('Please select a color.', 'mobius'),
						'required' => array('footer-background', 'equals', array('1')),
						'default'     => '#000000',
						'transparent' => false,
						'validate'    => 'color',
					),
					array(
                        'id' => 'footerBg-top-opacity',
                        'type' => 'slider',
                        'title' => __('Footer Top Background Opacity', 'mobius'),
                        'subtitle' => __('Set the top footer opacity.', 'mobius'),
						'required' => array('footer-background', 'equals', array('1')),
                        "default" => .66,
						"min" => 0,
						"step" => .01,
						"max" => 1,
						'resolution' => 0.01,
						'display_value' =>  'text'
                    ),
					array(
                        'id' => 'footerBg-bot-opacity',
                        'type' => 'slider',
                        'title' => __('Footer Bottom Background Opacity', 'mobius'),
                        'subtitle' => __('Set the bottom footer opacity.', 'mobius'),
						'required' => array('footer-background', 'equals', array('1')),
                        "default" => .76,
						"min" => 0,
						"step" => .01,
						"max" => 1,
						'resolution' => 0.01,
						'display_value' =>  'text'
                    ),
					array(
						'id'     => 'section-footer-background-end',
						'type'   => 'section',
						'indent' => false,
					),
					array(
						'id'     => 'section-footer-widget-start',
						'type'   => 'section',
						'title' => __('Top Footer Section', 'mobius'),
						'indent' => true,
					),
					array(
                        'id' => 'footer-widget',

                        'type' => 'switch',
                        'title' => __('Footer Widget Area', 'mobius'),
                        'subtitle' => __('Check this option if you want the footer widget area.', 'mobius'),
                        'default' => '1'
                    ),
					array(
                        'id' => 'footer-columns',
                        'type' => 'image_select',
                        'title' => __('Footer Columns', 'mobius'),
                        'subtitle' => __('Choose the number of desired column in the footer widget area.', 'mobius'),
						'required' => array('footer-widget', 'equals', array('1')),
                        'options' => array(
                            '2' => array('alt' => '2 Columns', 'img' => get_template_directory_uri() . '/includes/options/img/2col.png'),
                            '3' => array('alt' => '3 Columns', 'img' => get_template_directory_uri() . '/includes/options/img/3col.png'),
                            '4' => array('alt' => '4 Columns', 'img' => get_template_directory_uri() . '/includes/options/img/4col.png')
                        ),
                        'default' => '3'
                    ),
					array(
						'id'     => 'section-footer-widget-end',
						'type'   => 'section',
						'indent' => false,
					),
					array(
						'id'     => 'section-footer-bootom-start',
						'type'   => 'section',
						'title' => __('Bottom Footer Section', 'mobius'),
						'indent' => true,
					),
					array(
                        'id' => 'footer-bottom',
                        'type' => 'switch',
                        'title' => __('Footer Bottom Area', 'mobius'),
                        'subtitle' => __('Check this option if you want the footer bottom area.', 'mobius'),
                        'default' => '1'
                    ),
					array(
                        'id' => 'footer-copyright',
                        'type' => 'text',
                        'title' => __('Footer Copyright Text', 'mobius'),
                        'subtitle' => __('Please enter the copyright text.', 'mobius'),
						'required' => array('footer-bottom', 'equals', array('1')),
                        'default' => '&#169; Copyright 2014. All Rights Reserved, Mobius Inc.'
                    ),
					array(
                        'id' => 'footer-social',
                        'type' => 'switch',
                        'title' => __('Footer Social Icon', 'mobius'),
                        'subtitle' => __('Check this option if you to add social icons inside the footer.', 'mobius'),
						'required' => array('footer-bottom', 'equals', array('1')),
                        'default' => '0'
                    ),
					array(
						'id'      => 'footer-social-icon',
						'type'    => 'sorter',
						'title'   => 'Footer Social icon list',
						'subtitle' => __('Choose and organize how you want to appear the social icons inside the footer.<br><strong>Social icon url need to be set in Social Icon Links Themeone option panel.</strong>', 'mobius'),
						'required' => array(array('footer-social', 'equals', array('1')),array('footer-bottom', 'equals', array('1'))),
						'options' => array(
							'Available icons'  => array(
								'placebo' => 'placebo',
								'email' => 'Email',
								'facebook' => 'Facebook',
								'twitter' => 'Twitter',
								'google-plus' => 'Google+',
								'linkedin' => 'Linkedin',
								'tumblr' => 'Tumblr',
								'dribbble' => 'Dribbble',
								'pinterest' => 'Pinterest',
								'instagram' => 'Instagram',
								'youtube' => 'Youtube',
								'vimeo-square' => 'Vimeo',
								'flickr' => 'Flickr',
								'github' => 'Github',
								'stack-overflow' => 'Stackoverflow',
								'stack-exchange' => 'Stack-exchange'
							),
							'Footer icons' => array(
								'placebo'    => 'placebo',
							)
						),
					),
					array(
						'id'     => 'section-footer-bootom-end',
						'type'   => 'section',
						'indent' => false,
					),
				)
            );
			
			$this->sections[] = array(
                'icon' => 'dashicons dashicons-share',
                'title' => __('Social Icons', 'mobius'),
				'heading' => __('Social Icons Settings', 'mobius'),
                'fields' => array(
					array(
						'id'    => 'info_social',
						'type'  => 'info',
						'title' => __('Enter in your social media URL here and then select which ones you would like to display in your footer options. <br><strong>PLEASE INCLUDE "http://" or "https://" IN URL</strong>', 'mobius'),
						'icon'  => 'el-icon-info-sign',
					),
					array(
						'id'     => 'section-social-icon-start',
						'type'   => 'section',
						'indent' => true,
					),
					array(
                        'id' => 'url-email',
                        'type' => 'text',
                        'title' => __('Email', 'mobius'),
                        'subtitle' => __('Please enter your email.', 'mobius'),
                        'default' => ''
                    ),
					array(
                        'id' => 'url-facebook',
                        'type' => 'text',
                        'title' => __('Facebook URL', 'mobius'),
                        'subtitle' => __('Please enter your Facebook URL.', 'mobius'),
                        'default' => ''
                    ),
					array(
                        'id' => 'url-twitter',
                        'type' => 'text',
                        'title' => __('Twitter URL', 'mobius'),
                        'subtitle' => __('Please enter your Twitter URL.', 'mobius'),
                        'default' => ''
                    ),
					array(
                        'id' => 'url-google-plus',
                        'type' => 'text',
                        'title' => __('Google+ URL', 'mobius'),
                        'subtitle' => __('Please enter your Google+ URL.', 'mobius'),
                        'default' => ''
                    ),
					array(
                        'id' => 'url-linkedin',
                        'type' => 'text',
                        'title' => __('Linkedin URL', 'mobius'),
                        'subtitle' => __('Please enter your Linkedin URL.', 'mobius'),
                        'default' => ''
                    ),
					array(
                        'id' => 'url-tumblr',
                        'type' => 'text',
                        'title' => __('Tumblr URL', 'mobius'),
                        'subtitle' => __('Please enter your Tumblr URL.', 'mobius'),
                        'default' => ''
                    ),
					array(
                        'id' => 'url-dribbble',
                        'type' => 'text',
                        'title' => __('Dribbble URL', 'mobius'),
                        'subtitle' => __('Please enter your Dribbble URL.', 'mobius'),
                        'default' => ''
                    ),
					array(
                        'id' => 'url-pinterest',
                        'type' => 'text',
                        'title' => __('Pinterest URL', 'mobius'),
                        'subtitle' => __('Please enter your Pinterest URL.', 'mobius'),
                        'default' => ''
                    ),
					array(
                        'id' => 'url-instagram',
                        'type' => 'text',
                        'title' => __('Instagram URL', 'mobius'),
                        'subtitle' => __('Please enter your Instagram URL.', 'mobius'),
                        'default' => ''
                    ),
					array(
                        'id' => 'url-youtube',
                        'type' => 'text',
                        'title' => __('Youtube URL', 'mobius'),
                        'subtitle' => __('Please enter your Youtube URL.', 'mobius'),
                        'default' => ''
                    ),
					array(
                        'id' => 'url-vimeo-square',
                        'type' => 'text',
                        'title' => __('Vimeo URL', 'mobius'),
                        'subtitle' => __('Please enter your Vimeo URL.', 'mobius'),
                        'default' => ''
                    ),
					array(
                        'id' => 'url-flickr',
                        'type' => 'text',
                        'title' => __('Flickr URL', 'mobius'),
                        'subtitle' => __('Please enter your Flickr URL.', 'mobius'),
                        'default' => ''
                    ),
					array(
                        'id' => 'url-github',
                        'type' => 'text',
                        'title' => __('Github URL', 'mobius'),
                        'subtitle' => __('Please enter your Github URL.', 'mobius'),
                        'default' => ''
                    ),
					array(
                        'id' => 'url-stack-overflow',
                        'type' => 'text',
                        'title' => __('StackOverflow URL', 'mobius'),
                        'subtitle' => __('Please enter your StackOverflow URL.', 'mobius'),
                        'default' => ''
                    ),
					array(
                        'id' => 'url-stack-exchange',
                        'type' => 'text',
                        'title' => __('StackExchange URL', 'mobius'),
                        'subtitle' => __('Please enter your StackExchange URL.', 'mobius'),
                        'default' => ''
                    )
				)
            );

            $this->sections[] = array(
                'icon' => 'dashicons dashicons-location',
                'title' => __('Google Map', 'mobius'),
				'heading' => __('Map Settings', 'mobius'),
                'fields' => array(
					array(
						'id' => 'map-settings',
						'type' => 'section',
						'title' => __('Google map Settings', 'mobius'),
						'indent' => true
					),
					array(
						'id' => 'map-height',
						'type' => 'text',
						'title' => __('Map Height', 'mobius'), 
						'validate' => 'numeric',
						'subtitle' => __('Set the height of the map.', 'mobius'),
						'desc' => __('Please do not add \'px\'. (e.g : 400)', 'mobius'),
						'default' => '370'
					),
					array(
                        'id' => 'map-type',
                        'type' => 'select',
                        'title' => __('Map Type', 'mobius'),
                        'subtitle' => __('Select the type of the google map.', 'mobius'),
                        'options' => array('ROADMAP' => 'Roadmap', 'SATELLITE' => 'Satellite', 'HYBRID' => 'Hybrid', 'TERRAIN' => 'Terrain'),
                        'default' => 'ROADMAP'
                    ),
					array(
                        'id' => 'map-color',
                        'type' => 'select',
                        'title' => __('Map Color', 'mobius'),
                        'subtitle' => __('Select the color scheme of the google map.', 'mobius'),
						'required' => array(array('map-type', 'equals', array('ROADMAP')),array('footer-bottom', 'equals', array('1'))),
                        'options' => array('standard' => 'standard', 'simple' => 'Simple', 'flat' => 'Flat', 'dark' => 'Dark', 'grey' => 'Grey', 'pale-dawn' => 'Pale dawn', 'monochrome' => 'monochrome'),
                        'default' => 'standard'
                    ),
					array(
                        'id' => 'map-draggable',
                        'type' => 'switch',
                        'title' => __('Map Draggable', 'mobius'),
                        'subtitle' => __('Enable this option if you want to drag the map with mouse or touch.', 'mobius'),
                        'options' => array('ROADMAP' => 'Roadmap', 'SATELLITE' => 'Satellite', 'HYBRID' => 'Hybrid', 'TERRAIN' => 'Terrain'),
                        'default' => '1'
                    ),
					array(
						'id' => 'zoom-level',
						'type' => 'slider',
						'title' => __('Map Zoom Level', 'mobius'),
						'subtitle' => __('Choose your zoom level. 1 show the entire earth and 18 being right at street level.', 'mobius'),
						'validate' => 'numeric',
						"default" => 14,
						"min" => 0,
						"step" => 1,
						"max" => 18,
						'resolution' => 1,
						'display_value' =>  'text'
					),
					array(
                        'id' => 'enable-zoom',
                        'type' => 'switch',
                        'title' => __('Map Zoom In/Out', 'mobius'),
                        'subtitle' => __('Check this option if you want to add the zoom level control on the google map.', 'mobius'),
                        'default' => '1'
                    ),
					array(
                        'id' => 'enable-animation',
                        'type' => 'switch',
                        'title' => __('Marker Location animation', 'mobius'),
                        'subtitle' => __('Check this option if you want to add an animation on load.', 'mobius'),
                        'default' => '1'
                    ),
					array(
                        'id' => 'enable-hover',
                        'type' => 'switch',
                        'title' => __('Marker Location animation on mouse hover', 'mobius'),
                        'subtitle' => __('Check this option if you want to add an animation on mouse hover marker location.', 'mobius'),
                        'default' => '0'
                    ),
					array(
						'id' => 'map-settings-end',
						'type' => 'section',
						'indent' => false
					),
					array(
						'id' => 'map-points',
						'type' => 'section',
						'indent' => true
					),

					array(
						'id' => 'map-point-1',
						'type' => 'section',
						'title' => __('<i style="line-height:30px" class="dashicons dashicons-admin-post"></i> Location n&#176;1', 'mobius'),
						'indent' => true
					),
					array(
                        'id' => 'marker-1',
                        'type' => 'media',
                        'title' => __('Marker Image', 'mobius'),
						'default' => array('url'=>get_template_directory_uri() . '/images/mobius-marker-2.png')
                    ),
					array(
						'id' => 'latitude-1',
						'type' => 'text',
						'title' => __('Latitude', 'mobius'), 
						'validate' => 'numeric',
						'default' => '45.169342'
					),
					array(
						'id' => 'longitude-1',
						'type' => 'text',
						'title' => __('Longitude', 'mobius'), 
						'validate' => 'numeric',
						'default' => '5.732365'
					),
					array(
						'id' => 'map-info-1',
						'type' => 'text',
						'title' => __('Map Info Text', 'mobius'), 
						'default' => 'Headquarter Office<br>Mobius Inc'
					),
					
					array(
						'id' => 'map-point-2',
						'type' => 'section',
						'title' => __('<i style="line-height:30px" class="dashicons dashicons-admin-post"></i> Location n&#176;2', 'mobius'),
						'indent' => true
					),
					array(
                        'id' => 'marker-2',
                        'type' => 'media',
                        'title' => __('Marker Image', 'mobius'),
						'default' => array('url'=>get_template_directory_uri() . '/images/mobius-marker-1.png')
                    ),
					array(
						'id' => 'latitude-2',
						'type' => 'text',
						'title' => __('Latitude', 'mobius'), 
						'validate' => 'numeric',
						'default' => '45.1808330'
					),
					array(
						'id' => 'longitude-2',
						'type' => 'text',
						'title' => __('Longitude', 'mobius'), 
						'validate' => 'numeric',
						'default' => '5.7502983'
					),
					array(
						'id' => 'map-info-2',
						'type' => 'text',
						'title' => __('Map Info Text', 'mobius'), 
						'default' => 'Office<br>Mobius Inc'
					),
					
					array(
						'id' => 'map-point-3',
						'type' => 'section',
						'title' => __('<i style="line-height:30px" class="dashicons dashicons-admin-post"></i> Location n&#176;3', 'mobius'),
						'indent' => true
					),
					array(
                        'id' => 'marker-3',
                        'type' => 'media',
                        'title' => __('Marker Image', 'mobius'),
						'default' => array('url'=>get_template_directory_uri() . '/images/mobius-marker-1.png')
                    ),
					array(
						'id' => 'latitude-3',
						'type' => 'text',
						'title' => __('Latitude', 'mobius'), 
						'validate' => 'numeric',
						'default' => '45.1735991'
					),
					array(
						'id' => 'longitude-3',
						'type' => 'text',
						'title' => __('Longitude', 'mobius'), 
						'validate' => 'numeric',
						'default' => '5.7523286'
					),
					array(
						'id' => 'map-info-3',
						'type' => 'text',
						'title' => __('Map Info Text', 'mobius'), 
						'default' => 'Office<br>Mobius Inc'
					),
					
					array(
						'id' => 'map-point-4',
						'type' => 'section',
						'title' => __('<i style="line-height:30px" class="dashicons dashicons-admin-post"></i> Location n&#176;4', 'mobius'),
						'indent' => true
					),
					array(
                        'id' => 'marker-4',
                        'type' => 'media',
                        'title' => __('Marker Image', 'mobius'),
                    ),
					array(
						'id' => 'latitude-4',
						'type' => 'text',
						'title' => __('Latitude', 'mobius'), 
						'validate' => 'numeric'
					),
					array(
						'id' => 'longitude-4',
						'type' => 'text',
						'title' => __('Longitude', 'mobius'), 
						'validate' => 'numeric'
					),
					array(
						'id' => 'map-info-4',
						'type' => 'text',
						'title' => __('Map Info Text', 'mobius'), 
					),
					
					array(
						'id' => 'map-point-5',
						'type' => 'section',
						'title' => __('<i style="line-height:30px" class="dashicons dashicons-admin-post"></i> Location n&#176;5', 'mobius'),
						'indent' => true
					),
					array(
                        'id' => 'marker-5',
                        'type' => 'media',
                        'title' => __('Marker Image', 'mobius'),
                    ),
					array(
						'id' => 'latitude-5',
						'type' => 'text',
						'title' => __('Latitude', 'mobius'), 
						'validate' => 'numeric'
					),
					array(
						'id' => 'longitude-5',
						'type' => 'text',
						'title' => __('Longitude', 'mobius'), 
						'validate' => 'numeric'
					),
					array(
						'id' => 'map-info-5',
						'type' => 'text',
						'title' => __('Map Info Text', 'mobius'), 
					),
					
					array(
						'id' => 'map-point-6',
						'type' => 'section',
						'title' => __('<i style="line-height:30px" class="dashicons dashicons-admin-post"></i> Location n&#176;6', 'mobius'),
						'indent' => true
					),
					array(
                        'id' => 'marker-6',
                        'type' => 'media',
                        'title' => __('Marker Image', 'mobius'),
                    ),
					array(
						'id' => 'latitude-6',
						'type' => 'text',
						'title' => __('Latitude', 'mobius'), 
						'validate' => 'numeric'
					),
					array(
						'id' => 'longitude-6',
						'type' => 'text',
						'title' => __('Longitude', 'mobius'), 
						'validate' => 'numeric'
					),
					array(
						'id' => 'map-info-6',
						'type' => 'text',
						'title' => __('Map Info Text', 'mobius'), 
					),
					
					array(
						'id' => 'map-point-7',
						'type' => 'section',
						'title' => __('<i style="line-height:30px" class="dashicons dashicons-admin-post"></i> Location n&#176;7', 'mobius'),
						'indent' => true
					),
					array(
                        'id' => 'marker-7',
                        'type' => 'media',
                        'title' => __('Marker Image', 'mobius'),
                    ),
					array(
						'id' => 'latitude-7',
						'type' => 'text',
						'title' => __('Latitude', 'mobius'), 
						'validate' => 'numeric'
					),
					array(
						'id' => 'longitude-7',
						'type' => 'text',
						'title' => __('Longitude', 'mobius'), 
						'validate' => 'numeric'
					),
					array(
						'id' => 'map-info-7',
						'type' => 'text',
						'title' => __('Map Info Text', 'mobius'), 
					),
					
					array(
						'id' => 'map-point-8',
						'type' => 'section',
						'title' => __('<i style="line-height:30px" class="dashicons dashicons-admin-post"></i> Location n&#176;8', 'mobius'),
						'indent' => true
					),
					array(
                        'id' => 'marker-8',
                        'type' => 'media',
                        'title' => __('Marker Image', 'mobius'),
                    ),
					array(
						'id' => 'latitude-8',
						'type' => 'text',
						'title' => __('Latitude', 'mobius'), 
						'validate' => 'numeric'
					),
					array(
						'id' => 'longitude-8',
						'type' => 'text',
						'title' => __('Longitude', 'mobius'), 
						'validate' => 'numeric'
					),
					array(
						'id' => 'map-info-8',
						'type' => 'text',
						'title' => __('Map Info Text', 'mobius'), 
					),
					
					
					array(
						'id' => 'map-point-9',
						'type' => 'section',
						'title' => __('<i style="line-height:30px" class="dashicons dashicons-admin-post"></i> Location n&#176;9', 'mobius'),
						'indent' => true
					),
					array(
                        'id' => 'marker-9',
                        'type' => 'media',
                        'title' => __('Marker Image', 'mobius'),
                    ),
					array(
						'id' => 'latitude-9',
						'type' => 'text',
						'title' => __('Latitude', 'mobius'), 
						'validate' => 'numeric'
					),
					array(
						'id' => 'longitude-9',
						'type' => 'text',
						'title' => __('Longitude', 'mobius'), 
						'validate' => 'numeric'
					),
					array(
						'id' => 'map-info-9',
						'type' => 'text',
						'title' => __('Map Info Text', 'mobius'), 
					),
					
					
					array(
						'id' => 'map-point-10',
						'type' => 'section',
						'title' => __('<i style="line-height:30px" class="dashicons dashicons-admin-post"></i> Location n&#176;10', 'mobius'),
						'indent' => true
					),
					array(
                        'id' => 'marker-10',
                        'type' => 'media',
                        'title' => __('Marker Image', 'mobius'),
                    ),
					array(
						'id' => 'latitude-10',
						'type' => 'text',
						'title' => __('Latitude', 'mobius'), 
						'validate' => 'numeric'
					),
					array(
						'id' => 'longitude-10',
						'type' => 'text',
						'title' => __('Longitude', 'mobius'), 
						'validate' => 'numeric'
					),
					array(
						'id' => 'map-info-10',
						'type' => 'text',
						'title' => __('Map Info Text', 'mobius'), 
					),
					
					array(
						'id'     => 'map-points-end',
						'type'   => 'section',
						'indent' => false,
					),
					
					array(
						'id' => 'section-add',
						'type' => 'section',
						'indent' => true
					),
					array(
						'id' => 'add-remove-locations',
						'type' => 'add_remove',
						'title' => __('Add or remove locations', 'mobius'), 
						'desc' => ''
					),
					
					array(
						'id'     => 'section-add-end',
						'type'   => 'section',
						'indent' => false,
					),
                )
            );
			
			$this->sections[] = array(
                'icon' => 'dashicons dashicons-megaphone',
                'title' => __('Call To Action', 'mobius'),
				'heading' => __('Call To Action Settings', 'mobius'),
                'fields' => array(
					array(
						'id'     => 'scallTo-location-start',
						'type'   => 'section',
						'title' => __('Call To Action Location', 'mobius'),
						'indent' => true,
					),
					array(
                        'id' => 'callTo-pages',
                        'type' => 'select',
                        'data' => 'pages',
						'multi' => true,
                        'title' => __('Call to Action Section Pages', 'mobius'),
                        'subtitle' => __('Select any pages you wish to see the Call to Action section from. You can select multiple pages.', 'mobius'),
						'default' => ''
                    ),
					array(
						'id'     => 'callTo-location-end',
						'type'   => 'section',
						'indent' => false,
					),
					array(
						'id'     => 'callTo-text-section-start',
						'type'   => 'section',
						'title' => __('Call To Action Content Settings', 'mobius'),
						'indent' => true,
					),
					array(
						'id' => 'callTo-text',
						'type' => 'textarea',
						'title' => __('Call to Action Text', 'mobius'), 
						'subtitle' => __('Please enter your call to action text.', 'mobius'),
						'default' => 'Ready to take it to the next level?'
					),
					array(
						'id' => 'callTo-button-url',
						'type' => 'text',
						'title' => __('Call to Action Button URL', 'mobius'), 
						'subtitle' => __('Please enter the URL for the call to action.', 'mobius'),
						'default' => home_url()
					),
					array(
						'id'     => 'callTo-text-section-end',
						'type'   => 'section',
						'indent' => false,
					),
					array(
						'id'     => 'callTo-color-start',
						'type'   => 'section',
						'title' => __('Call To Action Color Settings', 'mobius'),
						'indent' => true,
					),
					array(
						'id'       => 'callTo-bg',
						'type'     => 'color',
						'title'    => __('Call to Action Background Color', 'mobius'), 
						'subtitle' => __('You can set a custom background color for the call to action section.', 'mobius'),
						'default'  => '#f3f5f8',
						'transparent' => false,
						'validate' => 'color',
					),
					array(
						'id'       => 'callTo-color',
						'type'     => 'color',
						'title'    => __('Call to Action Text Color', 'mobius'), 
						'subtitle' => __('You can set a custom text color for the call to action section.', 'mobius'),
						'default'  => '#59585b',
						'transparent' => false,
						'validate' => 'color',
					),
					array(
						'id'     => 'callTo-color-end',
						'type'   => 'section',
						'indent' => false,
					),
				)
            );
			
			$fields = get_option('mobius');
			if (is_array($fields) && array_key_exists ('unlimited_sidebar', $fields)) {
				$options = $fields['unlimited_sidebar'];
				$sidebars =  array();
				if ($options != null) {
					foreach($options as $sidebar) {
						$sidebars[$sidebar] = $sidebar;
					}
				} else {
					$sidebars = null;
				}
			} else {
				$sidebars = null;
			}
			
			$this->sections[] = array(
                'icon' => 'dashicons dashicons-align-left',
                'title' => __('Unlimited SideBar', 'mobius'),
				'heading' => __('Unlimited SideBar Settings', 'mobius'),
                'fields' => array(
					
					array(
						'id'     => 'sidebars-start',
						'type'   => 'section',
						'title' => __('Sidebar Generator', 'mobius'),
						'indent' => true,
					),
					array(
						'id'    => 'info_sidebars',
						'type'  => 'info',
						'title' => __('In this option panel, you can create and add unlimited number of sidebar.', 'mobius').'<br>'.__('Give a name to your sidebar, add it, then save changes.', 'mobius').'<br>'.__('Your new created sidebar will appear on the widget page', 'mobius').' (<a href="'. admin_url( "widgets.php", "http" ) .'">'.__('widget pages', 'mobius').'</a>) '. __('Manage it by adding widget as usual.<br>To set the sidebar, you will see on post, portfolio and page a custom meta box named Sidebar. Select the name of the desired sidebar that you want to display on the current post/page.', 'mobius'),
						'icon'  => 'el-icon-info-sign',
					),
					array(
						'id'     => 'sidebars-end',
						'type'   => 'section',
						'title' => __('Sidebar Generator', 'mobius'),
						'indent' => false,
					),
					array(
						'id'     => 'sidebars2-start',
						'type'   => 'section',
						'indent' => true,
					),
					array(
                        'id' => 'unlimited_sidebar',
                        'type' => 'multi_text',
                        'title' => __('Sidebar generator', 'mobius'),
                        'validate' => 'no_html',
                        'subtitle' => __('Enter a name <strong>(Without special characters)</strong> for the sidebar, then click on <i>"add more"</i> to add a new sidebar.', 'mobius'),
						'default' => '',
                    ),
					array(
						'id'     => 'sidebars-end',
						'type'   => 'section',
						'indent' => false,
					),
					array(
						'id'     => 'sidebars3-start',
						'type'   => 'section',
						'title' => __('Single Blog Post Sidebar Management', 'mobius'),
						'indent' => true,
					),
					array(
                        'id' => 'sidebar-post',
                        'type' => 'select',
                        'title' => __('Sidebar Single Blog Post', 'mobius'),
                        'subtitle' => __('Select a sidebar. This sidebar will be applied on every single post and will override the sidebar configured in each single post.', 'mobius'),
                        'options' => $sidebars
                    ),
                    array(
                        'id' => 'sidebar-post-position',
                        'type' => 'button_set',
                        'title' => __('Sidebar Single Blog Post Position', 'mobius'),
                        'subtitle' => __('Choose the sibar position for each single blog post.<br>It will only be applied if a sidebar is selected.', 'mobius'),
                        'options' => array('left' => 'Left', 'right' => 'Right'),
                        'default' => 'right'
                    ),
					array(
						'id'     => 'sidebars3-end',
						'type'   => 'section',
						'indent' => true,
					),
				)
            );
			
			$this->sections[] = array(
                'icon' => 'dashicons dashicons-edit',
                'title' => __('Blog', 'mobius'),
				'heading' => __('Blog Settings', 'mobius'),
                'fields' => array(
					array(
						'id'     => 'blog-section-start',
						'type'   => 'section',
						'title' => __('Blog Page Settings', 'mobius'),
						'indent' => true,
					),
					array(
						'id'       => 'Blog-layout-preset',
						'type'     => 'image_select', 
						'presets'  => true,
						'title'    => __('Blog Layout Style Presets', 'mobius'),
						'subtitle' => __('Select a preset layout style for the blog page.', 'mobius'),
						'default'  => 1,
						'options'  => array(
							'1' => array(
								'alt'   => 'Preset 1', 
								'img'   => get_template_directory_uri() . '/includes/options/img/standard-blog.png', 
								'presets'   => array(
									'blog-layout'     => 'standard',
									'blog-size'    => '', 
									'blog-gutter' => 0,
									'blog-filters' => '',
									'blog-pagination' => 'page',
								)
							),
							'2' => array(
								'alt'   => 'Preset 2', 
								'img'   => get_template_directory_uri() . '/includes/options/img/5cols-grid-blog.png', 
								'presets'   => array(
									'blog-layout'     => 'grid 5cols fullwidth',
									'blog-size'    => '', 
									'blog-gutter' => '0',
									'blog-filters' => '',
									'blog-pagination' => 'ajax',
								)
							),
							'3' => array(
								'alt'   => 'Preset 3', 
								'img'   => get_template_directory_uri() . '/includes/options/img/5cols-masonry-blog.png', 
								'presets'   => array(
									'blog-layout'     => 'masonry 3cols',
									'blog-size'    => '', 
									'blog-gutter' => '28',
									'blog-filters' => '',
									'blog-pagination' => 'page',
								)
							),
							'5' => array(
								'alt'   => 'Preset 4', 
								'img'   => get_template_directory_uri() . '/includes/options/img/4cols-grid-wide-blog.png', 
								'presets'   => array(
									'blog-layout'     => 'grid 4cols',
									'blog-size'    => 'wide', 
									'blog-gutter' => '12',
									'blog-filters' => '',
									'blog-pagination' => 'page',
								)
							),
						),
					),
					array(
                        'id' => 'blog-layout',
                        'type' => 'select',
                        'title' => __('Blog layout', 'mobius'),
                        'subtitle' => __('Please select your blog layout style.', 'mobius'),
                        'options' => array(
										'standard' => 'Standard',
										'masonry 3cols' => 'Masonry 3 columns',
										'masonry 4cols' => 'Masonry 4 columns',
										'masonry 5cols fullwidth' => 'Masonry 5 columns fullWidth',
										'masonry 6cols fullwidth' => 'Masonry 6 columns fullWidth',
										'grid 3cols' => 'Grid 3 columns',
										'grid 4cols' => 'Grid 4 columns',
										'grid 5cols fullwidth' => 'Grid 5 columns fullWidth',
										'grid 6cols fullwidth' => 'Grid 6 columns fullWidth',
									),
                        'default' => 'standard'
                    ),
					array(
                        'id' => 'blog-standard-wide',
                        'type' => 'switch',
                        'title' => __('Blog Wide Image Format', 'mobius'),
                        'subtitle' => __('Allows to display wide image ratio on the standard blog page.', 'mobius'),
						'required' => array('blog-layout', 'equals', array('standard')),
                        'default' => 0
                    ),
					array(
                        'id' => 'blog-size',
                        'type' => 'select',
                        'title' => __('Blog Item Size', 'mobius'),
                        'subtitle' => __('If you want to force an unique size to every blog items in the grid, please active this option.<br>Only working for the grid layout.', 'mobius'),
						'required' => array('blog-layout', 'equals', array('grid 3cols', 'grid 4cols', 'grid 5cols fullwidth', 'grid 6cols fullwidth')),
                        'options' => array(
										'tall' => 'Tall',
										'wide' => 'Wide',
										'square top' => 'Square Top Image',
										'square left' => 'Square Left Image',
										'normal center' => 'Normal Image Center',
										'tall center' => 'Tall Image Center',
										'wide center' => 'Wide Image Center',
										'square center' => 'Square Image Center',	
									),
                        'default' => ''
                    ),
					array(
						'id' => 'blog-gutter',
						'type' => 'slider',
						'title' => __('Blog Gutter Width', 'mobius'),
						'subtitle' => __('Set the gutter width of the grid.(gutter = distance between each element in the grid)', 'mobius'),
						'required' => array('blog-layout', 'equals', array('masonry 3cols', 'masonry 4cols', 'masonry 5cols fullwidth', 'masonry 6cols fullwidth', 'grid 3cols', 'grid 4cols', 'grid 5cols fullwidth', 'grid 6cols fullwidth')),
						'validate' => 'numeric',
						"default" => 0,
						"min" => 0,
						"step" => 1,
						"max" => 50,
						'resolution' => 1,
						'display_value' =>  'text'
					),
					array(
                        'id' => 'blog-filters',
                        'type' => 'switch',
                        'title' => __('Blog Filters', 'mobius'),
                        'subtitle' => __('Allows to display the horizontal blog filters.', 'mobius'),
						'required' => array('blog-layout', 'equals', array('masonry 3cols', 'masonry 4cols', 'masonry 5cols fullwidth', 'masonry 6cols fullwidth', 'grid 3cols', 'grid 4cols', 'grid 5cols fullwidth', 'grid 6cols fullwidth')),
                        'default' => 0
                    ),
					array(
                        'id' => 'blog-pagination',
                        'type' => 'button_set',
                        'title' => __('Blog Pagination', 'mobius'),
                        'subtitle' => __('Set the blog pagination between standard pagination number and an ajax button to load blog items on the fly.', 'mobius'),
						'required' => array('blog-layout', 'equals', array('masonry 3cols', 'masonry 4cols', 'masonry 5cols fullwidth', 'masonry 6cols fullwidth', 'grid 3cols', 'grid 4cols', 'grid 5cols fullwidth', 'grid 6cols fullwidth')),
                        'options' => array('page' => 'Page Numbers', 'ajax' => 'Ajax Button'),
                        'default' => 'page'
                    ),
					array(
                        'id' => 'blog-item-nb',
                        'type' => 'text',
                        'title' => __('Blog Items Per page', 'mobius'),
                        'subtitle' => __('Choose the number of items you want to display in the blog page.', 'mobius'),
						'required' => array('blog-layout', 'equals', array('masonry 3cols', 'masonry 4cols', 'masonry 5cols fullwidth', 'masonry 6cols fullwidth', 'grid 3cols', 'grid 4cols', 'grid 5cols fullwidth', 'grid 6cols fullwidth')),
                        'validate' => 'numeric',
                        'default' => '12'
                    ),
					array(
                        'id' => 'blog-author-photo',
                        'type' => 'switch',
                        'title' => __('Blog Author Photo', 'mobius'),
                        'subtitle' => __('Allows to display the blog author photo.', 'mobius'),
						'required' => array('blog-layout', 'equals', array('masonry 3cols', 'masonry 4cols', 'masonry 5cols fullwidth', 'masonry 6cols fullwidth', 'grid 3cols', 'grid 4cols', 'grid 5cols fullwidth', 'grid 6cols fullwidth')),
                        'default' => '1'
                    ),
					array(
						'id'     => 'blog-section-end',
						'type'   => 'section',
						'indent' => false,
					),
					array(
						'id'     => 'blog-section2-start',
						'type'   => 'section',
						'title' => __('Blog Posts Settings', 'mobius'),
						'indent' => true,
					),
					array(
                        'id' => 'blog-feature-image',
                        'type' => 'switch',
                        'title' => __('Blog Feature Image', 'mobius'),
                        'subtitle' => __('Allows to display automatically featured image if enabled.', 'mobius'),
                        'default' => '1'
                    ),
					array(
                        'id' => 'blog-tag',
                        'type' => 'switch',
                        'title' => __('Blog Tags', 'mobius'),
                        'subtitle' => __('Allows to display Tags at the end of each blog post.', 'mobius'),
                        'default' => '1'
                    ),
					array(
                        'id' => 'blog-breadcrumb',
                        'type' => 'switch',
                        'title' => __('Blog Breadcrumb', 'mobius'),
                        'subtitle' => __('Allows to display the breadcrumb at the top of the page after the header', 'mobius'),
                        'default' => '1'
                    ),
					array(
                        'id' => 'blog-next-prev-post',
                        'type' => 'switch',
                        'title' => __('Blog Next/Prev Post', 'mobius'),
                        'subtitle' => __('Allows to display the next/prev post buttons at the button of the page', 'mobius'),
                        'default' => '1'
                    ),
					array(
                        'id' => 'blog-related-post',
                        'type' => 'switch',
                        'title' => __('Blog Related Posts', 'mobius'),
                        'subtitle' => __('Allows to display the related posts before the sharing buttons', 'mobius'),
                        'default' => ''
                    ),
					array(
                        'id' => 'blog-social',
                        'type' => 'switch',
                        'title' => __('Blog Social Sharing Buttons', 'mobius'),
                        'subtitle' => __('Allows to display social sharing buttons on your blog posts.', 'mobius'),
                        'default' => '1'
                    ),
					array(
                        'id' => 'blog-author',
                        'type' => 'switch',
                        'title' => __('Blog Author Bio', 'mobius'),
                        'subtitle' => __('Allows to display author Bio informations on the end of the blog post before comments.', 'mobius'),
                        'default' => '1'
                    ),
					array(
						'id'     => 'blog-section2-end',
						'type'   => 'section',
						'indent' => false,
					),
					array(
						'id'     => 'blog-section3-start',
						'type'   => 'section',
						'title' => __('Blog Header Settings', 'mobius'),
						'indent' => true,
					),
					array(
                        'id' => 'blog-header-active',
                        'type' => 'switch',
                        'title' => __('Blog Header', 'mobius'),
                        'subtitle' => __('Activate this option if you want to set a header style to all posts. If you setted a particular header style with an image in a post it will be preserved and will not be overridden by the following parameters.', 'mobius'),
                        'default' => ''
                    ),
					array(
                        'id' => 'blog-header-color',
                        'type' => 'button_set',
                        'title' => __('Blog Header Text Color', 'mobius'),
                        'subtitle' => __('Select the color of the content inside the page header. Dark add black text color and light white text color.', 'mobius'),
						'required' => array('blog-header-active', 'equals', 1),
                        'options' => array('dark' => 'Dark', 'light' => 'Light'),
                        'default' => ''
                    ),
					array(
                        'id' => 'blog-header-bgcolor',
                        'type'     => 'color',
						'title'    => __('Blog Header Bacground Color', 'mobius'), 
						'subtitle' => __('Please choose a background color. If an image is set, then the background color will not be applied.', 'mobius'),
						'required' => array('blog-header-active', 'equals', 1),
						'default'  => '',
						'transparent' => false,
						'validate' => 'color',
                    ),
					array(
                        'id' => 'blog-header-image',
                        'type' => 'media',
                        'title' => __('Blog Header Image ', 'mobius'),
                        'compiler' => 'true',
                        'desc' => __('Upload your blog header image.', 'mobius'),
                        'subtitle' => __('Please enter an URL or upload the page header image. the image should be between 1600px and about 2000px. The height must be at minimum 200px', 'mobius'),
						'required' => array('blog-header-active', 'equals', 1),
						'default'  => '',
                    ),
					array(
                        'id' => 'blog-header-image-alignment',
                        'type' => 'button_set',
                        'title' => __('Blog Header Image Alignment', 'mobius'),
                        'subtitle' => __('Select the vertical alignment of the page header image.', 'mobius'),
						'required' => array('blog-header-active', 'equals', 1),
                        'options' => array('top' => 'Top', 'center' => 'Center', 'bottom' => 'Bottom'),
                        'default' => ''
                    ),
					array(
                        'id' => 'blog-header-repeat',
                        'type' => 'switch',
                        'title' => __('Blog Header Image Pattern', 'mobius'),
                        'subtitle' => __('If your uploaded image is a repeating pattern, please check this option.', 'mobius'),
						'required' => array('blog-header-active', 'equals', 1),
                        'default' => ''
                    ),
					array(
                        'id' => 'blog-header-parallax',
                        'type' => 'switch',
                        'title' => __('Blog Header Image Parallax', 'mobius'),
                        'subtitle' => __('If you would like to add a parallax effect on the header image, please check this option.', 'mobius'),
						'required' => array('blog-header-active', 'equals', 1),
                        'default' => ''
                    ),
					array(
                        'id' => 'blog-header-transparent',
                        'type' => 'switch',
                        'title' => __('Blog Transparent header', 'mobius'),
                        'subtitle' => __('Enable or not a transparent header over the blog page header.', 'mobius'),
						'required' => array('blog-header-active', 'equals', 1),
                        'default' => ''
                    ),
					array(
						'id'     => 'blog-section3-end',
						'type'   => 'section',
						'indent' => false,
					),	
				)
            );
			
			$this->sections[] = array(
                'icon' => 'dashicons dashicons-format-image',
                'title' => __('Portfolio', 'mobius'),
				'heading' => __('Portfolio Settings', 'mobius'),
                'fields' => array(
					array(
						'id'     => 'portfolio1-start',
						'type'   => 'section',
						'title' => __('Portfolio Page Settings', 'mobius'),
						'indent' => true,
					),
					array(
						'id'       => 'portfolio-layout-preset',
						'type'     => 'image_select', 
						'presets'  => true,
						'title'    => __('Portfolio Layout Style Presets', 'mobius'),
						'subtitle' => __('Select a preset layout style for the portfolio page or enable advanced portfolio layout style to set your portfolio page as desired.', 'mobius'),
						'default'  => 1,
						'options'  => array(
							'1' => array(
								'alt'   => 'Preset 1', 
								'img'   => get_template_directory_uri() . '/includes/options/img/5cols-full.png', 
								'presets'   => array(
									'portfolio-layout'     => 'grid 5cols fullwidth',
									'portfolio-size'    => '', 
									'portfolio-gutter' => '0',
									'portfolio-style' => 'style1',
								)
							),
							'2' => array(
								'alt'   => 'Preset 2', 
								'img'   => get_template_directory_uri() . '/includes/options/img/5cols-full-square.png', 
								'presets'   => array(
									'portfolio-layout'     => 'grid 4cols fullwidth',
									'portfolio-size'    => 1, 
									'portfolio-gutter' => '0',
									'portfolio-style' => '',
								)
							),
							'3' => array(
								'alt'     => 'Preset 3', 
								'img'     => get_template_directory_uri() . '/includes/options/img/4cols-boxed.png', 
								'presets' => array(
									'portfolio-layout'     => 'grid 4cols',
									'portfolio-size'    => 1, 
									'portfolio-gutter' => '24',
									'portfolio-style' => 'style2',
								)
							),
							'4' => array(
								'alt'     => 'Preset 4', 
								'img'     => get_template_directory_uri() . '/includes/options/img/3cols-boxed.png', 
								'presets' => array(
									'portfolio-layout'     => 'grid 3cols',
									'portfolio-size'    => 1, 
									'portfolio-gutter' => '28',
									'portfolio-style' => 'style2',
								)
							),
							'5' => array(
								'alt'     => 'Preset 5', 
								'img'     => get_template_directory_uri() . '/includes/options/img/4cols-boxed-1.png', 
								'presets' => array(
									'portfolio-layout'     => 'grid 4cols',
									'portfolio-size'    => 1, 
									'portfolio-gutter' => '24',
									'portfolio-style' => 'style1',
								)
							),
							'6' => array(
								'alt'     => 'Preset 6', 
								'img'     => get_template_directory_uri() . '/includes/options/img/3cols-boxed-1.png', 
								'presets' => array(
									'portfolio-layout'     => 'grid 3cols',
									'portfolio-size'    => 1, 
									'portfolio-gutter' => '28',
									'portfolio-style' => 'style1',
								)
							),
						),
					),
					array(
                        'id' => 'portfolio-advance-settings',
                        'type' => 'switch',
                        'title' => __('Portfolio Advanced Layout Settings', 'mobius'),
                        'subtitle' => __('If you want to force an unique square size to every portfolio items in the grid, please active this option.<br>Only working for the grid layout.', 'mobius'),
                        'default' => 0
                    ),
					array(
                        'id' => 'portfolio-layout',
                        'type' => 'select',
                        'title' => __('Portfolio layout', 'mobius'),
                        'subtitle' => __('Choose your portfolio page layout.', 'mobius'),
						'required' => array('portfolio-advance-settings', 'equals', 1),
                        'options' => array(
										'masonry 3cols' => 'Masonry 3 columns',
										'masonry 4cols' => 'Masonry 4 columns',
										'masonry 4cols fullwidth' => 'Masonry 4 columns fullWidth',
										'masonry 5cols fullwidth' => 'Masonry 5 columns fullWidth',
										'masonry 6cols fullwidth' => 'Masonry 6 columns fullWidth',
										'grid 3cols' => 'Grid 3 columns',
										'grid 4cols' => 'Grid 4 columns',
										'grid 4cols fullwidth' => 'Grid 4 columns fullWidth',
										'grid 5cols fullwidth' => 'Grid 5 columns fullWidth',
										'grid 6cols fullwidth' => 'Grid 6 columns fullWidth',
									),
                        'default' => 'grid 5cols fullwidth'
                    ),
					array(
                        'id' => 'portfolio-size',
                        'type' => 'switch',
                        'title' => __('Portfolio Item Square Size', 'mobius'),
                        'subtitle' => __('If you want to force an unique square size to every portfolio items in the grid, please active this option.<br>Only working for the grid layout.', 'mobius'),
						'required' => array('portfolio-layout', 'equals', array('grid 3cols', 'grid 4cols', 'grid 4cols fullwidth', 'grid 5cols fullwidth', 'grid 6cols fullwidth')),
                        'default' => ''
                    ),
					array(
						'id' => 'portfolio-gutter',
						'type' => 'slider',
						'title' => __('Portfolio Gutter Width', 'mobius'),
						'subtitle' => __('Set the gutter width of the grid.(gutter = distance between each element in the grid)', 'mobius'),
						'required' => array('portfolio-advance-settings', 'equals', 1),
						'validate' => 'numeric',
						"default" => 0,
						"min" => 0,
						"step" => 1,
						"max" => 50,
						'resolution' => 1,
						'display_value' =>  'text'
					),
					array(
                        'id' => 'portfolio-style',
                        'type' => 'select',
                        'title' => __('Portfolio Item Style', 'mobius'),
                        'subtitle' => __('Choose your portfolio item style.', 'mobius'),
						'required' => array('portfolio-advance-settings', 'equals', 1),
                        'options' => array(
										'style1' => 'Center title style',
										'style2' => 'Bottom title style',
										'style3' => 'Centered title & category'
									),
                        'default' => 'style1'
                    ),
					array(
                        'id' => 'portfolio-order',
                        'type' => 'select',
                        'title' => __('Portfolio Item Order', 'mobius'),
                        'subtitle' => __('Choose the order of item inside the portfolio grid/masonry.<br> Custom order can be set in Reorder grid menu page.', 'mobius'),
                        'options' => array(
										'none' => 'None',
										'menu_order' => 'Custom Order',
										'title' => 'Title',
										'name' => 'Name Slug',
										'date' => 'Date',
										'rand' => 'Random'
									),
                        'default' => 'date'
                    ),
					array(
                        'id' => 'portfolio-filters',
                        'type' => 'switch',
                        'title' => __('Portfolio Filters', 'mobius'),
                        'subtitle' => __('Allows to display the horizontal portfolio filters.', 'mobius'),
                        'default' => '1'
                    ),
					array(
                        'id' => 'portfolio-pagination',
                        'type' => 'button_set',
                        'title' => __('Portfolio Pagination', 'mobius'),
                        'subtitle' => __('Set the  portfolio pagination between standard pagination number and an ajax button to load portfolio items on the fly.', 'mobius'),
                        'options' => array('page' => 'Page Numbers', 'ajax' => 'Ajax Button'),
                        'default' => 'page'
                    ),
					array(
                        'id' => 'portfolio-item-nb',
                        'type' => 'text',
                        'title' => __('Portfolio Items Per page', 'mobius'),
                        'subtitle' => __('Choose the number of items you want to display in the portfolio page.', 'mobius'),
                        'validate' => 'numeric',
                        'default' => '16'
                    ),
					array(
						'id'     => 'portfolio1-end',
						'type'   => 'section',
						'indent' => false,
					),
					array(
						'id'     => 'portfolio2-start',
						'type'   => 'section',
						'title' => __('Portfolio Item Settings', 'mobius'),
						'indent' => true,
					),
					array(
                        'id' => 'portfolio-feature-image',
                        'type' => 'switch',
                        'title' => __('Portfolio Feature Image', 'mobius'),
                        'subtitle' => __('Allows to display automatically featured image if enabled.', 'mobius'),
                        'default' => '1'
                    ),
					array(
                        'id' => 'portfolio-breadcrumb',
                        'type' => 'switch',
                        'title' => __('Portfolio Breadcrumb', 'mobius'),
                        'subtitle' => __('Allows to display the breadcrumb at the top of the portfolio item after the header', 'mobius'),
                        'default' => '1'
                    ),
					array(
                        'id' => 'portfolio-next-prev-post',
                        'type' => 'switch',
                        'title' => __('Portfolio Next/Prev Post', 'mobius'),
                        'subtitle' => __('Allows to display the next/prev post buttons at the button of the page', 'mobius'),
                        'default' => '1'
                    ),
					array(
                        'id' => 'portfolio-social',
                        'type' => 'switch',
                        'title' => __('Portfolio Social Sharing Buttons', 'mobius'),
                        'subtitle' => __('Allows to display social sharing buttons on your portfolio items.', 'mobius'),
                        'default' => '1'
                    ),
					array(
                        'id' => 'portfolio-author',
                        'type' => 'switch',
                        'title' => __('Portfolio About Author', 'mobius'),
                        'subtitle' => __('Allows to display author informations on the end of the portfolio item before comments.', 'mobius'),
                        'default' => '1'
                    ),
					array(
                        'id' => 'portfolio-comment',
                        'type' => 'switch',
                        'title' => __('Portfolio Comment System', 'mobius'),
                        'subtitle' => __('Allows to have the comment system enable and under the portfolio content.', 'mobius'),
                        'default' => '1'
                    ),
					array(
                        'id' => 'portfolio-sidebar',
                        'type' => 'switch',
                        'title' => __('Portfolio Sidebar Follow On Scroll', 'mobius'),
                        'subtitle' => __('Allows to have a right sidebar follow you down the page. Only works if there is content inside the portfolio sidebar content area in portfolio item.', 'mobius'),
                        'default' => '1'
                    ),
					array(
						'id'     => 'portfolio2-end',
						'type'   => 'section',
						'indent' => false,
					),
					array(
						'id'     => 'portfolio-section3-start',
						'type'   => 'section',
						'title' => __('Portfolio Header Settings', 'mobius'),
						'indent' => true,
					),
					array(
                        'id' => 'portfolio-header-active',
                        'type' => 'switch',
                        'title' => __('Portfolio Header', 'mobius'),
                        'subtitle' => __('Activate this option if you want to set a header style to all posts. If you setted a particular header style with an image in a post it will be preserved and will not be overridden by the following parameters.', 'mobius'),
                        'default' => ''
                    ),
					array(
                        'id' => 'portfolio-header-color',
                        'type' => 'button_set',
                        'title' => __('Portfolio Header Text Color', 'mobius'),
                        'subtitle' => __('Select the color of the content inside the page header. Dark add black text color and light white text color.', 'mobius'),
						'required' => array('portfolio-header-active', 'equals', 1),
                        'options' => array('dark' => 'Dark', 'light' => 'Light'),
                        'default' => ''
                    ),
					array(
                        'id' => 'portfolio-header-bgcolor',
                        'type'     => 'color',
						'title'    => __('Portfolio Header Bacground Color', 'mobius'), 
						'subtitle' => __('Please choose a background color. If an image is set, then the background color will not be applied.', 'mobius'),
						'required' => array('portfolio-header-active', 'equals', 1),
						'default'  => '',
						'transparent' => false,
						'validate' => 'color',
                    ),
					array(
                        'id' => 'portfolio-header-image',
                        'type' => 'media',
                        'title' => __('Portfolio Header Image ', 'mobius'),
                        'compiler' => 'true',
                        'desc' => __('Upload your portfolio header image.', 'mobius'),
                        'subtitle' => __('Please enter an URL or upload the page header image. the image should be between 1600px and about 2000px. The height must be at minimum 200px', 'mobius'),
						'required' => array('portfolio-header-active', 'equals', 1),
						'default'  => '',
                    ),
					array(
                        'id' => 'portfolio-header-image-alignment',
                        'type' => 'button_set',
                        'title' => __('Portfolio Header Image Alignment', 'mobius'),
                        'subtitle' => __('Select the vertical alignment of the page header image.', 'mobius'),
						'required' => array('portfolio-header-active', 'equals', 1),
                        'options' => array('top' => 'Top', 'center' => 'Center', 'bottom' => 'Bottom'),
                        'default' => ''
                    ),
					array(
                        'id' => 'portfolio-header-repeat',
                        'type' => 'switch',
                        'title' => __('Portfolio Header Image Pattern', 'mobius'),
                        'subtitle' => __('If your uploaded image is a repeating pattern, please check this option.', 'mobius'),
						'required' => array('portfolio-header-active', 'equals', 1),
                        'default' => ''
                    ),
					array(
                        'id' => 'portfolio-header-parallax',
                        'type' => 'switch',
                        'title' => __('Portfolio Header Image Parallax', 'mobius'),
                        'subtitle' => __('If you would like to add a parallax effect on the header image, please check this option.', 'mobius'),
						'required' => array('portfolio-header-active', 'equals', 1),
                        'default' => ''
                    ),
					array(
                        'id' => 'portfolio-header-transparent',
                        'type' => 'switch',
                        'title' => __('Portfolio Transparent header', 'mobius'),
                        'subtitle' => __('Enable or not a transparent header over the portfolio page header.', 'mobius'),
						'required' => array('portfolio-header-active', 'equals', 1),
                        'default' => ''
                    ),
					array(
						'id'     => 'portfolio-section3-end',
						'type'   => 'section',
						'indent' => false,
					),	
				)
            );
			
			if (class_exists('Woocommerce')) {
				$this->sections[] = array(
					'icon' => 'dashicons dashicons-cart',
					'title' => __('Woocommerce', 'mobius'),
					'heading' => __('Woocommerce Options', 'mobius'),
					'fields' => array(
						array(
							'id'     => 'section-Cart-start',
							'type'   => 'section',
							'title' => __('Cart', 'mobius'),
							'indent' => true,
						),
						array(
							'id' => 'woo-cart',
							'type' => 'switch',
							'title' => __('Woocommerce Ajax Cart Header', 'mobius'),
							'subtitle' => __('This will add a cart item to your main navigation.', 'mobius'),
							'default' => '1'
						),
						array(
							'id'     => 'section-Cart-end',
							'type'   => 'section',
							'indent' => false,
						),
						array(
							'id'     => 'section-product-start',
							'type'   => 'section',
							'title' => __('Product Per Page', 'mobius'),
							'indent' => true,
						),
						array(
							'id' => 'woo-per-page',
							'type' => 'switch',
							'title' => __('Woocommerce Product Per Page', 'mobius'),
							'subtitle' => __('This will add a slider to choose the number of product per page.', 'mobius'),
							'default' => ''
						),
						array(
							'id'     => 'section-product-end',
							'type'   => 'section',
							'indent' => false,
						),
						array(
							'id'     => 'zoom-section-start',
							'type'   => 'section',
							'title' => __('Mobius Zoom Feature', 'mobius'),
							'indent' => true,
						),
						array(
							'id' => 'woo-zoom',
							'type' => 'switch',
							'title' => __('Single Product Zoom', 'mobius'),
							'subtitle' => __('Enable or not a zoom functionnality over single product image.', 'mobius'),
							'default' => '1'
						),
						array(
							'id'     => 'zoom-section-end',
							'type'   => 'section',
							'indent' => false,
						),
					)
				);
			}

            

            if (file_exists(dirname(__FILE__) . '/../README.md')) {
                $this->sections[] = array(
                    'icon' => 'dashicons dashicons-book-alt',
                    'title' => __('Documentation', 'mobius'),
                    'fields' => array(
                        array(
                            'id' => '999',
                            'type' => 'raw',
                            'markdown' => true,
                            'content' => file_get_contents(dirname(__FILE__) . '/../README.md')
                        ),
                    ),
                );
            }

            $this->sections[] = array(
				'title' => '',
                'type' => 'divide',
            );
			
			function encodeURIComponent($str) {
				$revert = array('%21'=>'!', '%2A'=>'*', '%27'=>"'", '%28'=>'(', '%29'=>')');
				return strtr(rawurlencode($str), $revert);
			}
			$theme_doc = '<iframe src="http://docs.google.com/viewer?embedded=true&url='. encodeURIComponent(get_template_directory_uri() . '/includes/options/mobius-documentation.pdf') .'" style="width:90%;height:800px"></iframe>';
			
			$this->sections[] = array(
                'icon' => 'dashicons dashicons-book-alt',
                'title' => __('Documentation', 'mobius'),
				'heading' => __('Mobius documentation v', 'mobius'). $this->theme->get('Version'), 
                'fields' => array(
                    array(
                        'id' => '1000',
                        'type' => 'raw',
                        'content' => $theme_doc,
                    )
                ),
            );
			
			$theme_info = '<div class="redux-framework-section-desc">';
			$theme_info .= '<p><img src="' . $this->theme->get_screenshot() . '" width="300"/></p>';
			$theme_info .= '<p class="redux-framework-theme-data description theme-uri">' . __('<strong>Theme URL:</strong> ', 'mobius') . '<a href="' . $this->theme->get('ThemeURI') . '" target="_blank">' . $this->theme->get('ThemeURI') . '</a></p>';
			$theme_info .= '<p class="redux-framework-theme-data description theme-author">' . __('<strong>Author:</strong> ', 'mobius') . $this->theme->get('Author') . '</p>';
			$theme_info .= '<p class="redux-framework-theme-data description theme-version">' . __('<strong>Version:</strong> ', 'mobius') . $this->theme->get('Version') . '</p>';
			$theme_info .= '<p class="redux-framework-theme-data description theme-description">' . $this->theme->get('Description') . '</p>';
			$tabs = $this->theme->get('Tags');
            if (!empty($tabs)) {
				$theme_info .= '<p class="redux-framework-theme-data description theme-tags">' . __('<strong>Tags:</strong> ', 'mobius') . implode(', ', $tabs) . '</p>';
            }
            $theme_info .= '</div>';
			
            $this->sections[] = array(
                'icon' => 'dashicons dashicons-lightbulb',
                'title' => __('Theme Informations', 'mobius'),
				'heading' => __('Mobius by Themeone v', 'mobius'). $this->theme->get('Version'), 
                'fields' => array(
                    array(
						'title' => '',
                        'id' => 'raw_new_info',
                        'type' => 'raw',
                        'content' => $theme_info,
                    )
                ),
            );
			
			$this->sections[] = array(
				'title' => '',
                'type' => 'divide',
            );
			
			if(class_exists('Themeone_Import_Demo')) {
				ob_start();
				$base = new Themeone_Import_Demo();
				$demo_importer = $base->themeone_build_demo_importer();
				$demo_importer = ob_get_contents();
				ob_end_clean();
			} else {
				$demo_importer = '';
			}
			
			$this->sections[] = array(
                'icon' => 'dashicons dashicons-download',
                'title' => __('One-Click install', 'mobius'),
				'heading' => __('One-click installer - Dummy Data', 'mobius'), 
                'fields' => array(
					
					array(
						'title' => '',
                        'id' => 'raw_new_info',
                        'type' => 'raw',
                        'content' => $demo_importer,
                    ),
					/*array(
						'id'    => 'info_accent_color',
						'type'  => 'info',
						'title' => __('We advise to import demo content only on fresh installation in order to avoid any conflict with your current blog content.<br>Images are not including in the demo content. The images will be replaced by a placeholder image.', 'mobius'),
						'icon'  => 'el-icon-info-sign',
					),*/
					/*array(
						'id'     => 'section-start',
						'type'   => 'section',
						'title' => __('Importer', 'mobius'),
						'indent' => true,
					),
					array(
						'id'          => 'demo-content-type',
						'type'        => 'button_set',
						'title'       => __('Demo Content Type', 'mobius'), 
						'subtitle'    => __('Select the demo content type. If you install Visual Composer demo content, you need to install Visual Composer plugin provided with Mobius', 'mobius'),
						'options' => array('visual-composer' => 'Visual Composer Demo', 'themeone-shortcode' => 'Themeone Shortcode Demo'),
                        'default' => 'visual-composer'
					),
                    array(
                        'id' => 'import-demo',
                        'type' => 'button_import',
                        'title' => __('Importing Dummy Data', 'mobius'),
                        'subtitle' => __('Importing demo content will copy the entire Mobius online demo. It will copy posts, portfolio items, pages, menu, slides and sliders. It will also add widgets.<br><br><strong><em>This installer can take a minute to complete.<br>Please, do not refresh your browser during the operation.</em></strong>', 'mobius'),
                        'default' => '1'
                    ),
					array(
						'id'     => 'section-end',
						'type'   => 'section',
						'indent' => true,
					),*/
                ),
            );
			
			
			if ( file_exists( dirname( __FILE__ ) . '/../README.md' ) ) {
				$section = array(
					'icon'   => 'el el-list-alt',
					'title'  => __( 'Documentation', 'redux-framework-demo' ),
					'fields' => array(
						array(
							'id'       => '17',
							'type'     => 'raw',
							'markdown' => true,
							'content'  => file_get_contents( dirname( __FILE__ ) . '/../README.md' )
						),
					),
				);
				Redux::setSection( $opt_name, $section );
			}

                if ( file_exists( trailingslashit( dirname( __FILE__ ) ) . 'README.html' ) ) {
                    $tabs['docs'] = array(
                        'icon'    => 'el el-book',
                        'title'   => __( 'Documentation', 'redux-framework-demo' ),
                        'content' => nl2br( file_get_contents( trailingslashit( dirname( __FILE__ ) ) . 'README.html' ) )
                    );
                }
            }

            public function setHelpTabs() {

                // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
                $this->args['help_tabs'][] = array(
                    'id'      => 'redux-help-tab-1',
                    'title'   => __( 'Theme Information 1', 'redux-framework-demo' ),
                    'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
                );

                $this->args['help_tabs'][] = array(
                    'id'      => 'redux-help-tab-2',
                    'title'   => __( 'Theme Information 2', 'redux-framework-demo' ),
                    'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
                );

                // Set the help sidebar
                $this->args['help_sidebar'] = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'redux-framework-demo' );
            }

            /**
             * All the possible arguments for Redux.
             * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
             * */
            public function setArguments() {

                $theme = wp_get_theme(); // For use with some settings. Not necessary.

                $this->args = array(
                    // TYPICAL -> Change these values as you need/desire
                    'opt_name'             => 'mobius',
                    // This is where your data is stored in the database and also becomes your global variable name.
                    'display_name'         => $theme->get( 'Name' ),
                    // Name that appears at the top of your panel
                    'display_version'      => $theme->get( 'Version' ),
                    // Version that appears at the top of your panel
                    'menu_type'            => 'menu',
                    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                    'allow_sub_menu'       => true,
                    // Show the sections below the admin menu item or not
                    'menu_title'           => __( 'Mobius Options', 'redux-framework-demo' ),
                    'page_title'           => __( 'Mobius Options', 'redux-framework-demo' ),
                    // You will need to generate a Google API key to use this feature.
                    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                    'google_api_key'       => '',
                    // Set it you want google fonts to update weekly. A google_api_key value is required.
                    'google_update_weekly' => false,
                    // Must be defined to add google fonts to the typography module
                    'async_typography'     => false,
                    // Use a asynchronous font on the front end or font string
                    //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
                    'admin_bar'            => true,
                    // Show the panel pages on the admin bar
                    'admin_bar_icon'     => 'dashicons-admin-generic',
                    // Choose an icon for the admin bar menu
                    'admin_bar_priority' => 50,
                    // Choose an priority for the admin bar menu
                    'global_variable'      => '',
                    // Set a different name for your global variable other than the opt_name
                    'dev_mode'             => false,
                    // Show the time the page took to load, etc
                    'update_notice'        => false,
                    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
                    'customizer'           => false,
                    // Enable basic customizer support
                    //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
                    //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

                    // OPTIONAL -> Give you extra features
                    'page_priority'        => null,
                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                    'page_parent'          => 'themes.php',
                    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                    'page_permissions'     => 'manage_options',
                    // Permissions needed to access the options panel.
                    'menu_icon'            => '',
                    // Specify a custom URL to an icon
                    'last_tab'             => '',
                    // Force your panel to always open to a specific tab (by id)
                    'page_icon'            => 'icon-themes',
                    // Icon displayed in the admin panel next to your menu_title
                    'page_slug'            => '',
                    // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
                    'save_defaults'        => true,
                    // On load save the defaults to DB before user clicks save or not
                    'default_show'         => false,
                    // If true, shows the default value next to each field that is not the default value.
                    'default_mark'         => '',
                    // What to print by the field's title if the value shown is default. Suggested: *
                    'show_import_export'   => true,
                    // Shows the Import/Export panel when not used as a field.

                    // CAREFUL -> These options are for advanced use only
                    'transient_time'       => 60 * MINUTE_IN_SECONDS,
                    'output'               => true,
                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                    'output_tag'           => true,
                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                    // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

                    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                    'database'             => '',
                    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                    'system_info'          => false,
                    // REMOVE

                    // HINTS
                    'hints'                => array(
                        'icon'          => 'el el-question-sign',
                        'icon_position' => 'right',
                        'icon_color'    => 'lightgray',
                        'icon_size'     => 'normal',
                        'tip_style'     => array(
                            'color'   => 'light',
                            'shadow'  => true,
                            'rounded' => false,
                            'style'   => '',
                        ),
                        'tip_position'  => array(
                            'my' => 'top left',
                            'at' => 'bottom right',
                        ),
                        'tip_effect'    => array(
                            'show' => array(
                                'effect'   => 'slide',
                                'duration' => '500',
                                'event'    => 'mouseover',
                            ),
                            'hide' => array(
                                'effect'   => 'slide',
                                'duration' => '500',
                                'event'    => 'click mouseleave',
                            ),
                        ),
                    )
                );
            }
        }

        global $MobiusConfig;
        $MobiusConfig = new Themeone_config();
    }