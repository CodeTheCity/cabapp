<?php
	include("action/conn.php");
?>

<form action="action_page.php">
Destination:<br>
<select>
  <option value="trainstation">Train Station</option>
  <option value="airport">Airport</option>
</select>
<br>
Date: <br>
<input type="date" name="dateleaving">
<br>
Time: <br>
<input type="time" name="timeleaving">
<br><br>
<input type="submit" value="submit">
</form> 