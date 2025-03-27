<?php
use App\Controllers\AuthController;

require_once __DIR__ . '/../../vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $auth = new AuthController();
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = $auth->login($email, $password);

    if (!$result['success']) {
        echo $result['message'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Miriam College Lost and Found</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex flex-col items-center justify-center min-h-screen">

    <!-- Header Section -->
    <header class="bg-white w-full fixed top-0 left-0 shadow-md px-6 py-3 flex items-center justify-between z-50">
        <div class="flex items-center">
            <img src="../Resources/image/Miriam_College_seal.svg" alt="Logo" class="h-16 w-20 mr-3">
            <h1 class="text-xl text-black font-semibold">Miriam College - Lost and Found System</h1>
        </div>
    </header>

    <!-- Main Container -->
    <div class="flex flex-col items-center justify-center w-full mt-28">
        <div class="flex bg-white shadow-lg rounded-lg w-3/4 max-w-4xl">

            <!-- Left Side - Information -->
            <div class="w-1/2 bg-purple-100 p-8 rounded-l-lg flex flex-col justify-center">
                <h2 class="text-2xl font-bold text-purple-700">Lost and Found System</h2>
                <p class="mt-4 text-gray-600">
                    The Lost and Found System of Miriam College helps students and faculty report and recover lost items efficiently.
                </p>
            </div>

            <!-- Right Side - Login Form -->
            <div class="w-1/2 p-8 flex flex-col justify-center">
                <h2 class="text-2xl font-bold text-purple-700 text-center">Login</h2>
                <form class="mt-6 flex flex-col">
                    <input type="email" placeholder="Email" class="w-full p-3 border border-gray-300 rounded mt-2 focus:ring-2 focus:ring-purple-500">
                    <input type="password" placeholder="Password" class="w-full p-3 border border-gray-300 rounded mt-2 focus:ring-2 focus:ring-purple-500">
                    <button class="w-full bg-purple-700 text-white p-3 rounded mt-4 hover:bg-purple-800 transition">Login</button>
                </form>
                <p class="text-center text-gray-600 mt-4">Don't have an account? 
                    <a href="./register.php" class="text-purple-700 font-semibold hover:underline">Sign up</a>
                </p>
            </div>

        </div>
    </div>

</body>
</html>