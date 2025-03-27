<?php
namespace App\Models;

require_once __DIR__ . '/../Config/Database.php';
use App\Config\Database;
use PDO;

class Found {
    private $pdo;

    public function __construct() {
        $database = new Database();
        $this->pdo = $database->connect();
    }

    // ✅ Get all approved (claimed) lost items with user details and image
    public function getFoundItems() {
        $sql = "
            SELECT li.*, li.image_name, c.created_at, u.id AS user_id, u.first_name, u.last_name 
            FROM lost_items li
            INNER JOIN claims c ON li.id = c.item_id
            INNER JOIN users u ON c.user_id = u.id
            WHERE c.status = 'Approved'
            ORDER BY c.created_at DESC
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>

