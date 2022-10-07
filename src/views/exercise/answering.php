<main class="container">
  <ul class="ansering-list">
    <?php foreach ($data['exercises'] as $exercise) : ?>
      <li class="row">
        <div class="column card">
          <div class="title"><?= $exercise->getTitle() ?></div>
          <a class="button" href="/<?= $data['router']->getUrl("newFulfillment", ["id" => $exercise->getID()]) ?>">Take it</a>
        </div>
      </li>
    <?php endforeach; ?>
  </ul>
</main>