<?php
session_start();

require_once("../includes/connections.php");

$user_name = $_SESSION['user_name'];

if(isset($_POST['submit'])){
	$off_type = $_POST['off_type'];
	$off_loc = $_POST['off_loc'];
	$rep_month = $_POST['rep_month'];
	$rep_year = $_POST['rep_year'];
	$heading = $_POST['heading'];
	$added_by = $user_name;
	$auto_date = time();
	$show_date = date("d/m/Y H:i", $auto_date);
	
	$number = mt_rand(100, 999999);
	$another_number = mt_rand(10, 999);
	$uniq = $number.$another_number;
	$pass = "file".$uniq;
	
	$loc = "uploaded/";
	
	$filez = explode(".", $_FILES['m_file']['name']);
	$fi = $filez[1];
	if($fi == 'doc' || $fi == 'pdf'){
		
		$file = explode(".", $_FILES['m_file']['name']);
		
		$newname = "$pass.$file[1]";
		
		$query = "INSERT INTO meeting VALUES (null, $off_type, $off_loc, '$added_by', $rep_month, '$rep_year', '$heading', '$newname', '$show_date')";
		
		mysqli_query( $connect, $query) or
		die("Error inserting into database ".mysqli_error($GLOBALS["___mysqli_ston"]));
		
		$path = "$loc$newname";
		
		move_uploaded_file($_FILES['m_file']['tmp_name'], $path);
		
		header("Location: meeting.php");
	} else {
		header("Location: meeting.php?error=1");
	}
}
?>