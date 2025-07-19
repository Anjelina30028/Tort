<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/reset.css" />
  <link rel="stylesheet" href="css/style.css" />
  <title>Будешь торт?</title>
  <style>
    /* Вставьте сюда обновленные стили */
  </style>
</head>

<body>
  <? require_once __DIR__ . '/../components/header.php'; ?>

  <main>
    <section class="login-form">
      <div class="login-img-container">
        <img src="img/login-bg.jpg" alt="" />
      </div>
      <form action="/auth" class="login" method="post">
        <p>Вход</p>
        <?php
          if (isset($_GET['message'])){
            ?>
              <p style="font-size: 20px;"><?=$_GET['message']?></p>
            <?php
          }
        ?>
        <div class="inputs">
          <input type="email" name="email" id="" placeholder="E-mail" required />
          <div class="password-container">
            <input type="password" name="password" id="password" placeholder="Пароль" required />
            <button type="button" id="togglePassword" class="eye-icon">
              <img src="img/eye-icon.png" alt="Показать пароль" />
            </button>
          </div>
          <button type="submit">Войти</button>
        </div>
        <div class="links">
          <a href="/registration">
            <p>Зарегестрироваться</p>
          </a>
          <a href="/error">
            <p style="font-size: 20px;">Забыли пароль?</p>
          </a>
        </div>
      </form>
      <div class="login-img-container">
        <img src="img/login-bg.jpg" alt="" />
      </div>
    </section>
  </main>

  <script>
    document.getElementById('togglePassword').addEventListener('click', function () {
      const passwordInput = document.getElementById('password');
      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);
      
      // Изменение иконки
      this.querySelector('img').src = type === 'text' ? 'img/eye-icon.png' : 'img/eye-off-icon.png';
    });
  </script>

  <? require_once __DIR__ . '/../components/footer.php'; ?>
</body>

</html>
