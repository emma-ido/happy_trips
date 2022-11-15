<?php
include_once("../controllers/trip_controller.php");


function get_destination_options() {
	$destinations = get_all_destinations();
	$html = "";
	print_r($destinations);
	foreach($destinations as $destination) {
		$html = $html. "<option value='$destination[id]'>$destination[destination_name]</option>";
	}
	echo $html;
}



?>