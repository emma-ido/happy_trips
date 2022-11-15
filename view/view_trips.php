<?php
include_once("../settings/core.php");
include_once("../controllers/trip_controller.php");
include_once("../controllers/bus_controller.php");

$found_trips = array();
if(isset($_POST["find_trips"])) {

	$travelling_from = $_POST["travelling_from"];
	$travelling_to = $_POST["travelling_to"];
	$departure_date = $_POST["departure_date"];
	$has_return = $_POST["has_return"];

	$origin = get_destination($travelling_from);
	$destination = get_destination($travelling_to);

	// echo "FROM: $travelling_from, TO: $travelling_to<br>";

	// $found_trips = array();
	if($has_return === "NO") {
		$found_trips = get_one_way_trips($travelling_from, $travelling_to, $departure_date);
		// print_r($found_trips);
	}

 
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Found Trips</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
	<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
	<?php include_once("../settings/navbar.php"); ?>

	<script type="text/javascript" src="../js/general.js"></script>
	<script type="text/javascript" src="../js/trips.js"></script>
<!-- example icon --><!-- 
<i data-feather="star"></i>
<i data-feather="square"></i>
<i data-feather="bell"></i>
<i data-feather="award"></i> -->
	<br>

	<div class="container">
		<?php echo "<h4>$origin --> $destination</h4>"; ?>
		<div class="row">
			<div class='card' style="width: 100%;">
				<div class='card-body'>
					<?php
					echo "
					<span class='font-weight-bold'>SELECT YOUR TRIP</span>
					";
					?>

					<?php
					if(count($found_trips) == 0) {
						echo "<span class='font-weight-bold'>No trips found</span>";
					}
					foreach ($found_trips as $trip) {
						$trip_id = $trip["id"];
						$type = $trip['trip_type'];
						$price = $trip['price'];
						$seats_left = $trip['seats_available'];
						$departure_time = $trip['departure_time'];
						$departure_time = explode(" ", $departure_time)[1];
						$bus_id = $trip['bus_id'];
						$bus_image = get_bus_image($bus_id);
						$html = "
						<hr>
						<div class='row'>
							<div class='col'>
								<img src='$bus_image' style='max-height: 130px;'>
							</div>
							<div class='col'>
								<span class='card-text'>
								TYPE: <span class='font-weight-bold'>$type</span><br>
							
								<ion-icon name='briefcase'></ion-icon> LUGGAGE: <span class='font-weight-bold'>30KG</span><br>
								<ion-icon name='bus'></ion-icon> SEATS AVAILABLE: <span class='font-weight-bold'>$seats_left</span>
								</span><br>
								<ion-icon name='time'></ion-icon> <span class='font-weight-bold'>$departure_time</span>
							</div>
							<div class='col-3' style='text-align: center;'>
								<br>
								<h4 class='font-weight-bold'>GHC $price</h4>";
						if(!isLoggedIn()) {
							$html .= "<button onclick='loginWarning()' class='btn btn-info'>BOOK</button>";
						} else {
							$html .= "
							<form method='POST' action='get_available_seats.php'>
							<input type='hidden' name='trip_id' value='$trip_id'>
							<button class='btn btn-info' type='submit'>BOOK</button>
							</form>";
						}
						
						$html .= "</div></div>";
						echo $html;
					}
					?>
				</div>
			</div>
		</div>
	</div>


<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script>
feather.replace()
</script>
</body>
</html>
<?php
} else {
	header("Location: trips.php");
}

?>