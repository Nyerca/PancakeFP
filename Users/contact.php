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
  <link rel="stylesheet" type="text/css" title="stylesheet" href="reviewStyle.css">
</head>
<body>

<?php require 'header.php' ?>
  
<div id="bodyDiv" class="container text-center">    
	<div id="bodyContent">
	<div id="firstReview">
		<h1>Contact Us</h1><br>
	
		
		<form class="form-horizontal"  action="" method="post">
		<div class="form-group">
		<input class="form-control" type="text" id="stars" name="stars">
		</div>
		
			<div class="form-group" id="emailForm">
				<label for="email">Email address:</label>
				<input type="email" class="form-control" id="email" name="email">
			</div>
			<div class="form-group">
		
				<label class="control-label col-sm-3" for="title">Titolo:</label>
				<div class="col-sm-6 col-sm-offset-1">
					<input type="text" class="form-control" id="title" placeholder="Enter title" name="title">
				</div>
			</div>
			   
			<div class="form-group">
				<label class="control-label col-sm-3" for="comment">Descrizione:</label>
				<div class="col-sm-10 col-sm-offset-1">
					<textarea class="form-control" rows="5" id="comment" placeholder="Enter your Description." name="comment"></textarea>
				</div>
			</div>
			  
			<div class="form-group">        
				<div class="col-sm-offset-2 col-sm-10">
					<button type="button" class="btn btn-default" onclick="contact()">Contact</button>
				</div>
			</div>
			
			
		</form>
		

	</div>
	</div>
</div>

<?php require 'footer.php' ?>

</body>
</html>

<script type="text/javascript">
function contact(number) {
	window.location.href= "home.php";
}


<?php
if (isset($_SESSION['user'])) {
	?>
	$("#emailForm").hide();
	<?php
}
?>
</script>