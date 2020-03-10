<?php

/**
 * TGM Init Class
 */
get_template_part('admin/tgm/class-tgm-plugin-activation');

function vg_calaco_register_required_plugins() {

	$plugins = array(
		array(
            'name'       => esc_html__('Redux Framework', 'vg-calaco'),
            'slug'       => 'redux-framework',
            'required'   => true,
        ),
		array(
            'name'      => esc_html__('Visual Composer', 'vg-calaco'),
            'slug'      => 'js_composer',
            'source'    => esc_url('http://wordpress.vinagecko.net/l/js_composer.zip'),
            'required'  => true,
		),
		array(
            'name'      => esc_html__('VG Helper', 'vg-calaco'),
            'slug'      => 'vg-helper',
            'source'    => esc_url('http://wordpress.vinagecko.net/l/vg-helper.zip'),
            'required'  => true,
		),
		array(
            'name'      => esc_html__('WooCommerce', 'vg-calaco'),
            'slug'      => 'woocommerce',
            'required'  => true,
		),
		array(
            'name'      => esc_html__('One Click Demo Import', 'vg-calaco'),
            'slug'      => 'one-click-demo-import',
            'required'  => true,
		),
		array(
            'name'      => esc_html__('Projects by WooThemes', 'vg-calaco'),
            'slug'      => 'projects-by-woothemes',
            'required'  => true,
		),
		array(
            'name'      => esc_html__('YITH WooCommerce Compare', 'vg-calaco'),
            'slug'      => 'yith-woocommerce-compare',
            'required'  => true,
            ),
        array(
            'name'      => esc_html__('YITH WooCommerce Wishlist', 'vg-calaco'),
            'slug'      => 'yith-woocommerce-wishlist',
            'required'  => true,
        ),
		array(
            'name'      => esc_html__('Revolution Slider', 'vg-calaco'),
            'slug'      => 'revslider',
            'source'    => esc_url('http://wordpress.vinagecko.net/l/revslider.zip'),
            'required'  => true,
		),
		array(
            'name'      => esc_html__('Contact Form 7', 'vg-calaco'),
            'slug'      => 'contact-form-7',
            'required'  => true,
        ), 
	);

	$config = array(
		'domain'       		=> 'vg-calaco',         			// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_slug'       => 'plugins.php',
		'capability'        => 'manage_options',
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> true,					   	// Automatically activate plugins after installation or not
	);

	tgmpa($plugins, $config);

}
add_action('tgmpa_register', 'vg_calaco_register_required_plugins');