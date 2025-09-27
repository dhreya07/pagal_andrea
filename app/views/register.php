<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
            gap: 20px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
            
        }

        .login h2 {
            text-align: center;
            font-size: 2.5em;
            font-weight: 600;
            color: #8f2c24;
            margin-bottom: 10px;
        }

        .login .inputBox input,
        .login .inputBox select {
            width: 100%;
            padding: 15px 20px;
            outline: none;
            font-size: 1.1em;
            color: #8f2c24;
            border-radius: 5px;
            background: #fff;
            border: none;
            margin-bottom: 20px;
        }

        .login .inputBox ::placeholder {
            color: #8f2c24;
        }

        .login .inputBox #btn {
            width: 100%;
            padding: 15px;
            border: none;
            outline: none;
            background: #8f2c24;
            color: #fff;
            cursor: pointer;
            font-size: 1.25em;
            font-weight: 500;
            border-radius: 5px;
            transition: 0.5s;
        }

        .login .inputBox #btn:hover {
            background: #d64c42;
        }

        .login .group {
        display: flex;
        justify-content: space-between;
        text-align: center;
        }

        .login .group a {
        font-size: 1.25em;
        color: #8f2c24;
        font-weight: 500;
        text-decoration: none;
        }

        .login .group a:nth-child(2) {
        text-decoration: underline;
        }

        .leaves {
            position: absolute;
            width: 100%;
            height: 100vh;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 100;
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
            0%   { opacity: 0; top: -10%; transform: translateX(20px) rotate(0deg); }
            10%  { opacity: 1; }
            20%  { transform: translateX(-20px) rotate(45deg); }
            40%  { transform: translateX(-20px) rotate(90deg); }
            60%  { transform: translateX(20px) rotate(180deg); }
            80%  { transform: translateX(-20px) rotate(45deg); }
            100% { top: 110%; transform: translateX(20px) rotate(225deg); }
        }
    </style>
</head>
<body>
    <section>
        <!-- Falling Leaves -->
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

        <!-- Background -->
        <img src="/public/images/bg.jpg" class="bg">
        <img src="/public/images/trees.png" class="trees">

        <!-- Register Form -->
        <div class="login">
            <h2>Register</h2>
            <form method="POST" action="<?= site_url('auth/register'); ?>" class="inputBox">
                <input type="text" name="username" placeholder="Username" required>
                <input type="email" name="email" placeholder="Email" required>

                <!-- Password field -->
                <div style="position: relative; margin-bottom: 20px;">
                    <input type="password" id="password" name="password" placeholder="Password" required 
                        style="width: 100%; padding: 15px 45px 15px 20px; border-radius: 5px; border: none; font-size: 1.1em;">
                    <i class="fa-solid fa-eye" id="togglePassword" 
                    style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #8f2c24;"></i>
                </div>

                <!-- Confirm Password field -->
                <div style="position: relative; margin-bottom: 20px;">
                    <input type="password" id="confirmPassword" name="confirm_password" placeholder="Confirm Password" required 
                        style="width: 100%; padding: 15px 45px 15px 20px; border-radius: 5px; border: none; font-size: 1.1em;">
                    <i class="fa-solid fa-eye" id="toggleConfirmPassword" 
                    style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #8f2c24;"></i>
                </div>

                <select name="role" required>
                    <option value="user" selected>User</option>
                    <option value="admin">Admin</option>
                </select>

                <button type="submit" id="btn">Register</button>
            </form>
            <div class="group">
                <p>Already have an account? <a href="<?= site_url('auth/login'); ?>">Login here</a></p>
            </div>
        </div>
    </section>
        <script>
            function toggleVisibility(toggleId, inputId) {
                const toggle = document.getElementById(toggleId);
                const input = document.getElementById(inputId);

                toggle.addEventListener('click', function () {
                    const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                    input.setAttribute('type', type);

                    this.classList.toggle('fa-eye');
                    this.classList.toggle('fa-eye-slash');
                });
            }

            toggleVisibility('togglePassword', 'password');
            toggleVisibility('toggleConfirmPassword', 'confirmPassword');
        </script>
</body>
</html>
