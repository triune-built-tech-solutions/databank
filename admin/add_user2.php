<?php
session_start();

$user_name = $_SESSION['user_name'];

require_once("../includes/connections.php");

if(isset($_POST['submit']) && $_POST['surname'] != ""){
		$surname = $_POST['surname'];
	
		$query = "INSERT INTO fred VALUES(null, '$surname')";
	
		mysqli_query( $connect, $query) or
	die ("Error Inserting to Table fred" .mysqli_error($GLOBALS["___mysqli_ston"]));
	
	header("location: add_user2.php");
} else 
	header("location: add_user2.php");
?>