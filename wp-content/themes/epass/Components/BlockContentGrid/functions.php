<?php
namespace Flynt\Components\BlockContentGrid;

use Flynt\FieldVariables;

function getACFLayout(): array
{
    return [
        'name'       => 'blockContentGrid',
        'label'      => __('Block: Content Grid', 'flynt'),
        'sub_fields' => [
            [
                'label'     => __('Content', 'flynt'),
                'name'      => 'contentTab',
                'type'      => 'tab',
                'placement' => 'top',
                'endpoint'  => 0,
            ],
            [
                'label'        => __('Content Entries', 'flynt'),
                'name'         => 'entries',
                'type'         => 'repeater',
                'layout'       => 'block',
                'button_label' => __('Add Entry', 'flynt'),
                'sub_fields'   => [
                    [
                        'label'        => __('Image', 'flynt'),
                        'instructions' => __('Image-Format: JPG, PNG, SVG, WebP.', 'flynt'),
                        'name'         => 'image',
                        'type'         => 'image',
                        'preview_size' => 'medium',
                        'mime_types'   => 'jpg,jpeg,png,svg,webp',
                        'wrapper'      => [
                            'width' => 30,
                        ],
                    ],
                    [
                        'label'   => __('Image position', 'flynt'),
                        'name'    => 'imagePosition',
                        'type'    => 'radio',
                        'choices' => [
                            'top'    => __('Top', 'flynt'),
                            'bottom' => __('Bottom', 'flynt'),
                        ],
                        'wrapper'      => [
                            'width' => 15,
                        ],
                    ],
                    [
                        'label'        => __('Content', 'flynt'),
                        'name'         => 'contentHtml',
                        'type'         => 'wysiwyg',
                        'delay'        => 0,
                        'media_upload' => 0,
                        'wrapper'      => [
                            'width' => 50,
                        ],
                    ],
                    FieldVariables\setCTAs(),
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
                    [
                        'label'        => __('Keep Image Aspect Ratio', 'flynt'),
                        'name'         => 'keepAspect',
                        'type'         => 'true_false',
                        'instructions' => __('Enable this to maintain the image’s original proportions. The image will no longer stretch to match the content height.', 'flynt'),
                    ],
                    FieldVariables\setColumns(),
                    FieldVariables\setContainerSize(),
                    FieldVariables\setPadding(),
                    FieldVariables\setBorders(),
FieldVariables\setAnchor(),
                ],
            ],
        ],
    ];
}
