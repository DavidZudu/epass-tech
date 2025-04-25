<?php

namespace Flynt\Acf;

use Flynt\Utils\Options;

Options::addGlobal('ContactInfo', [
    [
        'name' => 'contactDetailsTab',
        'label' => __('Contact Details', 'flynt'),
        'type' => 'tab',
    ],
    [
        'name' => 'contactEmail',
        'label' => __('Contact Email', 'flynt'),
        'type' => 'link',
        'wrapper' => [
            'width' => '50',
        ],
    ],
    [
        'name' => 'contactPhone',
        'label' => __('Contact Phone Number', 'flynt'),
        'type' => 'link',
        'wrapper' => [
            'width' => '50',
        ],
    ],
    [
        'name' => 'contactAddress',
        'label' => __('Contact Address', 'flynt'),
        'instructions' => 'Linebreaks will be honoured where possible.',
        'new_lines' => 'br',
        'rows' => 5,
        'type' => 'textarea',
    ],
    [
        'name' => 'socialsTab',
        'label' => __('Social Media', 'flynt'),
        'type' => 'tab',
    ],
    [
        'name' => 'socials',
        'label' => __('Social Media', 'flynt'),
        'type' => 'repeater',
        'sub_fields' => [
            [
                'name' => 'icon',
                'label' => __('Icon', 'flynt'),
                'type' => 'font-awesome',
                'icon_sets' => ['fas', 'far', 'fab'],
                'wrapper' => [
                    'width' => '40',
                ],
            ],
            [
                'name' => 'link',
                'label' => __('Label', 'flynt'),
                'type' => 'link',
                'wrapper' => [
                    'width' => '60',
                ],
            ],
        ],
    ],
]);

Options::addGlobal('CodeSnippets', [
    [
        'label' => __(
            '<h1><strong>WARNING:</strong> Modifying these fields may break your website.</h1>',
            'flynt'
        ),
        'name' => 'codeMessage',
        'type' => 'message',
        'message' =>
            "<p>These fields are intended to be used by non-coding members of the Zudu team to maintain snippets of code important to your website's marketing and analytics. Modifying these fields without checking with Zudu may break this functionality or may break your website entirely.</p><p>Please notify Zudu of any changes you'd like to make.</p>",
    ],
    [
        'label' => __('Head Code', 'flynt'),
        'name' => 'headCode',
        'instructions' =>
            'For code that should go immediately after the <code>&lt;head></code> tag.',
        'type' => 'textarea',
        'wrapper' => [
            'width' => '33',
        ],
    ],
    [
        'label' => __('Body Start Code', 'flynt'),
        'name' => 'bodyStartCode',
        'instructions' =>
            'For code that should go immediately after the <code>&lt;body></code>tag.',
        'type' => 'textarea',
        'wrapper' => [
            'width' => '33',
        ],
    ],
    [
        'label' => __('Body End Code', 'flynt'),
        'name' => 'bodyEndCode',
        'instructions' =>
            'For code that should go immediately before the <code>&lt;/body></code> tag.',
        'type' => 'textarea',
        'wrapper' => [
            'width' => '33',
        ],
    ],
]);
