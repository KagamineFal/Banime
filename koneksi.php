<?php
$servername = "localhost";
$username = "u417562747_KagamineFal";
$password = "Luna1410.";
$database = "u417562747_Banime";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";
?>