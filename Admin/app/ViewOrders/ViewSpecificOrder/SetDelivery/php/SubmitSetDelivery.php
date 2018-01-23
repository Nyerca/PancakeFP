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

$conn->close();
header("Location: SetDelivery.php");
?>
