<?php


$refCode = "";

if(isset($_GET["ref"])) {
	$refCode = $_GET["ref"];
} else {
	$refCode = "FAILED";
}

echo $refCode;

?>