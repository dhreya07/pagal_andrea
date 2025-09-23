<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Directory - Kuromi Pink Coquette</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="<?=base_url();?>/public/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
  body {
    font-family: 'Poppins', sans-serif;
    background-image: url('https://i.pinimg.com/originals/3b/7e/2a/3b7e2a2e8c1e4f3c9e3f6e4b6a3f3c8e.jpg'); /* Taylor Swift Evermore portrait */
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
  }

  .overlay {
    background: rgba(50, 40, 40, 0.5); /* moody mist */
  }

  .magic-icon {
    background: linear-gradient(135deg, #4b3f3f, #6e5e5e, #a9a9a9);
    padding: 0.5rem;
    border-radius: 9999px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 10px 25px rgba(0,0,0,0.3);
    animation: float 3s ease-in-out infinite;
  }

  @keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
  }

  .btn-folk {
    background: linear-gradient(to right, #6e5e5e, #a9a9a9);
    color: white;
  }

  .btn-folk:hover {
    background: linear-gradient(to right, #a9a9a9, #6e5e5e);
  }

  .bg-white\/40 {
    background-color: rgba(245, 240, 235, 0.4); /* parchment tone */
  }

  .border-pink-200 {
    border-color: #6e5e5e;
  }

  .shadow-2xl {
    box-shadow: 0 0 25px rgba(60, 50, 50, 0.4);
  }

  .text-pink-900 {
    color: #3e2f2f;
  }

  .bg-pink-50\/80 {
    background-color: rgba(240, 235, 230, 0.8);
  }

  .placeholder-pink-400::placeholder {
    color: #7b6e6e;
  }

  .border-pink-300 {
    border-color: #7b6e6e;
  }

  .focus\:ring-pink-500:focus {
    --tw-ring-color: #7b6e6e;
  }

  .bg-gradient-to-r {
    background-image: linear-gradient(to right, #6e5e5e, #a9a9a9);
  }

  .text-white {
    color: #fdf6f0;
  }

  .hover\:bg-pink-100\/50:hover {
    background-color: rgba(220, 210, 200, 0.5);
  }

  /* Pagination Styles */
  .pagination {
    display: flex;
    flex-direction: row;
    justify-content: center;
    gap: 0.5rem;
    margin-top: 1rem;
  }

  .pagination a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.5rem 1rem;
    border-radius: 9999px;
    background-color: rgba(240, 235, 230, 0.8);
    color: #3e2f2f;
    font-weight: 600;
    box-shadow: 0 2px 5px rgba(0,0,0,0.15);
    transition: all 0.2s ease-in-out;
  }

  .pagination a:hover {
    background-color: #a9a9a9;
    color: #fff;
  }

  .pagination .active a {
    background-color: #6e5e5e !important;
    color: #fff !important;
  }
</style>
</head>
<body class="min-h-screen relative text-pink-900">

  <!-- Overlay -->
  <div class="absolute inset-0 overlay"></div>

  <!-- Container -->
  <div class="relative max-w-6xl mx-auto mt-10 px-4 z-10">

    <!-- User Table Card -->
    <div class="bg-white/40 backdrop-blur-2xl rounded-3xl p-6 border border-pink-200 shadow-2xl">

      <!-- Search & Add Button Above Table -->
      <div class="flex flex-col md:flex-row justify-between items-center mb-4 gap-3">
        <!-- Search -->
        <form method="get" action="<?=site_url()?>" class="flex w-full md:w-auto">
          <input 
            type="text" 
            name="q" 
            value="<?=html_escape($_GET['q'] ?? '')?>" 
            placeholder="Search student..."
            class="px-4 py-2 rounded-l-full bg-pink-50/80 text-pink-900 placeholder-pink-400 border border-pink-300 focus:outline-none focus:ring-2 focus:ring-pink-500 w-full md:w-64">
          <button type="submit" 
                  class="px-4 py-2 rounded-r-full shadow-lg btn-folk transition duration-300">
            <i class="fa fa-search"></i>
          </button>
        </form>

        <!-- Add New User -->
        <a href="<?=site_url('users/create')?>"
           class="inline-flex items-center gap-2 font-bold px-5 py-2 rounded-full shadow-lg btn-folk transition-all duration-300 hover:scale-105">
          <i class="fa-solid fa-user-plus"></i> Add New User
        </a>
      </div>

      <!-- Table -->
      <div class="overflow-x-auto rounded-2xl border border-pink-300 shadow-lg">
        <table class="w-full text-center border-collapse">
          <thead>
            <tr class="bg-gradient-to-r from-pink-400 via-pink-300 to-pink-500 text-white text-sm uppercase tracking-wide rounded-t-3xl">
              <th class="py-3 px-4">ID</th>
              <th class="py-3 px-4">Lastname</th>
              <th class="py-3 px-4">Firstname</th>
              <th class="py-3 px-4">Email</th>
              <th class="py-3 px-4">Action</th>
            </tr>
          </thead>
          <tbody class="text-pink-900 text-sm">
            <?php foreach(html_escape($users) as $user): ?>
              <tr class="hover:bg-pink-100/50 transition duration-200 rounded-lg">
                <td class="py-3 px-4 font-medium"><?=($user['id']);?></td>
                <td class="py-3 px-4"><?=($user['last_name']);?></td>
                <td class="py-3 px-4"><?=($user['first_name']);?></td>
                <td class="py-3 px-4">
                  <span class="bg-pink-50/80 text-pink-900 text-sm font-semibold px-3 py-1 rounded-full">
                    <?=($user['email']);?>
                  </span>
                </td>
                <td class="py-3 px-4 flex justify-center gap-3">
                  <a href="<?=site_url('users/update/'.$user['id']);?>"
                     class="px-3 py-1 rounded-full shadow btn-folk flex items-center gap-1 transition duration-200 hover:scale-105">
                    <i class="fa-solid fa-pen-to-square"></i> Update
                  </a>
                  <a href="<?=site_url('users/delete/'.$user['id']);?>"
                     class="inline-flex items-center gap-2 px-3 py-1 rounded-full shadow btn-folk transition-all duration-300 hover:scale-105">
                     <i class="fa-solid fa-trash"></i> Delete
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <div class="pagination">
        <?php if(!empty($page)): 
            echo str_replace(
              ['<ul>', '</ul>', '<li>', '</li>', '<a', '</a>'],
              ['', '', '', '', '<a', '</a>'],
              $page
            );
        endif; ?>
      </div>

    </div>

  </div>

</body>
</html>
