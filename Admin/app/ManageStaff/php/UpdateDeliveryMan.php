<?php
$servername="localhost";
$username ="root";
$password ="";
$database = "testpf";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$del = $_GET["del"];
$sql = "UPDATE deliveryman SET Deleted ='1' WHERE FiscalCode='$del'";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}
$conn->close();
?>
