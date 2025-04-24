<?php
namespace Flynt\Components\LayoutHeroHeader;

use Flynt\FieldVariables;

add_filter('Flynt/addComponentData?name=LayoutHeroHeader', function ($data) {
    if (isset($data['options']['sectionAnchor'])) {
        $data['options']['sectionAnchorLabel'] = $data['options']['sectionAnchor'];
        $data['options']['sectionAnchor']      = preg_replace('/[^A-Za-z0-9]/', '-', strtolower($data['options']['sectionAnchor']));
    }

    return $data;
});

function getACFLayout()
{
    return [
        'name'       => 'LayoutHeroHeader',
        'label'      => __('Layout: Hero Header', 'flynt'),
        'sub_fields' => [
            [
                'label'     => __('Content', 'flynt'),
                'name'      => 'contentTab',
                'type'      => 'tab',
                'placement' => 'top',
                'endpoint'  => 0,
            ],
            [
                'label'   => __('Pre-Title', 'flynt'),
                'name'    => 'preTitle',
                'type'    => 'text',
                'wrapper' => [
                    'width' => 30,
                ],
            ],
            [
                'label'   => __('Page Title', 'flynt'),
                'name'    => 'pageTitle',
                'type'    => 'text',
                'wrapper' => [
                    'width' => 70,
                ],
            ],
            [
                'label' => __('Content', 'flynt'),
                'name'  => 'content',
                'type'  => 'wysiwyg',
            ],
            FieldVariables\setCTAs(),
            [
                'label' => __('Add image', 'flynt'),
                'name'  => 'image',
                'type'  => 'image',
            ],
            [
            'label' => __('Logo label', 'flynt'),
            'name' => 'logoLabel',
            'type' => 'text',
            'wrapper' => [
                    'width' => 30,
                ],
            ],
            [
                'label' => __('Add Logos', 'flynt'),
                'name'  => 'logos',
                'type'  => 'gallery',
                'wrapper' => [
                    'width' => 70,
                ],
            ],
            [
                'label'     => __('Options', 'flynt'),
                'name'      => 'optionsTab',
                'type'      => 'tab',
                'placement' => 'top',
                'endpoint'  => 0,
            ],
            [
                'label'      => '',
                'name'       => 'options',
                'type'       => 'group',
                'layout'     => 'row',
                'sub_fields' => [
                    FieldVariables\setBorders(),
                ],
            ],
        ],
    ];
}

// Options::addTranslatable('NavigationJs', [

// ]);

// Options::addGlobal('NavigationJs', [

// ]);
