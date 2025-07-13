<?php
require_once '../includes/db.php';


function login($benutzername, $password)
{  
    global $conn;
    try {
       $stmt = $conn->prepare("SELECT id, passwordhash FROM password_list WHERE benutzername = ?");
       $stmt->bindParam(1, $benutzername);
       $stmt->execute();

       $row = $stmt->fetch(PDO::FETCH_ASSOC);

       if ($row && password_verify($password, $row['passwordhash'])) {
           
           if (session_status() == PHP_SESSION_NONE) {
               session_start();
           }

           $_SESSION['user_id'] = $row['id']; 
           $_SESSION['benutzername'] = $benutzername;
      
           return true;
       } else {
       
           return false;
       }
    }
    catch(PDOException $e) {
      
        return false;
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'login') {
    $benutzername = $_POST['benutzername'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($benutzername) && !empty($password)) {
        if (login($benutzername, $password)) {
            echo 'login';
        } else {
            echo 'Benutzername oder Passwort ist falsch!';
        }
    } else {
        echo 'Bitte alle Felder ausfüllen!';
    }
} else {
    echo 'Ungültige Anfrage';
}

?>


