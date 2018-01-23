<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'notification.php';
?>
<script type="text/javascript">
$last = <?php echo notificationOfUser($_SESSION['user']["email"]);?>;
function showNotifications() {
	
	xmlhttp = new XMLHttpRequest();
	xmlhttp.open("GET","processNotification.php",true);
	xmlhttp.send();
	getCurrent();
	$last=0;
	
	xmlhttp2 = new XMLHttpRequest();
	xmlhttp2.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("notifications").innerHTML = this.responseText;
		}
	};
	xmlhttp2.open("GET","showNotifications.php",true);
	xmlhttp2.send();
	
	var el= document.getElementById("not");
	el.classList.remove('show-count');
	el.setAttribute('data-count', 0);
}
function addNotifications() {
alert("add");
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
	alert("lol");
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

	<div id="notificationSpace"><b>Person info will be listed here...</b></div>
	<div id="currentNotification"><b>Person info will be listed here...</b></div>
	
</body>
</html>

<script type="text/javascript">
$( document ).ready(function() {
xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("notificationSpace").innerHTML = this.responseText;
		}
	};
	xmlhttp.open("GET","notify.php?numb="+'<?php echo notificationOfUser($_SESSION['user']["email"]);?>',true);
	xmlhttp.send();
	
	xmlhttp2 = new XMLHttpRequest();
	xmlhttp2.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("currentNotification").innerHTML = this.responseText;
		}
	};
	xmlhttp2.open("GET","currentNotification.php",true);
	xmlhttp2.send();
	

});

function refreshNotify($newN) {

	xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("notificationSpace").innerHTML = this.responseText;
		}
	};
	xmlhttp.open("GET","notify.php?numb="+$newN,true);
	xmlhttp.send();
}
function getCurrent() {
	xmlhttp2 = new XMLHttpRequest();
	xmlhttp2.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("currentNotification").innerHTML = this.responseText;
		}
	};
	xmlhttp2.open("GET","currentNotification.php",true);
	xmlhttp2.send();
}
setInterval(function(){
	document.getElementById("not").disabled = true; 
	getCurrent();
$newN = document.getElementById("currentNotification").innerHTML;

if($newN > $last) {
	$last= $newN;
refreshNotify($newN);
}
document.getElementById("not").disabled = false; 
}, 1000);
</script>