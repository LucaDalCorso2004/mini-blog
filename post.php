<?php
session_start();
$user_id = $_SESSION['user_id'] ?? null; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<input type="hidden" id="user_id" value="<?= htmlspecialchars($user_id) ?>">

Titel: <input type="text" id="title_<?= $user_id ?>" placeholder="Titel" required><br>
Content: <input type="text" id="content_<?= $user_id ?>" placeholder="Inhalt" required><br>

<button onclick="Blog(
    document.getElementById('title_<?= $user_id ?>').value,
    document.getElementById('content_<?= $user_id ?>').value,
    document.getElementById('user_id').value
)">Absenden</button>
<script src="assets/scrpit.js"></script>
</body>
</html>