<?php
// session_start();

require_once __DIR__ . '/../../Models/Found.php';
require_once __DIR__ . '/../../Config/Database.php';

use App\Models\Found;

$found = new Found();
$foundItems = $found->getFoundItems();

include "../layout/administrator.php";
?>

<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold text-green-700 text-center">✅ Found & Claimed Items</h1>

    <div class="mt-6 bg-white shadow-md rounded-lg p-4">
        <?php if (!empty($foundItems)) : ?>
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-green-200">
                        <th class="border border-gray-300 px-4 py-2">Image</th>
                        <th class="border border-gray-300 px-4 py-2">Item Name</th>
                        <th class="border border-gray-300 px-4 py-2">Description</th>
                        <th class="border border-gray-300 px-4 py-2">Claimed By</th>
                        <th class="border border-gray-300 px-4 py-2">Claimed At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($foundItems as $item) : ?>
                        <tr class="text-center">
                            <td class="border border-gray-300 px-4 py-2">
                                <img src="/uploads/<?= htmlspecialchars($item['image_name']); ?>" 
                                     alt="Item Image" 
                                     class="w-24 h-24 object-cover rounded">
                            </td>
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($item['title']); ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($item['description']); ?></td>
                            <td class="border border-gray-300 px-4 py-2">
                                <?= htmlspecialchars($item['first_name'] . " " . $item['last_name']); ?> 
                                <!-- (ID: <?= htmlspecialchars($item['user_id']); ?>) -->
                            </td>
                            <td class="border border-gray-300 px-4 py-2"><?= date("F j, Y, g:i A", strtotime($item['created_at'])); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p class="text-gray-500 text-center">No found or claimed items yet.</p>
        <?php endif; ?>
    </div>
</div>
