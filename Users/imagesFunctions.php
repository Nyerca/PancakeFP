<?php
require_once 'dbConnection.php';

function savePhoto($file) {
	$target='res/'.basename($file['name']);
	move_uploaded_file($file['tmp_name'],$target);
	return $target;
}

function getPhoto($target) {
	return '<img src="' . htmlspecialchars($target) . '"/>';
}

function getSrc($target) {
	return htmlspecialchars($target);
}
 ?>

 