<?php

require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'themeone_register_required_plugins' );

function themeone_register_required_plugins() {    	  
$plugins =	array(  	

				array(
					'name'      => 'Woocommerce',
					'slug'      => 'woocommerce',
					'required'  => false,
				),
				array(
					'name'      => 'YITH WooCommerce Wishlist',
					'slug'      => 'yith-woocommerce-wishlist',
					'required'  => false,
				),
				array(
					'name' 		=> 'Contact Form 7',
					'slug' 		=> 'contact-form-7',
					'required' 	=> false,
				),
				array( 
					'name' => 'Envato WordPress Toolkit',
					'slug' => 'envato-wordpress-toolkit',
					'source' => get_template_directory() . '/includes/tgm-plugin-activation/plugins/envato-wordpress-toolkit.zip',
					'required' => false,
					'version' => '1.7.3',
					'force_activation' => false,
					'force_deactivation' => false,
					'external_url' => '',  	
				),
				array( 
					'name' => 'Themeone Portfolio',
					'slug' => 'themeone-portfolio',
					'source' => get_template_directory() . '/includes/tgm-plugin-activation/plugins/themeone-portfolio.zip',
					'required' 	=> true,
					'version' => '1.0',
					'force_activation' => false,
					'force_deactivation' => false,
					'external_url' => '', 
				),
				array( 
					'name' => 'Themeone Shortcodes',
					'slug' => 'themeone-shortcodes',
					'source' => get_template_directory() . '/includes/tgm-plugin-activation/plugins/themeone-shortcodes.zip',
					'required' 	=> true,
					'version' => '3.2',
					'force_activation' => false,
					'force_deactivation' => false,
					'external_url' => '', 
				),
				array( 
					'name' => 'Themeone Slider',
					'slug' => 'themeone-slider',
					'source' => get_template_directory() . '/includes/tgm-plugin-activation/plugins/themeone-slider.zip',
					'required' 	=> true,
					'version' => '1.1',
					'force_activation' => false,
					'force_deactivation' => false,
					'external_url' => '', 
				),
				array( 
					'name' => 'WPBakery Visual Composer',
            		'slug' => 'js_composer',
					'source' => get_template_directory() . '/includes/tgm-plugin-activation/plugins/js_composer.zip',
					'required' 	=> false,
					'version' => '4.9',
					'force_activation' => false,
					'force_deactivation' => false,
					'external_url' => ''
				),
				array( 
					'name' => 'Revolution Slider',
            		'slug' => 'revslider',
					'source' => get_template_directory() . '/includes/tgm-plugin-activation/plugins/revslider.zip',
					'required' 	=> false,
					'version' => '5.1.5',
					'force_activation' => false,
					'force_deactivation' => false,
					'external_url' => '', 
				)
			);  

//TGM_Plugin_Activation::get_instance()->update_dismiss();

$config = array(
        'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', 'mobius' ),
            'menu_title'                      => __( 'Install Plugins', 'mobius' ),
            'installing'                      => __( 'Installing Plugin: %s', 'mobius' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'mobius' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'mobius' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'mobius' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'mobius' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'mobius' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'mobius' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'mobius' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'mobius' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'mobius' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'mobius' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'mobius' ),
            'return'                          => __( 'Return to Required Plugins Installer', 'mobius' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'mobius' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'mobius' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );

    tgmpa( $plugins, $config );

}

?>