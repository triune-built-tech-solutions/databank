<?php
include("../includes/connections.php");

if(isset($_POST['resetIt'])){
	
	$name = $_POST['na'];
	$access_r = $_POST['access_right'];
	
	$que = "update staff_reg set access_right ='".$access_r."' where username ='".$name."' ";
	
	mysqli_query( $connect, $que) or
	die("Error connecting to server". mysqli_error($GLOBALS["___mysqli_ston"]));
	
	header("location: change_role.php");
}
?>