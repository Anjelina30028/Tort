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

  $items = Items::getItems()
  ?>

  <? require_once __DIR__ . '/../components/header.php'; ?>

  <main>
    <section class="delivery">
      <h1>Категории</h1>
      <div class="delivery-block-container">
        <div class="img-container">
          <img src="img/delivery.png" alt="">
        </div>
        <div class="delivery-block-text">
          <h1>Бесплатная доставка</h1>
          <p>В городе Красноярск доставка до дома и вручение лично в руки от 3 500 ₽
          </p>
        </div>
      </div>
      <div class="delivery-block-container">
        <div class="img-container" style="height: 270px;">
          <img src="img/warehouse.png" alt="">
        </div>
        <div class="delivery-block-text">
          <div>
            <h1>Оплата наличными</h1>
            <p>Вы можете оплатить свой заказ наличными при получении в нашем магазине или при доставке. Это быстрый и
              простой способ, который позволяет вам мгновенно наслаждаться нашими сладостями!</p>
          </div>

          <div>
            <h1>Перевод на карту</h1>
            <p>
              Также вы можете воспользоваться переводом на карту. Просто выберите этот способ оплаты при оформлении
              заказа, и мы отправим вам необходимые реквизиты. Это надежный и безопасный вариант, который позволяет вам
              совершать покупки не выходя из дома!</p>
          </div>
        </div>
      </div>
      <div class="delivery-block-container">
        <div class="img-container">
          <img src="img/details.png" alt="">
        </div>
        <div class="delivery-block-text">
          <div>
            <h1>Время доставки</h1>
            <p>
              Мы осуществляем доставку тортов с 10:00 до 20:00. Вы можете выбрать подходящее время при оформлении
              заказа. Пожалуйста, сообщите нам, если у вас есть предпочтения по времени доставки!</p>
          </div>
          <div>
            <h1>География доставки</h1>
            <p>
              Мы доставляем по следующим районам:
              Железнодорожный, Кировский, Ленинский, Октябрьский, Свердловский, Советский, Центральный. Если вы
              находитесь за пределами этого списка, свяжитесь с нами, и мы постараемся предложить вам подходящее
              решение!</p>
          </div>
          <div>
            <h1>Упаковка</h1>
            <p>
              Наши торты упаковываются в специальные коробки, чтобы обеспечить их безопасность во время транспортировки.
              Мы заботимся о том, чтобы каждая деталь была сохранена, и ваш десерт по прибытии выглядел идеально.</p>
          </div>
        </div>
      </div>
    </section>
  </main>
    <div class="overlay hidden" id="overlay">
      <div id="popup-content" class="item-popup"></div>
    </div>
  </main>
  <? require_once __DIR__ . '/../components/footer.php'; ?>

  <script>
    const itemsData = <?= json_encode($items) ?>;
  </script>
  <script src="/js/getItem.js"></script>
  <script src="/js/popup.js"></script>
</body>

</html>