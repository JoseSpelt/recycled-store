<?php
$DB_HOST = 'db';
$DB_NAME = 'recycled_store';
$DB_USER = 'recycled_user';
$DB_PASS = 'pass123'; // coincide con .env (edítalo si cambiaste)

$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if ($conn->connect_error) {
    die("DB connection failed: " . $conn->connect_error);
}
