<?php 
include_once("../settings/db_class.php");
include_once("trip_class.php");



class Ticket extends db_connection {

	function book_ticket($customer_id, $trip_id, $price) {
		$trip = new Trip();
		if(!$trip->book_seat($trip_id)) {
			return false;
		}

		$sql = "INSERT INTO tickets(customer_id, trip_id, price) VALUES($customer_id, $trip_id, $price)";
		$booking_attempt = $this->db_query($sql);

		if(!$booking_attempt) {
			$trip->unbook_seat($trip_id);
			return false;
		} else {
			return true;
		}
	}


	function has_ticket($customer_id, $trip_id) {
		$sql = "SELECT COUNT(*) FROM tickets WHERE customer_id=$customer_id AND trip_id=$trip_id";
		return $this->db_fetch_one($sql)["COUNT(*)"] > 0;
	}

	function get_ticket_id($customer_id, $trip_id) {
		$sql = "SELECT * FROM tickets WHERE customer_id=$customer_id AND trip_id=$trip_id";
		return $this->db_fetch_one($sql)["id"];
	}

	function get_filled_seat_numbers($trip_id) {
		$sql = "SELECT seat_number FROM ticket_seats WHERE trip_id=$trip_id";
		$output = array();
		$seats = $this->db_fetch_all($sql);
		foreach($seats as $seat) {
			$output[] = $seat["seat_number"];
		}
		return $output;
	}

	function insert_ticket_seat($trip_id, $ticket_id, $seat_number) {
		$sql = "INSERT INTO ticket_seats(trip_id, ticket_id, seat_number) VALUES($trip_id, $ticket_id, '$seat_number')";
		return $this->db_query($sql);
	}

	function insert_ticket_seats($trip_id, $ticket_id, $seats) {
		foreach ($seats as $seat) {
			$this->insert_ticket_seat($trip_id, $ticket_id, $seat);
		}
		return true;
	}
}


// $trip = new Trip();
// $ticket = new Ticket();
// $booking_attempt = $ticket->book_ticket(1, 2, 'R2', 75);

// if($booking_attempt) {
// 	echo "YES";
// } else {
// 	echo "NO";
// }
// echo "<br>======<br>";
// print_r($ticket->get_filled_seat_numbers(2));

// echo "<br>=== AVAILABLE TRIP SEATS ===<br>";
// print_r($trip->get_available_seat_numbers(2));

?>