<?php
session_start();
if(!isset($_SESSION['admin']["email"])) {
  header("location: ../../../../../Users/login.php");
}

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

$categoryRP = $_POST['categoryRP'];
$query_sql="SELECT CategoryID FROM `categoryroyalpancakes` WHERE CategoryName='$categoryRP'";
$result = $conn->query($query_sql);
$row = $result->fetch_assoc();
$mainCategory = $row['CategoryID'];

// prepare and bind for RP insert
$stmt = $conn->prepare("INSERT INTO `royalpancake` (`CategoryID`, `Deleted`, `Description`, `Photo`, `RoyalName`) VALUES(?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $mainCategory, $Deleted, $Description, $Photo, $RoyalName);
if(!isset($_POST["name"]) || !isset($_POST["description"])) {
  die("Fill all the fields.");
}
$Photo='../res/'.basename($_FILES['image']['name']);
if(move_uploaded_file($_FILES['image']['tmp_name'], $Photo)) {
  echo "true";
} else {
  echo "false";
}
$Deleted = "0";
$Description = $_POST['description'];
$RoyalName = $_POST['name'];

$stmt->execute();

$stmt->close();
$conn->close();
header("Location: SubmitItems.php");
?>
