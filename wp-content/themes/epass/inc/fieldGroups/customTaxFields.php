<?php

use ACFComposer\ACFComposer;
use Flynt\Components;

add_action('Flynt/afterRegisterComponents', function () {
  ACFComposer::registerFieldGroup([
    'name' => 'Category Fields',
    'title' => 'Custom Category Fields',
    'style' => 'default',
    'fields' => [
      [
      'label' => __('Featured Image', 'flynt'),
      'name' => 'catImage',
      'type' => 'image',
      ],       
           
    ],
    'location' => [
      [
        [
          'param' => 'taxonomy',
          'operator' => '==',
          'value' => 'category'
        ]
      ]
    ]
  ]);
});
