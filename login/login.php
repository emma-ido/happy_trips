<?php include_once("../settings/core.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Log in</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
<?php include_once("../settings/navbar.php"); ?>

<br>


<div class="mx-auto" style="width: 65%;">
  <h2 class="font-weight-normal">Log in to your account</h2>

  <form id="theForm" action="login_process.php" method="POST">
    <?php 
      if(isset($_GET["error"])) {
        echo "<span class='badge badge-pill badge-danger'>$_GET[error]</span>"; 
      } else if(isset($_GET["success"])) {
        echo "<span class='badge badge-pill badge-success'>$_GET[success]</span>"; 
      }
    ?>
    
    <div class="form-group">
      <label for="fullName">Email</label>
      <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" required>
    </div>
    
    
    <div class="form-group">
      <label for="pass">Password</label>
      <input type="password" name="pass" class="form-control" id="password" placeholder="Your password" required>
    </div>
    
    <input type="submit" name="customer_login" value="Submit" class="btn btn-primary"></button>
  </form>
</div>


</body>
</html>