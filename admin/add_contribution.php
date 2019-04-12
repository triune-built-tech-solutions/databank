<?php
session_start();

include("../includes/connections.php");

$user_name = $_SESSION['user_name'];

if(isset($_POST['submit'])){
	$off_type = $_POST['off_type'];
	$off_loc = $_POST['off_loc'];
	$rep_month = $_POST['rep_month'];
	$rep_year = $_POST['rep_year'];
	$target = $_POST['target'];
	$amt_coll = $_POST['amt_coll'];
	//$total_amt_coll = $_POST['total_amt_coll'];
	$auto_date = time();
	$show_date = date("d/m/Y H:i", $auto_date);
	$added_by = $user_name;
	
	$total_amt_coll = " ";
	
	$exist = "SELECT * from train_cont where office_location = ".$off_loc." AND month = ".$rep_month." AND year = '".$rep_year."'";
	
	$res_exist = mysqli_query( $connect, $exist) or
	die("Error selecting from database ".mysqli_error($GLOBALS["___mysqli_ston"]));
	
	$row_exist = mysqli_num_rows($res_exist);
	
	if($row_exist == 0){
		$staff_info = "INSERT INTO train_cont VALUES (null, $off_type, $off_loc, $rep_month, '$rep_year', '$show_date', '$added_by', $target, $amt_coll, $total_amt_coll)";
	
		mysqli_query( $connect, $staff_info) or
		die("Error connecting to server ".mysqli_error($GLOBALS["___mysqli_ston"]));
		
		header("Location: training_contribution.php");
	} else {
		header("Location: view_training_contribution.php?err=exist");
	}
}
?>