<?php
require_once("../includes/connections.php");

if(isset($_POST['off_loc']) && isset($_POST['rep_month']) && $_POST['rep_month'] != " "){
	$off_loc = $_POST['off_loc'];
	$rep_month = $_POST['rep_month'];
	$year = $_POST['rep_year'];
	
	$exist = "SELECT * from training_needs where office_location = ".$off_loc." AND month = ".$rep_month." AND year = '."$year."'";
	
	$res_exist = mysqli_query( $connect, $exist) or
	die("Error selecting from database ".mysqli_error($GLOBALS["___mysqli_ston"]));
	
	$row = mysqli_num_rows($res_exist);
	echo $row;
} else {
	echo 1;
?>