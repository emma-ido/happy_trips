<?php
include_once('../settings/core.php');
include_once('../controllers/ticket_controller.php');


if(isset($_POST["book_ticket"])) {
	$customer_id = getUserId();
	$trip_id = $_POST["trip_id"];
	$seats = $_POST["selected_seats"];

	// print_r($seats);

	$price = $_POST['total_price'];

	if(has_ticket($customer_id, $trip_id)) {
		header("Location: ../view/view_reciept.php?trip_id=$trip_id&customer_id=$customer_id");	
	}
	book_ticket($customer_id, $trip_id, $price);

	$ticket_id = get_ticket_id($customer_id, $trip_id);
	insert_ticket_seats($trip_id, $ticket_id, $seats);

	// echo "SUCESS";
	header("Location: ../view/view_reciept.php?trip_id=$trip_id&customer_id=$customer_id");

} else {

	header('Location: ../view/trips.php');
}

?>