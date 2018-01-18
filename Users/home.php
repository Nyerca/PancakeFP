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
  
<div id="bodyDiv" class="container text-center">    
	<div id="myCarousel" class="carousel slide" data-ride="carousel">
		<!-- Indicators -->
		<ol class="carousel-indicators">
		  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		  <li data-target="#myCarousel" data-slide-to="1"></li>
		</ol>

		<!-- Wrapper for slides -->
		<div class="carousel-inner" role="listbox">
		  <div class="item active">
			<img src="https://placehold.it/1200x400?text=IMAGE" alt="Image">
			<div class="carousel-caption">
			  <h3>Sell $</h3>
			  <p>Money Money.</p>
			</div>      
		  </div>

		  <div class="item">
			<img src="https://placehold.it/1200x400?text=Another Image Maybe" alt="Image">
			<div class="carousel-caption">
			  <h3>More Sell $</h3>
			  <p>Lorem ipsum...</p>
			</div>      
		  </div>
		</div>

		<!-- Left and right controls -->
		<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
		  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		  <span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
		  <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		  <span class="sr-only">Next</span>
		</a>
	</div>


	<div id="bodyContent">
		<h3>What We Do</h3><br>
		<div class="well">
			<p>We prepare the best pancakes in the city! 
			We only use fresh and genuine products purchased from the local market. 
			Our pancakes are the best, try them!</p>
		</div>
	</div>
	
	<?php require 'reviewChangeGets.php'; ?>
</div>

<?php require 'footer.php'; ?>

</body>
</html>
<script type="text/javascript">
function ViewReview() {
	window.location.href= "allReviews.php";
}
</script>