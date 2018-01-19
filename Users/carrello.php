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
<script type="text/javascript">
function insert($email, $item, $amount) {
xmlhttp = new XMLHttpRequest();
xmlhttp.open("GET","carrelloChangeQuantity.php?eml=".concat($email)
.concat("&idItm=").concat($item).concat("&amt=").concat($amount),true);
xmlhttp.send();
}
function insertRoyal($email, $item, $amount, $note) {
xmlhttp = new XMLHttpRequest();
xmlhttp.open("GET","carrelloChangeQuantityR.php?eml=".concat($email)
.concat("&idItm=").concat($item).concat("&amt=").concat($amount).concat("&note=").concat($note),true);
xmlhttp.send();
}
function insertOffline($item, $amount) {
xmlhttp = new XMLHttpRequest();
xmlhttp.open("GET","listinoChangeQuantityOffline.php?idItm=".concat($item).concat("&amt=").concat($amount),true);
xmlhttp.send();
}
function insertRoyalOffline($item, $amount, $note) {
xmlhttp = new XMLHttpRequest();
xmlhttp.open("GET","listinoChangeQuantityOffline.php?idItm=".concat($item).concat("&amt=").concat($amount).concat("&note=").concat($note),true);
xmlhttp.send();
}

function ifZero($val) {
	if($val.value<1) {
		$val.parentNode.parentNode.style.display="none";
	}
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
</head>
<body>

<?php require 'header.php' ?>

<div id="bodyDiv" class="container text-center">
	<h1>Carrello</h1>
	<form class="form-horizontal" method="post">
	<div class="container-fluid text-center">
		<div id="txtHint"><b>Person info will be listed here...</b></div>

		<div class="form-group">        
					<div class="col-sm-offset-2 col-sm-10">
						<input type="submit" class="btn btn-default" name="avanti" value="Avanti">
					</div>
		</div>
	</div>
	<button type="button" class="btn btn-default" onclick="home()">Home</button>

	</form>
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
if(!empty($_POST["avanti"])) {
	if(empty($_SESSION['user'])) {
		$_SESSION['url'] = "carrello.php";
		?>
	<script type="text/javascript">
	alert("In order to buy you hyave to be logged in!");
	window.location.href= "login.php";
	</script>
	<?php
	} else {
		echo cartEmpty($_SESSION['user']["email"]);
		if(cartEmpty($_SESSION['user']["email"]) > 0) {
			?>
	<script type="text/javascript">
	window.location.href= "consegna.php";
	</script>
	<?php
		} else {
			?>
	<script type="text/javascript">
	alert("There are no products to buy!");
	</script>
	<?php
		}
	}
}

?>
<script type="text/javascript">
$( document ).ready(function() {
	xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
	xmlhttp.open("GET","listinoChange.php",true);
	xmlhttp.send();

});
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
function updateListinoChange() {
	xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
	xmlhttp.open("GET","listinoChange.php",true);
	xmlhttp.send();
}
function manage($royal, $thisNote, $category) {
	
	$oldNote = $thisNote.parentNode.getAttribute("value");
	alert($oldNote);
	$changeVal = $oldNote.substring($category-1, $category);
	$changeVal ++;
	$changeVal = $changeVal % 2;
	$newNote = $oldNote.substr(0, $category-1) + $changeVal + $oldNote.substr($category);
	if ( $newNote == "000" ) {
		$newNote = $oldNote;
	}
	alert($newNote);
	xmlhttp = new XMLHttpRequest();
	xmlhttp.open("GET","royalNoteChange.php?IDRoyal="+$royal+"&oldNote="+$oldNote+"&newNote="+$newNote,true);
	xmlhttp.send();
	$thisNote.parentNode.setAttribute("value", $newNote);
updateListinoChange();
}
</script>