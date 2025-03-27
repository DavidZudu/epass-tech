<?php

add_filter('acf/load_field/name=manualSource', function ($field) {
    $field['choices'] = [];

    // Post types
    $postTypes = get_post_types(['public' => true], 'objects');
    $disallowed = ['page', 'attachment'];

    foreach ($postTypes as $postType) {
        if (!in_array($postType->name, $disallowed, true)) {
            $field['choices']['Post Types']['postType:' . $postType->name] = $postType->label;
        }
    }

    // Terms
    $taxonomies = get_taxonomies(['public' => true], 'objects');
    $disallowedTaxonomies = ['post_format', 'nav_menu'];

    foreach ($taxonomies as $taxonomy) {
        if (in_array($taxonomy->name, $disallowedTaxonomies, true)) {
            continue;
        }

        $terms = get_terms([
            'taxonomy' => $taxonomy->name,
            'hide_empty' => false,
        ]);

        foreach ($terms as $term) {
            $field['choices']['Terms']['term:' . $term->term_id] = $taxonomy->label . ': ' . $term->name;
        }
    }

    return $field;
});