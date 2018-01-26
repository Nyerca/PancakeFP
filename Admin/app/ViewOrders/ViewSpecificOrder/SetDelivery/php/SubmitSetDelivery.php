<?php
$servername="localhost";
$username ="root";
$password ="";
$database = "dbfp";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$idOrder = $_GET["id"];
$fc = $_GET["fc"];
$fc = str_replace("X","@", $fc);
$fc = str_replace("Y",".", $fc);

$sql = "UPDATE orders SET DeliveryManEmail ='$fc' WHERE IDOrder='$idOrder'";
if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$sql = "UPDATE orders SET Status ='1' WHERE IDOrder='$idOrder'";
if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$stmt = $conn->prepare("INSERT INTO `deliverymannotification` (`Description`, `Email`, `IDDeliveryManNotification`, `Title`) VALUES(?, ?, ?, ?)");
$stmt->bind_param("ssss", $Description, $fc, $idDMN, $Title);

$Description = "Order with ID=".' '.$idOrder.' '."need to be delivered.";
$idDMN = "1";
$Title = "You have a new order to deliver!";
$stmt->execute();


$conn->close();
header("Location: ../../../WelcomeBoss/php/WelcomeBoss.php");
?>
