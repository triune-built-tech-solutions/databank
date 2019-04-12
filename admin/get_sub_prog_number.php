<?php
session_start();
require_once("../includes/connections.php");

if(isset($_POST['prog_id'])){
	
	$sub_year = $_SESSION['prog_year'];
	$prog_id = $_POST['prog_id'];
	
	$prog_res = mysqli_query( $connect, "SELECT * from sub_prog_no where prog_id = $prog_id and sub_year = $sub_year");
	$elem = "<option value=''>[-SELECT-]</option>";
	//$elem = $elem . "<option value=''>[-Select-]</option>";
	while($sub_prog = mysqli_fetch_array($prog_res)){
		$sub = $sub_prog[2];
		//echo '<option value="'.$sub_prog_no['sub_no'].'">'.$sub_prog_no['sub_no'].'</option>';
		$elem = $elem."<option value='".$sub."'>".$sub."</option>";
	}
	echo $elem . "<option value=''>Add</option>";
}
?>
