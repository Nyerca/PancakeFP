<!DOCTYPE html>
<html lang="en">
<body>

<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'dbConnection.php';
require_once 'viewOrdersUtility.php';

if(!isset($_GET["ord"])) {
	$result = getAllOrders($_SESSION['user']["email"]);	
} else {
	$result = getAllOrdersGivenId($_SESSION['user']["email"], $_GET["ord"]);
}
	$rows = $result->num_rows;
	if($rows > 0) {
		while($row = $result->fetch_assoc()) {
			
		?>
			<div id="orders" class="col col-xs-12 col-sm-4 well">
				<div class="col-xs-6">
				<p>Date</p>
				</div>
				<div class="col-xs-6">
					<p>Price</p>
				</div>
				<button class="col-xs-12" name="item" type="submit" onclick="SelectOrder('<?php echo $row["IDOrder"]; ?>')">
					
					<div class="col-xs-6">
				<p><?php echo $row["DateTime"]; ?>
				</div>
				<div class="col-xs-6">
					<strong><?php echo $row["TotalPrice"]; ?></strong></p>
				</div>
					
					
				</button>
			</div>
		<?php
		}
	}

?>

</body>
</html>