<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<?php
if(!empty($_POST["buy"])) {
	if(isset($_SESSION['user']) && (!empty($_POST["cc"])) && (!empty($_POST["owner"])) 
	&& (!empty($_POST["expire"]))) {
		require 'cart.php'; 
		$email = $_SESSION['user']["email"];
		$cardNumber = $_POST["cc"];
		$cardOwner = $_POST["owner"];
		$expireDate = $_POST["expire"];
		addCardInfos($email, $cardNumber, $cardOwner, $expireDate);
		header('Location: home.php');
	} else if(isset($_SESSION['user']) && $_POST["optradio"]==0) {
		require 'cart.php'; 
		$email = $_SESSION['user']["email"];
		setOrderAsBought($email);
		header('Location: home.php');
	}
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
	<div class="container-fluid text-center">
	<form method="post">
		<div class="row">
			<h1>Pagamento</h1>
			<div class="radio">
			  <label><input type="radio" value="0" name="optradio" onclick="Card(0)" checked="checked">Contanti</label>
			</div>
			<div class="radio">
			  <label><input type="radio" value="1" name="optradio" onclick="Card(1)">Carta</label>
			</div>
		</div>
		
		
		<div id="cardSelected" class="form-group">
		
			<div class="row">
				<label class="col-sm-5 col-lg-2" for="cc">Numero carta:</label>
				<div class="col-sm-7 col-lg-4">
					<input id="cc" class="form-control" type="text" name="cc">
				</div>
				<label class="col-sm-5 col-lg-2" for="owner">Intestatario:</label>
				<div class="col-sm-7 col-lg-4">
					<input id="owner" class="form-control" type="text" name="owner">
				</div>
				<label class="col-sm-5 col-lg-2" for="expire">Data scadenza:</label>
				<div class="col-sm-7 col-lg-4">
					<input id="expire" class="form-control" type="month" name="expire">
				</div>
			</div>
			
		</div>	
	
	<button type="button" class="btn btn-default">Indietro</button>
	<input type="submit" class="btn btn-default" name="buy" value="Buy">
	</form>
	</div>
</div>
<?php require 'footer.php' ?>

</body>
</html>

<script type="text/javascript">
$( document ).ready(function() {
$("#cardSelected").hide();
});

function Card(carta) {
	if(carta==1) {
		$("#cardSelected").show();
	} else {
		$("#cc").val('');
		$("#owner").val('');
		$("#expire").val('');
		$("#cardSelected").hide();
	}
}
</script>