<?php
$servername = "mariadb";
$username = "mariadb";
$password = "mariadb";
$dbname = "mariadb";

try {
    $conn = new PDO('mysql:host=mariadb;dbname=mariadb', $username, $password);
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
}
?>
