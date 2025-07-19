<?php 
session_start(); // Начинаем сессию

// Проверка на то, авторизован ли пользователь
$isUserLoggedIn = isset($_SESSION['user']); // Проверяем, есть ли в сессии данные о пользователе

// Для роли администратора можно сделать дополнительную проверку
$isAdmin = isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin';

  use src\core\models\Items;
  $items = Items::getItems();

?>

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
     
    <?php require_once __DIR__ . '/../components/header.php'; ?>


    <main>
      <section class="contact-form">
        <div class="contact-img-container">
          <img src="img/contacts.jpg" alt="" />
        </div>

        <form action="submit_review.php" class="contact" method="post">
          <p>Оставь отзыв о компании</p>
          
          <!-- Проверяем, если пользователь авторизован -->
          <?php if ($isUserLoggedIn): ?>
            <div class="inputs">
              <input type="text" name="name" placeholder="Имя" required />
              <textarea name="review" cols="30" rows="5" placeholder="Расскажите, что Вам понравилось" required></textarea>
            </div>
            <button type="submit">Отправить</button>
          <?php else: ?>
            <p style="font-size: 20px;">Чтобы оставить отзыв, вам нужно <a href="/login">войти</a>.</p>
          <?php endif; ?>

        </form>

        <div class="contact-img-container">
          <img src="img/contacts.jpg" alt="" />
        </div>
      </section>

      <h1>Где мы находимся?</h1>
      <div class="map">
        <script
          type="text/javascript"
          charset="utf-8"
          async
          src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Adeee64320ff3712926a91f47b61b6c4a9eb6e680c2d318eb4479466536561254&amp;width=100%25&amp;height=400&amp;lang=ru_RU&amp;scroll=true"
        ></script>
      </div>
      <h1>Наши Контакты</h1>
      <p class="address">
        Адрес: г.Красноярск, ул.Сурикова, 28 <br> Телефон: +7-999-446-36-07
      </p>
      
    </main>
    <div class="overlay hidden" id="overlay">
      <div id="popup-content" class="item-popup"></div>
    </div>
  </main>
    <?php require_once __DIR__ . '/../components/footer.php'; ?>
  </body>
    <script>
    const itemsData = <?= json_encode($items) ?>;
  </script>
  <script src="/js/getItem.js"></script>
</html>