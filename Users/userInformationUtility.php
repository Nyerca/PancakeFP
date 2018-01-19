<?php
require_once 'dbConnection.php';
require_once 'imagesFunctions.php';
function getAllUserInfos($email) {
	$conn =connect();
	$sql = "SELECT * from Users WHERE Email = '".$email."'";
	$result = $conn->query($sql);
	return $result;
}

function updateTelephone($email, $tel) {
	$conn =connect();
	$sql = "UPDATE Users SET PhoneNumber ='".$tel."' WHERE Email = '".$email."'";
	$conn->query($sql);
}

function updateUsername($email, $usr) {
	$conn =connect();
	$sql = "UPDATE Users SET Username ='".$usr."' WHERE Email = '".$email."'";
	$conn->query($sql);
}

function updateEmail($email, $emailN) {
	$conn =connect();
	$sql = "UPDATE Users SET Email ='".$emailN."' WHERE Email = '".$email."'";
	$conn->query($sql);
}

function updatePassword($email, $pO, $pN, $pNr) {
	if($pN == $pNr) {
		
		$conn =connect();
		$sql = "SELECT Password from Users WHERE Email = '".$email."'";
		$result = $conn->query($sql);
		if($result->num_rows > 0)	{
			while($row = $result->fetch_assoc()) {
				$curr = $row["Password"];
				if($curr == $pO) {
					$sql2 = "UPDATE Users SET Password ='".$pN."' WHERE Email = '".$email."'";
					$conn->query($sql2);
				}
			}
		}
	}
}

function saveUserPhoto($email, $file) {
	$conn =connect();
	$target = savePhoto($file);
	$sql = "UPDATE users SET Photo = '".$target."' WHERE Email = '".$email."'";
	$conn->query($sql);
}

function getUserPhoto($email) {
	$conn =connect();
	$target = savePhoto($file);
	$sql = "SELECT Photo FROM users WHERE Email = '".$email."'";
	$result = $conn->query($sql);
	if($result->num_rows > 0)	{
		while($row = $result->fetch_assoc()) {
			return $row["Photo"];
		}
	}
	return -1;
}

?>