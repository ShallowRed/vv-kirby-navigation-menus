<?php

return function () {

  foreach (collection('navigation-menus') as $key => $menu) {
    $options[$key] = [
      'text' => $menu['label'],
      'value' => $key,
    ];
  }

  return [
    'name' => 'Menu de navigation',
    'icon' => 'sitemap',
    'fields' => [
      'menu' => [
        'label' => 'Menu',
        'type' => 'radio',
        'options' => $options,
      ],
    ],
  ];
};
