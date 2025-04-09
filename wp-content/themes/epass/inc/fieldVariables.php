<?php

/**
 * Defines field variables to be used across multiple components.
 */

namespace Flynt\FieldVariables;

function setSectionContent()
{
    return [
        
            [
                'label'   => __('Include content', 'flynt'),
                'name'    => 'contentToggle',
                'type'    => 'true_false',
                'wrapper' => [
                    'width' => '15',
                ],
            ],
            [
                'label'            => __('Section Content', 'flynt'),
                'name'             => 'sectionContent',
                'type'             => 'wysiwyg',
                'wrapper'          => [
                    'width' => '85',
                ],
                'conditional_logic' => [
                    [
                        [
                            'fieldPath'    => 'contentToggle',
                            'operator' => '==',
                            'value'    => 1,
                        ],
                    ],
                ],
            ],     
    ];
}
function setContainerSize($default = '')
{
    return [
        'label' => __('Container Size', 'flynt'),
        'name' => 'containerSize',
        'type' => 'radio',
        'layout' => 'horizontal',
        'default_value' => $default,
        'choices' => [
            'container--small' => 'Small',
            '' => 'Regular',
            'container--large' => 'Large',
            'container--xlarge' => 'Extra Large',
            'container--full' => 'Full',
        ],
        'instructions' => __(
            'Select the size of the content container',
            'flynt'
        ),
    ];
}
function setPadding($default = ['top','bottom'])
{
    return [
        'label' => __('Padding', 'flynt'),
        'name' => 'padding',
        'type' => 'checkbox',
        'layout' => 'horizontal',
        'return_value' => 'value',
        'default_value' => $default,
        'choices' => [
            'top' => 'Top',
            'bottom' => 'Bottom',
        ],
    ];
}
function setBorders($default = ['bottom'])
{
    return [
        'label' => __('Borders', 'flynt'),
        'name' => 'borders',
        'type' => 'checkbox',
        'layout' => 'horizontal',
        'return_value' => 'value',
        'default_value' => $default,
        'choices' => [
            'top' => 'Top',
            'bottom' => 'Bottom',
        ],
    ];
}
function setCTAs($wrapper = '100')
{
    return [
        'label' => __('Calls To Action', 'flynt'),
        'name' => 'ctaLinks',
        'type' => 'repeater',
        'layout' => 'block',
        'button_label' => 'Add Button',
        'sub_fields' => [
            [
                'label' => __('CTA', 'flynt'),
                'name' => 'cta',
                'type' => 'link',
                'wrapper'=> [
                    'width'=>'60'
                ]
            ],
            [
                'label' => __('Button Style', 'flynt'),
                'name' => 'style',
                'type' => 'radio',
                'layout' => 'horizontal',
                'default_value' => '',
                'choices' => [
                    '' => 'Default',
                    'light' => 'Light',
                ],
                'wrapper'=> [
                    'width'=>'40'
                ]
            ],
        ],
        'wrapper' => [
            'width' => $wrapper,
        ],
    ];
}


/// FLYNT FIELDS ////

function getTheme($default = ''): array
{
    return [
        'label'         => __('Theme', 'flynt'),
        'name'          => 'theme',
        'type'          => 'select',
        'allow_null'    => 0,
        'multiple'      => 0,
        'ui'            => 0,
        'ajax'          => 0,
        'choices'       => [
            ''      => __('(none)', 'flynt'),
            'light' => __('Light', 'flynt'),
            'dark'  => __('Dark', 'flynt'),
        ],
        'default_value' => $default,
    ];
}

function getSize($default = 'medium'): array
{
    return [
        'label'             => __('Size', 'flynt'),
        'name'              => 'size',
        'type'              => 'radio',
        'other_choice'      => 0,
        'save_other_choice' => 0,
        'layout'            => 'horizontal',
        'choices'           => [
            'medium' => __('Medium', 'flynt'),
            'wide'   => __('Wide', 'flynt'),
            'full'   => __('Full', 'flynt'),
        ],
        'default_value'     => $default,
    ];
}

function getAlignment($args = []): array
{
    $options = wp_parse_args($args, [
        'label'   => __('Align', 'flynt'),
        'name'    => 'align',
        'default' => 'center',
    ]);

    return [
        'label'             => $options['label'],
        'name'              => $options['name'],
        'type'              => 'radio',
        'other_choice'      => 0,
        'save_other_choice' => 0,
        'layout'            => 'horizontal',
        'choices'           => [
            'left'   => __('Left', 'flynt'),
            'center' => __('Center', 'flynt'),
        ],
        'default_value'     => $options['default'],
    ];
}

function getTextAlignment($args = []): array
{
    $options = wp_parse_args($args, [
        'label'   => __('Align text', 'flynt'),
        'name'    => 'textAlign',
        'default' => 'left',
    ]);

    return [
        'label'         => $options['label'],
        'name'          => $options['name'],
        'type'          => 'button_group',
        'choices'       => [
            'left'   => sprintf('<i class="dashicons dashicons-editor-alignleft" title="%1$s"></i>', __('Align text left', 'flynt')),
            'center' => sprintf('<i class="dashicons dashicons-editor-aligncenter" title="%1$s"></i>', __('Align text center', 'flynt')),
        ],
        'default_value' => $options['default'],
    ];
}
