<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/reset.css" />
  <link rel="stylesheet" href="css/style.css" />
  <title>Будешь торт?</title>
</head>

<body>
    <?
    use src\core\models\Items;
    $items=Items::getItems()
    ?>

  <? require_once __DIR__ . '/../components/header.php'; ?>
  <main>
      <section class="banner-top">
        <img src="svg\Frame 2banner_2 (2).svg" alt="">
        <div class="banner-text">
          <h1>Новая скидка 50% на первый заказ! <br> Давайте сделаем ваше событие <br> незабываемым!</h1>
        </div>
      </section>


    <h1>Специальные предложения</h1>

    <section class="catalog">
      <div class="card" data-id="<?= $items[5]['id'] ?>">
        <div class="img-container">
          <img src="<?= $items[5]['image_path'] ?>" alt="" />
        </div>
        <p>
          <?= $items[5]['name'] ?>
        </p>
        <button class="card-price getItemButton" data-id="<?= $items[5]['id'] ?>">
          <?= $items[5]['price'] ?> ₽
        </button>
      </div>
      <div class="card" data-id="<?= $items[6]['id'] ?>">
        <div class="img-container">
          <img src="<?= $items[6]['image_path'] ?>" alt="" />
        </div>
        <p>
          <?= $items[6]['name'] ?>
        </p>
        <button class="card-price getItemButton" data-id="<?= $items[6]['id'] ?>">
          <?= $items[6]['price'] ?> ₽
        </button>
      </div>
      <div class="card-wide" data-id="<?= $items[4]['id'] ?>">
        <div class="img-container">
          <img src="<?= $items[4]['image_path'] ?>" alt="" />
        </div>
        <div class="card-wide-text-stick">
          <h1>
            <?= $items[4]['name'] ?>
          </h1>
          <p>
            <?= $items[4]['card_description'] ?>
          </p>
          <button class="white-button getItemButton" data-id="<?= $items[4]['id'] ?>">
            <?= $items[4]['price'] ?> ₽
          </button>
        </div>
      </div>
    </section>

    <h1>Выгодная цена</h1>

    <section class="catalog">
      <div class="card-wide" data-id="<?= $items[9]['id'] ?>">
        <div class="img-container">
          <img src="<?= $items[9]['image_path'] ?>" alt="" />
        </div>
        <div class="card-wide-text-stick">
          <h1>
            <?= $items[9]['name'] ?>
          </h1>
          <p>
            <?= $items[9]['card_description'] ?>
          </p>
          <button class="white-button getItemButton" data-id="<?= $items[9]['id'] ?>">
            <?= $items[9]['price'] ?> ₽
          </button>
        </div>
      </div>
      <div class="card" data-id="<?= $items[7]['id'] ?>">
        <div class="img-container">
          <img src="<?= $items[7]['image_path'] ?>" alt="" />
        </div>
        <p>
          <?= $items[7]['name'] ?>
        </p>
        <button class="card-price getItemButton" data-id="<?= $items[7]['id'] ?>">
          <?= $items[7]['price'] ?> ₽
        </button>
      </div>
      <div class="card" data-id="<?= $items[8]['id'] ?>">
        <div class="img-container">
          <img src="<?= $items[8]['image_path'] ?>" alt="" />
        </div>
        <p>
          <?= $items[8]['name'] ?>
        </p>
        <button class="card-price getItemButton" data-id="<?= $items[8]['id'] ?>">
          <?= $items[8]['price'] ?> ₽
        </button>
      </div>
    </section>
    <div class="overlay hidden" id="overlay">
      <div id="popup-content" class="item-popup"></div>
    </div>
  </main>

  <? require_once __DIR__ . '/../components/footer.php'; ?>

  <script>
    const itemsData = <?= json_encode($items) ?>;
  </script>
  <script src="/js/getItem.js"></script>
</body>

</html>