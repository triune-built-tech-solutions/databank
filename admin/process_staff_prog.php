<?php
session_start();

$user_name = $_SESSION['user_name'];

require_once("../includes/connections.php");

if(isset($_POST['submit'])){
		$nom_id = $_POST['nom_id'];
		$train_type = $_POST['type'];
		$prog_type = $_POST['prog_type'];
		$category = $_POST['category'];
		$title = $_POST['title'];
		$t_date = $_POST['t_date'];
		$f_date = $_POST['t_date_f'];
		$location = $_POST['location'];
		$consult = $_POST['consult'];
		$auto_date = time();
		$show_date = date("d/m/Y H:i", $auto_date);
		$added_by = $user_name;
		
	if(empty($train_type) && empty($prog_type) && empty($category) && empty($title) && empty($t_date) && empty($f_date) && empty($location) && empty($consult)){
			 $rpty = '?rpt=err';
		}else{
		
		
		$query = "INSERT INTO staff_prog VALUES(null, $nom_id, '$train_type', '$prog_type', '$category', '$title', '$t_date', '$f_date', '$consult', '$location', '$show_date', '$added_by')";
	
		mysqli_query( $connect, $query) or
	die ("Error Inserting to Table nominal" .mysqli_error($GLOBALS["___mysqli_ston"]));
	
			if($query){
	header("location:add_staff_prog.php?rpt=Successfully");
	 }else{
            $rpty = '?rpt=err';
}
	}
	}
if(isset($_POST['next'])){
		$nom_id = $_POST['nom_id'];
		$train_type = $_POST['type'];
		$prog_type = $_POST['prog_type'];
		$title = $_POST['title'];
		$t_date = $_POST['t_date'];
		$f_date = $_POST['t_date_f'];
		$duration = $_POST['duration'];
		$location = $_POST['location'];
		$consult = $_POST['consult'];
		$auto_date = time();
		$show_date = date("d/m/Y H:i", $auto_date);
		$added_by = $user_name;
		
		if(empty($train_type) && empty($prog_type) && empty($category) && empty($title) && empty($t_date) && empty($f_date) && empty($location) && empty($consult)){
			$msg = "Please Fill All Fields to Continue";	
		}else{
		$query = "INSERT INTO staff_prog VALUES(null, $nom_id, '$train_type', '$prog_type', '$title', '$t_date', '$f_date', '$duration', '$consult', '$location', '$show_date', '$added_by')";
	
		mysqli_query( $connect, $query) or
	die ("Error Inserting to Table nominal" .mysqli_error($GLOBALS["___mysqli_ston"]));
	
		if($query){
	header("location: add_staff_prog.php?repId=".$nom_id." ");
	 }else{
            $rptys = '?rpt=Successfully';
}
	}
	}
?>