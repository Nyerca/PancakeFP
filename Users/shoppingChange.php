<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'cart.php'; 


$email = $_SESSION['user']["email"];
$data = $_GET["data"];
updateOrderTime($email, $data);

if(isset($_GET["addr"]) && isset($_GET["cap"]))  {
	$addr = $_GET["addr"];
	$cap = $_GET["cap"];
	insertAddressInOrder($email, $addr, $cap);
}
if(isset($_GET["cc"]) && isset($_GET["owner"]) && isset($_GET["expire"]))  {
	$cardNumber = $_GET["cc"];
	$cardOwner = $_GET["owner"];
	$expireDate = $_GET["expire"];
	addCardInfos($email, $cardNumber, $cardOwner, $expireDate);
} else {
	setOrderAsBought($email);
}
  
?>