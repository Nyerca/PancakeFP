<?php
include("connect.php");

$idOrder = $_GET['id'];
$sql = "SELECT * FROM orders WHERE IDOrder='$idOrder'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if(strlen($row['IDDeliveryMode']) > 0) {
  $st = $row['Status'];
} else {
  $st = "-1";
}
header("Location:../../ViewOrders/html/AllOrders.php?status=".$st)
$conn->close();

 ?>
