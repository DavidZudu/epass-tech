<?php
namespace Flynt\Components\BlockTeam;

use Flynt\FieldVariables;

function getACFLayout(): array
{
    return [
        'name'       => 'blockTeam',
        'label'      => __('Block: Team', 'flynt'),
        'sub_fields' => [
            [
                'label'     => __('Content', 'flynt'),
                'name'      => 'contentTab',
                'type'      => 'tab',
                'placement' => 'top',
                'endpoint'  => 0,
            ],
            [
                'label'   => __('Team Leads intro', 'flynt'),
                'name'    => 'teamLeadsIntro',
                'type'    => 'wysiwyg',
                'wrapper' => [
                    'width' => '30',
                ],
            ],
            [
                'label'     => __('Team Leads', 'flynt'),
                'name'      => 'teamLeads',
                'type'      => 'relationship',
                'post_type' => ['member'],
                'wrapper' => [
                    'width' => '70',
                ],
            ],
            [
                'label'   => __('Team intro', 'flynt'),
                'name'    => 'teamIntro',
                'type'    => 'wysiwyg',
                'wrapper' => [
                    'width' => '30',
                ],
            ],
            [
                'label'     => __('Team', 'flynt'),
                'name'      => 'team',
                'type'      => 'relationship',
                'post_type' => ['member'],
                'wrapper' => [
                    'width' => '70',
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
                    FieldVariables\setContainerSize(),
                    FieldVariables\setPadding(),
                    FieldVariables\setBorders(),
                ],
            ],
        ],
    ];
}
