<?php
function getPostTermsbyPostId($postId): ?string
{
    if (! $postId || ! get_post($postId)) {
        return null;
    }

    $postType = get_post_type($postId);

    if ($postType === 'post') {
        return 'category';
    }

    $postTypeObject = get_post_type_object($postType);

    if (
        !empty($postTypeObject->filter) &&
        is_array($postTypeObject->filter) &&
        isset($postTypeObject->filter[0])
    ) {
        return $postTypeObject->filter[0];
    }

    return null;
}