<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'dbConnection.php';
require_once 'password_compatibility_library.php';
	if(isset($_POST["email"]) && isset($_POST["user"]) && isset($_POST["pwd"])){
		//connessione al db
		$conn =connect();

		//preparazione query
		if(!empty($_POST["tel"])) {
			$stmt = $conn->prepare("INSERT INTO Users (Email,Password,Username,PhoneNumber) VALUES(?,?,?,?)");
			$stmt->bind_param("ssss", $email, $user_password_hash, $user, $tel);
			$tel = $_POST["tel"];

		} else {
			$stmt = $conn->prepare("INSERT INTO Users (Email,Password,Username) VALUES(?,?,?)");
			$stmt->bind_param("sss", $email, $user_password_hash, $user);

		}

		$email = $_POST["email"];
		$pwd = $_POST["pwd"];
		$user = $_POST["user"];


                // crypt the user's password with PHP 5.5's password_hash() function, results in a 60 character
                // hash string. the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using
                // PHP 5.3/5.4, by the password hashing compatibility library
        $user_password_hash = password_hash($pwd, PASSWORD_DEFAULT);

		$stmt->execute();


		$stmt->close();
		//Chiusura connessione con db
		$conn->close();
		
		header("Location: home.php");
		
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Registration</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" title="stylesheet" href="style.css">
</head>
<body>

<div id="loginPhoto" class="container-fluid text-center">
		<div id="insideText" class="container content text-center">
<h2>REGISTRATION</h2>
</div>

		<div class="container">
		<div id="loginForm" class="row display-flex">
			<div id="loginLogo" class="col-xs-12 col-sm-6 content">
				<a href="home.php"><img id="logoLogin" src="../res/PF.png" alt="Logo"></a>
			</div>
			<div class="col-xs-12 col-sm-6 content" >
				<h3>Create an account!</h3>
				<form class="well form-horizontal" method="post">
          <div class="form-group">
            <label for="email" class="col-md-2 control-label">Email</label>
            <div class="col-md-12 inputGroupContainer">
            <div class="input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            <input name="email" id="email" placeholder="E-Mail" class="form-control"  type="email" required="true">
              </div>
            </div>
          </div>


          <div class="form-group">
           <label for="user" class="col-md-2 control-label">Username</label>
             <div class="col-md-12 inputGroupContainer">
             <div class="input-group">
                 <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
           <input name="user" id="user" required="true" placeholder="Username" class="form-control"  type="text">
             </div>
           </div>
         </div>


         <div class="form-group">
           <label for="pwd" class="col-md-2 control-label" >Password</label>
             <div class="col-md-12 inputGroupContainer">
             <div class="input-group">
           <span class="input-group-addon"><span class="glyphicon glyphicon-ruble"></span></span>
           <input name="pwd" id="pwd" required="true" placeholder="Password" class="form-control"  type="password">
             </div>
           </div>
         </div>

         <div class="form-group">
           <label for="tel" class="col-md-2 control-label">Phone</label>
             <div class="col-md-12 inputGroupContainer">
             <div class="input-group">
                 <span class="input-group-addon"><span class="glyphicon glyphicon-phone-alt"></span></span>
           <input name="tel" id="tel" placeholder="+39 1234567890" class="form-control"  type="tel">
             </div>
           </div>
         </div>


					<button type="submit" class="btn btn-warning">Create</button>
					<h6>By registering you accept the Terms of Service and the Privacy Policy.</h6>
					<h6>Do you already have an account?<a href="login.php"> Sign in.</a></h6>
				</form>
			</div>
		</div>
	</div>
</div>

<?php require 'footer.php' ?>

</body>
</html>


