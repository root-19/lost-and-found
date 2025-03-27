<?php
include "../layout/administrator.php"; 

require_once __DIR__ . '/../../Config/Database.php';

use App\Config\Database;

$database = new Database();
$pdo = $database->connect();

// ✅ Fetch Total Users
$usersQuery = "SELECT COUNT(id) AS total_users FROM users";
$stmt = $pdo->prepare($usersQuery);
$stmt->execute();
$totalUsers = $stmt->fetch(PDO::FETCH_ASSOC)['total_users'] ?? 0;

// ✅ Fetch Total Lost Items
$lostItemsQuery = "SELECT COUNT(id) AS total_lost FROM lost_items";
$stmt = $pdo->prepare($lostItemsQuery);
$stmt->execute();
$totalLost = $stmt->fetch(PDO::FETCH_ASSOC)['total_lost'] ?? 0;

// ✅ Fetch Total Claimed Items
$claimedQuery = "SELECT COUNT(id) AS total_claimed FROM claims WHERE status = 'Approved'";
$stmt = $pdo->prepare($claimedQuery);
$stmt->execute();
$totalClaimed = $stmt->fetch(PDO::FETCH_ASSOC)['total_claimed'] ?? 0;

// ✅ Fetch Pending Claims
$pendingQuery = "SELECT COUNT(id) AS total_pending FROM claims WHERE status = 'Pending'";
$stmt = $pdo->prepare($pendingQuery);
$stmt->execute();
$totalPending = $stmt->fetch(PDO::FETCH_ASSOC)['total_pending'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Donut Chart - Claimed Items
            var claimedCtx = document.getElementById('claimedChart').getContext('2d');
            new Chart(claimedCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Claimed Items'],
                    datasets: [{
                        data: [<?= $totalClaimed ?>],
                        backgroundColor: ['rgba(75, 192, 192, 0.5)'],
                        borderColor: ['rgba(75, 192, 192, 1)'],
                        borderWidth: 1
                    }]
                },
                options: {
                    maintainAspectRatio: false
                }
            });
        });
    </script>
</head>
<body class="bg-gray-100">
    <h1 class="text-2xl font-bold text-center my-4">Dashboard</h1>
    
    <!-- ✅ Statistic Boxes -->
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-blue-500 text-white p-6 rounded-lg shadow-md text-center">
                <h2 class="text-2xl font-semibold">👥 <?= $totalUsers ?></h2>
                <p>Total Users</p>
            </div>
            <div class="bg-red-500 text-white p-6 rounded-lg shadow-md text-center">
                <h2 class="text-2xl font-semibold">📦 <?= $totalLost ?></h2>
                <p>Total Lost Items</p>
            </div>
            <div class="bg-green-500 text-white p-6 rounded-lg shadow-md text-center">
                <h2 class="text-2xl font-semibold">✅ <?= $totalClaimed ?></h2>
                <p>Total Claimed Items</p>
            </div>
            <div class="bg-yellow-500 text-white p-6 rounded-lg shadow-md text-center">
                <h2 class="text-2xl font-semibold">⏳ <?= $totalPending ?></h2>
                <p>Pending Claims</p>
            </div>
        </div>

        <!-- Donut Chart: Total Claimed Items -->
        <!-- <div class="bg-white shadow-md p-4 rounded-lg mt-6">
            <h2 class="text-lg font-semibold text-center mb-2">Total Claimed Items</h2>
            <div class="chart-container">
                <canvas id="claimedChart"></canvas>
            </div>
        </div> -->
    </div>
</body>
</html>
