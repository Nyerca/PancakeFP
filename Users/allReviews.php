<?php
require_once 'dbConnection.php';
		$conn =connect();
		$sql = "SELECT AVG(Vote) as average FROM review";
		
		$result = $conn->query($sql);
?>
<script type="text/javascript">
function AddToCart(id, name, price, amount) {
	xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
				alert("ok");
                document.getElementById("divReviews").innerHTML = this.responseText;
            }
        };
	xmlhttp.open("GET","allReviews.php",true);
	xmlhttp.send();
}
</script>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" title="stylesheet" href="reviewStyle.css">
</head>
<body>

<?php require 'header.php' ?>
  
<div id="bodyDiv" class="container text-center">    
	<div id="bodyContent">
	<div id="firstReview">
		<h1>Recensioni</h1><br>
		
		<div class="container">  
		<h1>Media voti</h1><br>
		<?php
		if($result->num_rows > 0)	{
			while($row = $result->fetch_assoc()) {
				?>
				<p><?php echo $row["average"]; ?> / 5</p>
				<?php
			}
		}
		?>

		</div>
		
		<div class="container">  
		<p>Scegli la stella di cui vuoi vedere le recensioni</p>
		<button id="star1" type="button" onclick="Shine(1)">
			<span id="s1" class="glyphicon glyphicon-star-empty">
		</button>
		<button id="star2" type="button" onclick="Shine(2)">
			<span id="s2" class="glyphicon glyphicon-star-empty">
		</button>
		<button id="star3" type="button" onclick="Shine(3)">
			<span id="s3" class="glyphicon glyphicon-star-empty">
		</button>
		<button id="star4" type="button" onclick="Shine(4)">
			<span id="s4" class="glyphicon glyphicon-star-empty">
		</button>
		<button id="star5" type="button" onclick="Shine(5)">
			<span id="s5" class="glyphicon glyphicon-star-empty">
		</button>

		</div>

		<div id="divReviews"></div>
	</div>
	</div>
</div>

<?php require 'footer.php' ?>

</body>
</html>

<script type="text/javascript">
var sNumber = 0;
var selected = 0;
$( document ).ready(function() {
		xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
				alert("ok");
                document.getElementById("divReviews").innerHTML = this.responseText;
            }
        };
	xmlhttp.open("GET","allReviewsChange.php",true);
	xmlhttp.send();
});

function Shine($number) {
	if(sNumber == $number) {
		selected = 1;
	}	
	if(selected==1) {
		selected=0;
		alert(selected);
		sNumber=0;
		$i = 1;
		while($i <= 5) {
		$("#s".concat($i)).attr("class", "glyphicon glyphicon-star-empty");
		$i = $i + 1;
		}
		xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
				alert("ok");
                document.getElementById("divReviews").innerHTML = this.responseText;
            }
        };
	xmlhttp.open("GET","allReviewsChange.php",true);
	xmlhttp.send();
	} else {
		$i = 1;
	sNumber = $number;
	$('#stars').val($number);
	alert($('#stars').val());
	while($i <= $number) {
		$("#s".concat($i)).attr("class", "glyphicon glyphicon-star");
		$i = $i + 1;
	}
	while($i <= 5) {
		$("#s".concat($i)).attr("class", "glyphicon glyphicon-star-empty");
		$i = $i + 1;
	}
	
	xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
				alert("ok");
                document.getElementById("divReviews").innerHTML = this.responseText;
            }
        };
	xmlhttp.open("GET","allReviewsChange.php?stars="+$number,true);
	xmlhttp.send();
	}
}
</script>