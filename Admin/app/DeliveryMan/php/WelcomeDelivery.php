<?php
session_start();
  $servername="localhost";
  $username ="root";
  $password ="";
  $database = "dbfp";

  $conn = new mysqli($servername, $username, $password, $database);
  $mail = $_SESSION['delivery']["email"];
  $query_sql="SELECT * FROM deliveryman WHERE Email='$mail'";
  $result = $conn->query($query_sql);
  $credential = $result->fetch_assoc();
  $nameDelivery = $credential['Name'];
  $surnameDelivery = $credential['Surname'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport" content="width = device-width, initial-scale = 1">
<title>Welcome delivery</title>
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="../css/DeliveryOrders.css">
</head>
<body>


<div class="container">

  <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <h1>Welcome <?php echo $credential['Name']. " " .$credential['Surname'];?></h1>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <input id="bellNotification" type="image" src="../../../res/bellNotification.png" name="bellNotification" alt="bellNotification" width="50" height="50"/>
    </div>
  </div>

  <div>
  	<?php
  			$query_sql="SELECT IDOrder, Email FROM orders WHERE Status=1 AND DeliveryManEmail='$mail'";
  			$result = $conn->query($query_sql);
  			if($result !== false){
  			?>
  			<table class="table table-striped">
  			  <thead>
  				<tr>
  				  <th scope="row">Data e ora</th>
  				  <th scope="row">Totale</th>
  				</tr>
  			  </thead>
  			  <tbody>
  			<?php
  				if ($result->num_rows > 0) {
  					while($row = $result->fetch_assoc()) {
  						?>
  						<tr onclick="myFunction('<?php echo $row["IDOrder"] ?>')">
  							<td><?php echo $row["IDOrder"]; ?></td>
  							<td><?php echo $row["Email"]; ?></td>
  						</tr>
  						<?php
  					}
  				}
  			?>
  			  </tbody>
  			</table>
  		  <?php
  			}
  			$conn->close();
  	?>
  </div>

</div>
<br/>
<br/>
  <div class="row2">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <a href="#" class = "btn btn-default btn-lg" role="button">Back</a>
  </div>
  <div class="row3">
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
      <span onclick="Logout()" class="glyphicon glyphicon-log-out">Logout</span>
    </div>
  </div>
</div>


<script type="text/javascript">
  function myFunction(fc) {
    var VariablePlaceholder = "id=";
    var UrlToSend = VariablePlaceholder + fc;
    window.location.href = "../ViewSpecificOrder/php/ViewSpecificOrder.php?" + UrlToSend;
  }

  function Logout() {
    window.location.href = "DestroySession.php";
  }

</script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
