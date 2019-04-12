<?php
session_start();

include("../includes/connections.php");

$user_name = $_SESSION['user_name'];

if(isset($_POST['submit'])){
	$off_type = $_POST['off_type'];
	$off_loc = $_POST['off_loc'];
	$rep_month = $_POST['rep_month'];
	$rep_year = $_POST['rep_year'];
	$reg_t_date = $_POST['reg_t_date'];
	$dis_d_month = $_POST['dis_d_month'];
	$reg_d_month = $_POST['reg_d_month'];
	$cont_t_date = $_POST['cont_t_date'];
	$defaulting = $_POST['defaulting'];
	$ord_defaulting = $_POST['ord_defaulting'];
	$chr_defaulting = $_POST['chr_defaulting'];
	$auto_date = time();
	$show_date = date("d/m/Y H:i", $auto_date);
	$added_by = $user_name;
	
	$exist = "SELECT * from emp_stat where office_location = ".$off_loc." AND month = ".$rep_month." AND year = '".$rep_year."'";
	
	$res_exist = mysqli_query( $connect, $exist) or
	die("Error selecting from database ".mysqli_error($GLOBALS["___mysqli_ston"]));
	
	$row_exist = mysqli_num_rows($res_exist);
	
	if($row_exist == 0){
		$staff_info = "INSERT INTO emp_stat VALUES (null, $off_type, $off_loc, $rep_month, '$rep_year', '$show_date', '$added_by', $reg_t_date, $dis_d_month, $reg_d_month, $cont_t_date, $defaulting, $ord_defaulting, $chr_defaulting)";
	
		mysqli_query( $connect, $staff_info) or
		die("Error connecting to server".mysqli_error($GLOBALS["___mysqli_ston"]));
		
		header("Location: emp_stat.php");
	} else {
		header("Location: view_emp_stat.php?err=exist");
	}
}
?>