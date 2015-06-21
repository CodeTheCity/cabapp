<?php
	session_start();

	$database = "u01rao14_cabapp";
	$conn = new mysqli("mysql.abdn.ac.uk", "u01rao14_cabapp" ,"password", "u01rao14_cabapp");

	if($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}

	function isLoggedIn()
	{
		return isset($_SESSION["id"]);
	}
?>