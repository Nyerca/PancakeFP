<?php
require_once 'dbConnection.php';
require_once 'imagesFunctions.php';
function getAvg() {
	$conn =connect();
	$sql = "SELECT AVG(Vote) as average FROM review";
	$result = $conn->query($sql);
	if($result->num_rows > 0)	{
		while($row = $result->fetch_assoc()) {
			return $row["average"];
		}
	}
}
function getReviewsNumber() {
	$conn =connect();
	$sql = "SELECT COUNT(*) AS number FROM review";
	$result = $conn->query($sql);
	if($result->num_rows > 0)	{
		while($row = $result->fetch_assoc()) {
			return $row["number"];
		}
	}
}
function getStarPercentage($star) {
	$allReviews = getReviewsNumber();
	$conn =connect();
	$sql = "SELECT COUNT(*) AS number FROM review WHERE Vote=".$star;
	$result = $conn->query($sql);
	if($result->num_rows > 0)	{
		while($row = $result->fetch_assoc()) {
			return ($row["number"] * 100) / $allReviews;
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