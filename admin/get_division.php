<?php
require_once("../includes/connections.php");

if(isset($_POST['dept'])){
	
	$dept = $_POST['dept'];
	
	$elem = "<option value=' '>[-SELECT-]</option>";
	
	$division = mysqli_query( $connect, "SELECT * from division where status = 1 AND dept_id = $dept");
	while($divi = mysqli_fetch_array($division)){
		$sub = $divi[2];
		$sub1 = $divi[0];
		$elem = $elem."<option value='".$sub1."'>".$sub."</option>";
	}
	echo $elem;
}
?>
