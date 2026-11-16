<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../html/registro.html");
    exit();
}

$usuario  = trim($_POST["txtusuario"] ?? "");
$password = trim($_POST["txtpassword"] ?? "");

if ($usuario === "" || $password === "") {
    header("Location: ../html/registro.html");
    exit();
}

$check = $conn->prepare("SELECT id FROM usuarios WHERE usuario = ?");
$check->bind_param("s", $usuario);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    $check->close();
    $conn->close();
    header("Location: ../html/registro.html?error=existe");
    exit();
}
$check->close();

$clase = 'usuario';
$stmt = $conn->prepare("INSERT INTO usuarios (usuario, `contraseña`, clase) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $usuario, $password, $clase);

if ($stmt->execute()) {
    $stmt->close();
    $conn->close();
    header("Location: ../html/login.html?registrado=1");
    exit();
}

$stmt->close();
$conn->close();
header("Location: ../html/registro.html?error=1");
exit();
?>
