<?php 
include_once("../settings/db_class.php");


/**
 * Handles the operations of the bus and bus make db tables
 * 
 */
class Bus extends db_connection {


	//-- BUS --//
	function new_bus($capacity, $make, $weight_limit=null, $plate_number=null) {
		$sql = "INSERT INTO bus(capacity, make, weight_limit, plate_number) VALUES ($capacity, '$make', $weight_limit, '$plate_number')";
		return $this->db_query($sql);
	}

	function get_bus($bus_id) {
		$sql = "SELECT * FROM bus WHERE id=$bus_id";
		return $this->db_fetch_one($sql);
	}

	function get_bus_capacity($bus_id) {
		$sql = "SELECT capacity FROM bus WHERE id=$bus_id";
		return $this->db_fetch_one($sql)["capacity"];
	}

	function get_all_buses() {
		$sql = "SELECT * FROM bus";
		return $this->db_fetch_all($sql);
	}

	//-- BUS MAKE --//
	function new_bus_make($make) {
		$sql = "INSERT INTO bus_makes VALUES ('$make')";
		return $this->db_query($sql);
	}

	function get_all_bus_makes() {
		$sql = "SELECT * FROM bus_makes";
		return $this->db_fetch_all($sql);
	}

	function get_bus_make($bus_id) {
		$sql = "SELECT make FROM bus WHERE id=$bus_id";
		return $this->db_fetch_one($sql)["make"];
	}

	function get_seat_numbers($bus_id) {
		$bus_make = $this->get_bus_make($bus_id);
		
		switch ($bus_make) {
			case 'SUBARU Coach RTX2':
				return array('L1', 'L2', 'L3', 'L4', 'L5', 'R1', 'R2', 'R3', 'R4', 'R5');
				break;

			case 'SUBARU Coach RTX4':
				return array('L1', 'L2', 'L3', 'L4', 'L5', 'R1', 'R2', 'R3', 'R4', 'R5');
				break;

			case 'VOLVO 9500 Euro 5':
				return array('L1', 'L2', 'L3', 'L4', 'L5', 'R1', 'R2', 'R3', 'R4', 'R5');
				break;

			case 'NAPOLEAN city liner N1116':
				return array('L1', 'L2', 'L3', 'L4', 'L5', 'L6', 'L7', 'L8', 'R1', 'R2', 'R3', 'R4', 'R5', 'R6', 'R7', 'R8');
				break;

			default:
				return array();
				break;
		}
	}


}




?>