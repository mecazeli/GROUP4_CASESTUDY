<?php
$servername = "localhost";
$username = "root";
$password = "";  // Change if necessary
$database = "MetroMedClinic";
$port = 3307;

$conn = new mysqli($servername, $username, $password, $database, $port);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>