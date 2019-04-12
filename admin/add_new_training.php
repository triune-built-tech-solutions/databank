<?php
session_start();

include("../includes/connections.php");

$user_name = $_SESSION['user_name'];

if(isset($_POST['submit'])){
	$off_type = $_POST['off_type'];
	$off_loc = $_POST['off_loc'];
	$rep_month = $_POST['rep_month'];
	$rep_year = $_POST['rep_year'];
	$target = $_POST['target'];
	$proposed = $_POST['proposed'];
	$test_runned = $_POST['test_runned'];
	$participants = $_POST['participants'];
	$organizations = $_POST['organizations'];
	$category = $_POST['category'];
	$auto_date = time();
	$show_date = date("d/m/Y H:i", $auto_date);
	$added_by = $user_name;
	
	//$exist = "SELECT * from new_training where office_location = ".$off_loc." AND month = ".$rep_month." AND year = '".$rep_year."'";
	
	//$res_exist = mysql_query($exist, $connect) or
	//die("Error selecting from database ".mysql_error());
	
	//$row_exist = mysql_num_rows($res_exist);
	
	if($row_exist == 0 || $row_exist == 1){
		$staff_info = "INSERT INTO new_training VALUES (null, $off_type, $off_loc, $rep_month, '$rep_year', '$show_date', '$added_by', $target, $proposed, $test_runned, $participants, $organizations, '$category')";
	
		mysqli_query( $connect, $staff_info) or
		die("Error connecting to server ".mysqli_error($GLOBALS["___mysqli_ston"]));
		
		header("Location: new_training.php");
	} else {
		header("Location: view_new_training.php?err=exist");
	}
}
?>