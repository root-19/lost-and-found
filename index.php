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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/framer-motion/10.12.2/framer-motion.umd.min.js" defer></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gradient-to-br from-gray-900 to-blue-800">
    <div class="relative w-full max-w-md px-8 py-12 bg-white shadow-xl rounded-2xl transform transition-all duration-300 hover:scale-105">
        <div class="text-center">
            <h1 class="text-4xl font-extrabold text-gray-800">Lost and Found System</h1>
            <p class="text-lg text-gray-600 mt-3">Find lost items or report found ones easily!</p>
        </div>
        
        <div class="mt-6 flex justify-center">
            <a href="app/public/login.php" 
               class="px-8 py-3 text-lg font-semibold text-white bg-yellow-500 rounded-lg shadow-md transition-all duration-300 hover:bg-yellow-600 hover:shadow-xl">
                Get Started
            </a>
        </div>
        
        <!-- Animated Floating Circles -->
        <div class="absolute top-0 left-0 w-24 h-24 bg-blue-500 rounded-full opacity-30 animate-pulse"></div>
        <div class="absolute bottom-0 right-0 w-32 h-32 bg-purple-500 rounded-full opacity-20 animate-bounce"></div>
    </div>
</body>
</html>
