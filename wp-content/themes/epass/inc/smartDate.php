<?php
function smartDate($date): string
{
    if (empty($date)) {
        return '';
    }

    $timestamp = is_numeric($date) ? (int) $date : strtotime($date);
    $now = time();
    $diff = $now - $timestamp;

    if ($diff < 0) {
        return date('j M \'y', $timestamp);
    }

    $days = floor($diff / 86400);

    if ($days === 0) {
        return 'Today';
    }

    if ($days < 7) {
        return $days == 1 ? 'Yesterday' : "{$days} days ago";
    }

    if ($days < 21) {
        $weeks = floor($days / 7);
        return $weeks == 1 ? 'Last week' : "{$weeks} weeks ago";
    }

    return date('j M \'y', $timestamp);
}
