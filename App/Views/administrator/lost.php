<?php
require_once __DIR__ . '/../.../../../../vendor/autoload.php';
require_once __DIR__ . '/../../Models/UserModel.php';


use App\Models\PostLost;

$postLost = new PostLost();
$lostItems = $postLost->getLostItems();
include "../layout/administrator.php"; 
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
                        <h2 class="text-xl font-semibold mt-3">name: <?php echo htmlspecialchars($item['title']); ?></h2>
                        <p class="text-gray-600 mt-1">Description: <?php echo htmlspecialchars($item['description']); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p class="text-center text-gray-600">No lost items reported yet.</p>
            <?php endif; ?>
        </div>
    </div>

</body>
</html> 