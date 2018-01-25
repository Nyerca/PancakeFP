<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<html>
<head>
<script type="text/javascript">
function showMoreDesc(id) {
      $('#' + id).toggle(400)
}
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
	
}
	
?>
</div>


























<div class="container">

						<?php

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
					
					
							<div id="<?php echo $row2["Name"]; ?>" class="btn-group col-md-3 col-sm-6 col-xs-12">
									<div class="thumbnail">
									<p><?php echo $row2["Price"]; ?></p>
									 <?php echo '<img height="20" src="' . htmlspecialchars($row2["Photo"]) . '"/>'; ?>
									  <div class="caption">
											<div class="contentInline clearfix">
												  <div class="responsive contentPart">
														<div class="clearfix">
															  <h3 class="pull-left"><?php echo $row2["Name"]; ?></h3>
														</div>
												  </div>
												  <div class="responsive cartPart">
														<div class="clearfix pull-right">
															  <button id="<?php echo $row2["IDItem"]; ?>" onclick="insert('<?php echo $email;?>','<?php echo $row2["IDItem"]; ?>','<?php echo $row["Amount"] + 1; ?>')" class="btn btn-sm btn-primary addRemoveButton addButton addButton">+</button>
															  <span>
																	<?php echo $row["Amount"]?>
															  </span>
															  <button id="<?php echo $row2["IDItem"]; ?>" onclick="insert('<?php echo $email;?>','<?php echo $row2["IDItem"]; ?>','<?php echo $row["Amount"] - 1; ?>')" class="btn btn-sm btn-default addRemoveButton removeButton">-</button>
														</div>
												  </div>
											</div>
									  </div>
								</div>
							</div>
<?php
					}
				}
					?>
			</div>
			<?php
		}
	}

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
						
							<div id="<?php echo $row2r["RoyalName"]; ?>" class="btn-group col-md-3 col-sm-6 col-xs-12">
									<div class="thumbnail">
									<p><?php echo getRoyalPrice($rowr["IDRoyalPancake"],1,1,1); ?></p>
									  <?php echo '<img height="20" src="' . htmlspecialchars($row2r["Photo"]) . '"/>'; ?>
									  <div class="caption">
											<div class="contentInline clearfix">
												  <div class="responsive contentPart">
														<div class="clearfix">
														<button id="<?php echo $row2r["RoyalName"]; ?>" type="button" onclick="popRoyal('<?php echo $row2r["IDRoyalPancake"]; ?>', '<?php echo $rowr["Note"]; ?>')">
									TMPP
								</button>	
															  <h3 class="pull-left"><?php echo $row2r["RoyalName"]; ?></h3>
														</div>
														<p class="foodDesc">
															  <a href="javascript:void(0)" onclick="showMoreDesc('moreDesc4')">Description</a>
														</p>
												  </div>
												  <div class="responsive cartPart">
														<div class="clearfix pull-right">
															  <button id="<?php echo $row2r["IDRoyalPancake"];?>" onclick="insertRoyal('<?php echo $email;?>','<?php echo $row2r["IDRoyalPancake"]; ?>',<?php echo $rowr["Amount"] + 1;?>, '<?php echo $rowr["Note"]; ?>')" class="btn btn-sm btn-primary addRemoveButton addButton addButton">+</button>
															  <span>
																	<?php echo $rowr["Amount"]?>
															  </span>
															  <button id="<?php echo $row2r["IDRoyalPancake"];?>" onclick="insertRoyal('<?php echo $email;?>','<?php echo $row2r["IDRoyalPancake"]; ?>',<?php echo $rowr["Amount"] - 1;?>, '<?php echo $rowr["Note"]; ?>')" class="btn btn-sm btn-default addRemoveButton removeButton">-</button>
														</div>
												  </div>
											</div>
									  </div>
									  <div class="foodMoreDesc" id="moreDesc4">
                              <a href="javascript:void(0)" onclick="showMoreDesc('moreDesc4')">
                                    <span class="closeDesc">
                                          <i class="fa fa-times"></i> Close
                                    </span>
                              </a>
                              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.
                        </div>
								</div>
							</div>
						
<?php
					}
				}
			?>
			</div>
		<?php
		}
	}
	if(!empty($_SESSION["cart"])) {	
	$u = unserialize($_SESSION["cart"]);
	foreach ($u->getArrayItem() as $item) {
		?>
		<div id="id <?php echo $item->getName();?>" class="btn-group col-md-3 col-sm-6 col-xs-12">
									<div class="thumbnail">
									<p><?php echo $item->getPrice(); ?></p>
									 <?php echo '<img height="20" width="20" src="' . htmlspecialchars($item->getPhoto()) . '"/>'; ?>
									  <div class="caption">
											<div class="contentInline clearfix">
												  <div class="responsive contentPart">
														<div class="clearfix">
															  <h3 class="pull-left"><?php echo $item->getName(); ?></h3>
														</div>
												  </div>
												  <div class="responsive cartPart">
														<div class="clearfix pull-right">
															  <button id="<?php echo $item->getItem(); ?>" onclick="insertOffline('<?php echo $item->getItem(); ?>',<?php echo $item->getAmount() + 1; ?>)" class="btn btn-sm btn-primary addRemoveButton addButton addButton">+</button>
															  <span>
																	<?php echo $item->getAmount();?>
															  </span>
															  <button id="<?php echo $item->getItem(); ?>" onclick="insertOffline('<?php echo $item->getItem(); ?>',<?php echo $item->getAmount() - 1; ?>)" class="btn btn-sm btn-default addRemoveButton removeButton">-</button>
														</div>
												  </div>
											</div>
									  </div>
								</div>
							</div>
		<?php
	}
	
	foreach ($u->getArrayRoyal() as $item) {
		?>
				<div id="id <?php echo $item->getName();?>" class="btn-group col-md-3 col-sm-6 col-xs-12">
									<div class="thumbnail">
									<p><?php echo $item->getPrice(); ?></p>
									 <?php echo '<img height="20" width="20" src="' . htmlspecialchars($item->getPhoto()) . '"/>'; ?>
									  <div class="caption">
											<div class="contentInline clearfix">
												  <div class="responsive contentPart">
														<div class="clearfix">
														<button id="<?php echo $item->getName(); ?>" type="button" onclick="popRoyal('<?php echo $item->getItem(); ?>', '<?php echo $item->getNote(); ?>')">
									TMPP
								</button>	
															  <h3 class="pull-left"><?php echo $item->getName(); ?></h3>
														</div>
														<p class="foodDesc">
															  <a href="javascript:void(0)" onclick="showMoreDesc('moreDesc4')">Description</a>
														</p>
												  </div>
												  <div class="responsive cartPart">
														<div class="clearfix pull-right">
															  <button id="<?php echo $item->getItem(); ?>" onclick="insertRoyalOffline('<?php echo $item->getItem(); ?>'<?php echo $item->getAmount() + 1; ?>, '<?php echo $item->getNote(); ?>')" class="btn btn-sm btn-primary addRemoveButton addButton addButton">+</button>
															  <span>
																	<?php echo $item->getAmount();?>
															  </span>
															  <button id="<?php echo $item->getItem(); ?>" onclick="insertRoyalOffline('<?php echo $item->getItem(); ?>'<?php echo $item->getAmount() - 1; ?>, '<?php echo $item->getNote(); ?>')" class="btn btn-sm btn-default addRemoveButton removeButton">-</button>
														</div>
												  </div>
											</div>
									  </div>
									  <div class="foodMoreDesc" id="moreDesc4">
                              <a href="javascript:void(0)" onclick="showMoreDesc('moreDesc4')">
                                    <span class="closeDesc">
                                          <i class="fa fa-times"></i> Close
                                    </span>
                              </a>
                              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.
                        </div>
								</div>
								</div>
		<?php
	}
	$s = serialize($u);
	}
?>




</div>


</body>
</html>