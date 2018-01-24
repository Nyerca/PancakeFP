<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<html>
<head>
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
</head>
<body>
<div class="listinoSearch">
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'dbConnection.php';
require_once 'cart.php';
echo "HEHE";

	$conn = connect();
	if(!empty($_SESSION['user'])) {
		$email = $_SESSION['user']["email"];
		if(isset($_GET['inc'])) {
			if(!isset($_GET['royals'])) {
				searchForActiveOrder($email, $_GET['itemChange'], 1);
			} else {
				searchForActiveOrderRoyal($email, $_GET['itemChange'], 1, 111);
			}
		}
	} else {
		$email = "";
	}

	$result = getItemInOrder($email);
	if($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
		?>
			<div id="divIt">
			<?php
				$sql2 = "SELECT * from item WHERE IDItem = ".$row["IDItem"];
				$result2 = $conn->query($sql2);
				if($result2->num_rows > 0) {
					while($row2 = $result2->fetch_assoc()) {
					?>
						<form>
							<div id="id <?php echo $row2["Name"]; ?>" class="row">
								<div class="col-xs-12 col-sm-5">
									<?php echo '<img height="60" src="' . htmlspecialchars($row2["Photo"]) . '"/>'; ?>
									<p><?php echo $row2["Name"]; ?></p>
								</div>
								<div class="col-xs-6 col-sm-4">
									<p><?php echo $row2["Price"]; ?></p>
								</div>
								<div class="col-xs-6 col-sm-3">
									<input min="0" onclick="ifZero(this)" class="hiddenToZero" id="<?php echo $row2["IDItem"]; ?>" type="number" onchange="insert('<?php echo $email;?>','<?php echo $row2["IDItem"]; ?>',this.value)" value="<?php echo $row["Amount"]?>">
								</div>
							</div>
						</form>
<?php
					}
				}
					?>
			</div>
			<?php
		}
	}
	echo "HEHE2";
	$resultr = getRoyalInOrder($email);
	if($resultr->num_rows > 0) {
		while($rowr = $resultr->fetch_assoc()) {
		?>
			<div id="divRo">
			<?php
				$sql2r = "SELECT * from royalpancake WHERE IDRoyalPancake = ".$rowr["IDRoyalPancake"];
				$result2r = $conn->query($sql2r);
				if($result2r->num_rows > 0) {
					while($row2r = $result2r->fetch_assoc()) {
?>
						<form>
							<div id="<?php echo $row2r["RoyalName"]; ?>" class="row">
								<button id="<?php echo $row2r["RoyalName"]; ?>" type="button" onclick="popRoyal('<?php echo $row2r["IDRoyalPancake"]; ?>', '<?php echo $rowr["Note"]; ?>')">
									<?php echo '<img height="60" src="' . htmlspecialchars($row2r["Photo"]) . '"/>'; ?>
									<p><?php echo $row2r["RoyalName"]; ?></p>
									<p><?php echo getRoyalPrice($rowr["IDRoyalPancake"],1,1,1); ?></p>
								</button>									
								<?php echo "LE NOTE SONO: ".$rowr["Note"]."<br/>";?>
								<div class="col-xs-6 col-sm-3">
									<input min="0" onclick="ifZero(this)" class="hiddenToZero" id="<?php echo $row2r["IDRoyalPancake"]; ?>" type="number" onchange="insertRoyal('<?php echo $email;?>','<?php echo $row2r["IDRoyalPancake"]; ?>',this.value, '<?php echo $rowr["Note"]; ?>')" value="<?php echo $rowr["Amount"]?>">
								</div>
							</div>
						</form>
<?php
					}
				}
			?>
			</div>
		<?php
		}
	}
	echo "HEHE3";

if(!empty($_SESSION["cart"])) {	

	if(isset($_GET['inc'])) {

		if(isset($_GET['royals'])) {
			echo "inc royal";
			$conn =connect();
			$sql2 = "SELECT * from royalpancake WHERE IDRoyalPancake = ".$_GET['itemChange'];
			$result2 = $conn->query($sql2);
			if($result2->num_rows > 0) {
				while($row2 = $result2->fetch_assoc()) {
					$item = new Royal($_GET['itemChange'], $row2["RoyalName"], getRoyalPrice($_GET['itemChange'], 1,1,1));
					$u = unserialize($_SESSION["cart"]);
					$u->addItem($item, 1, "111");
					$s = serialize($u);
					$_SESSION["cart"] = $s;
				}
			}
		} else {
			echo "inc ITEM";
			$conn =connect();
			$sql2 = "SELECT * from item WHERE IDItem = ".$_GET['itemChange'];
			$result2 = $conn->query($sql2);
			if($result2->num_rows > 0) {
				while($row2 = $result2->fetch_assoc()) {
					$item = new Item($_GET['itemChange'], $row2["Name"], $row2["Price"]);
					$u = unserialize($_SESSION["cart"]);
					$u->addItem($item, 1, "");
					$s = serialize($u);
					$_SESSION["cart"] = $s;
				}
			}
		}
		
				$u = unserialize($_SESSION["cart"]);
	}
	$u = unserialize($_SESSION["cart"]);
	foreach ($u->getArrayItem() as $item) {
		?>
		<form>
			<div id="id <?php echo $item->getName();?>" class="row">
				<div class="col-xs-12 col-sm-5">
					<?php echo '<img height="60" src="' . htmlspecialchars($item->getPhoto()) . '"/>'; ?>
					<p><?php echo $item->getName(); ?></p>
				</div>
				<div class="col-xs-6 col-sm-4">
					<p><?php echo $item->getPrice(); ?></p>
				</div>
				<div class="col-xs-6 col-sm-3">
					<input min="0" onclick="ifZero(this)" class="hiddenToZero" id="<?php echo $item->getItem(); ?>" type="number" onchange="insertOffline('<?php echo $item->getItem(); ?>',this.value)" value="<?php echo $item->getAmount(); ?>">
				</div>
			</div>
		</form>
		<?php
	}
	
	foreach ($u->getArrayRoyal() as $item) {
		?>
		<form>
			<div id="<?php echo $item->getName(); ?>" class="row">
				<button id="<?php echo $item->getName(); ?>" type="button" onclick="popRoyal('<?php echo $item->getItem(); ?>', '<?php echo $item->getNote(); ?>')">
					<?php echo '<img height="60" src="' . htmlspecialchars($item->getPhoto()) . '"/>'; ?>
					<p><?php echo $item->getName(); ?></p>
					<p><?php echo $item->getPrice(); ?></p>
				</button>	
				
				<?php echo $item->getNote();?>
								
				<div class="col-xs-6 col-sm-3">
					<input min="0" onclick="ifZero(this)" class="hiddenToZero" id="<?php echo $item->getItem(); ?>" type="number" onchange="insertRoyalOffline('<?php echo $item->getItem(); ?>',this.value, '<?php echo $item->getNote(); ?>')" value="<?php echo $item->getAmount(); ?>">
				</div>
			</div>
		</form>
		<?php
	}
	$s = serialize($u);
}
	
?>
</div>
</body>
</html>