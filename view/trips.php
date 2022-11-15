<?php include_once("../actions/trip_functions.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Trips</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
	<script type="text/javascript" src="../js/trips.js"></script>
	<?php include_once("../settings/navbar.php") ?>;


	<div class='row' style='width: 99%;'>
		<div class='col'>
		</div>
		<div class='col-5'>
			<div class='card' style='padding: 10px;border-radius: 20px;'>
				<ul class='nav justify-content-center'>
				  <li class='nav-item'>
				    <a class='nav-link active' href='#'>Book a seat</a>
				  </li>
				  <li class='nav-item'>
				    <a class='nav-link' href='#'>Link</a>
				  </li>
				  <li class='nav-item'>
				    <a class='nav-link' href='#'>Link</a>
				  </li>
				  <li class='nav-item'>
				    <a class='nav-link disabled' href='#'>Disabled</a>
				  </li>
				</ul>
				<div class='card-body'>
					<div class='row'>
						<div class='col-md-auto'><button type='button' id="oneWay" onclick="oneWay()" class='btn btn-outline-info active'>One Way</button></div>
						<div class='col'><button type='button' id="roundTrip" onclick="roundTrip()" class='btn btn-outline-info'>Round Trip</button></div>
					</div>
					<br>
					<form method="POST" id="findTripForm" action="view_trips.php">
					<div class="form-group">
					    <label for="travelling_from">Travelling From</label>
					    <select class="form-control" name="travelling_from" id="travelling_from" value="travelling_to" required>
					      <?php get_destination_options(); ?>
					    </select>
					</div>
					<br>
					<div class="row">
						<div class="col form-group">
						    <label for="travelling_to">Travelling To</label>
						    <select class="form-control" name="travelling_to" id="travelling_to" value="travelling_to" required>
						      <?php get_destination_options(); ?>
						    </select>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col form-group">
						    <label for="departure_date">Departure date</label>
						    <input type="date" class="form-control" id="departure_date" name="departure_date" required>
						</div>
						<div class="col form-group" id="return_date_div" style="display: none;">
						    <label for="return_date">Return date</label>
						    <input type="date" class="form-control" id="return_date" name="return_date">
						</div>
						<input type="hidden" value="NO" name="has_return" id="has_return">
						<div class="col form-group">
						    <label for="seats">Seats</label>
						    <input type="number" name="seats" step=1 min=1 value=1 max=10 class="form-control" id="seats" required>
						</div>
					</div>
					<br>
					<div class="mx-auto"><input class="btn btn-info form-control" onclick="validateFindTripForm()" value="Find Trips" type="button"></input></div>
					<div style="display: none"><input name="find_trips" id="submit_button" value="Find Trips" type="submit"></div>
					</form>
				</div>
			</div>
		</div>
	</div>
<br>
</body>
</html>