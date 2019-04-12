<?php
session_start();

$user_name = $_SESSION['user_name'];

require_once("../includes/connections.php");
$target_d="passports/";
$target_file=$target_d.basename($_FILE["passport"]["name"]);
//$imagetype=pathinfo($target_file,PATHINFO_EXTENSION);
if(isset($_FILES['passport'])){
      $errors= array();
      $file_name = $_FILES['passport']['name'];
      $file_size =$_FILES['passport']['size'];
      $file_tmp =$_FILES['passport']['tmp_name'];
      $file_type=$_FILES['passport']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['passport']['name'])));
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"passports/".$file_name);
         echo "Success";
		 $target_file="passports/".$file_name;
      }else{
         print_r($errors);
      }
   }

if(isset($_POST['submit']) && $_POST['surname'] != ""){
		$surname = $_POST['surname'];
		$other_name = $_POST['other_name'];
		$staff_no = $_POST['staff_no'];
		$gender = $_POST['sex'];
		$job_title = $_POST['job_title'];
		$doa = $_POST['doa'];
		$dob = $_POST['dob'];
		$state = $_POST['state'];
		$auto_date = time();
		$show_date = date("d/m/Y H:i", $auto_date);
		$added_by = $user_name;
		
		$query = "INSERT INTO nominal VALUES(null, '$surname', '$other_name', '$staff_no', '$gender', '$job_title', '$doa', '$dob', '$state', '$show_date', '$added_by','$target_file')";
	
		mysqli_query( $connect, $query) or
	die ("Error Inserting to Table nominal" .mysqli_error($GLOBALS["___mysqli_ston"]));
	
	header("location: add_nominal.php");
} else 
	header("location: add_nominal.php");
?>