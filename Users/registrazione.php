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
		<h1>Registration</h1><br>

		<div class="container">  
		<div id="loginForm" class="row display-flex">
			<div id="loginLogo" class="col-xs-12 col-sm-6">
				<img id="logo" src="PF.png" alt="Logo">
			</div>
			<div id="loginInsert" class="col-xs-12 col-sm-6" >
				<h2>Crea un account!</h2>
				<form method="post">
					<div class="form-group">
						<label for="email">Email address:</label>
						<input type="email" class="form-control" name="email" id="email" required="true">
					</div>
					<div class="form-group">
						<label for="user">Username:</label>
						<input type="text" class="form-control" name="user" id="user" required="true">
					</div>
					<div class="form-group">
						<label for="pwd">Password:</label>
						<input type="password" class="form-control" name="pwd" id="pwd" required="true">
						<p>Password dimenticata?</p>
					</div>
					<div class="form-group">
						<label for="tel">Telephone:</label>
						<input type="tel" class="form-control" name="tel" id="tel">
					</div>
					<div class="checkbox">
						<label><input type="checkbox"> Remember me</label>
					</div>
					<button type="submit" class="btn btn-default" onclick="Register()">Create</button>
					<p>Registrandoti accetti i Termini di servizio e la Politica sulla Privacy</p>
					<p>Hai già un account? Accedi.</p>
				</form>
			</div>
		</div>
	</div>
</div>

<?php require 'footer.php' ?>

</body>
</html>

<script type="text/javascript">
function Register() {
<?php
require 'dbConnection.php';
	
	if(isset($_POST["email"]) && isset($_POST["user"]) && isset($_POST["pwd"])){ 
		//connessione al db
		$conn =connect();

		//preparazione query
		if(!empty($_POST["tel"])) {
			$stmt = $conn->prepare("INSERT INTO Users (Email,Password,Username,PhoneNumber) VALUES(?,?,?,?)");
			$stmt->bind_param("ssss", $email, $pwd, $user, $tel);
			$tel = $_POST["tel"];

		} else {			
			$stmt = $conn->prepare("INSERT INTO Users (Email,Password,Username) VALUES(?,?,?)");
			$stmt->bind_param("sss", $email, $pwd, $user);

		}

		$email = $_POST["email"];
		$pwd = $_POST["pwd"];
		$user = $_POST["user"];
		
		$stmt->execute();

      
		$stmt->close();
		//Chiusura connessione con db
		$conn->close();
		header("location: home.php");
	}
?>
}
</script>