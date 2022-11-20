<?php
include_once("../settings/core.php");
include_once("../actions/receipt_functions.php");

if(!isLoggedIn()) {
	header("Location: ../login/login.php");
}

if(!isset($_SESSION['customer_id'])) {
	header("Location: ../login/login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Trip History</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/background.css">
</head>
<body class="history">
	<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

	<?php include_once("../settings/navbar.php"); ?>
	<br><br>
	<div class="card container" style="text-align: center;">
		<div class="card-body">
			<h2>Your Trips</h2><br>
			<table class="table table-hover">
			  <thead class="thead">
			    <tr>
			      <th scope="col"><i data-feather="map-pin"></i></th>
			      <th scope="col"><i data-feather="clock"></i></th>
			      <th scope="col"><i data-feather="dollar-sign"></i></th>
			      <th scope="col"><i data-feather="file-text"></i></th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php get_ticket_info_table(getUserId()); ?>
			  </tbody>
			</table>
		</div>
	</div>


<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script>
feather.replace()
</script>
</body>
</html>