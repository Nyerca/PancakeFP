<html lang="en">
<body>
<script type="text/javascript">
function ViewReview() {
	window.location.href= "allReviews.php";
}
</script>
<button class="btn col-xs-12" type="button" onclick="ViewReview()">
		View all reviews
</button>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'dbConnection.php';
require_once 'cart.php';
 $conn = connect();

$sql = "SELECT * FROM review ORDER BY RAND() LIMIT 3";

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
				<div class="col-xs-12">
					<p><?php echo $row["Vote"]; ?></p>
				</div>
			</div>

<?php
		}
    }
?>

</body>
</html>