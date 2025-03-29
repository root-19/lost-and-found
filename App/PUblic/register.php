<?php
use App\Controllers\AuthController;

require_once __DIR__ . '/../../vendor/autoload.php'; 

$message = "";
$success = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $auth = new AuthController();
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = $auth->register($firstName, $lastName, $email, $password);

    if ($result["success"]) {
        $success = true;
        $message = "Registration successful! Redirecting to login...";
    } else {
        $message = $result["message"];
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100 flex flex-col items-center justify-center min-h-screen">

<header class="bg-white w-full fixed top-0 left-0 shadow-md px-6 py-3 flex items-center justify-between z-50">
    <div class="flex items-center">
        <img src="../Resources/image/Miriam_College_seal.svg" alt="Logo" class="h-16 w-20 mr-3">
        <h1 class="text-xl text-black font-semibold">Miriam College - Lost and Found System</h1>
    </div>
</header>

    <!-- Main Content -->
    <div class="flex flex-col md:flex-row items-center justify-center mt-10 w-full max-w-4xl bg-white rounded-lg shadow-lg overflow-hidden">
        
        <!-- Left Side - Registration Form -->
        <div class="w-full md:w-1/2 p-8">
            <h2 class="text-3xl font-semibold text-center  text-gray-700 mb-6">Register</h2>
            <form method="POST">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                        <input type="text" name="first_name" id="first_name" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-900">
                    </div>
                    <div>
                        <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                        <input type="text" name="last_name" id="last_name" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-900">
                    </div>
                </div>
                <div class="mt-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-900">
                </div>
                <div class="mt-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-900">
                </div>
                <div class="mt-4 flex items-center">
                    <input type="checkbox" id="terms" name="terms" required class="w-4 h-4 border-gray-300 rounded focus:ring-purple-900">
                    <label for="terms" class="ml-2 text-sm text-gray-600">I agree to the <a href="#" class="text-purple-900 underline">Terms & Conditions</a></label>
                </div>
                <div class="mt-6">
                    <button type="submit" class="w-full bg-gradient-to-br from-gray-900 to-blue-800 text-white py-3 rounded-md hover:bg-purple-800 focus:ring-2 focus:ring-purple-900">
                        Register
                    </button>
                </div>
            </form>
        </div>

        <!-- Right Side - About the System -->
        <div class="w-full md:w-1/2 p-8 flex flex-col justify-center">
            <h2 class="text-3xl font-semibold text-gray-700 text-center">Lost and Found System</h2>
            <p class="mt-4 text-gray-700 text-center">The Lost and Found System of Miriam College helps students and faculty report and recover lost items efficiently. This platform ensures a secure and organized way to return found belongings to their rightful owners.</p>
        </div>

    </div>
</body>
    <?php if (!empty($message)): ?>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            Swal.fire({
                icon: '<?php echo $success ? "success" : "error"; ?>',
                title: '<?php echo $success ? "Success!" : "Error!"; ?>',
                text: '<?php echo $message; ?>',
                timer: 3000,
                showConfirmButton: false
            });

            <?php if ($success): ?>
            setTimeout(() => {
                window.location.href = '../Views/student/dashboard.php';
            }, 3000);
            <?php endif; ?>
        });
    </script>
    <?php endif; ?>

</body>
</html>
