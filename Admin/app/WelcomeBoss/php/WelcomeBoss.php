<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport" content="width = device-width, initial-scale = 1">
<title>Welcome Boss</title>
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" title="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
<link rel="stylesheet" href="../css/WelcomeBoss.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
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
        <a class="navbar-brand" href="#">Welcome Boss</a>
       </div>
       <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
         <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count" style="border-radius:10px;"></span> <span class="glyphicon glyphicon-envelope" style="font-size:18px;"></span></a>
         <ul class="dropdown-menu"></ul>
        </li>
       </ul>
      </div>
     </nav>
</div>

  <div class="row2">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <a href="../../ManageMarket/html/ManageMarket.html" class = "btn btn-default btn-lg" role="button">Manage Market</a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <a href="../../ManageStaff/php/ManageStaff.php" class = "btn btn-default btn-lg" role="button">Manage Staff</a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <a href="../../NewNotification/html/NewNotification.html" class = "btn btn-default btn-lg" role="button">New Notification</a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <a href="../../ViewOrders/html/AllOrders.html" class = "btn btn-default btn-lg" role="button">View Orders</a>
    </div>
  </div>

</div>
<script type="text/javascript">
// var el = document.querySelector('.notification');
//
// setInterval(function(){
// if(2==1) {
//   var count = Number(el.getAttribute('data-count')) || 0;
//   el.setAttribute('data-count', count + 1);
//   el.classList.remove('notify');
//   el.offsetWidth = el.offsetWidth;
//   el.classList.add('notify');
//   if(count === 0){
//     el.classList.add('show-count');
// } }}, 1000);

$(document).ready(function(){

 function load_unseen_notification(view = '')
 {
  $.ajax({
   url:"fetch.php",
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
}, 500);

});

function  Fun(id) {
  //window.location.href ="../../ViewOrders/ViewSpecificOrder/php/ViewSpecificOrder.php?" + "id=" + id + "&st=0";
}

function DeleteNotification(id){
  //Ajax request
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        load_unseen_notification();
      }
  };
  var PageToSendTo = "DeleteNotification.php?";
  var VariablePlaceholder = "id=";
  var UrlToSend = PageToSendTo + VariablePlaceholder + id;
  xmlhttp.open("GET", UrlToSend, true);
  xmlhttp.send();
}
</script>
</body>
</html>
