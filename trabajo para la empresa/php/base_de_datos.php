<?php
include("conexion.php");

$createUsuarios = "CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    `contraseña` VARCHAR(100) NOT NULL,
    clase VARCHAR(20) NOT NULL DEFAULT 'usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

$createStock = "CREATE TABLE IF NOT EXISTS stock (
    id INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(255) NOT NULL,
    Valor INT NOT NULL,
    img VARCHAR(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

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

$conn->query($createUsuarios);
$conn->query($createStock);
$conn->query($createTurnos);


$adminUser = 'ADMIN';
$adminPass = 's0yElA5m!';
$adminClase = 'admin';
$stmt = $conn->prepare("SELECT id FROM usuarios WHERE usuario = ?");
$stmt->bind_param("s", $adminUser);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows === 0) {
    $stmt->close();
    $ins = $conn->prepare("INSERT INTO usuarios (usuario, `contraseña`, clase) VALUES (?, ?, ?)");
    $ins->bind_param("sss", $adminUser, $adminPass, $adminClase);
    $ins->execute();
    $ins->close();
} else {
    $stmt->close();
}


$productos = [
    ['Aceite Castrol Actevo 4T 20W-50', 18000],
    ['Aceite Motul 5100 4T. Semisintético de 1 litro', 35000],
    ['Aceite para motor 2 tiempos Yamalube. Envase de 1 litro, para motores 2T', 15000],
    ['Bujía NGK C7HSA', 8000],
    ['Filtro de aceite para moto', 14000],
    ['Lubricante para cadena de moto', 25000],
    ['Grasa lubricante para cadena Penetrit', 10000],
    ['Limpiador de cadena para moto. Desengrasante en aerosol para quitar residuos antes de lubricar', 15000],
    ['Líquido de frenos DOT 4', 18000],
    ['Pastillas de freno para moto', 30000],
    ['Filtro de nafta universal', 5000],
    ['Cámara de aire para moto rodado 18', 13000],
];

$res = $conn->query("SELECT COUNT(*) AS c FROM stock");
$row = $res ? $res->fetch_assoc() : ['c' => 0];
if (intval($row['c']) === 0) {
    $insP = $conn->prepare("INSERT INTO stock (Nombre, Valor, img) VALUES (?, ?, '')");
    foreach ($productos as $p) {
        $nombre = $p[0];
        $valor = $p[1];
        $insP->bind_param("si", $nombre, $valor);
        $insP->execute();
    }
    $insP->close();
}

$conn->close();
echo "Base de datos inicializada correctamente en zampedribs.";
?>
