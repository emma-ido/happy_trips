<?php
include_once("../classes/trip_class.php");


function get_one_way_trips($origin, $destination, $departure_time) {
	$trip = new Trip();
	return $trip->get_one_way_trips($origin, $destination, $departure_time);
}

function get_trip($trip_id) {
	$trip = new Trip();
	return $trip->get_trip_by_id($trip_id);
}

function get_all_destinations() {
	$trip = new Trip();
	return $trip->get_all_destinations();
}

function get_destination($id) {
	$trip = new Trip();
	return $trip->get_destination_by_id($id);
}

function get_available_seat_numbers($trip_id) {
	$trip = new Trip();
	return $trip->get_available_seat_numbers($trip_id);
}

function get_available_seat_numbers_speacial($trip_id) {
	$trip = new Trip();
	return $trip->get_available_seat_numbers_speacial($trip_id);
}
?>