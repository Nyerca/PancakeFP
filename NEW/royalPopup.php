<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'imagesFunctions.php';
?>
<html>
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" title="stylesheet" href="listinoStyle.css">
  
</head>

<body>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'dbConnection.php';
require_once 'cart.php';

if (isset($_GET["item"])) {
	$conn3 =connect();
		$sql4 = "SELECT RoyalName FROM royalpancake WHERE IDRoyalPancake='".$_GET["item"]."'";
		$result4 = $conn3->query($sql4);
	if($result4->num_rows > 0) {
		while($row4 = $result4->fetch_assoc()) {
			$name = $row4["RoyalName"];
		}
	}
	?>
	<div class="asd" id="popItemInfo">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h2 id="itemName" class="modal-title"><?php echo $name; ?></h2>
				</div>
				<div class="modal-body">
					<div class="row display-flex">
						<div class="col-xs-12 col-sm-6">
							<img id="logo" src="PF.png" alt="Logo">
						</div>
						<div value="<?php echo $_GET["note"];?>" class="col-xs-12 col-sm-6" >
							<h3>Componenti:</h3>
							<?php 
							$result3 = getItemInRoyal($_GET["item"]);
							$conn =connect();
							if($result3->num_rows > 0){
								while($row3 = $result3->fetch_assoc()) {
									$sql = "SELECT * FROM Item WHERE IDItem=".$row3["IDItem"];
									$result2 = $conn->query($sql);

									if($result2->num_rows > 0){
										while($row2 = $result2->fetch_assoc()) {
											?>
											<button id="<?php echo $row2["IDItem"]; ?>" type="button" onclick="manage('<?php echo $_GET["item"]; ?>',this,'<?php echo $row2["CategoryID"]; ?>')">
											<?php echo '<img height="60" src="' . htmlspecialchars($row2["Photo"]) . '"/>'; ?>
											<?php echo $row2["Name"]; ?>
											</button>
											<?php

										}
									}
								}
							}
							?>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<?php	
}
?>
</body>
</html>

