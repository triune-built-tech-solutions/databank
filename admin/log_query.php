<?php

session_start();
$id = $_SESSION['user_id'];

require_once("../functions/function.php");

require_once("../includes/connections.php");

if(isset($_POST['submit'])){
	$report_type = $_POST['report_type'];
	$month = $_POST['month'];
	$year = $_POST['year'];
	$annual_target = $_POST['annual_target'];
	$month_f = $_POST['month_f'];
	$month_t = $_POST['month_t'];
	$prog_no = $_POST['prog_no'];
	$sub_prog_no = $_POST['sub_prog_no'];
	$obj_no = $_POST['obj_no'];
	$activities =$_POST['activities'];
	$achievements =$_POST['achievements'];
	$constraint = $_POST['constraint'];
	//$date = time();
	$auto_date = time();
	$show_date = date("d/m/Y H:i", $auto_date);

	$activities = mysql_prep($activities);
	$achievements = mysql_prep($achievements);
	$constraint = mysql_prep($constraint);
	
	$query = "SELECT * FROM staff_reg where id = $id ";
	$result = mysqli_query( $connect, $query);
	
	while($row = mysqli_fetch_assoc($result)){
		$username = $row['username'];
		$office_type = $row['office_type'];
		$office_location = $row['office_location'];
		$department = $row['department'];
		$section = $row['section_id'];
		$division = $row['div_id'];
		$unit = $row['unit'];
		$sub_unit = $row['sub_unit'];
	}
	
	if($department == ""){
		$log_query = "INSERT INTO report_log VALUES (null, '$report_type', '$month', '$year', '$annual_target', '$month_f', '$month_t', '$prog_no', '$sub_prog_no', '$obj_no', '$office_type', '$office_location', null, null, null, '$unit', '$sub_unit', '$username', '$show_date', '$activities', '$achievements', '$constraint', 1)";
	} else {
		$log_query = "INSERT INTO report_log VALUES (null, '$report_type', '$month', '$year', '$annual_target', '$month_f', '$month_t', '$prog_no', '$sub_prog_no', '$obj_no', '$office_type', '$office_location', '$department', '$division', '$section', null, null, '$username', '$show_date', '$activities', '$achievements', '$constraint', 1)";
	}
	
	mysqli_query( $connect, $log_query) or
die ("Error Connecting to Server" .mysqli_error($GLOBALS["___mysqli_ston"]));
	
}

header("location: report.php?msg=success");

?>