<?php
session_start();
include '../includes/connections.php';


$user_name = $_SESSION['user_name'];

if(isset($_POST['submit'])){
	$off_type = $_POST['off_type'];
	$off_loc = $_POST['off_loc'];
	$rep_month = $_POST['rep_month'];
	$rep_year = $_POST['rep_year'];
	$retainer = $_POST['retainer'];
	$caseno = $_POST['caseno'];
	$status = $_POST['status'];
	$amount = $_POST['amount'];
	$remarks = $_POST['remarks'];
	$location = $_POST['location'];
	$auto_date = time();
	$show_date = date("d/m/Y H:i", $auto_date);
	$added_by = $user_name;
	

		$staff_info = "INSERT INTO legalinfo VALUES (null, $off_type, $off_loc, $rep_month, '$rep_year', '$retainer', '$caseno', '$status', $amount, '$remarks', '$location', '$added_by', '$show_date')";
		
		mysqli_query( $connect, $staff_info) or
		die("Error connecting to server ".mysqli_error($GLOBALS["___mysqli_ston"]));
		
		header("Location: add_legal.php");
}
?>