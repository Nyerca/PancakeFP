<!DOCTYPE html>
<html lang="en">
<head>
  <title>PFPancakes</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Pacifico" />
  <link rel="stylesheet" type="text/css" title="stylesheet" href="style.css">
  <link rel="stylesheet" type="text/css" title="stylesheet" href="reviewChange.css">
</head>
<body>

<?php require 'header.php' ?>
<div id="bodyBack">
<img id="imgTop" src="../res/breakfast.jpeg" alt="">
<div id="bodyDiv" class="container text-center">

	<div id="bodyContent">
		<h3>Welcome!</h3><br>
		<div class="well">
			<p>Welcome in the world of pancakes, the world of doraemon, the world of flavour and the world of special prices!</p>
		</div>
	</div>


	<div class="container">
	<div class="row col-xs-12">
		<div class="col-xs-12">
		<p class="homeInfos">Where we are</p>
		</div>
        <div id="shadow" class="col-xs-12 col-sm-8 shad">
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
				<?php
require_once 'reviewUtility.php';
if(getReviewNumber() > 0) {
	?>
	<div class="container">
	<div class="row">
		<h2>Reviews</h2>
	</div>

	<div class="carousel-reviews">
	<div class="container-fluid">
        <div class="row">
            <div id="carousel-reviews" class="carousel slide" data-ride="carousel">

                <div class="carousel-inner">
                    <div class="item active">
						<div id="txtHint"></div>
                    </div>
					<div class="item">
						<div id="txtHint2"></div>
                    </div>

                </div>

                <a class="left carousel-control" href="#carousel-reviews" role="button" style="color: #FFA240" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-reviews" role="button" style="color: #FFA240" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>


            </div>
        </div>
		</div>
</div>
</div>
				<?php
}
?>
<div class="container-fluid"  id="itmPhotos">
<div id="insideText" class="container content">
<p class="homeInfos">Awesome Recipes</p>
<p class="subt">TASTE THE FRESH</p>
<p>We provide our costomers a convenient shop. You can find everything you need for your breakfast and discover the taste of the best pancakes ever made!</p>
<p>The flavour is not the only thing we offer, we also have the lowest prices! What are you waiting for? Come to visit us!</p>
</div>
</div>
</div>


</div>
<?php require 'footer.php'; ?>


</body>
</html>
				<?php
require_once 'reviewUtility.php';
if(getReviewNumber() > 0) {
	?>
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
				<?php
}
?>
