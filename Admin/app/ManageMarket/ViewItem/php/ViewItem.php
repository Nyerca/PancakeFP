<?php
session_start();
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport" content="width = device-width, initial-scale = 1">
<title>Pancake</title>
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="../css/ViewItem.css">
</head>
<body>
  <div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h1>Pancake</h1>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <input id="bellNotification" type="image" src="../../../../res/bellNotification.png" name="bellNotification" alt="bellNotification" width="50" height="50"/>
      </div>
    </div>


    <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
      <select onchange="Filter()" lass="selectpicker" name="categoryitem" id="categoryitem">
          <?php
          $query_sql="SELECT * FROM categoryitem";
          $result = $conn->query($query_sql);
          if ($result->num_rows > 0) {
            echo '<option>Select the category!</option>';
            while($row = $result->fetch_assoc()) {
              ?>
                <option><?php echo $row["CategoryName"]; ?></option>
              <?php
            }
          }
          ?>
      </select>
    </div>


    <br/>
    <br/>
<?php
$idFil = $_GET['fil'];
$query_sql="SELECT * FROM item WHERE CategoryID=$idFil";
$items = $conn->query($query_sql);
if ($items->num_rows > 0) {
  while($row = $items->fetch_assoc()) {
    echo '<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">';
    echo '<div class="items" id='.$row['IDItem'].' onclick=Selected('.$row['IDItem'].')>';
    echo '<input type="text" value='.$row['Name'].'>';
    echo '<figure class="figure">';
    echo '<img  class="figure-img img-fluid rounded" width="100" height="100" src="' . htmlspecialchars($row['Photo']) . '"/>';
    echo '<figcaption class="figure-caption"> Price:'.$row['Price'].'</figcaption>';
    echo '<figcaption class="figure-caption"> Description: <input type="text" value='.$row['Description'].'></figcaption>';
    echo '</figure>';
    echo '</div>';
    echo '</div>';
  }
}
$conn->close();
?>

<script type="text/javascript">
  function Filter() {
    var PageToSendTo = "GetIdFromFilter.php?";
    var VariablePlaceholder = "fil=";
    var UrlToSend = PageToSendTo + VariablePlaceholder + $("#categoryitem").val();
    var toSet = $("#categoryitem").val();
    window.location.href = UrlToSend;
  }
</script>

</div>

<div class="row2">
  <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
      <a onclick="#" href="#" class = "btn btn-default btn-lg" role="button">Back</a>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
