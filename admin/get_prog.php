<?php
session_start();

require_once("../includes/connections.php");

$prog_year = $_SESSION['prog_year'];

if(isset($_POST['id'])){
	$id = $_POST['id'];
	$result = mysqli_query( $connect, "SELECT * from prog_no where prog_no = $id and prog_year = $prog_year");
	while($prog = mysqli_fetch_array($result)){
		echo $prog['2'];
	}
	
	if(mysqli_num_rows($result) == 0){
		echo "";
	}
}
?>