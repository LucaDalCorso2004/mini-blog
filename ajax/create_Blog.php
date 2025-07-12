<?php
require_once '../includes/db.php';

function createBlog($title, $content, $user_id)
{
    global $conn;       
    $date = date("Y-m-d H:i:s"); 

    try {
        $sql = "INSERT INTO posts (user_id, title, content, created_at)
                VALUES (:user_id, :title, :content, :created_at)";
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute([
            ':user_id' => $user_id,
            ':title' => $title,
            ':content' => $content,
            ':created_at' => $date,
        ]);
        return $result;
    } catch (PDOException $e) {
        echo "Fehler beim Einfügen: " . $e->getMessage();
        return false;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $title = $_POST['title'] ?? '';
$content = $_POST['content'] ?? '';
$user_id = $_POST['id'] ?? '';


var_dump($title, $content, $user_id);

if ($title && $content && $user_id) {
    $success = createBlog($title, $content, $user_id);
    if ($success) {
        echo "Post erfolgreich erstellt.";
    } else {
        echo "Fehler beim Erstellen des Posts.";
    }
} else {
    echo "Bitte alle Felder ausfüllen.";
}
}
?>
