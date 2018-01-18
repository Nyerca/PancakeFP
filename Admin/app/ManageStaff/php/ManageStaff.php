<?php
  $servername="localhost";
  $username ="root";
  $password ="";
  $database = "testpf";

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
<link rel="stylesheet" href="../css/ManageStaff.css">
</head>
<body>
<span id="shared" style="display:none;">0</span>
<span id="saveid" style="display:none;"></span>

<div class="container">

  <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <h1>Manage staff</h1>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <input id="bellNotification" type="image" src="../../../res/bellNotification.png" name="bellNotification" alt="bellNotification" width="50" height="50"/>
    </div>
  </div>

  <div class="row2">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <a href="http://127.0.0.1/TWProject/app/ManageStaff/AddDeliveryMan/html/AddDeliveryMan.html" class = "btn btn-default btn-lg" role="button">Add delivery man</a>
    </div>
    <p>&nbsp;</p>
  </div>

    <div class="listDeliveryMan">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              ?>
              <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="mans" id="<?php echo $row["FiscalCode"] ?>" style="display: block;">
                  <div>
                    <button type="button" class="close" data-toggle="modal" data-target="#myModal" onclick="SaveId('<?php echo $row["FiscalCode"] ?>')" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <label>Name: </label>  <?php echo $row["Name"]; ?> <br/>
                  <label>Surname: </label>  <?php echo $row["Surname"]; ?> <br/>
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
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <a href="http://127.0.0.1/TWProject/app/WelcomeBoss/html/WelcomeBoss.html" class = "btn btn-default btn-lg" role="button">Back</a>
  </div>

</div>

<script type="text/javascript">
function DeleteDeliveryMan(fc) {

if($("#shared").text() == 1) {
    //Ajax request
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
           document.getElementById(fc).style.display = 'none';
           document.location.reload();
        }
    };
    var PageToSendTo = "UpdateDeliveryMan.php?";
    var VariablePlaceholder = "del=";
    var UrlToSend = PageToSendTo + VariablePlaceholder + fc;
    xmlhttp.open("GET", UrlToSend, true);
    xmlhttp.send();
  }
  $("#shared").text("0");
}

function SaveId(fc) {
  $("#saveid").text(fc);
}

function SubmitDelete() {
  $("#shared").text("1");
  DeleteDeliveryMan($("#saveid").text());
}
</script>

<!-- POP-UP, Note: this content is being shown only when an event is triggered -->
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Attention!</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure to delete ...</p>
      </div>
      <div class="modal-footer">
         <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="SubmitDelete()">Yes, im sure</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
      </div>

    </div>

  </div>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
