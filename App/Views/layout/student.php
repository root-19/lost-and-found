<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../Config/Database.php';

use App\Config\Database;

$database = new Database();
$pdo = $database->connect();
$user_id = isset($_SESSION['role']) && $_SESSION['role'] === "student";


$notifyStmt = $pdo->prepare("SELECT COUNT(*) AS unread_count FROM notifications WHERE user_id = ? AND status = 'Unread'");
$notifyStmt->execute([$_SESSION['user_id']]);
$notification = $notifyStmt->fetch(PDO::FETCH_ASSOC);
$unreadCount = $notification['unread_count'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lost and Found System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

<!-- Navbar -->
<nav class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
        <div class="flex items-center">
            <img src="../../Resources/image/Miriam_College_seal.svg" alt="Logo" class="h-16 w-20 mr-3">
            <h1 class="text-xl text-gradient-to-br from-gray-900 to-blue-800 font-semibold">Miriam College - Lost and Found System</h1>
        </div>
            <!-- Mobile Menu Button -->
            <div class="flex items-center sm:hidden">
                <button id="menu-toggle" class="text-white focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <!-- Navbar Links -->
            <div class="hidden sm:flex sm:items-center space-x-4 text-black">
                <a href="../student/dashboard.php" class="text-black font-bold  hover:bg-gradient-to-br from-gray-900 to-blue-800 px-3 py-2 rounded-md">Home</a>
                <a href="../student/lost-item.php" class="text-black font-bold hover:bg-hover:bg-gradient-to-br from-gray-900 to-blue-800 bg-blue-700 px-3 py-2 rounded-md">Lost</a>
                <a href="../student/claim-item.php" class=" relativetext-white font-bold hover:bg-gradient-to-br from-gray-900 to-blue-800 bg-blue-700 px-3 py-2 rounded-md">Claim
                <?php if ($unreadCount > 0): ?>bg-
        <span class="absolute top-0 right-0 bg-red-500 text-white text-xs px-2 py-1 rounded-full">
            <?php echo $unreadCount; ?>
        </span>
    <?php endif; ?>
                </a>
                <!-- <a href="users.php" class="text-white hover:bg-blue-700 px-3 py-2 rounded-md">Users</a> -->
                <a href="../student/session.php" class="text-white bg-red-500 hover:bg-red-600 px-3 py-2 rounded-md">Logout</a>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden sm:hidden bg-blue-600">
    <a href="../student/dashboard.php" class="text-white hover:bg-blue-700 px-3 py-2 rounded-md">Home</a>
                <a href="../student/lost-item.php" class="text-white hover:bg-blue-700 px-3 py-2 rounded-md">Lost</a>
                <a href="../student/claim-item.php" class=" relativetext-white hover:bg-blue-700 px-3 py-2 rounded-md">Claim
                <?php if ($unreadCount > 0): ?>
        <span class="absolute top-0 right-0 bg-red-500 text-white text-xs px-2 py-1 rounded-full">
            <?php echo $unreadCount; ?>
        </span>
    <?php endif; ?>
                </a>
                <!-- <a href="users.php" class="text-white hover:bg-blue-700 px-3 py-2 rounded-md">Users</a> -->
                <a href="../student/session.php" class="text-white bg-red-500 hover:bg-red-600 px-3 py-2 rounded-md">Logout</a>
    </div>
</nav>


<!-- <script src="../../Resources/js/header.js"></script> -->


