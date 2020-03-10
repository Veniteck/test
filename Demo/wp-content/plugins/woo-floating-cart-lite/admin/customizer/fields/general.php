<?php

$fields[] = array(
    'id'          => 'ajax_init',
    'section'     => 'general',
    'label'       => esc_html__( 'Force Ajax Initialization', 'woo-floating-cart' ),
    'description' => esc_html__( 'Enable only if encountering caching issues / conflicts with your theme', 'woo-floating-cart' ),
    'type'        => 'radio-buttonset',
    'choices'     => array(
    '0' => esc_html__( 'No', 'woo-floating-cart' ),
    '1' => esc_html__( 'Yes', 'woo-floating-cart' ),
),
    'default'     => '0',
    'priority'    => 10,
    'transport'   => 'postMessage',
);
$fields[] = array(
    'id'        => 'position',
    'section'   => 'general',
    'label'     => esc_html__( 'Trigger / Cart Position (Desktop)', 'woo-floating-cart' ),
    'type'      => 'radio',
    'priority'  => 10,
    'choices'   => array(
    'top-left'     => esc_html__( 'Top Left', 'woo-floating-cart' ),
    'top-right'    => esc_html__( 'Top Right', 'woo-floating-cart' ),
    'bottom-left'  => esc_html__( 'Bottom Left', 'woo-floating-cart' ),
    'bottom-right' => esc_html__( 'Bottom Right', 'woo-floating-cart' ),
),
    'transport' => 'postMessage',
    'js_vars'   => array( array(
    'element'     => '.xt_woofc',
    'function'    => 'class',
    'prefix'      => 'xt_woofc-pos-',
    'media_query' => '@media (min-width: 769px)',
), array(
    'element'     => '.xt_woofc',
    'function'    => 'html',
    'attr'        => 'data-position',
    'media_query' => '@media (min-width: 769px)',
) ),
    'default'   => 'bottom-right',
);
$fields[] = array(
    'id'        => 'position_tablet',
    'section'   => 'general',
    'label'     => esc_html__( 'Trigger / Cart Position (Tablet)', 'woo-floating-cart' ),
    'type'      => 'radio',
    'priority'  => 10,
    'choices'   => array(
    'top-left'     => esc_html__( 'Top Left', 'woo-floating-cart' ),
    'top-right'    => esc_html__( 'Top Right', 'woo-floating-cart' ),
    'bottom-left'  => esc_html__( 'Bottom Left', 'woo-floating-cart' ),
    'bottom-right' => esc_html__( 'Bottom Right', 'woo-floating-cart' ),
),
    'transport' => 'postMessage',
    'js_vars'   => array( array(
    'element'     => '.xt_woofc',
    'function'    => 'class',
    'prefix'      => 'xt_woofc-tablet-pos-',
    'media_query' => '@media (max-width: 768px)',
), array(
    'element'     => '.xt_woofc',
    'function'    => 'html',
    'attr'        => 'data-tablet_position',
    'media_query' => '@media (max-width: 768px)',
) ),
    'default'   => 'bottom-right',
);
$fields[] = array(
    'id'        => 'position_mobile',
    'section'   => 'general',
    'label'     => esc_html__( 'Trigger / Cart Position (Mobile)', 'woo-floating-cart' ),
    'type'      => 'radio',
    'priority'  => 10,
    'choices'   => array(
    'top-left'     => esc_html__( 'Top Left', 'woo-floating-cart' ),
    'top-right'    => esc_html__( 'Top Right', 'woo-floating-cart' ),
    'bottom-left'  => esc_html__( 'Bottom Left', 'woo-floating-cart' ),
    'bottom-right' => esc_html__( 'Bottom Right', 'woo-floating-cart' ),
),
    'transport' => 'postMessage',
    'js_vars'   => array( array(
    'element'     => '.xt_woofc',
    'function'    => 'class',
    'prefix'      => 'xt_woofc-mobile-pos-',
    'media_query' => '@media (max-width: 480px)',
), array(
    'element'     => '.xt_woofc',
    'function'    => 'html',
    'attr'        => 'data-mobile_position',
    'media_query' => '@media (max-width: 480px)',
) ),
    'default'   => 'bottom-right',
);
$fields[] = array(
    'id'        => 'counter_position',
    'section'   => 'general',
    'label'     => esc_html__( 'Product Counter Position (Desktop)', 'woo-floating-cart' ),
    'type'      => 'radio',
    'priority'  => 10,
    'choices'   => array(
    'top-left'     => esc_html__( 'Top Left', 'woo-floating-cart' ),
    'top-right'    => esc_html__( 'Top Right', 'woo-floating-cart' ),
    'bottom-left'  => esc_html__( 'Bottom Left', 'woo-floating-cart' ),
    'bottom-right' => esc_html__( 'Bottom Right', 'woo-floating-cart' ),
),
    'transport' => 'postMessage',
    'js_vars'   => array( array(
    'element'     => '.xt_woofc',
    'function'    => 'class',
    'prefix'      => 'xt_woofc-counter-pos-',
    'media_query' => '@media (min-width: 769px)',
) ),
    'default'   => 'top-left',
);
$fields[] = array(
    'id'        => 'counter_position_tablet',
    'section'   => 'general',
    'label'     => esc_html__( 'Product Counter Position (Tablet)', 'woo-floating-cart' ),
    'type'      => 'radio',
    'priority'  => 10,
    'choices'   => array(
    'top-left'     => esc_html__( 'Top Left', 'woo-floating-cart' ),
    'top-right'    => esc_html__( 'Top Right', 'woo-floating-cart' ),
    'bottom-left'  => esc_html__( 'Bottom Left', 'woo-floating-cart' ),
    'bottom-right' => esc_html__( 'Bottom Right', 'woo-floating-cart' ),
),
    'transport' => 'postMessage',
    'js_vars'   => array( array(
    'element'     => '.xt_woofc',
    'function'    => 'class',
    'prefix'      => 'xt_woofc-counter-tablet-pos-',
    'media_query' => '@media (max-width: 768px)',
) ),
    'default'   => 'top-left',
);
$fields[] = array(
    'id'        => 'counter_position_mobile',
    'section'   => 'general',
    'label'     => esc_html__( 'Product Counter Position (Mobile)', 'woo-floating-cart' ),
    'type'      => 'radio',
    'priority'  => 10,
    'choices'   => array(
    'top-left'     => esc_html__( 'Top Left', 'woo-floating-cart' ),
    'top-right'    => esc_html__( 'Top Right', 'woo-floating-cart' ),
    'bottom-left'  => esc_html__( 'Bottom Left', 'woo-floating-cart' ),
    'bottom-right' => esc_html__( 'Bottom Right', 'woo-floating-cart' ),
),
    'transport' => 'postMessage',
    'js_vars'   => array( array(
    'element'     => '.xt_woofc',
    'function'    => 'class',
    'prefix'      => 'xt_woofc-counter-mobile-pos-',
    'media_query' => '@media (max-width: 480px)',
) ),
    'default'   => 'top-left',
);
$fields[] = array(
    'id'      => 'general_features',
    'section' => 'general',
    'type'    => 'xt-premium',
    'default' => array(
    'type'  => 'image',
    'value' => $this->core->plugin_url() . 'admin/customizer/assets/images/general.png',
    'link'  => $this->core->plugin_upgrade_url(),
),
);