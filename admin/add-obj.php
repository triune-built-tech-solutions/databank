<?php
require_once("../includes/connections.php");
require_once("../functions/function.php");

if(isset($_POST['adding_obj'])){
	$year = $_POST['oyear'];
	$sub_oprog_no = $_POST['sub_oprog_no'];
	$obj_no = $_POST['obj_no'];
	$obj_title = $_POST['obj_title'];
	
	$obj_title = mysql_prep($obj_title);
	$obj_no = mysql_prep($obj_no);
	
	$quer = "INSERT into obj_no VALUES (null, '$sub_oprog_no', '$obj_no', '$obj_title', $year)";
	mysqli_query( $connect, $quer) or
	die("Error connecting to server ".mysqli_error($GLOBALS["___mysqli_ston"]));

	header("Location: itf_prog.php");

}

if(isset($_POST['edit_obj'])){
	$year = $_POST['oyear'];
	$sub_oprog_no = $_POST['sub_oprog_no'];
	$obj_no = $_POST['obj_ono'];
	$obj_title = $_POST['obj_title'];
	
	$obj_title = mysql_prep($obj_title);
	$obj_no = mysql_prep($obj_no);

	
	$quer = "UPDATE obj_no SET objective = '$obj_title' WHERE sub_prog_no_id = '$sub_oprog_no' AND obj_no = '$obj_no' AND obj_year = $year";
	
	mysqli_query( $connect, $quer) or
	die("Error connecting to server ".mysqli_error($GLOBALS["___mysqli_ston"]));

	header("Location: itf_prog.php");
}

?>