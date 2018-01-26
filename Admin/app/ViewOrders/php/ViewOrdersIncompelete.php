<?php
  $servername="localhost";
  $username ="root";
  $password ="";
  $database = "dbfp";

  $conn = new mysqli($servername, $username, $password, $database);

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport" content="width = device-width, initial-scale = 1">
<title>View orders</title>
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="../css/ViewOrders.css">
</head>
<body>


<div class="container">

  <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <h1>View orders</h1>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <input id="bellNotification" type="image" src="../../../res/bellNotification.png" name="bellNotification" alt="bellNotification" width="50" height="50"/>
    </div>
  </div>

  <div>
  	<?php
        $status = $_GET['st'];
  			$query_sql="SELECT * FROM orders o, deliverymode d  WHERE o.IDDeliveryMode=d.IDDeliveryMode AND Status='$status' AND ((Address IS NOT NULL AND CAP IS NOT NULL) OR (Latitude IS NOT NULL AND Longitude IS NOT NULL)) ";
        $result = $conn->query($query_sql);
  			if($result !== false){
  			?>
  			<table class="table table-striped">
  			  <thead>
  				<tr>
  				  <th scope="row">Date and time</th>
  				  <th scope="row">Total price</th>
  				</tr>
  			  </thead>
  			  <tbody>
  			<?php
  				if ($result->num_rows > 0) {
  					while($row = $result->fetch_assoc()) {
  						?>
  						<tr onclick="myFunction('<?php echo $row["IDOrder"] ?>', '<?php echo $status ?>')">
  							<td><?php echo $row["DateTime"]; ?></td>
  							<td><?php echo $row["TotalPrice"]; ?></td>
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

</div>


<script type="text/javascript">
function myFunction(fc, status) {
  var VariablePlaceholder = "id=";
  var UrlToSend = VariablePlaceholder + fc;
  var st = "&" + "st=" +status;
  window.location.href = "../ViewSpecificOrder/php/ViewSpecificOrder.php?" + UrlToSend + st;
}
</script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
