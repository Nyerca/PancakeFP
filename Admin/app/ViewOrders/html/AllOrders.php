<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width = device-width, initial-scale = 1">
  <title>View orders</title>
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../css/ViewOrders.css">
</head>
<body>
<div class="container">

  <div class="row">
  <br/>
  <br/>
     <nav class="navbar navbar-inverse">
      <div class="container-fluid">
       <div class="navbar-header">
        <a class="navbar-brand" href="#">View orders</a>
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
  <br/>
  <br/>

  <div class="row2">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <a href="../php/ViewOrdersIncompelete.php?st=1" class = "btn btn-default btn-lg" role="button">Incomplete</a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <a href="../php/ViewOrders.php?st=2" class = "btn btn-default btn-lg" role="button">Delivered</a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <a href="../php/ViewOrders.php?st=3" class = "btn btn-default btn-lg" role="button">Completed</a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <a href="../php/ViewOrders.php?st=-1" class = "btn btn-default btn-lg" role="button">In market</a>
    </div>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function(){

 function load_unseen_notification(view = '')
 {
  $.ajax({
   url:"../../WelcomeBoss/php/fetch.php",
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
 window.location.href ="../../ViewOrders/ViewSpecificOrder/php/ViewSpecificOrderNotification.php?" + "id=" + id;
}

function DeleteNotification(id){
  //Ajax request
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        load_unseen_notification();
      }
  };
  var PageToSendTo = "../../WelcomeBoss/php/DeleteNotification.php?";
  var VariablePlaceholder = "id=";
  var UrlToSend = PageToSendTo + VariablePlaceholder + id;
  xmlhttp.open("GET", UrlToSend, true);
  xmlhttp.send();
}

function ViewAllNotification() {
    window.location.href ="../../WelcomeBoss/php/ViewAllNotification.php";
}
</script>
</body>
</html>
