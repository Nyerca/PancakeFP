<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Pagamento</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" title="stylesheet" href="style.css">
</head>
<body>



	<div class="container-fluid text-center">
	<form method="post">
		<div class="row">
			<h1>Pagamento</h1>
			<div class="radio">
			  <label hidden for="optradioPay0">Cash</label>
			  <input id="optradioPay0" type="radio" value="0" name="optradioPay" onclick="Card(0)" checked="checked">Cash
			</div>
			<div class="radio">
			  <label hidden for="optradioPay1">Card</label>
			  <input id="optradioPay1" type="radio" value="1" name="optradioPay" onclick="Card(1)">Card
			</div>
		</div>
		
		
		<div id="cardSelected" class="form-group">
		
			<div class="row">
				<label class="col-sm-5 col-lg-2" for="cc">Card number:</label>
				<div class="col-sm-7 col-lg-4">
					<input id="cc" class="form-control" type="number" name="cc">
				</div>
				<label class="col-sm-5 col-lg-2" for="owner">Owner:</label>
				<div class="col-sm-7 col-lg-4">
					<input id="owner" class="form-control" type="text" name="owner">
				</div>
				<label class="col-sm-5 col-lg-2" for="expire">Expire date:</label>
				<div class="col-sm-7 col-lg-4">
					<input id="expire" class="form-control" type="month" name="expire">
				</div>
			</div>
			
		</div>	
	
	</form>
	</div>


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