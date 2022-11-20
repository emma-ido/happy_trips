<?php
include_once("../settings/core.php");
include_once("../actions/receipt_functions.php");

if(!isLoggedIn()) {
	header("Location: ../login/login.php");
}

if(isset($_GET["ticket_id"])) {

	$ticket_id = $_GET["ticket_id"];
	$customer_id = getUserId();

	
	// trip details
	// ticket details
	// ticket seat details


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Receipt</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/background.css">
</head>
<body>
	<?php include_once("../settings/navbar.php"); ?>
	<br><br>

	<div class="col d-flex justify-content-center">
		<div class="card" style="width: 40%;border-radius: 20px;">
			<div class="card-body" style="text-align: center;">
				<h2><ion-icon name='bus-outline'></ion-icon> Ticket</h2>
				<hr>
				<?php get_receipt_summary($ticket_id, $customer_id); ?>
			</div>
		</div>
	</div>
	<br><br>

	<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
	<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
<?php

}
?>