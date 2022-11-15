<?php
include_once("../settings/core.php");


if(isset($_POST["select_seat"])) {
	$trip_id = $_POST["trip_id"];
	$price = $_POST["trip_price"];

?>

<?php
} else {
	header('Location: trips.php');
}
?>