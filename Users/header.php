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
  <title>Header</title>
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


<nav id="divHead" class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" onclick="navcollapse()">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="home.php"><img id="logo" class="img-responsive" src="../res/PF.png" alt="Logo"></a>

<div id="bellBtn" class="btn-group">

      <div class="dropdown">
       <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-target="#notificationCheck">

	   <div id="bell">
		</div></a>
		<div id="notificationCheck">
       <ul class="dropdown-menu"></ul>
	   </div>
      </div>
	 </div>

    </div>
    <div class="collapse navbar-collapse" id="myNav">
      <ul class="nav navbar-nav text-center">
				<li><a class="black" href="listino.php">Pancakes</a></li>
				<li id="firstLi"><a class="black" href="royalPancake.php">Royal Pancakes</a></li>
				<li><a class="black" href="studente.php">Student?</a></li>
				<li id="signUp"><a class="black" href="registrazione.php"><span class="glyphicon glyphicon-user"></span>Sign Up</a></li>
				<li id="signIn"><a class="black" href="login.php"><span class="glyphicon glyphicon-log-in"></span>Login</a></li>
				<li id="signOut">
				<form action="" method="post" id="frmLogout">
					<input id="lgout" type="submit" name="logout" value="Logout"></button>
				</form>
				</li>
				<li><div class="marg padLeftPhoto" id="userMainPht" class="useravatar">
				</div><a class="hideDesk black" href="profile.php">Profile</a></li>
	 <li><button id="shop" type="button" onclick="cart()">
			<span class="glyphicon glyphicon-shopping-cart"></span>
		</button><a class="hideDesk black" href="carrello.php">Cart</a></li>


      </ul>
    </div>
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
	x.setAttribute("src", "../res/" + $name);
	x.setAttribute("width", "30");
	x.setAttribute("height", "30");
	x.setAttribute("alt", "Profile");

	var element = document.createElement("a");
	element.setAttribute("href", "profile.php");
	element.appendChild(x);
	list.appendChild(element);
}
function createUserWithoutPhoto() {
	var list = document.getElementById("userMainPht");
	list.removeChild(list.childNodes[0]);
	var x = document.createElement("IMG");
	x.setAttribute("src", "../res/user.png");
	x.setAttribute("width", "30");
	x.setAttribute("height", "30");
	x.setAttribute("alt", "Profile");


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
		$("#userImg").show();
	} else {
		$("#signOut").hide();
		$("#userImg").hide();

		$("#menuCog").hide();
	}
});

function collapse() {
$("#myNavbar").collapse("toggle");
}

function navcollapse() {
$("#myNav").collapse("toggle");
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
