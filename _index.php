<?php
	include("action/conn.php");
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>Cabapp</title>

		<link href="css/home.css" rel="stylesheet">
	</head>

	<body>
		<?php include("sidebar.php"); ?>

		<div id="container">
			<div class="row">
				<div class="col-xs-6">
					<h2>Train Station</h2>
					<table>
						<tr>
							<td>Booking ID</td>
							<td>Date/Time</td>
							<td>Departing From</td>
							<td>Arriving At</td>
							<td>Booked By</td>
							<td>Joiners</td>
							<td>Total Seats</td>
							<td>Confirmed</td>
						</tr>

						<?php
						if($stmt = $conn->prepare("SELECT `id`, `time`, `start_location`, `end_location`, `creator_id`, `confirmed`, `seats` FROM `" . $database . "`.`booking` WHERE `end_location` = 'Train Station'"))
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
								if($stmt2 = $conn->prepare("SELECT `email` FROM `" . $database . "`.`users` WHERE `id` = ?"))
								{
									$stmt2->bind_param("s", $creator_id);
									$stmt2->execute();
									$stmt2->store_result();
									$stmt2->bind_result($email);
									while($stmt2->fetch())
									{
										echo("<td>" . $email . "</td>");
										break;
									}
								}

								if($stmt1 = $conn->prepare("SELECT `user_id` FROM `" . $database . "`.`join_booking` WHERE booking_id = ?"))
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
				</div>

				<div class="col-xs-6">
					<h2>Airport</h2>
					<table>
						<tr>
							<td>Booking ID</td>
							<td>Date/Time</td>
							<td>Departing From</td>
							<td>Arriving At</td>
							<td>Booked By</td>
							<td>Joiners</td>
							<td>Total Seats</td>
							<td>Confirmed</td>
						</tr>

						<?php
						if($stmt = $conn->prepare("SELECT `id`, `time`, `start_location`, `end_location`, `creator_id`, `confirmed`, `seats` FROM `" . $database . "`.`booking` WHERE `end_location` = 'Airport'"))
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
								if($stmt2 = $conn->prepare("SELECT `email` FROM `" . $database . "`.`users` WHERE `id` = ?"))
								{
									$stmt2->bind_param("s", $creator_id);
									$stmt2->execute();
									$stmt2->store_result();
									$stmt2->bind_result($email);
									while($stmt2->fetch())
									{
										echo("<td>" . $email . "</td>");
										break;
									}
								}

								if($stmt1 = $conn->prepare("SELECT `user_id` FROM `" . $database . "`.`join_booking` WHERE booking_id = ?"))
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
				</div>
			</div>
		</div>
	</body>
</html>