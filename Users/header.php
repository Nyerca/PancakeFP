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
var tmpCount = 0;
function load_unseen_notification(view = '')
 {
  $.ajax({
   url:"fetch.php",
   method:"POST",
   data:{view:view},
   dataType:"json",
   success:function(data)
   {
	$('#bell').html(data.notificationBell);
    $('.dropdown-menu').html(data.notification);
    if(data.unseen_notification > 0)
    {
     $('.count').html(data.unseen_notification);
	 if(data.unseen_notification > tmpCount) {
		tmpCount = data.unseen_notification;
		} else {
			$( "#not" ).attr( "class", "dropdown-toggle notification show-count" );
		}
    } else {
		$( "#not" ).attr( "class", "dropdown-toggle notification" );
		tmpCount = 0;
	}
   }
  });
 }
function deleteNotification(elem) {
	xmlhttp = new XMLHttpRequest();
	xmlhttp.open("GET","deleteNotification.php?notificationID="+elem.id,true);
	xmlhttp.send();
	$(".fadeMe"+elem.id).parent().next().fadeOut( "slow");
	$(".fadeMe"+elem.id).parent().fadeOut( "slow", function() {
    load_unseen_notification();
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
  <link rel="stylesheet" type="text/css" title="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css">
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
		
		<div class="btn-group">

      <div class="dropdown">
       <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-target="#notificationCheck">
	  
	   <div id="bell">
		</div></a>
		<div id="notificationCheck">
       <ul class="dropdown-menu dropdown-menu-right"></ul>
	   </div>
      </div>
	 </div>
	 
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
	x.setAttribute("width", "30");
	x.setAttribute("height", "30");
	x.setAttribute("alt", "User image");
	
	var element = document.createElement("a");
	element.setAttribute("href", "profile.php");
	element.appendChild(x);
	list.appendChild(element);
}
function createUserWithoutPhoto() {
	var list = document.getElementById("userMainPht");
	list.removeChild(list.childNodes[0]);
	var x = document.createElement("span");
	x.setAttribute("class", "glyphicon glyphicon-user");
	x.setAttribute("width", "30");
	x.setAttribute("height", "30");

	
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

	if (isset($_SESSION['user'])) {
      

$result = getAllUserInfos($_SESSION['user']["email"]);
	while($row = $result->fetch_assoc()) {
		if(!empty($row["Photo"])) {
		?>
		<script type="text/javascript">

			createUserImgN('<?php echo getSrc($row["Photo"]);?>');

		</script>
		<?php
		} else {
			?>
		<script type="text/javascript">

			createUserWithoutPhoto();

		</script>
		<?php
		}
		
	}

    }
	?>
	
<script>
$(document).ready(function(){

 load_unseen_notification();

 $(document).on('click', '.dropdown-toggle', function(){
  $('.count').html('');
  load_unseen_notification('yes');
 });

 setInterval(function(){
  load_unseen_notification();
}, 1000);

});
</script>