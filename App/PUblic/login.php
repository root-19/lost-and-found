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
    <title>Login - GradeLink Job Hoping</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-lg">
        <h2 class="text-2xl font-bold text-purple-900 text-center mb-6">Login</h2>
        <form method="POST" class="space-y-4">
            <div>
                <label for="email" class="block text-gray-600">Email</label>
                <input type="email" name="email" id="email" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-purple-900" required>
            </div>
            <div>
                <label for="password" class="block text-gray-600">Password</label>
                <input type="password" name="password" id="password" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-purple-900" required>
            </div>
            <button type="submit" class="w-full bg-purple-900 text-white py-2 rounded-lg hover:bg-purple-800 transition">Login</button>
        </form>
        <p class="mt-4 text-sm text-gray-600 text-center">
            Don't have an account? <a href="register.php" class="text-purple-900 hover:underline">Sign up</a>
        </p>
    </div>
</body>
</html>
