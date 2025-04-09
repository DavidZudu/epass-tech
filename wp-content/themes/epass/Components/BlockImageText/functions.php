<?php
namespace Flynt\Components\BlockImageText;

use Flynt\FieldVariables;

function getACFLayout(): array
{
    return [
        'name'       => 'blockImageText',
        'label'      => __('Block: Image Text', 'flynt'),
        'sub_fields' => [
            [
                'label'     => __('Content', 'flynt'),
                'name'      => 'contentTab',
                'type'      => 'tab',
                'placement' => 'top',
                'endpoint'  => 0,
            ],
            [
                'label'   => __('Image Position', 'flynt'),
                'name'    => 'imagePosition',
                'type'    => 'button_group',
                'choices' => [
                    'left'  => sprintf('<i class=\'dashicons dashicons-align-left\' title=\'%1$s\'></i>', __('Image on the left', 'flynt')),
                    'right' => sprintf('<i class=\'dashicons dashicons-align-right\' title=\'%1$s\'></i>', __('Image on the right', 'flynt')),
                ],
                'wrapper' => [
                    'width' => 20,
                ],
            ],
            [
                'label'        => __('Image', 'flynt'),
                'instructions' => __('Image-Format: JPG, PNG, SVG, WebP.', 'flynt'),
                'name'         => 'image',
                'type'         => 'image',
                'preview_size' => 'medium',
                'required'     => 1,
                'mime_types'   => 'jpg,jpeg,png,svg,webp',
                'wrapper'      => [
                    'width' => 20,
                ],
            ],
            [
                'label'        => __('Text', 'flynt'),
                'name'         => 'contentHtml',
                'type'         => 'wysiwyg',
                'delay'        => 0,
                'media_upload' => 0,
                'required'     => 1,
                'wrapper'      => [
                    'width' => 60,
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
                    FieldVariables\setContainerSize(),
                    FieldVariables\setPadding(),
                    FieldVariables\setBorders(),
                ],
            ],
        ],
    ];
}
