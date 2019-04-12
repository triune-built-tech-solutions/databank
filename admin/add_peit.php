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
	$surv_c_o = $_POST['surv_c_o'];
	$packages_dev = $_POST['packages_dev'];
	$implemented = $_POST['implemented'];
	$participants = $_POST['participants'];
	$auto_date = time();
	$show_date = date("d/m/Y H:i", $auto_date);
	$added_by = $user_name;
	
	//$exist = "SELECT * from peit where office_location = ".$off_loc." AND month = ".$rep_month." AND year = '".$rep_year."'";
	
	//$res_exist = mysql_query($exist, $connect) or
	//die("Error selecting from database ".mysql_error());
	
	//$row_exist = mysql_num_rows($res_exist);
	
	if($row_exist == 0 || $row_exist == 1){
		$staff_info = "INSERT INTO peit VALUES (null, $off_type, $off_loc, $rep_month, '$rep_year', '$show_date', '$added_by', $target, $surv_c_o, $packages_dev, $implemented, $participants)";
	
		mysqli_query( $connect, $staff_info) or
		die("Error connecting to server ".mysqli_error($GLOBALS["___mysqli_ston"]));
	
		header("Location: peit.php");
	} else {
		header("Location: view_peit.php?err=exist");
	}
}
?>
