<?php
session_start();

require_once("../includes/connections.php");

if(isset($_POST['add_prog'])){
	$year = $_POST['year'];
	$prog_no = $_POST['prog_no'];
	$prog_titl = $_POST['prog_titl'];
	
	
	$quer = "INSERT into prog_no VALUES (null, $prog_no, '$prog_titl', $year)";
	mysqli_query( $connect, $quer) or
	die("Error connecting to server ".mysqli_error($GLOBALS["___mysqli_ston"]));

	header("Location: itf_prog.php");

}

if(isset($_POST['edit_prog'])){
	$year = $_POST['year'];
	$prog_no = $_POST['prog_no'];
	$prog_titl = $_POST['prog_titl'];
	
	$quer = "UPDATE prog_no SET programme = '$prog_titl' where prog_no = $prog_no and prog_year = $year";
	
	mysqli_query( $connect, $quer) or
	die("Error connecting to server ".mysqli_error($GLOBALS["___mysqli_ston"]));

	header("Location: itf_prog.php");
}

?>