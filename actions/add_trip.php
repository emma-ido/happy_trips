<?php
include_once("../settings/core.php");
include_once("../controllers/trip_controller.php");


if(isset($_POST["new_trip"])) {

	$origin = $_POST['origin'];
	$destination = $_POST['destination'];
	$departure_time = $_POST['departure_time'];
	$arrival_time = $_POST['arrival_time'];
	$trip_type = $_POST['trip_type'];
	$bus = $_POST['bus'];
	$price = $_POST['price'];


	if(new_trip($bus, $trip_type, $origin, $destination, $departure_time, $arrival_time, $price, $booking_status="open")) {
		// do something
		header("Location: ../admin/add_trip_form.php?success=Successfuly added a new trip");
	}
}





?>