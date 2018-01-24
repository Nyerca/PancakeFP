<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'notification.php';
require_once 'userInformationUtility.php';
?>
<script type="text/javascript">
<?php
if (isset($_SESSION['user'])) {
?>
$last = <?php echo notificationOfUser($_SESSION['user']["email"]);?>;
<?php
}
?>
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
function deleteNotification(elem) {
	xmlhttp = new XMLHttpRequest();
	xmlhttp.open("GET","deleteNotification.php?notificationID="+elem.id,true);
	xmlhttp.send();
	$(".fadeMe"+elem.id).parent().parent().parent().fadeOut( "slow", function() {
    xmlhttp2 = new XMLHttpRequest();
	xmlhttp2.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("notifications").innerHTML = this.responseText;
		}
	};
	xmlhttp2.open("GET","showNotifications.php",true);
	xmlhttp2.send();
  });
	//elem.parentElement.parentElement.parentElement.style.display = 'none';
}
function collapseNotification($id) {
$("#collapseExample"+$id).collapse("toggle");
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
<nav class="navbar navbar-default">


	<div class="container-fluid">
	
		<div id="menuPhone" class="btn-group">
			<button id="menuButton" type="button" class="navbar-toggle" onclick="collapse()">
				<img id="menu" src="menu.png" alt="menuIcon">
			</button>
		</div>


		<div id="navHead" class="navbar-header">
			<a href="home.php">
				<img id="logo" class="img-responsive" src="PF.png" alt="Logo">
			</a>
		</div>

		<div class="collapse navbar-collapse" id="myNavbar">
			<ul class="nav navbar-nav">
				<li><a href="listino.php">Order</a></li>
				<li><a href="royalPancake.php">Royal Pancakes</a></li>
				<li><a href="contact.php">Contact</a></li>
				<li><a href="studente.php">Sei studente?</a></li>
				<li id="signUp"><a href="registrazione.php"><span class="glyphicon glyphicon-user"></span>Sign Up</a></li>
				<li id="signIn"><a href="login.php"><span class="glyphicon glyphicon-log-in"></span>Login</a></li>
				<li id="signOut">
				<form action="" method="post" id="frmLogout">
					<input type="submit" name="logout" value="Logout" class="btn btn-default"></button>	
				</form>
				</li>
			</ul>

			
		</div>
		
		

		<p id="user_name"></p>
		<div id="userMainPht" class="useravatar">
		</div>	
		<div id="menuCog" class="btn-group">
			<button id="cog" type="button" data-toggle="dropdown" data-target="#cogDrop">
				<span class="glyphicon glyphicon-cog"></span>
			</button>
		</div>
		
			
		
		<div id="cogDrop">
			<ul class="dropdown-menu">
				<li class="dropdown-header">Orders</li>
				<li><a href="viewOrders.php">My orders</a></li>
				<li class="dropdown-header">Account</li>
				<li><a href="userInformation.php">Modify account</a></li>                        
			</ul>
		</div>
		<div id="notificationSpace"><b></b></div>
		<div hidden id="currentNotification"><b></b></div>
		<button id="shop" type="button" onclick="cart()"> 
			<span class="glyphicon glyphicon-shopping-cart"></span>
		</button>
		
		
	</div>
	
</nav>

</body>
</html>

<script type="text/javascript">
$('body').on("click", ".dropdown-menu", function (e) {
    $(this).parent().is(".open") && e.stopPropagation();
});
function createUserImgN($name) {
	var list = document.getElementById("userMainPht");
	list.removeChild(list.childNodes[0]);
	var x = document.createElement("IMG");
	x.setAttribute("src", $name);
	x.setAttribute("href", "profile.php");
	x.setAttribute("width", "30");
	x.setAttribute("height", "30");
	x.setAttribute("alt", "User image");
	
	var element = document.createElement("a");
	element.setAttribute("href", "profile.php");
	element.appendChild(x);
	list.appendChild(element);
}

$( document ).ready(function() {
	<?php
	if (isset($_SESSION['user'])) {
       $logged=1;
	   $usr = $_SESSION['user']["username"];
    } else {
       $logged=0;
	   $usr = "";
    }
	?>
	$login = "<?php echo $logged ?>";
	if($login == 1) {
		$("#signUp").hide();
		$("#signIn").hide();
		$("#signOut").show();
		$("#menuCog").show();
		$("#user_name").append("<?php echo $usr ?>");
		$("#userImg").show();
	} else {
		$("#signOut").hide();
		$("#userImg").hide();
		$("#user_name").hide();
		$("#menuCog").hide();
	}
});

function collapse() {
$("#myNavbar").collapse("toggle");
}

function cart() {
window.location.href= "carrello.php";	
}
</script>

<?php

if(!empty($_POST["logout"])) {
	unset($_SESSION['user']);
	session_unset();
	session_destroy();
	?>
	<script type="text/javascript">
	window.location.replace("home.php");
	</script>
	<?php
}
?>
<script type="text/javascript">
$( document ).ready(function() {
	<?php
	if (isset($_SESSION['user'])) {
	?>
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
	<?php
	}
	?>

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
<?php
	if (isset($_SESSION['user'])) {
	?>
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
<?php
	}
	?>
</script>

<?php
	if (isset($_SESSION['user'])) {
      

$result = getAllUserInfos($_SESSION['user']["email"]);
	while($row = $result->fetch_assoc()) {
		if(!empty($row["Photo"])) {
		?>
		<script type="text/javascript">

			createUserImgN('<?php echo getSrc($row["Photo"]);?>');

		</script>
		<?php
		}
		
	}

    }
	?>