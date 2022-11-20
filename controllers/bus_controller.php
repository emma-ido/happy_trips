<?php
include_once("../classes/bus_class.php");


function get_all_busses() {
	$bus = new Bus();
	return $bus->get_all_buses();
}

function get_all_bus_makes() {
	$bus = new Bus();
	return $bus->get_all_bus_makes();
}

function add_new_bus_make($make) {
	$bus = new Bus();
	return $bus->new_bus_make($make);
}

function add_new_bus($capacity, $make, $weight_limit, $plate_number) {
	$bus = new Bus();
	return $bus->new_bus($capacity, $make, $weight_limit, $plate_number);
}


function get_bus_make($bus_id) {
	$bus = new Bus();
	return $bus->get_bus_make($bus_id);
}

function get_bus_image($bus_id) {
	$bus = new Bus();
	return $bus->get_bus_image($bus_id);
}

// add_new_bus_make("SUBARU Coach RTX4");
// get_all_busses();
// add_new_bus(20, "SUBARU Coach RTX4", 35, "ASD-28920");
// get_all_busses();
?>