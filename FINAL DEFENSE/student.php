<?php
session_start();
// Sample data - in real application, this would come from database
$user_room = "Room 301";
$requests = [
    ['id' => 1, 'type' => 'Deep Clean', 'status' => 'In Progress', 'date' => '2025-06-12', 'time' => '09:00 AM', 'notes' => 'Please focus on bathroom'],
    ['id' => 2, 'type' => 'Maintenance', 'status' => 'Completed', 'date' => '2025-06-10', 'time' => '02:00 PM', 'notes' => 'Fixed leaky faucet'],
    ['id' => 3, 'type' => 'Regular Clean', 'status' => 'Scheduled', 'date' => '2025-06-14', 'time' => '10:00 AM', 'notes' => 'Weekly cleaning'],
];

$notifications = [
    ['type' => 'info', 'message' => 'Your cleaning request has been accepted', 'time' => '2 hours ago'],
    ['type' => 'success', 'message' => 'Room cleaning completed', 'time' => '1 day ago'],
    ['type' => 'warning', 'message' => 'Please be present during maintenance', 'time' => '3 days ago'],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal - CleanSpace</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <i class="fas fa-home text-green-600 text-2xl mr-3"></i>
                    <h1 class="text-xl font-semibold text-gray-900">CleanSpace Student</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <button class="relative p-2 text-gray-400 hover:text-gray-500">
                        <i class="fas fa-bell text-lg"></i>
                        <span class="absolute top-0 right-0 block h-2 w-2 bg-red-400 rounded-full"></span>
                    </button>
                    <div class="flex items-center space-x-2">
                        <img class="h-8 w-8 rounded-full bg-gray-300" src="data:image/svg+xml,%3Csvg fill='none' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath d='M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z' fill='%239CA3AF'/%3E%3C/svg%3E" alt="Profile">
                        <span class="text-sm font-medium text-gray-700">John Smith</span>
                        <span class="text-xs text-gray-500"><?php echo $user_room; ?></span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Welcome Section -->
        <div class="bg-gradient-to-r from-green-500 to-blue-600 rounded-lg shadow-lg p-6 mb-8 text-white">
            <h2 class="text-2xl font-bold mb-2">Welcome back, John!</h2>
            <p class="text-green-100">Your room: <?php echo $user_room; ?> • Last cleaned: June 10, 2025</p>
            <div class="mt-4 flex space-x-4">
                <button class="bg-white text-green-600 px-4 py-2 rounded-lg font-medium hover:bg-gray-100" onclick="openRequestModal()">
                    <i class="fas fa-plus mr-2"></i>New Request
                </button>
                <button class="bg-green-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-green-700">
                    <i class="fas fa-calendar mr-2"></i>Schedule Service
                </button>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-100 rounded-full">
                        <i class="fas fa-clipboard-list text-blue-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Active Requests</p>
                        <p class="text-2xl font-bold text-gray-900">2</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 bg-green-100 rounded-full">
                        <i class="fas fa-check-circle text-green-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Completed</p>
                        <p class="text-2xl font-bold text-gray-900">15</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 bg-yellow-100 rounded-full">
                        <i class="fas fa-star text-yellow-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Rating</p>
                        <p class="text-2xl font-bold text-gray-900">4.8</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Service Requests -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">My Service Requests</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <?php foreach ($requests as $request): ?>
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <h4 class="font-medium text-gray-900"><?php echo $request['type']; ?></h4>
                                    <p class="text-sm text-gray-500"><?php echo $request['date']; ?> at <?php echo $request['time']; ?></p>
                                </div>
                                <?php
                                $statusClass = '';
                                switch ($request['status']) {
                                    case 'Completed':
                                        $statusClass = 'bg-green-100 text-green-800';
                                        break;
                                    case 'In Progress':
                                        $statusClass = 'bg-blue-100 text-blue-800';
                                        break;
                                    case 'Scheduled':
                                        $statusClass = 'bg-yellow-100 text-yellow-800';
                                        break;
                                }
                                ?>
                                <span class="px-2 py-1 text-xs font-medium rounded-full <?php echo $statusClass; ?>">
                                    <?php echo $request['status']; ?>
                                </span>
                            </div>
                            <p class="text-sm text-gray-600 mb-3"><?php echo $request['notes']; ?></p>
                            <div class="flex space-x-2">
                                <?php if ($request['status'] == 'Completed'): ?>
                                    <button class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded hover:bg-yellow-200">
                                        <i class="fas fa-star mr-1"></i>Rate Service
                                    </button>
                                <?php endif; ?>
                                <button class="text-xs bg-gray-100 text-gray-800 px-2 py-1 rounded hover:bg-gray-200">
                                    <i class="fas fa-eye mr-1"></i>View Details
                                </button>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Notifications & Quick Actions -->
            <div class="space-y-6">
                <!-- Notifications -->
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Notifications</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3">
                            <?php foreach ($notifications as $notification): ?>
                            <div class="flex items-start space-x-3">
                                <?php
                                $iconClass = '';
                                switch ($notification['type']) {
                                    case 'success':
                                        $iconClass = 'text-green-500 fas fa-check-circle';
                                        break;
                                    case 'warning':
                                        $iconClass = 'text-yellow-500 fas fa-exclamation-triangle';
                                        break;
                                    default:
                                        $iconClass = 'text-blue-500 fas fa-info-circle';
                                }
                                ?>
                                <i class="<?php echo $iconClass; ?> mt-0.5"></i>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-900"><?php echo $notification['message']; ?></p>
                                    <p class="text-xs text-gray-500"><?php echo $notification['time']; ?></p>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Quick Actions</h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-2 gap-3">
                            <button class="flex flex-col items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100" onclick="openRequestModal()">
                                <i class="fas fa-broom text-blue-600 text-xl mb-2"></i>
                                <span class="text-sm font-medium text-gray-900">Request Cleaning</span>
                            </button>
                            <button class="flex flex-col items-center p-4 bg-red-50 rounded-lg hover:bg-red-100">
                                <i class="fas fa-tools text-red-600 text-xl mb-2"></i>
                                <span class="text-sm font-medium text-gray-900">Report Issue</span>
                            </button>
                            <button class="flex flex-col items-center p-4 bg-green-50 rounded-lg hover:bg-green-100">
                                <i class="fas fa-calendar text-green-600 text-xl mb-2"></i>
                                <span class="text-sm font-medium text-gray-900">Schedule Service</span>
                            </button>
                            <button class="flex flex-col items-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100">
                                <i class="fas fa-phone text-purple-600 text-xl mb-2"></i>
                                <span class="text-sm font-medium text-gray-900">Contact Support</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Room Status -->
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Room Status</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Cleanliness</span>
                                <span class="text-sm font-medium text-green-600">Excellent</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Last Cleaned</span>
                                <span class="text-sm font-medium text-gray-900">June 10, 2025</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Next Scheduled</span>
                                <span class="text-sm font-medium text-blue-600">June 14, 2025</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Supplies Status</span>
                                <span class="text-sm font-medium text-green-600">Good</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Request Modal -->
    <div id="requestModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">New Service Request</h3>
                </div>
                <form class="p-6">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Service Type</label>
                        <select class="w-full border border-gray-300 rounded-md px-3 py-2">
                            <option>Regular Cleaning</option>
                            <option>Deep Cleaning</option>
                            <option>Maintenance</option>
                            <option>Supply Request</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Priority</label>
                        <select class="w-full border border-gray-300 rounded-md px-3 py-2">
                            <option>Normal</option>
                            <option>High</option>
                            <option>Urgent</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Preferred Date</label>
                        <input type="date" class="w-full border border-gray-300 rounded-md px-3 py-2">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Preferred Time</label>
                        <select class="w-full border border-gray-300 rounded-md px-3 py-2">
                            <option>Morning (8AM - 12PM)</option>
                            <option>Afternoon (12PM - 5PM)</option>
                            <option>Evening (5PM - 8PM)</option>
                        </select>
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Additional Notes</label>
                        <textarea class="w-full border border-gray-300 rounded-md px-3 py-2 h-20" placeholder="Please provide any specific instructions..."></textarea>
                    </div>
                    <div class="flex justify-end space-x-3">
                        <button type="button" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200" onclick="closeRequestModal()">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Submit Request
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Navigation Links -->
    <div class="fixed bottom-4 right-4 flex flex-col space-y-2">
        <a href="housekeeper.php" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700">
            Housekeeper Page
        </a>
        <a href="admin.php" class="bg-purple-600 text-white px-4 py-2 rounded-lg shadow hover:bg-purple-700">
            Admin Page
        </a>
    </div>

    <script>
        function openRequestModal() {
            document.getElementById('requestModal').classList.remove('hidden');
        }

        function closeRequestModal() {
            document.getElementById('requestModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('requestModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeRequestModal();
            }
        });
    </script>
</body>
</html>
