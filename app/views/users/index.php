<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>User Management</title>
<script src="https://cdn.tailwindcss.com"></script>
<style>
  body {
    background: linear-gradient(135deg, #60a5fa, #6366f1);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  .card {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 1rem;
    box-shadow:
      0 6px 20px rgba(0, 0, 0, 0.6),
      0 0 14px rgba(59, 130, 246, 0.5);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  .card:hover {
    transform: translateY(-4px) scale(1.01);
    box-shadow:
      0 8px 28px rgba(0, 0, 0, 0.7),
      0 0 20px rgba(59, 130, 246, 0.6);
  }

  /* Buttons */
  .btn-primary { background: #2563eb; color: #fff; font-weight: 600; padding: 0.55rem 1.25rem; border-radius: 0.5rem; transition: transform 0.2s ease, background 0.2s ease; }
  .btn-primary:hover { background: #1d4ed8; transform: scale(1.05); }
  .btn-danger { background: #dc2626; color: #fff; font-weight: 600; padding: 0.55rem 1.25rem; border-radius: 0.5rem; transition: transform 0.2s ease, background 0.2s ease; }
  .btn-danger:hover { background: #b91c1c; transform: scale(1.05); }
  .btn-edit { background: #2563eb; color: white; padding: 0.35rem 0.9rem; border-radius: 9999px; font-size: 0.85rem; font-weight: 500; transition: all 0.2s; }
  .btn-edit:hover { background: #1d4ed8; transform: scale(1.05); }
  .btn-delete { background: #dc2626; color: white; padding: 0.35rem 0.9rem; border-radius: 9999px; font-size: 0.85rem; font-weight: 500; transition: all 0.2s; }
  .btn-delete:hover { background: #b91c1c; transform: scale(1.05); }

  table thead { background: #2563eb; }
  table thead th { color: #ffffff; font-weight: 700; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.05em; }
  table tbody tr:hover { background: rgba(59, 130, 246, 0.15); }

  .tag-admin { background: #fee2e2; color: #b91c1c; }
  .tag-user { background: #dcfce7; color: #166534; }

  .welcome-box {
    display: inline-block;
    background: linear-gradient(to right, #3b82f6, #6366f1);
    color: white;
    font-weight: 600;
    padding: 0.6rem 1.2rem;
    border-radius: 0.75rem;
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.6);
    font-size: 1rem;
    transition: transform 0.2s ease;
  }
  .welcome-box:hover { transform: scale(1.05); }

  
.pagination a {
    min-width: 2.5rem; 
    text-align: center;
}

</style>
</head>
<body class="flex justify-center p-4 min-h-screen">

<div class="container card mx-auto p-4 md:p-6 lg:p-10 w-full">

  <!-- Dashboard Header -->
  <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
    <h2 class="text-2xl font-bold text-gray-800">
      <?= ($logged_in_user['role'] === 'admin') ? 'Admin Dashboard' : 'User Dashboard'; ?>
    </h2>
    <a href="<?=site_url('auth/logout'); ?>" class="btn-danger w-full md:w-auto text-center">Logout</a>
  </div>

  <!-- Highlighted Welcome -->
  <?php if(!empty($logged_in_user)): ?>
    <div class="mb-6">
      <span class="welcome-box">
        Welcome: <?= html_escape($logged_in_user['username']); ?>
      </span>
    </div>
  <?php else: ?>
    <p class="mb-6 text-red-600 font-semibold">Logged in user not found</p>
  <?php endif; ?>

  <!-- Search + Add -->
  <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4 flex-wrap">
    <form action="<?=site_url('users');?>" method="get" class="flex flex-col sm:flex-row items-start sm:items-center gap-3 w-full sm:w-auto">
      <?php $q = isset($_GET['q']) ? $_GET['q'] : ''; ?>
      <input type="text" name="q" placeholder="Search users..." value="<?=html_escape($q);?>" 
             class="w-full sm:w-64 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
      <button type="submit" class="btn-primary flex items-center justify-center space-x-2 w-full sm:w-auto">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z"/>
        </svg>
        <span>Search</span>
      </button>
    </form>

    <a href="<?=site_url('users/create'); ?>" class="btn-primary flex items-center justify-center shadow-md hover:scale-105 w-full sm:w-auto">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
      </svg>
      Add Account
    </a>
  </div>

  <!-- Table -->
  <div class="bg-white/95 rounded-xl shadow-lg overflow-hidden">
    <div class="overflow-x-auto">
      <table class="min-w-full">
        <thead class="border-b border-gray-200">
          <tr>
            <th class="py-3 px-4 text-left">Username</th>
            <th class="py-3 px-4 text-left">Email</th>
            <th class="py-3 px-4 text-left">Role</th>
            <th class="py-3 px-4 text-center">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
          <?php if (empty($users)): ?>
            <tr>
              <td colspan="4" class="py-12 text-center text-gray-500">
                <p class="text-lg font-semibold">No user records found.</p>
                <p class="mt-2 text-sm">Click the "Add Account" button to add one!</p>
              </td>
            </tr>
          <?php else: ?>
            <?php foreach (html_escape($users) as $user): ?>
              <tr>
                <td class="py-4 px-4 text-sm text-gray-900 font-medium whitespace-nowrap"><?=$user['username'];?></td>
                <td class="py-4 px-4 text-sm text-gray-600 whitespace-nowrap"><?=$user['email'];?></td>
                <td class="py-4 px-4 text-sm text-gray-600 whitespace-nowrap">
                  <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?= $user['role'] === 'admin' ? 'tag-admin' : 'tag-user'; ?>">
                    <?= ucfirst(html_escape($user['role'])); ?>
                  </span>
                </td>
                <td class="py-4 px-4 text-sm font-medium text-center whitespace-nowrap">
                  <div class="flex flex-col sm:flex-row items-center justify-center gap-2 sm:gap-3">
                    <a href="<?=site_url('users/update/'.$user['id']); ?>" class="btn-edit w-full sm:w-auto text-center">Edit</a>
                    <a href="<?=site_url('users/delete/'.$user['id']); ?>" 
                       class="btn-delete w-full sm:w-auto text-center"
                       onclick="return confirm('Are you sure you want to delete this user? This action cannot be undone.');">Delete</a>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>

     <!-- Pagination -->
      <div class="flex flex-wrap justify-center items-center py-6 gap-2">
          <?= $page; ?>
      </div>

      </div>
    </div>
  </div>
</div>
</body>
</html>