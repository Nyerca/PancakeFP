<script type="text/javascript">
$selected = 0;

function SelectOrder($idOrder) {
	xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("viewOrdersChange").innerHTML = this.responseText;
        }
    };
	$selected++;
	if($selected==1) {	
		xmlhttp.open("GET","viewOrdersChange.php?ord="+$idOrder,true);
	} else {
		$selected = 0;
		xmlhttp.open("GET","viewOrdersChange.php",true);
	}
	xmlhttp.send();
	
	if($selected==1) {
		xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("singleOrder").innerHTML = this.responseText;
			}
        };
		xmlhttp.open("GET","singleOrder.php?idOrd="+$idOrder,true);
		xmlhttp.send();
	}else {
		document.getElementById("singleOrder").innerHTML = "";
	}
}
</script>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
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
  <link rel="stylesheet" type="text/css" title="stylesheet" href="userInformationStyle.css">
</head>
<body>

<div id="bodyDiv" class="container text-center">    
	<div class="row" id="bodyContent">
		<div id="viewOrdersChange"></div>
	</div>
	<div class="row" id="bodyContent">
		<div id="singleOrder"></div>
	</div>
	
</div>


</body>
</html>

<script type="text/javascript">
$( document ).ready(function() {
		xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("viewOrdersChange").innerHTML = this.responseText;
            }
        };
	xmlhttp.open("GET","viewOrdersChange.php",true);
	xmlhttp.send();
});
</script>