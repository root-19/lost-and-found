<?php
namespace App\Models;

use PDO;
use PDOException;

class ClaimModel {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    public function submitClaim($item_id, $image_name, $location, $time_lost, $marks, $details, $user_id) {
        try {
            $query = "INSERT INTO claims (item_id, image_name, user_id, location, time_lost, marks, details, status, created_at) 
                      VALUES (:item_id, :image_name, :user_id, :location, :time_lost, :marks, :details, 'Pending', NOW())";
            $stmt = $this->db->prepare($query);
            $stmt->execute([
                ':item_id' => $item_id,
                ':image_name' => $image_name,
                ':user_id' => $user_id,
                ':location' => $location,
                ':time_lost' => $time_lost,
                ':marks' => $marks,
                ':details' => $details
            ]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>
