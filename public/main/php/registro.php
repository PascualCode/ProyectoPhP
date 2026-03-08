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

        <?php if (isset($_GET['error'])): ?>
            <div class="error"><?php echo htmlspecialchars($_GET['error']); ?></div>
        <?php endif; ?>


        <?php if (isset($_GET['success'])): ?>
            <div class="success"> Usuario registrado correctamente. Redirigiendo... </div>
            <script>
                setTimeout(function() {
                    window.location.href = "/../../index.php";
                }, 2000); // 2000 ms = 2 segundos
            </script>
        <?php endif; ?>

        <form action='/../controller/processors/procRegistro.php' method="POST" class="login__form">
          <h1 class="login__title">login</h1>

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
                <input type="password" name="password" required class="login__input" id="login-pas" placeholder="Password">
                <i class="ri-eye-off-line login__eye"></i>
               </div>
            </div>

            <div class="login__box">
              <i class="ri-lock-2-line login__icon"></i>


              <div class="login__box-input">
                <input type="password" name="password2" required class="login__input" id="login-pas" placeholder="Repeat Your Password">
                <i class="ri-eye-off-line login__eye"></i>
               </div>
            </div>
          </div>

          <button type="submit" class="login__button">Register</button>
        </form>
      </div>

      <!--<============ Main Js ============-->

      <script>/*--================== Show Hidden - Password =================*/
        const showHiddenPass = (loginPass, LoginEye) =>{
        const input = document.getElementById(loginPass),
        iconEye = document.getElementById(LoginEye)

        iconEye.addEventListener('click', () =>{
          //change password to text 
          if(input.type === 'password'){
            //switch to text 
            input.type = 'text'

            //Icon chnage
            iconEye.classList.add('ri-eye-line')
            iconEye.classList.remove('ri-eye-off-line')
          } else{

            //change to password
            input.type ='password'


            //Icon change 
            iconEye.classList.remove('ri-eye-line')
            iconEye.classList.add('ri-eye-off-line')

          }
        })
      }

      showHiddenPass('login-pass',' login-eye')</script>
</body>

<?php
require_once __DIR__ . '/../../templates/footer.php';
?>