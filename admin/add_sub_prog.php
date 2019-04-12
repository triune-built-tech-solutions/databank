<?php

require_once("../includes/connections.php");
require_once("../functions/function.php");

if(isset($_POST['add_sub'])){
	$year = $_POST['syear'];
	$sprog_no = $_POST['sprog_n'];
	$sub_no = $_POST['sub_no'];
	$sub_prog_title = $_POST['sub_prog_title'];
	
	$sub_prog_title = mysql_prep($sub_prog_title);
	$sub_no = mysql_prep($sub_no);
	
	$quer = "INSERT into sub_prog_no VALUES (null, $sprog_no, '$sub_no', '$sub_prog_title', $year)";
	mysqli_query( $connect, $quer) or
	die("Error connecting to server ".mysqli_error($GLOBALS["___mysqli_ston"]));

	header("Location: itf_prog.php");

}

if(isset($_POST['edit_sub'])){
	$syear = $_POST['syear'];
	$sprog_no = $_POST['sprog_n'];
	$sub_prog_no = $_POST['sub_prog_no'];
	$sub_no = $_POST['sub_no'];
	$sub_prog_title = $_POST['sub_prog_title'];
	
	$sub_prog_title = mysql_prep($sub_prog_title);
	$sub_prog_no = mysql_prep($sub_prog_no);
	
	$quer = "UPDATE sub_prog_no SET title_sub_prog = '$sub_prog_title' where sub_no = '$sub_prog_no' and sub_year = $syear";
	
	mysqli_query( $connect, $quer) or
	die("Error connecting to server ".mysqli_error($GLOBALS["___mysqli_ston"]));

	header("Location: itf_prog.php");
}

?>