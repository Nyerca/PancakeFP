
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


$sql = "SELECT * FROM orders WHERE IDOrder='$idOrder'";
$result = $conn->query($sql);
$emailUser = $result->fetch_assoc();


$sql = "UPDATE orders SET Status ='2' WHERE IDOrder='$idOrder'";
if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$stmt = $conn->prepare("INSERT INTO `adminnotification` (`Description`, `Email`, `IDOrder`, `Title`) VALUES(?, ?, ?, ?)");
$stmt->bind_param("ssss", $Description, $emailUser['Email'], $idOrder, $Title);

$Description = "Order ".$idOrder." has been delivered with success.";
$Title = "New order has been delivered.";
$stmt->execute();

$stmt = $conn->prepare("INSERT INTO `usernotification` (`Description`, `Email`, `IDOrder`, `Title`) VALUES(?, ?, ?, ?)");
$stmt->bind_param("ssss", $Description, $emailUser['Email'], $idOrder, $Title);

$Description = "If you like, leave us a review! See you soon!";
$Title = "Your order has been delivered with success.";
$stmt->execute();

$conn->close();
header("Location: ../../php/WelcomeDelivery.php");
?>
