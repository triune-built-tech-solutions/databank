<?php
session_start();

include("../includes/connections.php");

$user_name = $_SESSION['user_name'];

if(isset($_POST['submit'])){
	$off_type = $_POST['off_type'];
	$off_loc = $_POST['off_loc'];
	$rep_month = $_POST['rep_month'];
	$rep_year = $_POST['rep_year'];
	$company = $_POST['company'];
	$address = $_POST['address'];
	$email = $_POST['email'];
	$sector = $_POST['sector'];
	$phone = $_POST['phone'];
	$strength = $_POST['strength'];
	$auto_date = time();
	$show_date = date("d/m/Y H:i", $auto_date);
	$added_by = $user_name;
	

		$staff_info = "INSERT INTO comp_cont_detail VALUES (null, $off_type, $off_loc, $rep_month, '$rep_year', '$company', '$address', '$email', '$sector', '$phone', $strength, '$show_date', '$added_by')";
		
		mysqli_query( $connect, $staff_info) or
		die("Error connecting to server ".mysqli_error($GLOBALS["___mysqli_ston"]));
		
		header("Location: add_comp_cont.php");
}
?>