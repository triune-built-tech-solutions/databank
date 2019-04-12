<?php
session_start();
require_once("../includes/connections.php");

$username = $_SESSION['user_name'];

if(isset($_POST['submit'])){
	$headings = $_POST['headings'];
	$homeP = $_POST['homeP'];
	$auto_date = time();
	$show_date = date("d/m/Y H:i", $auto_date);
	
	$query = "INSERT INTO home_page VALUES (null, '$headings', '$homeP', '$username', '$show_date')";
	
	mysqli_query( $connect, $query);
	
	header("Location: home.php");
}

?>