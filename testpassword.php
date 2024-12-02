<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Kode pengujian
$inputPassword = "admin123"; // Password yang diinput
$hash = '$2y$10$QqsVhvXu55YM7LVTThFlkObT29R7OYbuWJAa0Mqo.qxQvk1GBkWey'; // Hash dari database

if (password_verify($inputPassword, $hash)) {
    echo "Password cocok!";
} else {
    echo "Password tidak cocok!";
}
?>
