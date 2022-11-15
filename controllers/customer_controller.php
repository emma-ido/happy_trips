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

?>