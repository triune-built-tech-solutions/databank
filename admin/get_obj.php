<?php
session_start();
require_once("../includes/connections.php");

$sub_p = $_SESSION['sub_prog_id'];

$prog_year = $_SESSION['prog_year'];

if(isset($_POST['obj_id'])){
	$obj_id = $_POST['obj_id'];
	$obj_res = mysqli_query( $connect, "SELECT * from obj_no where obj_no = $obj_id AND sub_prog_no_id = '$sub_p' and obj_year = $prog_year");
	while($obj = mysqli_fetch_array($obj_res)){
		echo $obj['objective'];
	}
}
?>