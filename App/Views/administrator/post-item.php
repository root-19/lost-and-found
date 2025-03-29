<?php
require_once __DIR__ . '../../../../vendor/autoload.php';
require_once __DIR__ . '../../../Controllers/PostlostController.php';


use App\Models\PostLost;
use App\Controllers\PostLostController;

$postLost = new PostLost();
$controller = new PostLostController();
$lostItems = $postLost->getLostItems();

include "../layout/administrator.php"; 
?>

<div class="max-w-2xl mx-auto p-6">
    <h2 class="text-xl font-bold mb-4">Post a Lost Item</h2>
    <form id="postLostForm" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Title" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 mb-5" required> 
        <textarea name="description" placeholder="Description" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 mb-5" required></textarea>
        <input type="file" name="image" class="w-full p-2 border rounded mb-5" required>
        <button type="submit" class="w-full bg-gradient-to-br from-gray-900 to-blue-800 text-white py-2 rounded-lg hover:bg-blue-600 transition">Post Item</button>
    </form>
</div>

<!-- ✅ Include SweetAlert and jQuery -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function(){
    $("#postLostForm").submit(function(e){
        e.preventDefault(); 

        let formData = new FormData(this); 
        $.ajax({
            url: "../../Controllers/PostLostController.php", // ✅ Send to controller
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response){
                Swal.fire({
                    title: 'Success!',
                    text: 'Lost item posted successfully.',
                    icon: 'success'
                }).then(() => {
                    location.reload();
                });
            },
            error: function(){
                Swal.fire("Error", "Something went wrong!", "error");
            }
        });
    });
});
</script>

<!-- <div class="max-w-lg mx-auto mt-6">
    <h2 class="text-xl font-bold mb-4">Lost Items</h2>

    <?php if (!empty($lostItems)): ?> 
        <?php foreach ($lostItems as $item): ?>
            <div class="bg-white p-4 rounded-lg shadow-md mb-4">
                <h3 class="text-lg font-semibold"><?= htmlspecialchars($item['title']) ?></h3>
                <p class="text-gray-600"><?= htmlspecialchars($item['description']) ?></p>
                <img src="/uploads/<?php htmlspecialchars($item['image_path']) ?>" alt="<?= htmlspecialchars($item['title']) ?>" class="mt-2 w-full h-48 object-cover rounded">
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-gray-600">No lost items found.</p> 
    <?php endif; ?>
</div> -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
