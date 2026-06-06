<?php
session_start();

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../model/UserDB.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Méthode non autorisée']);
    exit;
}

$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');

try {
    $db = Database::getConnection();
    $userDB = new UserDB($db);

    $user = $userDB->login($email, $password);

    $_SESSION['id'] = $user['id'];
    $_SESSION['nom'] = $user['nom'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['phone'] = $user['telephone'];
    $_SESSION['role_id'] = $user['role_id'];
    $_SESSION['logged_in'] = true;

    echo json_encode([
        'success' => true,
        'message' => 'Connexion réussie !',
        'redirect' => 'admin.php'
    ]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
