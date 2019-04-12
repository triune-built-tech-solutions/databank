<?php
session_start();

include("../includes/connections.php");

$user_name = $_SESSION['user_name'];

if(isset($_POST['submit'])){
	$off_type = $_POST['off_type'];
	$off_loc = $_POST['off_loc'];
	$rep_month = $_POST['rep_month'];
	$rep_year = $_POST['rep_year'];
	$exp_rev = $_POST['exp_rev'];
	$amt_coll = $_POST['amt_coll'];
	$amt_outs = $_POST['amt_outs'];
	$amt_budg = $_POST['amt_budg'];
	$amt_expen = $_POST['amt_expen'];
	$prog_imp = $_POST['prog_imp'];
	$net_rev = $_POST['net_rev'];
	$auto_date = time();
	$show_date = date("d/m/Y H:i", $auto_date);
	$added_by = $user_name;
	
	$exist = "SELECT * from rev_fr_course where office_location = ".$off_loc." AND month = ".$rep_month." AND year = '".$rep_year."'";
	
	$res_exist = mysqli_query( $connect, $exist) or
	die("Error selecting from database ".mysqli_error($GLOBALS["___mysqli_ston"]));
	
	$row_exist = mysqli_num_rows($res_exist);
	
	if($row_exist == 0 || $row_exist == 1){
		$staff_info = "INSERT INTO rev_fr_course VALUES (null, $off_type, $off_loc, $rep_month, '$rep_year', '$show_date', '$added_by', $exp_rev, $prog_imp, $amt_budg, $amt_expen, $net_rev, $amt_coll, $amt_outs)";
	
		mysqli_query( $connect, $staff_info) or
		die("Error connecting to server ".mysqli_error($GLOBALS["___mysqli_ston"]));
	
		header("Location: revenue_gen.php");
	} else {
		header("Location: view_revenue_gen.php?err=exist");
	}
}
?>