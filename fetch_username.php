<?php
session_start();

// Periksa apakah admin sudah login
if (!isset($_SESSION['username'])) {
    header("Location: loginadmin.php");
    exit();
}

// Tampilkan username
echo htmlspecialchars($_SESSION['username']);
?>
