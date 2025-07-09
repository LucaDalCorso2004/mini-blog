<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php
require_once 'includes/db.php';
  try {
        $stmt = $conn->prepare("SELECT title, content, created_at FROM posts");
    $stmt->execute();  // Wichtig: Ausführen!

    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<table border='1'>";
    echo "<tr><th>Titel</th><th>Inhalt</th><th>Erstellt am</th></tr>";

    foreach ($comments as $row) {
        echo "<tr>
                <td>{$row['title']}</td>
                <td>{$row['content']}</td>
                <td>{$row['created_at']}</td>
              </tr>";
    }
   } catch (PDOException $e) {
        echo "Fehler: " . $e->getMessage();
    }
  


?>




</body>
</html>