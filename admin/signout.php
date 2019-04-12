<?php
	include("../includes/checkUser.php");
	include("../includes/connections.php");

$uniquePass = rand(000001, 999999);
	if(isset($_SESSION['user_name'])){
	$logged_out = "UPDATE staff_reg SET logged_users='0' WHERE username='".$_SESSION['user_name']."'";
				$loggedResult = mysqli_query($GLOBALS["___mysqli_ston"], $logged_out); //echo $logged_out; exit;
				session_destroy();
	header("location:../index.php?msg=You have successfully signed out&rand=".sha1($uniquePass)."");
	}
?>

