<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../html/index.php#turno");
    exit();
}

$nombre             = trim($_POST["nombre"] ?? "");
$telefono           = trim($_POST["telefono"] ?? "");
$email              = trim($_POST["email"] ?? "");
$marcaMoto          = trim($_POST["marcaMoto"] ?? "");
$modeloMoto         = trim($_POST["modeloMoto"] ?? "");
$servicioSolicitado = trim($_POST["servicioSolicitado"] ?? "");
$fechaPreferida     = trim($_POST["fechaPreferida"] ?? "");
$comentarios        = trim($_POST["comentarios"] ?? "");

if ($nombre === "" || $telefono === "" || $marcaMoto === "" || $modeloMoto === "" || $servicioSolicitado === "") {
    echo "Faltan datos obligatorios. <a href='../html/index.php#turno'>Volver al formulario</a>";
    exit();
}

$createTurnos = "CREATE TABLE IF NOT EXISTS turnos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    telefono VARCHAR(50) NOT NULL,
    email VARCHAR(100),
    marca_moto VARCHAR(50) NOT NULL,
    modelo_moto VARCHAR(100) NOT NULL,
    servicio_solicitado VARCHAR(150) NOT NULL,
    fecha_preferida DATE NULL,
    comentarios TEXT,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
$conn->query($createTurnos);

$fechaPreferidaDb = $fechaPreferida !== "" ? $fechaPreferida : null;
$stmt = $conn->prepare("INSERT INTO turnos (nombre, telefono, email, marca_moto, modelo_moto, servicio_solicitado, fecha_preferida, comentarios) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", $nombre, $telefono, $email, $marcaMoto, $modeloMoto, $servicioSolicitado, $fechaPreferidaDb, $comentarios);

if ($stmt->execute()) {
    $stmt->close();
    $conn->close();
    echo "<!DOCTYPE html><html lang='es'><head><meta charset='UTF-8'><meta name='viewport' content='width=device-width, initial-scale=1.0'><title>Turno enviado</title><link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'></head><body class='bg-dark text-white d-flex align-items-center justify-content-center vh-100'><div class='text-center'><h1 class='mb-3'>Solicitud enviada correctamente</h1><p class='mb-4'>Gracias por solicitar tu turno. Nos pondremos en contacto para coordinarlo.</p><a class='btn btn-danger' href='../html/index.php'>Volver al sitio</a></div></body></html>";
    exit();
}

echo "Error al enviar la solicitud: " . $conn->error . " <a href='../html/index.php#turno'>Volver</a>";
$stmt->close();
$conn->close();
?>
