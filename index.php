<?php
	include("action/conn.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cabapp</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/simple-sidebar.css" rel="stylesheet">



</head>

<body>

    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="index.php">
                        Get started
                    </a>
                </li>
                <li>
                    <a href="login.php">login</a>
                </li>
                <li>
                    <a href="account.php">account</a>
                </li>
                <li>
                   <a href="create.php">create</a>
                </li>
                <li>
                     <a href="search.php">search</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

       <!--  Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12">
                      
						 <h1 id="title">Cab app</h1>
						<img src="picture.jpg" alt="banner" id="banner"  height="250" width="250">
						<h1 id="header"> Destination </h1>
						<div class="row">
							<div class="col-xs-6" id="train-feed">
								<h2> Train Station </h2>
								<div class="post">
								
								<div class="table-responsive"> 
									<table class="table" >
										<tr>
											<td>Booking ID</td>
											<td>Date/Time</td>
											<td>Departing From</td>
											<td>Arriving At</td>
											<td>Booked By</td>
											<td>Joiners</td>
											<td>Total Seats</td>
											<td>Confirmed</td>
											<td>Join</td>
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
												echo("<td><a href='action/join_booking.php?booking_id=" . $id . "'>Join</a></td>");

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
							<div class="col-xs-6" id="airport-feed">
								<h2>Airport</h2>
								<div class="post">
								<div class="table-responsive"> 
								<table class="table">
									<tr>
										<td>Booking ID</td>
										<td>Date/Time</td>
										<td>Departing From</td>
										<td>Arriving At</td>
										<td>Booked By</td>
										<td>Joiners</td>
										<td>Total Seats</td>
										<td>Confirmed</td>
										<td>Join</td>
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
								echo("<td><a href='action/join_booking.php?booking_id=" . $id . "'>Join</a></td>");

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
						</div>
                        
                        <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
						
						
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

</body>

</html>


<div> 

<p> </p>
</div>
