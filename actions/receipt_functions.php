<?php
include_once("../controllers/trip_controller.php");
include_once("../controllers/bus_controller.php");
include_once("../controllers/ticket_controller.php");
include_once("../controllers/customer_controller.php");


function get_receipt_summary($ticket_id, $customer_id) {
	$ticket_details = get_ticket_details($ticket_id);
	if($ticket_details == null) return;
	$ticket_price = $ticket_details["price"];
	$ticket_seats = get_ticket_seats($ticket_id);
	$num_of_seats = count($ticket_seats);

	$trip_id = $ticket_details["trip_id"];

	$trip = get_trip($trip_id);

	$price = $trip['price'];
	$seats_left = $trip['seats_available'];

	$origin = get_destination($trip["origin"]);
	$destination = get_destination($trip["destination"]);

	$bus_id = $trip['bus_id'];

	$departure_time = date("F j, Y g:i a",strtotime($trip["departure_time"]));
	$customer_names = get_customer_name($customer_id);

	echo "<h4>$origin -> $destination</h4><br>";

	echo "<span><span class='font-weight-bold'>Passenger Name</span><br>$customer_names[first_name] $customer_names[last_name]</span><br><br>";

	echo "<span><span class='font-weight-bold'>Bus Number</span><br>$bus_id</span><br><br>";

	echo "<span><span class='font-weight-bold'>Departure Time</span><br>$departure_time</span><br><br>";

	echo "<span><span class='font-weight-bold'>Price per seat (GHC)</span><br>$price</span><br><br>";

	echo "<span><span class='font-weight-bold'>Number of seats</span><br>$num_of_seats</span><br><br>";

	echo "<span><span class='font-weight-bold'>Total Price (GHC)</span><br>$ticket_price</span><br><br>";

}


function get_ticket_info_table($customer_id) {
	$tickets = get_user_tickets($customer_id);

	foreach ($tickets as $ticket) {
		$trip_id = $ticket["trip_id"];
		$trip = get_trip($trip_id);
		$ticket_id = $ticket["id"];
		$ticket_price = $ticket["price"];

		$origin = get_destination($trip["origin"]);
		$destination = get_destination($trip["destination"]);
		$departure_time = date("F j, Y g:i a",strtotime($trip["departure_time"]));

		echo "
		<tr>
	  		<th>$origin -> $destination</th>
	  		<th>$departure_time</th>
	  		<th>$ticket_price</th>
	  		<th><a class='btn btn-primary' role='button' href='../view/view_receipt.php?ticket_id=$ticket_id'>View Ticket</a></th>
	  	</tr>
		";

	}
}

?>