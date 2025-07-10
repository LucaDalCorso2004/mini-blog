 <?php
require_once '../includes/db.php';// PDO-Verbindung


 function create($title, $content)
    {
 global $conn;       
        $date = date("Y/m/d H:i");
     

        try {
            $sql = "INSERT INTO posts (title, content, created_at)
                    VALUES (:title, :content, :created_at)";
            $stmt = $conn->prepare($sql);
            $result = $stmt->execute([
                ':title' => $title,
                ':content' => $content,
                ':created_at' => $date,
                
            ]);
            return $result;
        } catch (PDOException $e) {
            
            return false;
        }
    }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';

    if ($title && $content) {
        $success = create( $title, $content);
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