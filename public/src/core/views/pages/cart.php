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
<style>

</style>

<body>
  <?
  use src\core\models\Items;

  $items = Items::getItems();
  $productData = json_encode($items, JSON_UNESCAPED_UNICODE);
  ?>

  <? require_once __DIR__ . '/../components/header.php'; ?>

  <main>
    <h1 class="cart-h">Корзина</h1>

    <section class="cart-pool" id="cart-container"></section>
    <section class="cart-pool">

      <button
        class="cart-button open-popup" style="color: white;" id="total-price" data-target="cart-popup">
        К оформлению <br>
        2 588 ₽
      </button>
    </section>

    <form action="/order" method="post" class="tip__popup" id="cart-popup">
       <button class="fix close-popup">
            <img src="/img/cross.png" class="fix_img" alt="Закрыть">
          </button>
      <p>Оставьте свой номер телефона, чтобы мы связались с вами по поводу оплаты и доставки</p>
      <input type="text"
        name="phone"
        id="phone"
        placeholder="+7(000)000-00-00" required>
      <input type="hidden" id="order" name="order" >
      <div class="center" style="gap: 10px;">
        <button type="submit" id="order" class="green-button close-popup" onclick="localStorage.clear()">Заказать</button>
      </div>
    </form>
  </main>
    <div class="overlay hidden" id="overlay">
      <div id="popup-content" class="item-popup"></div>
    </div>
  </main>
  <? require_once __DIR__ . '/../components/footer.php'; ?>
</body>
<script>
  const cartData = <?= $productData; ?>;
</script>
<script src="/js/viewCart.js"></script>
<script src="https://unpkg.com/imask"></script>
<script src="/js/popup.js"></script>
<script src="/js/phone-mask.js"></script>
  <script>
    const itemsData = <?= json_encode($items) ?>;
  </script>
  <script src="/js/getItem.js"></script>


</html>