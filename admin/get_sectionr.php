<?php
require_once("../includes/connections.php");

if(isset($_POST['div'])){
	
	$div = $_POST['div'];
	
	$elem = "<option value=' '>[-SELECT-]</option>";
	
	$division = mysqli_query( $connect, "SELECT * from section where status = 0 AND div_id = $div");
	while($divi = mysqli_fetch_array($division)){
		$sect = $divi[2];
		$div_id = $divi[0];
		$elem = $elem."<option value='".$div_id."'>".$sect."</option>";
	}
	echo $elem;
}
?>
