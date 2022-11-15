<?php 
include_once("../settings/db_class.php");
include_once("generate_referral_code_class.php");


class Customer extends db_connection {


	function new_customer($first_name, $last_name, $email, $pass, $phone_number, $referral_code) {
		$pass = password_hash($pass, PASSWORD_DEFAULT);
		$sql = "INSERT INTO customer(first_name, last_name, email, pass, phone_number) VALUES ('$first_name', '$last_name', '$email', '$pass', '$phone_number')";
		
		if($this->emailExists($email)) {
			return false;
		}

		$result = $this->db_query($sql);
		
		$customer_id = $this->get_customer_with_email($email)['id'];
		if($result) {
			// $cutomer_id = $this->get_id_from_email($email);
			echo "<br>$customer_id<br>";
			$this->generate_ref_code_for_user($customer_id);
		}

		if($referral_code != -1 && ($customer_id != -1)) {
			if($this->refCodeExists($referral_code)) {
				$this->use_referall_code($customer_id, $referral_code);
			}
		}

		return $result;
	}


	function get_customer_by_id($customer_id) {
		$sql = "SELECT * FROM customer WHERE id=$customer_id";
		return $this->db_fetch_one($sql);
	}


	function login($email, $password) {
		if(!$this->emailExists($email)) {
			return false;
		} else {
			$customerFromDb = $this->get_customer_with_email($email);
			
			return array(password_verify($password, $customerFromDb["pass"]), $customerFromDb["id"]);
		}
	}

	/**
	 * Return true if email exists in customer table, sinon false
	 * */
	function emailExists($email) {
		$sql = "SELECT id FROM customer WHERE email = '$email'";
		$this->db_query($sql);
		return ($this->db_count() == 1);
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

	/**
	 * A user uses a beneficiaries referral code
	 * The beneficiary gets a discount after 3 people that used their referral code have made purchases
	 * */
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
			// $this->give_discount($beneficiary_id);
		}

		$sql = "UPDATE referral_code_gen SET current_count=$current_count, total_count=$total_count WHERE beneficiary_id=$beneficiary_id";
		return $this->db_query($sql);
	}

	function give_discount($user_id) {

	}


	function purchas() {
		// when  user makes a purchase
		// update update referral count
		// if status==settled return
		// if status==pending update code count and set status=settled
	}

	function get_referral_code_counts($beneficiary_id) {
		$sql = "SELECT current_count, total_count FROM referral_code_gen WHERE beneficiary_id=$beneficiary_id";
		$result = $this->db_fetch_one($sql);
		return array($result["current_count"], $result["total_count"]);
	}


	function get_id_from_email($email) {
		$sql = "SELECT id FROM customer WHERE email='$email'";
		return $this->db_fetch_one($sql)["id"];
	}

	function get_customer_with_email($email) {
		$sql = "SELECT * FROM customer WHERE email='$email'";
		return $this->db_fetch_one($sql);
	}
}

// $first_name, $last_name, $email, $pass, $phone_number, $referral_code
// $customer = new Customer();
// $customer->new_customer("Emma-Ido", "Ukpong", "emmankelam@gmail.com", "123456789", "0549462052", "O/smV,ra");

// echo "Id: ".$customer->get_id_from_email("emmankelam@gmail.com");
?>