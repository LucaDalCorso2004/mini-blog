

<?php
require_once 'includes/db.php';
$pdo = new PDO('mysql:host=localhost;dbname=mini_blog;charset=utf8', 'root', '');

$sql = file_get_contents('database.sql');

try {
    $pdo->exec($sql);
    echo "Datenbank wurde erfolgreich eingerichtet.";
} catch (PDOException $e) {
    echo "Fehler beim Import: " . $e->getMessage();
}
?>