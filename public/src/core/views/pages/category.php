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

  $items = Items::getCategory();
  ?>

  <? require_once __DIR__ . '/../components/header.php'; ?>

  <main>
    <section class="category">
      <h1>
        <?= $_GET['category'] ?>
      </h1>
      <div class="wrapper">
        <?
        foreach ($items as $item) { ?>
          <div class="card catalog-card" data-id="<?= $item['id'] ?>">
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
    <div class="overlay hidden" id="overlay">
      <div id="popup-content" class="item-popup"></div>
    </div>
  </main>

  <? require_once __DIR__ . '/../components/footer.php'; ?>

</body>

<script>
  const itemsData = <?= json_encode($items) ?>;
</script>
<script src="/js/getItem.js"></script>

</html>