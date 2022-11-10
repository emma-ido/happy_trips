<?php
include_once("../classes/bus_class.php");


function get_all_busses() {
	echo "<h1>Attempting to create a new bus</h1><br>";

	$bus = new Bus();
	print_r($bus->get_all_buses());

	
}

function get_all_bus_makes() {
	$bus = new Bus();
	print_r($bus->get_all_bus_makes());
}

function add_new_bus_make($make) {
	$bus = new Bus();
	$bus->new_bus_make($make);
}

function add_new_bus($capacity, $make, $weight_limit, $plate_number) {
	$bus = new Bus();
	$bus->new_bus($capacity, $make, $weight_limit, $plate_number);
}

add_new_bus_make("SUBARU Coach RTX4");
get_all_busses();
add_new_bus(20, "SUBARU Coach RTX4", 35, "ASD-28920");
get_all_busses();
?>