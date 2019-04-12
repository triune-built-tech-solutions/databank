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
	$amount_paid = $_POST['amount_paid'];
	$amount_paid = $_POST['amount_due'];
	$payment_year = $_POST['payment_year'];
	$auto_date = time();
	$show_date = date("d/m/Y H:i", $auto_date);
	$added_by = $user_name;
	

		$staff_info = "INSERT INTO comp_outstanding VALUES (null, $off_type, $off_loc, $rep_month, '$rep_year', '$company', '$address', $amount_due, $amount_paid, '$payment_year', '$show_date', '$added_by')";
		
		mysqli_query( $connect, $staff_info) or
		die("Error connecting to server ".mysqli_error($GLOBALS["___mysqli_ston"]));
		
		header("Location: add_comp_outstanding.php");
}
?>