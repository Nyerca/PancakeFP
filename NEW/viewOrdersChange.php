<html>
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
			<div id="orders" class="col-xs-12 col-sm-4">
				<div class="col-xs-6">
				<p>Data</p>
				</div>
				<div class="col-xs-6">
					<p>Prezzo</p>
				</div>
				<button class="col-xs-12" name="item" type="submit" onclick="SelectOrder('<?php echo $row["IDOrder"]; ?>')">
					<p><?php echo $row["DateTime"]; ?>
					<?php echo $row["TotalPrice"]; ?></p>
				</button>
			</div>
		<?php
		}
	}
	$rows = $rows % 3;
	while(3 - $rows > 0 && $rows!=0) {
		$rows++;
		?>
		<div id="orders" class="col-sm-4"> 
			<div class="col-xs-6"><p>a</p>
			</div>
				<div class="col-xs-6"><p>a</p>
				</div>
				<div class="col-xs-12"><p>s</p>
				</div>
		</div>
		<?php
		
	}

?>

</body>
</html>