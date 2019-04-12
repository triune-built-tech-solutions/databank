<?php
session_start();

include("../includes/connections.php");

$user_name = $_SESSION['user_name'];

if(isset($_POST['submit'])){
	$off_type = $_POST['off_type'];
	$off_loc = $_POST['off_loc'];
	$rep_month = $_POST['rep_month'];
	$rep_year = $_POST['rep_year'];
	$part_inst = $_POST['part_inst'];
	$orien_d_month = $_POST['orien_d_month'];
	$zonal_meet = $_POST['zonal_meet'];
	$std_plc_d_m = $_POST['std_plc_d_m'];
	$std_eligable = $_POST['std_eligable'];
	$std_paid = $_POST['std_paid'];
	$amt_paid = $_POST['amt_paid'];
	$sup_all_p = $_POST['sup_all_p'];
	$stud_inv = $_POST['stud_inv'];
	$auto_date = time();
	$show_date = date("d/m/Y H:i", $auto_date);
	$added_by = $user_name;
	
	//$exist = "SELECT * from siwes_matters where office_location = ".$off_loc." AND month = ".$rep_month." AND year = '".$rep_year."'";
	
	//$res_exist = mysql_query($exist, $connect) or
	//die("Error selecting from database ".mysql_error());
	
	//$row_exist = mysql_num_rows($res_exist);
	
	if($row_exist == 0 || $row_exist == 1){
		$staff_info = "INSERT INTO siwes_matters VALUES (null, $off_type, $off_loc, $rep_month, '$rep_year', '$show_date', '$added_by', $part_inst, $orien_d_month, $zonal_meet, $std_plc_d_m, $std_eligable, $std_paid, $amt_paid, $sup_all_p,  $stud_inv)";
	
		mysqli_query( $connect, $staff_info) or
		die("Error connecting to server ".mysqli_error($GLOBALS["___mysqli_ston"]));
		
		header("Location: siwes_matters.php");
	} else {
		header("Location: view_siwes_matters.php?err=exist");
	}
}
?>