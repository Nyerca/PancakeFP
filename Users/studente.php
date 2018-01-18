<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require 'dbConnection.php';

if(!empty($_POST["controllo"]) && !empty($_SESSION['user'])) {
	$conn =connect();
	$sql = "UPDATE Users SET IsStudent = 1 WHERE Email='".$_SESSION["user"]["email"]."'";
	$conn->query($sql);
	$conn->close();
	echo "".$_SESSION['user']["email"]." <br/>";
	header('Location: home.php');
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

<?php require 'header.php' ?>

<div id="bodyDiv" class="container text-center">
	<h2>Discover the advantages of being a student</h2>
	<p id="descS">If you are a student you will have free shipping and a 10% discount for each product.</p>

	<form id="formS" class="form-inline" method="post" action="studente.php">
		<fieldset>
			<legend>Enter the serial number</legend>
			<div class="form-group">
			<label for="matricola">Matricola:</label>
			<input type="text" class="form-control" id="matricola" name="matricola" placeholder="000000000">
			</div>
			<input type="submit" class="btn btn-default" name="controllo" value="Submit">
		</fieldset>
	</form>
</div>

<?php require 'footer.php' ?>

</body>
</html>


<?php
	$conn2 = connect();
	if (isset($_SESSION['user'])) {
	$sql2 = "SELECT IsStudent FROM Users WHERE Email='".$_SESSION["user"]["email"]."'";
	$result = $conn2->query($sql2);

	if ($result->num_rows > 0) {
    // output data of each row
		while($row = $result->fetch_assoc()) {
			if($row["IsStudent"] != NULL) {
			?>
			<script type="text/javascript">
				$("h2").text("Sei gia' registrato come studente!");
				$("#descS").css("display", "none");
				$("#formS").css("display", "none");
			</script>
			<?php
			}
			echo "".$row["IsStudent"];
		}
	}
	}

	$conn2->close();
?>

<?php
unset($_SESSION['url']);
if(!empty($_POST["controllo"])) {
	if (!isset($_SESSION['user'])) {
		$_SESSION['url'] = "studente.php";
		$_SESSION['matr'] =  $_POST['matricola'];
		?>
		<script type="text/javascript">
		window.location.href= "login.php";
		</script>
	<?php
	}
}
?>

<?php
	if (isset($_SESSION['matr'])) {
		?>
		<script type="text/javascript">
			$("#matricola").val("<?php echo $_SESSION['matr'] ?>");
		</script>
		<?php
	}
?>
