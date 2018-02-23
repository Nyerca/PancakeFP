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
var stringGeo = "";
function nextOne() {
	var $active = $('.wizard .nav-tabs li.active');
    $active.next().removeClass('disabled');
    nextTab($active);
}
function checkItems(val) {
	<?php
	if(!empty($_SESSION['user'])) {
		?>
	if(val == 0) {
		alert("There are no items.");
	} else {
		nextOne();
	}
	<?php
	} else { 
	?>
		alert("In order to buy you have to be logged in");
		window.location.href = "login.php";
	<?php } ?>
}
function CheckLengths() {
	if(document.querySelector('input[name="optradio"]:checked').value==1) {
		if(document.querySelector('input[name="optradio2"]:checked').value==1) {
			$addr = document.getElementById("address").value;
			$cap = document.getElementById("cap").value;
			if($addr.length <= 0 || $cap.length <=0) {
				alert("Insert a correct address");
				return false;
			}
		}
	}
	if(document.querySelector('input[name="optradioPay"]:checked').value==1) {
		$cc = document.getElementById("cc").value;
	$owner = document.getElementById("owner").value;
	$expire = document.getElementById("expire").value;
		if($expire.length <= 0 || $cc.length !=16 || $owner.length <=0) {
			alert("Insert a correct payment");
			return false;
		}
	}
	return true;
}
function end() {
	$stringPay = "";
	$stringAddr = "";
	if(timeCheck()==true) {
		if(CheckLengths()==true) {
			if(document.querySelector('input[name="optradio"]:checked').value==1) {
				if(document.querySelector('input[name="optradio2"]:checked').value==1) {
					$stringAddr = CheckAddress();
				} else {
					$stringAddr = stringGeo;
				}
			}
			$dateTime = DeliverSupport();
			if(document.querySelector('input[name="optradioPay"]:checked').value==1) {
				$stringPay = CheckPay();
			}
			
			xmlhttp = new XMLHttpRequest();
			xmlhttp.open("GET","shoppingChange.php?data="+$dateTime+"" + $stringAddr + "" + $stringPay,true);
			xmlhttp.send();
			
			var $active = $('.wizard .nav-tabs li.active');
			$active.next().removeClass('disabled');
			nextTab($active);
			$active.addClass('disabled');
			$active.prev().addClass('disabled');
			$active.prev().prev().addClass('disabled');
		}
	} else {
		alert("Insert a correct date.");
	}
}

function manage($royal, $thisNote, $category) {
$oldNote = $thisNote.parentNode.parentNode.getAttribute("value");

	var notes = [("" + $oldNote).substr(0, 1), ("" + $oldNote).substr(1, 1), ("" + $oldNote).substr(2, 1)];
	if (parseInt(notes[0]) + parseInt(notes[1]) + parseInt(notes[2]) == 1 && notes[$category - 1] == "1") {
		alert("You cannot remove the last one!");
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

function showMoreDesc(id) {
      $('#' + id).collapse("toggle");
}

function ifZero($val) {
	if($val.value<1) {
		$val.parentNode.parentNode.style.display="none";
	}
}
</script>
<script type="text/javascript">
function timeCheck() {
	var d = new Date();
	var data = $("#dateField").val();
	var anno = data.substring(0, 4);
	var mese = data.substring(5, 7);
	var giorno = data.substring(8, 10);
	if (anno == d.getFullYear()) {
		var cMese = d.getMonth() + 1;
		if (mese == cMese) {
			if(giorno == d.getDate()) {
				var m = d.getMinutes();
				var h = d.getHours();
				var insTime = $("#time").val();
				var insM = insTime.substring(3, 5);
				var insH = insTime.substring(0, 2);
				if (insH == h) {
					if (insM>= m) {
						return true;
					}
				} else if(insH > h) {
					return true;
				}
			}else if (giorno > d.getDate()) {
				return true;
			}
		} else if (mese > cMese) {
			return true;
		}
	}else if(anno > d.getFullYear()) {
		return true;
	}
	return false;
}

function DeliverSupport() {
if(timeCheck()==true) {
			<?php
			if(isset($_SESSION['user'])) {
				?>
				$data = $("#dateField").val();
				$anno = $data.substring(0, 4);
				$mese = $data.substring(5, 7);
				$giorno = $data.substring(8, 10);
				
				$insTime = $("#time").val();
				$insM = $insTime.substring(3, 5);
				$insH = $insTime.substring(0, 2);
				
				$dateTime = "".concat($anno).concat("/").concat($mese).concat("/").concat($giorno)
				.concat(" ").concat($insH).concat(":").concat($insM);
				return $dateTime;

				<?php
			}
			?>
		}
}

function CheckAddress() {
	$addr = document.getElementById("address").value;
	$cap = document.getElementById("cap").value;
	if($addr && $cap) {
		 return "&addr="+$addr+"&cap="+$cap;
	}
}


function showPosition(position) {
	xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
				stringGeo = stringGeo + this.responseText;
                document.getElementById("latlong").innerHTML = this.responseText;
            }
        };
	xmlhttp.open("GET","geo.php?latitude="+position.coords.latitude+"&longitude="+position.coords.longitude,true);
	xmlhttp.send();

}

function Geolocalization() {
	if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        alert("Geolocation is not supported by this browser.");
    }
}

function Deliver() {
	if(document.querySelector('input[name="optradio"]:checked').value==0) {
		$datetime = DeliverSupport();
		window.location.replace("consegna.php?data=".concat($dateTime));
	} else {
		if(document.querySelector('input[name="optradio2"]:checked').value==1) {
			CheckAddress();
		}
	}
}
function CheckPay() {
	$cc = document.getElementById("cc").value;
	$owner = document.getElementById("owner").value;
	$expire = document.getElementById("expire").value;
	if($cc && $owner && $expire) {
		 return "&cc="+$cc+"&owner="+$owner+"&expire="+$expire;
	}
}
</script>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Cart</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  <link rel="stylesheet" type="text/css" title="stylesheet" href="consegna.css">
  <link rel="stylesheet" type="text/css" title="stylesheet" href="style.css">
</head>
<body>

<?php require 'header.php' ?>

<div id="bodyDiv" class="container text-center">
<div hidden id="latlong"></div>

<div class="row">
		<section>
        <div class="wizard">
            <div class="wizard-inner">
                <div class="connecting-line"></div>
                <ul class="nav nav-tabs" role="tablist">

                    <li role="presentation" class="active">
                        <a href="#step1" aria-controls="step1" role="tab" title="Preview">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-shopping-cart"></i>
                            </span>
                        </a>
                    </li>

                    <li role="presentation" class="disabled">
                        <a href="#step2" aria-controls="step2" role="tab" title="Delivery">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-road"></i>
                            </span>
                        </a>
                    </li>
                    <li role="presentation" class="disabled">
                        <a href="#step3" aria-controls="step3" role="tab" title="Payment">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-euro"></i>
                            </span>
                        </a>
                    </li>

                    <li role="presentation" class="disabled">
                        <a href="#complete" aria-controls="complete" role="tab" title="Complete">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-ok"></i>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>

            <form role="form">
                <div class="tab-content">
                    <div class="tab-pane active" role="tabpanel" id="step1">
                        <h2>Carrello</h2>
						<form class="form-horizontal" method="post">
						<div class="container-fluid text-center">
							<div id="txtHint"></div>
						</div>

						<p id="totPrice">Totale : <?php 
						
						if(!empty($_SESSION["cart"])) {	
						$u = unserialize($_SESSION["cart"]);
						echo $u->getPrice();
						} else if(!empty($_SESSION['user'])) {
							$email = $_SESSION['user']["email"];
							if(isStudent($email) == 1) {
								echo '<s>'. getFullPriceNotStudent($email) . '</s>   >  '; 
							}
						echo getTotalPrice($email); 
						} else {
							echo 0;
						}?><span class="glyphicon glyphicon-euro"></span></p>

						</form>
                        <ul class="list-inline pull-right">
                            <li><button type="button" onclick="checkItems('<?php echo getTotalPrice($email); ?>')" class="btn btn-primary next-step">Continue</button></li>
                        </ul>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="step2">
                        <?php require 'consegna.php' ?>
						<ul class="list-inline pull-right">
							<li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                            <li><button type="button" onclick="nextOne()" class="btn btn-primary next-step">Continue</button></li>
                        </ul>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="step3">
                        <?php require 'pagamento.php' ?>
						<ul class="list-inline pull-right">
							<li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                            <li><button type="button"onclick="end()" class="btn btn-primary next-step">Save and continue</button></li>
                        </ul>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="complete">
                        <h3>Complete</h3>
                        <p>You have successfully completed all steps.</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </form>
        </div>
    </section>
   </div>


	
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


$(document).ready(function () {
    //Initialize tooltips
    $('.nav-tabs > li a[title]').tooltip();
	
$(".nav-tabs a").click(function(){
   if ($(this).parent().attr('class') == "disabled") {
	} else {
		$(this).tab('show');
	}
    });
	
	
    //Wizard
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
        var $target = $(e.target);
    
        if ($target.parent().hasClass('disabled')) {
            return false;
        }
    });


    $(".prev-step").click(function (e) {
        var $active = $('.wizard .nav-tabs li.active');
        prevTab($active);

    });
});

function nextTab(elem) {
	
    $(elem).next().find('a').click();
}
function prevTab(elem) {
    $(elem).prev().find('a').click();
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

});
function home() {
	window.location.href= "home.php";
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
</script>
<script type="text/javascript">
$( document ).ready(function() {
	$("#domicilioSelected").hide();
	$("#indirizzoSelected").hide();
	//$('#dateField').val(new Date().toDateInputValue());
	var d = new Date();
	document.getElementById('dateField').valueAsDate = d;
  var m = d.getMinutes();
  var h = d.getHours();

  if(m<10) {
	  var m = "0".concat(m);
  }
  if(h<10) {
	  var h = "0".concat(h);
  }
  $("#time").val("".concat(h).concat(":").concat(m));
  
});

Date.prototype.toDateInputValue = (function() {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0,10);
});

function Domicile(domicilio) {
	if(domicilio==1) {
		$("#domicilioSelected").show();
	} else {
		$("#domicilioSelected").hide();
		$("#indirizzoSelected").hide();
	}
}

function Address(address) {
	if(address==1) {
		$("#indirizzoSelected").show();
	} else {
		alert("Geolocalization...");
		Geolocalization();
		$("#indirizzoSelected").hide();
	}
}



</script>