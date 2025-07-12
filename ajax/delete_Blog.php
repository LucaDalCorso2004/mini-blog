<?php
require_once '../includes/db.php';
session_start();

$user_id = $_SESSION['user_id'] ?? null;
$postId = $_GET['id'] ?? null;

if (!$user_id || !$postId) {
    echo "Ungültige Anfrage.";
    exit;
}

$stmt = $conn->prepare("DELETE FROM posts WHERE id = :id AND user_id = :user_id");
$stmt->execute([
    ':id' => $postId,
    ':user_id' => $user_id
]);

if ($stmt->rowCount() > 0) {
    echo "Beitrag erfolgreich gelöscht";
} else {
    echo "Löschen fehlgeschlagen oder keine Berechtigung.";
}
?>
