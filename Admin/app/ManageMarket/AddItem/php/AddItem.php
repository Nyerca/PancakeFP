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

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width = device-width, initial-scale = 1">
  <title>Manage market</title>
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/AddItem.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">

  <div class="row">
  <br/>
  <br/>
     <nav class="navbar navbar-inverse">
      <div class="container-fluid">
       <div class="navbar-header">
        <a class="navbar-brand" href="#">Add item</a>
       </div>
       <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
         <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count" style="border-radius:10px;"></span> <span class="glyphicon glyphicon-envelope" style="font-size:18px;"></span></a>
         <ul class="dropdown-menu">
           <li class="divider"></li>
         </ul>
        </li>
       </ul>
      </div>
     </nav>
   </div>

  <div class="container">
    <form action="SubmitInsert.php" method="post" enctype="multipart/form-data">
      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <label for="name">Name</label> <input type="text" class="form-control" id="name" name="name" ><br/>
      </div>
      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <label for="surname">Description</label> <input type="text" class="form-control" id="description" name="description"><br/>
      </div>

      <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <select onchange="CheckIfPancake()" lass="selectpicker" name="categoryitem" id="categoryitem">
            <?php
            $query_sql="SELECT * FROM categoryitem";
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
        <select class="selectpicker" name="undercategoryitem" id="undercategoryitem">
            <?php
            $query_sql="SELECT * FROM undercategoryitem";
            $result = $conn->query($query_sql);
            if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                ?>
                  <option><?php echo $row["UnderCategoryName"]; ?></option>
                <?php
              }
            }
            ?>
        </select>
      </div>


      <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <input type="file" name="image" value="">
      </div>
    </div>

    <div id="seasoning" class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h3>Choose seasonings</h3>
      <div class="form-check">
        <?php
        $query_sql="SELECT * FROM seasoning";
        $result = $conn->query($query_sql);
        if ($result->num_rows > 0) {

          while($row = $result->fetch_assoc()) {
            ?>
            <input name="<?php echo $row['IDSeasoning']; ?>" class="form-check-input" type="checkbox" value="">
            <label id="<?php echo $row['IDSeasoning']; ?>" class="form-check-label">
              <?php echo $row['Name']; ?>
            </label><br/>
            <?php
          }
        }
        ?>

      </div>
    </div>
    <div class="row2">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <a onclick="#" href="#" class = "btn btn-default btn-lg" role="button">Back</a>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <label for="submit">
          <input type="submit" value="Add" class = "btn btn-default btn-lg" >
        </label>
      </div>
      </div>
    </form>
</div>

<script type="text/javascript">
  function CheckIfPancake() {
    if($("#categoryitem").val() == "drink" || "coffee") {
       $("#seasoning").fadeOut();
    }
    if($("#categoryitem").val() == "pancake"){
      $("#seasoning").fadeIn();
    }
  }

  function ViewOfItem() {
    window.location.href = "../ViewItem/php/ViewItem.php?"+"fil=1";
  }

  function ViewOfRoyalPancake() {
    window.location.href = "../ViewRoyalPancake/php/ViewRoyalPancake.php?"+"fil=1";
  }

  $(document).ready(function(){

   function load_unseen_notification(view = '')
   {
    $.ajax({
     url:"../../../WelcomeBoss/php/fetch.php",
     method:"POST",
     data:{view:view},
     dataType:"json",
     success:function(data)
     {
      $('.dropdown-menu').html(data.notification);
      if(data.unseen_notification > 0)
      {
       $('.count').html(data.unseen_notification);
      }
     }
    });
   }

    load_unseen_notification();

   $(document).on('click', '.dropdown-toggle', function(){
    $('.count').html('');
    load_unseen_notification('yes');
   });

   setInterval(function(){
    load_unseen_notification();
  }, 1000);

  });


  function GoToOrder(id) {
    window.location.href ="../../../ViewOrders/ViewSpecificOrder/php/ViewSpecificOrder.php?" + "id=" + id + "&st=0";
  }

  function DeleteNotification(id){
    //Ajax request
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          load_unseen_notification();
        }
    };
    var PageToSendTo = "../../../WelcomeBoss/php/DeleteNotification.php?";
    var VariablePlaceholder = "id=";
    var UrlToSend = PageToSendTo + VariablePlaceholder + id;
    xmlhttp.open("GET", UrlToSend, true);
    xmlhttp.send();
  }

  function ViewAllNotification() {
      window.location.href ="../../../WelcomeBoss/php/ViewAllNotification.php";
  }
</script>
</body>
</html>
