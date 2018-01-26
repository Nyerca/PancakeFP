<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'cart.php'; 
$conn =connect();

	?>

	<?php
	//preparazione query
	$sql = "SELECT * from item WHERE Deleted=0 AND CategoryID =".$_SESSIONS["cat"];
	$result = $conn->query($sql);
	if($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
				?>
			<div class="col-sm-4">
				<form action="" method="post">
					<div class="col-xs-12">	
					<button name="item" id="<?php echo $row["Name"];?>" type="button" onclick="AddToCart(this,'<?php echo $row["IDItem"]; ?>','<?php echo $row["Name"]; ?>','<?php echo $row["Price"]; ?>','1')">
						<?php echo '<img id="idImg" height="60" src="' . htmlspecialchars($row["Photo"]) . '"/>'; ?>
						<p><?php echo $row["Price"]; ?></p>
						<p><?php echo $row["Name"]; ?></p>
					</button>
					</div>
					<div class="col-xs-12">
						<button id="<?php echo $row["Name"]; ?>" type="button" onclick="popup('<?php echo $row["Name"]; ?>', '<?php echo $row["CategoryID"]; ?>')">
							View information
						</button>	
					</div>
				</form>
			</div>
							
					<?php
		}
	}
	?>
