<?php
session_start();

$user_name = $_SESSION['user_name'];

require_once("../includes/connections.php");

if(isset($_POST['submit'])){
		$nom_id = $_POST['nom_id'];
		$train_type = $_POST['type'];
		$title = $_POST['title'];
		$t_date = $_POST['t_date'];
		$f_date = $_POST['t_date_f'];
		//$duration = $_POST['duration'];
		$location = $_POST['location'];
		$auto_date = time();
		$show_date = date("d/m/Y H:i", $auto_date);
		$added_by = $user_name;
		
		$query = "UPDATE staff_prog SET type = '$train_type', title = '$title', train_date = '$t_date', finish_date = '$f_date', location = '$location' where id = $nom_id";
	
		mysqli_query( $connect, $query) or
	die ("Error Inserting to Table nominal" .mysqli_error($GLOBALS["___mysqli_ston"]));
	
	header("location: view_nominal.php");
}

?>