<?php
require_once 'dbConnection.php';
require_once 'cart.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//$q = intval($_GET['q']);
if(!empty($_SESSION["cart"])) {
	$u = unserialize($_SESSION["cart"]);
	if(isset($_GET['note'])) {
		$u->printItems();
		$item = new Royal(intval($_GET['idItm']), "a", "1");
		$u->setItemAmount($item,$_GET['amt'], $_GET['note']);
		$u->printItems();
	} else {
		$u = unserialize($_SESSION["cart"]);
		$u->printItems();
		$item = new Item(intval($_GET['idItm']), "a", "1");
		$u->setItemAmount($item,$_GET['amt'], "");
		$u->printItems();
		
	}
	$s = serialize($u);
	$_SESSION["cart"] = $s;
}

?>
