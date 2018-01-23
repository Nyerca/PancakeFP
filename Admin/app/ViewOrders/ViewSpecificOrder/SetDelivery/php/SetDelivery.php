<?php
  $servername="localhost";
  $username ="root";
  $password ="";
  $database = "dbfp";

  $conn = new mysqli($servername, $username, $password, $database);


  $sql = "SELECT * FROM deliveryman WHERE Deleted = 0";
  $result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport" content="width = device-width, initial-scale = 1">
<title>Manage staff</title>
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="../css/SetDelivery.css">
</head>
<body>
<span id="selectedDelivery" style="display:none;"></span>
<div class="container">
  <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <h1>Set delivery man to order</h1>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <input id="bellNotification" type="image" src="../../../../../res/bellNotification.png" name="bellNotification" alt="bellNotification" width="50" height="50"/>
    </div>
  </div>

  <div class="listDeliveryMan">
      <?php
      if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $mail = $row["Email"];
            $first = strtok($mail, "@");
            $second = strtok(".");
            $third = strtok("");
            $mail = $first."X".$second."Y".$third;
            ?>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="mans" onclick="SelectDelivery('<?php echo $mail ?>')" id="<?php echo $mail ?>" style="display: block;">
                <label>Name: </label>  <?php echo $row["Name"]; ?> <br/>
                <label>Surname: </label>  <?php echo $row["Surname"]; ?> <br/>
                <label>Email: </label>  <?php echo $row["Email"]; ?> <br/>
                <label>Fiscal code: </label>  <?php echo $row["FiscalCode"]; ?> <br/>
                <label>Phone Number: </label>  <?php echo $row["PhoneNumber"]; ?> <br/>
              </div>
          </div>
            <?php
          }
      }
      mysqli_close($conn);
      ?>
  </div>
</div>
<br/>
<br/>
  <div class="row2">
  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
    <a href="../../php/ViewSpecificOrder.php" class = "btn btn-default btn-lg" role="button">Back</a>
  </div>

  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
    <a href="#" onclick="SetParameters('<?php echo $_GET['id']?>')" class = "btn btn-default btn-lg" role="button">Confirm</a>
  </div>

</div>


<script type="text/javascript">
  function SelectDelivery(fc) {
    $(".mans").css("background-color", "#afeece");
    $("#"+fc).css( "background-color", "#00802b" );
    $("#selectedDelivery").text(fc);
  }

  function SetParameters(id) {
    var fc = document.getElementById('selectedDelivery').innerHTML;
    window.location.href = "SubmitSetDelivery.php?" + "id=" + id + "&" +"fc=" + fc;
  }
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
