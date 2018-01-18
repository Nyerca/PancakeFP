<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'dbConnection.php';
require_once 'cart.php';
$conn = connect();
	if(!empty($_SESSION['user'])) {
		$email = $_SESSION['user']["email"];
		
	} else {
		$email = "";
	}
	$result = getItemInOrder($email);

	
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

<div id="bodyDiv" class="container text-center">
	<h1>Carrello</h1>
	<div class="container-fluid text-center">
		
		<?php
			require 'listinoChange.php';
			
			
			
			
			if(empty($_SESSION['user'])) {
					if(!empty($_SESSION["cart"])) {
						$u = unserialize($_SESSION["cart"]);
						$arr =$u->getArrayItem();
						
						for($i=0; $i<sizeof($arr); $i++) {
							?>
							<div class="row">
								<div class="col-xs-12 col-sm-5">
									<p><?php echo $arr[$i]->getName(); ?></p>
								</div>
								<div class="col-xs-6 col-sm-4">
									<p><?php echo $arr[$i]->getPrice(); ?></p>
								</div>
								<div class="col-xs-6 col-sm-3">
									<p><?php echo $arr[$i]->getAmount(); ?></p>
								</div>
							</div>
							<?php
						}
					}
			}
		?>
		
		
		
	</div>
	<button type="button" class="btn btn-default" onclick="home()">Home</button>
	<button type="button" class="btn btn-default" onclick="avanti()">Avanti</button>
</div>

<?php require 'footer.php' ?>

</body>
</html>


<div class="modal fade" id="popItemInfo">
	<div class="modal-dialog" id="modCont" role="document">
		aaa
	</div>
</div>


<?php
unset($_SESSION['url']);
$conn->close();
?>
<script type="text/javascript">
function avanti() {
	<?php
	if(empty($_SESSION['user'])) {
		$_SESSION['url'] = "carrello.php";
		?>
		alert("you have to be logged in to buy");
	window.location.href= "login.php";
	<?php } else {
		if($empty==0) {
		?>
	window.location.href= "consegna.php";
	<?php
		} else {
			?>
			alert("Non ci sono elementi nel carrello");
			<?php
		}
	}
	?>
}
function home() {
	window.location.href= "home.php";
}

function popRoyal(nomeItem, note) {

	//window.location.href = "listino.php?item=" + nomeItem + "&showCat=" + categoryID;

xmlhttp = new XMLHttpRequest();
xmlhttp.open("GET","royalPopup.php?item="+nomeItem+"&note="+note,true);
xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
				
                //document.getElementById("txtHint2").innerHTML = this.responseText;
				$("#modCont").html(this.responseText);
				$("#popItemInfo").modal("toggle");
            }
        };
xmlhttp.send();

}

function manage($royal, $thisNote, $category) {
	
	$oldNote = $thisNote.parentNode.getAttribute("value");
	alert($oldNote);
	$changeVal = $oldNote.substring($category-1, $category);
	$changeVal ++;
	$changeVal = $changeVal % 2;
	$newNote = $oldNote.substr(0, $category-1) + $changeVal + $oldNote.substr($category);
	alert($newNote);
	xmlhttp = new XMLHttpRequest();
	xmlhttp.open("GET","royalNoteChange.php?IDRoyal="+$royal+"&oldNote="+$oldNote+"&newNote="+$newNote,true);
	xmlhttp.send();
	$thisNote.parentNode.setAttribute("value", $newNote);

}
</script>