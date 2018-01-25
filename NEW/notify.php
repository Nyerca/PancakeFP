<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<script type="text/javascript">
function showNotifications() {
	alert("hi");
	var el= document.getElementById("not");
	el.classList.remove('show-count');
	el.setAttribute('data-count', 0);
}
function addNotifications() {

	var el = document.querySelector('.notification');
	var count = Number(el.getAttribute('data-count')) || 0;
    el.setAttribute('data-count', count + 1);
    el.classList.remove('notify');
    el.offsetWidth = el.offsetWidth;
    el.classList.add('notify');
    if(count === 0){
        el.classList.add('show-count');
    }
}
function setNotifications($val) {
	alert($val);
	var el = document.querySelector('.notification');
    el.setAttribute('data-count', $val);
    el.classList.remove('notify');
    el.offsetWidth = el.offsetWidth;
    el.classList.add('notify');
	el.classList.add('show-count');

}

</script>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" title="stylesheet" href="headerStyle.css">
  <link rel="stylesheet" type="text/css" title="stylesheet" href="style.css">
</head>
<body>

<div id="menuNot" class="btn-group">
<span class="label label-pill label-danger count" style="border-radius:10px;"></span>
	<button data-toggle="dropdown" data-target="#notificationCheck" onclick="showNotifications()" data-count="<?php if(isset($_GET["numb"])) {  if($_GET["numb"] > 0) { echo  $_GET["numb"];} }?>"
id="not" class="dropdown-toggle notification <?php if(isset($_GET["numb"])) {  if($_GET["numb"] > 0) { echo  "notify show-count";} }?>"></button>
			
			<div id="notificationCheck">
			<ul class="dropdown-menu dropdown-menu-right">
				<div id="notifications"><b>Person info will be listed here...</b></div>

              <li class="divider"></li>
              <li><a class="text-center" href="">View All</a></li>                  
			</ul>
		</div>
		</div>


</body>
</html>

<script type="text/javascript">
$( document ).ready(function() {
	$("#not").click(function() {
	  $("a.dropdown-toggle").dropdown("toggle");
	});

	

});
</script>