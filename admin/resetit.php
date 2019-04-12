<?php
require_once("../includes/connections.php");

if(isset($_POST['resetIt'])){
	
	$password = $_POST['pass'];
	$password = md5($password);
	
	mysqli_query( $connect, "UPDATE staff_reg SET password ='".$password."' where id = '".$pass_id);
}

	header("location: reset_password.php");

?>