<?php
session_start();
date_default_timezone_set('Asia/Manila');
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['housekeepers'])) {
    $_SESSION['housekeepers'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit']) && count($_SESSION['housekeepers']) < 4) {
    $newHousekeeper = [
        'id' => count($_SESSION['housekeepers']) + 1,
        'staff_id' => $_POST['staff_id'],
        'name' => $_POST['name'],
        'contact' => $_POST['contact'],
        'email' => $_POST['email'],
        'gender' => $_POST['gender'],
        'password' => $_POST['password'],
        'date_created' => date('F j, Y \a\t h:i a')
    ];

    $_SESSION['housekeepers'][] = $newHousekeeper;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $deleteId = (int) $_POST['delete_id'];
    $_SESSION['housekeepers'] = array_values(array_filter($_SESSION['housekeepers'], function($hk) use ($deleteId) {
        return $hk['id'] !== $deleteId;
    }));
    foreach ($_SESSION['housekeepers'] as $index => &$hk) {
        $hk['id'] = $index + 1;
    }
    unset($hk);
}

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contact = $_POST['contact'] ?? '';
    if (!preg_match('/^\d{11}$/', $contact)) {
        $errors[] = "Contact number must be exactly 11 digits.";
    }

    $password = $_POST['password'] ?? '';
    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long.";
    }
    if (!preg_match('/[A-Z]/', $password)) {
        $errors[] = "Password must contain at least 1 uppercase letter.";
    }
    if (preg_match_all('/\d/', $password) < 2) {
        $errors[] = "Password must contain at least 2 numbers.";
    }
    if (!preg_match('/[!@#$%^&*]/', $password)) {
        $errors[] = "Password must contain at least 1 special character (!@#$%^&*).";
    }
    if (empty($errors)) {
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Housekeeper</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 min-h-screen">

    <!-- Header -->
    <header class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <i class="fas fa-user-plus text-blue-600 text-2xl mr-3"></i>
                    <h1 class="text-xl font-semibold text-gray-900">Manage Housekeepers</h1>
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

    <main class="w-full max-w-[1800px] mx-auto px-6 py-6">
    <div class="bg-white rounded-lg shadow px-6 py-4">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Dedicated Housekeepers:
            <span class="ml-4 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                <?= count($_SESSION['housekeepers']) ?>/4 added
            </span>
        </h2>

        <table class="w-full table-auto border-collapse">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">No#</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">ID number</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Name</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Contact</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Email</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Gender</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Password</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php if (!empty($_SESSION['housekeepers'])): ?>
                    <?php foreach ($_SESSION['housekeepers'] as $hk): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-900 text-center"><?= $hk['id'] ?></td>
                            <td class="px-6 py-4 text-sm text-gray-900 text-center"><?= htmlspecialchars($hk['staff_id'] ?? 'N/A') ?></td>
                            <td class="px-6 py-4 text-sm text-gray-900 text-center"><?= htmlspecialchars($hk['name']) ?></td>
                            <td class="px-6 py-4 text-sm text-gray-900 text-center"><?= htmlspecialchars($hk['contact']) ?></td>
                            <td class="px-6 py-4 text-sm text-gray-900 text-center"><?= htmlspecialchars($hk['email']) ?></td>
                            <td class="px-6 py-4 text-sm text-gray-900 text-center"><?= htmlspecialchars($hk['gender']) ?></td>
                            <!-- Password column -->
                             <td class="px-6 py-4 text-sm text-gray-900 text-center">
                                <?php
                                $pwd = $hk['password'];
                                $visible = htmlspecialchars(substr($pwd, 0, 3));
                                $masked = str_repeat('*', max(strlen($pwd) - 3, 0));
                                echo $visible . $masked; ?></td>
                            <!-- Actions column -->
                             <td class="px-6 py-4 text-sm text-gray-900 text-center space-x-2">
                                <form method="POST" action="add_housekeeper.php" style="display:inline;">
                                    <input type="hidden" name="delete_id" value="<?= htmlspecialchars($hk['id']) ?>">
                                    <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">Remove</button>
                                </form>
                                <button onclick='printHousekeeper(<?= json_encode($hk, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>)' 
                                class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">Print</button></td>
                            </tr>

                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center py-4 text-gray-500">No housekeepers added yet.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <?php if (count($_SESSION['housekeepers']) >= 4): ?>
            <p class="mt-4 text-red-600 text-sm">
                You have reached the maximum of 4 dedicated housekeepers.
            </p>
        <?php else: ?>
            <p class="mt-4 text-green-600 text-sm">
                You may still add <?= 4 - count($_SESSION['housekeepers']) ?> housekeeper(s).
            </p>
        <?php endif; ?>
    </div>
</main>

    <!-- Add Housekeeper Form Section -->
<main class="w-full max-w-[1800px] mx-auto px-6 py-6 overflow-x-auto">
    <div class="bg-white rounded-lg shadow px-6 py-4">
        <h2 class="text-lg font-semibold text-gray-900 mb-4 text-center">Add a New Housekeeper</h2>

        <?php if (isset($_GET['success'])): ?>
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                <strong class="font-bold">Success!</strong>
                <span class="block">Housekeeper was added successfully.</span>
            </div>

        <?php elseif (isset($_GET['error'])): ?>
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <strong class="font-bold">Error!</strong>
                <span class="block">There was a problem adding the housekeeper.</span>
            </div>
        <?php endif; ?>

        <form method="POST" action="add_housekeeper.php" class="space-y-4">
            <div class="grid grid-cols-4 gap-4 text-sm">
                <div>
                    <label for="staff_id" class="block text-sm font-medium text-gray-700 mb-1">ID Number</label>
                    <input type="text" id="staff_id" name="staff_id" required pattern="\d{6}" maxlength="6"
                    title="Must be exactly 6 digits" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <input type="text" id="name" name="name" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label for="contact" class="block text-sm font-medium text-gray-700 mb-1">Contact Number</label>
                     <input type="text" id="contact" name="contact" required pattern="\d{11}" maxlength="11" title="Contact number must be exactly 11 digits (numbers only)" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                     class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                     <span id="contactError" class="text-red-500 text-sm mt-1 block"></span>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <input type="email" id="email" name="email" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                    <select id="gender" name="gender" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                        <option value="" disabled selected>Select gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" id="password" name="password" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" oninput="validatePassword()">
                    <p id="passwordError" class="text-red-500 text-sm mt-1"></p>
                </div>

                <!-- Confirm Password Field -->
                 <div>
                    <label for="confirm_password" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                    oninput="validateConfirmPassword()">
                     <p id="confirmPasswordError" class="text-red-500 text-sm mt-1 h-5"></p>
                    </div>
                </div>
                
                <div class="flex justify-end pt-4 space-x-3">
                    <a href="admin.php" class="px-5 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400">Cancel</a>
                    <button type="submit" name="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Add Housekeeper</button>
                </div>
        </form>
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

<script>

document.querySelector("form").addEventListener("submit", function (e) {
    const pwd = document.getElementById("password").value;
    const confirm = document.getElementById("confirm_password").value;
    if (pwd !== confirm) {
        e.preventDefault();
        alert("Passwords do not match!");
    }
});

function printHousekeeper(hk) {
    const printWindow = window.open('', '', 'height=500,width=800');
    printWindow.document.write('<html><head><title>Print Housekeeper</title>');
    printWindow.document.write('<style>body{font-family: Arial;padding:20px;}h2{margin-bottom:20px;}table{width:100%;border-collapse:collapse;}td{padding:10px;border:1px solid #ccc;}</style>');
    printWindow.document.write('</head><body>');
    printWindow.document.write('<h2 style="text-align: center;">Added Housekeeper Details:</h2>');
    printWindow.document.write('<table>');
    printWindow.document.write('<tr><td style="text-align: left;"><strong>Employee Number:</strong></td><td style="text-align: center;">' + hk.id + '</td></tr>'); 
    printWindow.document.write('<tr><td style="text-align: left;"><strong>ID Number:</strong></td><td style="text-align: center;">' + hk.staff_id + '</td></tr>');
    printWindow.document.write('<tr><td style="text-align: left;"><strong>Name:</strong></td><td style="text-align: center;">' + hk.name + '</td></tr>');
    printWindow.document.write('<tr><td style="text-align: left;"><strong>Contact Info:</strong></td><td style="text-align: center;">' + hk.contact + '</td></tr>');
    printWindow.document.write('<tr><td style="text-align: left;"><strong>Email Address:</strong></td><td style="text-align: center;">' + hk.email + '</td></tr>');
    printWindow.document.write('<tr><td style="text-align: left;"><strong>Gender:</strong></td><td style="text-align: center;">' + hk.gender + '</td></tr>');
    printWindow.document.write('<tr><td style="text-align: left;"><strong>Password:</strong></td><td style="text-align: center;">' + hk.password + '</td></tr>');

    printWindow.document.write('<tr><td style="text-align: left;"><strong>Date of Creation:</strong></td><td style="text-align: center;">' + hk.date_created + '</td></tr>');

    printWindow.document.write('</table>');
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print();
}

function validatePassword() {
  const password = document.getElementById('password').value;
  const errorField = document.getElementById('passwordError');

  if (password.length === 0) {
    errorField.textContent = "";
    return;
  }

  if (password.length < 6) {
    errorField.textContent = "Password must be at least 6 characters long.";
  } else if (!/[A-Z]/.test(password)) {
    errorField.textContent = "Must contain at least 1 uppercase letter.";
  } else if ((password.match(/\d/g) || []).length < 2) {
    errorField.textContent = "Must include at least 2 numbers.";
  } else if (!/[!@#$%^&*]/.test(password)) {
    errorField.textContent = "Must include at least 1 special character (!@#$%^&*).";
  } else {
    errorField.textContent = "";
  }
}

document.getElementById("contact").addEventListener("input", function () {
  const value = this.value;
  const errorField = document.getElementById("contactError");

  if (value.length > 0 && value.length !== 11) {
    errorField.textContent = "Contact number must be exactly 11 digits.";
  } else {
    errorField.textContent = "";
  }
});

function validateConfirmPassword() {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password').value;
    const errorField = document.getElementById('confirmPasswordError');

    if (confirmPassword === "") {
        errorField.textContent = "";
    } else if (password !== confirmPassword) {
        errorField.textContent = "Passwords do not match.";
    } else {
        errorField.textContent = "";
    }
}
</script>
</body>
</html>