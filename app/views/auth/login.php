<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>

  <!-- Font Awesome for eye icon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #60a5fa, #6366f1);
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      margin: 0;
    }

    /* Card Container */
    .login-card {
      background: rgba(255, 255, 255, 0.95);
      padding: 2rem;
      border-radius: 1rem;
      width: 100%;
      max-width: 380px;
      box-shadow:
        0 6px 20px rgba(0, 0, 0, 0.6),
        0 0 12px rgba(59, 130, 246, 0.6);
      animation: borderGlow 3s infinite ease-in-out;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      text-align: center;
    }

    .login-card:hover {
      transform: translateY(-4px) scale(1.01);
      box-shadow:
        0 8px 25px rgba(0, 0, 0, 0.7),
        0 0 20px rgba(59, 130, 246, 0.8),
        0 0 30px rgba(99, 102, 241, 0.6);
    }

    @keyframes borderGlow {
      0%   { box-shadow: 0 6px 20px rgba(0,0,0,0.6), 0 0 10px rgba(59,130,246,0.5); }
      50%  { box-shadow: 0 6px 20px rgba(0,0,0,0.6), 0 0 20px rgba(99,102,241,0.7); }
      100% { box-shadow: 0 6px 20px rgba(0,0,0,0.6), 0 0 10px rgba(59,130,246,0.5); }
    }

    /* Title */
    .login-title {
      font-size: 1.8rem;
      font-weight: bold;
      margin-bottom: 1.5rem;
      color: #1f2937;
    }

    /* Error message */
    .error-message {
      background: #fee2e2;
      color: #b91c1c;
      padding: 0.6rem;
      border-radius: 0.5rem;
      font-size: 0.9rem;
      margin-bottom: 1rem;
    }

    /* Form */
    .login-form {
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    .form-group {
      text-align: left;
    }

    .form-group label {
      font-size: 0.9rem;
      font-weight: 600;
      color: #374151;
      margin-bottom: 0.3rem;
      display: block;
    }

    .form-group input {
      width: 100%;
      padding: 0.6rem 0.75rem;
      border: 1px solid #d1d5db;
      border-radius: 0.5rem;
      font-size: 1rem;
      outline: none;
      transition: border 0.3s, box-shadow 0.3s;
    }

    .form-group input:focus {
      border-color: #3b82f6;
      box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25);
    }

    /* Password wrapper (fix overflow) */
    .password-wrapper {
      position: relative;
      display: flex;
      align-items: center;
    }

    .password-wrapper input {
      padding-right: 2.5rem;
      box-sizing: border-box;
    }

    .toggle-password {
      position: absolute;
      right: 12px;
      color: #6b7280;
      cursor: pointer;
      font-size: 1rem;
      transition: color 0.3s;
    }

    .toggle-password:hover {
      color: #111827;
    }

    /* Button */
    .btn-login {
      background: #2563eb;
      color: #fff;
      border: none;
      padding: 0.8rem;
      border-radius: 0.5rem;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.3s, transform 0.2s, box-shadow 0.3s;
    }

    .btn-login:hover {
      background: #1d4ed8;
      transform: scale(1.03);
      box-shadow: 0 0 12px rgba(37, 99, 235, 0.6);
    }

    /* Register link */
    .register-text {
      margin-top: 1rem;
      font-size: 0.9rem;
      color: #374151;
    }

    .register-text a {
      color: #2563eb;
      font-weight: 600;
      text-decoration: none;
    }

    .register-text a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="login-card">
    <h2 class="login-title">Login</h2>

    <?php if (!empty($error)): ?>
      <div class="error-message">
        <?= $error ?>
      </div>
    <?php endif; ?>

    <form method="post" action="<?= site_url('auth/login') ?>" class="login-form">
      <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" placeholder="Enter your username" required>
      </div>

      <div class="form-group">
        <label>Password</label>
        <div class="password-wrapper">
          <input type="password" name="password" id="password" placeholder="Enter your password" required>
          <i class="fa-solid fa-eye toggle-password" id="togglePassword"></i>
        </div>
      </div>

      <button type="submit" class="btn-login">Login</button>
    </form>

    <p class="register-text">
      Don’t have an account? <a href="<?= site_url('auth/register'); ?>">Register here</a>
    </p>
  </div>

  <script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function () {
      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
      password.setAttribute('type', type);
      this.classList.toggle('fa-eye');
      this.classList.toggle('fa-eye-slash');
    });
  </script>
</body>
</html>