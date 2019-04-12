<?php
session_start();
require_once("../includes/connections.php");

if(isset($_POST['dept_id'])){
	
	$dept_id = $_POST['dept_id'];
	
	$prog_res = mysqli_query( $connect, "SELECT * from department where id = $dept_id")or
	die("error selecting from db ".mysqli_error($GLOBALS["___mysqli_ston"]));
	while($sub_prog = mysqli_fetch_array($prog_res)){
		echo $sub_prog['1'];
	}
}
?>
