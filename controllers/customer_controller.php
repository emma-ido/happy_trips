<?php
include_once("../classes/customer_class.php");


function customer_login($email, $password) {
	$customer = new Customer();
	return $customer->login($email, $password);
}

function get_customer_by_id($id) {
	$customer = new Customer();
	return $customer->get_customer_by_id($id);
}

function get_customer_name($customer_id) {
	$customer = new Customer();
	return $customer->get_customer_name($customer_id);
}

function new_customer($first_name, $last_name, $email, $pass, $phone_number, $referral_code=null) {
	$customer = new Customer();
	return $customer->new_customer($first_name, $last_name, $email, $pass, $phone_number);
}

?>