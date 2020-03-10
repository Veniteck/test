<?php

$fields[] = array(
    'id'      => 'trigger_features',
    'section' => 'trigger',
    'type'    => 'xt-premium',
    'default' => array(
    'type'  => 'image',
    'value' => $this->core->plugin_url() . 'admin/customizer/assets/images/trigger.png',
    'link'  => $this->core->plugin_upgrade_url(),
),
);