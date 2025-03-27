<?php
namespace App\Controllers;

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../Models/UserModel.php';

use App\Config\Database;
use App\Models\UserModel;

session_start();

class AuthController {
    private $user;

    public function __construct() {
        $db = new Database();
        $this->user = new UserModel($db->connect());
    }

    /**
     * Register a new user
     */
    public function register($firstName, $lastName, $email, $password) {
        $role = "student";  
        
        // Check if email already exists
        if ($this->user->findUserByEmail($email)) {
            return ["success" => false, "message" => "Email already registered."];
        }

        // Hash password before storing
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $result = $this->user->register($firstName, $lastName, $email, $hashedPassword, $role);
        
        return $result ? ["success" => true, "message" => "Registration successful!"] : ["success" => false, "message" => "Error registering user."];
    }

    /**
     * Login user
     */
    public function login($email, $password) {
        $user = $this->user->findUserByEmail($email);

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];
        $_SESSION['role'] = $user['role'];

        header("Location: " . ($user['role'] == "student" ? "../Views/student/dashboard.php" : "../Views/administrator/dashboard.php"));
        exit();
    }

    /**
     * Logout user
     */
    public function logout() {
        session_destroy();
        header("Location: ../Views/login.php");
        exit();
    }
}
