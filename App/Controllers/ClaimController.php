<?php
namespace App\Controllers;

use App\Models\ClaimModel;
use PDO;

class ClaimController {
    private $claimModel;

    public function __construct($pdo) {
        $this->claimModel = new ClaimModel($pdo);
    }

    public function handleClaimSubmission() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            if (!isset($_SESSION['user_id'])) {
                echo json_encode(['success' => false, 'message' => 'User not logged in.']);
                return;
            }

            $item_id = $_POST['item_id'] ?? null;
            $image_name = $_POST['image_name'] ?? null;
            $location = $_POST['location'] ?? null;
            $time_lost = $_POST['time_lost'] ?? null;
            $marks = $_POST['marks'] ?? null;
            $details = $_POST['details'] ?? null;
            $user_id = $_SESSION['user_id'];

            if ($item_id && $location && $time_lost && $marks && $details) {
                $success = $this->claimModel->submitClaim($item_id, $image_name, $location, $time_lost, $marks, $details, $user_id);
                echo json_encode(['success' => $success]);
            } else {
                echo json_encode(['success' => false, 'message' => 'All fields are required.']);
            }
        }
    }
}
?>
