<?php
$servername = "localhost";
$username = "simcon";
$password = "AkKuBabsjIbSGv7zr!";
$dbname = "simcondb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
