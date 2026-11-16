<?php
$server = "localhost";
$user   = "root";
$pass   = "";
$db     = "zampedribs";

$conn = new mysqli($server, $user, $pass, $db);
$conn->set_charset("utf8mb4");

if ($conn->connect_errno) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
