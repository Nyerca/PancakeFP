<?php
$servername="localhost";
$username ="root";
$password ="";
$database = "testpf";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST["textAreaDescription"]) && isset($_POST["title"])) {
  $sql = "INSERT INTO `adminnotification`(`Description`, `Email`, `IDAdminNofitication`, `Title`) VALUES ('".$_POST['textAreaDescription'] ."','". "admin@gmail.com" ."','". "3" ."','".$_POST['title']."')";
  $conn->query($sql);
  header('Location: ../html/NewNotification.html');
}
$conn->error;
$conn->close();
?>
