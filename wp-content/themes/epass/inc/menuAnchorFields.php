<?php

function apply_anchors_to_menu_items($items) {
    foreach ($items as $item) {
        $anchor = get_field('addAnchor', $item->ID);
        if (!empty($anchor)) {
            $anchor = ltrim($anchor, '#');
            $item->url .= '#' . $anchor;
        }

        // Recursively apply to children, if they exist
        if (!empty($item->children)) {
            apply_anchors_to_menu_items($item->children);
        }
    }
}