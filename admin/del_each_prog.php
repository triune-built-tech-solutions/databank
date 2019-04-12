<?php
require_once("../includes/connections.php");

if(isset($_REQUEST['delete'])){
	$ids = $_REQUEST['del'];
	
	for($i=0;$i<count($ids);$i++){
		$news_id = $ids[$i];
		$q = "delete from staff_prog where id= ".$news_id;
		mysqli_query( $connect, $q) or
		die ("Error Deleting from server".mysqli_error($GLOBALS["___mysqli_ston"]));
		
		header("Location: view_nominal.php");
	}
	
} else {
	header("Location: view_nominal.php");
}
?>