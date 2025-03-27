<?php
require_once __DIR__ . '/../.../../../../vendor/autoload.php';
require_once __DIR__ . '/../../Config/Database.php';

use App\Config\Database;

$database = new Database();
$pdo = $database->connect();
include "../layout/administrator.php"; 

// Fetch claims from the database
$stmt = $pdo->query("SELECT * FROM claims ORDER BY id DESC");
$claims = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle approval request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["approve_claim"])) {
    $claim_id = $_POST['claim_id'];
    $user_id = $_POST['user_id'];

    try {
        // Update claim status to 'Approved'
        $stmt = $pdo->prepare("UPDATE claims SET status = 'Approved' WHERE id = ?");
        $stmt->execute([$claim_id]);

        // Insert notification for user
        $message = "Your lost item is approved. Please claim it in the building claiming room.";
        $notifyStmt = $pdo->prepare("INSERT INTO notifications (user_id, message, status, created_at) VALUES (?, ?, 'Unread', NOW())");
        $notifyStmt->execute([$user_id, $message]);

        echo "<script>
                Swal.fire({
                    title: 'Claim Approved!',
                    text: 'Notification has been sent to the user.',
                    icon: 'success'
                }).then(() => {
                    window.location.reload();
                });
              </script>";
    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
}
?>

<div class="container mx-auto py-8">
    <h1 class="text-3xl font-semibold text-center text-purple-900">Claim Requests</h1>

    <div class="mt-6">
        <table class="min-w-full bg-white border border-gray-200 shadow-md rounded-lg">
            <thead>
                <tr class="bg-purple-700 text-white">
                    <th class="py-2 px-4 border">Claim ID</th>
                    <th class="py-2 px-4 border">Item ID</th>
                    <th class="py-2 px-4 border">User ID</th>
                    <th class="py-2 px-4 border">Location</th>
                    <th class="py-2 px-4 border">Time Lost</th>
                    <th class="py-2 px-4 border">Marks</th>
                    <th class="py-2 px-4 border">Details</th>
                    <th class="py-2 px-4 border">Status</th>
                    <th class="py-2 px-4 border">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($claims)) : ?>
                    <?php foreach ($claims as $claim) : ?>
                        <tr class="text-center border-b">
                            <td class="py-2 px-4 border"><?php echo $claim['id']; ?></td>
                            <td class="py-2 px-4 border"><?php echo $claim['item_id']; ?></td>
                            <td class="py-2 px-4 border"><?php echo $claim['user_id']; ?></td>
                            <td class="py-2 px-4 border"><?php echo htmlspecialchars($claim['location']); ?></td>
                            <td class="py-2 px-4 border"><?php echo htmlspecialchars($claim['time_lost']); ?></td>
                            <td class="py-2 px-4 border"><?php echo htmlspecialchars($claim['marks']); ?></td>
                            <td class="py-2 px-4 border"><?php echo htmlspecialchars($claim['details']); ?></td>
                            <td class="py-2 px-4 border font-semibold <?php echo ($claim['status'] == 'Approved') ? 'text-green-600' : 'text-red-600'; ?>">
                                <?php echo $claim['status']; ?>
                            </td>
                            <td class="py-2 px-4 border">
                                <?php if ($claim['status'] !== 'Approved') : ?>
                                    <form method="POST" class="inline-block">
                                        <input type="hidden" name="claim_id" value="<?php echo $claim['id']; ?>">
                                        <input type="hidden" name="user_id" value="<?php echo $claim['user_id']; ?>">
                                        <button type="submit" name="approve_claim"
                                                class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                                            Approve
                                        </button>
                                    </form>
                                <?php else : ?>
                                    <span class="text-gray-500">Approved</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="9" class="text-center py-4 text-gray-600">No claims found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
