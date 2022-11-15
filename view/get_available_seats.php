<?php
include_once("../settings/core.php");
include_once("../controllers/trip_controller.php");
include_once("../controllers/customer_controller.php");

// if(isset($_POST["trip_id"])) {

// }
if($_POST["trip_id"]) {
$trip_id = $_POST["trip_id"];
$available_seats = get_available_seat_numbers_speacial($trip_id);

$trip_details = get_trip($trip_id);
$customer = get_customer_by_id(getUserId());
$departure_time = date("F j, Y, g:i a",strtotime($trip_details["departure_time"]));
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Found Trips</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
	<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
	<?php include_once("../settings/navbar.php"); ?>
<script src="https://js.paystack.co/v1/inline.js"></script>
<script src='../js/trips.js'></script>
<br><br>

<div class='container'>
<div class='row'>
	<!-- d-flex justify-content-center -->
<div class='col'>
	<div class='card' style='text-align: center; border-radius: 25px;width: 85%;'>
		<div class='card-body'>
			<div class='row' style='padding: 10px;'>
				<div class='col'>
					<img src='../images/seat_selection/available_seat.svg'>
					<br><span class='font-weight-normal'>Available Seat</span>
				</div>
				<div class='col'>
					<img src='../images/seat_selection/booked_seat.svg'>
					<br>Booked Seat
				</div>
				<div class='col'>
					<img src='../images/seat_selection/selected_seat.svg'>
					<br>Selected Seat
				</div>
			</div>
			<br><br>
			<form id='select_seats_form' method="POST" action="../actions/book_ticket.php">
				<input id="total_price" name="total_price" type="hidden" value=0>
				<input type="hidden" name="book_ticket" value="YES">
				<?php echo "<input type='hidden' name='trip_id' value='$trip_id'>"; ?>
			<div class='row'>
				<div class='col'>
					<img src='../images/seat_selection/steering_wheel.svg'>
				</div>
				<div class='col'>
					
				</div>
				<div class='col'>
					
				</div>
				<div class='col'>
				</div>
			</div>
			<?php
				$html = "<br><div class='row'>";
				$i = 0;
				$j = 0;
				foreach ($available_seats as $seat_number => $isAvailable) {
					if($i == 3) {
						$html .= "</div><br><div class='row'>";
						$i = 0;
					}
					$image_path = "";
					if($isAvailable == 1) {
						// available seat
						$image_path = "../images/seat_selection/available_seat.svg";
					} else {
						$image_path = "../images/seat_selection/booked_seat.svg";
					}
					if($i == 2) {
						$html .= "<div class='col'></div>";
					}
					$html .= "<div class='col'>
								<input type='radio' id='seat_$j' value='$seat_number' name='selected_seats[$j]' style='display: none;'>
								<img id='seat_image$j' onclick='changeSeatImage($j)' src='$image_path'>
							</div>";
					$i++;
					$j++;
				}
				// echo $i%3;

				while($i%4 != 0) {
					$html .= "<div class='col'></div>";
					$i++;
				}

				$html .= "</div>";
				echo $html;
				?>
			<br>
		</div>
		</div>
	</div>
</form>
	<div class='col'>
		<div class='card' style="border-radius: 25px;">
			<div class='card-body'>
				<h4 style="text-align: center;">Details</h4>
				<hr>

				<div class="row" style="text-align: center;">
					<div class="col">
						<span class="font-weight-bold">Price per seat (GHC)</span><br>
						<?php echo "<span id='price_per_seat'>$trip_details[price]</span>"; ?>
						
					</div>
					<div class="col">
						<span class="font-weight-bold">Seats Selected</span><br>
						<span id="seats">0</span>
					</div>
					<div class="col">
						<span class="font-weight-bold">Total Fare (GHC)</span><br>
						<span id="total_fare">0</span>
					</div>
				</div>
				<div id="select_seat_error" style="text-align: center;display: none;"><span class="badge badge-danger">Select a seat to continue</span></div>
				<br>
				<button type="button" onclick="conFirmBooking()" class="btn btn-outline-primary form-control">Select Seat(s)</button>

			</div>
		</div>
	</div>

</div>
</div>
<br><br>




<!-- modal -->
<!-- Button trigger modal -->
<button style="display: none;" type="button" class="btn btn-primary" id="trigger_button" data-toggle="modal" data-target="#exampleModal">
  Select Seat(s)
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirm Booking Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo "<span><span class='font-weight-bold'>Name:</span> $customer[first_name] $customer[last_name]</span>"; ?><br>
        <?php echo "<span><span class='font-weight-bold'>Number:</span> $customer[phone_number]</span><br>
        						<span><span class='font-weight-bold'>Departure date & time:</span> $departure_time</span><br>
        						<input type='hidden' style='display: none;' value='$customer[email]' id='email-address'>
        "; ?>
        <span><span class='font-weight-bold'>Seat(s): </span><span id="seats_summary">0</span></span><br>
        <?php echo "<span><span class='font-weight-bold'>Unit Price (GHC):</span> $trip_details[price]</span>"; ?><br>
        <span><span class='font-weight-bold'>Total Fare (GHC): </span><span id="amount">0</span></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="payWithPaystack()">Proceed to payment</button>
      </div>
    </div>
  </div>
</div>










</body>
</html>

<?php

} else {
	header("Location: ../view/trips.php");
}


?>