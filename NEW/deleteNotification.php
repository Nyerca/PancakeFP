<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'notification.php';
echo $_GET["notificationID"];
deleteNotificationNumber($_SESSION['user']["email"], $_GET["notificationID"]);
?>