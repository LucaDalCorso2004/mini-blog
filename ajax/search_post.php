<?php
require_once '../includes/db.php'; // PDO-Verbindung

function search($title)
{
    global $conn;

    try {
        $stmt = $conn->prepare("SELECT title, content, created_at FROM posts WHERE title LIKE :title");
        $like = "%" . $title . "%";
        $stmt->execute([':title' => $like]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // ← richtige Rückgabe
    } catch (PDOException $e) {
        return false;
    }
}

function all(){
try {
      global $conn;
        $stmt = $conn->prepare("SELECT title, content, created_at FROM posts");
    $stmt->execute();  

    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

return $comments;
   } catch (PDOException $e) {
        echo "Fehler: " . $e->getMessage();
    }
  
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $title = $_GET['q'] ?? ''; 

  var_dump($title);

if (trim($title) === '') {
    // Noch kein Suchbegriff eingegeben → zeige alle Posts
    $results = all();
} else {
    // Suchbegriff vorhanden → suche gezielt
    $results = search($title);
}
      var_dump($results);
        if ($results !== false && count($results) > 0) {
         
            foreach ($results as $row) {
                echo "<div>";
                echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
                echo "<p>" . htmlspecialchars($row['content']) . "</p>";
                echo "<small>" . htmlspecialchars($row['created_at']) . "</small>";
                echo "</div><hr>";
            }
        } else {
            echo "Keine Ergebnisse gefunden.";
        }
    } else {
        echo "Suchbegriff fehlt.";
    }

?>
