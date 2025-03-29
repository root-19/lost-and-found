<?php
include "../layout/student.php"; 

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

// Get the user's name
$userName = $_SESSION['first_name'] . " " . $_SESSION['last_name'];
?>

<div class="max-w-2xl mx-auto p-6 bg-white mt-20">
        <h1 class="text-3xl font-semibold text-gray-900">Welcome, <?php echo htmlspecialchars($userName); ?>!</h1>
        <p class="mt-2 text-gray-600">
            This is the Lost and Found System where students can report lost items and claim found belongings.
        </p>


        <div class="mt-4 text-left">
            <h2 class="text-xl font-semibold text-purple-900">How It Works?</h2>
            <ul class="mt-2 list-disc list-inside text-gray-700">
                <li><strong>View Found Items:</strong> Browse through items that have been found.</li>
                <li><strong>Claim Your Item:</strong> If your item is found, you can request to claim it.</li>
                <li><strong>Stay Updated:</strong> Get notified when a matching item is found.</li>
            </ul>
        </div>

        <div class="mt-6">
          
            <a href="lost-items.php" class="ml-2 bg-gradient-to-br from-gray-900 to-blue-800 bg-blue-700 text-white px-4 py-2 rounded-md hover:bg-gray-600">
                View Found Items
            </a>
        </div>
    </div>

</body>
</html>
