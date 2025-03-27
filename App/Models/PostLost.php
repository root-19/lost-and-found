<?php
namespace App\Models;

use PDO;
use App\Config\Database;

class PostLost {
    private $conn;
    private $table = "lost_items";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function saveLostItem($title, $description, $imageName, $imagePath) {
        try {
            $query = "INSERT INTO " . $this->table . " (title, description, image_name, image_path) VALUES (:title, :description, :image_name, :image_path)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':image_name', $imageName);
            $stmt->bindParam(':image_path', $imagePath);
            return $stmt->execute();
        } catch (\PDOException $e) {
            die("Database Error: " . $e->getMessage());
        }
    }

    public function getLostItems() {
        $sql = "
            SELECT * FROM lost_items 
            WHERE id NOT IN (
                SELECT item_id FROM claims WHERE status = 'Approved'
            )
        ";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
