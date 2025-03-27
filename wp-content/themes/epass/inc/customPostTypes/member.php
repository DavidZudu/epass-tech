<?php

/**
 * This is an example file showcasing how you can add custom post types to your Flynt theme.
 *
 * For a full list of parameters see https://developer.wordpress.org/reference/functions/register_post_type/ or use https://generatewp.com/post-type/ to generate the code for you.
 */

namespace Flynt\CustomPostTypes;

add_action('init', function (): void {
    $labels = [
        'name'                  => _x('Members', 'Member General Name', 'flynt'),
        'singular_name'         => _x('Member', 'Member Singular Name', 'flynt'),
        'menu_name'             => __('Members', 'flynt'),
        'name_admin_bar'        => __('Member', 'flynt'),
        'archives'              => __('Member Archives', 'flynt'),
        'attributes'            => __('Member Attributes', 'flynt'),
        'parent_item_colon'     => __('Parent Member:', 'flynt'),
        'all_items'             => __('All Members', 'flynt'),
        'add_new_item'          => __('Add New Member', 'flynt'),
        'add_new'               => __('Add New', 'flynt'),
        'new_item'              => __('New Member', 'flynt'),
        'edit_item'             => __('Edit Member', 'flynt'),
        'update_item'           => __('Update Member', 'flynt'),
        'view_item'             => __('View Member', 'flynt'),
        'view_items'            => __('View Members', 'flynt'),
        'search_items'          => __('Search Member', 'flynt'),
        'not_found'             => __('Not found', 'flynt'),
        'not_found_in_trash'    => __('Not found in Trash', 'flynt'),
        'featured_image'        => __('Featured Image', 'flynt'),
        'set_featured_image'    => __('Set featured image', 'flynt'),
        'remove_featured_image' => __('Remove featured image', 'flynt'),
        'use_featured_image'    => __('Use as featured image', 'flynt'),
        'insert_into_item'      => __('Insert into item', 'flynt'),
        'uploaded_to_this_item' => __('Uploaded to this item', 'flynt'),
        'items_list'            => __('Members list', 'flynt'),
        'items_list_navigation' => __('Members list navigation', 'flynt'),
        'filter_items_list'     => __('Filter items list', 'flynt'),
    ];

    $args = [
        'label'                 => __('Member', 'flynt'),
        'description'           => __('Member Description', 'flynt'),
        'labels'                => $labels,
        'supports'              => ['title', 'editor', 'revisions'],
        'filter'            => ['team'],
        'taxonomies'            => [''],
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
    ];

    register_post_type('member', $args);
});
