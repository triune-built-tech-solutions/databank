<?php
session_start();

include("../includes/connections.php");

$user_name = $_SESSION['user_name'];

if(isset($_POST['submit'])){
	$off_type = $_POST['off_type'];
	$off_loc = $_POST['off_loc'];
	$rep_month = $_POST['rep_month'];
	$rep_year = $_POST['rep_year'];
	$prom_vis = $_POST['prom_vis'];
	$appraisal = $_POST['appraisal'];
	$inst_harm = $_POST['inst_harm'];
	$monitored = $_POST['monitored'];
	$harmonized = $_POST['harm_skill'];
	$provisional = $_POST['prov_appren'];
	$full_appren = $_POST['full_appren'];
	$auto_date = time();
	$show_date = date("d/m/Y H:i", $auto_date);
	$added_by = $user_name;

//exist = "SELECT * from industrial_training where office_location = ".$off_loc." AND month = ".$rep_month." AND year = '".$rep_year."'";
	
	//$res_exist = mysql_query($exist, $connect) or
	//die("Error selecting from database ".mysql_error());
	
	//$row_exist = mysql_num_rows($res_exist);
	
	if($row_exist == 0 || $row_exist == 1){
	
	$staff_info = "INSERT INTO industrial_training VALUES (null, $off_type, $off_loc, $rep_month, '$rep_year', '$show_date', '$added_by', $prom_vis, $appraisal, $inst_harm, $monitored, $harmonized, $provisional, $full_appren)";
	
	mysqli_query( $connect, $staff_info) or
	die("Error connecting to server ".mysqli_error($GLOBALS["___mysqli_ston"]));
	
		header("Location: industrial_training.php");
	} else {
		header("Location: industrial_training.php?err=exist");
	}
} 
?>
