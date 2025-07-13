
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Übersicht</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<header style="display: flex; justify-content: space-between; align-items: center; padding: 10px 20px; background-color: #1E3A8A; color: white;">
    <h1 style="margin: 0;">Mein Blog</h1>
    <form action="logout.php" method="post">
        <button type="submit" style="background-color: #EF4444;">Logout</button>
    </form>
</header>

<main style="text-align: center; padding: 20px;">
 
    <button onclick="window.location.href='post.php'">Neuer Beitrag</button>

    <div style="margin-top: 20px;">
        <label for="search" style="display: block; margin-bottom: 5px;">Suche:</label>
        <input type="text" id="search" placeholder="Beitragstitel eingeben..." onkeyup="searchBlog(this.value)">
    </div>

    <div id="txtHint" style="margin-top: 30px;"></div>

</main>

<footer>
    &copy; 2025 Mein Blog
</footer>

<script src="assets/scrpit.js"></script>
</body>
</html>
