<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Student - Swiftie Folklore Era</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="<?=base_url();?>/public/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
  body {
    font-family: 'Poppins', sans-serif;
    background-image: url('https://i.pinimg.com/originals/4f/9e/2e/4f9e2e3c6e4b6a3f3c8e6f2e3c4f9e.jpg'); /* Evermore + Red inspired backdrop */
    background-position: center;
    background-attachment: fixed;
    background-size: cover;
  }
     .quote {
    font-size: 1rem;
    font-style: italic;
    transition: color 0.5s ease;
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

  .btn-folklore {
    background: linear-gradient(to right, #a97474, #c19a7e); /* Red meets Evermore */
    color: white;
  }

  .btn-folklore:hover {
    background: linear-gradient(to right, #c19a7e, #a97474);
  }

  .input-folklore {
    background-color: rgba(250, 240, 235, 0.85); /* parchment tone */
  }

  .input-folklore:hover {
    background-color: rgba(220, 200, 190, 0.5);
  }

  .bg-white\/30 {
    background-color: rgba(255, 245, 240, 0.3); /* soft Evermore parchment */
  }

  .border-gray-300 {
    border-color: #7b2e2e; /* Red border */
  }

  .shadow-2xl {
    box-shadow: 0 0 25px rgba(123, 30, 30, 0.4);
  }

  .text-gray-800 {
    color: #4b1e1e; /* deep wine */
  }

  .text-gray-600 {
    color: #7b2e2e; /* muted crimson */
  }

  .bg-gray-100 {
    background-color: #fceeee;
  }

  .hover\:bg-gray-200:hover {
    background-color: #f5dada;
  }

  .border-gray-400 {
    border-color: #a05252;
  }

  .focus\:ring-gray-500:focus {
    --tw-ring-color: #a05252;
  }

  .placeholder-gray-500::placeholder {
    color: #a05252;
  }
</style>

</head>
<body class="min-h-screen flex items-center justify-center relative text-gray-800">

  <!-- Overlay -->
  <div class="absolute inset-0 overlay"></div>

  <!-- Container -->
  <div class="relative w-full max-w-md mx-auto p-6 z-10">
    <div class="bg-white/30 backdrop-blur-2xl rounded-3xl p-8 border border-gray-300 shadow-2xl">
      
      <!-- Header -->
      <div class="flex flex-col items-center mb-6">
        <div class="magic-icon mb-3">
          <i class="fa-solid fa-feather text-white text-3xl"></i>
        </div>
        <h2 class="text-2xl font-bold text-gray-800">Swiftie Student Signup</h2>
        <p class="text-gray-600 text-sm italic mt-1">🌲 “You showed me colors you know I can’t see with anyone else”</p>
      </div>

      <!-- Form -->
      <form action="<?=site_url('/users/create')?>" method="POST" class="space-y-5">
        <!-- First Name -->
        <div>
          <label class="block mb-1 font-semibold text-gray-800">First Name</label>
          <input type="text" name="first_name" placeholder="Enter first name" required
                 class="w-full px-4 py-3 rounded-full border border-gray-400 input-folklore text-gray-800 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 transition">
        </div>

        <!-- Last Name -->
        <div>
          <label class="block mb-1 font-semibold text-gray-800">Last Name</label>
          <input type="text" name="last_name" placeholder="Enter last name" required
                 class="w-full px-4 py-3 rounded-full border border-gray-400 input-folklore text-gray-800 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 transition">
        </div>

        <!-- Email -->
        <div>
          <label class="block mb-1 font-semibold text-gray-800">Email Address</label>
          <input type="email" name="email" placeholder="Enter email" required
                 class="w-full px-4 py-3 rounded-full border border-gray-400 input-folklore text-gray-800 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 transition">
        </div>

        <!-- Era Badge Toggle -->
<div>
  <label class="block mb-1 font-semibold text-gray-800" title="🎶 'Choose your vibe, choose your era'">Choose Your Era Badge</label>
  <select name="era_badge"
          class="w-full px-4 py-3 rounded-full border border-gray-400 input-folklore text-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 transition">
    <option value="evermore">🧶 Evermore</option>
    <option value="red">❤️ Red</option>
    <option value="folklore">🌲 Folklore</option>
    <option value="speaknow">💜 Speak Now</option>
  </select>
</div>


        <!-- Buttons -->
        <div class="flex flex-col sm:flex-row gap-3 mt-6">
          <button type="submit"
                  class="flex-1 px-5 py-3 rounded-full font-semibold shadow-lg btn-folklore transition-all duration-300 hover:scale-105">
            <i class="fa-solid fa-star mr-2"></i> Sign Up
          </button>
          <a href="<?=site_url()?>"
             class="flex-1 px-5 py-3 rounded-full font-semibold shadow-lg bg-gray-100 text-gray-800 border border-gray-300 hover:bg-gray-200 transition duration-300 text-center">
            <i class="fa-solid fa-arrow-left mr-2"></i> Back
          </a>
        </div>
      </form>
        
      <!-- Era Quote Carousel -->
<div class="mt-8 text-center text-gray-700 italic">
  <div id="eraCarousel" class="transition duration-700 ease-in-out">
    <p class="quote">“I remember it all too well.” – Red</p>
  </div>
</div>

<script>
  const quotes = [
    { text: "“I remember it all too well.” – Red", color: "#8b0000" },         // Red
    { text: "“This pain wouldn't be for evermore.” – Evermore", color: "#4b3f3f" }, // Evermore
    { text: "“I knew you’d linger like a tattoo kiss.” – Folklore", color: "#5a5a5a" }, // Folklore
    { text: "“I had the time of my life fighting dragons with you.” – Speak Now", color: "#800080" } // Speak Now
  ];

  let index = 0;
  setInterval(() => {
    const quote = quotes[index];
    document.getElementById('eraCarousel').innerHTML = `<p class="quote" style="color: ${quote.color}; transition: color 0.5s ease;">${quote.text}</p>`;
    index = (index + 1) % quotes.length;
  }, 4000);
</script>


      <!-- Footer -->
      <footer class="mt-8 text-center text-gray-600 text-sm italic">
        Made with <i class="fa-solid fa-heart text-gray-500"></i> by a Swiftie | 🧶 “Folklore lives in the trees”
      </footer>
    </div>
  </div>

</body>
</html>
