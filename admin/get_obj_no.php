<?php
session_start();
require_once("../includes/connections.php");

if(isset($_POST['sub_prog_id'])){
	
	$prog_year = $_SESSION['prog_year'];
	$sub_prog_id = $_POST['sub_prog_id'];
	
	$_SESSION['sub_prog_id'] = $sub_prog_id;
	
	$obj_res = mysqli_query( $connect, "SELECT * from obj_no where sub_prog_no_id = '$sub_prog_id' and obj_year = $prog_year");
	$eleme = "<option value=''>[-SELECT-]</option>";
	//$elem = $elem . "<option value=''>[-Select-]</option>";
	while($obj = mysqli_fetch_array($obj_res)){
		$obj_no = $obj[2];
		//echo '<option value="'.$sub_prog_no['sub_no'].'">'.$sub_prog_no['sub_no'].'</option>';
		$eleme = $eleme."<option value='".$obj_no."'>".$obj_no."</option>";
	}
	echo $eleme;
}
?>
