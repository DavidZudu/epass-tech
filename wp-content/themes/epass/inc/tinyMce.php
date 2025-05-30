<?php

/**
 * Moves most relevant editor buttons to the first toolbar
 * and provides config for creating new toolbars, block formats, and style formats.
 * See the TinyMce documentation for more information: https://www.tiny.cloud/docs/
 */

namespace Flynt\TinyMce;

// First Toolbar.
add_filter('mce_buttons', function (array $buttons) {
    $config = getConfig();
    if ($config && isset($config['toolbars'])) {
        $toolbars = $config['toolbars'];
        if (isset($toolbars['default']) && isset($toolbars['default'][0])) {
            return $toolbars['default'][0];
        }
    }

    return $buttons;
});

// Second Toolbar.
add_filter('mce_buttons_2', '__return_empty_array');

add_filter('tiny_mce_before_init', function (array $mceInit): array {
    $config = getConfig();

    if ($config !== []) {
        if (isset($config['blockformats'])) {
            $mceInit['block_formats'] = getBlockFormats($config['blockformats']);
        }

        if (isset($config['styleformats'])) {
            // Send it to style_formats as true js array
            $mceInit['style_formats'] = json_encode($config['styleformats']);
        }

        if (isset($config['entities'])) {
            $entityString = getEntities($config['entities']);
            if ($entityString !== '' && $entityString !== '0') {
                $mceInit['entities'] = implode(',', [$mceInit['entities'] ?? '', $entityString]);
            }
        }

        if (isset($config['entity_encoding'])) {
            $mceInit['entity_encoding'] = getEntityEncoding($config['entity_encoding']);
        }
    }

    $mceInit['height'] = 150; // starting height

    return $mceInit;
}, 10);

add_action('admin_footer', function () {
    ?>
    <script>
    (function ($) {
        function resizeEditor(editor) {
            const iframe = editor.iframeElement;
            if (!iframe) return;

            const doc = iframe.contentDocument || iframe.contentWindow.document;
            const body = doc.body;
            if (!body) return;

            // Reset height before measuring
            iframe.style.height = 'auto';

            // Calculate new height (limit to 400px)
            const contentHeight = body.scrollHeight;
            const newHeight = Math.min(contentHeight + 20, 400);

            iframe.style.height = newHeight + 'px';
        }

        // Wait for TinyMCE to be ready
        window.addEventListener('load', function () {
            if (typeof tinymce === 'undefined') return;

            tinymce.on('AddEditor', function (e) {
                const editor = e.editor;

                editor.on('input keyup setcontent', function () {
                    resizeEditor(editor);
                });

                // Initial resize
                editor.on('init', function () {
                    resizeEditor(editor);
                });
            });
        });
    })(jQuery);
    </script>
    <?php
});

add_filter('acf/fields/wysiwyg/toolbars', function (array $toolbars) {
    // Load Toolbars and parse them into TinyMCE.
    $config = getConfig();
    if ($config && !empty($config['toolbars'])) {
        return array_map(function ($toolbar) {
            array_unshift($toolbar, []);
            return $toolbar;
        }, $config['toolbars']);
    }

    return $toolbars;
});

function getBlockFormats($blockFormats): string
{
    if (!empty($blockFormats)) {
        $blockFormatStrings = array_map(
            function ($tag, $label): string {
                return "{$label}={$tag}";
            },
            $blockFormats,
            array_keys($blockFormats)
        );
        return implode(';', $blockFormatStrings);
    }

    return '';
}

function getEntities($entities): string
{
    if (!empty($entities)) {
        $entityString = array_map(
            function ($name, $code): string {
                return "{$code},{$name}";
            },
            $entities,
            array_keys($entities)
        );
        return implode(',', $entityString);
    }

    return '';
}

function getEntityEncoding($entityEncoding): string
{
    if (!empty($entityEncoding)) {
        return $entityEncoding;
    }

    return 'raw';
}

function getConfig(): array
{
    return [
        'blockformats' => [
            __('Paragraph', 'flynt') => 'p',
            // __('Heading 1', 'flynt') => 'h1',
            __('Heading 2', 'flynt') => 'h2',
            __('Heading 3', 'flynt') => 'h3',
            __('Heading 4', 'flynt') => 'h4',
            __('Heading 5', 'flynt') => 'h5',
            __('Heading 6', 'flynt') => 'h6'
        ],
        'styleformats' => [
            [
                'title' => __('Headings', 'flynt'),
                'icon' => '',
                'items' => [
                    [
                        'title' => __('Heading 1 style', 'flynt'),
                        'classes' => 'h1',
                        'selector' => '*'
                    ],
                    [
                        'title' => __('Heading 2 style', 'flynt'),
                        'classes' => 'h2',
                        'selector' => '*'
                    ],
                    [
                        'title' => __('Heading 3 style', 'flynt'),
                        'classes' => 'h3',
                        'selector' => '*'
                    ],
                    [
                        'title' => __('Heading 4 style', 'flynt'),
                        'classes' => 'h4',
                        'selector' => '*'
                    ],
                    [
                        'title' => __('Heading 5 style', 'flynt'),
                        'classes' => 'h5',
                        'selector' => '*'
                    ],
                    [
                        'title' => __('Heading 6 style', 'flynt'),
                        'classes' => 'h6',
                        'selector' => '*'
                    ],
                ]
            ],
            [
                'title' => 'Text Styles',
                'icon' => '',
                'items' => [
                    [
                        'title' => 'Lead text',
                        'classes' => 'lead',
                        'selector' => 'p'
                    ],                   
                    [
                        'title' => 'Small text',
                        'classes' => 'small',
                        'selector' => 'p'
                    ],                   
                ]
            ],
            [
                'title' => 'Text Colours',
                'icon' => '',
                'items' => [
                    [
                        'title' => 'Teal',
                        'classes' => 'c-primary',
                        'inline' => 'span'
                    ],                   
                    [
                        'title' => 'Teal Dark',
                        'classes' => 'c-primary-d',
                        'inline' => 'span'
                    ],                   
                    [
                        'title' => 'Purple',
                        'classes' => 'c-secondary',
                        'inline' => 'span'
                    ],                   
                ]
            ],
            [
                'title' => __('Buttons', 'flynt'),
                'icon' => '',
                'items' => [
                    [
                        'title' => __('Button', 'flynt'),
                        'classes' => 'button',
                        'selector' => 'a,button'
                    ],                    
                ]
            ],
        ],
        'toolbars' => [
            'default' => [
                [
                    'formatselect',
                    'styleselect',
                    'bold',
                    'italic',
                    'strikethrough',
                    'blockquote',
                    'alignleft',
                     'aligncenter',
                      'alignright',
                    '|',
                    'bullist',
                    'numlist',
                    '|',
                    'link',
                    'unlink',
                    '|',
                    'pastetext',
                    'removeformat',
                    '|',
                    'undo',
                    'redo',
                    'fullscreen'
                ]
            ],
            'basic' => [
                [
                    'bold',
                    'italic',
                    'strikethrough',
                    '|',
                    'link',
                    'unlink',
                    '|',
                    'undo',
                    'redo',
                    'fullscreen'
                ]
            ]
                ],
        'entities' => [
            '160' => 'nbsp',
            '173' => 'shy'
        ],
        'entity_encoding' => 'named',
    ];
}

// add style sheet
add_editor_style('editor-style.css' );