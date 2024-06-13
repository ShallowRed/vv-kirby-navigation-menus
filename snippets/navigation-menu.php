<?php
$navigationProps = $site->navigationProps($key);
?>
<nav <?php echo attr($navigationProps['attrs'] ?? []);?>>
  <ul>
    <?php foreach ($navigationProps['navPages'] as $navPage) : ?>
    <li>
      <?php $icon = !$page->isCurrentPage($navPage)
      ? ''
      : Html::tag('span', '', ['class' => 'i-ri-arrow-drop-right-line']);
      ?>
      <?php echo Html::a(
          $navPage->url(),
          [$icon . $navPage->title()],
          $page->isCurrentPage($navPage) ? ['aria-current' => 'page'] : []
      ); ?>
    </li>
    <?php endforeach;?>
  </ul>
</nav>
