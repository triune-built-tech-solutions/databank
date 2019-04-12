<?php
require_once("../includes/connections.php");

if(isset($_POST['office_type'])){
	$office_type = $_POST['office_type'];
	
	$elem = "<option value=' '>[-SELECT-]</option>";
	
	$location = mysqli_query( $connect, "SELECT * from area_office where office_type_id = $office_type order by area_office_name");
	while($loc = mysqli_fetch_array($location)){
		$subti = $loc['0'];
		$sub = $loc['2'];
		$elem = $elem."<option value='".$subti."'>".$sub."</option>";
	}
			echo $elem;
}
?>