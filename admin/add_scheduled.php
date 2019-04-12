<?php
session_start();

include("../includes/connections.php");

$user_name = $_SESSION['user_name'];

if(isset($_POST['submit'])){
	$off_type = $_POST['off_type'];
	$off_loc = $_POST['off_loc'];
	$rep_month = $_POST['rep_month'];
	$rep_year = $_POST['rep_year'];
	$training = $_POST['training'];
	$implemented = $_POST['implemented'];
	$participants = $_POST['participants'];
	$organization = $_POST['organization'];
	$prog_title = $_POST['prog_title'];
	$duration = $_POST['duration'];
	$rev_f_c = $_POST['revenue'];
	$rev_c = $_POST['rev_c'];
	$rev_t = $_POST['rev_t'];
	$auto_date = time();
	$show_date = date("d/m/Y H:i", $auto_date);
	$added_by = $user_name;
	
	//$exist = "SELECT * from scheduled_training where office_location = ".$off_loc." AND month = ".$rep_month." AND year = '".$rep_year."'";
	
	//$res_exist = mysql_query($exist, $connect) or
	//die("Error selecting from database ".mysql_error());
	
	//$row_exist = mysql_num_rows($res_exist);
	
	if($row_exist == 0){
		$staff_info = "INSERT INTO scheduled_training VALUES (null, $off_type, $off_loc, $rep_month, '$rep_year', '$show_date', '$added_by', $training, $implemented, $participants, $organization, '$prog_title', '$duration', '$rev_f_c', '$rev_c', '$rev_t')";
		
		mysqli_query( $connect, $staff_info) or
		die("Error connecting to server ".mysqli_error($GLOBALS["___mysqli_ston"]));
		
		header("Location: scheduled_training.php");
	} else {
		header("Location: view_scheduled_training.php?err=exist");
	}
}
?>