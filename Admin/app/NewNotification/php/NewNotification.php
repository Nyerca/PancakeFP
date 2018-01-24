<?php
$servername="localhost";
$username ="root";
$password ="";
$database = "dbfp";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$query_sql="SELECT * FROM users";
$result = $conn->query($query_sql);
while($row = $result->fetch_assoc()) {
  $stmt = $conn->prepare("INSERT INTO `usernotification` (`Description`, `Email`, `Title`) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $Description, $Email, $Title);
  if(!isset($_POST["description"]) || !isset($_POST["title"])) {
    die("Fill all the fields.");
  }

  $Description = $_POST["description"];
  $Email = $row['Email'];
  $Title = $_POST["title"];

  $stmt->execute();
  $stmt->close();
}

$conn->close();
header('Location: ../html/NewNotification.html');
?>
