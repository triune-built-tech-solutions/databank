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
	$std_c_o = $_POST['std_c_o'];
	$int_dev = $_POST['int_dev'];
	$int_imp = $_POST['int_imp'];
	$auto_date = time();
	$show_date = date("d/m/Y H:i", $auto_date);
	$added_by = $user_name;
	
	$exist = "SELECT * from msme where office_location = ".$off_loc." AND month = ".$rep_month." AND year = '".$rep_year."'";
	
	$res_exist = mysqli_query( $connect, $exist) or
	die("Error selecting from database ".mysqli_error($GLOBALS["___mysqli_ston"]));
	
	$row_exist = mysqli_num_rows($res_exist);
	
	if($row_exist == 0){
		$staff_info = "INSERT INTO msme VALUES (null, $off_type, $off_loc, $rep_month, '$rep_year', '$show_date', '$added_by', $target, $std_c_o, $int_dev, $int_imp)";
	
		mysqli_query( $connect, $staff_info) or
		die("Error connecting to server ".mysqli_error($GLOBALS["___mysqli_ston"]));
		
		header("Location: indepth_diagnostic.php");
	} else {
		header("Location: view_indepth_diagnostic.php?err=exist");
	}
}
?>