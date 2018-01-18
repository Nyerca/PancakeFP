<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'viewOrdersUtility.php';
require_once 'dbConnection.php';
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
  <link rel="stylesheet" type="text/css" title="stylesheet" href="userInformationStyle.css">
</head>
<body>
<?php
$result = getAllOrdersGivenId($_SESSION['user']["email"], $_GET["idOrd"]);
if($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
?>
<div id="bodyDiv" class="container text-center">    
	<div id="bodyContent">
		<h1>Ordine:</h1>
		<div id="orderInfos" class="col-xs-12 col-sm-6">
			<p>Stato:</p>
		</div>
		<div id="orderInfos" class="col-xs-12 col-sm-6">
			<p>a</p>
		</div>
		<div id="orderInfos" class="col-xs-12 col-sm-6">
			<p>Data e ora:</p>
		</div>
		<div id="orderInfos" class="col-xs-12 col-sm-6">
			<p><?php echo $row["DateTime"]; ?></p>
		</div>
		<div id="orderInfos" class="col-xs-12 col-sm-6">
			<p>Costo:</p>
		</div>
		<div id="orderInfos" class="col-xs-12 col-sm-6">
			<p><?php echo $row["TotalPrice"]; ?></p>
		</div>
		<div id="orderInfos" class="col-xs-12 col-sm-6">
			<p>Pagamento:</p>
		</div>
		<?php
			if($row["CardOwner"]=="") {
				$text = "contanti";
			} else {
				$card =$row["CardNumber"];
				$text = "card ending with: ".substr($card,12);
			}
			
			?>
			<div id="orderInfos" class="col-xs-12 col-sm-6">
			<p><?php echo $text; ?></p>
		</div>
		<div id="orderInfos" class="col-xs-12 col-sm-6">
			<p>Consegna:</p>
		</div>
		<?php
			if($row["IDDeliveryMode"]=="") {
				$text2 = "In negozio";
			} else {
				$sql2 = "SELECT * FROM deliverymode WHERE IDDeliveryMod=".$row["IDDeliveryMode"];	
				$result2 = $conn->query($sql2);
				if($result2->num_rows > 0) {
							while($row2 = $result2->fetch_assoc()) {
								if(!$row2["Address"]=="") {
									$text2 = "Domicilio indirizzo";
								} else {
									$text2 = "Domicilio geolocalizzato";
								}
							}
				}
			}
			?>
			<div id="orderInfos" class="col-xs-12 col-sm-6">
			<p><?php echo $text2; ?></p>
			</div>
	</div>
</div>
<?php
			}
}
?>

</body>
</html>