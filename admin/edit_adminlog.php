<?php
session_start();

$user_name = $_SESSION['user_name'];

require_once("../includes/connections.php");

if(isset($_POST['edit_department'])){
	$id = $_POST['dept_edit'];
	$department = $_POST['dept_titl'];
	
	$query = mysqli_query( $connect, "UPDATE department SET department = '$department' where id = $id")or
	die("Error updating database ".mysqli_error($GLOBALS["___mysqli_ston"]));
	
	header("Location: admin_log.php");
	
}
if(isset($_POST['del_department'])){
	$id = $_POST['dept_edit'];
	$department = $_POST['dept_titl'];
	
	$query = mysqli_query( $connect, "DELETE FROM department  where id = $id")or
	die("Error updating database ".mysqli_error($GLOBALS["___mysqli_ston"]));
	
	header("Location: admin_log.php");
	
}

if(isset($_POST['edit_division'])){
	$dept_id = $_POST['department1'];
	$div_id = $_POST['division1'];
	$division = $_POST['div_edit'];
	
	$query = mysqli_query( $connect, "UPDATE division SET division = '$division' where id = $div_id")or
	die("Error updating database ".mysqli_error($GLOBALS["___mysqli_ston"]));
	
	header("Location: admin_log.php");
	
}
if(isset($_POST['del_division'])){
	$dept_id = $_POST['department1'];
	$div_id = $_POST['division1'];
	$division = $_POST['div_edit'];
	
	$query = mysqli_query( $connect, "DELETE FROM  division where id = $div_id")or
	die("Error updating database ".mysqli_error($GLOBALS["___mysqli_ston"]));
	
	header("Location: admin_log.php");
	
}


if(isset($_POST['edit_section'])){
	$sect = $_POST['sect'];
	$sec_edit = $_POST['sec_edit'];
	
	$query = mysqli_query( $connect, "UPDATE section SET section_name = '$sec_edit' where section_id = $sect")or
	die("Error updating database ".mysqli_error($GLOBALS["___mysqli_ston"]));
	
	header("Location: admin_log.php");
	
}
if(isset($_POST['del_section'])){
	$sect = $_POST['sect'];
	$sec_edit = $_POST['sec_edit'];
	
	$query = mysqli_query( $connect, "DELETE FROM  section where section_id = $sect")or
	die("Error updating database ".mysqli_error($GLOBALS["___mysqli_ston"]));
	
	header("Location: admin_log.php");
	
}

if(isset($_POST['edit_off'])){
	$sect = $_POST['office_location'];
	$sec_edit = $_POST['loc_edit'];
	
	$query = mysqli_query( $connect, "UPDATE area_office SET area_office_name = '$sec_edit' where id = $sect")or
	die("Error updating database ".mysqli_error($GLOBALS["___mysqli_ston"]));
	
	header("Location: admin_log.php");
	
}