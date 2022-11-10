<?php
include_once("../settings/db_class.php");
include_once("bus_class.php");
include_once("ticket_class.php");


class Trip extends db_connection {


	function new_trip($bus_id, $driver_id, $trip_type, $origin, $destination, $departure_time, $arrival_time, $booking_status) {

		$bus = new Bus();
		$capacity = $bus->get_bus_capacity($bus_id);

		$sql = "INSERT INTO trips(bus_id, driver_id, trip_type, origin, destination, departure_time, arrival_time, seats_available, booking_status) VALUES ($bus_id, $driver_id, '$trip_type', '$origin', '$destination', '$departure_time', '$arrival_time', $capacity, '$booking_status')";
		//echo $sql."<br>";
		$this->db_query($sql);
	}


	function has_available_seat($trip_id) {
		$seats_left = $this->get_seats_left($trip_id);
		if($seats_left == 0) {
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

	function book_seat($trip_id) {
		if(!$this->has_available_seat($trip_id)) {
			return false;
		}
		$updated_seats = $this->get_seats_left($trip_id) - 1;
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