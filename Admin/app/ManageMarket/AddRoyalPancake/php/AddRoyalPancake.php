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
<title>Add new royal pancake</title>
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="../css/AddRoyalPancake.css">
</head>
<body>

<div class="container">

  <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <h1>Add new Royal Pancake</h1>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <input id="bellNotification" type="image" src="../../../../res/bellNotification.png" name="bellNotification" alt="bellNotification" width="50" height="50"/>
    </div>
  </div>
  <br/>
  <br/>

  <div class="container">
    <form action="SubmitInsertRP.php" method="post" enctype="multipart/form-data">
      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <label for="name">Name</label> <input type="text" class="form-control" id="name" name="name" ><br/>
      </div>
      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <label for="surname">Description</label> <input type="text" class="form-control" id="description" name="description"><br/>
      </div>

      <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <h3>Pancake</h3>
            <a href="AddPancakeInRP.php" class = "btn btn-default btn-lg" role="button">Add</a>
        </div>
      </div>

      <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <h3>Drink</h3>
            <a href="AddDrinkInRP.php" class = "btn btn-default btn-lg" role="button">Add</a>
        </div>
      </div>

      <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <h3>Coffee</h3>
          <a href="AddCoffeeInRP.php" class = "btn btn-default btn-lg" role="button">Add</a>
        </div>
      </div>
    <form action="SubmitInsertRP.php" method="post" enctype="multipart/form-data">
      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h3>Choose seasonings</h3>
        <div class="form-check">
          <?php
          $query_sql="SELECT * FROM seasoning";
          $result = $conn->query($query_sql);
          if ($result->num_rows > 0) {

            while($row = $result->fetch_assoc()) {
              ?>
              <input class="form-check-input" type="checkbox" value="">
              <label name="<?php echo $row['IDSeasoning']; ?>" id="<?php echo $row['IDSeasoning']; ?>" class="form-check-label">
                <?php echo $row['Name']; ?>
              </label><br/>
              <?php
            }
          }
          ?>

        </div>
      </div>

      <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <h3>Category</h3>
        <select class="selectpicker" name="categoryRP" id="categoryRP">
            <?php
            $query_sql="SELECT * FROM categoryroyalpancakes";
            $result = $conn->query($query_sql);
            if ($result->num_rows > 0) {

              while($row = $result->fetch_assoc()) {
                ?>
                  <option><?php echo $row["CategoryName"]; ?></option>
                <?php
              }
            }
            ?>
        </select>
      </div>

      <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <h3>Select a photo</h3>
        <input type="file" name="image" value="">
      </div>
    </div>

      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <a onclick="" href="#" class = "btn btn-default btn-lg" role="button">Back</a>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <label for="submit">
          <input type="submit" value="Add" class = "btn btn-default btn-lg" >
        </label>
      </div>
    </form>
  </div>

</div>
<script type="text/javascript">

</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
