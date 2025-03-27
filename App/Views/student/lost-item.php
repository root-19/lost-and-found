<?php
require_once __DIR__ . '/../.../../../../vendor/autoload.php';
require_once __DIR__ . '/../../Models/UserModel.php';
require_once __DIR__ . '/../../Config/Database.php'; 

use App\Models\PostLost;
use App\Config\Database;

$postLost = new PostLost();
$lostItems = $postLost->getLostItems();

$database = new Database();
$pdo = $database->connect();
include "../layout/student.php"; 

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["claim_item"])) {
    global $pdo;

    $item_id = $_POST['item_id'] ?? null;
    $user_id = $_SESSION['user_id'] ?? null; 
    $location = $_POST['location'] ?? null;
    $image = $_POST['image_name'] ?? null;
    $time_lost = $_POST['time_lost'] ?? null;
    $marks = $_POST['marks'] ?? null;
    $details = $_POST['details'] ?? null;

    // Validate that required fields are not empty
    if (!$item_id || !$user_id || !$location || !$time_lost || !$marks || !$details) {
        echo "<script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Please fill in all required fields.',
                    icon: 'error'
                });
              </script>";
        exit; // Stop execution if validation fails
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO claims (item_id, user_id, image_name, location, time_lost, marks, details, status) 
                               VALUES (?, ?, ?, ?, ?, ?, ?, 'Pending')");
        $stmt->execute([$item_id, $user_id, $image, $location, $time_lost, $marks, $details]);

        echo "<script>
                Swal.fire({
                    title: 'Claim Submitted!',
                    text: 'Your claim is pending approval.',
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
    <h1 class="text-3xl font-semibold text-center text-purple-900">Lost Items</h1>
    
    <div class="grid md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-6 mt-6">
        <?php if (!empty($lostItems)) : ?>
            <?php foreach ($lostItems as $item) : ?>
                <div class="bg-white shadow-lg rounded-lg p-4">
                    <img src="/uploads/<?php echo htmlspecialchars($item['image_name']); ?>" 
                         alt="<?php echo htmlspecialchars($item['title']); ?>" 
                         class="w-full h-40 object-cover rounded-md">
                    <h2 class="text-xl font-semibold mt-3">Name: <?php echo htmlspecialchars($item['title']); ?></h2>
                    <p class="text-gray-600 mt-1">Description: <?php echo htmlspecialchars($item['description']); ?></p>
                    
                    <!-- Claim Button -->
                    <button onclick="openClaimModal(<?php echo $item['id']; ?>, '<?php echo $item['image_name']; ?>')"
                            class="mt-3 w-full bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700">
                        Claim
                    </button>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p class="text-center text-gray-600">No lost items reported yet.</p>
        <?php endif; ?>
    </div>
</div>

<!-- Claim Modal -->
<div id="claimModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg w-96">
        <h2 class="text-xl font-semibold mb-4">Claim Verification</h2>
        <form id="claimForm" method="POST">
            <input type="hidden" id="item_id" name="item_id">
            <input type="hidden" id="image_name" name="image_name">
            
            <label class="block mb-2">Where did you lose it?</label>
            <input type="text" name="location" required class="w-full p-2 border rounded mb-3">

            <label class="block mb-2">What time did you lose it?</label>
            <input type="text" name="time_lost" required class="w-full p-2 border rounded mb-3">

            <label class="block mb-2">Any identifying marks?</label>
            <input type="text" name="marks" required class="w-full p-2 border rounded mb-3">

            <label class="block mb-2">Additional details about the item:</label>
            <textarea name="details" required class="w-full p-2 border rounded mb-3"></textarea>

            <button type="submit" name="claim_item" class="bg-blue-600 text-white w-full py-2 rounded hover:bg-blue-700">
                Submit Claim
            </button>
            <button type="button" onclick="closeClaimModal()" class="w-full mt-2 py-2 text-gray-600 border rounded">
                Cancel
            </button>
        </form>
    </div>
</div>

<!-- SweetAlert & JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function openClaimModal(itemId, imageName) {
        document.getElementById("item_id").value = itemId;
        document.getElementById("image_name").value = imageName; // Assign the image name dynamically
        document.getElementById("claimModal").classList.remove("hidden");
    }

    function closeClaimModal() {
        document.getElementById("claimModal").classList.add("hidden");
    }
</script>
