<?php
include_once("../controllers/trip_controller.php");
include_once("../controllers/bus_controller.php");


function get_destination_options() {
	$destinations = get_all_destinations();
	$html = "";
	// print_r($destinations);
	foreach($destinations as $destination) {
		$html = $html. "<option value='$destination[id]'>$destination[destination_name]</option>";
	}
	echo $html;
}


function get_bus_options() {
	$buses = get_all_busses();
	$html = "";
	foreach ($buses as $bus) {
		$bus_make = $bus["make"];
		$capacity = $bus["capacity"];
		$plate_number = $bus["plate_number"];
		$bus_id = $bus["id"];

		$html = $html. "<option value='$bus_id'>Make: $bus_make, Plate: $plate_number, Capacity: $capacity</option>";
	}

	echo $html;
}

function get_trip_type_options() {
	$trip_types = get_trip_types();
	$html = "";
	foreach ($trip_types as $trip_type) {
		$html = $html. "<option value='$trip_type[trip_type]'>$trip_type[trip_type]</option>";
	}
	echo $html;
}



?>