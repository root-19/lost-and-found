<?php
session_start(); // Start the session before using $_SESSION

require_once __DIR__ . '/../.../../../../vendor/autoload.php';
require_once __DIR__ . '/../../Config/Database.php';

use App\Config\Database;

$database = new Database();
$pdo = $database->connect();

// ✅ Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access. Please log in first.");
}

$user_id = $_SESSION['user_id'];

// ✅ Fetch notifications for debugging
$stmt = $pdo->prepare("SELECT * FROM notifications WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$user_id]);
$notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);



// ✅ Mark notifications as "Read"
$updateStmt = $pdo->prepare("UPDATE notifications SET status = 'Read' WHERE user_id = ?");
$updateStmt->execute([$user_id]);

include "../layout/student.php"; 
?>
<!-- ✅ Tailwind CSS UI -->
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold text-purple-900 text-center">📢 Notifications</h1>

    <div class="mt-6 bg-white shadow-md rounded-lg p-4">
        <?php if (!empty($notifications)) : ?>
            <?php foreach ($notifications as $notification) : ?>
                <div class="border-b py-3 px-4 bg-gray-100 my-2 rounded-lg">
                    <p class="text-gray-800 text-lg">
                        <?php echo htmlspecialchars($notification['message']); ?>
                    </p>
                    <span class="text-sm text-gray-500">
                        <?php echo date("F j, Y, g:i A", strtotime($notification['created_at'])); ?>
                    </span>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p class="text-gray-500 text-center">No new notifications.</p>
        <?php endif; ?>
    </div>
</div>