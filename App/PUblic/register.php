<?php
use App\Controllers\AuthController;

require_once __DIR__ . '/../../vendor/autoload.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $auth = new AuthController();
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
   

    $result = $auth->register($firstName, $lastName, $email, $password);

    if ($result === true) {
        header("Location: login.php");
        exit();
    } else {
        echo "Registration failed";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Lost and Found</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white rounded-lg shadow-lg max-w-lg w-full overflow-hidden">
        <img src="../resources/image/LOGO.png" alt="Job Search" class="w-full h-40 object-cover">
        <form method="POST" class="p-6">
            <h2 class="text-2xl font-semibold mb-4 text-center text-purple-900">Register</h2>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                    <input type="text" name="first_name" id="first_name" required class="mt-1 block w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-purple-900">
                </div>
                <div>
                    <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                    <input type="text" name="last_name" id="last_name" required class="mt-1 block w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-purple-900">
                </div>
            </div>
            <div class="mt-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" required class="mt-1 block w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-purple-900">
            </div>
            <div class="mt-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" required class="mt-1 block w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-purple-900">
            </div>
            <div class="mt-4 flex items-center">
                <input type="checkbox" id="terms" name="terms" required class="w-4 h-4 border-gray-300 rounded focus:ring-purple-900">
                <label for="terms" class="ml-2 text-sm text-gray-600">I agree to the <a href="#" class="text-purple-900 underline">Terms & Conditions</a></label>
            </div>
            <div class="mt-6">
                <button type="submit" class="w-full bg-purple-900 text-white py-2 px-4 rounded-md hover:bg-purple-800 focus:ring-2 focus:ring-purple-900">
                    Register
                </button>
            </div>
        </form>
    </div>
</body>
</html>
