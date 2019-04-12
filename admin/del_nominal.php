<?php
require_once("../includes/connections.php");

if(isset($_REQUEST['delete'])){
	$ids = $_REQUEST['del'];
	
	for($j=0;$j<count($ids);$j++){
		$new_id = $ids[$j];
		$w = "select * from nominal where id= ".$new_id;
		$result = mysqli_query( $connect, $w) or
		die ("Error Selecting from table ".mysqli_error($GLOBALS["___mysqli_ston"]));
		
		$row = mysqli_fetch_array($result);
		
		$x = "INSERT INTO retired_staff value($row[0], '$row[1]', '$row[2]', '$row[3]', '$row[4]', '$row[5]', '$row[6]', '$row[7]', '$row[8]', '$row[9]', '$row[10]')";
		mysqli_query( $connect, $x) or
		die ("Error Inserting into table ".mysqli_error($GLOBALS["___mysqli_ston"]));
		
	}
	
	
	for($i=0;$i<count($ids);$i++){
		$news_id = $ids[$i];
		$q = "delete from nominal where id= ".$news_id;
		mysqli_query( $connect, $q) or
		die ("Error Deleting from server".mysqli_error($GLOBALS["___mysqli_ston"]));
	}
	
	header("Location: view_nominal.php?msg=success");
	
} else {
	header("Location: view_nominal.php");
}
?>