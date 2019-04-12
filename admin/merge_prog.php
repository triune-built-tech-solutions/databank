<?php
session_start();

require_once("../includes/connections.php");
require_once("../functions/function.php");

if(isset($_POST['migrate_prog'])){
	$year = $_POST['year_copy'];
	$year1 = $_POST['year_copy1'];
	
	
	$quer = "SELECT * from prog_no where prog_year = '$year' order by prog_no";
	$result = mysqli_query( $connect, $quer) or
	die("Error connecting to server ".mysqli_error($GLOBALS["___mysqli_ston"]));
	
	for($i=0; $i<mysqli_num_rows($result); $i++){
		$id = mysqli_result($result,  $i,  "id");
		$prog_no = mysqli_result($result,  $i,  "prog_no");
		$prog_titl = mysqli_result($result,  $i,  "programme");
		$prog_year = mysqli_result($result,  $i,  "prog_year");
		
		$prog_titl = mysql_prep($prog_titl);
		
		$query_merge = "INSERT into prog_no VALUES (null, $prog_no, '$prog_titl', $year1)";
		mysqli_query( $connect, $query_merge) or
		die("Error connecting to server ".mysqli_error($GLOBALS["___mysqli_ston"]));
		
	}
	
	$quer_sub = "SELECT * from sub_prog_no where sub_year = '$year'";
	$result_sub = mysqli_query( $connect, $quer_sub) or
	die("Error connecting to server ".mysqli_error($GLOBALS["___mysqli_ston"]));
	
	for($i=0; $i<mysqli_num_rows($result_sub); $i++){
		$id = mysqli_result($result_sub,  $i,  "id");
		$prog_id = mysqli_result($result_sub,  $i,  "prog_id");
		$sub_no = mysqli_result($result_sub,  $i,  "sub_no");
		$sub_prog_titl = mysqli_result($result_sub,  $i,  "title_sub_prog");
		$prog_year = mysqli_result($result_sub,  $i,  "sub_year");
		
		$sub_prog_titl = mysql_prep($sub_prog_titl);
		$sub_no = mysql_prep($sub_no);
		
		$query_merge_sub = "INSERT into sub_prog_no VALUES (null, $prog_id, '$sub_no', '$sub_prog_titl', $year1)";
		mysqli_query( $connect, $query_merge_sub) or
		die("Error connecting to server ".mysqli_error($GLOBALS["___mysqli_ston"]));
		
	}
	
	$quer_obj = "SELECT * from obj_no where obj_year = '$year'";
	$result_obj = mysqli_query( $connect, $quer_obj) or
	die("Error inserting to database ".mysqli_error($GLOBALS["___mysqli_ston"]));
	
	for($i=0; $i<mysqli_num_rows($result_obj); $i++){
		$id = mysqli_result($result_obj,  $i,  "id");
		$sub_prog_no_id = mysqli_result($result_obj,  $i,  "sub_prog_no_id");
		$obj_no = mysqli_result($result_obj,  $i,  "obj_no");
		$objective = mysqli_result($result_obj,  $i,  "objective");
		$obj_year = mysqli_result($result_obj,  $i,  "obj_year");
		
		$objective = mysql_prep($objective);
		$obj_no = mysql_prep($obj_no);
		
		$query_merge_obj = "INSERT into obj_no VALUES (null, '$sub_prog_no_id', '$obj_no', '$objective', $year1)";
		mysqli_query( $connect, $query_merge_obj) or
		die("Error inserting to database ".mysqli_error($GLOBALS["___mysqli_ston"]));
		
	}
	

	header("Location: itf_prog.php");

}
?>