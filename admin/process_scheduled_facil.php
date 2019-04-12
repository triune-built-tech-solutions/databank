<?php
session_start();

include("../includes/connections.php");

$user_name = $_SESSION['user_name'];

if(isset($_POST['submit'])){
	$off_type = $_POST['off_type'];
	$off_loc = $_POST['off_loc'];
	$rep_month = $_POST['rep_month'];
	$rep_year = $_POST['rep_year'];
	$facilitator = $_POST['facilitator'];
	$organization = $_POST['organization'];
	$gender = $_POST['gender'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	$phone = $_POST['phone'];
	$topic = $_POST['topic'];
	$auto_date = time();
	$show_date = date("d/m/Y H:i", $auto_date);
	$added_by = $user_name;
	

		$staff_info = "INSERT INTO scheduled_facil VALUES (null, $off_type, $off_loc, $rep_month, '$rep_year', '$facilitator', '$organization', '$gender', '$email', '$address', '$phone', '$topic', '$show_date', '$added_by')";
		
		mysqli_query( $connect, $staff_info) or
		die("Error connecting to server ".mysqli_error($GLOBALS["___mysqli_ston"]));
		
		header("Location: add_scheduled_facil.php?msg=success");
} else {
	header("Location: add_scheduled_facil.php?msg=error");
}
?>