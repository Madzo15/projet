<?php
session_start();

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../model/UserDB.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Méthode non autorisée']);
    exit;
}

$firstname = trim($_POST['prenom'] ?? '');
$lastname = trim($_POST['nom'] ?? '');
$email = trim($_POST['email'] ?? '');
$email_confirm = trim($_POST['email_confirm'] ?? '');
$phone = trim($_POST['telephone'] ?? '');
$password = trim($_POST['motDePasse'] ?? '');

try {
    $db = Database::getConnection();
    $userDB = new UserDB($db);

    $userDB->createUsersTable();

    if ($email !== $email_confirm) {
        throw new Exception("Les adresses email ne correspondent pas");
    }

    $userDB->register($firstname, $lastname, $email, $phone, $password);

    echo json_encode([
        'success' => true,
        'message' => 'Inscription réussie ! '
    ]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
