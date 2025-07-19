<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/reset.css" />
  <link rel="stylesheet" href="css/style.css" />
  <title>Будешь торт?</title>
</head>

<body>
  <? require_once __DIR__ . '/../components/header.php'; ?>

  <main>
    <section class="login-form">
      <div class="login-img-container">
        <img src="img/login-bg.jpg" alt="" />
      </div>
      <form id="registrationForm" action="/reg" class="login" method="post">
        <p>Регистрация</p>
        <div class="inputs">
          <input type="email" name="email" id="email" placeholder="E-mail" required />
          <input type="password" name="password" id="password" placeholder="Пароль" required />
          <input type="password" name="password_ver" id="password_ver" placeholder="Повторите пароль" required />
          <button type="submit">Зарегестрироваться</button>
        </div>
        <div class="links">
          <a href="/login">
            <p>Войти</p>
          </a>
        </div>
      </form>
      <div class="links">
        <p>* Промокоды вы сможете увидеть только после регистрации  </p>
      </div>
      <div class="login-img-container">
        <img src="img/login-bg.jpg" alt="" />
      </div>
    </section>
  </main>

  <script>
    document.getElementById('registrationForm').addEventListener('submit', function(event) {
      const email = document.getElementById('email').value;
      const password = document.getElementById('password').value;
      const passwordVer = document.getElementById('password_ver').value;

      let valid = true;
      let errorMessage = '';

      // Валидация email
      const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
      if (!emailPattern.test(email)) {
        errorMessage += 'Введите правильный E-mail.\n';
        valid = false;
      }

      // Валидация пароля
      if (password.length < 6) {
        errorMessage += 'Пароль должен содержать не менее 6 символов.\n';
        valid = false;
      }

      // Проверка совпадения паролей
      if (password !== passwordVer) {
        errorMessage += 'Пароли не совпадают.\n';
        valid = false;
      }

      // Если есть ошибки, предотвратить отправку формы
      if (!valid) {
        alert(errorMessage);
        event.preventDefault();
      }
    });
  </script>

  <? require_once __DIR__ . '/../components/footer.php'; ?>
</body>

</html>