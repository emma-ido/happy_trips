<?php
include_once("../settings/db_class.php");


class Employee extends db_connection {


	function new_employee($first_name, $last_name, $email, $pass, $phone_number, $role="ADMIN") {
		$pass = password_hash($pass, PASSWORD_DEFAULT);
		$sql = "INSERT INTO employee(first_name, last_name, email, pass, phone_number, employee_role) VALUES('$first_name', '$last_name', '$email', '$pass', '$phone_number', '$role')";

		if($this->emailExists($email)) {
			return array(false, "Account already exists. Login to your account");
		}

		$result = $this->db_query($sql);

		if($result) {
			return array($result, "Successfuly created account. Login to coninue");
		} else {
			return array($result, "Error creating new account");
		}
	}

	function login($email, $password) {
		if(!$this->emailExists($email)) {
			return false;
		} else {
			$emplyee_from_db = $this->get_employee_with_email($email);
			return array(password_verify($password, $emplyee_from_db["pass"]), $emplyee_from_db["id"]);
		}
	}

	function get_employee($id) {
		$sql = "SELECT * FROM employee WHERE id=$id";
		return $this->db_fetch_one($sql);
	}

	function get_employee_email($id) {
		$sql = "SELECT email FROM employee WHERE id=$id";
		return $this->db_fetch_one($sql)["email"];
	}

	function get_employee_name($id) {
		$sql = "SELECT first_name, last_name FROM employee WHERE id=$id";
		$names = $this->db_fetch_one($sql)["email"];
		return $names["first_name"] . " " .$names["last_name"];
	}

	function get_employee_with_email($email) {
		$sql = "SELECT * FROM employee WHERE email='$email'";
		return $this->db_fetch_one($sql);	
	}

	function emailExists($email) {
		$sql = "SELECT id FROM employee WHERE email = '$email'";
		$this->db_query($sql);
		return ($this->db_count() == 1);
	}
}
?>