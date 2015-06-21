<?php
	include("conn.php");

	if(isLoggedIn())
	{
		die("You are already logged in as " . $_SESSION["email"]);
	}

	if(!isset($_POST["email"])) loginFailed("Email empty!");
	if(!isset($_POST["password"])) loginFailed("Password empty!");

	$email = $_POST["email"];
	$password = $_POST["password"];

	if($stmt = $conn->prepare("SELECT `id`, `password` FROM `" . $database . "`.`users` WHERE `email` = ?"))
	{
		$stmt->bind_param("s", $email);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($id, $hash);
		$stmt->fetch();

		if($hash == crypt($password, $hash))
		{
			$_SESSION["id"] = $id;
			$_SESSION["email"] = $email;
			header("LOCATION: ../login.php");
		}
		else
		{
			loginFailed("Incorrect password!");
		}
	}
	else
	{
		loginFailed("Email not found!");
	}

	function loginFailed($reason)
	{
		$_SESSION["login_error"] = $reason;
		header("LOCATION: ../login.php");
	}
?>