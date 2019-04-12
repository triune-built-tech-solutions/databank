<?php
session_start();

include("../includes/connections.php");

$user_name = $_SESSION['user_name'];

if(isset($_POST['submit'])){
	$off_type = $_POST['off_type'];
	$off_loc = $_POST['off_loc'];
	$rep_month = $_POST['rep_month'];
	$rep_year = $_POST['rep_year'];
	$comp_ver = $_POST['comp_ver'];
	$variance = $_POST['variance'];
	$amt_paid = $_POST['amt_paid'];
	$auto_date = time();
	$show_date = date("d/m/Y H:i", $auto_date);
	$added_by = $user_name;
	
	$exist = "SELECT * from ver_comp_acct where office_location = ".$off_loc." AND month = ".$rep_month." AND year = '".$rep_year."'";
	
	$res_exist = mysqli_query( $connect, $exist) or
	die("Error selecting from database ".mysqli_error($GLOBALS["___mysqli_ston"]));
	
	$row_exist = mysqli_num_rows($res_exist);
	
	if($row_exist == 0 || $row_exist == 1){
		$staff_info = "INSERT INTO ver_comp_acct VALUES (null, $off_type, $off_loc, $rep_month, '$rep_year', '$show_date', '$added_by', $comp_ver, $variance, $amt_paid)";
	
		mysqli_query( $connect, $staff_info) or
		die("Error connecting to server ".mysqli_error($GLOBALS["___mysqli_ston"]));
		
		header("Location: verification_of_acct.php");
	} else {
		header("Location: view_verification_of_acct.php?err=exist");
	}
}
?>