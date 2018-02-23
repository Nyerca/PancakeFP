<?php
session_start();
if(!isset($_SESSION['admin']["email"])) {
  header("location: ../../../../../Users/login.php");
}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width = device-width, initial-scale = 1">
  <title>Add delivery man</title>
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style media="screen">
    #drop {
      background-color: white;
    }


    @media screen and (max-width: 766px) {

        #back {
          width: 70%;
        }

        #sub {
          width: 150%;
        }

        #logo {
          float: left;
        }
    }
  </style>
<link rel="stylesheet" href="../css/AddDeliveryMan.css">
</head>
<body>

<div class="container">

  <div class="row">
  <br/>
  <br/>
     <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
         <img onclick="ReturnHome()" id="logo" src="https://fpwealth.com/wp-content/uploads/2015/09/fp-logo-large.png" width="50" height="50" alt="logo">
        </div>
       <div class="navbar-header">
        <a class="navbar-brand" href="#">Add delivery man</a>
       </div>
       <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
         <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count" style="border-radius:10px;"></span> <span class="glyphicon glyphicon-envelope" style="font-size:20px;"></span></a>
         <ul id="drop" class="dropdown-menu">
           <li class="divider"></li>
         </ul>
        </li>
       </ul>
      </div>
     </nav>
  </div>
  <br/>
  <br/>

  <div class="container">
    <form action="../php/AddDeliveryMan.php" class="well form-horizontal" method="post"  id="contact_form">

      <fieldset>

<!-- Form Name -->
    <legend>Add new delivery man!</legend>

<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label">Email</label>
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
    <input id="email" name="email1" required placeholder="E-Mail" class="form-control"  type="email">
    </div>
  </div>
</div>

<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label" >Password</label>
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-ruble"></i></span>
      <input id="password" name="password1" required placeholder="Last Name" class="form-control"  type="password">
    </div>
  </div>
</div>

<!-- Text input-->
       <div class="form-group">
        <label class="col-md-4 control-label">Name</label>
          <div class="col-md-4 inputGroupContainer">
          <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
              <input id="name" name="name" required placeholder="First Name" class="form-control"  type="text">
          </div>
        </div>
      </div>


<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label">Surname</label>
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
        <input id="surname" name="surname" required placeholder="Surname" class="form-control" type="text">
    </div>
  </div>
</div>

<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label">Fiscal code</label>
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
        <input id="fc" name="fc" required placeholder="Fiscal code" class="form-control" type="text">
    </div>
  </div>
</div>

<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label">Phone number</label>
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt"></i></span>
        <input id="phone" name="phone" required placeholder="+39 1234567890" class="form-control"  type="tel">
    </div>
  </div>
</div>



</fieldset>
<div class="row2">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
      <a id="back" href="../../php/ManageStaff.php" class="btn btn-warning" role="button">Back</a>
  </div>
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
    <label for="submit">
      <input id="sub" type="submit" value="Add" class="btn btn-warning" >
    </label>
  </div>
</div>
</form>
  </div>
</div>
<script type="text/javascript">
function ReturnHome() {
  window.location.href = "../../../WelcomeBoss/php/WelcomeBoss.php";
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
  window.location.href ="../../../ViewOrders/ViewSpecificOrder/php/ViewSpecificOrderNotification.php?" + "id=" + id;
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
