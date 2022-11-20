<?php
include_once("../settings/core.php");
include_once("../controllers/employee_controller.php");

if(isset($_POST["customer_login"])) {

	$email = $_POST["email"];
	$password = $_POST["pass"];

	$login = employee_login($email, $password);
	if($login[0]) {
		$helper = array_keys($_SESSION);
	    foreach ($helper as $key){
	        unset($_SESSION[$key]);
	    }

		$_SESSION['active'] = true;
		$_SESSION['employee_id'] = $login[1];
		$_SESSION['admin'] = true;
		// echo "YES";
		header("location: add_trip_form.php");

	} else {
		// echo "NO";
		header("location: admin_login.php?error=Incorrect email or password");		
	}
}

?>