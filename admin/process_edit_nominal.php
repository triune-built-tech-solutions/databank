<?php
session_start();

$user_name = $_SESSION['user_name'];

require_once("../includes/connections.php");

if(isset($_POST['submit']) && $_POST['surname'] != ""){
		$surname = $_POST['surname'];
		$other_name = $_POST['other_name'];
		$staff_no = $_POST['staff_no'];
		$gender = $_POST['sex'];
		$job_title = $_POST['job_title'];
		$doa = $_POST['doa'];
		$dob = $_POST['dob'];
		$state = $_POST['state'];
		$repid = $_POST['repid'];
		$auto_date = time();
		$show_date = date("d/m/Y H:i", $auto_date);
		$added_by = $user_name;
		
		$query = "UPDATE nominal SET surname = '$surname', other_name = '$other_name', staff_no = '$staff_no', sex = '$gender', job_title = '$job_title', date_appt = '$doa', dob = '$dob', state = '$state' where id = $repid";
	
		mysqli_query( $connect, $query) or
	die ("Error updating Table nominal" .mysqli_error($GLOBALS["___mysqli_ston"]));
	header("location: edit_nominal.php?repId=$repid");
} else 
	header("location: edit_nominal.php");
?>