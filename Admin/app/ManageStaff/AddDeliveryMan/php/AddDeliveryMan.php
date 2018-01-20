<?php

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

// prepare and bind
$stmt = $conn->prepare("INSERT INTO `deliveryman` (`Deleted`, `Email`, `FiscalCode`, `Name`, `Password`, `PhoneNumber`, `Surname`) VALUES(?, ?, ?, ?, ?, ?, ?)");
if(!isset($_POST["name"]) || !isset($_POST["surname"]) || !isset($_POST["fc"]) || !isset($_POST["phone"]) || !isset($_POST["email"])|| !isset($_POST["password"])) {
  $stmt->bind_param("sssssss", $Deleted, $Email, $FiscalCode, $Name, $Password, $PhoneNumber, $Surname);
  die("Fill all the fields.");
}
// if (!mysqli_query($conn,"INSERT INTO `deliveryman` (`Deleted`, `Email`, `FiscalCode`, `Name`, `Password`,`PhoneNumber`, `Surname`) VALUES (?, ?, ?, ?, ?, ?, ?)")) {
//   echo("Error description: " . mysqli_error($conn));
// }

$Deleted = "0";
$Email = $_POST['email'];
$FiscalCode = $_POST['fc'];
$Name = $_POST['name'];
$Password = $_POST['password'];
$PhoneNumber = $_POST['phone'];
$Surname = $_POST['surname'];

$stmt->execute();

$stmt->close();
$conn->close();
//header("Location: ../html/AddDeliveryMan.html");
?>
