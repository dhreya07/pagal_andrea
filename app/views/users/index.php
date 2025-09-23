<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Directory - Swiftie</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="<?=base_url();?>/public/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-image: url('https://i.pinimg.com/originals/9d/73/2f/9d732f83c1e0e6bb59c03e8a6f68d94f.jpg'); /* Evermore forest aesthetic */
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
      color: #2c2c2c;
    }

    .overlay {
      background: rgba(30, 25, 25, 0.6);
    }

    .btn-folk {
      background: linear-gradient(to right, #5a3b3b, #b33a3a); /* deep red gradient */
      color: #fdf6f0;
    }

    .btn-folk:hover {
      background: linear-gradient(to right, #b33a3a, #5a3b3b);
    }

    .table-head {
      background: linear-gradient(to right, #3e2f2f, #6e4c4c, #b33a3a);
    }

    .bg-white\/40 {
      background-color: rgba(245, 240, 235, 0.4);
    }

    .border-theme {
      border-color: #b33a3a;
    }

    .shadow-2xl {
      box-shadow: 0 0 25px rgba(40, 20, 20, 0.4);
    }

    .text-theme {
      color: #2c1c1c;
    }

    .bg-soft {
      background-color: rgba(230, 220, 215, 0.8);
    }

    .placeholder-theme::placeholder {
      color: #6e5e5e;
    }

    .focus\:ring-theme:focus {
      --tw-ring-color: #b33a3a;
    }

    /* Pagination */
    .pagination-container {
      display: flex;
      justify-content: center;
      align-items: center;
      margin-top: 1rem;
    }

    .pagination a {
      padding: 0.5rem 0.9rem;
      margin: 0 0.3rem;
      border-radius: 9999px;
      background-color: rgba(230, 220, 215, 0.8);
      color: #3e2f2f;
      font-weight: 600;
      box-shadow: 0 2px 6px rgba(0,0,0,0.2);
      transition: all 0.3s ease;
    }

    .pagination a:hover {
      background-color: #b33a3a;
      color: #fff;
      transform: scale(1.05);
    }
  </style>
</head>
<body class="min-h-screen relative text-theme">

  <!-- Overlay -->
  <div class="absolute inset-0 overlay"></div>

  <!-- Container -->
  <div class="relative max-w-6xl mx-auto mt-10 px-4 z-10">

    <!-- User Table Card -->
    <div class="bg-white/40 backdrop-blur-2xl rounded-3xl p-6 border border-theme shadow-2xl">

      <!-- Search & Add Button -->
      <div class="flex flex-col md:flex-row justify-between items-center mb-4 gap-3">
        <form method="get" action="<?=site_url()?>" class="flex w-full md:w-auto">
          <input 
            type="text" 
            name="q" 
            value="<?=html_escape($_GET['q'] ?? '')?>" 
            placeholder="Search student..."
            class="px-4 py-2 rounded-l-full bg-soft text-theme placeholder-theme border border-theme focus:outline-none focus:ring-2 focus:ring-theme w-full md:w-64">
          <button type="submit" 
                  class="px-4 py-2 rounded-r-full shadow-lg btn-folk transition duration-300">
            <i class="fa fa-search"></i>
          </button>
        </form>

        <a href="<?=site_url('users/create')?>"
           class="inline-flex items-center gap-2 font-bold px-5 py-2 rounded-full shadow-lg btn-folk transition-all duration-300 hover:scale-105">
          <i class="fa-solid fa-user-plus"></i> Add New User
        </a>
      </div>

      <!-- Table -->
      <div class="overflow-x-auto rounded-2xl border border-theme shadow-lg">
        <table class="w-full text-center border-collapse">
          <thead>
            <tr class="table-head text-white text-sm uppercase tracking-wide rounded-t-3xl">
              <th class="py-3 px-4">ID</th>
              <th class="py-3 px-4">Lastname</th>
              <th class="py-3 px-4">Firstname</th>
              <th class="py-3 px-4">Email</th>
              <th class="py-3 px-4">Action</th>
            </tr>
          </thead>
          <tbody class="text-theme text-sm">
            <?php foreach(html_escape($users) as $user): ?>
              <tr class="hover:bg-soft transition duration-200 rounded-lg">
                <td class="py-3 px-4 font-medium"><?=($user['id']);?></td>
                <td class="py-3 px-4"><?=($user['last_name']);?></td>
                <td class="py-3 px-4"><?=($user['first_name']);?></td>
                <td class="py-3 px-4">
                  <span class="bg-soft text-theme text-sm font-semibold px-3 py-1 rounded-full">
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
      <div class="pagination-container">
        <?php if (!empty($page)): 
          echo '<div class="pagination">';
          echo str_replace(
            ['<ul>', '</ul>', '<li>', '</li>', '<a', '</a>'],
            ['', '', '', '', '<a', '</a>'],
            $page
          );
          echo '</div>';
        endif; ?>
      </div>

    </div>
  </div>

</body>
</html>
