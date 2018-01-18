<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbfp";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$_SESSION['idPancake'] = $_GET['pan'];

header("Location: AddRoyalPancake.php");
?>
