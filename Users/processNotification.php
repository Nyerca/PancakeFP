<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'notification.php';
echo setProcessed($_SESSION['user']["email"]);
?>