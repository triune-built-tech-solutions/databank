<?php
session_start();

require_once("../includes/connections.php");

$uname = $_POST['username'];
$pword = $_POST['password'];

$pword = md5($pword);

$query = "select * from staff_reg where username = '{$uname}' and password = '{$pword}' and freeze_id = 0";

$result = mysqli_query($connect, $query);

if(mysqli_num_rows($result) == 1){
	$logged_status = "UPDATE staff_reg SET logged_users='1' WHERE username = '{$uname}' and password = '{$pword}' and freeze_id = 0 ";
				$loggedResult = mysqli_query($logged_status);
	$row = mysqli_fetch_array($result);
	
	$_SESSION['user_id'] = $row['id'];
	$_SESSION['user_name'] = $row['username'];
	
	$office_type = $row['office_type'];
	$office_loc = $row['office_location'];
	$access_right = $row['access_right'];
	$dept = $row['department'];
	$div_id = $row['div_id'];
	$section_id = $row['section_id'];
	$unit = $row['unit'];
	$sub_unit = $row['sub_unit'];
	
	if(isset($dept)){
		$query_dept = "SELECT * FROM department where id = $dept";
		$result_dept = mysqli_query($connect, $query_dept);
		
		while($row_dept = mysqli_fetch_array($result_dept)){
			$depart = $row_dept[1];
		}
	} else {
		$query_unit = "SELECT * FROM unit where id = $unit";
		$result_unit = mysqli_query($connect, $query_unit);
			
			while($row_unit = mysqli_fetch_array($result_unit)){
				$depart = $row_unit[1];
			}
	}
	
	if(isset($div_id)){
		$query_div = "SELECT * FROM division where id = $div_id";
		$result_div = mysqli_query($connect, $query_div);
		
		while($row_div = mysqli_fetch_array($result_div)){
			$div = $row_div[2];
		}
	} else {
		$query_sub_unit = "SELECT * FROM sub_unit where id = $sub_unit";
		$result_sub_unit = mysqli_query( $connect, $query_sub_unit);
			
			while($row_sub_unit = mysqli_fetch_array($result_sub_unit)){
				$div = $row_sub_unit[2];
			}
	}
	
	$query_office = "SELECT type FROM office_type where id = $office_type";
	$result_office = mysqli_query($connect, $query_office);
	
	while($row_office = mysqli_fetch_assoc($result_office)){
		$office_t = $row_office['type'];
	}
	
	$query_office = "SELECT * FROM area_office where office_type_id = $office_type and id = $office_loc";
	$result_office = mysqli_query($connect, $query_office);
	
	while($row_office = mysqli_fetch_array($result_office)){
		$office_l = $row_office['2'];
	}
	
	$log_name = $_SESSION['user_name'];
	$ip_add = $_SERVER['REMOTE_ADDR'];
	$port = $_SERVER['REMOTE_PORT'];
	$protocol = $_SERVER['SERVER_PROTOCOL'];
	$auto_date = time();
	$show_date = date("d/m/Y H:i", $auto_date);
	
	$que = "INSERT INTO login_logger VALUES (null, '$log_name', '$show_date', '$office_t', '$office_l', '$access_right', '$depart', '$div', 'null', '$ip_add', '$protocol', '$port')";
	
	mysqli_query($connect, $que);
	
	header("Location: home.php");
} else {
	header("Location: ../index.php?msg=error");
}



?>