<?php
require_once '../includes/db.php';

function createComment($content, $postId)
{
    global $conn;

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $benutzername = $_SESSION['benutzername'] ?? 'Gast'; // Fallback falls nicht eingeloggt

    try {
        $stmt = $conn->prepare("
            INSERT INTO comments (post_id, name, content)
            VALUES (:post_id, :name, :content)
        ");

        return $stmt->execute([
            ':post_id' => $postId,
            ':name' => $benutzername,
            ':content' => $content
        ]);
    } catch (PDOException $e) {
        return false;
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $content = trim($_GET['q'] ?? '');
    $postId = (int) ($_GET['id'] ?? 0);

    if ($postId <= 0 || empty($content)) {
        http_response_code(400);
        echo "Ungültige Eingaben.";
        exit;
    }

    $success = createComment($content, $postId);

    if ($success) {
        echo "Kommentar erfolgreich gespeichert.";
    } else {
        http_response_code(500);
        echo "Fehler beim Speichern.";
    }
}
