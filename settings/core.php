<?php
//start session
session_start(); 

//for header redirection
ob_start();

//funtion to check for login
function isLoggedIn() {
	return isset($_SESSION['active']) && $_SESSION['active'] === true;
}


//function to get user ID
function getUserId() {
	if(!isLoggedIn()) {
		return -1;
	}
	return $_SESSION['customer_id'];
}

//function to check for role (admin, customer, etc)



?>