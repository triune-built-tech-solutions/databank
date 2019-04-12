<?php
session_start();
require_once("../includes/connections.php");
require_once("header.php");

$sn = $_SESSION['edId'];

require_once("../functions/function.php");

if(isset($_POST['edit_rep']) && !empty($_POST['activities'])){
	$activities = $_POST['activities'];
	$archievements = $_POST['archievements'];
	$constraints = $_POST['constraints'];
	
	$activities = mysql_prep($activities);
	$archievements = mysql_prep($archievements);
	$constraints = mysql_prep($constraints);
	
	$edit = "UPDATE report_log SET activities = '$activities', achievements = '$archievements', constraints = '$constraints' WHERE id = $sn";
	
	mysqli_query( $connect, $edit) or
	die("Error connecting to server". mysqli_error($GLOBALS["___mysqli_ston"]));
	
	header("Location: vet_report.php");
} else {
	header("location: vet_report.php");
}
?>