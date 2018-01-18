<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'cart.php'; 

  if(isset($_GET["addr"]) && isset($_GET["cap"]))  {
	  $email = $_SESSION['user']["email"];
					$addr = $_GET["addr"];
					$cap = $_GET["cap"];
					
					insertAddressInOrder($email, $addr, $cap);
					
					$data = $_GET["data"];
					updateOrderTime($email, $data);
					echo "NON CAPISCO";
					header('Location: pagamento.php');
  }
  else if(isset($_GET["data"]))  {
					$email = $_SESSION['user']["email"];
					$data = $_GET["data"];
					updateOrderTime($email, $data);
					//if(isset( && !(empty($_GET["address"])) && !(empty($_GET["cap"])) 
					header('Location: pagamento.php');
				}

?>
<script type="text/javascript">
function timeCheck() {
	var d = new Date();
	var data = $("#dateField").val();
	var anno = data.substring(0, 4);
	var mese = data.substring(5, 7);
	var giorno = data.substring(8, 10);
	if (anno == d.getFullYear()) {
		var cMese = d.getMonth() + 1;
		if (mese == cMese) {
			if(giorno == d.getDay()) {
				var m = d.getMinutes();
				var h = d.getHours();
				var insTime = $("#time").val();
				var insM = insTime.substring(3, 5);
				var insH = insTime.substring(0, 2);
				if (insH == h) {
					if (insM>= m) {
						alert("ok2");
						return true;
					}
				} else if(insH > h) {
					alert("ok2");
					return true;
				}
			}else if (giorno > d.getDay()) {
				alert("ok1");
				return true;
			}
		} else if (mese > cMese) {
			return true;
		}
	}else if(anno > d.getFullYear()) {
		return true;
	}
	return false;
}

function DeliverSupport() {
if(timeCheck()==true) {
			<?php
			if(isset($_SESSION['user'])) {
				?>
				$data = $("#dateField").val();
				$anno = $data.substring(0, 4);
				$mese = $data.substring(5, 7);
				$giorno = $data.substring(8, 10);
				
				$insTime = $("#time").val();
				$insM = $insTime.substring(3, 5);
				$insH = $insTime.substring(0, 2);
				
				$dateTime = "".concat($anno).concat("/").concat($mese).concat("/").concat($giorno)
				.concat(" ").concat($insH).concat(":").concat($insM);
				return $dateTime;

				<?php
			}
			?>
		}
}

function CheckAddress() {
	$datetime = DeliverSupport();
	$addr = document.getElementById("address").value;
	$cap = document.getElementById("cap").value;
	if($addr && $cap && $datetime) {
		window.location.replace("consegna.php?addr="+$addr+"&cap="+$cap+"&data="+$datetime);
	}

}

function Deliver() {
	if(document.querySelector('input[name="optradio"]:checked').value==0) {
		$datetime = DeliverSupport();
		window.location.replace("consegna.php?data=".concat($dateTime));
	} else {
		if(document.querySelector('input[name="optradio2"]:checked').value==1) {
			CheckAddress();
		} else {
			alert("Geolocalizzami DA IMPLEMENTARE");
		}
	}
}
</script>
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
			<h1>Consegna</h1>
			<div class="radio">
			  <label><input type="radio" name="optradio" value="1" onclick="Domicile(1)">Domicilio</label>
			</div>
			<div class="radio">
			  <label><input type="radio" name="optradio" value="0" onclick="Domicile(0)" checked="checked">In negozio</label>
			</div>
		</div>
		
		
		<div id="domicilioSelected" class="form-group">
			<div class="row">
				<h1>Dove vuoi che te lo portiamo?</h1>
				<div class="radio">
				  <label><input type="radio" name="optradio2" value="0" onclick="Address(0)">Geolocalizzami</label>
				</div>
				<div class="radio">
				  <label><input type="radio" name="optradio2" value="1" onclick="Address(1)">Indirizzo</label>
				</div>
			</div>
		</div>
		
		<div id="indirizzoSelected" class="form-group">
			<div class="row">
				<label class="col-sm-5 col-lg-2" for="address">Indirizzo:</label>
				<div class="col-sm-7 col-lg-4">
					<input id="address" class="form-control" type="text" name="address">
				</div>
				<label class="col-sm-5 col-lg-2" for="cap">CAP:</label>
				<div class="col-sm-7 col-lg-4">
					<input id="cap" class="form-control" type="text" name="cap">
				</div>
			</div>
		</div>
		
		<div class="form-group">
			<div class="row">
				<label class="col-sm-5 col-lg-2" for="date">Data:</label>
				<div class="col-sm-7 col-lg-4">
					<input id="dateField" class="form-control" type="date" name="date">
				</div>
				<label class="col-sm-5 col-lg-2" for="time">Orario:</label>
				<div class="col-sm-7 col-lg-4">
					<input id="time" class="form-control" type="time" name="time">
				</div>
			</div>
		</div>
		</form>
	</div>
	
	
	<button type="button" class="btn btn-default">Indietro</button>
	<button type="button" class="btn btn-default" onclick="Deliver()">Avanti</button>
</div>

<?php require 'footer.php' ?>

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
  alert(m);
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
