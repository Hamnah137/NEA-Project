<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function toggleTheme() {
            document.documentElement.classList.toggle('dark');
        }
    </script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 min-h-screen flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-white dark:bg-gray-800 shadow-lg min-h-screen p-5">
        <h2 class="text-2xl font-bold mb-6">Dashboard</h2>
        <nav class="space-y-4">
            <a href="index.php" class="block py-2 px-4 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700">Shop</a>
            <a href="orders.php" class="block py-2 px-4 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700">My Orders</a>
            <a href="profile.php" class="block py-2 px-4 bg-blue-500 text-white rounded-lg">Profile</a>
            <a href="reviews.php" class="block py-2 px-4 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700">My Reviews</a>
            <a href="logout.php" class="block py-2 px-4 rounded-lg hover:bg-red-500 hover:text-white">Logout</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-semibold">User Profile</h1>
            <button onclick="toggleTheme()" class="py-2 px-4 bg-blue-500 text-white rounded-lg shadow-md hover:bg-blue-600">Toggle Theme</button>
        </div>

        <!-- Profile Section -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6 mb-6">
            <h2 class="text-2xl font-semibold mb-4">Personal Information</h2>
            <form action="update_profile.php" method="POST" enctype="multipart/form-data" class="space-y-4">
                <div class="flex items-center space-x-6">
                    <img src="<?php echo isset($user['profile_image']) ? $user['profile_image'] : 'profile-placeholder.png'; ?>" alt="Profile Image" class="w-24 h-24 rounded-full object-cover">
                    <div>
                        <label class="block text-sm font-medium">Update Profile Image</label>
                        <input type="file" name="profile_image" class="mt-1 block w-full">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium">Full Name</label>
                    <input type="text" name="full_name" value="<?php echo htmlspecialchars($user['full_name']); ?>" class="w-full p-3 rounded-lg bg-gray-100 dark:bg-gray-700">
                </div>
                <div>
                    <label class="block text-sm font-medium">Email Address</label>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" class="w-full p-3 rounded-lg bg-gray-100 dark:bg-gray-700">
                </div>
                <div>
                    <button type="submit" class="py-2 px-4 bg-green-500 text-white rounded-lg hover:bg-green-600">Save Changes</button>
                </div>
            </form>
        </div>

        <!-- Order History Section -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6">
            <h2 class="text-2xl font-semibold mb-4">Order History</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white dark:bg-gray-800 rounded-lg">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 text-left">Order ID</th>
                            <th class="py-2 px-4 text-left">Date</th>
                            <th class="py-2 px-4 text-left">Amount</th>
                            <th class="py-2 px-4 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order): ?>
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="py-2 px-4"><?php echo $order['order_id']; ?></td>
                                <td class="py-2 px-4"><?php echo $order['order_date']; ?></td>
                                <td class="py-2 px-4">$<?php echo $order['amount']; ?></td>
                                <td class="py-2 px-4 text-<?php echo ($order['status'] === 'Completed') ? 'green' : 'yellow'; ?>-500"><?php echo $order['status']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>
