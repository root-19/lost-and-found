<?php
namespace App\Config;

require_once __DIR__ . '/../../vendor/autoload.php';

use PDO;
use PDOException;
use Dotenv\Dotenv;

class Database {
    private $conn;

    public function __construct() {
        // Load .env from the ROOT directory
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../'); 
        $dotenv->load();
    }

    public function connect() {
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_NAME'], 
                $_ENV['DB_USER'], 
                $_ENV['DB_PASS']
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection Error: " . $e->getMessage());
        }
        return $this->conn;
    }
}
