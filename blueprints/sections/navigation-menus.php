<?php

return function () {

  $fields = [];

  foreach (collection('navigation-menus') as $menu) {
    $fields[$menu['name']] = [
      "width" => "1/2",
      "type" => "pages",
      "label" => $menu['label'],
    ];
  }

  return [
    'type' => 'fields',
    'fields' => $fields,
  ];
};
