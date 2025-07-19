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
  $items = Items::getPopularItems(4, 0)
    ?>

  <? require_once __DIR__ . '/../components/header.php'; ?>

  <main>
    <section class="categories">
      <h1>Категории</h1>
      <div class="category-container">
        <a href="/category?category=Свадебные торты"
          class="category-short">
          <img src="svg/cat_wedding.svg" alt="">
          <p>Свадебные торты</p>
        </a>
        <a href="/category?category=Капкейки в ассортименте"
          class="category-long">
          <img src="svg/cat_cap.svg" alt="">
          <p>Капкейки в ассортименте</p>
        </a>
      </div>
      <div class="category-container">
        <a href="/category?category=Зефир в ассортименте"
          class="category-long">
          <img src="svg/cat_zephyr.svg" alt="">
          <p>Зефир в ассортименте</p>
        </a>
        <a href="/category?category=Торты на день рождение"
          class="category-short">
          <img src="svg/cat_bday.svg" alt="">
          <p>Торты на день рождение</p>
        </a>
      </div>
    </section>

    <section class="items">
      <h1>Популярное</h1>
      <div class="catalog">
        <?
        foreach ($items as $item) { ?>
          <div class="card" data-id="<?= $item['id'] ?>">
            <div class="img-container">
              <img src="<?= $item['image_path'] ?>" alt="" />
            </div>
            <p>
              <?= $item['name'] ?>
            </p>
            <button class="card-price getItemButton" data-id="<?= $item['id'] ?>">
              <?= $item['price'] ?> ₽
            </button>
          </div>
        <? }
        ?>

      </div>
    </section>

    <section class="tips">
      <h1>Памятки</h1>
      <div class="tips-container">
        <div class="tip tip1-bg">
          <p>Как рассчитать количество килограмм торта по количеству человек?</p>
          <button
            class="green-button open-popup" data-target="popup1">Читать</игее>
        </div>
        <div class="tip tip2-bg">
          <p>Как выбрать начинку для торта?</p>
          <button
            class="green-button open-popup" data-target="popup2">Читать</button>
        </div>
      </div>
    </section>
    <div class="overlay hidden" id="overlay">
      <div id="popup-content" class="item-popup"></div>
    </div>


    <div class="tip__popup" id="popup1">
      <img class="tip1__image" src="/img/levels.png" alt="">
      <div class="center">
        <button class="green-button close-popup">Закрыть</button>
      </div>
    </div>

    <div class="tip__popup" id="popup2">
      <div class="blur">

      </div>
      <div class="tip2__popup__header">Как выбрать начинку</div>
      <hr>
      <div class="tip2__popup__text">
        <p>Начинки стоит выбирать из общего предпочтения гостей, самый нижний и самый большой ярус лучше выбирать без
          аллергенов, например, такие как арахис. А вот первый ярус начинки выбирается по Вашим вкусовым предпочтениям и
          ваших родителей. Так как первые кусочки обычно нарезаются для них.
          <br><br>
          Количество начинок ограничивается количеством ярусов. Можно сделать каждый ярус разным, а можно выбрать одну
          начинку на все, оба варианты по-своему удобны, в первом случае у гостей есть возможность самостоятельно
          выбрать вкус, во втором случае никто не расстроится, если ему не достанется желаемый кусочек.
        </p>
      </div>
      <div class="center">
        <button class="green-button close-popup">Закрыть</button>
      </div>
    </div>
  </main>

  <? require_once __DIR__ . '/../components/footer.php'; ?>
</body>

<script>
  const itemsData = <?= json_encode($items) ?>;
</script>
<script src="/js/getItem.js"></script>
<script src="/js/popup.js"></script>

</html>