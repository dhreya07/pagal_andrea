<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>

  <!-- Font Awesome for eye icon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }

    section {
      position: relative;
      display: flex;
      justify-content: center;
      align-items: center;
      width: 100%;
      height: 100vh;
      overflow: hidden;
    }

    section .bg,
    section .trees {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      pointer-events: none;
    }

    section .trees {
      z-index: 100;
    }

    .login {
      position: relative;
      padding: 60px;
      background: rgba(255, 255, 255, 0.25);
      backdrop-filter: blur(15px);
      border: 1px solid #fff;
      border-bottom: 1px solid rgba(255, 255, 255, 0.5);
      border-right: 1px solid rgba(255, 255, 255, 0.5);
      border-radius: 20px;
      width: 500px;
      display: flex;
      flex-direction: column;
      gap: 30px;
      box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
      z-index: 200;
    }

    .login h2 {
      text-align: center;
      font-size: 2.5em;
      font-weight: 600;
      color: #8f2c24;
    }

    .login .inputBox {
      position: relative;
      margin-bottom: 20px;
    }

    .login .inputBox input {
      width: 100%;
      padding: 15px 45px 15px 20px;
      font-size: 1.25em;
      color: #8f2c24;
      border-radius: 5px;
      background: #fff;
      border: none;
    }

    .login .inputBox ::placeholder {
      color: #8f2c24;
    }

    .toggle-password {
      position: absolute;
      right: 15px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      font-size: 1.2em;
      color: #8f2c24;
    }

    .login button {
      width: 100%;
      padding: 15px;
      border: none;
      background: #8f2c24;
      color: #fff;
      font-size: 1.25em;
      font-weight: 500;
      border-radius: 5px;
      cursor: pointer;
      transition: 0.3s;
    }

    .login button:hover {
      background: #d64c42;
    }

    .group {
      text-align: center;
    }

    .group a {
      font-size: 1em;
      color: #8f2c24;
      font-weight: 500;
      text-decoration: none;
    }

    .group a:hover {
      text-decoration: underline;
    }

    /* Leaves animation */
    .leaves {
      position: absolute;
      width: 100%;
      height: 100vh;
      overflow: hidden;
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 1;
      pointer-events: none;
    }

    .leaves .set {
      position: absolute;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
    }

    .leaves .set div {
      position: absolute;
      display: block;
    }

    .leaves .set div:nth-child(1) { left: 20%; animation: animate 20s linear infinite; }
    .leaves .set div:nth-child(2) { left: 50%; animation: animate 14s linear infinite; }
    .leaves .set div:nth-child(3) { left: 70%; animation: animate 12s linear infinite; }
    .leaves .set div:nth-child(4) { left: 5%;  animation: animate 15s linear infinite; }
    .leaves .set div:nth-child(5) { left: 85%; animation: animate 18s linear infinite; }
    .leaves .set div:nth-child(6) { left: 90%; animation: animate 12s linear infinite; }
    .leaves .set div:nth-child(7) { left: 15%; animation: animate 14s linear infinite; }
    .leaves .set div:nth-child(8) { left: 60%; animation: animate 15s linear infinite; }

    @keyframes animate {
      0% { opacity: 0; top: -10%; transform: translateX(20px) rotate(0deg); }
      10% { opacity: 1; }
      20% { transform: translateX(-20px) rotate(45deg); }
      40% { transform: translateX(-20px) rotate(90deg); }
      60% { transform: translateX(20px) rotate(180deg); }
      80% { transform: translateX(-20px) rotate(45deg); }
      100% { top: 110%; transform: translateX(20px) rotate(225deg); }
    }
  </style>
</head>
<body>
  <section>
    <div class="leaves">
      <div class="set">
        <div><img src="/public/images/leaf_03.png"></div>
        <div><img src="/public/images/leaf_02.png"></div>
        <div><img src="/public/images/leaf_03.png"></div>
        <div><img src="/public/images/leaf_04.png"></div>
        <div><img src="/public/images/leaf_01.png"></div>
        <div><img src="/public/images/leaf_02.png"></div>
        <div><img src="/public/images/leaf_03.png"></div>
        <div><img src="/public/images/leaf_04.png"></div>
      </div>
    </div>

    <img src="/public/images/bg.jpg" class="bg">
    <img src="/public/images/trees.png" class="trees">

    <div class="login">
      <h2>Login</h2>

      <?php if (!empty($error)): ?>
        <div style="background: rgba(255,0,0,0.1); color: #d64c42; padding: 10px; border: 1px solid #d64c42; border-radius: 5px; margin-bottom: 15px; text-align: center; font-size: 0.95em;">
          <?= $error ?>
        </div>
      <?php endif; ?>

      <form method="post" action="<?= site_url('auth/login') ?>">
        <div class="inputBox">
          <input type="text" placeholder="Username" name="username" required>
        </div>

        <div class="inputBox">
          <input type="password" placeholder="Password" name="password" id="password" required>
          <i class="fa-solid fa-eye toggle-password" id="togglePassword"></i>
        </div>

        <button type="submit" id="btn">Login</button>
      </form>

      <div class="group">
        <p style="font-size: 0.9em;">
          Don't have an account? <a href="<?= site_url('auth/register'); ?>">Register here</a>
        </p>
      </div>
    </div>
  </section>

  <script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function () {
      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
      password.setAttribute('type', type);

      // Toggle between fa-eye and fa-eye-slash
      this.classList.toggle('fa-eye');
      this.classList.toggle('fa-eye-slash');
    });
  </script>
</body>
</html>
