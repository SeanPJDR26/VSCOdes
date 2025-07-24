<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Updated sample request data
$requests = [
    ['id' => 1, 'room' => 'Room 201', 'type' => 'General Clean', 'priority' => 'Medium', 'status' => 'Completed', 'date' => '2025-07-20', 'time' => '10:00 AM', 'requested_by' => 'Anna Lee', 'acc_type' => 'Student', 'housekeeper' => 'James'],
    ['id' => 2, 'room' => 'Room 305', 'type' => 'Deep Clean', 'priority' => 'High', 'status' => 'Pending', 'date' => '2025-07-21', 'time' => '2:00 PM', 'requested_by' => 'Mark Jones', 'acc_type' => 'Guest', 'housekeeper' => 'Maria'],
    ['id' => 3, 'room' => 'Room 101', 'type' => 'General Clean', 'priority' => 'Low', 'status' => 'Pending', 'date' => '2025-07-22', 'time' => '8:00 AM', 'requested_by' => 'Lucy Chen', 'acc_type' => 'Student', 'housekeeper' => 'Carlos'],
    ['id' => 4, 'room' => 'Room 402', 'type' => 'Deep Clean', 'priority' => 'High', 'status' => 'In Progress', 'date' => '2025-07-23', 'time' => '11:00 AM', 'requested_by' => 'Carlos Diaz', 'acc_type' => 'Guest', 'housekeeper' => 'Emily'],
    ['id' => 5, 'room' => 'Room 210', 'type' => 'Spot Clean', 'priority' => 'Medium', 'status' => 'Completed', 'date' => '2025-07-24', 'time' => '1:30 PM', 'requested_by' => 'Emily Smith', 'acc_type' => 'Student', 'housekeeper' => 'Leo'],
    ['id' => 6, 'room' => 'Room 310', 'type' => 'General Clean', 'priority' => 'Low', 'status' => 'Completed', 'date' => '2025-07-25', 'time' => '9:30 AM', 'requested_by' => 'Ryan Cooper', 'acc_type' => 'Guest', 'housekeeper' => 'Sofia'],
    ['id' => 7, 'room' => 'Room 109', 'type' => 'Deep Clean', 'priority' => 'High', 'status' => 'Pending', 'date' => '2025-07-26', 'time' => '3:00 PM', 'requested_by' => 'Tina Brown', 'acc_type' => 'Student', 'housekeeper' => 'Daniel'],
    ['id' => 8, 'room' => 'Room 303', 'type' => 'General Clean', 'priority' => 'Medium', 'status' => 'Completed', 'date' => '2025-07-27', 'time' => '10:30 AM', 'requested_by' => 'Jared Wilson', 'acc_type' => 'Guest', 'housekeeper' => 'Lily'],
    ['id' => 9, 'room' => 'Room 408', 'type' => 'Spot Clean', 'priority' => 'Low', 'status' => 'In Progress', 'date' => '2025-07-28', 'time' => '4:00 PM', 'requested_by' => 'Nina Patel', 'acc_type' => 'Student', 'housekeeper' => 'Ben'],
    ['id' => 10, 'room' => 'Room 207', 'type' => 'Deep Clean', 'priority' => 'High', 'status' => 'Completed', 'date' => '2025-07-29', 'time' => '5:00 PM', 'requested_by' => 'Ahmed Khan', 'acc_type' => 'Guest', 'housekeeper' => 'Grace'],
    ['id' => 11, 'room' => 'Room 105', 'type' => 'General Clean', 'priority' => 'Medium', 'status' => 'Pending', 'date' => '2025-07-30', 'time' => '9:00 AM', 'requested_by' => 'Chloe Nguyen', 'acc_type' => 'Student', 'housekeeper' => 'Oliver'],
    ['id' => 12, 'room' => 'Room 301', 'type' => 'Spot Clean', 'priority' => 'Low', 'status' => 'Completed', 'date' => '2025-07-31', 'time' => '7:30 AM', 'requested_by' => 'Leo Kim', 'acc_type' => 'Guest', 'housekeeper' => 'Zoe'],
    ['id' => 13, 'room' => 'Room 204', 'type' => 'General Clean', 'priority' => 'Medium', 'status' => 'In Progress', 'date' => '2025-08-01', 'time' => '11:45 AM', 'requested_by' => 'Sophia Martinez', 'acc_type' => 'Student', 'housekeeper' => 'Noah'],
    ['id' => 14, 'room' => 'Room 409', 'type' => 'Deep Clean', 'priority' => 'High', 'status' => 'Pending', 'date' => '2025-08-02', 'time' => '2:30 PM', 'requested_by' => 'Miguel Torres', 'acc_type' => 'Guest', 'housekeeper' => 'Mia'],
    ['id' => 15, 'room' => 'Room 103', 'type' => 'Spot Clean', 'priority' => 'Low', 'status' => 'Completed', 'date' => '2025-08-03', 'time' => '12:15 PM', 'requested_by' => 'Grace Lee', 'acc_type' => 'Student', 'housekeeper' => 'Ethan'],
    ['id' => 16, 'room' => 'Room 308', 'type' => 'General Clean', 'priority' => 'Medium', 'status' => 'Completed', 'date' => '2025-08-04', 'time' => '3:15 PM', 'requested_by' => 'David Park', 'acc_type' => 'Guest', 'housekeeper' => 'Ava'],
    ['id' => 17, 'room' => 'Room 110', 'type' => 'Deep Clean', 'priority' => 'High', 'status' => 'In Progress', 'date' => '2025-08-05', 'time' => '10:15 AM', 'requested_by' => 'Isabella Johnson', 'acc_type' => 'Student', 'housekeeper' => 'Liam']
];

$limit = 10; // 10 requests per page
$totalRequests = count($requests);
$totalPages = ceil($totalRequests / $limit);

// Get current page from GET parameter or default to 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
if ($page > $totalPages) $page = $totalPages;

// Calculate offset and get only the current page data
$offset = ($page - 1) * $limit;
$currentRequests = array_slice($requests, $offset, $limit);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Requests</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <i class="fas fa-list text-blue-600 text-2xl mr-3"></i>
                    <h1 class="text-xl font-semibold text-gray-900">All Service Requests</h1>
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


    <!-- Main Section -->
<main class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="bg-white rounded-lg shadow px-4">
        <div class="px-6 py-4 border-b border-gray-200">
            <!-- ✅ New Header with Live Count -->
            <h2 class="text-lg font-semibold text-gray-900 mb-1">
                Current Requests:
                <span class="ml-4 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                    <span id="visibleCount">0</span>
                    <span class="ml-1">showing</span>
                </span>
            </h2>
        </div>

        <div id="requestsTable" data-limit="<?= $limit ?>">
            <div class="bg-white p-6 rounded-lg shadow mt-6 w-full overflow-visible">

                <!-- Search Bar -->
                <div class="mt-6 mb-4 flex justify-center">
                    <input type="text" id="searchInput" placeholder="Search by name or room #..."
                        class="w-full sm:w-1/2 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:border-blue-300">
                </div>

                <!-- Sort Buttons -->
                <div class="flex justify-center mb-4">
                    <div class="flex flex-wrap gap-2">
                        <button onclick="sortTable(0)" class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300 text-sm">Sort by ID</button>
                        <button onclick="sortTable(1)" class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300 text-sm">Sort by Room</button>
                        <button onclick="sortTable(4)" class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300 text-sm">Sort by Status</button>
                    </div>
                </div>

                <!-- Export to Excel Button -->
                <div class="flex justify-center mt-4 mb-2">
                    <button onclick="exportToExcel()" class="px-3 py-2 bg-green-500 text-white rounded hover:bg-green-600 text-sm">
                        <i class="fas fa-file-excel mr-1"></i>Export Data to Excel
                    </button>
                </div>

                <!-- ✅ Main Table -->
                <table class="min-w-full w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Room</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Service Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Priority</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Housekeeper</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Requested By</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acc Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
    <?php foreach ($currentRequests as $req): ?>
        <tr class="hover:bg-gray-50">
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $req['id'] ?></td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $req['room'] ?></td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $req['type'] ?></td>
            <td class="px-6 py-4 whitespace-nowrap text-sm">
                <?php
                $priorityClass = '';
                switch ($req['priority']) {
                    case 'High': $priorityClass = 'bg-red-100 text-red-800'; break;
                    case 'Medium': $priorityClass = 'bg-yellow-100 text-yellow-800'; break;
                    case 'Low': $priorityClass = 'bg-green-100 text-green-800'; break;
                }
                ?>
                <span class="px-2 py-1 text-xs font-medium rounded-full <?= $priorityClass ?>">
                    <?= $req['priority'] ?>
                </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm">
                <?php
                $statusClass = '';
                switch ($req['status']) {
                    case 'Completed': $statusClass = 'bg-green-100 text-green-800'; break;
                    case 'Pending': $statusClass = 'bg-gray-100 text-gray-800'; break;
                    case 'In Progress': $statusClass = 'bg-blue-100 text-blue-800'; break;
                }
                ?>
                <span class="px-2 py-1 text-xs font-medium rounded-full <?= $statusClass ?>">
                    <?= $req['status'] ?>
                </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $req['date'] ?></td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $req['time'] ?></td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $req['housekeeper'] ?></td>
            <td class="px-4 py-2 text-sm text-gray-700"><?= $req['requested_by'] ?></td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $req['acc_type'] ?></td>

            <td class="px-6 py-4 whitespace-nowrap text-sm text-right space-x-2">
                <button onclick='printRequest(<?= json_encode($req) ?>)'
                    class="px-3 py-1 bg-indigo-500 text-white rounded hover:bg-indigo-600 text-xs">
                    <i class="fas fa-print mr-1"></i>Print
                </button>
                <button onclick="removeRequest(this)"
                    class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-xs">
                    <i class="fas fa-trash-alt mr-1"></i>Remove
                </button>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>
                </table>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const rows = document.querySelectorAll("tbody tr");
    console.log("Rows found:", rows.length);
    document.getElementById("visibleCount").textContent = rows.length;
});

window.addEventListener('DOMContentLoaded', () => {
    updateVisibleCount();
});

</script>

                <!-- Pagination Controls -->
                <div class="flex justify-center items-center mt-6 space-x-2 text-sm text-gray-700">
                    <?php if ($page > 1): ?>
                        <a href="?page=<?= $page - 1 ?>" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Prev</a>
                    <?php endif; ?>
                    <span>Page <?= $page ?> of <?= $totalPages ?></span>
                    <?php if ($page < $totalPages): ?>
                        <a href="?page=<?= $page + 1 ?>" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Next</a>
                    <?php endif; ?>
                </div>

                <!-- Navigation Links -->
                <div class="fixed bottom-4 right-4 flex flex-col space-y-2">
                    <a href="admin.php" class="bg-purple-600 text-white px-4 py-2 rounded-lg shadow hover:bg-purple-700">Admin Page</a>
                    <a href="add_housekeeper.php" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700">Add Housekeeper</a>
                    <a href="report.php" class="bg-green-600 text-white px-4 py-2 rounded-lg shadow hover:bg-green-700">Report Page</a>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    
<script>
let currentPage = 1;
let sortOrder = 'asc';
let sortColumn = null;
let allRows = [];

const rowsPerPage = parseInt(document.getElementById('requestsTable').dataset.limit);

function getFilteredRows() {
    const search = document.getElementById('searchInput')?.value?.toLowerCase() || '';
    return allRows.filter(row =>
        row.textContent.toLowerCase().includes(search)
    );
}

function renderTable() {
    const tbody = document.querySelector('#requestsTable tbody');
    tbody.innerHTML = '';

    const filteredRows = getFilteredRows();

    // Sort using selected column index if provided
    if (sortColumn !== null) {
        filteredRows.sort((a, b) => {
            const aText = a.cells[sortColumn].textContent.trim().toLowerCase();
            const bText = b.cells[sortColumn].textContent.trim().toLowerCase();

            const aNum = parseFloat(aText);
            const bNum = parseFloat(bText);

            if (!isNaN(aNum) && !isNaN(bNum)) {
                return sortOrder === 'asc' ? aNum - bNum : bNum - aNum;
            } else {
                return sortOrder === 'asc' ? aText.localeCompare(bText) : bText.localeCompare(aText);
            }
        });
    }

    const start = (currentPage - 1) * rowsPerPage;
    const paginatedRows = filteredRows.slice(start, start + rowsPerPage);

    paginatedRows.forEach(row => tbody.appendChild(row));
    renderPagination(filteredRows.length);
    updateVisibleCount(filteredRows.length);
}

function renderPagination(totalRows) {
    const totalPages = Math.ceil(totalRows / rowsPerPage);
    const pagination = document.getElementById('pagination');
    pagination.innerHTML = '';

    if (totalPages <= 1) return;

    const createPageButton = (page, label = page) => {
        const btn = document.createElement('button');
        btn.textContent = label;
        btn.className = `px-3 py-1 border rounded mx-1 ${currentPage === page ? 'bg-blue-500 text-white' : 'bg-white text-gray-700 hover:bg-gray-200'}`;
        btn.addEventListener('click', () => {
            currentPage = page;
            renderTable();
        });
        return btn;
    };

    if (currentPage > 1) pagination.appendChild(createPageButton(currentPage - 1, 'Previous'));
    for (let i = 1; i <= totalPages; i++) pagination.appendChild(createPageButton(i));
    if (currentPage < totalPages) pagination.appendChild(createPageButton(currentPage + 1, 'Next'));

    document.getElementById('pageIndicator').textContent = `Page ${currentPage} of ${Math.max(totalPages, 1)}`;
}

function updateVisibleCount() {
    // Wait for DOM content to be fully loaded and table rows to exist
    const rows = document.querySelectorAll('tbody tr');
    const visibleRows = Array.from(rows).filter(row => row.style.display !== 'none');

    document.getElementById('visibleCount').textContent = visibleRows.length;
    document.getElementById('totalCount').textContent = rows.length;
}

function sortTable(columnIndex) {
    if (sortColumn === columnIndex) {
        sortOrder = (sortOrder === 'asc') ? 'desc' : 'asc';
    } else {
        sortColumn = columnIndex;
        sortOrder = 'asc';
    }

    currentPage = 1;
    renderTable();
}

document.getElementById('searchInput').addEventListener('input', () => {
    currentPage = 1;
    renderTable();
});

window.onload = () => {
    allRows = Array.from(document.querySelectorAll('#requestsTable tbody tr'));
    renderTable();
};

function printRequest(data) {
    const printWindow = window.open('', '', 'width=800,height=600');
    printWindow.document.write('<html><head><title>Print Request</title>');
    printWindow.document.write('<style>body{font-family:sans-serif;padding:20px;} table{border-collapse:collapse;width:100%;} td,th{border:1px solid #ccc;padding:8px;}</style>');
    printWindow.document.write('</head><body>');
    printWindow.document.write('<h2>Cleaning Request Details</h2>');
    printWindow.document.write('<table>');
    for (const key in data) {
        printWindow.document.write('<tr><th>' + key.charAt(0).toUpperCase() + key.slice(1) + '</th><td>' + data[key] + '</td></tr>');
    }
    printWindow.document.write('</table>');
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.focus();
    printWindow.print();
    printWindow.close();
}

function removeRequest(button) {
    const row = button.closest('tr');
    if (confirm('Are you sure you want to remove this request?')) {
        row.remove();
        updateVisibleCount();
    }
}

function exportToExcel() {
    let table = document.getElementById("requestsTable");
    let wb = XLSX.utils.table_to_book(table, { sheet: "Requests" });
    XLSX.writeFile(wb, "housekeeper_requests.xlsx");
}
</script>

</body>
</html>