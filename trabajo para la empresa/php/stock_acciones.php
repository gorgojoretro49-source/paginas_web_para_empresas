<?php
session_start();
include("conexion.php");

if (!isset($_SESSION['clase']) || $_SESSION['clase'] !== 'admin') {
    header("Location: ../html/login.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accion = $_POST["accion"] ?? "";

    if ($accion === "agregar") {
        $nombre = trim($_POST["nombre"] ?? "");
        $valor  = trim($_POST["valor"] ?? "");
        if ($nombre !== "" && $valor !== "") {
            $stmt = $conn->prepare("INSERT INTO stock (Nombre, Valor, img) VALUES (?, ?, '')");
            $stmt->bind_param("si", $nombre, $valor);
            $stmt->execute();
            $stmt->close();
        }
    } elseif ($accion === "editar") {
        $id     = intval($_POST["id"] ?? 0);
        $nombre = trim($_POST["nombre"] ?? "");
        $valor  = trim($_POST["valor"] ?? "");
        if ($id > 0 && $nombre !== "" && $valor !== "") {
            $stmt = $conn->prepare("UPDATE stock SET Nombre = ?, Valor = ? WHERE id = ?");
            $stmt->bind_param("sii", $nombre, $valor, $id);
            $stmt->execute();
            $stmt->close();
        }
    } elseif ($accion === "eliminar") {
        $id = intval($_POST["id"] ?? 0);
        if ($id > 0) {
            $stmt = $conn->prepare("DELETE FROM stock WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
        }
    }
}

$conn->close();
header("Location: ../html/index.php#precios");
exit();
?>

