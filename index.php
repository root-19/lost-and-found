<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lost and Found System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center h-screen bg-gray-100">

    <div class="text-center bg-white p-10 shadow-lg rounded-lg">
        <h1 class="text-4xl font-bold text-gray-800">Welcome to Lost and Found System</h1>
        <p class="text-lg text-gray-600 mt-3">Find lost items or report found ones easily!</p>
        
        <a href="app/public/login.php" class="mt-6 inline-block bg-blue-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-600 transition">
            Start
        </a>
    </div>

</body>
</html>
