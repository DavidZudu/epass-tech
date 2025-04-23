<?php

namespace Flynt\Components\LayoutBasicHeader;

use Flynt\FieldVariables;

add_filter('Flynt/addComponentData?name=LayoutBasicHeader', function ($data) {
    if (isset($data['options']['sectionAnchor'])) {
        $data['options']['sectionAnchorLabel'] = $data['options']['sectionAnchor'];
        $data['options']['sectionAnchor'] = preg_replace('/[^A-Za-z0-9]/', '-', strtolower($data['options']['sectionAnchor']));
    }

    return $data;
});

// function getACFLayout()
// {
//     return [
//         'name' => 'LayoutBasicHeader',
//         'label' => __('Layout: Basic Header', 'flynt'),
//         'sub_fields' => [
           
           
//         ],
//     ];
// }

// Options::addTranslatable('NavigationJs', [

// ]);

// Options::addGlobal('NavigationJs', [

// ]);
