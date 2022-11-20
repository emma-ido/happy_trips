<?php
include_once("../settings/core.php");

if(!isLoggedIn()) {
	header("Location: admin_login.php");
}

if(!isEmployee()) {
	header("Location: ../view");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Close All Past Rides</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/background.css">
</head>
<body class="history">
	<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

	<script type="text/javascript">
		function myFunction() {
		     if (confirm("Are you sure you want to close all past trip ticket sales?") == true) {
		         window.location.href = "close_trips.php";
		     } else {
		         return;
		     }
		}
	</script>

	<?php include_once("admin_navbar.php"); ?>
	<br><br>
	<div class="card container" style="text-align: center;">
		<div class="card-body">
			<h2>Close All Past Trips</h2><br>

			<?php 
				if(isset($_GET["success"])) {
					echo "<span class='badge badge-success'>$_GET[success]</span><br>";
				}
			?>

			
			<button class="btn btn-danger" onclick="myFunction()" role="button">CLOSE</button>
		</div>
	</div>
	


<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script>
feather.replace()
</script>
</body>
</html>