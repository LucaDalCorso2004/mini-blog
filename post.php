<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
$user_id = $_SESSION['user_id'] ?? null; 



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="assets/style.css">
    <title>Document</title>
</head>
<body>
 <header style="display: flex; justify-content: space-between; align-items: center; padding: 10px 20px; background-color: #1E3A8A; color: white;">
    <h1 style="margin: 0;">Create</h1>
    <form action="logout.php" method="post">
        <button type="submit" style="background-color: #EF4444;">Logout</button>
    </form>
</header>
<input type="hidden" id="user_id" value="<?= htmlspecialchars($user_id) ?>">

Titel: <input type="text" id="title_<?= $user_id ?>" placeholder="Titel" required><br>
Content: <input type="text" id="content_<?= $user_id ?>" placeholder="Inhalt" required><br>

<button onclick="Blog(
    document.getElementById('title_<?= $user_id ?>').value,
    document.getElementById('content_<?= $user_id ?>').value,
    document.getElementById('user_id').value
)">Absenden</button>
<script src="assets/scrpit.js"></script>
<footer>
    &copy; 2025 Mein Blog
</footer>
</body>
</html>