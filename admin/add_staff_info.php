<?php
session_start();

include("../includes/connections.php");

$user_name = $_SESSION['user_name'];

if(isset($_POST['submit'])){
	$off_type = $_POST['off_type'];
	$off_loc = $_POST['off_loc'];
	$rep_month = $_POST['rep_month'];
	$rep_year = $_POST['rep_year'];
	$sen_staff = $_POST['sen_staff'];
	$jun_staff = $_POST['jun_staff'];
	$oth_staff = $_POST['oth_staff'];
	$staff_dis = $_POST['staff_dis'];
	$auto_date = time();
	$show_date = date("d/m/Y H:i", $auto_date);
	$added_by = $user_name;
		
	$exist = "SELECT * from staff_info where office_location = ".$off_loc." AND month = ".$rep_month." AND year = '".$rep_year."'";
	
	$res_exist = mysqli_query( $connect, $exist) or
	die("Error selecting from database ".mysqli_error($GLOBALS["___mysqli_ston"]));
	
	$row_exist = mysqli_num_rows($res_exist);
	
	if($row_exist == 0){
		
		$staff_info = "INSERT INTO staff_info (office_type, office_location, month, year, auto_date, added_by, senior_staff, junior_staff, non_staff, staff_dis)VALUES ('$off_type', '$off_loc', '$rep_month', '$rep_year', '$show_date', '$added_by', '$sen_staff', '$jun_staff', '$oth_staff', '$staff_dis')";
		
		mysqli_query( $connect, $staff_info) or
		die("Error connecting to server".mysqli_error($GLOBALS["___mysqli_ston"]));

		header("Location: staff_info.php");
	} else {
		header("Location: view_staff_info.php?err=exist");
	}
} 
?>