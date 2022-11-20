<?php
include_once("../classes/trip_class.php");


function new_trip($bus_id, $trip_type, $origin, $destination, $departure_time, $arrival_time, $price, $booking_status="open") {
	$trip = new Trip();
	return $trip->new_trip($bus_id, $trip_type, $origin, $destination, $departure_time, $arrival_time, $price, $booking_status);
}

function close_all_passed_trips() {
	$trip = new Trip();
	return $trip->close_all_passed_trips();
}

function get_one_way_trips($origin, $destination, $departure_time, $seats=1) {
	$trip = new Trip();
	return $trip->get_one_way_trips($origin, $destination, $departure_time, $seats);
}

function get_trip($trip_id) {
	$trip = new Trip();
	return $trip->get_trip_by_id($trip_id);
}

function get_all_destinations() {
	$trip = new Trip();
	return $trip->get_all_destinations();
}

function get_trip_types() {
	$trip = new Trip();
	return $trip->get_trip_types();
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