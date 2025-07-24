<?php
session_start();
// Example: Check if admin is logged in
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <i class="fas fa-user-shield text-purple-600 text-2xl mr-3"></i>
                    <h1 class="text-xl font-semibold text-gray-900">Admin Panel</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <button class="relative p-2 text-gray-400 hover:text-gray-500">
                        <i class="fas fa-bell text-lg"></i>
                        <span class="absolute top-0 right-0 block h-2 w-2 bg-red-400 rounded-full"></span>
                    </button>
                    <div class="flex items-center space-x-2">
                        <img class="h-8 w-8 rounded-full bg-gray-300" src="data:image/svg+xml,%3Csvg fill='none' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath d='M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z' fill='%239CA3AF'/%3E%3C/svg%3E" alt="Profile">
                        <span class="text-sm font-medium text-gray-700">Admin User</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Welcome Section -->
    <div class="bg-gradient-to-r from-purple-600 to-blue-700 rounded-lg shadow-lg p-6 mb-8 text-white">
        <h2 class="text-2xl font-bold mb-2">Welcome back, Admin!</h2>
        <p class="text-purple-100">
            Monitor operations, manage housekeeping staff, and review incoming service requests below.
        </p>
        <div class="mt-4">
            <button class="bg-white text-green-600 px-4 py-2 rounded-lg font-medium hover:bg-gray-100" onclick="openRequestModal()">
                <i class="fas fa-plus mr-2"></i>New Request
            </button>
        </div>
    </div>
</div>



    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Admin Actions -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <i class="fas fa-users-cog text-3xl text-blue-600 mb-4"></i>
            <h2 class="text-lg font-semibold text-gray-900 mb-2">Manage Housekeepers</h2>
            <a href="add_housekeeper.php" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Add Housekeeper</a>
        </div>

        <div class="bg-white rounded-lg shadow p-6 text-center">
            <i class="fas fa-user-graduate text-3xl text-pink-600 mb-4"></i>
            <h2 class="text-lg font-semibold text-gray-900 mb-2">Manage Student Guests</h2>
            <a href="student_accounts.php" class="inline-block px-4 py-2 bg-pink-600 text-white rounded hover:bg-pink-700">Add Student</a>
        </div>

        <div class="bg-white rounded-lg shadow p-6 text-center">
            <i class="fas fa-box-open text-3xl text-red-600 mb-4"></i>
            <h2 class="text-lg font-semibold text-gray-900 mb-2">Extra Item Requests</h2>
            <a href="extra_items.php" class="inline-block px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">View Items</a>
        </div>

        <div class="bg-white rounded-lg shadow p-6 text-center">
            <i class="fas fa-clipboard-list text-3xl text-yellow-600 mb-4"></i>
            <h2 class="text-lg font-semibold text-gray-900 mb-2">Requests Overview</h2>
            <a href="view_requests.php" class="inline-block px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">View Requests</a>
        </div>

        <div class="bg-white rounded-lg shadow p-6 text-center">
            <i class="fas fa-address-book text-3xl text-indigo-600 mb-4"></i>
            <h2 class="text-lg font-semibold text-gray-900 mb-2">Guest Records</h2>
            <a href="guest_records.php" class="inline-block px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">View Guests</a>
        </div>

        <div class="bg-white rounded-lg shadow p-6 text-center">
            <i class="fas fa-chart-line text-3xl text-green-600 mb-4"></i>
            <h2 class="text-lg font-semibold text-gray-900 mb-2">Generate Reports</h2>
            <a href="report.php" class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Generate Report</a>
        </div>

    </div>
</div>

    <!-- Navigation Links -->
    <div class="fixed bottom-4 right-4 flex flex-col space-y-2">
        <a href="housekeeper.php" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700">
            Housekeeper Page
        </a>
        <a href="student.php" class="bg-green-600 text-white px-4 py-2 rounded-lg shadow hover:bg-green-700">
            Student Page
        </a>
    </div>
</body>
</html>
