<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testpf";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// prepare and bind
$stmt = $conn->prepare("INSERT INTO `deliveryman`(`Deleted`, `FiscalCode`, `Name`, `PhoneNumber`, `Surname`) VALUES(?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $Deleted, $FiscalCode, $Name, $PhoneNumber, $Surname);
if(!isset($_POST["name"]) || !isset($_POST["surname"]) || !isset($_POST["fc"]) || !isset($_POST["phone"])) {
  die("Fill all the fields.");
}

$Deleted = "0";
$FiscalCode = $_POST['fc'];
$Name = $_POST['name'];
$PhoneNumber = $_POST['phone'];
$Surname = $_POST['surname'];
$stmt->execute();

echo "New records created successfully";

$stmt->close();
$conn->close();
header("Location: ../html/AddDeliveryMan.html");
?>
