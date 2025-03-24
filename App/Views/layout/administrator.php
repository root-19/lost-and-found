<?php
session_start();
$user_id = isset($_SESSION['role']) && $_SESSION['role'] === "administrator";
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
<nav class="bg-blue-600 shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="index.php" class="text-white text-2xl font-bold">MyApp</a>
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
            <div class="hidden sm:flex sm:items-center space-x-4">
                <a href="index.php" class="text-white hover:bg-blue-700 px-3 py-2 rounded-md">Home</a>
                <a href="lost.php" class="text-white hover:bg-blue-700 px-3 py-2 rounded-md">Lost</a>
                <a href="found.php" class="text-white hover:bg-blue-700 px-3 py-2 rounded-md">Found</a>
                <a href="users.php" class="text-white hover:bg-blue-700 px-3 py-2 rounded-md">Users</a>
                <a href="session.php" class="text-white bg-red-500 hover:bg-red-600 px-3 py-2 rounded-md">Logout</a>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden sm:hidden bg-blue-600">
        <a href="index.php" class="block text-white px-4 py-2">Home</a>
        <a href="lost.php" class="block text-white px-4 py-2">Lost</a>
        <a href="found.php" class="block text-white px-4 py-2">Found</a>
        <a href="users.php" class="block text-white px-4 py-2">Users</a>
        <a href="logout.php" class="block text-white px-4 py-2 bg-red-500 hover:bg-red-600">Logout</a>
    </div>
</nav>


<script src="../../Resources/js/header.js"></script>


