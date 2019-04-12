<?php
session_start();
require_once("../includes/connections.php");

if(isset($_POST['rep_year'])){
	$rep_year = $_POST['rep_year'];
	$_SESSION['prog_year'] = $rep_year;

	$query_prog_no = "Select * from prog_no where prog_year = $rep_year";
	
	$result_prog_no = mysqli_query( $connect, $query_prog_no) or
	die("Error connecting to server".mysqli_error($GLOBALS["___mysqli_ston"]));
	
	$em = "<option value=' '>SELECT</option>";
	
	while($row_prog_no = mysqli_fetch_array($result_prog_no)){
		$em .= "<option value='". $row_prog_no[1] ."'>". $row_prog_no[1] . "</option>";
	}
	
	echo $em;
}
?>