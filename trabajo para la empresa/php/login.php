<?php
session_start();
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../html/login.html");
    exit();
}

$usuario  = trim($_POST["txtusuario"] ?? "");
$password = trim($_POST["txtpassword"] ?? "");

if ($usuario === "" || $password === "") {
    header("Location: ../html/login.html?error=1");
    exit();
}

$stmt = $conn->prepare("SELECT id, usuario, clase FROM usuarios WHERE usuario = ? AND `contraseña` = ?");
$stmt->bind_param("ss", $usuario, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows === 1) {
    $fila = $result->fetch_assoc();
    $_SESSION['id']      = $fila['id'];
    $_SESSION['usuario'] = $fila['usuario'];
    $_SESSION['clase']   = $fila['clase'];
    $stmt->close();
    $conn->close();
    header("Location: ../html/index.php");
    exit();
}

$stmt->close();
$conn->close();
header("Location: ../html/login.html?error=1");
exit();
?>
