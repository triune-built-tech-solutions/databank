<?php
session_start();
require_once("../includes/connections.php");

if(isset($_POST['year'])){
	$year = $_POST['year'];
	$_SESSION['prog_year'] = $year;

	$query_prog_no = "Select * from prog_no where prog_year = $year";
	$result_prog_no = mysqli_query( $connect, $query_prog_no);

	$em = "<option value='0'>SELECT</option>";
	
	$cnt = 1;
	while($row_prog_no = mysqli_fetch_array($result_prog_no)){
		$cnt++;
		$em .= "<option value='". $row_prog_no[1] ."'>". $row_prog_no[1] . "</option>";
	}
		$em .= "<option value'".$cnt."'>".$cnt."</option>";
		
		echo $em;
}
?>