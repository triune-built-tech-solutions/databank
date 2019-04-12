<?php
include '../includes/connections.php';

$ins="insert into vehicles values(null,'$_POST[make]','$_POST[colour]','$_POST[chassis]','$_POST[engine]','$_POST[registration]','$_POST[date_purchase]','$_POST[price]','$_POST[location]','$_POST[use]')";

$q=mysqli_query($GLOBALS["___mysqli_ston"], $ins);
if(!$q){
	print mysqli_error($GLOBALS["___mysqli_ston"]);
	exit;	
}

header("location:add_vehicle.php");
?>