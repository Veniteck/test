<?php

    /**
     * For full documentation, please visit: http://docs.reduxframework.com/
     * For a more extensive sample-config file, you may look at:
     * https://github.com/reduxframework/redux-framework/blob/master/sample/sample-config.php
     */

    if(! class_exists('Redux')) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "vg_calaco_options";

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        'opt_name' => $opt_name,
        'display_name' => $theme->get('Name'),
        'display_version' => 'v.' . $theme->get('Version'),
        'page_slug' => 'vg-calaco',
        'page_title' => $theme->get('Name'),
        'update_notice' => FALSE,
        'intro_text' => '',
        'footer_text' => __('Copyright &copy; 2016 ', 'vg-calaco') . $theme->get('Name') . __('. All Rights Reserved.', 'vg-calaco'),
        'admin_bar' => TRUE,
        'menu_type' => 'menu',
        'menu_title' => $theme->get('Name'),
        'allow_sub_menu' => TRUE,
        'page_parent_post_type' => 'your_post_type',
        'page_priority' => '3',
        'customizer' => FALSE,
        'default_mark' => '*',
		'global_variable' => 'vg_calaco_options',
        'hints' => array(
            'icon' => 'el el-adjust-alt',
            'icon_position' => 'right',
            'icon_size' => 'normal',
            'tip_style' => array(
                'color' => 'light',
			),
            'tip_position' => array(
                'my' => 'top left',
                'at' => 'bottom right',
			),
            'tip_effect' => array(
                'show' => array(
                    'duration' => '500',
                    'event' => 'mouseover',
				),
                'hide' => array(
                    'duration' => '500',
                    'event' => 'mouseleave unfocus',
				),
			),
		),
        'output' => FALSE,
        'output_tag' => FALSE,
        'page_permissions' => 'manage_options',
        'save_defaults' => TRUE,
        'show_import_export' => TRUE,
        'database' => '',
        'transient_time' => '3600',
        'network_sites' => TRUE,
		'dev_mode' => false,
		'forced_dev_mode_off' => TRUE,
		'disable_tracking' => TRUE,
	);

    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
    $args['share_icons'][] = array(
        'url'   => 'https://www.facebook.com/vinawebsolutions/',
        'title' => 'Like us on Facebook',
        'icon'  => 'el el-facebook'
	);
    $args['share_icons'][] = array(
        'url'   => 'http://twitter.com/vnwebsolutions',
        'title' => 'Follow us on Twitter',
        'icon'  => 'el el-twitter'
	);
	
	if(! isset($args['global_variable']) || $args['global_variable'] !== false) {
        if(! empty($args['global_variable'])) {
            $v = $args['global_variable'];
        } 
		else {
            $v = str_replace('-', '_', $args['opt_name']);
        }
    }
	
    Redux::setArgs($opt_name, $args);

    /*
     * ---> END ARGUMENTS
     */

    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => __('Theme Information 1', 'vg-calaco'),
            'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'vg-calaco')
		),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => __('Theme Information 2', 'vg-calaco'),
            'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'vg-calaco')
		)
	);
    Redux::setHelpTab($opt_name, $tabs);

    // Set the help sidebar
    $content = __('<p>This is the sidebar content, HTML is allowed.</p>', 'vg-calaco');
    Redux::setHelpSidebar($opt_name, $content);


    /*
     * <--- END HELP TABS
     */


    /*
     *
     * ---> START SECTIONS
     *
     */
	
	Redux::setSection($opt_name, array(
        'icon'   => 'fa fa-tachometer',
        'title'  => __('General', 'vg-calaco'),
        'fields' => array(
						
			array(
                'title' => __('Demo Mode', 'vg-calaco'),
                'subtitle' => __('<em>Enabled / Disabled Demo Mode.<br>(for Developer only).</em>', 'vg-calaco'),
				'desc' =>__('<em>When enabled, some config from Theme Options will not implement.</em>', 'vg-calaco'),
                'id' => 'demo_mode',
                'on' => __('Enabled', 'vg-calaco'),
                'off' => __('Disabled', 'vg-calaco'),
                'type' => 'switch',
                'default' => 0,
			),
			
			array(
				'id'=>'demo_setting',
				'type' => 'textarea',
				'title' => __('Demo Setting', 'vg-calaco'), 
				'subtitle' => __('This field only use for Developer.', 'vg-calaco'),				
				'validate' => 'html_custom',
				'default' => 'niche-01:layout-1,preset-1,full-width',
				'allowed_html' => array('br' => array()),				
				'required' => array('demo_mode', '=', array('1')),
			),
			
            array(
                'id'       => 'default_layout',
                'type'     => 'image_select',
                'compiler' => true,
                'title'    => __('Default Layout', 'vg-calaco'),
                'subtitle' => __('<em>Select the default layout for your website.</em>', 'vg-calaco'),
                'options'  => array(
                    'layout-1' => array(
                        'alt' => __('Layout 1', 'vg-calaco'),
                        'img' => get_template_directory_uri() . '/assets/images/theme_options/header_1.png'
					),
                    'layout-2' => array(
                        'alt' => __('Layout 2', 'vg-calaco'),
                        'img' => get_template_directory_uri() . '/assets/images/theme_options/header_2.png'
					),
                    'layout-3' => array(
                        'alt' => __('Layout 3', 'vg-calaco'),
                        'img' => get_template_directory_uri() . '/assets/images/theme_options/header_3.png'
					),
					'layout-4' => array(
                        'alt' => __('Layout 4', 'vg-calaco'),
                        'img' => get_template_directory_uri() . '/assets/images/theme_options/header_4.png'
					),
				),
                'default'  => 'layout-1',
				'required' => array('demo_mode', '=', array('0')),
			),
			
			array(
                'id'       => 'default_preset',
                'type'     => 'image_select',
                'compiler' => true,
                'title'    => __('Default Preset Color', 'vg-calaco'),
                'subtitle' => __('<em>Select the default preset color for your website.</em>', 'vg-calaco'),
                'options'  => array(
                    'preset-1' => array(
                        'alt' => __('Preset Color 1', 'vg-calaco'),
                        'img' => get_template_directory_uri() . '/assets/images/theme_options/preset-1.png'
					),
                    'preset-2' => array(
                        'alt' => __('Preset Color 2', 'vg-calaco'),
                        'img' => get_template_directory_uri() . '/assets/images/theme_options/preset-2.png'
					),
                    'preset-3' => array(
                        'alt' => __('Preset Color 3', 'vg-calaco'),
                        'img' => get_template_directory_uri() . '/assets/images/theme_options/preset-3.png'
					),
				),
                'default'  => 'preset-1',
				'required' => array('demo_mode', '=', array('0')),
			),
			
			array(
                'id'       => 'website_width',
                'type'     => 'button_set',
                'title'    => __('Website Width', 'vg-calaco'),
                'subtitle' => __('<em>Set up the width of the Website.</em>', 'vg-calaco'),
                'options'  => array(
                    'full-width' => 'Full',
                    'box-width'  => 'Box'
				),
                'default'  => 'full-width',
				'required' => array('demo_mode', '=', array('0')),
			),
			array(
				'id'        => 'theme_loading',
				'type'      => 'switch',
				'title'     => esc_html__('Show Loading Page', 'vg-calaco'),
				'default'   => false,
			),
      ),        
  ));
	
	
    Redux::setSection($opt_name, array(
        'icon'   => 'fa fa-arrow-circle-up',
        'title'  => __('Header', 'vg-calaco'),
        'fields' => array(),
	));
	
	Redux::setSection($opt_name, array(
        'icon'       => 'fa fa-angle-right',
        'title'      => __('Top Bar', 'vg-calaco'),
        'subsection' => true,
        'fields'     => array(
        
            array(
                'title' => __('Top Bar', 'vg-calaco'),
                'subtitle' => __('<em>Enable / Disable the Top Bar.</em>', 'vg-calaco'),
                'id' => 'top_bar_switch',
                'on' => __('Enabled', 'vg-calaco'),
                'off' => __('Disabled', 'vg-calaco'),
                'type' => 'switch',
                'default' => 1,
				'required' => array('demo_mode','=','0'),
			),
            
			array(
				'id'    => 'top_bar_warning',
				'type'  => 'info',
				'title' => __('Demo Mode is Enabled!', 'vg-calaco'),
				'style' => 'warning',
				'desc'  => __('Demo Mode is Enabled, please disable it to customize Top Bar.', 'vg-calaco'),
				'required' => array('demo_mode','=','1'),
			),
			
			array(
                'title' => __('Customize CSS', 'vg-calaco'),
                'subtitle' => __('<em>You can change background, font-size, font-color of Top Bar if enabled this option.</em>', 'vg-calaco'),
                'id' => 'top_bar_customize',
                'on' => __('Enabled', 'vg-calaco'),
                'off' => __('Disabled', 'vg-calaco'),
                'type' => 'switch',
                'default' => 0,
				'required' => array('top_bar_switch','=','1')
			),
			
			array(
                'id'            => 'top_bar_background',
                'type'          => 'background',
                'title'         => __('Top Bar Background', 'vg-calaco'),
                'subtitle'      => __('<em>Top Bar Background with image, color, etc.</em>', 'vg-calaco'),
                'default'  => array(
                    'background-color' => '#222222',
				),
                'transparent'   => false,
				'required' 		=> array('top_bar_customize','=','1'),
			),
			
			
			array(
                'title' => __('Top Bar Link Color', 'vg-calaco'),
                'subtitle' => __('<em>Specify the Top Bar Link Color.</em>', 'vg-calaco'),
                'id' => 'top_bar_link_color',
                'type' => 'color',
                'default' => '#fff',
                'transparent' => false,
                'required' => array('top_bar_customize','=','1')
			),
			
			array(
                'title' => __('Top Bar Link Hover Color', 'vg-calaco'),
                'subtitle' => __('<em>Specify the Top Bar Link Hover Color.</em>', 'vg-calaco'),
                'id' => 'top_bar_link_hover_color',
                'type' => 'color',
                'default' => '#81d742',
                'transparent' => false,
                'required' => array('top_bar_customize','=','1')
			),
		)
	));
	
	Redux::setSection($opt_name, array(
        'icon'       => 'fa fa-angle-right',
        'title'      => __('Middle Bar', 'vg-calaco'),
        'subsection' => true,
        'fields'     => array(
			
			array(
				'id'    => 'middle_bar_warning',
				'type'  => 'info',
				'title' => __('Demo Mode is Enabled!', 'vg-calaco'),
				'style' => 'warning',
				'desc'  => __('Demo Mode is Enabled, please disable it to customize Middle Bar.', 'vg-calaco'),
				'required' => array('demo_mode','=','1'),
			),
			
            array(
                'title' => __('Your Logo', 'vg-calaco'),
                'subtitle' => __('<em>Upload your logo image.</em>', 'vg-calaco'),
                'id' => 'site_logo',
                'type' => 'media',
                'default' => array(
                    'url' => '',
				),
				'required' => array('demo_mode','=','0'),
			),
            
            array(
                'title' => __('Alternative Logo', 'vg-calaco'),
                'subtitle' => __('<em>The Alternative Logo is used on the <strong>Mobile Devices</strong>.</em>', 'vg-calaco'),
                'id' => 'site_logo_mobile',
                'type' => 'media',
                'default' => array(
                    'url' => '',
				),
				'required' => array('demo_mode','=','0'),
			),
            
			array(
                'title' => __('Customize CSS', 'vg-calaco'),
                'subtitle' => __('<em>Allow you change background, font-size, font-color of Middle Bar. If Disabled, the theme will use default values from preset color.</em>', 'vg-calaco'),
                'id' => 'middle_bar_customize',
                'on' => __('Enabled', 'vg-calaco'),
                'off' => __('Disabled', 'vg-calaco'),
                'type' => 'switch',
                'default' => 0,	
				'required' => array('demo_mode','=','0'),
			),
			
            array(
                'title' => __('Logo Container Min Width', 'vg-calaco'),
                'subtitle' => __('<em>Drag the slider to set the logo container min width.</em>', 'vg-calaco'),
                'id' => 'logo_min_height',
                'type' => 'slider',
                "default" => 300,
                "min" => 0,
                "step" => 1,
                "max" => 600,
                'display_value' => 'text',
				'required' => array('middle_bar_customize','=','1')
			),
            
            array(
                'title' => __('Logo Height', 'vg-calaco'),
                'subtitle' => __('<em>Drag the slider to set the logo height <br/>(ignored if there\'s no uploaded logo).</em>', 'vg-calaco'),
                'id' => 'logo_height',
                'type' => 'slider',
                "default" => 46,
                "min" => 0,
                "step" => 1,
                "max" => 300,
                'display_value' => 'text',
				'required' => array('middle_bar_customize','=','1')
			),
            
			
			array(
                'id'            => 'middle_bar_background',
                'type'          => 'background',
                'title'         => __('Middle Bar Background', 'vg-calaco'),
                'subtitle'      => __('<em>The Middle Bar background with image, color, etc.</em>', 'vg-calaco'),
                'default'  => array(
                    'background-color' => '#ffffff',
				),
                'transparent'   => false,
				'required' 		=> array('middle_bar_customize','=','1'),
			),
		)
        
	));

    Redux::setSection($opt_name, array(
        'icon'       => 'fa fa-angle-right',
        'title'      => __('Menu Bar', 'vg-calaco'),
        'subsection' => true,
        'fields'     => array(
			
            array(
                'title' => __('Sticky Menu', 'vg-calaco'),
                'subtitle' => __('<em>Enable / Disable the Sticky Menu Bar.</em>', 'vg-calaco'),
                'id' => 'sticky_menu',
                'on' => __('Enabled', 'vg-calaco'),
                'off' => __('Disabled', 'vg-calaco'),
                'type' => 'switch',
                'default' => 0,
			),
            
			array(
				'id'    => 'menu_bar_warning',
				'type'  => 'info',
				'title' => __('Demo Mode is Enabled!', 'vg-calaco'),
				'style' => 'warning',
				'desc'  => __('Demo Mode is Enabled, please disable it to customize Menu Bar.', 'vg-calaco'),
				'required' => array('demo_mode','=','1'),
			),
			
			array(
                'title' => __('Sticky Logo', 'vg-calaco'),
                'subtitle' => __('<em>The Alternative Logo is used on the <strong>Sticky Menu</strong>.</em>', 'vg-calaco'),
                'id' => 'sticky_header_logo',
                'type' => 'media',
                'default' => array(
                    'url' => '',
				),
				'required' => array('demo_mode','=','0'),
			),
			
			array(
                'title' => __('Customize CSS', 'vg-calaco'),
                'subtitle' => __('<em>Allow you change background, font-size, font-color of Menu Bar. If Disabled, the theme will use default values from preset color.</em>', 'vg-calaco'),
                'id' => 'menu_bar_customize',
                'on' => __('Enabled', 'vg-calaco'),
                'off' => __('Disabled', 'vg-calaco'),
                'type' => 'switch',
                'default' => 0,	
				'required' => array('demo_mode','=','0'),
			),
            array(
                'id'            => 'menu_bar_background',
                'type'          => 'background',
                'title'         => __('Menu Bar Background', 'vg-calaco'),
                'subtitle'      => __('<em>The Menu Bar background with image, color, etc.</em>', 'vg-calaco'),
                'default'  => array(
                    'background-color' => '#ffffff',
				),
                'transparent'   => false,
				'required' 		=> array('menu_bar_customize','=','1'),
			),
			
			array(
				'id'            	=> 'menu_bar_text',
				'type'          	=> 'typography',
				'title'         	=> __('Menu Bar Text', 'vg-calaco'),
				'google'        	=> false,    // Disable google fonts. Won't work if you haven't defined your google api key
				'font-backup'   	=> false,    // Select a backup non-google font in addition to a google font
				'all_styles'    	=> false,    // Enable all Google Font style/weight variations to be added to the page
				'output'        	=> array('body'), // An array of CSS selectors to apply this font style to dynamically
				'units'         	=> 'px', // Defaults to px
				'subtitle'      	=> __('Menu Bar Text with color, font size, font weight...', 'vg-calaco'),
				'default'       	=> array(
					'color'         => '#000000',
					'font-weight'   => '400',
					'font-family' => 'Open Sans', 
					'font-size'     => '14px',
					'line-height'   => '20px'
				),
				'required' 			=> array('menu_bar_customize','=','1'),
			),
			array(
                'title' => __('Menu Bar Text Hover Color', 'vg-calaco'),
                'subtitle' => __('<em>Specify the Menu Bar Text Hover Color.</em>', 'vg-calaco'),
                'id' => 'menu_bar_text_hover_color',
                'type' => 'color',
                'default' => '#f00',
                'transparent' => false,
                'required' => array(
					array('menu_bar_customize','=','1'),					
				)
			),
		)
        
	));

    Redux::setSection($opt_name, array(
        'icon'    => 'fa fa-arrow-circle-down',
        'title'   => __('Footer', 'vg-calaco'),
        'fields'  => array(
            
			array(
				'id'    => 'footer_warning',
				'type'  => 'info',
				'title' => __('Demo Mode is Enabled!', 'vg-calaco'),
				'style' => 'warning',
				'desc'  => __('Demo Mode is Enabled, please disable it to customize Footer.', 'vg-calaco'),
				'required' => array('demo_mode','=','1'),
			),
			array(
                'title' => __('Logo Footer', 'vg-calaco'),
                'subtitle' => __('<em>The Alternative Logo is used on the <strong> Footer</strong>.</em>', 'vg-calaco'),
                'id' => 'logo_footer',
                'type' => 'media',
                'default' => array(
                    'url' => '',
				),
				'required' => array('demo_mode','=','0'),
			),
			
			array(
                'title' => __('Customize CSS', 'vg-calaco'),
                'subtitle' => __('<em>Allow you change background, font-size, font-color of Footer. If Disabled, the theme will use default values from preset color.</em>', 'vg-calaco'),
                'id' => 'footer_customize',
                'on' => __('Enabled', 'vg-calaco'),
                'off' => __('Disabled', 'vg-calaco'),
                'type' => 'switch',
                'default' => 0,	
				'required' => array('demo_mode','=','0'),
			),
			
            array(
                'id'            => 'footer_background',
                'type'          => 'background',
                'title'         => "Footer Background",
                'subtitle'      => "<em>Footer background with image, color, etc.</em>",
                'default'  => array(
                    'background-color' => '#1f1f1f',
				),
                'transparent'   => false,
				'required' 		=> array('footer_customize','=','1'),
			),
            array(
                'title' => __('Footer Text', 'vg-calaco'),
                'subtitle' => __('<em>Specify the Footer Text Color.</em>', 'vg-calaco'),
                'id' => 'footer_texts_color',
                'type' => 'color',
                'transparent' => false,
                'default' => '#fff',
				'required' => array('footer_customize','=','1'),
			),
            
            array(
                'title' => __('Footer Links(Hover)', 'vg-calaco'),
                'subtitle' => __('<em>Specify the Footer Links Color.</em>', 'vg-calaco'),
                'id' => 'footer_links_color_hover',
                'type' => 'color',
                'transparent' => false,
                'default' => '#EC7A5C',
				'required' => array('footer_customize','=','1'),
			),
            
		)
        
	));
	Redux::setSection($opt_name, array(
        'icon'       => 'fa fa-angle-right',
        'title'      => __('Bottom Footer', 'vg-calaco'),
        'subsection' => true,
        'fields'  => array(
            
			array(
				'id'    => 'bottom_footer_warning',
				'type'  => 'info',
				'title' => __('Demo Mode is Enabled!', 'vg-calaco'),
				'style' => 'warning',
				'desc'  => __('Demo Mode is Enabled, please disable it to customize Bottom Footer.', 'vg-calaco'),
				'required' => array('demo_mode','=','1'),
			),
			
			array(
                'title' => __('Customize CSS', 'vg-calaco'),
                'subtitle' => __('<em>Allow you change background, font-size, font-color of Bottom Footer. If Disabled, the theme will use default values from preset color.</em>', 'vg-calaco'),
                'id' => 'bottom_footer_customize',
                'on' => __('Enabled', 'vg-calaco'),
                'off' => __('Disabled', 'vg-calaco'),
                'type' => 'switch',
                'default' => 0,	
				'required' => array('demo_mode','=','0'),
			),
			
            array(
                'id'            => 'bottom_footer_background',
                'type'          => 'background',
                'title'         => "Bottom Footer Background",
                'subtitle'      => "<em>Footer background with image, color, etc.</em>",
                'default'  => array(
                    'background-color' => '#101010',
				),
                'transparent'   => false,
				'required' 		=> array('bottom_footer_customize','=','1'),
			),
			array(
                'id'            => 'footer_menu_background',
                'type'          => 'background',
                'title'         => "Footer Menu Background",
                'subtitle'      => "<em>Footer Menu background with image, color, etc.</em>",
                'default'  => array(
                    'background-color' => '#101010',
				),
                'transparent'   => false,
				'required' 		=> array('bottom_footer_customize','=','1'),
			),
            array(
                'title' => __('Bottom Footer Text', 'vg-calaco'),
                'subtitle' => __('<em>Specify the Bottom Footer Text Color.</em>', 'vg-calaco'),
                'id' => 'bottom_footer_texts_color',
                'type' => 'color',
                'transparent' => false,
                'default' => '#fff',
				'required' => array('bottom_footer_customize','=','1'),
			),
            array(
                'title' => __('Bottom Footer Links', 'vg-calaco'),
                'subtitle' => __('<em>Specify the Bottom Footer Links Color.</em>', 'vg-calaco'),
                'id' => 'bottom_footer_links_color',
                'type' => 'color',
                'transparent' => false,
                'default' => '#fff',
				'required' => array('bottom_footer_customize','=','1'),
			),
            array(
                'title' => __('Bottom Footer Links(Hover)', 'vg-calaco'),
                'subtitle' => __('<em>Specify the Bottom Footer Links Color Hover.</em>', 'vg-calaco'),
                'id' => 'bottom_footer_links_color_hover',
                'type' => 'color',
                'transparent' => false,
                'default' => '#EC7A5C',
				'required' => array('bottom_footer_customize','=','1'),
			),
		)
	));
	
    Redux::setSection($opt_name, array(
        'icon'   => 'fa fa-list-alt',
        'title'  => __('Blog', 'vg-calaco'),
        'fields' => array(
			array(
                'id'       => 'default_blog_sidebar',
                'type'     => 'image_select',
                'compiler' => true,
                'title'    => __('Default Sidebar', 'vg-calaco'),
                'subtitle' => __('<em>Select the default blog sidebar for your website.</em>', 'vg-calaco'),
                'options'  => array(
                    'left' => array(
                        'alt' => __('Lef Sidebar', 'vg-calaco'),
                        'img' => get_template_directory_uri() . '/assets/images/theme_options/sidebar_1.png'
					),
                    'right' => array(
                        'alt' => __('Right Sidebar', 'vg-calaco'),
                        'img' => get_template_directory_uri() . '/assets/images/theme_options/sidebar_2.png'
					),
                    'none' => array(
                        'alt' => __('Without Sidebar', 'vg-calaco'),
                        'img' => get_template_directory_uri() . '/assets/images/theme_options/sidebar_3.png'
					),
				),
                'default'  => 'left',
			),
			array(
                'title' => __('Number of Post per Column', 'vg-calaco'),
                'subtitle' => __('<em>Drag the slider to set the number of post per column <br />to be listed on the category post.</em>', 'vg-calaco'),
                'id' => 'posts_per_column',
                'min' => '1',
                'step' => '1',
                'max' => '4',
                'type' => 'slider',
                'default' => '1',
			),
		)
        
	));

    Redux::setSection($opt_name, array(
        'icon'   => 'fa fa-shopping-cart',
        'title'  => __('Shop', 'vg-calaco'),
        'fields' => array(
            
			array(
				'id'       => 'default_woo_hover_effect',
				'subtitle' => esc_html__('Select default product hover effect.', 'vg-calaco'),
				'type'     => 'select',
				'multi'    => false,
				'title'    => esc_html__('Hover Effect', 'vg-calaco'),
				'options'  => array(
					'default' => 'Default',
					'effect-1' => 'Effect 01',
					'effect-2' => 'Effect 02',
					'effect-3' => 'Effect 03',
				),
				'default'  => 'default'
			),
			
            array(
                'title' => __('Quick View', 'vg-calaco'),
                'subtitle' => __('<em>Enable / Disable the quick view modal.</em>', 'vg-calaco'),
                'desc' => __('<em>When enabled, the feature Turns On the quick view functionality.</em>', 'vg-calaco'),
                'id' => 'quick_view',
                'on' => __('Enabled', 'vg-calaco'),
                'off' => __('Disabled', 'vg-calaco'),
                'type' => 'switch',
				'default' => 1,
			),
			
            array(
                'title' => __('Second Image on Catalog Page(Hover)', 'vg-calaco'),
                'subtitle' => __('<em>Change to display second image when hover on product image.</em>', 'vg-calaco'),
                'id' => 'second_image_product_listing',
                'on' => __('Enabled', 'vg-calaco'),
                'off' => __('Disabled', 'vg-calaco'),
                'type' => 'switch',
                'default' => 1,
			),
            
            array(
                'id'       => 'default_shop_sidebar',
                'type'     => 'image_select',
                'compiler' => true,
                'title'    => __('Default Sidebar', 'vg-calaco'),
                'subtitle' => __('<em>Select the default blog sidebar for your website.</em>', 'vg-calaco'),
                'options'  => array(
                    'left' => array(
                        'alt' => __('Lef Sidebar', 'vg-calaco'),
                        'img' => get_template_directory_uri() . '/assets/images/theme_options/sidebar_1.png'
					),
                    'right' => array(
                        'alt' => __('Right Sidebar', 'vg-calaco'),
                        'img' => get_template_directory_uri() . '/assets/images/theme_options/sidebar_2.png'
					),
                    'none' => array(
                        'alt' => __('Without Sidebar', 'vg-calaco'),
                        'img' => get_template_directory_uri() . '/assets/images/theme_options/sidebar_3.png'
					),
				),
                'default'  => 'left',
			),
			
            array(
				'id'       	=> 'default_view_mode',
				'type'     => 'image_select',
				'title'    	=> esc_html__('Category View Mode', 'vg-calaco'),
				'subtitle'      => esc_html__('Display products in Grid or List layout.', 'vg-calaco'),
				'options'  	=> array(
					'gridview' 	=> array(
                        'alt' => __('Grid View', 'vg-calaco'),
                        'img' => get_template_directory_uri() . '/assets/images/theme_options/Grid_view.png'
					),
					'listview' => array(
                        'alt' => __('List View', 'vg-calaco'),
                        'img' => get_template_directory_uri() . '/assets/images/theme_options/list_view.png'
					),
				),
				'default'  	=> 'gridview'
			),
			
            array(
                'title' => __('Number of Products per Column', 'vg-calaco'),
                'subtitle' => __('<em>Drag the slider to set the number of products per column <br />to be listed on the shop page and catalog pages.</em>', 'vg-calaco'),
                'id' => 'products_per_column',
                'min' => '2',
                'step' => '1',
                'max' => '4',
                'type' => 'slider',
                'default' => '3',
			),
            
            array(
                'title' => __('Number of Products per Page', 'vg-calaco'),
                'subtitle' => __('<em>Drag the slider to set the number of products per page <br />to be listed on the shop page and catalog pages.</em>', 'vg-calaco'),
                'id' => 'products_per_page',
                'min' => '1',
                'step' => '1',
                'max' => '48',
                'type' => 'slider',
                'edit' => '1',
                'default' => '9',
			),
            
            array(
                'title' => __('Featured Label', 'vg-calaco'),
                'subtitle' => __('<em>Out of Stock label text.</em>', 'vg-calaco'),
                'id' => 'hot_label',
                'type' => 'text',
                'default' => 'Hot',
			),

            array(
                'title' => __('Sale Label', 'vg-calaco'),
                'subtitle' => __('<em>Sale label text.</em>', 'vg-calaco'),
                'id' => 'sale_label',
                'type' => 'text',
                'default' => 'Sale',
			),
            
		)
        
	));

    Redux::setSection($opt_name, array(
        'icon'   => 'fa fa-archive',
        'title'  => __('Product Page', 'vg-calaco'),
        'fields' => array(
            
			array(
                'title' => __('Column of Thumbnail Images', 'vg-calaco'),
                'subtitle' => __('<em>Drag the slider to set the number of Thumbnail Images will visible in carousel.</em>', 'vg-calaco'),
                'id' => 'column_thumbnail_images',
                'type' => 'slider',
                "default" => 4,
                "min" => 1,
                "step" => 1,
                "max" => 6,
                'display_value' => 'text',
			),
			
            array(
                'title' => __('Related Products', 'vg-calaco'),
                'subtitle' => __('<em>Enable / Disable Related Products.<em>', 'vg-calaco'),
                'id' => 'related_products',
                'on' => __('Enabled', 'vg-calaco'),
                'off' => __('Disabled', 'vg-calaco'),
                'type' => 'switch',
                'default' => 1,
			),
            
			array(
                'title' => __('Total Related Products', 'vg-calaco'),
                'subtitle' => __('<em>Drag the slider to set the Total Related Products will display in carousel.</em>', 'vg-calaco'),
                'id' => 'total_related_products',
                'type' => 'slider',
                "default" => 6,
                "min" => 1,
                "step" => 1,
                "max" => 12,
                'display_value' => 'text',
				'required' => array('related_products','=','1')
			),
			
			array(
                'title' => __('Column of Related Products', 'vg-calaco'),
                'subtitle' => __('<em>Drag the slider to set the number of Product will visible in carousel.</em>', 'vg-calaco'),
                'id' => 'column_related_products',
                'type' => 'slider',
                "default" => 4,
                "min" => 1,
                "step" => 1,
                "max" => 6,
                'display_value' => 'text',
				'required' => array('related_products','=','1')
			),
			
            array(
                'title' => __('Sharing Options', 'vg-calaco'),
                'subtitle' => __('<em>Enable / Disable Sharing Options.<em>', 'vg-calaco'),
                'id' => 'sharing_options',
                'on' => __('Enabled', 'vg-calaco'),
                'off' => __('Disabled', 'vg-calaco'),
                'type' => 'switch',
                'default' => 1,
			),
            
		)
        
	));
	
	Redux::setSection($opt_name, array(
        'icon'   => 'fa fa-image',
        'title'  => __('Brand Logos', 'vg-calaco'),
        'fields' => array(
		
			array(
				'id'          => 'brand_logos',
				'type'        => 'slides',
				'title'       => __('Brand Logos Manager', 'vg-calaco'),				
				'placeholder' => array(
					'title'           => __('This is a title', 'vg-calaco'),
					'description'     => __('Description Here', 'vg-calaco'),
					'url'             => __('Give us a link!', 'vg-calaco'),
				),
			),
			
		)
	));
	
    Redux::setSection($opt_name, array(
        'icon'   => 'fa fa-paint-brush',
        'title'  => __('Styling', 'vg-calaco'),
        'fields' => array(
            array(
				'id'       => 'effect_banner',
				'title'     => esc_html__('Images Banner', 'vg-calaco'),
				'subtitle' => esc_html__('Hover Effect Images Banner', 'vg-calaco'),
				'type'     => 'select',
				'options'  => array(
					'style-0' 	=> 'No Effect',
					'style-1' 	=> 'Effect Style 1',
					'style-2' 	=> 'Effect Style 2',
					'style-3' 	=> 'Effect Style 3',
					'style-4' 	=> 'Effect Style 4',
				),
				'default'  => 'style-1'
			),
			array(
				'id'    => 'styling_warning',
				'type'  => 'info',
				'title' => __('Demo Mode is Enabled!', 'vg-calaco'),
				'style' => 'warning',
				'desc'  => __('Demo Mode is Enabled, please disable it to customize the Styling of the theme.', 'vg-calaco'),
				'required' => array('demo_mode','=','1'),
			),
			
			array(
                'title' => __('Customize Styling', 'vg-calaco'),
                'subtitle' => __('<em>Allow you customize the Styling of the theme. If Disabled, the theme will use default values from preset color.</em>', 'vg-calaco'),
                'id' => 'styling_customize',
                'on' => __('Enabled', 'vg-calaco'),
                'off' => __('Disabled', 'vg-calaco'),
                'type' => 'switch',
                'default' => 0,	
				'required' => array('demo_mode','=','0'),
			),
			
            array(
                'title' => __('Body Texts Color', 'vg-calaco'),
                'subtitle' => __('<em>Body Texts Color of the site.</em>', 'vg-calaco'),
                'id' => 'body_color',
                'type' => 'color',
                'transparent' => false,
                'default' => '#545454',
				'required' => array('styling_customize','=','1'),
			),
            
            array(
                'title' => __('Headings Color', 'vg-calaco'),
                'subtitle' => __('<em>Headings Color of the site.</em>', 'vg-calaco'),
                'id' => 'headings_color',
                'type' => 'color',
                'transparent' => false,
                'default' => '#000000',
				'required' => array('styling_customize','=','1'),
			),
            
            array(
                'title' => __('Main Theme Color', 'vg-calaco'),
                'subtitle' => __('<em>The main color of the site.</em>', 'vg-calaco'),
                'id' => 'main_color',
                'type' => 'color',
                'transparent' => false,
                'default' => '#5dac6c',
				'required' => array('styling_customize','=','1'),
			),
            
            array(
                'id'            => 'main_background',
                'type'          => 'background',
                'title'         => "Body Background",
                'subtitle'      => "<em>Body background with image, color, etc.</em>",
                'default'  => array(
                    'background-color' => '#fff',
				),
                'transparent'   => false,
				'required' 		=> array('styling_customize','=','1'),
			),
            
		)
        
	));

    Redux::setSection($opt_name, array(
        'icon'   => 'fa fa-font',
        'title'  => __('Typography', 'vg-calaco'),
        'fields' => array(

            array(
				'id'    => 'typography_warning',
				'type'  => 'info',
				'title' => __('Demo Mode is Enabled!', 'vg-calaco'),
				'style' => 'warning',
				'desc'  => __('Demo Mode is Enabled, please disable it to customize Typography of the theme.', 'vg-calaco'),
				'required' => array('demo_mode','=','1'),
			),
			
			array(
                'title' => __('Customize Typography', 'vg-calaco'),
                'subtitle' => __('<em>Allow you customize Typography of the theme. If Disabled, the theme will use default values from preset color.</em>', 'vg-calaco'),
                'id' => 'typography_customize',
                'on' => __('Enabled', 'vg-calaco'),
                'off' => __('Disabled', 'vg-calaco'),
                'type' => 'switch',
                'default' => 0,	
				'required' => array('demo_mode','=','0'),
			),
			
            array(
                'id' => 'source_fonts_info',
                'icon' => true,
                'type' => 'info',
                'raw' => __('<h3 style="margin: 0;"><i class="fa fa-font"></i> Font Sources</h3>', 'vg-calaco'),
				'required' => array('typography_customize','=','1'),
			),
            
            array(
                'title'    => __('Font Source', 'vg-calaco'),
                'subtitle' => __('<em>Choose the Font Source</em>', 'vg-calaco'),
                'id'       => 'font_source',
                'type'     => 'radio',
                'options'  => array(
                    '1' => 'Standard + Google Webfonts',
                    '2' => 'Google Custom',
                    '3' => 'Adobe Typekit'
				),
                'default' => '2',
				'required' => array('typography_customize','=','1'),
			),
            
            // Google Code
            array(
                'id'=>'font_google_code',
                'type' => 'text',
                'title' => __('Google Code', 'vg-calaco'), 
                'subtitle' => __('<em>Paste the provided Google Code</em>', 'vg-calaco'),
                'default' => 'https://fonts.googleapis.com/css?family=Open+Sans:400,600i,700',
                'required' => array(
					array('font_source','=','2'),
					array('typography_customize','=','1')
				)
			),
            
            // Typekit ID
            array(
                'id'=>'font_typekit_kit_id',
                'type' => 'text',
                'title' => __('Typekit Kit ID', 'vg-calaco'), 
                'subtitle' => __('<em>Paste the provided Typekit Kit ID.</em>', 'vg-calaco'),
                'default' => '',
                'required' => array(
					array('font_source','=','3'),
					array('typography_customize','=','1')
				)
			),
            
            array(
                'id' => 'main_font_info',
                'icon' => true,
                'type' => 'info',
                'raw' => __('<h3 style="margin: 0;"><i class="fa fa-font"></i> Main Font</h3>', 'vg-calaco'),
				'required' => array('typography_customize','=','1'),
			),
            
            // Standard + Google Webfonts
            array(
                'title' => __('Font Face', 'vg-calaco'),
                'subtitle' => __('<em>Pick the Main Font for your site.</em>', 'vg-calaco'),
                'id' => 'main_font',
                'type' => 'typography',
                'line-height' => false,
                'text-align' => false,
                'font-style' => false,
                'font-weight' => false,
                'all_styles'=> true,
                'font-size' => false,
                'color' => false,
                'default' => array(
                    'font-family' => 'Montserrat',
                    'subsets' => '',
				),
                'required' => array(
					array('font_source','=','1'),
					array('typography_customize','=','1')
				)
			),
            
            // Google Custom                        
            array(
                'title' => __('Google Font Face', 'vg-calaco'),
                'subtitle' => __('<em>Enter your Google Font Name for the theme\'s Main Typography</em>', 'vg-calaco'),
                'desc' => __('e.g.: open sans', 'vg-calaco'),
                'id' => 'main_google_font_face',
                'type' => 'text',
                'default' => 'Open Sans',
                'required' => array(
					array('font_source','=','2'),
					array('typography_customize','=','1')
				)
			),
            
            // Adobe Typekit                        
            array(
                'title' => __('Typekit Font Face', 'vg-calaco'),
                'subtitle' => __('<em>Enter your Typekit Font Name for the theme\'s Main Typography</em>', 'vg-calaco'),
                'desc' => __('e.g.: futura-pt', 'vg-calaco'),
                'id' => 'main_typekit_font_face',
                'type' => 'text',
                'default' => '',
                'required' => array(
					array('font_source','=','3'),
					array('typography_customize','=','1')
				)
			),              
            
            
            array(
                'id' => 'secondary_font_info',
                'icon' => true,
                'type' => 'info',
                'raw' => __('<h3 style="margin: 0;"><i class="fa fa-font"></i> Secondary Font</h3>', 'vg-calaco'),
				'required' => array('typography_customize','=','1'),
			),
            
            // Standard + Google Webfonts
            array(
                'title' => __('Font Face', 'vg-calaco'),
                'subtitle' => __('<em>Pick the Secondary Font for your site.</em>', 'vg-calaco'),
                'id' => 'secondary_font',
                'type' => 'typography',
                'line-height' => false,
                'text-align' => false,
                'font-style' => false,
                'font-weight' => false,
                'all_styles'=> true,
                'font-size' => false,
                'color' => false,
                'default' => array(
                    'font-family' => 'Pontano Sans',
                    'subsets' => '',
				),
                'required' => array(
					array('font_source','=','1'),
					array('typography_customize','=','1')
				)
                
			),
            
            // Google Custom                        
            array(
                'title' => __('Google Font Face', 'vg-calaco'),
                'subtitle' => __('<em>Enter your Google Font Name for the theme\'s Secondary Typography</em>', 'vg-calaco'),
                'desc' => __('e.g.: open sans', 'vg-calaco'),
                'id' => 'secondary_google_font_face',
                'type' => 'text',
                'default' => 'Open Sans',
                'required' => array(
					array('font_source','=','2'),
					array('typography_customize','=','1')
				)
			),
            
            // Adobe Typekit                        
            array(
                'title' => __('Typekit Font Face', 'vg-calaco'),
                'subtitle' => __('<em>Enter your Typekit Font Name for the theme\'s Secondary Typography</em>', 'vg-calaco'),
                'desc' => __('e.g.: futura-pt', 'vg-calaco'),
                'id' => 'secondary_typekit_font_face',
                'type' => 'text',
                'default' => '',
                'required' => array(
					array('font_source','=','3'),
					array('typography_customize','=','1')
				)
			),
              
		)
        
	));

    Redux::setSection($opt_name, array(
        'icon'   => 'fa fa-share-alt-square',
        'title'  => __('Social Media', 'vg-calaco'),
        'fields' => array(
            
            array(
                'title' => __('<i class="fa fa-facebook"></i> Facebook', 'vg-calaco'),
                'subtitle' => __('<em>Type your Facebook profile URL here.</em>', 'vg-calaco'),
                'id' => 'facebook_link',
                'type' => 'text',
                'default' => 'https://www.facebook.com/VinaWebSolutions',
			),
            
            array(
                'title' => __('<i class="fa fa-twitter"></i> Twitter', 'vg-calaco'),
                'subtitle' => __('<em>Type your Twitter profile URL here.</em>', 'vg-calaco'),
                'id' => 'twitter_link',
                'type' => 'text',
                'default' => 'http://twitter.com/vnwebsolutions',
			),
            
            array(
                'title' => __('<i class="fa fa-pinterest"></i> Pinterest', 'vg-calaco'),
                'subtitle' => __('<em>Type your Pinterest profile URL here.</em>', 'vg-calaco'),
                'id' => 'pinterest_link',
                'type' => 'text',
                'default' => 'http://www.pinterest.com/',
			),
            
            array(
                'title' => __('<i class="fa fa-linkedin"></i> LinkedIn', 'vg-calaco'),
                'subtitle' => __('<em>Type your LinkedIn profile URL here.</em>', 'vg-calaco'),
                'id' => 'linkedin_link',
                'type' => 'text',
			),
            
            array(
                'title' => __('<i class="fa fa-google-plus"></i> Google+', 'vg-calaco'),
                'subtitle' => __('<em>Type your Google+ profile URL here.</em>', 'vg-calaco'),
                'id' => 'googleplus_link',
                'type' => 'text',
			),
            
            array(
                'title' => __('<i class="fa fa-rss"></i> RSS', 'vg-calaco'),
                'subtitle' => __('<em>Type your RSS Feed URL here.</em>', 'vg-calaco'),
                'id' => 'rss_link',
                'type' => 'text',
			),
            
            array(
                'title' => __('<i class="fa fa-tumblr"></i> Tumblr', 'vg-calaco'),
                'subtitle' => __('<em>Type your Tumblr URL here.</em>', 'vg-calaco'),
                'id' => 'tumblr_link',
                'type' => 'text',
			),
            
            array(
                'title' => __('<i class="fa fa-instagram"></i> Instagram', 'vg-calaco'),
                'subtitle' => __('<em>Type your Instagram profile URL here.</em>', 'vg-calaco'),
                'id' => 'instagram_link',
                'type' => 'text',
                'default' => '',
			),
            
            array(
                'title' => __('<i class="fa fa-youtube-play"></i> Youtube', 'vg-calaco'),
                'subtitle' => __('<em>Type your Youtube profile URL here.</em>', 'vg-calaco'),
                'id' => 'youtube_link',
                'type' => 'text',
                'default' => '',
			),
            
            array(
                'title' => __('<i class="fa fa-vimeo-square"></i> Vimeo', 'vg-calaco'),
                'subtitle' => __('<em>Type your Vimeo profile URL here.</em>', 'vg-calaco'),
                'id' => 'vimeo_link',
                'type' => 'text',
			),
            
            array(
                'title' => __('<i class="fa fa-behance"></i> Behance', 'vg-calaco'),
                'subtitle' => __('<em>Type your Behance profile URL here.</em>', 'vg-calaco'),
                'id' => 'behance_link',
                'type' => 'text',
			),
            
            array(
                'title' => __('<i class="fa fa-dribbble"></i> Dribble', 'vg-calaco'),
                'subtitle' => __('<em>Type your Dribble profile URL here.</em>', 'vg-calaco'),
                'id' => 'dribble_link',
                'type' => 'text',
			),
            
            array(
                'title' => __('<i class="fa fa-flickr"></i> Flickr', 'vg-calaco'),
                'subtitle' => __('<em>Type your Flickr profile URL here.</em>', 'vg-calaco'),
                'id' => 'flickr_link',
                'type' => 'text',
			),
            
            array(
                'title' => __('<i class="fa fa-git"></i> Git', 'vg-calaco'),
                'subtitle' => __('<em>Type your Git profile URL here.</em>', 'vg-calaco'),
                'id' => 'git_link',
                'type' => 'text',
			),
            
            array(
                'title' => __('<i class="fa fa-skype"></i> Skype', 'vg-calaco'),
                'subtitle' => __('<em>Type your Skype profile URL here.</em>', 'vg-calaco'),
                'id' => 'skype_link',
                'type' => 'text',
			),
            
            array(
                'title' => __('<i class="fa fa-weibo"></i> Weibo', 'vg-calaco'),
                'subtitle' => __('<em>Type your Weibo profile URL here.</em>', 'vg-calaco'),
                'id' => 'weibo_link',
                'type' => 'text',
			),
            
            array(
                'title' => __('<i class="fa fa-foursquare"></i> Foursquare', 'vg-calaco'),
                'subtitle' => __('<em>Type your Foursquare profile URL here.</em>', 'vg-calaco'),
                'id' => 'foursquare_link',
                'type' => 'text',
			),
            
            array(
                'title' => __('<i class="fa fa-soundcloud"></i> Soundcloud', 'vg-calaco'),
                'subtitle' => __('<em>Type your Soundcloud profile URL here.</em>', 'vg-calaco'),
                'id' => 'soundcloud_link',
                'type' => 'text',
			),

            array(
                'title' => __('<i class="fa fa-vk"></i> VK', 'vg-calaco'),
                'subtitle' => __('<em>Type your VK profile URL here.</em>', 'vg-calaco'),
                'id' => 'vk_link',
                'type' => 'text',
			),
            
		)
        
	));
	
	Redux::setSection($opt_name, array(
        'icon'   => 'fa fa-exchange',
        'title'  => __('Owl Carousel', 'vg-calaco'),
        'fields' => array(
            array(
				'id' 		=> 'slide_speed',
                'title' 	=> __('Slide Speed(ms)', 'vg-calaco'),
                'desc' 		=> __('<em>Slide speed in milliseconds. Only use numeric. Default: 200.</em>', 'vg-calaco'),
                'type' 		=> 'text',
                'default' 	=> '200',                
			),
			array(
				'id' 		=> 'pagination_speed',
                'title' 	=> __('Pagination Speed(ms)', 'vg-calaco'),
                'desc' 		=> __('<em>Pagination speed in milliseconds. Only use numeric. Default: 800.</em>', 'vg-calaco'),
                'type' 		=> 'text',
                'default' 	=> '800',                
			),
			array(
                'title' 	=> __('Rewind Speed(ms)', 'vg-calaco'),
                'desc' 		=> __('<em>Rewind speed in milliseconds. Only use numeric. Default: 1000.</em>', 'vg-calaco'),
                'id' 		=> 'rewind_speed',
                'type' 		=> 'text',
                'default' 	=> '1000',                
			),
			array(
                'title' 	=> __('Autoplay', 'vg-calaco'),
				'desc' 		=>__('<em>Enable/disable autoplay for all carousel.</em>', 'vg-calaco'),
                'id' 		=> 'auto_play',
                'on' 		=> __('Enabled', 'vg-calaco'),
                'off' 		=> __('Disabled', 'vg-calaco'),
                'type' 		=> 'switch',
                'default' 	=> 0,
			),
			array(
                'title' 	=> __('Autoplay Speed(ms)', 'vg-calaco'),
                'desc' 		=> __('<em>Autoplay speed in milliseconds. Only use numeric. Default: 5000.</em>', 'vg-calaco'),
                'id' 		=> 'autoplay_speed',
                'type' 		=> 'text',
                'default' 	=> '5000', 
				'required'	=> array('auto_play', '=', array('1')),
			),
			array(
                'title' 	=> __('Stop on Hover', 'vg-calaco'),
				'desc' 		=>__('<em>Enable/disable stop carousel when mouse hover function.</em>', 'vg-calaco'),
                'id' 		=> 'stop_hover',
                'on' 		=> __('Enabled', 'vg-calaco'),
                'off' 		=> __('Disabled', 'vg-calaco'),
                'type' 		=> 'switch',
                'default' 	=> 0,
			),
			array(
                'title' 	=> __('Rewind Nav', 'vg-calaco'),
				'desc' 		=>__('<em>Slide to first item. Use rewindSpeed to change animation speed.</em>', 'vg-calaco'),
                'id' 		=> 'rewind_nav',
                'on' 		=> __('Enabled', 'vg-calaco'),
                'off' 		=> __('Disabled', 'vg-calaco'),
                'type' 		=> 'switch',
                'default' 	=> 1,
			),
			array(
                'title' 	=> __('Scroll per Page', 'vg-calaco'),
				'desc' 		=>__('<em>Scroll per page not per item. This affect next/prev buttons and mouse/touch dragging.</em>', 'vg-calaco'),
                'id' 		=> 'scroll_page',
                'on' 		=> __('Enabled', 'vg-calaco'),
                'off' 		=> __('Disabled', 'vg-calaco'),
                'type' 		=> 'switch',
                'default' 	=> 0,
			),
			array(
                'title' 	=> __('Mouse Drag', 'vg-calaco'),
				'desc' 		=>__('<em>Enable/disable mouse drag function.</em>', 'vg-calaco'),
                'id' 		=> 'mouse_drag',
                'on' 		=> __('Enabled', 'vg-calaco'),
                'off' 		=> __('Disabled', 'vg-calaco'),
                'type' 		=> 'switch',
                'default' 	=> 1,
			),
			array(
                'title' 	=> __('Touch Drag', 'vg-calaco'),
				'desc' 		=>__('<em>Enable/disable touch drag function.</em>', 'vg-calaco'),
                'id' 		=> 'touch_drag',
                'on' 		=> __('Enabled', 'vg-calaco'),
                'off' 		=> __('Disabled', 'vg-calaco'),
                'type' 		=> 'switch',
                'default' 	=> 1,
			),
		)
        
	));
	
   Redux::setSection($opt_name, array(
        'icon'   => 'fa fa-code',
        'title'  => __('Custom Code', 'vg-calaco'),
        'fields' => array(
            
            array(
                'title' => __('Custom CSS', 'vg-calaco'),
                'subtitle' => __('<em>Paste your custom CSS code here.</em>', 'vg-calaco'),
                'id' => 'custom_css',
                'type' => 'ace_editor',
                'mode' => 'css',
            ),
            
            array(
                'title' => __('Custom JavaScript Code', 'vg-calaco'),
                'subtitle' => __('<em>Paste your custom JS code here. The code will be added to your site.</em>', 'vg-calaco'),
                'id' => 'custom_js',
                'type' => 'ace_editor',
                'mode' => 'javascript',
            ),
            
        )
        
    ));

    /*
     * <--- END SECTIONS
     */

