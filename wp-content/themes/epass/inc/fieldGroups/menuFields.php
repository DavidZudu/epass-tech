<?php

use ACFComposer\ACFComposer;
use Flynt\FieldVariables;

// Some fieldsd hidden at certain levels via css: zudu-admin.css

add_action('Flynt/afterRegisterComponents', function () {
    ACFComposer::registerFieldGroup([
        'name' => 'navFields',
        'title' => 'Nav Fields',
        'style' => 'seamless',
        'fields' => [
           [
           'label' => __('Add anchor', 'flynt'),
           'name' => 'addAnchor',
           'type' => 'text',
           ],
        ],
        'location' => [
            [
                [
                    'param' => 'nav_menu_item',
                    'operator' => '==',
                    'value' => 'all',
                ],
            ],
        ],
    ]);

});
