<?php
require_once 'dbConnection.php';
require_once 'cart.php';
	updateQuantityInOrder($_GET['eml'], $_GET['idItm'], $_GET['amt']);
?>
