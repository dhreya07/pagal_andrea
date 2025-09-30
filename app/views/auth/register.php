<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>

  <!-- Font Awesome for eye icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    body {
      font-family: Arial, sans-serif;
      background: linear-gradient(to right, #60a5fa, #6366f1);
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      margin: 0;
    }

    .form-container {
      background: rgba(255, 255, 255, 0.9);
      padding: 2rem;
      border-radius: 16px;
      box-shadow:
        0 6px 20px rgba(0, 0, 0, 0.6),
        0 0 12px rgba(59, 130, 246, 0.6);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      width: 100%;
      max-width: 400px;
      text-align: center;
      animation: borderGlow 3s infinite ease-in-out;
    }

    .form-container:hover {
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

    h2 {
      margin-bottom: 1rem;
      color: #1e3a8a;
    }

    .error {
      background-color: #fee;
      border: 1px solid #fcc;
      color: #c33;
      padding: 10px;
      margin-bottom: 1rem;
      border-radius: 6px;
      font-size: 0.9rem;
      text-align: left;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    .form-group {
      text-align: left;
      position: relative;
    }

    label {
      font-weight: bold;
      font-size: 0.9rem;
      color: #1e3a8a;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"],
    select {
      width: 100%;
      padding: 10px 40px 10px 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 1rem;
      box-sizing: border-box;
    }

    select {
      padding: 10px;
    }

    .toggle-password {
      position: absolute;
      right: 10px;
      top: 68%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #555;
    }

    button {
      background: #2563eb;
      color: white;
      border: none;
      padding: 0.75rem;
      border-radius: 6px;
      cursor: pointer;
      font-size: 1rem;
      font-weight: bold;
      transition: background 0.3s, transform 0.2s;
    }

    button:hover {
      background: #1e40af;
      transform: scale(1.05);
      box-shadow: 0 0 12px rgba(37, 99, 235, 0.6);
    }

    p {
      margin-top: 1rem;
      font-size: 0.9rem;
    }

    a {
      color: #2563eb;
      text-decoration: none;
      font-weight: 600;
    }

    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Register</h2>

    <?php if(isset($error)): ?>
      <div class="error">
        <?= html_escape($error); ?>
      </div>
    <?php endif; ?>

    <form method="POST" action="<?= site_url('auth/register'); ?>">
      <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" placeholder="Choose a username" required>
      </div>

      <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" placeholder="Enter your email" required>
      </div>

      <div class="form-group">
        <label>Password</label>
        <input type="password" id="password" name="password" placeholder="Create a password" required>
        <i class="fa-solid fa-eye toggle-password" id="togglePassword"></i>
      </div>

      <div class="form-group">
        <label>Role</label>
        <select name="role" required>
          <option value="user" selected>User</option>
          <option value="admin">Admin</option>
        </select>
      </div>

      <button type="submit">Register</button>
    </form>

    <p>
      Already have an account? <a href="<?= site_url('auth/login'); ?>">Login here</a>
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