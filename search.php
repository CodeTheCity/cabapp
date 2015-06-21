<?php include("action/conn.php"); ?>

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
				if($stmt = $conn->prepare("SELECT `id`, `time`, `start_location`, `end_location`, `creator_id`, `confirmed`, `seats` FROM `" . $database . "`.`booking`"))
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