<?php
require_once 'dbConnection.php';
require_once 'allReviewsUtility.php';
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
  <link rel="stylesheet" type="text/css" title="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" title="stylesheet" href="allReviews.css">
</head>
<body>

<?php require 'header.php' ?>
  
<div id="bodyDiv" class="container text-center">    
	<div id="bodyContent">
	<div id="firstReview">
		<h1>Recensioni</h1><br>
		
		


        <div class="col-xs-12">
            <div class="well">
                <div class="row">
                    <div class="col-xs-12">
						<p class="rating-num"><?php echo getAvg();?> <span id="bigStar" class="glyphicon glyphicon-star"></p> 
						

                    </div>
					<div class="col-xs-12">
                        <span class="glyphicon glyphicon-user"></span><?php echo getReviewsNumber();?> total
                    </div>
                    <div class="col-xs-12">
                        <div class="row rating-desc">
                            <div class="col-xs-2 text-right">
                                <span class="glyphicon glyphicon-star"></span>5
                            </div>
                            <div class="col-xs-9">
                                <div class="progress progress-striped">
                                    <div  id="w5" class="progress-bar progress-bar-success" role="progressbar" data-transitiongoal="75">
                                        <span class="sr-only"><?php echo getStarPercentage(5); ?>%</span>
                                    </div>
                                </div>
                            </div>
                            <!-- end 5 -->
                            <div class="col-xs-2 text-right">
                                <span class="glyphicon glyphicon-star"></span>4
                            </div>
                            <div class="col-xs-9">
                                <div class="progress">
                                    <div id="w4" class="progress-bar progress-bar-success" role="progressbar" data-transitiongoal="75">
                                        <span class="sr-only"><?php echo getStarPercentage(4);?>%</span>
                                    </div>
                                </div>
                            </div>
                            <!-- end 4 -->
                            <div class="col-xs-2 text-right">
                                <span class="glyphicon glyphicon-star"></span>3
                            </div>
                            <div class="col-xs-9">
                                <div class="progress">
                                    <div id="w3" class="progress-bar progress-bar-info" role="progressbar" data-transitiongoal="75">
                                        <span class="sr-only"><?php echo getStarPercentage(3);?>%</span>
                                    </div>
                                </div>
                            </div>
                            <!-- end 3 -->
                            <div class="col-xs-2 text-right">
                                <span class="glyphicon glyphicon-star"></span>2
                            </div>
                            <div class="col-xs-9">
                                <div class="progress">
                                    <div id="w2" class="progress-bar progress-bar-warning" role="progressbar" data-transitiongoal="75">
                                        <span class="sr-only"><?php echo getStarPercentage(2);?>%</span>
                                    </div>
                                </div>
                            </div>
                            <!-- end 2 -->
                            <div class="col-xs-2 text-right">
                                <span class="glyphicon glyphicon-star"></span>1
                            </div>
                            <div class="col-xs-9">
                                <div class="progress">
                                    <div id="w1" class="progress-bar progress-bar-danger" role="progressbar" data-transitiongoal="75">
                                        <span class="sr-only"><?php echo getStarPercentage(1);?>%</span>
                                    </div>
                                </div>
                            </div>
                            <!-- end 1 -->
                        </div>
                        <!-- end row -->
                    </div>
                </div>
            </div>
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
	
<?php
	for($i=1; $i<6; $i++) {
		$perc = getStarPercentage($i);
		?>
		$percentage = <?php echo $perc;?> + "%";
		var e1 = document.getElementById("w"+<?php echo $i;?>);
		e1.style.width = $percentage;
		<?php
	}
	?>
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