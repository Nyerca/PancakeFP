<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'imagesFunctions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Popup</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Pacifico" />
    <link rel="stylesheet" type="text/css" title="stylesheet" href="listinoChangeStyle.css">
  <link rel="stylesheet" type="text/css" title="stylesheet" href="style.css">
  <link rel="stylesheet" type="text/css" title="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
  
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
			<h2 class="homeInfos listinoInf"><?php echo $_GET["item"]; ?></h2>
			</div>
			<div class="modal-body">
				<div class="row display-flex">
					<div class="col-xs-12 col-sm-6">
						<?php echo '<img alt="" height="150" src="' . htmlspecialchars($row3["Photo"]) . '"/>'; ?>
					</div>
					<div class="col-xs-12 col-sm-6" >
						<h3>Description:</h3>
						<?php 
							echo $row3["Description"];
						?>
						<p id="pricePopP"><strong>Price:</strong> <?php
							echo $row3["Price"];
						?><span class="glyphicon glyphicon-euro"></span></p>
						<div class="col">
						<h3>Seasonings:</h3>
						<p>
						
						<?php $res = getSeasoningOfItem($row3["IDItem"]);

						
				    if($res->num_rows > 0)
					{
						while($row_s = $res->fetch_assoc()) {
							echo $row_s["Name"] . "<br/>";
						}
					}
					?>
					</p>
					</div>
							
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