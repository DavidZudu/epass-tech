<?php

use ACFComposer\ACFComposer;
use Flynt\Components;

add_action('Flynt/afterRegisterComponents', function () {
    ACFComposer::registerFieldGroup([
        'name' => 'headerComponents',
        'title' => 'Header Components',
        'default_value' => [
            'layoutPageHeader' => '1',
        ],
        'style' => 'seamless',
        'menu_order' => '-1',
        'fields' => [
            [
                'name' => 'headerComponents',
                'label' => __('Header Components', 'flynt'),
                'type' => 'flexible_content',
                'button_label' => __('Add Component', 'flynt'),
                'layouts' => [
                   
                    // Components\LayoutPageHeader\getACFLayout(),
                ]
            ]
        ],
        'location' => [
            [
                [
                    'param' => 'post_type',
                    'operator' => '!=',
                    'value' => 'post'
                ],
                [
                    'param' => 'post_type',
                    'operator' => '!=',
                    'value' => 'reusable-components'
                ],
                [
                    'param' => 'post_type',
                    'operator' => '!=',
                    'value' => 'location'
                ]
            ]
        ]
    ]);
});
