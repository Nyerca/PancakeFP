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
	<div class="row-fluid">
        <div class="col-xs-12 col-sm-8">
        	<iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" 
			 src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJXYBY6JakLBMR8evItrbN89Y&key=AIzaSyAyyNlt6JQ-5Na8Sqq73AMh57zXfdd9gBI">
			</iframe>
    	</div>
    	
      	<div class="col-xs-12 col-sm-4">
    		<h2>PF Pancakes</h2>
    		<address>
    			Via Sangro 66<br>
    			47522<br>
    			Cesena<br>
    			Italia<br>
    			01234 567 890
    		</address>
    	</div>
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