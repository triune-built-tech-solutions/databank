<?php
session_start();

require_once("../includes/connections.php");

$prog_year = $_SESSION['prog_year'];

if(isset($_POST['sub_id'])){
	$id = $_POST['sub_id'];
	$result = mysqli_query( $connect, "SELECT * from sub_prog_no where sub_no = '$id' and sub_year = $prog_year");
	while($sub_prog = mysqli_fetch_array($result)){
		echo $sub_prog['3'];
	}
}

?>