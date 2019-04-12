<?php
session_start();

include("../includes/connections.php");

$user_name = $_SESSION['user_name'];

if(isset($_POST['submit'])){
	$off_type = $_POST['off_type'];
	$off_loc = $_POST['off_loc'];
	$rep_month = $_POST['rep_month'];
	$rep_year = $_POST['rep_year'];
	$claims = $_POST['claims'];
	$claims_pro = $_POST['claims_pro'];
	$comp_paid = $_POST['comp_paid'];
	$claims_paid = $_POST['claims_paid'];
	$claims_files = $_POST['claims_files'];
	$amount_paid = $_POST['amount_paid'];
	$auto_date = time();
	$show_date = date("d/m/Y H:i", $auto_date);
	$added_by = $user_name;
	
	$exist = "SELECT * from reimbursement where office_location = ".$off_loc." AND month = ".$rep_month." AND year = '".$rep_year."'";
	
	$res_exist = mysqli_query( $connect, $exist) or
	die("Error selecting from database ".mysqli_error($GLOBALS["___mysqli_ston"]));
	
	$row_exist = mysqli_num_rows($res_exist);
	
	if($row_exist == 0){
		$staff_info = "INSERT INTO reimbursement VALUES (null, $off_type, $off_loc, $rep_month, '$rep_year', '$show_date', '$added_by', $claims, $claims_pro, $claims_paid, $claims_files, $amount_paid, $comp_paid)";
	
		mysqli_query( $connect, $staff_info) or
		die("Error connecting to server".mysqli_error($GLOBALS["___mysqli_ston"]));
		
		header("Location: reimbursement.php");
	} else {
		header("Location: view_reimbursement.php?err=exist");
	}
}
?>