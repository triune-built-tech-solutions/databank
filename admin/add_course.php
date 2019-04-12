<?php
session_start();

include("../includes/connections.php");

$user_name = $_SESSION['user_name'];

if(isset($_POST['submit'])){
	$off_type = $_POST['off_type'];
	$off_loc = $_POST['off_loc'];
	$rep_month = $_POST['rep_month'];
	$rep_year = $_POST['rep_year'];
	$comp_req = $_POST['comp_req'];
	$cous_app = $_POST['cous_app'];
	$cous_app_over = $_POST['cous_app_over'];
	$cous_rej = $_POST['cous_rej'];
	$cous_rej_over = $_POST['cous_rej_over'];
	$trainees = $_POST['trainees'];
	$app_prog = $_POST['app_prog'];
	$trainees_f_c = $_POST['trainees_f_c'];
	$comp_invl = $_POST['comp_invl'];
	$auto_date = time();
	$show_date = date("d/m/Y H:i", $auto_date);
	$added_by = $user_name;
	
	//$exist = "SELECT * from course_approvals where office_location = ".$off_loc." AND month = ".$rep_month." AND year = '".$rep_year."'";
	
	//$res_exist = mysql_query($exist, $connect) or
	//die("Error selecting from database ".mysql_error());
	
	//$row_exist = mysql_num_rows($res_exist);
	
	if($row_exist == 0 || $row_exist == 1){
		$staff_info = "INSERT INTO course_approvals VALUES (null, $off_type, $off_loc, $rep_month, '$rep_year', '$show_date', '$added_by', $comp_req, $cous_app, $cous_app_over, $cous_rej, $cous_rej_over, $trainees, $app_prog, $trainees_f_c, $comp_invl)";
	
		mysqli_query( $connect, $staff_info) or
		die("Error connecting to server".mysqli_error($GLOBALS["___mysqli_ston"]));
		
		header("Location: course_approval.php");
	} else {
		header("Location: view_course_approval.php?err=exist");
	}
}
?>