<?php
namespace Flynt\Components\BlockPostsCarousel;

use Flynt\FieldVariables;
use Flynt\Utils\Options;
use Timber\Timber;

const POST_TYPE          = 'post';
const FILTER_BY_TAXONOMY = 'category';

add_filter('Flynt/addComponentData?name=BlockPostsCarousel', function (array $data): array {
    $data['uuid'] ??= wp_generate_uuid4();

    $showRelated     = $data['showRelated'] ?? false;
    $manualSource    = $data['manualSource'] ?? null;

    $manualPostType = null;
    $manualTerm     = null;

    if (is_string($manualSource)) {
        if (str_starts_with($manualSource, 'postType:')) {
            $manualPostType = substr($manualSource, strlen('postType:'));
        } elseif (str_starts_with($manualSource, 'term:')) {
            $termId     = (int) substr($manualSource, strlen('term:'));
            $manualTerm = get_term($termId);
        }
    }

    $postType = $manualTerm && $manualTerm->taxonomy
        ? get_taxonomy($manualTerm->taxonomy)->object_type[0] ?? POST_TYPE
        : ($manualPostType ?: POST_TYPE);

    $queryArgs = [
        'post_type'      => $postType,
        'posts_per_page' => 6,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ];

    // 🔁 Show related posts logic
    if ($showRelated && is_singular()) {
        $postId   = get_the_ID();
        $taxonomy = getPostTermsbyPostId($postId);
    
        $terms = get_the_terms($postId, $taxonomy);
    
        if (!empty($terms) && !is_wp_error($terms)) {
            $termIds = wp_list_pluck($terms, 'term_id');
    
            $queryArgs['tax_query'] = [[
                'taxonomy' => $taxonomy,
                'field'    => 'term_id',
                'terms'    => $termIds,
            ]];
    
            $queryArgs['post__not_in'] = [$postId]; // exclude current post
        }
    } elseif ($manualTerm && $manualTerm->taxonomy) {
        // fallback: manual term filtering
        $queryArgs['tax_query'] = [[
            'taxonomy' => $manualTerm->taxonomy,
            'field'    => 'term_id',
            'terms'    => [$manualTerm->term_id],
        ]];
    }

    $data['posts'] = Timber::get_posts($queryArgs);

    return $data;
});


function getACFLayout(): array
{
    return [
        'name'       => 'BlockPostsCarousel',
        'label'      => __('Block: Posts Carousel', 'flynt'),
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
                'label'        => __('Manual Source (Post Type or Term)', 'flynt'),
                'name'         => 'manualSource',
                'type'         => 'select',
                'allow_null'   => 1,
                'ui'           => 1,
                'instructions' => __('Select a post type or a taxonomy term to show posts from.', 'flynt'),
                'wrapper'     => ['width' => '50%'],
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

