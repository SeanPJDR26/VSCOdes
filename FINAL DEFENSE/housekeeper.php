<?php
session_start();

// Sample data - in real application, this would come from database
$tasks = [
    ['id' => 1, 'room' => 'Room 301', 'type' => 'Deep Clean', 'priority' => 'High', 'status' => 'Pending', 'time' => '09:00 AM', 'duration' => '2 hours', 'student' => 'John Smith'],
    ['id' => 2, 'room' => 'Room 205', 'type' => 'Regular Clean', 'priority' => 'Medium', 'status' => 'In Progress', 'time' => '11:00 AM', 'duration' => '1 hour', 'student' => 'Sarah Johnson'],
    ['id' => 3, 'room' => 'Room 412', 'type' => 'Maintenance', 'priority' => 'Low', 'status' => 'Completed', 'time' => '02:00 PM', 'duration' => '30 mins', 'student' => 'Mike Chen'],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Housekeeper Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <i class="fas fa-broom text-blue-600 text-2xl mr-3"></i>
                    <h1 class="text-xl font-semibold text-gray-900">CleanSpace</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <button class="relative p-2 text-gray-400 hover:text-gray-500">
                        <i class="fas fa-bell text-lg"></i>
                        <span class="absolute top-0 right-0 block h-2 w-2 bg-red-400 rounded-full"></span>
                    </button>
                    <div class="flex items-center space-x-2">
                        <img class="h-8 w-8 rounded-full bg-gray-300" src="data:image/svg+xml,%3Csvg fill='none' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath d='M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z' fill='%239CA3AF'/%3E%3C/svg%3E" alt="Profile">
                        <span class="text-sm font-medium text-gray-700">Maria Garcia</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-2 bg-blue-100 rounded-lg">
                        <i class="fas fa-tasks text-blue-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Today's Tasks</p>
                        <p class="text-2xl font-bold text-gray-900">8</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-2 bg-green-100 rounded-lg">
                        <i class="fas fa-check-circle text-green-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Completed</p>
                        <p class="text-2xl font-bold text-gray-900">5</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-2 bg-yellow-100 rounded-lg">
                        <i class="fas fa-clock text-yellow-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">In Progress</p>
                        <p class="text-2xl font-bold text-gray-900">2</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-2 bg-red-100 rounded-lg">
                        <i class="fas fa-exclamation-triangle text-red-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Urgent</p>
                        <p class="text-2xl font-bold text-gray-900">1</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Task List -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-medium text-gray-900">Task Schedule</h2>
                    <div class="flex space-x-2">
                        <button class="px-3 py-1 text-sm bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200">
                            <i class="fas fa-filter mr-1"></i>Filter
                        </button>
                        <button class="px-3 py-1 text-sm bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            <i class="fas fa-plus mr-1"></i>Add Task
                        </button>
                    </div>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Room</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Task Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Priority</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Duration</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($tasks as $task): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <i class="fas fa-door-open text-gray-400 mr-2"></i>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900"><?php echo $task['room']; ?></div>
                                        <div class="text-sm text-gray-500"><?php echo $task['student']; ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo $task['type']; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php
                                $priorityClass = '';
                                switch ($task['priority']) {
                                    case 'High':
                                        $priorityClass = 'bg-red-100 text-red-800';
                                        break;
                                    case 'Medium':
                                        $priorityClass = 'bg-yellow-100 text-yellow-800';
                                        break;
                                    case 'Low':
                                        $priorityClass = 'bg-green-100 text-green-800';
                                        break;
                                }
                                ?>
                                <span class="px-2 py-1 text-xs font-medium rounded-full <?php echo $priorityClass; ?>">
                                    <?php echo $task['priority']; ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo $task['time']; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo $task['duration']; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php
                                $statusClass = '';
                                switch ($task['status']) {
                                    case 'Completed':
                                        $statusClass = 'bg-green-100 text-green-800';
                                        break;
                                    case 'In Progress':
                                        $statusClass = 'bg-blue-100 text-blue-800';
                                        break;
                                    case 'Pending':
                                        $statusClass = 'bg-gray-100 text-gray-800';
                                        break;
                                }
                                ?>
                                <span class="px-2 py-1 text-xs font-medium rounded-full <?php echo $statusClass; ?>">
                                    <?php echo $task['status']; ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <?php if ($task['status'] == 'Pending'): ?>
                                        <button class="text-blue-600 hover:text-blue-900">
                                            <i class="fas fa-play"></i>
                                        </button>
                                    <?php elseif ($task['status'] == 'In Progress'): ?>
                                        <button class="text-green-600 hover:text-green-900">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    <?php endif; ?>
                                    <button class="text-gray-600 hover:text-gray-900">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="text-gray-600 hover:text-gray-900">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Quick Actions</h3>
                <div class="space-y-3">
                    <button class="w-full flex items-center px-4 py-2 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100">
                        <i class="fas fa-plus mr-2"></i>
                        Report Issue
                    </button>
                    <button class="w-full flex items-center px-4 py-2 bg-green-50 text-green-700 rounded-lg hover:bg-green-100">
                        <i class="fas fa-calendar mr-2"></i>
                        View Schedule
                    </button>
                    <button class="w-full flex items-center px-4 py-2 bg-purple-50 text-purple-700 rounded-lg hover:bg-purple-100">
                        <i class="fas fa-chart-bar mr-2"></i>
                        Performance Report
                    </button>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Today's Notes</h3>
                <textarea class="w-full h-32 p-3 border border-gray-300 rounded-lg resize-none" placeholder="Add notes about today's tasks..."></textarea>
                <button class="mt-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Save Notes</button>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Supplies Status</h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Cleaning Supplies</span>
                        <span class="text-sm font-medium text-green-600">Good</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Towels</span>
                        <span class="text-sm font-medium text-yellow-600">Low</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Vacuum Cleaner</span>
                        <span class="text-sm font-medium text-green-600">Working</span>
                    </div>
                    <button class="w-full mt-3 px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">
                        Request Supplies
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Links -->
    <div class="fixed bottom-4 right-4 flex flex-col space-y-2">
        <a href="student.php" class="bg-green-600 text-white px-4 py-2 rounded-lg shadow hover:bg-green-700">
            Student Page
        </a>
        <a href="admin.php" class="bg-purple-600 text-white px-4 py-2 rounded-lg shadow hover:bg-purple-700">
            Admin Page
        </a>
    </div>

    <script>
        // Add interactivity
        document.addEventListener('DOMContentLoaded', function() {
            // Handle status updates
            const statusButtons = document.querySelectorAll('button[data-action]');
            statusButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const action = this.dataset.action;
                    const taskId = this.dataset.taskId;
                    // Here you would typically make an AJAX call to update the task status
                    console.log('Action:', action, 'Task ID:', taskId);
                });
            });
        });
    </script>
</body>
</html>