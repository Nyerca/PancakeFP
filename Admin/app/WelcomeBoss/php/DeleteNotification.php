<?php
include("connect.php");
// sql to delete a record
$idNotification = $_GET['id'];
$sql = "DELETE FROM adminnotification WHERE IDAdminNotification='$idNotification'";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}
$conn->close();
header("location: WelcomeBoss.php");
 ?>
