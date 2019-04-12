<?php
require_once("../includes/connections.php");

if(isset($_POST['usrname'])){
	$name = $_POST['usrname'];
	
	$result = mysqli_query($GLOBALS["___mysqli_ston"], "select * from staff_reg where username = '$name'");
	$row = mysqli_num_rows($result);
		echo $row;
}
?>