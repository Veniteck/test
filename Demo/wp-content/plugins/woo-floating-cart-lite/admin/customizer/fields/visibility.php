<?php

$fields[] = array(
    'id'      => 'visibility_features',
    'section' => 'visibility',
    'type'    => 'xt-premium',
    'default' => array(
    'type'  => 'image',
    'value' => $this->core->plugin_url() . 'admin/customizer/assets/images/visibility.png',
    'link'  => $this->core->plugin_upgrade_url(),
),
);