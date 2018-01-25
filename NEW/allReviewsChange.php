<html>
<head>
<script type="text/javascript">
function insert($email, $item, $amount) {
xmlhttp = new XMLHttpRequest();
xmlhttp.open("GET","carrelloChangeQuantity.php?eml=".concat($email)
.concat("&idItm=").concat($item).concat("&amt=").concat($amount),true);
xmlhttp.send();
}
function ifZero($val, $item) {
if($val.value<1) {
	$val.parentNode.parentNode.style.display="none";
//document.getElementById($item).style.display = "none";
}
}
function ViewReview() {
	window.location.href= "allReviews.php";
}
</script>
</head>
<body>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'dbConnection.php';
require_once 'cart.php';
 $conn = connect();
if(isset($_GET["stars"])) {
	$sql = "SELECT * FROM review WHERE Vote=".$_GET["stars"];
} else {
	$sql = "SELECT * FROM review";
}

$result = $conn->query($sql);
	if($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
?>

						
								<div class="col-xs-12 col-sm-4">								
								<div class="col-xs-12">
								<p><?php echo $row["Email"]; ?></p>
								</div>
								<div class="col-xs-12">
									<p><?php echo $row["Title"]; ?></p>
								</div>
								<div class="col-xs-12">
									<p><?php echo $row["Description"]; ?></p>
								</div>
								<?php
								if(!isset($_GET["stars"])) { ?>
								<div class="col-xs-12">
									<p><?php echo $row["Vote"]; ?></p>
								</div>
								<?php } ?>
								</div>

<?php

				}
    }

	

?>

</body>
</html>