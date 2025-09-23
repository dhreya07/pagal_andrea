<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Student - Kuromi Pink Coquette</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="<?=base_url();?>/public/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
  body {
    font-family: 'Poppins', sans-serif;
    background-image: url('https://i.pinimg.com/originals/2e/4f/3c/2e4f3c9e3f6e4b6a3f3c8e6f2e3c4f9e.jpg'); /* Evermore forest vibe */
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
  }

  .overlay {
    background: rgba(80, 40, 40, 0.5); /* wine-toned mist */
  }

  .magic-icon {
    background: linear-gradient(135deg, #5c1a1a, #7b2e2e, #a97474);
    padding: 0.6rem;
    border-radius: 9999px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 10px 25px rgba(0,0,0,0.3);
    animation: float 3s ease-in-out infinite;
  }

  @keyframes float {
    0%,100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
  }

  .btn-red {
    background: linear-gradient(to right, #a97474, #c19a7e); /* Red meets Evermore */
    color: white;
  }

  .btn-red:hover {
    background: linear-gradient(to right, #c19a7e, #a97474);
  }

  .input-red {
    background-color: rgba(250, 240, 235, 0.85); /* parchment tone */
  }

  .input-red:hover {
    background-color: rgba(220, 200, 190, 0.5);
  }

  .bg-white\/40 {
    background-color: rgba(245, 240, 235, 0.4);
  }

  .border-pink-200 {
    border-color: #7b2e2e;
  }

  .shadow-2xl {
    box-shadow: 0 0 25px rgba(60, 50, 50, 0.4);
  }

  .text-pink-900 {
    color: #4b1e1e;
  }

  .text-pink-700 {
    color: #7b2e2e;
  }

  .bg-pink-50\/80 {
    background-color: rgba(240, 235, 230, 0.8);
  }

  .hover\:bg-pink-100:hover {
    background-color: rgba(220, 210, 200, 0.5);
  }

  .border-pink-300 {
    border-color: #a05252;
  }

  .focus\:ring-pink-500:focus {
    --tw-ring-color: #a05252;
  }

  .placeholder-pink-400::placeholder {
    color: #a05252;
  }

  .btn-pink {
    @apply btn-red;
  }

  .input-pink {
    @apply input-red;
  }
</style>

</head>
<body class="min-h-screen flex items-center justify-center relative text-pink-900">

  <!-- Overlay -->
  <div class="absolute inset-0 overlay"></div>

  <!-- Container -->
  <div class="relative w-full max-w-md mx-auto p-6 z-10">
    <div class="bg-white/40 backdrop-blur-2xl rounded-3xl p-8 border border-pink-200 shadow-2xl">
      
      <!-- Header -->
      <div class="flex flex-col items-center mb-6">
        <div class="magic-icon mb-3">
          <i class="fa-solid fa-wand-magic-sparkles text-white text-3xl"></i>
        </div>
        <h2 class="text-2xl font-bold text-pink-900">Update Student Info ✨</h2>
        <p class="text-pink-700 text-sm italic mt-1">Make your profile magical & fresh!</p>
      </div>

      <!-- Update Form -->
      <form action="<?=site_url('users/update/'.$user['id'])?>" method="POST" class="space-y-5">
        <!-- First Name -->
        <div>
          <label class="block mb-1 font-semibold text-pink-900">First Name</label>
          <input type="text" name="first_name" value="<?= html_escape($user['first_name'])?>" required
                 class="w-full px-4 py-3 rounded-full border border-pink-300 input-pink text-pink-900 placeholder-pink-400 focus:outline-none focus:ring-2 focus:ring-pink-500 transition">
        </div>

        <!-- Last Name -->
        <div>
          <label class="block mb-1 font-semibold text-pink-900">Last Name</label>
          <input type="text" name="last_name" value="<?= html_escape($user['last_name'])?>" required
                 class="w-full px-4 py-3 rounded-full border border-pink-300 input-pink text-pink-900 placeholder-pink-400 focus:outline-none focus:ring-2 focus:ring-pink-500 transition">
        </div>

        <!-- Email -->
        <div>
          <label class="block mb-1 font-semibold text-pink-900">Email Address</label>
          <input type="email" name="email" value="<?= html_escape($user['email'])?>" required
                 class="w-full px-4 py-3 rounded-full border border-pink-300 input-pink text-pink-900 placeholder-pink-400 focus:outline-none focus:ring-2 focus:ring-pink-500 transition">
        </div>

        <!-- Buttons -->
        <div class="flex flex-col sm:flex-row gap-3 mt-6">
          <button type="submit"
                  class="flex-1 px-5 py-3 rounded-full font-semibold shadow-lg btn-pink transition-all duration-300 hover:scale-105">
            <i class="fa-solid fa-heart mr-2"></i> Update
          </button>
          <a href="<?=site_url()?>"
             class="flex-1 px-5 py-3 rounded-full font-semibold shadow-lg bg-pink-50/80 text-pink-900 border border-pink-300 hover:bg-pink-100 transition duration-300 text-center">
            <i class="fa-solid fa-arrow-left mr-2"></i> Back
          </a>
        </div>
      </form>
    </div>
  </div>

</body>
</html>
