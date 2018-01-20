<?php

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

//HARDCODED
$numberOfSeasoning = 7;
$defaultPancakePrice = 3;
$a=array();

for($i = 1; $i < $numberOfSeasoning; $i++) {
  if(isset($_POST[$i])) {
    array_push($a, $i);
  }
}
$pricePancake = 0;
for($i = 0; $i < count($a); $i++) {
  $query_sql="SELECT * FROM `seasoning` WHERE IDSeasoning='$a[$i]'";
  $result = $conn->query($query_sql);
  $row = $result->fetch_assoc();
  $pricePancake = $pricePancake + $row['Price'];
}
$pricePancake = $pricePancake + $defaultPancakePrice;

$categoryitem = $_POST['categoryitem'];
$query_sql="SELECT CategoryID FROM `categoryitem` WHERE CategoryName='$categoryitem'";
$result = $conn->query($query_sql);
$row = $result->fetch_assoc();
$mainCategory = $row['CategoryID'];

$undercategoryitem = $_POST['undercategoryitem'];
$query_sql="SELECT UnderCategoryID FROM `undercategoryitem` WHERE UnderCategoryName='$undercategoryitem'";
$result = $conn->query($query_sql);
$row = $result->fetch_assoc();
$underCategory = $row['UnderCategoryID'];

// prepare and bind
$stmt = $conn->prepare("INSERT INTO `item` (`CategoryID`, `Deleted`, `Description`, `Name`,  `Photo`, `Price`, `UnderCategoryID`) VALUES(?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss", $mainCategory, $Deleted, $Description, $Name, $Photo, $pricePancake, $underCategory);
if(!isset($_POST["name"]) || !isset($_POST["description"])) {
  die("Fill all the fields.");
}
$Photo='../../../../res/'.basename($_FILES['image']['name']);
if(move_uploaded_file($_FILES['image']['tmp_name'], $Photo)) {
  echo "true";
} else {
  echo "false";
}
$Deleted = "0";
$Description = $_POST['description'];
$Name = $_POST['name'];

$stmt->execute();
$stmt->close();

$query_sql="SELECT * FROM `item`";
$result = $conn->query($query_sql);
$idItem = 0;
while($row = $result->fetch_assoc()) {
  if($row['IDItem'] > $idItem) {
    $idItem = $row['IDItem'];
  }
}

for($i = 0; $i < count($a); $i++) {
  $stmt = $conn->prepare("INSERT INTO `seasoninginitem` (`IDItem`, `IDSeasoning`) VALUES(?, ?)");
  $stmt->bind_param("ss", $idItemToInsert, $idSeasoningToInsert);

  $idItemToInsert = $idItem;
  $idSeasoningToInsert = $a[$i];
  $stmt->execute();
  $stmt->close();
}

$conn->close();
header("Location: AddItem.php");
?>
