<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Page</title>
<script src="https://cdn.tailwindcss.com"></script>
<style>
/* Card with subtle outer glow */
.glow-card {
    background: #ffffff;
    border-radius: 1rem;
    padding: 1.5rem;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    animation: pulseGlow 4s infinite;
}

.glow-card:hover {
    transform: translateY(-5px) scale(1.02);
}

@keyframes pulseGlow {
    0%, 100% {
        box-shadow:
            0 6px 20px rgba(0, 0, 0, 0.15),
            0 0 6px rgba(59, 130, 246, 0.2),
            0 0 12px rgba(99, 102, 241, 0.2);
    }
    50% {
        box-shadow:
            0 6px 20px rgba(0, 0, 0, 0.15),
            0 0 10px rgba(59, 130, 246, 0.3),
            0 0 20px rgba(99, 102, 241, 0.3);
    }
}
</style>
</head>
<body class="bg-gray-100 min-h-screen">
<div class="container mx-auto px-4 py-8">

    <!-- Header -->
    <div class="glow-card mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Welcome to User Page</h1>
            <p class="text-gray-600 mt-2">Hello, <?= html_escape($logged_in_user['username']); ?>!</p>
        </div>
        <div class="flex space-x-4">
            <a href="<?= site_url('auth/logout'); ?>" 
               class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300 w-full md:w-auto text-center">
                Logout
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Profile Card -->
        <div class="glow-card">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold text-xl">
                    <?= strtoupper(substr($logged_in_user['username'], 0, 1)); ?>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-800">Profile Information</h3>
                    <p class="text-gray-600">Your account details</p>
                </div>
            </div>
            <div class="space-y-2 text-sm md:text-base">
                <div class="flex justify-between">
                    <span class="text-gray-600">Username:</span>
                    <span class="font-medium"><?= html_escape($logged_in_user['username']); ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Email:</span>
                    <span class="font-medium"><?= html_escape($logged_in_user['email']); ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Role:</span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        <?= ucfirst(html_escape($logged_in_user['role'])); ?>
                    </span>
                </div>
            </div>
        </div>

        <!-- System Info Card -->
        <div class="glow-card">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">System Information</h3>
            <div class="space-y-2 text-sm md:text-base text-gray-600">
                <p>Welcome to your user dashboard!</p>
                <p>Here you can view your account details and role information.</p>
                <p>Your role determines the features and access available to you.</p>
                <p>If you encounter any issues or need assistance, please contact your administrator.</p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="mt-8 text-center text-gray-500 text-sm">
        <p>&copy; <?= date('Y'); ?> User Management System. All rights reserved.</p>
    </div>
</div>
</body>
</html>