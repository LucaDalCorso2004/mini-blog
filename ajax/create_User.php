<?php
require_once '../includes/db.php';

// Registrierung-Funktion
function registrieren($benutzername, $password)
{
    global $conn;
    $passwordhash = password_hash($password, PASSWORD_DEFAULT);

    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prüfen, ob Benutzername bereits existiert
        $stmt = $conn->prepare("SELECT benutzername FROM password_list WHERE benutzername = ?");
        $stmt->bindParam(1, $benutzername);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($row['benutzername'])) {
            // Benutzer registrieren
            $sql = "INSERT INTO password_list (benutzername, passwordhash) VALUES (:benutzer, :password)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':benutzer' => $benutzername,
                ':password' => $passwordhash,
            ]);
            return true;
        } else {
            // Benutzername existiert schon
            return false;
        }
    } catch (PDOException $e) {
        echo "Fehler: " . $e->getMessage();
        return false;
    }
}

// === Hier wird die Funktion aufgerufen ===
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'registrieren') {
    $benutzername = $_POST['benutzername'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($benutzername) && !empty($password)) {
        if (registrieren($benutzername, $password)) {
            echo 'registriert';
        } else {
            echo 'Benutzername existiert bereits!';
        }
    } else {
        echo 'Bitte alle Felder ausfüllen!';
    }
} else {
    echo 'Ungültige Anfrage';
}
