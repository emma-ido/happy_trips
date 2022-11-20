<?php
include_once("../settings/core.php");
include_once("../controllers/customer_controller.php");


if(isset($_POST["new_customer"])) {

	$first_name = $_POST['fname'];
	$last_name = $_POST['lname'];
	$email = $_POST['email'];
	$pass = $_POST['pass'];
	$phone_number = $_POST['contact'];

	$result = new_customer($first_name, $last_name, $email, $pass, $phone_number);
	if($result[0]) {
		header("Location: login.php?success=$result[1]");
		// echo "YES";
	} else {
		// echo "NO";
		header("Location: register.php?error=$result[1]");
	}
}

?>