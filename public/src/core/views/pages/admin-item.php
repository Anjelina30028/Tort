<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="slick/slick.css" />
  <link rel="stylesheet" type="text/css" href="slick/slick-theme.css" />
  <link rel="stylesheet" href="/css/reset.css" />
  <link rel="stylesheet" href="/css/style.css" />

  <title>Eco Bubble</title>
</head>

<body>
  <?
  use src\core\models\Items;

  $item = Items::getItem();
  $categories = Items::getCategories();
  ?>

  <? require_once __DIR__ . '/../components/header.php'; ?>

  <main>
    <a href="/admin" class="button" style="margin-bottom: 50px; display: block;">Админ панель</a>
    <?php if(isset($_GET['message'])) : ?>
      <h1 style="margin-bottom: 20px;"><?=$_GET['message']?></h1>
    <?php endif; ?>
    <section class="admin">

        <div class="admin-item">
          <form action="/updateItem" method="post"  enctype="multipart/form-data">
            <div class="img-container">
              <img src="/<?= $item['image_path'] ?>" alt="">
            </div>
            <input type="file" name="image" id="">
            <input type="hidden" name="current_image" value="<?=$item['image_path']?>">
            <input type="hidden" name="id" value="<?= $item['id'] ?>">
            <p>Название</p>
            <input type="text" name="name" value="<?= $item['name'] ?>">
            <p>Цена</p>
            <input type="number" name="price" value="<?= $item['price'] ?>">
            <p>Описание в каталоге</p>
            <textarea id="" cols="30" rows="10" name="card_description"><?= $item['card_description'] ?></textarea>
            <p>Категория</p>
            <select name="category" id="">
              <?php foreach ($categories as $category): ?>
                <option <?php if ($category['category_id'] == $item['category']): ?>
                    selected
                  <?php endif; ?> value="<?= $category['category_id'] ?>">
                  <?= $category['category_name'] ?>
                </option>
              <?php endforeach; ?>
            </select>
            <p>Состав</p>
            <textarea id="" cols="30" rows="10" name="compound"><?= $item['compound'] ?></textarea>
            <p>Калорийность</p>
            <input type="number" name="kkal" value="<?= $item['kkal'] ?>">
            <p>Белки</p>
            <input type="text" name="protein" value="<?= $item['protein'] ?>">
            <p>Жиры</p>
            <input type="text" name="fat" value="<?= $item['fat'] ?>">
            <p>Углеводы</p>
            <input type="text" name="carbo" value="<?= $item['carbo'] ?>">
            <p>Углеводы</p>
            <input type="number" name="carbo" value="<?= $item['carbo'] ?>">
            <p>Вес</p>
            <input type="number" name="weight" value="<?= $item['weight'] ?>">
            <p>Популярное</p>
            <label class="popular-switch">
            <input type="checkbox" name="is_popular" <?= $item['is_popular'] == 1 ? 'checked' : '' ?>>
            <span class="slider round"></span>
            </label>
            <button type="submit">Изменить данные</button>
          </form>
          <form action="/deleteItem" method="post">
            <input type="hidden" name="id" value="<?= $item['id'] ?>">
            <button type="submit">Удалить товар</button>
          </form>
        </div>
    </section>
  </main>

  <? require_once __DIR__ . '/../components/footer.php'; ?>

</body>

</html>