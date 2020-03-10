<?php
$fields[] = array(
	'id'              => 'cart_checkout_link',
	'section'         => 'footer',
	'label'           => esc_html__( 'Cart Checkout Action', 'woo-floating-cart' ),
	'type'            => 'radio-buttonset',
	'choices'         => array(
		'checkout' => esc_attr__( 'Go to Checkout Page', 'woo-floating-cart' ),
		'cart'     => esc_attr__( 'Go to Cart Page', 'woo-floating-cart' )
	),
	'default'         => 'checkout',
	'active_callback' => array(
		array(
			'setting'  => 'cart_checkout_form',
			'operator' => '==',
			'value'    => '0',
		),
	),
);

$fields[] = array(
	'id'        => 'cart_checkout_button_bg_color',
	'section'   => 'footer',
	'label'     => esc_html__( 'Cart Checkout Button Bg Color', 'woo-floating-cart' ),
	'type'      => 'color-alpha',
	'default'   => '#2c97de',
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => '.xt_woofc-inner a.xt_woofc-checkout',
			'property' => 'background',
		)
	)
);
$fields[] = array(
	'id'        => 'cart_checkout_button_bg_hover_color',
	'section'   => 'footer',
	'label'     => esc_html__( 'Cart Checkout Button Bg Hover Color', 'woo-floating-cart' ),
	'type'      => 'color-alpha',
	'default'   => '#2c97de',
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => array(
				'.xt_woofc-no-touchevents .xt_woofc-inner a.xt_woofc-checkout:hover',
				'.xt_woofc-touchevents .xt_woofc-inner a.xt_woofc-checkout:focus'
			),
			'property' => 'background',
		)
	)
);

$fields[] = array(
	'id'        => 'cart_checkout_button_text_color',
	'section'   => 'footer',
	'label'     => esc_html__( 'Cart Checkout Button Text Color', 'woo-floating-cart' ),
	'type'      => 'color-alpha',
	'default'   => '#ffffff',
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => '.xt_woofc-cart-open .xt_woofc-inner a.xt_woofc-checkout',
			'property' => 'color',
		)
	)
);

$fields[] = array(
	'id'        => 'cart_checkout_button_text_hover_color',
	'section'   => 'footer',
	'label'     => esc_html__( 'Cart Checkout Button Text Hover Color', 'woo-floating-cart' ),
	'type'      => 'color-alpha',
	'default'   => '#ffffff',
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => array(
				'.xt_woofc-no-touchevents .xt_woofc-cart-open .xt_woofc-inner a.xt_woofc-checkout:hover',
				'.xt_woofc-touchevents .xt_woofc-cart-open .xt_woofc-inner a.xt_woofc-checkout:focus'
			),
			'property' => 'color',
		)
	)
);
