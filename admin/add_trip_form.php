<?php
include_once("../settings/core.php");
include_once("../actions/trip_functions.php");

if(!isEmployee()) {
	header("Location: ../view");
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>New Trip</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>

	<?php include_once("admin_navbar.php"); ?>

	<script type="text/javascript" src="../js/trips.js"></script>
	<br><br>
	<div class="mx-auto" style="width: 65%;">
  <h2 class="font-weight-normal">Add a New Trip</h2>
  <hr>
  <?php
    if(isset($_GET["error"])) {
      echo "<span class='badge badge-danger'>$_GET[error]</span>";
    } else if(isset($_GET["success"])) {
      echo "<span class='badge badge-success'>$_GET[success]</span>";
    }
  ?>
  
  <form id="addTripForm" action="../actions/add_trip.php" method="POST">

    <span id="invalid_name" class="font-weight-bold" style="color: red; display: none;"></span>
    <div class="row">
      <div class="col">Origin</div>
      <div class="col">Destination</div>
    </div>

    <div class="row form-group">
        <div class="col">
	        <select class="form-control" name="origin" id="origin" required>
		        <?php get_destination_options(); ?>
	      	</select>
	    </div>
        
        <div class="col">
        	<select class="form-control" name="destination" id="destination" required>
          		<?php get_destination_options(); ?>
          	</select>
        </div>
    </div>

    <span id="invalid_time" class="font-weight-bold" style="color: red; display: none;"></span>
    <div class="row">
      <div class="col">Departure Time and Date</div>
      <div class="col">Estimated Arrival Time and Date</div>
    </div>
    <div class="row form-group">
        
        <div class="col">
        	<?php 
        		$current_date = date("Y-m-d");
        		$current_date .= "T00:00";
        		echo "<input type='datetime-local' min='$current_date' name='departure_time' class='form-control' id='departure_time' required>";
        	?>
        </div>
        
        <div class="col">
        	<?php 
        		$current_date = date("Y-m-d");
        		$current_date .= "T00:00";
        		echo "<input type='datetime-local' min='$current_date' name='arrival_time' class='form-control' id='arrival_time' required>";
        	?>
        	
        </div>
    </div>


    <span id="invalid_contact" class="font-weight-bold" style="color: red; display: none;">Invalid phone number</span>
    <div class="form-group">
    	<label for="trip_type">Trip Type</label>
    	<select class="form-control" name="trip_type" id="trip_type" required>
    		<?php get_trip_type_options(); ?>  			
        </select>
    </div>

    <div class="form-group">
    	<label for="bus">Bus</label>
    	<select class="form-control" name="bus" id="bus" required>
    		<?php get_bus_options(); ?>  			
        </select>
    </div>

    <div class="form-group">
    	<label for="price">Price</label>
    	<input type="number" step=0.1 min=0.5 class="form-control" name="price" id="price" required>
    </div>

    <!-- <input type="hidden" name="new_trip" value="new_trip"> -->
    
    <input type="button" value="Submit" onclick="validateNewTrip()" class="btn btn-primary">
    <div style="display: none;"><input id="add_new_trip_trigger" type="submit" name="new_trip" value="YES"></div>
  </form>
</div>

<br><br>

</body>
</html>