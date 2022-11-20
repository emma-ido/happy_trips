<?php
include_once("../settings/core.php");
include_once("../controllers/trip_controller.php");

if(!isEmployee()) {
	header("Location: admin_login.php");
}


close_all_passed_trips();
header("Location: modify_trip.php?success=All past trips successfully closed");

?>