<?php
require_once 'dbConnection.php';
require_once 'cart.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
echo "&latitude=".$_GET["latitude"]."&longitude=".$_GET["longitude"]

?>
