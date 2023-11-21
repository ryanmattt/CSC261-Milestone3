<?php
$servername = "localhost";
$username = "phpmyadmin";
$password = "k8Agop8XNjy9iAqolPr!";
$dbname = "simcondb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
