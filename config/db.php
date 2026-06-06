<?php
class Database {
    private static $connection = null;

    public static function getConnection() {
        if (self::$connection === null) {
            try {
                $host = 'localhost';
                $dbname = 'projet';
                $username = 'root';
                $password = '';
                
                self::$connection = new PDO(
                    "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
                    $username,
                    $password,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]
                );
            } catch (PDOException $e) {
                // Au lieu de couper avec die(), on renvoie un joli JSON lisible par le JavaScript
                header('Content-Type: application/json');
                echo json_encode([
                    'success' => false,
                    'message' => "Problème de connexion BDD : " . $e->getMessage()
                ]);
                exit;
            }
        }
        return self::$connection;
    }
}