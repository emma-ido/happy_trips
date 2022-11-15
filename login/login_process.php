<?php
include_once("../settings/core.php");
include_once("../controllers/customer_controller.php");

if(isset($_POST["customer_login"])) {

	$email = $_POST["email"];
	$password = $_POST["pass"];

	$login = customer_login($email, $password);
	if($login[0]) {
		
		$_SESSION['active'] = true;
		$_SESSION['customer_id'] = $login[1];
		header("location: ../index.php?success=Login Successful");

	} else {
		header("location: ../login/login.php?error=Incorrect email or password");		
	}
}

?>