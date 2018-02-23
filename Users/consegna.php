<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Consegna</title>
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
			<h1>Consegna</h1>
			<div class="radio">
				<label hidden for="domicile0">Cash</label>
			  <input id="domicile0" type="radio" name="optradio" value="1" onclick="Domicile(1)">Domicile
			</div>
			<div class="radio">
			<label hidden for="store">Cash</label>
			  <input id="store" type="radio" name="optradio" value="0" onclick="Domicile(0)" checked="checked">Store
			</div>
		</div>
		
		
		<div id="domicilioSelected" class="form-group">
			<div class="row">
				<h1>Dove vuoi che te lo portiamo?</h1>
				<div class="radio">
				<label hidden for="geolocalization">Cash</label>
			  <input id="geolocalization" type="radio" name="optradio2" value="0" onclick="Address(0)">Geolocalization

				</div>
				<div class="radio">
				<label hidden for="Addrs">Cash</label>
			  <input id="Addrs" type="radio" name="optradio2" value="1" onclick="Address(1)">Address
				</div>
			</div>
		</div>
		
		<div id="indirizzoSelected" class="form-group">
			<div class="row">
				<label class="col-sm-5 col-lg-2" for="address">Address:</label>
				<div class="col-sm-7 col-lg-4">
					<input id="address" class="form-control" type="text" name="address">
				</div>
				<label class="col-sm-5 col-lg-2" for="cap">CAP:</label>
				<div class="col-sm-7 col-lg-4">
					<input id="cap" class="form-control" type="number" name="cap">
				</div>
			</div>
		</div>
		
		<div class="form-group">
			<div class="row">
				<label class="col-sm-5 col-lg-2" for="dateField">Date:</label>
				<div class="col-sm-7 col-lg-4">
					<input id="dateField" class="form-control" type="date" name="date">
				</div>
				<label class="col-sm-5 col-lg-2" for="time">Time:</label>
				<div class="col-sm-7 col-lg-4">
					<input id="time" class="form-control" type="time" name="time">
				</div>
			</div>
		</div>
		</form>
	</div>



</body>
</html>

<script type="text/javascript">
$( document ).ready(function() {
	$("#domicilioSelected").hide();
	$("#indirizzoSelected").hide();
	//$('#dateField').val(new Date().toDateInputValue());
	var d = new Date();
	document.getElementById('dateField').valueAsDate = d;
  var m = d.getMinutes();
  var h = d.getHours();

  if(m<10) {
	  var m = "0".concat(m);
  }
  if(h<10) {
	  var h = "0".concat(h);
  }
  $("#time").val("".concat(h).concat(":").concat(m));
  
});

Date.prototype.toDateInputValue = (function() {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0,10);
});

function Domicile(domicilio) {
	if(domicilio==1) {
		$("#domicilioSelected").show();
	} else {
		$("#domicilioSelected").hide();
		$("#indirizzoSelected").hide();
	}
}

function Address(address) {
	if(address==1) {
		$("#indirizzoSelected").show();
	} else {
		$("#indirizzoSelected").hide();
	}
}



</script>
