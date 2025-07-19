<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="slick/slick.css" />
  <link rel="stylesheet" type="text/css" href="slick/slick-theme.css" />
  <link rel="stylesheet" href="css/reset.css" />
  <link rel="stylesheet" href="css/style.css" />

  <title>Будешь торт?</title>
</head>

<body>
  <?

  use src\core\models\Items;
  use src\core\models\Orders;

  $items = Items::getItems();
  $categories = Items::getCategories();
  $orders = Orders::getOrders();
  function stringInArray($str)
  {

    $content = trim($str, '{}');

    preg_match_all('/(["\']?)(\d+)\1\s*:\s*(\d+)/', $content, $matches, PREG_SET_ORDER);

    $result = [];

    foreach ($matches as $match) {
      $id = (int)$match[2];
      $quantity = (int)$match[3];
      $result[$id] = $quantity;
    }

    return $result;
  }


  ?>

  <? require_once __DIR__ . '/../components/header.php'; ?>

  <main>
    <section class="admin">
      <div class="nav_admin" id="navbar">
        <a href="/admin#search">Поиск</a>
        <a href="/admin#add">Добавить товар</a>
        <a href="/admin#catalog">Каталог</a>
        <a href="/admin#order">Заказы</a>

      </div>

      <form method="GET" action="/admin" id="search">
        <p>Найти товар</p>
        <input type="text" name="search" placeholder="Поиск...">
        <button type="submit">Найти</button>
      </form>

      <form action="/addItem" method="post" id="add">
        <p>Добавить товар</p>
        <p>Название</p>
        <input type="text" name="name">
        <p>Цена</p>
        <input type="number" name="price">
        <p>Категория</p>
        <select name="category" id="">
          <?php foreach ($categories as $category): ?>
            <option value="<?= $category['category_id'] ?>">
              <?= $category['category_name'] ?>
            </option>
          <?php endforeach; ?>
          <option value="add_new">➕ Добавить новую</option>
        </select>

        <button type="submit">Добавить</button>
      </form>

      <form action="/addCategory" id="add-category-form"  style="display: none" method="post">
        <p>Добавить новую категорию</p>
        <input type="text" name="category_name" placeholder="Название категории" required>
        <button type="submit">Добавить категорию</button>
      </form>

      <div class="catalog" id="catalog">
        <? foreach ($items as $item) { ?>
          <a href="/admin/item?id=<?= $item['id'] ?>" class="card">
            <div class="img-container">
              <img src="<?= $item['image_path'] ?>" alt="Фото карточки" />
            </div>
            <p>
              <?= $item['name'] ?>
            </p>
            <button class="card-price getItemButton">
              <?= $item['price'] ?> ₽
            </button>
          </a>
        <? } ?>
      </div>


      <table id="order" class="styled-table">
        <thead>
          <tr>
            <th>Номер телефона</th>
            <th>Статус</th>
            <th>Позиции</th>
            <th>Действие</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($orders as $order): ?>
            <tr>
              <td>
                <p><?= $order['phone'] ?></p>
              </td>
              <td>
                <p><?= $order['status'] ?></p>
              </td>
              <td>
                <?php
                $orderItems = stringInArray($order['item_id']);
                foreach ($orderItems as $key => $value) {
                  $item = Items::getItem($key);
                ?>
                  <p><?= $item['name'] ?></p>
                  <p>Количество: <?= $value ?></p>
                <?php
                }
                ?>
              </td>
              <td>
                <form action="/changeStatus" method="post">
                  <input type="hidden" name="order_id" id="order_id" value="<?= $order['id'] ?>">
                  <button type="submit" name="status" value="Подтвержден">Подтвердить</button>
                  <button type="submit" name="status" value="Отклонен">Отклонить</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </section>

  </main>

  <? require_once __DIR__ . '/../components/footer.php'; ?>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const categorySelect = document.querySelector("select[name='category']");
      const addCategoryForm = document.getElementById("add-category-form");

      categorySelect.addEventListener("change", function() {
        if (this.value === "add_new") {
          addCategoryForm.style.display = "flex";
        } else {
          addCategoryForm.style.display = "none";
        }
      });
    });
  </script>

</body>

</html>