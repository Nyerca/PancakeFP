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
		$sql3 = "SELECT * FROM Item WHERE Name='".$_GET["item"]."'";
		$result3 = $conn3->query($sql3);
	
				    if($result3->num_rows > 0)
					{
						while($row3 = $result3->fetch_assoc()) {
						?>
<div class="asd" id="popItemInfo">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h2 id="itemName" class="modal-title"><?php echo $_GET["item"]; ?></h2>
			</div>
			<div class="modal-body">
				<div class="row display-flex">
					<div class="col-xs-12 col-sm-6">
						<?php echo '<img height="150" src="' . htmlspecialchars($row3["Photo"]) . '"/>'; ?>
					</div>
					<div class="col-xs-12 col-sm-6" >
						<h3>Descrizione:</h3>
						<?php 
							echo $row3["Description"];
						?>
						<p>Prezzo:</p>
						<?php
							echo $row3["Price"];
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
					}
					}
					?>

</body>
</html>