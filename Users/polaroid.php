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
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Pacifico" />
  <link rel="stylesheet" type="text/css" title="stylesheet" href="style.css">
  <link rel="stylesheet" type="text/css" title="stylesheet" href="reviewChange.css">
</head>
<body>

<div id="overlay"></div>
<div id="container">
<?php
require_once 'cart.php';
$result = getRandomItems();
if($result->num_rows >= 0)	{
			while($row = $result->fetch_assoc()) {
				echo '<div class="photo"><img alt="" class="photo-image" src="' . htmlspecialchars($row["Photo"]) . '"/></div>';
			}
		}
?>

</div>

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