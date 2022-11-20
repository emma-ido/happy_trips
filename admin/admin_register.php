<?php include_once("../settings/core.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Register</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>


<br>

<script type="text/javascript" src="../js/loginValidation.js"></script>



<div class="mx-auto" style="width: 65%;">
  <h2 class="font-weight-normal">Create a Happy Trips Account</h2>
  <hr>
  <?php
    if(isset($_GET["error"])) {
      echo "<span class='badge badge-danger'>$_GET[error]</span>";
    } 
  ?>
  
  <form id="theForm" action="admin_register_process.php" method="POST">

    <span id="invalid_name" class="font-weight-bold" style="color: red; display: none;"></span>
    <div class="row">
      <div class="col">First name</div>
      <div class="col">Last name</div>
    </div>

    <div class="row form-group">
        <div class="col">
          <input type="text" name="fname" class="form-control" id="fname" placeholder="Enter your first name" required>
        </div>
        
        <div class="col">
          <input type="text" name="lname" class="form-control" id="lname" placeholder="Enter your last name" required>
        </div>
    </div>

    <span id="invalid_email" class="font-weight-bold" style="color: red; display: none;"></span>
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" required>
    </div>


    <span id="invalid_pass" class="font-weight-bold" style="color: red; display: none;"></span>
    <div class="row">
      <div class="col">Password</div>
      <div class="col">Confirm Password</div>
    </div>
    <div class="row form-group">
        
        <div class="col">
          <input type="password" name="pass" class="form-control" id="pass" placeholder="Enter a password" required>
        </div>
        
        <div class="col">
          <input type="password" name="pass2" class="form-control" id="pass2" placeholder="Confirm password" required>
        </div>
    </div>


    <span id="invalid_contact" class="font-weight-bold" style="color: red; display: none;">Invalid phone number</span>
    <div class="form-group">
      <label for="contact">Contact </label>
      <input type="text" name="contact" class="form-control" id="contact" placeholder="Phone Number" required>
    </div>

    <input type="hidden" name="new_customer" value="new_customer">
    
    <input type="button" onclick="validateRegister()" value="Submit" class="btn btn-primary">
    <div style="display: none;"><input id="submitButton" type="submit" name="new_account" value="YES"></div>
  </form>
</div>

<br><br><br>

</body>
</html>