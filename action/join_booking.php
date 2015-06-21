<?php
	include("conn.php");

	if(!isLoggedIn())
	{
		die("You must be logged in to do this!");
	}

	if(!isset($_GET["booking_id"])) die("Booking ID empty");

	$booking_id = $_GET["booking_id"];
	$user_id = $_SESSION["id"];

	if($stmt = $conn->prepare("INSERT INTO `" . $database . "`.`join_booking` (`booking_id`, `user_id`) VALUES (?, ?);"))
	{
		$stmt->bind_param("ss", $booking_id, $user_id);
		$stmt->execute();
		$stmt->close();
		die("Join done!");
	}
	else
	{
		die("Join failed!");
	}
?>