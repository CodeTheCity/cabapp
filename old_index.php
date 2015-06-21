<?php
	include("action/conn.php");
?>

<!DOCTYPE>
<html>
	<head>
		<title>CabApp!</title>

		<style type="text/css">
			table
			{
				margin-bottom: 20px;
				width: 100%;
			}
			th, td
			{
				text-align: center;
			}
			input
			{
				width: 100%;
			}
			h2
			{
				margin-left: 30px;
			}
		</style>
	</head>

	<body>
		<?php if(!isLoggedIn()): ?>
		<table>
			<h2>Register</h2>
			<tr>
				<form method="POST" action="action/register.php">
					<td><input name="forename" type="text" placeholder="Forename" autofocus="true" /></td>
					<td><input name="surname" type="text" placeholder="Surname" /></td>
					<td><input name="email" type="text" placeholder="Email" /></td>
					<td><input name="password" type="password" placeholder="Password" /></td>
					<td><input type="submit" value="Submit" /></td>
				</form>
			</tr>
		</table>

		<table>
			<h2>Login</h2>
			<tr>
				<form method="POST" action="action/login.php">
					<td><input name="email" type="text" placeholder="Email" /></td>
					<td><input name="password" type="password" placeholder="Password" /></td>
					<td><input type="submit" value="Submit" /></td>
				</form>
			</tr>
		</table>
		<?php else: ?>
		<h1>You are logged in as <?php echo($_SESSION["email"]); ?>! <a href="action/logout.php">Logout</a></h1>
		<?php endif; ?>

		<table>
			<h2>Create Booking</h2>
			<tr>
				<form method="POST" action="action/create_booking.php">
					<td><input name="start_location" type="text" placeholder="Departing From" /></td>
					<td><input name="end_location" type="text" placeholder="Arriving At" /></td>
					<td><input name="seats" type="text" placeholder="Seats" /></td>
					<td><input type="submit" value="Submit" /></td>
				</form>
			</tr>
		</table>

		<table>
			<h2>Bookings</h2>
			<tr>
				<th>Booking ID</th>
				<th>Date/Time</th>
				<th>Departing From</th>
				<th>Arriving At</th>
				<th>Booked By</th>
				<th>Joiners</th>
				<th>Total Seats</th>
				<th>Confirmed</th>
			</tr>
			<?php
				if($stmt = $conn->prepare("SELECT `id`, `time`, `start_location`, `end_location`, `creator_id`, `confirmed`, `seats` FROM `cabapp`.`booking`"))
				{
					$stmt->execute();
					$stmt->store_result();
					$stmt->bind_result($id, $time, $start_location, $end_location, $creator_id, $confirmed, $seats);
					while($stmt->fetch())
					{
						echo("<tr>");
						echo("<td>" . $id . "</td>");
						echo("<td>" . $time . "</td>");
						echo("<td>" . $start_location . "</td>");
						echo("<td>" . $end_location . "</td>");
						echo("<td>" . $creator_id . "</td>");

						if($stmt1 = $conn->prepare("SELECT `user_id` FROM `cabapp`.`join_booking` WHERE booking_id = ?"))
						{
							$stmt1->bind_param("s", $id);
							$stmt1->execute();
							$stmt1->store_result();
							$stmt1->bind_result($user_id);

							echo("<td>");
							$first = true;
							while($stmt1->fetch())
							{
								if($first)
								{
									echo($user_id);
									$first = false;
								}
								else
								{
									echo(", " . $user_id);
								}
							}
							echo("</td>");
						}

						echo("<td>" . $seats . "</td>");
						echo("<td>" . $confirmed . "</td>");

						echo("</tr>"); 
					}
					$stmt->close();
				}
				else
				{
					echo("Failed to load bookings!");
				}
			?>
		</table>
	</body>
</html>