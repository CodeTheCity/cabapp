<?php
	include("action/conn.php");
?>

<?php include("sidebar.php"); ?>

<form action="action/create_booking.php" method="POST" id="form">
Destination:<br>
<select name="end_location">
  <option value="Train Station">Train Station</option>
  <option value="Airport">Airport</option>
</select>
<br>
Date: <br>
<input type="date" name="date">
<br>
Time: <br>
<input type="time" name="time">
<br><br>
<input type="submit" value="submit">
</form> 