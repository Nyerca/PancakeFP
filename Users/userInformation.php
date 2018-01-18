<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'userInformationUtility.php';
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

<?php require 'header.php' ?>

<div id="bodyDiv" class="container text-center">    
	<div id="bodyContent">
		<div id="loginForm" class="row display-flex">
			<div id="loginLogo" class="col-xs-12 col-sm-3">
				<p>Carica foto</p>
				<img id="userPhoto" src="PF.png" alt="Logo">
				<p>Mario Rossi</p>
			</div>
			<div id="loginInsert" class="col-xs-12 col-sm-9" >
				<h1>Il mio account!</h1>
				<form class="form-horizontal" method="post">

					<div class="form-group">
						<label class="control-label col-xs-3 col-sm-3" for="email">Email:</label>
						<label id="showEmail" class="control-label col-sm-6" for="emailValue"></label>
						<div id="emailDiv" class="col-xs-10 col-xs-offset-1">
							<input type="email" class="form-control" id="email" placeholder="ciao@gmail.com" name="email">
						</div>
						<button id="modifyEmail" type="button" class="btn btn-default">
							Modify
						</button>
						
						<div class="collapse" id="myNavbar2">
						<div id="collapsedEmail" class="col-sm-12">
							
								<label class="control-label col-sm-4" for="emailN">New email:</label>
								<div class="col-sm-7 col-sm-offset-1">
									<input type="email" class="form-control" id="emailN" placeholder="Enter the new email." name="emailN">
								</div>
							</div>
						</div>
					</div>


					<div class="form-group">
						<label class="control-label col-xs-3 col-sm-3" for="username">Username:</label>
						<label id="showUsername" class="control-label col-xs-6 col-sm-6" for="usernameValue"></label>
						<div id="usernameDiv" class="col-xs-10 col-xs-offset-1">
								<input type="text" class="form-control" id="username" placeholder="Mario Rossi" name="username">
						</div>
						<button id="modifyUsername" type="button" class="btn btn-default">
							Modify
						</button>
							
						<div id="collapsedUsername" class="col-sm-12">
							<div class="collapse" id="myNavbar3">
								<label class="control-label col-sm-4" for="usernameN">New username:</label>
								<div class="col-sm-7 col-sm-offset-1">
									<input type="text" class="form-control" id="usernameN" placeholder="Enter the new Username." name="usernameN">
								</div>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-xs-3 col-sm-3" for="password">Password</label>
						<button id="popupPassword" type="button" class="btn btn-default col-xs-offset-5" data-toggle="modal" href="#popPwd">
							Modify
						</button>
						<button id="modifyPassword" type="button" class="btn btn-default col-sm-offset-9">
							Modify
						</button>
						
						<div class="modal fade" id="popPwd">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h2 class="modal-title">Password modification</h2>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										</button>
									</div>
									<div class="modal-body">
										<label class="control-label col-xs-12 col-sm-4" for="passwordTo">Old password:</label>
										<div class="col-sm-7 col-sm-offset-1">
											<input type="pwd" class="form-control" id="passwordTo" placeholder="********" name="passwordTo">
										</div>
										
										<label class="control-label col-xs-12 col-sm-4" for="passwordTn">New password:</label>
										<div class="col-sm-7 col-sm-offset-1">
											<input type="pwd" class="form-control" id="passwordTn" placeholder="********" name="passwordTn">
										</div>
										
										<label class="control-label col-xs-12 col-sm-4" for="passwordTnr">Repeat new password:</label>
										<div class="col-sm-7 col-sm-offset-1">
											<input type="pwd" class="form-control" id="passwordTnr" placeholder="********" name="passwordTnr">
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										<input type="submit" class="btn btn-primary" name="update" value="Update">
									</div>
								</div>
							</div>
						</div>
							
						<div id="collapsedPassword" class="col-sm-12">
							<div class="collapse" id="myNavbar4">
								<label class="control-label col-xs-12 col-sm-4" for="passwordPo">Old password:</label>
								<div class="col-sm-7 col-sm-offset-1">
									<input type="pwd" class="form-control" id="passwordPo" placeholder="********" name="passwordPo">
								</div>
								
								<label class="control-label col-xs-12 col-sm-4" for="passwordPn">New password:</label>
								<div class="col-sm-7 col-sm-offset-1">
									<input type="pwd" class="form-control" id="passwordPn" placeholder="********" name="passwordPn">
								</div>
								
								<label class="control-label col-xs-12 col-sm-4" for="passwordPnr">Repeat new password:</label>
								<div class="col-sm-7 col-sm-offset-1">
									<input type="pwd" class="form-control" id="passwordPnr" placeholder="********" name="passwordPnr">
								</div>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-xs-3 col-sm-3" for="telephone">Telephone:</label>
						<label id="showTelephone" class="control-label col-xs-6 col-sm-6" for="telephoneValue"></label>
						<div id="telephoneDiv" class="col-xs-10 col-xs-offset-1">
							<input type="text" class="form-control" id="telephone" placeholder="Enter the new telephone." name="telephone">
						</div>
						<button id="modifyTelephone" type="button" class="btn btn-default">
							Modify
						</button>
							
						<div id="collapsedTelephone" class="col-sm-12">
							<div class="collapse" id="myNavbar5">
								<label class="control-label col-sm-4" for="telephoneN">New telephone:</label>
								<div class="col-sm-7 col-sm-offset-1">
									<input type="text" class="form-control" id="telephoneN" placeholder="Enter the new telephone." name="telephoneN">
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">        
						<div class="col-sm-offset-2 col-sm-10">
							<input type="submit" class="btn btn-default" name="submit" value="Submit">
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>

<?php require 'footer.php' ?>

</body>
</html>

<script type="text/javascript">
$(document).ready(function(){
    $("#modifyEmail").click(function(){
        $("#myNavbar2").collapse('toggle');
    });
	$("#modifyUsername").click(function(){
        $("#myNavbar3").collapse('toggle');
    });
	$("#modifyPassword").click(function(){
        $("#myNavbar4").collapse('toggle');
    });
	$("#modifyTelephone").click(function(){
        $("#myNavbar5").collapse('toggle');
    });
});

<?php
if (!isset($_SESSION['user'])) {
	header('Location: home.php');
} else {
	$result = getAllUserInfos($_SESSION['user']["email"]);
	while($row = $result->fetch_assoc()) {
		?>
		$("#showEmail").text("<?php echo $row["Email"];?>");
		$("#showUsername").text("<?php echo $row["Username"];?>");
		$("#showTelephone").text("<?php echo $row["PhoneNumber"];?>");
		<?php
	}
	
}

if(!empty($_POST["submit"])) {
	?>
	$(window).resize(function() {
  if ($(this).width() >= 768) {
	$("#passwordTnr").val('');
    $("#passwordTn").val('');
	$("#passwordTo").val('');
  } else {
	$("#passwordPnr").val('');
	$("#passwordPn").val('');
	$("#passwordPo").val('');
  }
	});
  <?php
	if(!empty($_POST["usernameN"])) {
		updateUsername($_SESSION['user']["email"], $_POST["usernameN"]);
	}
	if(!empty($_POST["telephoneN"])) {
		updateTelephone($_SESSION['user']["email"], $_POST["telephoneN"]);
	}
	if(!empty($_POST["passwordPn"]) && (!empty($_POST["passwordPnr"])) && (!empty($_POST["passwordPo"]))) {
		updatePassword($_SESSION['user']["email"], $_POST["passwordPo"], $_POST["passwordPn"], $_POST["passwordPnr"]);
	}
}

if(!empty($_POST["update"])) {
	if(!empty($_POST["passwordTn"]) && (!empty($_POST["passwordTnr"])) && (!empty($_POST["passwordTo"]))) {
		updatePassword($_SESSION['user']["email"], $_POST["passwordTo"], $_POST["passwordTn"], $_POST["passwordTnr"]);
	}
}
?>
</Script>