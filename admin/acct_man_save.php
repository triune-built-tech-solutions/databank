<?php
session_start();
$id = $_SESSION['user_id'];
require_once("../includes/connections.php");

if(isset($_POST['user_edit'])){
	
	$staff_no = $_POST['staff_no'];
	$title = $_POST['title'];
	$first_name = $_POST['first_name'];
	$middle_name = $_POST['middle_name'];
	$last_name = $_POST['last_name'];
	$gender = $_POST['gender'];
	$office_type = $_POST['office_type'];
	$office_location = $_POST['office_location'];
	$department = $_POST['department'];
	$division = $_POST['division'];
	$section = $_POST['section'];
	$username = $_POST['username'];
	
	if($section == " "){
		$section = 'null';
	}
	
	mysqli_query( $connect, "UPDATE staff_reg SET staff_no = '{$staff_no}', title_id = {$title}, first_name = '{$first_name}', middle_name = '{$middle_name}', last_name = '{$last_name}', gender_id = {$gender}, office_type = {$office_type}, office_location = {$office_location}, department = {$department}, div_id = {$division}, section_id = {$section}, username = '{$username}' WHERE id = {$id}") or
	die("error ".mysqli_error($GLOBALS["___mysqli_ston"]));
}

header("location: manage_account.php");
?>