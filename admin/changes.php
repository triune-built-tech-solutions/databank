<?php
include("../includes/connections.php");

if(isset($_POST['resetIt'])){
	
	$name = $_POST['na'];
	$password = $_POST['pass'];
	$hashed_password = md5($password);
	
	$que = "update staff_reg set password ='".$hashed_password."' where username ='".$name."' ";
	
	mysqli_query( $connect, $que) or
	die("Error connecting to server". mysqli_error($GLOBALS["___mysqli_ston"]));
	
	header("Location: pword_change.php");
}
?>