<?php
	
function connect() {

$servername="localhost";
	$username ="root";
	$password ="";
	$database = "dbfp";
	//connessione al db
	$conn =new mysqli($servername, $username, $password, $database);
	//Check della connessione
	if ($conn->connect_errno) {
		echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
	}
	return $conn;
}
?>