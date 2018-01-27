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
require_once 'cart.php'; 
$conn =connect();
	if (isset($_GET["showCat"])) {
		$category = $_GET["showCat"];
	} else {
		$category = 1;
	}
	$_SESSIONS["cat"] = $category;
	?>
	<select class="col-xs-12" onchange="change(this, <?php echo $category;?>)" >
	<option value="-1">Show all</option>
  <?php
$result = getUnderCategoryItems($category);
				while($row = $result->fetch_assoc()) {
					if(isset($_GET["underC"]) && $_GET["underC"]==$row["UnderCategoryID"]) {
						?>
						<option selected="selected" value="<?php echo $row["UnderCategoryID"];?>"><?php echo $row["UnderCategoryName"];?></option>
						<?php
					} else {
					?>
					<option value="<?php echo $row["UnderCategoryID"];?>"><?php echo $row["UnderCategoryName"];?></option>
					<?php
					}
				}
				?>
</select>
	<?php	
	
	if(isset($_GET["underC"]) && $_GET["underC"]>=0) {
		$sql = "SELECT * from item WHERE Deleted=0 AND CategoryID =".$_SESSIONS["cat"]." AND UnderCategoryID = ".$_GET["underC"];
	} else {
		$sql = "SELECT * from item WHERE Deleted=0 AND CategoryID =".$_SESSIONS["cat"];
	}
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
</body>
</html>