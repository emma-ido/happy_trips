<?php 
include_once("settings/core.php");
session_destroy();

header("Location: view/trips.php");
?>