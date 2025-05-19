<?php
$host = "localhost";
$user = "root";
$pass = ""; // Default password for XAMPP
$db = "dream_gallery";

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
