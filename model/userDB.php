<?php

class UserDB
{
    private $db;

    public function __construct($database)
    {
        $this->db = $database;
    }

    /**
     * Create the users table if it doesn't exist
     */
    public function createUsersTable()
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                firstname VARCHAR(100) NOT NULL,
                lastname VARCHAR(100) NOT NULL,
                email VARCHAR(255) NOT NULL UNIQUE,
                phone VARCHAR(20) NOT NULL,
                password VARCHAR(255) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ";

        try {
            $this->db->exec($sql);
            return true;
        } catch (PDOException $e) {
            throw new Exception("Error creating users table: " . $e->getMessage());
        }
    }

    /**
     * Register a new user
     */
    public function register($firstname, $lastname, $email, $phone, $password)
    {
        // Validate inputs
        if (empty($firstname) || empty($lastname) || empty($email) || empty($phone) || empty($password)) {
            throw new Exception("Tous les champs sont requis");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Format email invalide");
        }

        if (!preg_match('/^[+]?[0-9]{9,15}$/', str_replace(' ', '', $phone))) {
            throw new Exception("Format téléphone invalide");
        }

        if (strlen($password) < 6) {
            throw new Exception("Le mot de passe doit contenir au moins 6 caractères");
        }

        $check = $this->db->prepare("SELECT id FROM users WHERE email = ?");
        $check->execute([$email]);

        if ($check->rowCount() > 0) {
            throw new Exception("Cet email est déjà utilisé");
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO users (firstname, lastname, email, phone, password) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);

        try {
            $stmt->execute([$firstname, $lastname, $email, $phone, $hashedPassword]);
            return true;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de l'enregistrement: " . $e->getMessage());
        }
    }

    public function login($email, $password)
    {
        if (empty($email) || empty($password)) {
            throw new Exception("Email et mot de passe requis");
        }

        $sql = "SELECT id, firstname, lastname, email, phone, password FROM users WHERE email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email]);

        if ($stmt->rowCount() === 0) {
            throw new Exception("Email ou mot de passe incorrect");
        }

        $user = $stmt->fetch();

        if (!password_verify($password, $user['password'])) {
            throw new Exception("Email ou mot de passe incorrect");
        }

        return $user;
    }

    public function getUserById($id)
    {
        $sql = "SELECT id, firstname, lastname, email, phone FROM users WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch();
    }
}
