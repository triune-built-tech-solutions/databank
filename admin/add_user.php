<?php
session_start();

$user_name = $_SESSION['user_name'];

require_once("../includes/connections.php");

if(isset($_POST['submit_user']) && isset($_POST['office_location'])){
	if(isset($_POST['department'])){
		$staff_no = $_POST['staff_no'];
		$title = $_POST['title'];
		$first_name = $_POST['first_name'];
		$middle_name = $_POST['middle_name'];
		$last_name = $_POST['last_name'];
		$gender = $_POST['gender'];
		$office_type = $_POST['office_type'];
		$office_location = $_POST['office_location'];
		$access_right = $_POST['access_right'];
		$department = $_POST['department'];
		$division = $_POST['division'];
		$section = $_POST['section'];
		$unit = $_POST['unit'];
		$sub_unit = $_POST['sub_unit'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$conpassword = $_POST['conpassword'];
		$conpassword = md5($conpassword);
		$password = md5($password);
		$auto_date = time();
		$show_date = date("d/m/Y H:i", $auto_date);
		$added_by = $user_name;
		$logged_users = 0;
		if($department == " "){
			$department = 'null';
		}
		if($section == " "){
			$section = 'null';
		}
		if($division == " "){
			$division = 'null';
		}
		if($unit == " "){
			$unit = 'null';
		}
		if($sub_unit == " "){
			$sub_unit = 'null';
		}
	} else if(isset($_POST['unit'])){
		$staff_no = $_POST['staff_no'];
		$title = $_POST['title'];
		$first_name = $_POST['first_name'];
		$middle_name = $_POST['middle_name'];
		$last_name = $_POST['last_name'];
		$gender = $_POST['gender'];
		$office_type = $_POST['office_type'];
		$office_location = $_POST['office_location'];
		$access_right = $_POST['access_right'];
		$unit = $_POST['unit'];
		$sub_unit = $_POST['sub_unit'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$conpassword = $_POST['conpassword'];
		$conpassword = md5($conpassword);
		$password = md5($password);
		$auto_date = time();
		$show_date = date("d/m/Y H:i", $auto_date);
		$added_by = $user_name;
		$logged_users = 0;
	}
	
	if($middle_name == " "){
		$middle_name = 'null';
	}
	if($unit == " "){
			$unit = 'null';
		}
		if($sub_unit == " "){
			$sub_unit = 'null';
		}
	//$result = mysql_query("select * from staff_reg where username = '$username'");
	//$row = mysql_num_rows($result);

	//if($password == $conpassword && $row < 1 && $password !== " "){
		if(isset($department)){
			$query = "INSERT INTO staff_reg VALUES(null, '$staff_no', $title, '$first_name', '$middle_name', '$last_name', $gender, $office_type, $office_location, $access_right, $department, $division, $section, '$username', '$password', 0, '$added_by', '$show_date', '$unit', '$sub_unit', '$logged_users')";
		} else if(isset($unit)) {
			$query = "INSERT INTO staff_reg VALUES(null, '$staff_no', $title, '$first_name', '$middle_name', '$last_name', $gender, $office_type, $office_location, $access_right, null, null, null, '$username', '$password', 0, '$added_by', '$show_date', null, null, '$logged_users')";
		}
	
		mysqli_query( $connect, $query) or
	die ("Error Connecting to Server" .mysqli_error($GLOBALS["___mysqli_ston"]));
	} else {
		header("location: new_user.php?$eror='yes'");
	}
//}

header("location: new_user.php");
?>