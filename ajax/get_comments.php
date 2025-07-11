<?php
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['post_id'])) {
    $postId = (int) $_GET['post_id'];

    try {
        $stmt = $conn->prepare("SELECT name, content, created_at FROM comments WHERE post_id = :post_id ORDER BY created_at DESC");
        $stmt->execute([':post_id' => $postId]);
        $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

        header('Content-Type: application/json');
        echo json_encode($comments);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Fehler beim Abrufen der Kommentare.']);
    }
}
