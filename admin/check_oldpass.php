<?php
session_start();
$id = $_SESSION['user_id'];

require_once("../includes/connections.php");

if(isset($_POST['oldp'])){
	
	$oldp = $_POST['oldp'];
	$oldp = md5($oldp);
	
	$result = mysqli_query($GLOBALS["___mysqli_ston"], "select * from staff_reg where password = '$oldp' and id = $id limit 1")or
	die("error connecting to server ".mysqli_error($GLOBALS["___mysqli_ston"]));
	$row = mysqli_num_rows($result);
		echo $row;
}
?>