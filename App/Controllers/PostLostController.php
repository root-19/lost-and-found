<?php
namespace App\Controllers;

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Models\PostLost;

class PostLostController {
    public function postLostItem() {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
            $title = $_POST['title'] ?? ''; 
            $description = $_POST['description'] ?? '';

            $targetDir = __DIR__ . '/../../uploads/';
            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            $imageName = basename($_FILES["image"]["name"]);
            $imagePath = "uploads/" . $imageName;

            if (move_uploaded_file($_FILES["image"]["tmp_name"], __DIR__ . "/../../" . $imagePath)) {
                $postLost = new PostLost();
                $saved = $postLost->saveLostItem($title, $description, $imageName, $imagePath);

                if ($saved) {
                    echo json_encode(["status" => "success"]);
                    exit();
                } else {
                    echo json_encode(["status" => "error", "message" => "Database error"]);
                    exit();
                }
            } else {
                echo json_encode(["status" => "error", "message" => "Image upload failed"]);
                exit();
            }
        }
    }
}


$controller = new PostLostController();
$controller->postLostItem();
