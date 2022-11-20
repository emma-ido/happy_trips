<?php
include_once("../classes/ticket_class.php");


function book_ticket($customer_id, $trip_id, $price, $seats=1) {
	$ticket = new Ticket();
	return $ticket->book_ticket($customer_id, $trip_id, $price, $seats);
}

function get_last_ticket_id($customer_id) {
	$ticket = new Ticket();
	return $ticket->get_last_id($customer_id);
}

function get_user_tickets($customer_id) {
	$ticket = new Ticket();
	return $ticket->get_user_tickets($customer_id);
}

function get_ticket_id($customer_id, $trip_id) {
	$ticket = new Ticket();
	return $ticket->get_ticket_id($customer_id, $trip_id);
}

function insert_ticket_seats($trip_id, $ticket_id, $seats) {
	$ticket = new Ticket();
	return $ticket->insert_ticket_seats($trip_id, $ticket_id, $seats);
}

function has_ticket($customer_id, $trip_id) {
	$ticket = new Ticket();
	return $ticket->has_ticket($customer_id, $trip_id);
}

function get_ticket_price($ticket_id) {
	$ticket = new Ticket();
	return $ticket->get_ticket_price($ticket_id);
}

function get_ticket_seats($ticket_id) {
	$ticket = new Ticket();
	return $ticket->get_ticket_seats($ticket_id);
}

function get_ticket_details($ticket_id) {
	$ticket = new Ticket();
	return $ticket->get_ticket_details($ticket_id);
}
?>