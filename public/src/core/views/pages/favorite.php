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

    use src\core\models\Favorite;
    use src\core\models\Items;
    use src\core\models\Users;

    $items = Favorite::getFavorite($_SESSION['user']['id']);
    ?>

    <? require_once __DIR__ . '/../components/header.php'; ?>

    <main>
<section class="category">
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
                    <form action="/deleteFavorite" method="post" class="form-for-favorite"> 
                        <input type="hidden" name="id" value="<?= $item['id'] ?>">
                    <button class="card-price getItemButton" id="<?= $item['id'] ?>" data-id="<?= $item['id'] ?>">
                        Удалить
                    </button>
                    </form>
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

    <!-- <script src="/js/addToCart.js"></script> -->
    <script>
        const itemsData = <?= json_encode($items) ?>;
    </script>
    <script src="/js/getItem.js"></script>
</body>

</html>