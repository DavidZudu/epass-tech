<?php

namespace Flynt\Components\LayoutPageHeaderBasic;

use Flynt\FieldVariables;

add_filter('Flynt/addComponentData?name=LayoutPageHeaderBasic', function ($data) {
    if (isset($data['options']['sectionAnchor'])) {
        $data['options']['sectionAnchorLabel'] = $data['options']['sectionAnchor'];
        $data['options']['sectionAnchor'] = preg_replace('/[^A-Za-z0-9]/', '-', strtolower($data['options']['sectionAnchor']));
    }

    return $data;
});

function getACFLayout()
{
    return [
        'name' => 'LayoutPageHeaderBasic',
        'label' => __('Layout: Page Header', 'flynt'),
        'sub_fields' => [
            [
                'label' => __('Content', 'flynt'),
                'name' => 'contentTab',
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0,
            ],
            [
                'label' => __('Page Title', 'flynt'),
                'name' => 'pageTitle',
                'type' => 'text',
                'wrapper' => [
                    'width' => 40,
                ],
            ],
            [
                'label' => __('Video background', 'flynt'),
                'name' => 'videoBg',
                'type' => 'file',
                'mime_types' => 'mp4',
                'preview_size' => 'thumbnail',
                'wrapper' => [
                    'width' => 20,
                ],
                'conditional_logic' => [
                            [
                                [
                                    'fieldPath' => 'largeHeader',
                                    'operator' => '==',
                                    'value' => 1,
                                ],
                            ],
                        ],
            ],
            [
                'label' => __('Corner Image', 'flynt'),
                'name' => 'cornerImage',
                'type' => 'image',
                'preview_size' => 'thumbnail',
                'wrapper' => [
                    'width' => 20,
                ],
                'conditional_logic' => [
                    [
                        [
                            'fieldPath' => 'largeHeader',
                            'operator' => '==',
                            'value' => 1,
                        ],
                    ],
                ],
            ],
            [
                'label' => __('Large Header', 'flynt'),
                'name' => 'largeHeader',
                'type' => 'true_false',
                'wrapper' => [
                    'width' => 20,
                ],
            ],
            FieldVariables\setContent(),
            FieldVariables\setCTAs(),
            [
                'label' => __('Options', 'flynt'),
                'name' => 'optionsTab',
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0,
            ],
            [
                'label' => '',
                'name' => 'options',
                'type' => 'group',
                'layout' => 'row',
                'sub_fields' => [
                    [
                    'label' => __('Disable overlay', 'flynt'),
                    'name' => 'disabledTint',
                    'type' => 'true_false',
                    ],
                    [
                    'label' => __('Disable greyscale', 'flynt'),
                    'name' => 'disabledGreyscale',
                    'type' => 'true_false',
                    ],
                    [
                    'label' => __('Disable logo icon overlay (large headers)', 'flynt'),
                    'name' => 'disabledLogo',
                    'type' => 'true_false',                    
                    ],
                    FieldVariables\setPadding(),
                    FieldVariables\setAnchor(),
                ],
            ],
        ],
    ];
}

// Options::addTranslatable('NavigationJs', [

// ]);

// Options::addGlobal('NavigationJs', [

// ]);
