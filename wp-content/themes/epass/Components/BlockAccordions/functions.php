<?php
namespace Flynt\Components\BlockAccordions;

use Flynt\FieldVariables;

function getACFLayout(): array
{
    return [
        'name'       => 'blockAccordions',
        'label'      => __('Block: Accordions', 'flynt'),
        'sub_fields' => [
            [
                'label'     => __('Content', 'flynt'),
                'name'      => 'contentTab',
                'type'      => 'tab',
                'placement' => 'top',
                'endpoint'  => 0,
            ],
            FieldVariables\setSectionContent(),
            [
                'label' => __('Accordions', 'flynt'),
                'name' => 'accordions',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => 'Add Accordion',
                'sub_fields' => [
                    [
                        'label' => __('Title', 'flynt'),
                        'name' => 'title',
                        'type' => 'text',
                        'wrapper' => [
                            'width' => '70'
                        ],
                    ],                    
                    [
                        'label' => __('Load Open?', 'flynt'),
                        'name' => 'isOpen',
                        'type' => 'true_false',
                        'wrapper' => [
                            'width' => '30'
                        ],
                    ],
                    [
                        'label' => __('Content', 'flynt'),
                        'name' => 'content',
                        'type' => 'wysiwyg',
                    ],
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
                    'label' => __('One at a time', 'flynt'),
                    'name' => 'oneAtATime',
                    'type' => 'true_false',
                    'ui' => 1,
                    ],             
                    FieldVariables\setContainerSize(),
                    FieldVariables\setPadding(),
                    FieldVariables\setBorders(),
                ],
            ],
        ],
    ];
}
