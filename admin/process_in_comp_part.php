<?php
session_start();

include("../includes/connections.php");

$user_name = $_SESSION['user_name'];

if(isset($_POST['submit'])){
	$off_type = $_POST['off_type'];
	$off_loc = $_POST['off_loc'];
	$rep_month = $_POST['rep_month'];
	$rep_year = $_POST['rep_year'];
	$participants = $_POST['participants'];
	$organization = $_POST['organization'];
	$gender = $_POST['gender'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	$phone = $_POST['phone'];
	$auto_date = time();
	$show_date = date("d/m/Y H:i", $auto_date);
	$added_by = $user_name;
	

		$staff_info = "INSERT INTO in_comp_part VALUES (null, $off_type, $off_loc, $rep_month, '$rep_year', '$participants', '$organization', '$gender', '$email', '$address', '$phone', '$show_date', '$added_by')";
		
		mysqli_query( $connect, $staff_info) or
		die("Error connecting to server ".mysqli_error($GLOBALS["___mysqli_ston"]));
		
		header("Location: add_in_part.php");
}
?>