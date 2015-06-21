<?php
	include("conn.php");

	if(isLoggedIn())
	{
		registerFailed("You are already logged in as " . $_SESSION["email"]);
	}

	$domain_whitelist = array("abdn.ac.uk", "aberdeen.ac.uk");

	if(!isset($_POST["forename"])) registerFailed("Forename empty");
	if(!isset($_POST["surname"])) registerFailed("Surname empty");
	if(!isset($_POST["email"])) registerFailed("Email empty");
	if(!isset($_POST["password"])) registerFailed("Password empty");

	$forename = $_POST["forename"];
	$surname = $_POST["surname"];
	$email = $_POST["email"];
	$password = $_POST["password"];

	if(empty($forename)) registerFailed("Forename empty");
	if(empty($surname)) registerFailed("Surname empty");
	if(empty($email)) registerFailed("Email empty");
	if(empty($password)) registerFailed("Password empty");

	if(validateEmail($email, $domain_whitelist)) registerFailed("Email invalid");
	validatePassword($password);

	if($stmt = $conn->prepare("INSERT INTO `" . $database . "`.`users` (`forename`, `surname`, `email`, `password`) VALUES (?, ?, ?, ?);"))
	{
		$cost = 10;
		$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
		$salt = sprintf("$2a$%02d$", $cost) . $salt;
		$hash = crypt($password, $salt);

		$stmt->bind_param("ssss", $forename, $surname, $email, $hash);
		$stmt->execute();
		$stmt->close();

		$_SESSION["register_success"] = true;
		header("LOCATION: ../login.php");
	}
	else
	{
		registerFailed("Registration failed! The email submitted may be in use.");
	}

	function validateEmail($email, $domains)
	{
		if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) return false;

		// TODO: domain check.
	}

	function validatePassword($password)
	{
		if(strlen($password) < 6) registerFailed("Password too short!");
		if(!preg_match("#[0-9]+#", $password)) registerFailed("Password must include at least one number!");
		if(!preg_match("#[a-zA-Z]+#", $password)) registerFailed("Password must include at least one letter!");
	}

	function registerFailed($reason)
	{
		$_SESSION["register_error"] = $reason;
		header("LOCATION: ../login.php");
		die();
	}
?>