<?php
require_once '../includes/db.php';

function updateBlog($title, $content, $post_id)
{
    global $conn;

    try {
     
        $sql = "UPDATE posts SET title = :title, content = :content WHERE id = :id ";
        $stmt = $conn->prepare($sql);

        $result = $stmt->execute([
            ':title' => $title,
            ':content' => $content,
            ':id' => $post_id,
          
        ]);

        return $result;
    } catch (PDOException $e) {
        echo "Fehler beim Aktualisieren: " . $e->getMessage();
        return false;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';
    $post_id = $_POST['id'] ?? '';
   

    if ($title && $content && $post_id ) {
        $success = updateBlog($title, $content, $post_id);
        if ($success) {
            echo "Post erfolgreich aktualisiert.";
        } else {
            echo "Fehler beim Aktualisieren des Posts.";
        }
    } else {
        echo "Bitte alle Felder ausfüllen und angemeldet sein.";
    }
}
?>
