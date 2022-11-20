<?php
include_once("../settings/db_class.php");
include_once("bus_class.php");
include_once("ticket_class.php");


class Trip extends db_connection {


	function new_trip($bus_id, $trip_type, $origin, $destination, $departure_time, $arrival_time, $price, $booking_status="open") {

		$bus = new Bus();
		$capacity = $bus->get_bus_capacity($bus_id);

		$sql = "INSERT INTO trips(bus_id, trip_type, origin, destination, departure_time, arrival_time, seats_available, booking_status, price) VALUES ($bus_id, '$trip_type', $origin, $destination, '$departure_time', '$arrival_time', $capacity, '$booking_status', $price)";
		// echo $sql;
		return $this->db_query($sql);
	}

	function close_all_passed_trips() {
		$date = date("Y-m-d H:i:s");
		$sql = "UPDATE trips SET booking_status='closed' WHERE departure_time < '$date'";
		$this->db_query($sql);
	}

	function get_trip_by_id($trip_id) {
		$sql = "SELECT * FROM trips WHERE id=$trip_id ORDER BY departure_time DESC";
		return $this->db_fetch_one($sql);
	}

	function get_one_way_trips($origin, $destination, $departure_time, $seats=1) {
		$departure_time.= " 00:00:00";
		$next_day = date_create($departure_time);
		date_modify($next_day, "+1 day");
		$next_day = date_format($next_day, "Y-m-d");

		$sql = "SELECT * FROM trips WHERE origin='$origin' AND destination='$destination' AND departure_time >= '$departure_time' AND departure_time < '$next_day' AND seats_available > 0 AND booking_status = 'open' AND seats_available >= $seats";
		// echo $sql;
		return $this->db_fetch_all($sql);
	}


	function get_all_destinations() {
		$sql = "SELECT * FROM destinations";
		return $this->db_fetch_all($sql);
	}

	function get_destination_by_id($id) {
		$sql = "SELECT destination_name FROM destinations WHERE id=$id";
		return $this->db_fetch_one($sql)["destination_name"];
	}

	function get_trip_types() {
		$sql = "SELECT * FROM trip_types";
		return $this->db_fetch_all($sql);
	}


	function has_available_seat($trip_id, $seats=1) {
		$seats_left = $this->get_seats_left($trip_id);
		if($seats_left-$seats < 0) {
			return false;
		} else {
			return true;
		}
	}
	
	function get_seats_left($trip_id) {
		$sql = "SELECT seats_available FROM trips WHERE id=$trip_id";
		return $this->db_fetch_one($sql)["seats_available"];
	}


	function get_available_seat_numbers($trip_id) {
		$bus_id = $this->get_trip_bus($trip_id);
		$bus = new Bus();
		$ticket = new Ticket();
		$total_seats = $bus->get_seat_numbers($bus_id);
		$filled_seats = $ticket->get_filled_seat_numbers($trip_id);
		return array_diff($total_seats, $filled_seats);
	}

	function get_available_seat_numbers_speacial($trip_id) {
		$bus_id = $this->get_trip_bus($trip_id);
		$bus = new Bus();
		$ticket = new Ticket();
		$total_seats = $bus->get_seat_numbers($bus_id);
		$filled_seats = $ticket->get_filled_seat_numbers($trip_id);
		$output = array();

		foreach($total_seats as $current_seat) {
			if($this->contains($filled_seats, $current_seat)) {
				// if the seat has been filled
				$output["$current_seat"] = 0;
			} else {
				$output["$current_seat"] = 1;
			}
		}
		return $output;
	}

	private function contains($array, $seat_to_find) {
		foreach ($array as $seat) {
			if($seat_to_find === $seat) {
				return true;
			}
		}
		return false;
	}

	function get_trip_price($trip_id) {
		$sql = "SELECT price FROM trips WHERE id=$trip_id";
		return $this->db_fetch_one($sql)["price"];
	}

	function get_trip_type($trip_id) {
		$sql = "SELECT trip_type FROM trips WHERE id=$trip_id";
		return $this->db_fetch_one($sql)["trip_type"];
	}

	function get_trip_bus($trip_id) {
		$sql = "SELECT bus_id FROM trips WHERE id=$trip_id";
		return $this->db_fetch_one($sql)["bus_id"];
	}

	function book_seat($trip_id, $seats=1) {
		if(!$this->has_available_seat($trip_id, $seats)) {
			return false;
		}
		$updated_seats = $this->get_seats_left($trip_id) - $seats;
		$sql = "UPDATE trips SET seats_available=$updated_seats WHERE id=$trip_id";
		return $this->db_query($sql);
	}

	function unbook_seat($trip_id) {
		$updated_seats = $this->get_seats_left($trip_id) + 1;
		$sql = "UPDATE trips SET seats_available=$updated_seats WHERE id=$trip_id";
		return $this->db_query($sql);	
	}
}


	


?>