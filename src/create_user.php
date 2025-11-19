<?php
require 'db_connect.php';

$username = 'jspelt';
$password_plano = '123456';
$nombre = 'Jose Spelt';

$hash = password_hash($password_plano, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO usuarios (username, password_hash, nombre_completo) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $hash, $nombre);

if ($stmt->execute()) {
    echo "Usuario creado correctamente. Usuario: jspelt, contraseña: 123456";
} else {
    echo "Error: " . $stmt->error;
}
