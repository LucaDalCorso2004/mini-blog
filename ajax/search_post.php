<?php
require_once '../includes/db.php'; 
session_start();
$user_id = $_SESSION['user_id'] ?? null; 
function search($title)
{
    global $conn;

    try {
        $stmt = $conn->prepare("SELECT id, user_id,title, content, created_at FROM posts WHERE title LIKE :title");
        $like = "%" . $title . "%";
        $stmt->execute([':title' => $like]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    } catch (PDOException $e) {
        return false;
    }
}

function all(){
try {
      global $conn;
        $stmt = $conn->prepare("SELECT id, user_id,title, content, created_at FROM posts");
    $stmt->execute();  

    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

return $comments;
   } catch (PDOException $e) {
        echo "Fehler: " . $e->getMessage();
    }
  
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $title = $_GET['q'] ?? ''; 

if (trim($title) === '') {
 
    $results = all();
} else {
   
    $results = search($title);
}

        if ($results !== false && count($results) > 0) {
         
            foreach ($results as $row) {
           $postId = $row['id'];




echo "<div class='post' id='post_$postId'>";
if ($user_id == $row['user_id']) {
   echo "<button onclick=\"deleteBlog($postId)\">Löschen</button>";

    echo "<input type='text' id='edit_title_$postId' value='" . htmlspecialchars($row['title'], ENT_QUOTES) . "'>";
    echo "<textarea id='edit_content_$postId'>" . htmlspecialchars($row['content'], ENT_QUOTES) . "</textarea>";
 echo "<button onclick=\"updateBlog(
    document.getElementById('edit_title_$postId').value,
    document.getElementById('edit_content_$postId').value,
    $postId
)\">Speichern</button>";
} else {
 
    echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
    echo "<p>" . htmlspecialchars($row['content']) . "</p>";
}

echo "<small>" . htmlspecialchars($row['created_at']) . "</small>";
echo "<br>";


echo "<input type='text' id='kom_$postId' name='kom' placeholder='Antwort'>";
echo "<button onclick=\"komant(document.getElementById('kom_$postId').value, $postId)\">Absenden</button>";
echo "<button onclick=\"viewkomant('', $postId)\">Kommentare anzeigen</button>";

echo "<div id='comments_$postId'></div>";
echo "</div>";


            }
        } else {
            echo "Keine Ergebnisse gefunden.";
        }
    } else {
        echo "Suchbegriff fehlt.";
    }

?>
