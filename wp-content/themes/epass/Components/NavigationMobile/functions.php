<?php

namespace Flynt\Components\NavigationJs;

use Timber;
use Flynt\Utils\Asset;
use Flynt\FieldVariables;
use Flynt\Utils\Options;

add_action('init', function () {
      
  });

add_filter('Flynt/addComponentData?name=NavigationMobile', function ($data) {
  $data['navOptions'] = Options::getGlobal('NavigationOptions');
    $data['menu'] = Timber::get_menu('navigation_primary') ?? Timber::get_pages_menu();
    // $data['menuSecondary'] = Timber::get_menu('navigation_secondary') ?? Timber::get_pages_menu();
    $data['menuExtras'] = Timber::get_menu('navigation_primary_extras') ?? Timber::get_pages_menu();
    $data['logo'] = wp_get_attachment_image( get_theme_mod( 'custom_logo' ) , 'full', '', ["class" => "logo"] );
    //   var_dump($data['menu']);
    return $data;
});