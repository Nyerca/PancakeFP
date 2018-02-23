<?php
require_once 'dbConnection.php';
	if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
	
require_once 'cart.php'; 
if(empty($_SESSION['user'])) {
  if(empty($_SESSION["cart"])) {
	$s = serialize(new ShoppingCart());
	$_SESSION["cart"] = $s;
	
	$cart= new ShoppingCart();
  }
}
 ?>
<script type="text/javascript">
function manage($royal, $thisNote, $category) {
$oldNote = $thisNote.parentNode.parentNode.getAttribute("value");

	var notes = [("" + $oldNote).substr(0, 1), ("" + $oldNote).substr(1, 1), ("" + $oldNote).substr(2, 1)];
	if (parseInt(notes[0]) + parseInt(notes[1]) + parseInt(notes[2]) == 1 && notes[$category - 1] == "1") {
		alert("You cannot remove the last item!");
	} else {
		$changeVal = $oldNote.substring($category-1, $category);
		$changeVal ++;
		$changeVal = $changeVal % 2;
		$newNote = $oldNote.substr(0, $category-1) + $changeVal + $oldNote.substr($category);
		if ( $newNote == "000" ) {
			$newNote = $oldNote;
		}
		$thisNote.parentNode.parentNode.setAttribute("value", $newNote);
		xmlhttp = new XMLHttpRequest();
		xmlhttp.open("GET","royalNoteChange.php?IDRoyal="+$royal+"&oldNote="+$oldNote+"&newNote="+$newNote,true);
		xmlhttp.send();
		updateListinoChange();
	}
}
function insert($email, $item, $amount) {
	updateListinoChange();
xmlhttp = new XMLHttpRequest();
xmlhttp.open("GET","carrelloChangeQuantity.php?eml=".concat($email)
.concat("&idItm=").concat($item).concat("&amt=").concat($amount),true);
xmlhttp.send();
updateListinoChange();
}
function insertRoyal($email, $item, $amount, $note) {
		updateListinoChange();
xmlhttp = new XMLHttpRequest();
xmlhttp.open("GET","carrelloChangeQuantityR.php?eml=".concat($email)
.concat("&idItm=").concat($item).concat("&amt=").concat($amount).concat("&note=").concat($note),true);
xmlhttp.send();
updateListinoChange();
}
function insertOffline($item, $amount) {
updateListinoChange();
xmlhttp = new XMLHttpRequest();
xmlhttp.open("GET","listinoChangeQuantityOffline.php?idItm=".concat($item).concat("&amt=").concat($amount),true);
xmlhttp.send();
updateListinoChange();

}
function insertRoyalOffline($item, $amount, $note) {
updateListinoChange();
xmlhttp = new XMLHttpRequest();
xmlhttp.open("GET","listinoChangeQuantityOffline.php?idItm=".concat($item).concat("&amt=").concat($amount).concat("&note=").concat($note),true);
xmlhttp.send();
updateListinoChange();
}

function ifZero($val) {
	if($val.value<1) {
		$val.parentNode.parentNode.style.display="none";
	}
}
</script>
<script type="text/javascript">

function show(categoryID) {
	//window.location.href = "listino.php?showCat=" + categoryID;
	xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint3").innerHTML = this.responseText;
            }
        };
xmlhttp.open("GET","RoyalInner.php?showCat=" + categoryID,true);
xmlhttp.send();
}
function getOffset(el) {
  el = el.getBoundingClientRect();
  return {
    left: el.left + window.scrollX,
    top: el.top + window.scrollY
  }
}

function showMoreDesc(id) {
      $('#' + id).collapse("toggle");
}

function AddToCart(elem,id, name, price, amount) {
	var img = elem.getElementsByTagName('img')[0];
	
	elem.disabled = true;
	img.classList.add("grow");

	 $("#" + img.id).fadeOut(300, function() { 
	 img.classList.remove("grow");
	$("#" + img.id).fadeIn();
	elem.disabled = false;
	});
	xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
	xmlhttp.open("GET","listinoChange.php?royals=1&inc=1&itemChange=".concat(id),true);
	xmlhttp.send();
}
</script>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>RoyalPancake</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Pacifico" />
      <link rel="stylesheet" type="text/css" title="stylesheet" href="listinoChangeStyle.css">
  <link rel="stylesheet" type="text/css" title="stylesheet" href="style.css">
  <link rel="stylesheet" type="text/css" title="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
</head>
<body>


<?php require 'header.php' ?>

<div id="bodyBack">
<img id="bannerTop" class="img-responsive" src="../res/bannerTop.png" alt="">
<div id="listinoDiv" class="container text-center content">

	<div id="bodyContent">	
		<div id="orderForm" class="row display-flex">
			<div id="spaceDiv" class="container-fluid col-xs-12 col-sm-2">
				<span id="fork" class="glyphicon glyphicon-cutlery"></span>

				<?php
				$result = getCategoryRoyals();
				while($row = $result->fetch_assoc()) {
					?>
					<button type="button" class="btn button-clk col-xs-4 col-sm-12" onclick="show(<?php echo $row["CategoryID"];?>)"><?php echo $row["CategoryName"];?></button>
					<?php
				}
				?>

			</div>
			<div class="col-xs-12 col-sm-10" >
				<h1 class="homeInfos listinoInf">Taste the fresh!</h1>

				<div id="txtHint3"></div>
			</div>
		</div>
	</div>
</div>
<div class="listChange" id="txtHint"></div>
</div>

<?php require 'footer.php' ?>

</body>
</html>

<div class="modal fade" id="popItemInfo">
	<div class="modal-dialog" id="modCont" role="document">
		aaa
	</div>
</div>


<script type="text/javascript">
<?php
	if (isset($_GET["item"])) {
?>
		$("#popItemInfo").modal("toggle");
<?php 
}

?>

function popup(nomeItem, categoryID) {

	//window.location.href = "listino.php?item=" + nomeItem + "&showCat=" + categoryID;
	
xmlhttp = new XMLHttpRequest();
xmlhttp.open("GET","royalInnerPop.php?item="+nomeItem,true);
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

$( document ).ready(function() {
	xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
	xmlhttp.open("GET","listinoChange.php",true);
	xmlhttp.send();
	
		xmlhttp2 = new XMLHttpRequest();
	xmlhttp2.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint3").innerHTML = this.responseText;
            }
        };
xmlhttp2.open("GET","royalInner.php",true);
xmlhttp2.send();

});

</script>