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
        use src\core\models\Orders;

        $orders = Orders::getHistory($_SESSION['user']['id']);

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

          <table id="order" class="styled-table">
              <thead>
                  <tr>
                      <th>Номер телефона</th>
                      <th>Статус</th>
                      <th>Позиции</th>
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
                      </tr>
                  <?php endforeach; ?>
              </tbody>
          </table>


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