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
echo "session cart defined <br/>";
  } else {
	  echo "cart already defined <br/>";
	  
  }
}
 ?>
<script type="text/javascript">
function manage($royal, $thisNote, $category) {
	$oldNote = "" + $thisNote;
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
	updateListinoChange();
}
function insert($email, $item, $amount) {
xmlhttp = new XMLHttpRequest();
xmlhttp.open("GET","carrelloChangeQuantity.php?eml=".concat($email)
.concat("&idItm=").concat($item).concat("&amt=").concat($amount),true);
xmlhttp.send();
updateListinoChange()
}
function insertRoyal($email, $item, $amount, $note) {
		
xmlhttp = new XMLHttpRequest();
xmlhttp.open("GET","carrelloChangeQuantityR.php?eml=".concat($email)
.concat("&idItm=").concat($item).concat("&amt=").concat($amount).concat("&note=").concat($note),true);
xmlhttp.send();
updateListinoChange()
}
function insertOffline($item, $amount) {
updateListinoChange();
xmlhttp = new XMLHttpRequest();
xmlhttp.open("GET","listinoChangeQuantityOffline.php?idItm=".concat($item).concat("&amt=").concat($amount),true);
xmlhttp.send();
updateListinoChange();

}
function insertRoyalOffline($item, $amount, $note) {
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
xmlhttp.open("GET","listinoInner.php?showCat=" + categoryID,true);
xmlhttp.send();
}

function getOffset(el) {
  el = el.getBoundingClientRect();
  return {
    left: el.left + window.scrollX,
    top: el.top + window.scrollY
  }
}

function AddToCart(elem,id, name, price, amount) {
	var img = elem.getElementsByTagName('img')[0];
	elem.disabled = true;
	var img2 = img.cloneNode(true);
	img2.id = "fake" + id;
	img2.style.zIndex="100";
	img2.style.position = "absolute";
	document.getElementById(""+name).insertBefore(img2, document.getElementById(""+name).childNodes[0]);
var position = 0;
var leftEl = 0;
var p = $('div.thumbnail img').each(function() {
  var id = $(this).attr("id").substring(2);
  if(id == name) {

	  position = getOffset(document.getElementById($(this).attr("id")));
	  leftEl = $(this).attr("id");
  }
});

alert($('#getItems').height());
var newPos = getOffset(document.getElementById("getItems")).top +$('#getItems').height()/3 - getOffset(img).top;
//var newPosL = $("#fake"+id).position().left;
var newPosL = getOffset(document.getElementById("getItems")).left +$('#getItems').width()/2 - getOffset(img).left;
$("#fake"+id).animate({opacity: '0.4', top: +newPos, left: newPosL}, 700, function() {
   xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
	xmlhttp.open("GET","listinoChange.php?inc=1&itemChange=".concat(id),true);
	xmlhttp.send();
   $("#fake"+id).fadeOut(300, function() { $("#fake"+id).remove(); 
   elem.disabled = false;
	});
  });
	
	
}


function showMoreDesc(id) {
      $('#' + id).collapse("toggle");
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
    <link rel="stylesheet" type="text/css" title="stylesheet" href="listinoChangeStyle.css">
  <link rel="stylesheet" type="text/css" title="stylesheet" href="style.css">

  <link rel="stylesheet" type="text/css" title="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
</head>
<body>


<?php require 'header.php' ?>

<img id="bannerTop" class="img-responsive" src="bannerTop.png" alt="Logo">
<div id="bodyDiv" class="container text-center">

	<div id="bodyContent">	
		<div id="loginForm" class="row display-flex">
			<div id="loginLogo" class="col-xs-12 col-sm-2">
				<img id="logo" src="PF.png" alt="Logo">
				<button type="button" class="btn btn-secondary" onclick="show(1)">Pancake</button>
				<button type="button" class="btn btn-secondary" onclick="show(2)">Drink</button>
				<button type="button" class="btn btn-secondary" onclick="show(3)">Coffee</button>
			</div>
			<div id="loginInsert" class="col-xs-12 col-sm-10" >
				<h1>Crea un account!</h1>
				<div id="txtHint3"><b>Person info will be listed here...</b></div>
			</div>
		</div>
	</div>
</div>

<div id="txtHint"><b>Person info will be listed here...</b></div>


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
xmlhttp.open("GET","popup.php?item="+nomeItem,true);
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
xmlhttp2.open("GET","listinoInner.php",true);
xmlhttp2.send();

});

</script>