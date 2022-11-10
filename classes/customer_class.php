<?php 
include_once("../settings/db_class.php");
include_once("generate_referral_code_class.php");


class Customer extends db_connection {


	function new_customer($first_name, $last_name, $email, $pass, $phone_number) {
		$sql = "INSERT INTO customer(first_name, last_name, email, pass, phone_number) VALUES ('$first_name', '$last_name', '$email', '$pass', '$phone_number')";
		return $this->db_query($sql);
	}

	/**
	 * Return true if email exists in customer table, sinon false
	 * */
	function emailExists($email) {
		$sql = "SELECT id FROM customer WHERE email = '$email'";
		$this->db_query($sql);
		return ($this->db_count() === 1);
	}

	/**
	 * Return true if the referral code exists in the the db
	 * */
	function refCodeExists($code) {
		$sql = "SELECT beneficiary_id FROM referral_code_gen WHERE referral_code = '$code'";
		$this->db_query($sql);
		return ($this->db_count() === 1);
	}


	/**
	 * On account register, a user is assigned a referral code
	 * */
	function generate_ref_code_for_user($user_id) {
		$ref_code = Ref::generateRandomString(8, 255);

		while($this->refCodeExists($ref_code)) {
			$ref_code = Ref::generateRandomString(8, 255);
		}
		
		$sql = "INSERT INTO referral_code_gen(beneficiary_id, referral_code) VALUES ($user_id, '$ref_code')";
		return $this->db_query($sql);
	}

	function get_ref_code_owner($referral_code) {
		$sql = "SELECT beneficiary_id FROM referral_code_gen WHERE referral_code = '$referral_code'";
		return $this->db_fetch_one($sql)['beneficiary_id'];
	}

	function use_referall_code($user_id, $referral_code) {
		$beneficiary_id = $this->get_ref_code_owner($referral_code);
		$sql = "INSERT INTO referral_code_uses(beneficiary_id, used_by) VALUES ($beneficiary_id, $user_id)";
		$this->db_query($sql);
	}


	function update_referral_code_count($beneficiary_id) {
		$counts = $this->get_referral_code_counts($beneficiary_id);
		$current_count = $counts[0];
		$total_count = $counts[1];
		$current_count++;
		$total_count++;

		if($current_count === 3) {
			$current_count = 0;
		}

		$sql = "UPDATE referral_code_gen SET current_count=$current_count, total_count=$total_count WHERE beneficiary_id=$beneficiary_id";
		return $this->db_query($sql);
	}

	function give_discount($user_id) {

	}

	function get_referral_code_counts($beneficiary_id) {
		$sql = "SELECT current_count, total_count FROM referral_code_gen WHERE beneficiary_id=$beneficiary_id";
		$result = $this->db_fetch_one($sql);
		return array($result["current_count"], $result["total_count"]);
	}
}


$customer = new Customer();

?>