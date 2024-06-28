<?php

Kirby::plugin('vv/navigation-menus', [

  'collections' => [
    'navigation-menus' => function () {
      return option('vv.navigation-menus.menus');
    },
  ],

  'blueprints' => [
    'blocks/navigation-menu' => include __DIR__ . '/blueprints/blocks/navigation-menu.php',
    'sections/navigation-menus' => include __DIR__ . '/blueprints/sections/navigation-menus.php',
  ],

  'snippets' => [
    'blocks/navigation-menu' => __DIR__ . '/snippets/blocks/navigation-menu.php',
    'navigation-menu' => __DIR__ . '/snippets/navigation-menu.php',
  ],

  'siteMethods' => [

    'navPages' => function ($key) {
      $menu = collection('navigation-menus')[$key] ?? null;
      if (is_array($menu) && isset($menu['name'])) {
        $navPages = $this->content()->get($menu['name']);
          if ($navPages) {
            return $navPages->toPages();
          }
        }
      return null;
    },

    'navigationProps' => function ($key) {
      $menu = collection('navigation-menus')[$key] ?? null;
      $navPages = $this->navPages($key);
      return [
        'navPages' => $navPages ?? null,
        'attrs' => [
          'id' => $menu['id'],
          'aria-label' => $menu['ariaLabel'],
        ],
      ];
    },

  ],

  'pageMethods' => [

    'isCurrentPage' => function ($navItem) {
      return $this->slug() === $navItem->slug();
    },

    'isInMenu' => function ($key) {
      $navPages = site()->navPages($key) ?? null;
      if (!$navPages) {
        return false;
      }
      $isInMenu = $navPages->find($this->uid()) !== null;
      return $isInMenu;
    },

    'prevInMenu' => function ($key) {
      $navPages = site()->navPages($key) ?? null;
      if (!$navPages) {
        return null;
      }
      $index = $navPages->indexOf($this->uid());

      if ($index === 0) {
        return null;
      }

      return $navPages->nth($index - 1);
    },

    'nextInMenu' => function ($key) {
      $navPages = site()->navPages($key) ?? null;
      if (!$navPages) {
        return null;
      }
      $index = $navPages->indexOf($this->uid());

      if ($index === $navPages->count() - 1) {
        return null;
      }

      return $navPages->nth($index + 1);
    },

    'hasPrevInMenu' => function ($key) {
      return $this->prevInMenu($key) !== null;
    },

    'hasNextInMenu' => function ($key) {
      return $this->nextInMenu($key) !== null;
    },
  ],
]);
