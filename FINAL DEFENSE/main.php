<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Housekeeping Services - Main</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <i class="fas fa-hands-bubbles text-indigo-600 text-2xl mr-3"></i>
                    <h1 class="text-xl font-semibold text-gray-900">Housekeeping Services</h1>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow flex items-center justify-center">
        <div class="bg-white p-10 rounded-lg shadow-lg max-w-md w-full text-center">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Welcome</h2>
            <p class="text-gray-600 mb-6">Please select your role to continue:</p>

            <div class="flex flex-col space-y-4">
                <a href="admin.php" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-lg text-lg font-medium transition">
                    Admin
                </a>
                <a href="student.php" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg text-lg font-medium transition">
                    Student / Guest
                </a>
                <a href="housekeeper.php" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg text-lg font-medium transition">
                    Housekeeper
                </a>
            </div>
        </div>
    </main>
</body>
</html>
