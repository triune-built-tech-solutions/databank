<?php
require_once("../includes/connections.php");

if(isset($_POST['unit_id'])){
	$unit_id = $_POST['unit_id'];
	
	$elem = "<option value=''>[-SELECT-]</option>";
	
	$sub_unit_res = mysqli_query( $connect, "SELECT * from sub_unit where unit_id = $unit_id AND status = 0");
	while($sub_unit = mysqli_fetch_array($sub_unit_res)){
		$subti = $sub_unit['0'];
		$sub = $sub_unit['2'];
		$elem = $elem."<option value='".$subti."'>".$sub."</option>";
	}
			echo $elem;
}
?>