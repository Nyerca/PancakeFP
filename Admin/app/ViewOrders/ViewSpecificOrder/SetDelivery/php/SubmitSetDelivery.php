<?php
$servername="localhost";
$username ="root";
$password ="";
$database = "testpf";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$idOrder = $_GET["id"];
$fc = $_GET["fc"];

$sql = "UPDATE orders SET FiscalCode ='$fc' WHERE IDOrder='$idOrder'";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}
$conn->close();
header("Location: SetDelivery.php");
?>
