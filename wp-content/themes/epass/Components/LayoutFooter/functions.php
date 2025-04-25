<?php

namespace Flynt\Components\LayoutFooter;

use Timber;
use Flynt\Utils\Asset;
use Flynt\FieldVariables;
use Flynt\Utils\Options;

add_filter('Flynt/addComponentData?name=LayoutFooter', function ($data) {
    if (isset($data['options']['sectionAnchor'])) {
        $data['options']['sectionAnchorLabel'] = $data['options']['sectionAnchor'];
        $data['options']['sectionAnchor'] = preg_replace('/[^A-Za-z0-9]/', '-', strtolower($data['options']['sectionAnchor']));
    }
    $data['contactOptions'] = Options::getGlobal('ContactInfo');
    $data['logo'] = wp_get_attachment_image( get_theme_mod( 'custom_logo' ) , 'full', '', ["class" => "logo"] );
    $data['menuFooterBottom'] = Timber::get_menu('menu_footer_bottom') ?? Timber::get_pages_menu();
    return $data;
});

Options::addGlobal('LayoutFooter', [   
    [
    'label' => __('Copyright Text', 'flynt'),
    'name' => 'copyrightText',
    'type' => 'text',
    ],
]);