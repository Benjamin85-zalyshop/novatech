<?php
$host = 'localhost';
$dbname = 'novatech_store';
$username = 'root';
$password = '';

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die('Erreur de connexion : ' . $conn->connect_error);
}
$conn->set_charset('utf8mb4');
?>
