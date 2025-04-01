<?php

/**
 * Add Twig extensions.
 */

namespace Flynt\TwigExtensions;

use Flynt\Utils\TwigExtensionRenderComponent;
use Flynt\Utils\TwigExtensionReadingTime;
use Flynt\Utils\TwigExtensionPlaceholderImage;
use Twig\Environment;

add_filter('timber/twig', function (Environment $twig): Environment {
    $twig->addExtension(new TwigExtensionRenderComponent());
    $twig->addExtension(new TwigExtensionReadingTime());
    $twig->addExtension(new TwigExtensionPlaceholderImage());
    return $twig;
});

add_filter('timber/twig', function ($twig) {
    $twig->addFunction(new \Twig\TwigFunction('inline_svg', function ($path) {
        $fullPath = get_template_directory() . '/' . ltrim($path, '/');
        if (file_exists($fullPath)) {
            return file_get_contents($fullPath);
        }
        return '<!-- SVG not found: ' . esc_html($path) . ' -->';
    }, ['is_safe' => ['html']]));

    return $twig;
});