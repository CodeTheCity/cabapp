<?php
	include("conn.php");

	if(!isLoggedIn())
	{
		die("You must be logged in to do this!");
	}

	if(!isset($_POST["end_location"])) die("Destination empty");
	if(!isset($_POST["date"])) die("Date empty");
	if(!isset($_POST["time"])) die("Time empty");

	$end_location = $_POST["end_location"];
	$date = $_POST["date"];
	$time = $_POST["time"];

	$datetime = $date . " " . $time . ":00";

	if(empty($end_location)) die("Arriving At empty");

	if($stmt = $conn->prepare("INSERT INTO `" . $database . "`.`booking` (`end_location`, `time`, `creator_id`) VALUES (?, ?, ?);"))
	{
		$stmt->bind_param("sss", $end_location, $datetime, $_SESSION["id"]);
		$stmt->execute();
		$stmt->close();
		die("Booking created!");
	}
	else
	{
		die("Booking failed!");
	}
?>