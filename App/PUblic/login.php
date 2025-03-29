<?php 
use App\Controllers\AuthController;
require_once __DIR__ . '/../../vendor/autoload.php';
// session_start();

$error_message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $auth = new AuthController();
    $email = trim($_POST['email']); // Trim input to avoid spaces
    $password = trim($_POST['password']);

    $result = $auth->login($email, $password);

    if (!$result['success']) {
        $error_message = $result['message'];
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

    <header class="bg-white w-full fixed top-0 left-0 shadow-md px-6 py-3 flex items-center justify-between z-50">
        <div class="flex items-center">
            <img src="../Resources/image/Miriam_College_seal.svg" alt="Logo" class="h-16 w-20 mr-3">
            <h1 class="text-xl text-gradient-to-br from-gray-900 to-blue-800 font-semibold">Miriam College - Lost and Found System</h1>
        </div>
    </header>

    <div class="flex flex-col items-center justify-center w-full mt-28">
        <div class="flex bg-white shadow-lg rounded-lg w-3/4 max-w-4xl">
            <div class="w-1/2  rounded-l-lg flex flex-col justify-center">
                <h2 class="text-2xl font-bold text-gray-500" >Lost and Found System</h2>
                <p class="mt-4 text-gray-500">
                    The Lost and Found System of Miriam College helps students and faculty report and recover lost items efficiently.
                </p>
            </div>

            <div class="w-1/2 p-8 flex flex-col justify-center">
                <h2 class="text-2xl font-bold text-gray-600 text-center">Login</h2>

                <?php if (!empty($error_message)): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4">
                        <strong>Error:</strong> <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>

                <form method="POST" class="mt-6 flex flex-col">
                    <input type="email" name="email" placeholder="Email" required class="w-full p-3 border border-gray-300 rounded mt-2 focus:ring-2 focus:ring-purple-500">
                    <input type="password" name="password" placeholder="Password" required class="w-full p-3 border border-gray-300 rounded mt-2 focus:ring-2 focus:ring-purple-500">
                    <button type="submit" class="w-full bg-gradient-to-br from-gray-900 to-blue-800 text-white p-3 rounded mt-4 hover:bg-purple-800 transition">Login</button>
                </form>

                <p class="text-center text-gray-600 mt-4">Don't have an account? 
                    <a href="./register.php" class="text-purple-700 font-semibold hover:underline">Sign up</a>
                </p>
            </div>
        </div>
    </div>

</body>
</html>
