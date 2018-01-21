<script type="text/javascript">
function ViewReview() {
	window.location.href= "allReviews.php";
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
  <link rel="stylesheet" type="text/css" title="stylesheet" href="style.css">
  <link rel="stylesheet" type="text/css" title="stylesheet" href="reviewChange.css">
</head>
<body>

<?php require 'header.php' ?>
  
<div id="bodyDiv" class="container text-center">    

	<div id="bodyContent">
		<h3>What We Do</h3><br>
		<div class="well">
			<p>We prepare the best pancakes in the city! 
			We only use fresh and genuine products purchased from the local market. 
			Our pancakes are the best, try them!</p>
		</div>
	</div>
	
	

	<div class="container">
	<div class="row">
		<h2>Reviews</h2>
		<button class="btn col-xs-12" type="button" onclick="ViewReview()">
		View all reviews
</button>
	</div>
	
	<div class="carousel-reviews">
	<div class="container-fluid">
        <div class="row">
            <div id="carousel-reviews" class="carousel slide" data-ride="carousel">
            
                <div class="carousel-inner">
                    <div class="item active">
						<div id="txtHint"><b>Person info will be listed here...</b></div>
                    </div>
					<div class="item">
						<div id="txtHint2"><b>Person info will be listed here...</b></div>
                    </div>
                 
                </div>
                <a class="left carousel-control" href="#carousel-reviews" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-reviews" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            </div>
        </div>
		</div>
</div>
</div>
	

</div>



<?php require 'footer.php'; ?>

</body>
</html>

<script type="text/javascript">
$( document ).ready(function() {
	
	$("#carousel-reviews").on('slide.bs.carousel', function () {
		if($('#carousel-reviews .active').index('#carousel-reviews .item')==0) {
			xmlhttp2 = new XMLHttpRequest();
			xmlhttp2.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("txtHint2").innerHTML = this.responseText;
				}
			};
			xmlhttp2.open("GET","reviewChangeGets.php",true);
			xmlhttp2.send();
		} else {

			xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("txtHint").innerHTML = this.responseText;
				}
			};
			xmlhttp.open("GET","reviewChangeGets.php",true);
			xmlhttp.send();
		}
	
    });
	
	xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
	xmlhttp.open("GET","reviewChangeGets.php",true);
	xmlhttp.send();
	
		xmlhttp2 = new XMLHttpRequest();
	xmlhttp2.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint2").innerHTML = this.responseText;
            }
        };
xmlhttp2.open("GET","reviewChangeGets.php",true);
xmlhttp2.send();

});
</script>