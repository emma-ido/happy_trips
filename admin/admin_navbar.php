<?php
include_once("../settings/core.php");
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="../view/trips.php">Happy Trips</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      
      <?php
      if(!isLoggedIn()) {
        echo "<li class='nav-item'>
                <a class='nav-link' href='../login/register.php'>Register</a>
              </li>
              <li class='nav-item'>
                <a class='nav-link' href='../login/login.php'>Login</a>
              </li>";
      } else {
        if(isEmployee()) {
          echo "<li class='nav-item'>
                	<a class='nav-link' href='add_trip_form.php'>Add trip</a>
              	</li>
              	<li class='nav-item'>
                	<a class='nav-link' href='modify_trip.php'>Modify Trips</a>
              	</li>";
        }
        echo "
              <li class='nav-item'>
                <a class='nav-link' href='../logout.php'>Logout</a>
              </li>
              ";
      }
      ?>
      

      <!-- <li class="nav-item">
        <a class="nav-link" href="#">Pricing</a>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown link
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li> -->

    </ul>
  </div>
</nav>