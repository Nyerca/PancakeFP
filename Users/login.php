<?php
require_once 'dbConnection.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

	if(isset($_POST["email"]) ){ 
		$conn = connect();
		$stmt2 = $conn->prepare("SELECT Email, Username FROM admin WHERE Email=?");
		$emails = $_POST["email"];
		$stmt2->bind_param("s", $emails);
		$stmt2->execute();
		$stmt2->bind_result($email, $username);
        $stmt2->store_result();
        $stmt2->fetch();          
        if($stmt2->num_rows > 0)
        {
			$_SESSION['admin']["email"] = $email;
			$_SESSION['admin']["username"] = $username;
			header("location: WelcomeBoss.html");
		}
		
		
		$stmt = $conn->prepare("SELECT Email, Username FROM Users WHERE Email=?");
		$emails = $_POST["email"];
		$stmt->bind_param("s", $emails);
		
		$stmt->execute();
		$stmt->bind_result($email, $username);

        $stmt->store_result();
        $stmt->fetch();          
        if($stmt->num_rows > 0)
        {
			require_once 'cart.php';
			$user = "user";
			$_SESSION['user']["email"] = $email;
			$_SESSION['user']["username"] = $username;
			
			if(!empty($_SESSION["cart"])) {
				$u = unserialize($_SESSION["cart"]);
				$u->moveToDb($email);
				unset($_SESSION["cart"]);
			}
			
			if (isset($_SESSION['url'])) {
				header("location: ".$_SESSION['url']);
			} else {
				header("location: home.php");
			}
			
			
        }

		$stmt->close();
		//Chiusura connessione con db
		$conn->close();
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
  <link rel="stylesheet" type="text/css" title="stylesheet" href="style.css">

</head>
<body>


<div id="bodyDiv" class="container-fluid text-center">    
	<div id="bodyContent">
		<h1>Login</h1><br>

		<div class="container">  
		<div id="loginForm" class="row display-flex">
			<div id="loginLogo" class="col-xs-12 col-sm-6">
				<img id="logo" src="PF.png" alt="Logo">
			</div>
			<div id="loginInsert" class="col-xs-12 col-sm-6" >
				<h2>Guarda chi si rivede!</h2>
				<form method="post" action="login.php">
					<div class="form-group">
						<label for="email">Email address:</label>
						<input type="email" class="form-control" id="email" name="email">
					</div>
					<div class="form-group">
						<label for="pwd">Password:</label>
						<input type="password" class="form-control" id="pwd">
						<p>Password dimenticata?</p>
					</div>
					<div class="checkbox">
						<label><input type="checkbox"> Remember me</label>
					</div>
					<button type="submit" class="btn btn-default">Accedi</button>
					<p>Non ti sei ancora registrato? Registrati.</p>
				</form>
			</div>
		</div>
	</div>
</div>

<?php require 'footer.php' ?>

</body>
</html>
