<?php

class UserDB
{
    private $db;

    public function __construct($database)
    {
        $this->db = $database;
    }

    /**
     * Crée la table des rôles proprement
     */
    /**
     * Crée la table des rôles proprement
     */
    public function createRolesTable()
    {
        try {
            // FORCE la suppression de l'ancienne table mal configurée si elle existe
            $this->db->exec("SET FOREIGN_KEY_CHECKS = 0; DROP TABLE IF EXISTS role; SET FOREIGN_KEY_CHECKS = 1;");

            // Recréation propre de la table avec la colonne 'name'
            $sql = "
                CREATE TABLE IF NOT EXISTS role (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    name VARCHAR(100) NOT NULL UNIQUE,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
            ";
            $this->db->exec($sql);
            
            // Insertion des rôles par défaut
            $insertRoles = "INSERT IGNORE INTO role (id, name) VALUES (1, 'admin'), (2, 'user')";
            $this->db->exec($insertRoles);
            
            return true;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la création de la table role : " . $e->getMessage());
        }
    }

    /**
     * Crée la table des utilisateurs en totale conformité avec phpMyAdmin
     */
    public function createUsersTable()
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                nom VARCHAR(100) NOT NULL,
                email VARCHAR(255) NOT NULL UNIQUE,
                motDePasse VARCHAR(255) NOT NULL,
                telephone VARCHAR(20) NOT NULL,
                role_id INT DEFAULT 2,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                CONSTRAINT fk_role FOREIGN KEY (role_id) REFERENCES role(id) ON DELETE RESTRICT ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ";

        try {
            $this->db->exec($sql);
            return true;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la création de la table users : " . $e->getMessage());
        }
    }

    /**
     * Inscription d'un nouvel utilisateur
     */
    public function register($nom, $email, $telephone, $motDePasse, $role_id = 2)
    {
        if (empty($nom) || empty($email) || empty($telephone) || empty($motDePasse)) {
            throw new Exception("Tous les champs sont requis");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Format email invalide");
        }

        if (!preg_match('/^[+]?[0-9]{9,15}$/', str_replace(' ', '', $telephone))) {
            throw new Exception("Format téléphone invalide");
        }

        if (strlen($motDePasse) < 6) {
            throw new Exception("Le mot de passe doit contenir au moins 6 caractères");
        }

        // Vérification si l'email existe déjà
        $check = $this->db->prepare("SELECT id FROM users WHERE email = ?");
        $check->execute([$email]);

        if ($check->rowCount() > 0) {
            throw new Exception("Cet email est déjà utilisé");
        }

        // Hachage sécurisé du mot de passe
        $hashedmotDePasse = password_hash($motDePasse, PASSWORD_BCRYPT);

        // Requête SQL alignée avec les colonnes exactes de ton phpMyAdmin
        $sql = "INSERT INTO users (nom, email, telephone, motDePasse, role_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);

        try {
            $stmt->execute([$nom, $email, $telephone, $hashedmotDePasse, $role_id]);
            return true;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de l'enregistrement : " . $e->getMessage());
        }
    }

    /**
     * Connexion d'un utilisateur
     */
    public function login($email, $motDePasse)
    {
        if (empty($email) || empty($motDePasse)) {
            throw new Exception("Email et mot de passe requis");
        }

        $sql = "SELECT id, nom, email, telephone, role_id, motDePasse FROM users WHERE email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email]);

        if ($stmt->rowCount() === 0) {
            throw new Exception("Email ou mot de passe incorrect");
        }

        $user = $stmt->fetch();

        if (!password_verify($motDePasse, $user['motDePasse'])) {
            throw new Exception("Email ou mot de passe incorrect");
        }

        return $user;
    }

    /**
     * Récupérer un utilisateur par son ID
     */
    public function getUserById($id)
    {
        $sql = "SELECT id, nom, email, telephone, role_id FROM users WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch();
    }
}