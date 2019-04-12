<?php
session_start();

include("../includes/connections.php");

$user_name = $_SESSION['user_name'];
if($_GET['id'])
{
$id=$_GET['id'];

 $sql = "delete FROM new_training WHERE id='$id'";
 $res = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
 	if($res){
header("location:edit_new_training.php");
	}

}

?>