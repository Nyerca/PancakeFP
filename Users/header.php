<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

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
		<img id="userImg" class="img-responsive" src="PF.png" alt="Logo">
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
		
		<button id="shop" type="button" onclick="cart()"> 
			<span class="glyphicon glyphicon-shopping-cart"></span>
		</button>
	</div>
	
</nav>

<?php require 'head2.php'; ?>
</body>
</html>

<script type="text/javascript">
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
