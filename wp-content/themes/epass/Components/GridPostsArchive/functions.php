<?php
namespace Flynt\Components\GridPostsArchive;

use Flynt\FieldVariables;
use Flynt\Utils\Options;
use Timber\Timber;

const POST_TYPE          = 'post';
const FILTER_BY_TAXONOMY = 'category';

add_filter('Flynt/addComponentData?name=GridPostsArchive', function (array $data): array {
    $data['uuid'] ??= wp_generate_uuid4();

    $queriedObject = get_queried_object();
    $manualSource = $data['manualSource'] ?? null;

    $manualPostType = null;
    $manualTerm = null;

    if (is_string($manualSource)) {
        if (str_starts_with($manualSource, 'postType:')) {
            $manualPostType = substr($manualSource, strlen('postType:'));
        } elseif (str_starts_with($manualSource, 'term:')) {
            $termId = (int) substr($manualSource, strlen('term:'));
            $manualTerm = get_term($termId);
        }
    }

    $postType = $manualTerm && $manualTerm->taxonomy
        ? get_taxonomy($manualTerm->taxonomy)->object_type[0] ?? POST_TYPE
        : ($manualPostType ?: get_post_type() ?: POST_TYPE);

    $postTypeObject = get_post_type_object($postType);

    // Determine filter taxonomies
    if (!empty($postTypeObject->filter) && is_array($postTypeObject->filter)) {
        $filterTaxonomies = $postTypeObject->filter;
    } else {
        $filterTaxonomies = [FILTER_BY_TAXONOMY];
    }

    // Filter bar
    $data['filters'] = [];

    foreach ($filterTaxonomies as $taxonomy) {
        $terms = get_terms([
            'taxonomy'   => $taxonomy,
            'hide_empty' => true,
        ]);

        if (!empty($terms) && !is_wp_error($terms)) {
            $filterTerms = array_map(function ($term) use ($taxonomy, $queriedObject) {
                $timberTerm = Timber::get_term($term);
                $timberTerm->isActive = false;

                if (($queriedObject->taxonomy ?? null) === $taxonomy &&
                    ($queriedObject->term_id ?? null) === $term->term_id) {
                    $timberTerm->isActive = true;
                }

                return $timberTerm;
            }, $terms);

            array_unshift($filterTerms, [
                'link'     => get_post_type_archive_link($postType),
                'title'    => $data['labels']['allPosts'] ?? __('All', 'flynt'),
                'isActive' => is_post_type_archive($postType),
            ]);

            $data['filters'][] = [
                'taxonomy' => $taxonomy,
                'terms'    => $filterTerms,
                'label'    => $data['labels']['filterBy'] ?? __('Filter by', 'flynt'),
            ];
        }
    }

    // Title/Description logic
    if (is_home()) {
        $data['isHome'] = true;
        $data['title']  = $queriedObject->post_title ?? get_bloginfo('name');
    } elseif (!is_archive() && $manualTerm) {
        $data['title']       = $manualTerm->name ?? '';
        $data['description'] = $manualTerm->description ?? '';
    } elseif (!is_archive() && $manualPostType) {
        $data['title']       = $postTypeObject->label ?? '';
        $data['description'] = $postTypeObject->description ?? '';
    } else {
        $data['title']       = get_the_archive_title();
        $data['description'] = get_the_archive_description();
    }

    // Fetch posts manually if needed
    if (!is_archive() && !is_home() && ($manualPostType || $manualTerm)) {
        $queryArgs = [
            'post_type'      => $postType,
            'posts_per_page' => get_option('posts_per_page'),
            'paged'          => get_query_var('paged') ?: 1,
        ];

        if ($manualTerm && $manualTerm->taxonomy) {
            $queryArgs['tax_query'] = [[
                'taxonomy' => $manualTerm->taxonomy,
                'field'    => 'term_id',
                'terms'    => [$manualTerm->term_id],
            ]];
        }

        $data['posts'] = Timber::get_posts($queryArgs);
    }

    return $data;
});



function getACFLayout(): array
{
    return [
        'name' => 'gridPostsArchive',
        'label' => __('Grid: Posts Archive', 'flynt'),
        'sub_fields' => [   
            FieldVariables\setSectionContent(),                    
            [
                'label' => __('Manual Source (Post Type or Term)', 'flynt'),
                'name' => 'manualSource',
                'type' => 'select',
                'allow_null' => 1,
                'ui' => 1,
                'instructions' => __('Select a post type or a taxonomy term to show posts from.', 'flynt'),
            ],
        ]
    ];
}

Options::addGlobal('GridPostsArchive', [
    [
        'label'         => __('Load More Button?', 'flynt'),
        'name'          => 'loadMore',
        'type'          => 'true_false',
        'default_value' => 0,
        'ui'            => 1,
    ],
]);

Options::addTranslatable('GridPostsArchive', [
    [
        'label'     => __('Content', 'flynt'),
        'name'      => 'contentTab',
        'type'      => 'tab',
        'placement' => 'top',
        'endpoint'  => 0,
    ],
    [
        'label'        => __('Title', 'flynt'),
        'instructions' => __('Want to add a headline? And a paragraph? Go ahead! Or just leave it empty and nothing will be shown.', 'flynt'),
        'name'         => 'preContentHtml',
        'type'         => 'wysiwyg',
        'tabs'         => 'visual,text',
        'media_upload' => 0,
        'delay'        => 0,
    ],
    [
        'label'     => __('Labels', 'flynt'),
        'name'      => 'labelsTab',
        'type'      => 'tab',
        'placement' => 'top',
        'endpoint'  => 0,
    ],
    [
        'label'      => '',
        'name'       => 'labels',
        'type'       => 'group',
        'sub_fields' => [
            [
                'label'         => __('Filter by', 'flynt'),
                'name'          => 'filterBy',
                'type'          => 'text',
                'default_value' => __('Filter by', 'flynt'),
                'required'      => 1,
                'wrapper'       => [
                    'width' => '50',
                ],
            ],
            [
                'label'         => __('Previous', 'flynt'),
                'name'          => 'previous',
                'type'          => 'text',
                'default_value' => __('Prev', 'flynt'),
                'required'      => 1,
                'wrapper'       => [
                    'width' => '50',
                ],
            ],
            [
                'label'         => __('Next', 'flynt'),
                'name'          => 'next',
                'type'          => 'text',
                'default_value' => __('Next', 'flynt'),
                'required'      => 1,
                'wrapper'       => [
                    'width' => '50',
                ],
            ],
            [
                'label'         => __('Load More', 'flynt'),
                'name'          => 'loadMore',
                'type'          => 'text',
                'default_value' => __('Load More', 'flynt'),
                'required'      => 1,
                'wrapper'       => [
                    'width' => '50',
                ],
            ],
            [
                'label'         => __('No Posts Found Text', 'flynt'),
                'name'          => 'noPostsFound',
                'type'          => 'text',
                'default_value' => __('No post found.', 'flynt'),
                'required'      => 1,
                'wrapper'       => [
                    'width' => '50',
                ],
            ],
            [
                'label'         => __('All Posts', 'flynt'),
                'name'          => 'allPosts',
                'type'          => 'text',
                'default_value' => __('All', 'flynt'),
                'required'      => 1,
                'wrapper'       => [
                    'width' => '50',
                ],
            ],
            [
                'label'         => __('Reading Time - (20) min read', 'flynt'),
                'instructions'  => __('%d is placeholder for number of minutes', 'flynt'),
                'name'          => 'readingTime',
                'type'          => 'text',
                'default_value' => __('%d min read', 'flynt'),
                'required'      => 1,
                'wrapper'       => [
                    'width' => 50,
                ],
            ],
            [
                'label'         => __('Read More', 'flynt'),
                'name'          => 'readMore',
                'type'          => 'text',
                'default_value' => __('Read More', 'flynt'),
                'required'      => 1,
                'wrapper'       => [
                    'width' => '50',
                ],
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
            FieldVariables\getTheme(),
        ],
    ],
]);
