<?php
session_start();
session_unset();
session_destroy();
header("Location: login.php"); // Oder index.php, je nachdem wohin du zurück willst
exit;
?>