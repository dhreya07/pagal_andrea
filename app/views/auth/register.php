<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-sm">
    <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Create Account</h1>
    <form method="post" class="space-y-4">
        <input type="text" name="username" placeholder="Username" required
               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        
        <input type="password" name="password" placeholder="Password" required
               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        
        <select name="role" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
        
        <button type="submit" class="w-full py-3 bg-green-500 text-white font-semibold rounded-lg hover:bg-green-600 transition duration-300">
            Register
        </button>
    </form>
    <p class="text-center text-gray-500 mt-4">
        Already have an account? 
        <a href="<?= site_url('auth/login') ?>" class="text-blue-500 font-semibold hover:underline">Login</a>
    </p>
</div>

</body>
</html>
