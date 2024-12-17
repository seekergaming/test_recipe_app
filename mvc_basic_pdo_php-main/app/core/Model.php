<?php
namespace App\Core;

use PDO;
use PDOException;

class Model
{
    protected $db;

    public function __construct()
    {
        try {
            $this->db = new PDO(
                "mysql:host=localhost;dbname=pdo_crud;charset=utf8", // Update this with your actual DB credentials
                "root", // Your database username
                "admin123",     // Your database password
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]
            );
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->db;
    }
}
