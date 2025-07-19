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
<a href=""></a>
<body>
  <?
  use src\core\models\Items;
  use src\core\models\Users;

  $items = Items::getItems();
  ?>

  <? require_once __DIR__ . '/../components/header.php'; ?>

  <main>
    <section class="banner">
      <img class="banner-art" src="svg/banner1.svg" alt="">
      <div class="banner-text">
        <p>
          Погрузитесь в мир нежных сладостей! <br> У нас вы найдете тортики на любой вкус – <br>от классических до
          авторских.<br>
          Заказывайте сейчас и сделайте свой <br> праздник по-настоящему незабываемым!
        </p>
        <a class="button" href="/catalog">Выбрать сладость</a>
      </div>
    </section>


    <section class="catalog">
      <div class="card" data-id="<?= $items[0]['id'] ?>">
        <div class="img-container">
          <img src="<?= $items[0]['image_path'] ?>" alt="" />
        </div>
        <p>
          <?= $items[0]['name'] ?>
        </p>
        <button class="card-price getItemButton" data-id="<?= $items[0]['id'] ?>">
          <?= $items[0]['price'] ?> ₽
        </button>
      </div>
      <div class="card" data-id="<?= $items[1]['id'] ?>">
        <div class="img-container">
          <img src="<?= $items[1]['image_path'] ?>" alt="" />
        </div>
        <p>
          <?= $items[1]['name'] ?>
        </p>
        <button class="card-price getItemButton" data-id="<?= $items[1]['id'] ?>">
          <?= $items[1]['price'] ?> ₽
        </button>
      </div>
      <div class="card-wide">
        <div class="img-container">
          <img src="img/malahit.jpg" alt="" />
        </div>
        <div class="card-wide-text">
          <h1>Лучшие предложения</h1>
          <p>
            Все самые выгодные предложения собраны в подборке вам стоит на нее взглянуть
          </p>
          <a class="white-button" href="/catalog">Выбрать предложение</a>
        </div>
      </div>
    </section>

    <section class="banner-bottom">
      <img class="banner-art" src="svg/banner2.svg" alt="">
      <div class="banner-text">
        <p>
          Свадебные торты мечты! <br> Создайте идеальный момент с нашим уникальным дизайном и вкусом. Закажите свадебный
          торт, который станет ярким акцентом вашего праздника! Празднуйте с любовью и сладостью!
        </p>
        <a href="/catalog" class="button">Выбрать сладость</a>
      </div>
    </section>

    <section class="catalog">
      <div class="card-wide">
        <div class="img-container-bottom">
          <img src="img/tortik15.jpg" alt="" />
        </div>
        <div class="card-wide-text">
          <h1>Удобный заказ</h1>
          <p>
            Залог экономии вашего времени и уверенности в получении нужных товаров без лишних хлопот
          </p>
          <a class="white-button" href="/delivery">Подробнее</a>
        </div>
      </div>
      <div class="card" data-id="<?= $items[2]['id'] ?>">
        <div class="img-container">
          <img src="<?= $items[2]['image_path'] ?>" alt="" />
        </div>
        <p>
          <?= $items[2]['name'] ?>
        </p>
        <button class="card-price getItemButton" data-id="<?= $items[2]['id'] ?>">
          <?= $items[2]['price'] ?> ₽
        </button>
      </div>
      <div class="card" data-id="<?= $items[3]['id'] ?>">
        <div class="img-container">
          <img src="<?= $items[3]['image_path'] ?>" alt="" />
        </div>
        <p>
          <?= $items[3]['name'] ?>
        </p>
        <button class="card-price getItemButton" data-id="<?= $items[3]['id'] ?>">
          <?= $items[3]['price'] ?> ₽
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