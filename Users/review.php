<?php
require_once 'dbConnection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <link rel="stylesheet" type="text/css" title="stylesheet" href="style.css">
</head>
<body>

<?php require 'header.php' ?>
<div id="bodyBack">
<div id="bodyDiv" class="container text-center">    
	<div id="bodyContent">
		<div id="firstReview">
			<h1>Scrivi la tua recensione</h1><br>
			
			<div class="container">  
				<p>Scegli il numero di stelle</p>
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

			<form class="form-horizontal"  action="" method="post">
				<div class="form-group">
					<input class="form-control" type="text" id="stars" name="stars">
				</div>
				
				<div class="form-group">
					<label class="control-label col-sm-3" for="title">Titolo:</label>
					<div class="col-sm-6 col-sm-offset-1">
						<input type="text" class="form-control" id="title" placeholder="Enter title" name="title">
					</div>
				</div>
				   
				<div class="form-group">
					<label class="control-label col-sm-3" for="comment">Review:</label>
					<div class="col-sm-10 col-sm-offset-1">
						<textarea class="form-control" rows="5" id="comment" placeholder="Enter your review." name="comment"></textarea>
					</div>
				</div>
				  
				<div class="form-group">        
					<div class="col-sm-offset-2 col-sm-10">
						<input type="submit" class="btn btn-default" name="review" value="Review">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
</div>
<?php require 'footer.php' ?>

</body>
</html>

<script type="text/javascript">
var sNumber = 0;
$( document ).ready(function() {
	function hover1(number){
		$n = 0;
		while($n <= number) {
			$("#s".concat($n)).attr("class", "glyphicon glyphicon-star");
			$n = $n + 1;
		}
		if ($n > sNumber) {
			while($n <= 5) {
				$("#s".concat($n)).attr("class", "glyphicon glyphicon-star-empty");
				$n = $n + 1;
			}
		}
	}
	
	$("#star1").hover(function (){hover1(1);});
	$("#star2").hover(function (){hover1(2);});
	$("#star3").hover(function (){hover1(3);});
	$("#star4").hover(function (){hover1(4);});
	$("#star5").hover(function (){hover1(5);});
});

function Shine(number) {
	$i = 0;
	sNumber = number;
	$('#stars').val(number);
	alert($('#stars').val());
	while($i <= number) {
		$("#s".concat($i)).attr("class", "glyphicon glyphicon-star");
		$i = $i + 1;
	}
	while($i <= 5) {
		$("#s".concat($i)).attr("class", "glyphicon glyphicon-star-empty");
		$i = $i + 1;
	}
}
</script>

<?php
unset($_SESSION['url']);
if(!empty($_POST["review"])) {
	if (!isset($_SESSION['user'])) {
		
		$_SESSION['url'] = "review.php";
		$_SESSION['title'] =  $_POST['title'];
		$_SESSION['comment'] = $_POST['comment'];
		$_SESSION['stars'] = $_POST['stars'];
		?>
		<script type="text/javascript">
			alert("In order to write a review you have to be logged in.");
			window.location.href= "login.php?stars=".concat(sNumber);
		</script>
	<?php
	} else {
		if (!empty($_POST['title']) && (!empty($_POST['comment'])) && (!empty($_POST['stars']))) {
			unset($_SESSION['title']);
			unset($_SESSION['comment']);
			unset($_SESSION['stars']);
			$conn =connect();
			$email = $_SESSION['user']["email"];
			$sql = "SELECT MAX(IDReview) as max FROM Review WHERE Email = '".$email."'";
			
			$result = $conn->query($sql);
			if($result->num_rows > 0)	{
				while($row = $result->fetch_assoc()) {
					$id = $row["max"] + 1;
				}
			} else {
				$id = 1;
			}
			$stmt = $conn->prepare("INSERT INTO Review (Email,IDReview,Title, Description, Vote) VALUES(?,?,?,?,?)");
			$title = $_POST['title'];
			$comment = $_POST['comment'];
			$stars = $_POST['stars'];
			
			$stmt->bind_param("sssss", $email, $id, $title, $comment, $stars);
			
			$stmt->execute();
			$stmt->fetch();
			$stmt->close();
			$conn->close();
			?>
			<script type="text/javascript">
				window.location.href= "home.php";
			</script>
			<?php
		}
	}
}
?>

<script type="text/javascript">
$( document ).ready(function() {
	<?php
	if (isset($_SESSION['title'])) {
		?>
		$("#title").val("<?php echo $_SESSION['title'] ?>");
		$("#comment").val("<?php echo $_SESSION['comment'] ?>");
		$("#stars").val("<?php echo $_SESSION['stars'] ?>");
		Shine(<?php echo $_SESSION['stars'] ?>);
	<?php
	}
	?>
});
</script>