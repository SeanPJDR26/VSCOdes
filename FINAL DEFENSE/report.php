<?php
session_start();
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
    <title>Report Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <i class="fas fa-chart-line text-blue-600 text-2xl mr-3"></i>
                    <h1 class="text-xl font-semibold text-gray-900">Reports</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <button class="relative p-2 text-gray-400 hover:text-gray-500">
                        <i class="fas fa-bell text-lg"></i>
                        <span class="absolute top-0 right-0 block h-2 w-2 bg-red-400 rounded-full"></span>
                    </button>
                    <div class="flex items-center space-x-2">
                        <img class="h-8 w-8 rounded-full bg-gray-300" src="data:image/svg+xml,%3Csvg fill='none' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath d='M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z' fill='%239CA3AF'/%3E%3C/svg%3E" alt="Profile">
                        <span class="text-sm font-medium text-gray-700">Admin</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Report Content -->
    <main class="max-w-4xl mx-auto px-4 py-10">
        <div class="bg-white rounded-lg shadow p-8">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Report Details</h2>

            <!-- Example Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Room</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <!-- Example row -->
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">2025-07-18</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">Room 101</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">General Clean</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600">Completed</td>
                        </tr>
                        <!-- Add your PHP loop here to populate more rows from database -->
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Navigation Links -->
    <div class="fixed bottom-4 right-4 flex flex-col space-y-2">
        <a href="admin.php" class="bg-purple-600 text-white px-4 py-2 rounded-lg shadow hover:bg-purple-700">
            Admin Page
        </a>
        <a href="view_requests.php" class="bg-green-600 text-white px-4 py-2 rounded-lg shadow hover:bg-green-700">
            View Requests
        </a>
        <a href="report.php" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700">
            Report Page
        </a>
    </div>
</body>
</html>