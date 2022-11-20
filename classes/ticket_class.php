<?php 
include_once("../settings/db_class.php");
include_once("trip_class.php");



class Ticket extends db_connection {

	function book_ticket($customer_id, $trip_id, $price, $seats=1) {
		$trip = new Trip();
		if(!$trip->book_seat($trip_id, $seats)) {
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

	function get_last_id($customer_id) {
		$sql = "SELECT id FROM tickets WHERE customer_id=$customer_id ORDER BY id DESC LIMIT 1";
		return $this->db_fetch_one($sql)["id"];
	}

	function get_user_tickets($customer_id) {
		$sql = "SELECT * FROM tickets WHERE customer_id=$customer_id ORDER BY date_bought DESC";
		return $this->db_fetch_all($sql);
	}


	function has_ticket($customer_id, $trip_id) {
		$sql = "SELECT COUNT(*) FROM tickets WHERE customer_id=$customer_id AND trip_id=$trip_id";
		return $this->db_fetch_one($sql)["COUNT(*)"] > 0;
	}

	function get_ticket_price($ticket_id) {
		$sql = "SELECT price FROM tickets WHERE id=$ticket_id";
		return $this->db_fetch_one($sql)["price"];
	}

	function get_ticket_details($ticket_id) {
		$sql = "SELECT * FROM tickets WHERE id=$ticket_id";
		return $this->db_fetch_one($sql);	
	}

	function get_ticket_seats($ticket_id) {
		$sql = "SELECT seat_number FROM ticket_seats WHERE ticket_id=$ticket_id";
		return $this->db_fetch_all($sql);
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