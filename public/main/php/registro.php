<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../templates/header.php';
require_once __DIR__ . '/../../controller/redirects/redirectIfLogged.php';
require_once __DIR__ . '/../../controller/redirects/redirectIfBlocked.php';
?>

<head>
  <link rel="stylesheet" href="/main/css/log-reg.css">
</head>

<body>
  <div class="login">
    <img src="./../css/img-css/log-reg.jpg" alt="login image" class="login__img">

    <form action='../controller/processors/procRegistro.php' method="POST" class="login__form">
      <h1 class="login__title">login</h1>

      <?php if (isset($_GET['error'])): ?>
        <div class="error">
          <?php echo htmlspecialchars($_GET['error']); ?>
        </div>
      <?php endif; ?>


      <?php if (isset($_GET['success'])): ?>
        <div class="success"> Usuario registrado correctamente. Redirigiendo... </div>
        <script>
          setTimeout(function () {
            window.location.href = "../../index.php";
          }, 2000); // 2000 ms = 2 segundos
        </script>
      <?php endif; ?>

      <div class="login__content">
        <div class="login__box">
          <i class="bx bx-lock-alt"></i>

          <div class="login__box-input">
            <input type="text" name="usuario" required class="login__input" placeholder="Username">
          </div>
        </div>

        <div class="login__box">
          <i class="bx bx-lock-alt"></i>

          <div class="login__box-input">
            <input type="email" name="email" required class="login__input" placeholder="Email">
          </div>
        </div>

        <div class="login__box">
          <i class="ri-lock-2-line login__icon"></i>
          <div class="login__box-input">
            <input type="password" name="password" required class="login__input" id="login-pass1"
              placeholder="Password">
            <i class="ri-eye-off-line login__eye" id="login-eye1"></i>
          </div>
        </div>

        <div class="login__box">
          <i class="ri-lock-2-line login__icon"></i>
          <div class="login__box-input">
            <input type="password" name="password2" required class="login__input" id="login-pass2"
              placeholder="Repeat Your Password">
            <i class="ri-eye-off-line login__eye" id="login-eye2"></i>
          </div>
        </div>
      </div>

      <button type="submit" class="login__button">Register</button>
    </form>
  </div>

  <!--<============ Main Js ============-->

  <script>
    /*--================== Show Hidden - Password =================*/
    const showHiddenPass = (inputId, iconId) => {
      const input = document.getElementById(inputId);
      const iconEye = document.getElementById(iconId);

      iconEye.addEventListener('click', () => {
        if (input.type === 'password') {
          input.type = 'text';
          iconEye.classList.add('ri-eye-line');
          iconEye.classList.remove('ri-eye-off-line');
        } else {
          input.type = 'password';
          iconEye.classList.remove('ri-eye-line');
          iconEye.classList.add('ri-eye-off-line');
        }
      });
    };

    showHiddenPass('login-pass1', 'login-eye1');
    showHiddenPass('login-pass2', 'login-eye2');
  </script>
</body>

<?php
require_once __DIR__ . '/../../templates/footer.php';
?>