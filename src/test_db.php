<?php
require 'db_connect.php';

echo "<h2>✔ Conexión exitosa a MySQL</h2>";

$res = $conn->query("SELECT DATABASE() AS db");
$row = $res->fetch_assoc();

echo "<p><strong>Base de datos usada:</strong> " . $row['db'] . "</p>";

echo "<h3>Tablas existentes:</h3>";
$res2 = $conn->query("SHOW TABLES");
while ($t = $res2->fetch_array()) {
    echo "• " . $t[0] . "<br>";
}
