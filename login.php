<?php
	include("action/conn.php");
?>

<?php include("sidebar.php"); ?>

<?php if(isLoggedIn()): ?>
	<div class="row" >
	<div class="col-xs-6" id="register">
	<h1> You are already logged in! <a href="action/logout.php">Logout</a> </h1>
	</div>
	</div>
<?php else: ?>
	<div class="row" >
	<div class="col-xs-6" id="login">
	<h1> login </h1>
	<?php if(isset($_SESSION["login_error"])): ?><h5 style="text-align: center;"><?php echo($_SESSION["login_error"]); unset($_SESSION["login_error"]); ?></h5><?php endif; ?>
	<form action="action/login.php" method="POST">
		E-mail:<br>
		<input type="email" name="email">
		<br>
		Password: <br>
		<input type="password" name="password">
		<br><br>
		<input type="submit" value="Login">
	</form> 

	</div>
	<div class="col-xs-6" id="register">
	<h1> register </h1>
	<?php if(isset($_SESSION["register_error"])): ?><h5 style="text-align: center;"><?php echo($_SESSION["register_error"]); unset($_SESSION["register_error"]); ?></h5><?php endif; ?>
	<?php if(isset($_SESSION["register_success"])): ?><h5 style="text-align: center;"><?php echo("Successfully registered!"); unset($_SESSION["register_success"]); ?></h5><?php endif; ?>
	<form action="action/register.php" method="POST">
	Forename:<br>
	<input type="text" name="forename" value="">
	<br>
	Surname:<br>
	<input type="text" name="surname" value="">
	<br>
	E-mail:<br>
	<input type="email" name="email">
	<br>
	Password: <br>
	<input type="password" name="password">
	<br>
	Confirm Password: <br>
	<input type="password" name="cpassword">
	<br><br>
	<input type="submit" value="Submit">

	</form>

	</div>
	</div>
<?php endif; ?>